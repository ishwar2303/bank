<?php 
    session_start();
    require_once('connection.php');
    require_once('middleware.php');  
    
    $user_email = '';
    $user_password = '';
    $user_email_error = '';
    $user_password_error = '';
    $login_error = '';

    if(isset($_POST['userEmail']) && isset($_POST['userPassword'])){
        // initialize variables with user data
        $user_email = $_POST['userEmail'];
        $user_password = $_POST['userPassword'];
        $control = 1;
        $registered = 1;
        
        $user_email = cleanInput($user_email);
        if(!empty($user_email)){ // not empty
            if(!emailValidation($user_email)){ // call for email validation
                $user_email_error = 'Invalid E-mail';
                $control = 0;
            }
            else{ 
                $encoded_user_email = base64_encode($user_email);
                $sql = "SELECT user_id FROM user_registration WHERE user_email = '$encoded_user_email'";
                $result = $conn->query($sql);
                if($result->num_rows == 0){
                    $user_email_error = "Not registered!";
                    $control = 0;
                    $registered = 0;
                }
            }
        }
        else{
            $user_email_error = 'E-mail required';
            $control = 0;
        }
        if($registered){
          $user_password = cleanInput($user_password);
          if(empty($user_password)){ // not empty
              $user_password_error = 'Password required';
              $control = 0;
          }
          else{
              $encoded_user_password = base64_encode($user_password);
          }

          if($control){ 

              $sql = "SELECT user_id, user_role, user_full_name, user_password_changed FROM user_registration WHERE user_email = '$encoded_user_email' AND user_password ='$encoded_user_password'";
              $result = $conn->query($sql);

              if($result->num_rows == 1){ // authenticated
                  $row = $result->fetch_assoc();
                  $_SESSION['login_time'] = time();
                  $_SESSION['user_id'] = $row['user_id'];
                  $_SESSION['user_role'] = $row['user_role'];
                  $_SESSION['user_full_name'] = $row['user_full_name'];
                  if($row['user_password_changed'] == '0')
                      $_SESSION['note_msg'] = 'Please change your password';
                  header('Location: index.php');
                  exit;
              }
              else{
                  $_SESSION['error_msg'] = 'Wrong Password';
              }
              
          }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require 'includes/layout.php'; ?>
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
                  <span>Asset Reconservices</span>
                </h3>
                </div>
                <h4>Hello!</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                
                <!-- Flash Message  -->
                <?php require 'includes/flash-message.php'; ?>

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
