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

            $sql = "SELECT user_id, user_role FROM user_registration WHERE user_email = '$encoded_user_email' AND user_password ='$encoded_user_password'";
            $result = $conn->query($sql);

            if($result->num_rows == 1){ // authenticated
                $row = $result->fetch_assoc();
                $_SESSION['login_time'] = time();
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_role'] = $row['user_role'];
                header('Location: index.php');
                exit;
            }
            else{
                $login_error = 'Wrong credentials!';
            }
            
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LogIn</title>
        <link rel="stylesheet" type="text/css" href="pretty-forms-assets/css/form.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="wrapper">
            
            <div class="form-container login-form">
                <h5 class="form-header">
                    <label>User Login</label>
                </h5>
                <?php if($login_error != ''){ ?>
                    <div class="error">
                        <i class="fa fa-close"></i>
                        <span>
                            <?php echo $login_error; ?>
                        </span>
                    </div>
                <?php } ?>

                <?php 
                    if(isset($_SESSION['register_success'])){
                        ?>
                        <div class="success">
                            <i class="fa fa-check"></i>
                            <span>
                                <?php echo $_SESSION['register_success']; ?>
                            </span>
                        </div>
                        <?php
                        unset($_SESSION['register_success']);
                    }
                ?>

                <?php 
                    if(isset($_SESSION['error_msg'])){
                        ?>
                        <div class="error">
                            <i class="fa fa-close"></i>
                            <span>
                                <?php echo $_SESSION['error_msg']; ?>
                            </span>
                        </div>
                        <?php
                        unset($_SESSION['error_msg']);
                    }
                ?>
                
                <form action="" method="POST" id="validate-form" class="form-layout" novalidate>
                    <div class="set-row">
                        <div class="set-col">
                            <div class="input-container">
                                <label class="input-label">E-mail</label>
                                <div class="input-wrap-for-icon">
                                    <span>
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <input id="email-validate" class="form-input" type="email" name="userEmail" value="<?php echo $user_email; ?>" placeholder="E-mail" required="">
                                </div>
                            </div>
                            <div id="email-validate-response" class="form-input-response">
                                <?php echo $user_email_error; ?>
                            </div>
                        </div>
                    </div>
                    <div class="set-row">
                        <div class="set-col">
                            <div class="input-container">
                                <label class="input-label">Password</label>
                                <div class="input-wrap-for-icon">
                                    <span>
                                        <i class="fa fa-key"></i>
                                    </span>
                                    <input id="password" class="form-input" type="password" name="userPassword" value="<?php echo $user_password ?>" placeholder="Password" required="">
                                    <i id="password-show-eye-icon" class="fa fa-eye"></i>
                                    <i id="password-hide-eye-icon" class="fa fa-eye-slash"></i>
                                </div>
                            </div>
                            <div id="password-validate-response" class="form-input-response">
                                <?php echo $user_password_error; ?>
                            </div>
                        </div>
                    </div>
            
                    <div class="submit-btn-wrapper">
                        <button id="submit-btn">Login</button>
                    </div>
                </form>
                <div class="form-footer"></div>
            </div>
    
        </div>

        <script type="text/javascript" src="pretty-forms-assets/js/form.js"></script>

    </body>
</html>
