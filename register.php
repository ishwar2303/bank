<?php 
    session_start();
    require_once('connection.php');

    date_default_timezone_set("Asia/Kolkata");
    $epoch_time = time();
    $timestamp = date("y-m-d h:i:sa", $epoch_time);

    $user_full_name = '';
    $user_email = '';
    $user_contact = '';
    $user_role = '';
    $user_password = '';
    $user_confirm_password = '';
    $user_full_name_error = '';
    $user_email_error = '';
    $user_contact_error = '';
    $user_password_error = '';
    $user_role_error = '';
    $user_confirm_password_error = '';
    $db_error = '';

    require_once('middleware.php');

    if(isset($_POST['fullName']) && isset($_POST['userEmail']) && isset($_POST['userContact']) && isset($_POST['userRole']) && isset($_POST['userPassword']) && isset($_POST['userConfirmPassword'])){
        // initialize variables with user data
        $user_full_name = $_POST['fullName'];
        $user_email = $_POST['userEmail'];
        $user_contact = $_POST['userContact'];
        $user_role = $_POST['userRole'];
        $user_password = $_POST['userPassword'];
        $user_confirm_password = $_POST['userConfirmPassword'];
        $control = 1;

        $user_full_name = cleanInput($user_full_name);
        if(!empty($user_full_name)){
            if(strlen($user_full_name) < 2){
                $user_full_name_error = 'Invalid name';
                $control = 0;
            }
            if(!alphaSpaceValidation($user_full_name)){
                $user_full_name_error = 'Special charcters not allowed!';
                $control = 0;
            }
        }
        else{ // empty 
            $user_full_name_error = 'Full name required';
            $control = 0;
        }

        
        $user_email = cleanInput($user_email);
        if(!empty($user_email)){ // not empty
            if(!emailValidation($user_email)){ // call for email validation
                $user_email_error = 'Invalid E-mail';
                $control = 0;
            }
            else{ // valid E-mail
                $encoded_user_email = base64_encode($user_email);
                $sql = "SELECT user_email FROM user_registration WHERE user_email = '$encoded_user_email'";
                $result = $conn->query($sql);
                if($result->num_rows == 1){
                    $user_email_error = 'E-mail already register';
                    $control = 0;
                }
            }
        }
        else{
            $user_email_error = 'E-mail required';
            $control = 0;
        }

        $user_contact = cleanInput($user_contact);
        if(!empty($user_contact)){
            if(!contactValidation($user_contact)){
                $user_contact_error = 'Invalid contact';
                $control = 0;
            }
            $encoded_user_contact = base64_encode($user_contact);
        }
        else{
            $user_contact_error = 'Contact required';
            $control = 0;
        }

        $user_role = cleanInput($user_role);
        if($user_role != '0' && $user_role != '1' && $user_role !='2'){
            $user_role_error = 'Role required';
            $control = 0;
            
        }

        $user_password = cleanInput($user_password);
        if(!empty($user_password)){ // not empty
            if(!passwordValidation($user_password)){ //  password validation
                $user_password_error = 'Minimum 8 characters, at least one uppercase letter, one lowercase letter, one number and one special character
                <br>Maximum limit 20 characters';
                $control = 0;
            }
            else{
                $encoded_user_password = base64_encode($user_password);
            }
        }
        else{
            $user_password_error = 'Password required';
            $control = 0;
        }

        $user_confirm_password = cleanInput($user_confirm_password);
        if(empty($user_confirm_password)){
            $user_confirm_password_error = 'Confirm password required';
            $control = 0;
        }

        if($user_password != $user_confirm_password){ // check for both password
            $user_confirm_password_error = 'Password not matched';
            $control = 0;
        }
        
        if($control){ // Insert data into database control = 1
            $sql = "INSERT INTO `user_registration` (`user_id`, `user_full_name`, `user_email`, `user_mobile`, `user_password`, `user_role`, `user_updated_timestamp`) VALUES (NULL, '$user_full_name', '$encoded_user_email', '$encoded_user_contact', '$encoded_user_password', '$user_role', '$timestamp')";
            $conn->query($sql); 
            
            if($conn->error == ''){    
                $_SESSION['success_msg'] = 'Successfully registered';        
                header('Location: login.php');
                exit;
            }
            else{
                $db_error = 'Something went wrong!';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create User</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <script src="https://kit.fontawesome.com/196c90f518.js" crossorigin="anonymous"></script>
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-7 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="assets/images/logo.svg">
                </div>
                <h4>Create User</h4>
                <h6 class="font-weight-light">It only takes a few steps</h6>
                <form class="pt-3" method="POST">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label for="exampleInputCity1">Full Name</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text bg-gradient-primary text-white br"><i class="fas fa-user"></i></span>
                          </div>
                          <input type="text" class="form-control form-input" id="" name="fullName" placeholder="Full Name" value="<?php echo $user_full_name; ?>">
                        </div>
                        <div class="form-input-response">
                            <?php echo $user_full_name_error; ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="exampleInputCity1">E-mail</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text bg-gradient-primary text-white br"><i class="fas fa-envelope"></i></span>
                          </div>
                          <input type="email" class="form-control form-input" id="" name="userEmail" placeholder="E-mail" value="<?php echo $user_email; ?>">
                        </div>
                        <div id="email-validate-response" class="form-input-response">
                            <?php echo $user_email_error; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label for="exampleInputCity1">Contact</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text bg-gradient-primary text-white br"><i class="fas fa-phone-alt"></i></span>
                          </div>
                          <input type="number" class="form-control form-input" id="" name="userContact" placeholder="Contact" value="<?php echo $user_contact; ?>">
                        </div>
                        <div class="form-input-response">
                            <?php echo $user_contact_error; ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="exampleInputCity1">User Role</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text bg-gradient-primary text-white br"><i class="fas fa-users"></i></span>
                          </div>
                          <select class="form-control form-control-lg" id="exampleFormControlSelect2" name="userRole">
                            <option value="">Choose</option>
                            <option value="2" <?php if($user_role == '2') echo 'selected'; ?> >Admin</option>
                            <option value="1" <?php if($user_role == '1') echo 'selected'; ?>>Privileged User</option>
                            <option value="0" <?php if($user_role == '0') echo 'selected'; ?>>Data Operator</option>
                          </select>
                        </div>   
                        <div class="form-input-response">
                            <?php echo $user_role_error; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label for="exampleInputCity1">Password</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text bg-gradient-primary text-white br"><i class="fas fa-key"></i></span>
                          </div>
                          <input type="password" class="form-control form-input" id="" name="userPassword" placeholder="Password" value="<?php echo $user_password; ?>">
                        </div>
                        <div id="password-validate-response" class="form-input-response">
                            <?php echo $user_password_error; ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="exampleInputCity1">Confirm Password</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text bg-gradient-primary text-white br"><i class="fas fa-check-double"></i></span>
                          </div>
                          <input type="password" class="form-control form-input" id="" name="userConfirmPassword" placeholder="Confirm Password" value="<?php echo $user_confirm_password; ?>">
                        </div>
                        <div class="form-input-response">
                            <?php echo $user_confirm_password_error; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mt-3">
                    <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="login.php" class="text-primary">Login</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
  </body>
</html>
<?php 
    $conn->close();
?>