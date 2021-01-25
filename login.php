<?php 
    session_start();
    require_once('connection.php');
    $user_email = '';
    $user_password = '';
    $user_email_error = '';
    $user_password_error = '';
    $login_error = '';
    function cleanInput($str){
        $str = trim($str); 
        $str = strip_tags($str); 
        $str = addslashes($str);
        return $str;
    }
    function emailValidation($email_to_validate){
        $reg_exp = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/"; // regular expression for email
        return preg_match($reg_exp, $email_to_validate);
    }
    
    function passwordValidation($password_to_validate){
        $reg_exp = "/^(?=.*[0-9])"."(?=.*[a-z])(?=.*[A-Z])"."(?=.*[@#$%^&+=])"."(?=\\S+$).{8,20}$/"; // regular expression for password
        return preg_match($reg_exp, $password_to_validate);
    }
    

    if(isset($_POST['userEmail']) && isset($_POST['userPassword'])){
        // initialize variables with user data
        $user_email = $_POST['userEmail'];
        $user_password = $_POST['userPassword'];
        $control = 1;
        
        $user_email = cleanInput($user_email);
        if(!empty($user_email)){ // not empty
            if(!emailValidation($user_email)){ // call for email validation
                $user_email_error = 'Invalid E-mail';
                $control = 0;
            }
            else{ 
                $encoded_user_email = base64_encode($user_email);
                $sql = "SELECT user_email FROM user_registration WHERE user_email = '$encoded_user_email'";
                $result = $conn->query($sql);
                if($result->num_rows == 0){
                    $user_email_error = "Not registered!";
                    $control = 0;
                }
            }
        }
        else{
            $user_email_error = 'E-mail required';
            $control = 0;
        }

        $user_password = cleanInput($user_password);
        if(empty($user_password)){ // not empty
            $user_password_error = 'Password required';
            $control = 0;
        }
        else{
            $encoded_user_password = base64_encode($user_password);
        }

        if($control){ 

            $sql = "SELECT user_id, user_role, user_full_name FROM user_registration WHERE user_email = '$encoded_user_email' AND user_password ='$encoded_user_password'";
            $result = $conn->query($sql);

            if($result->num_rows == 1){ // authenticated
                $row = $result->fetch_assoc();
                $_SESSION['login_time'] = time();
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_role'] = $row['user_role'];
                $_SESSION['user_full_name'] = $row['user_full_name'];
                header('Location: index.php');
                exit;
            }
            else{
                $login_error = 'Wrong credentials!';
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
    <title>Sign In</title>
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
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                <h3 class="logo-container">
                  <i class="fas fa-university"></i>
                  <span>BANK</span>
                </h3>
                </div>
                <h4>Hello!</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>

                <?php if($login_error != ''){ ?>
                    <div class="error-msg">
                        <i class="fas fa-times"></i>
                        <span>
                            <?php echo $login_error; ?>
                        </span>
                    </div>
                <?php } ?>
              
                <?php 
                    if(isset($_SESSION['error_msg'])){
                        ?>
                        <div class="error-msg">
                          <i class="fas fa-times"></i>
                            <span>
                                <?php echo $_SESSION['error_msg']; ?>
                            </span>
                        </div>
                        <?php
                        unset($_SESSION['error_msg']);
                    }
                ?>
                
                <?php 
                    if(isset($_SESSION['success_msg'])){
                        ?>
                        <div class="success-msg">
                            <i class="fa fa-check"></i>
                            <span>
                                <?php echo $_SESSION['success_msg']; ?>
                            </span>
                        </div>
                        <?php
                        unset($_SESSION['success_msg']);
                    }
                ?>

                <form class="pt-3" method="POST">
                  <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-gradient-primary text-white br"><i class="fas fa-envelope"></i></span>
                      </div>
                      <input type="email" class="form-control form-input" id="exampleInputPassword1" name="userEmail" placeholder="User Email" value="<?php echo $user_email; ?>">
                    </div>
                    <div id="email-validate-response" class="form-input-response">
                        <?php echo $user_email_error; ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-gradient-primary text-white br"><i class="fas fa-key"></i></span>
                      </div>
                      <input type="password" class="form-control form-input" id="exampleInputPassword1" name="userPassword" placeholder="Password" value="<?php echo $user_password; ?>">
                    </div>
                    <div id="password-validate-response" class="form-input-response">
                        <?php echo $user_password_error; ?>
                    </div>
                  </div>
                  <div class="mt-3">
                    <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                  </div>
                  <!--
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input"> Keep me signed in </label>
                    </div>
                    <a href="#" class="auth-link text-black">Forgot password?</a>
                  </div>
                  <!-- 
                  <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="register.php" class="text-primary">Create</a>
                  </div> -->
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