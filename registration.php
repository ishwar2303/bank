<?php 
    session_start();
    require_once('connection.php');
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
    function cleanInput($str){
        $str = trim($str); 
        $str = strip_tags($str); 
        $str = addslashes($str); 
        return $str;
    }

    function emailValidation($email_to_validate){
        $reg_exp = "/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/"; // regular expression for email
        return preg_match($reg_exp, $email_to_validate);
    }
    
    function passwordValidation($password_to_validate){
        $reg_exp = "/^(?=.*[0-9])"."(?=.*[a-z])(?=.*[A-Z])"."(?=.*[@#$%^&+=])"."(?=\\S+$).{8,20}$/"; // regular expression for password
        return preg_match($reg_exp, $password_to_validate);
    }
    
    function fullnameValidation($name_to_validate){
        $reg_exp = "/^[a-zA-Z\s]+$/";
        return preg_match($reg_exp, $name_to_validate);
    }

    function contactValidation($contact_to_validate){
        $reg_exp = "/^[6789][0-9]{9}$/";
        return preg_match($reg_exp, $contact_to_validate);
    }

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
            if(!fullnameValidation($user_full_name)){
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
            $sql = "INSERT INTO `user_registration` (`user_id`, `user_full_name`, `user_email`, `user_mobile`, `user_password`, `user_role`, `user_updated_timestamp`) VALUES (NULL, '$user_full_name', '$encoded_user_email', '$encoded_user_contact', '$encoded_user_password', '$user_role', current_timestamp())";
            $conn->query($sql); 
            
            if($conn->error == ''){    
                $_SESSION['register_success'] = 'Successfully registered';        
                header('Location: login.php');
                exit;
            }
            else{
                $db_error = 'Something went wrong!';
            }
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="pretty-forms-assets/css/form.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="wrapper">
            
            <div class="form-container">
                <h5 class="form-header">
                    <label>User Registration</label>
                </h5>
                <!-- Message for registration success -->
                <?php if($db_error != ''){ ?>
                    <div class="error">
                        <i class="fa fa-check"></i>
                        <span>
                        <?php echo $db_error; ?>
                        </span>
                    </div>
                <?php } ?>
                <form action="" method="POST" id="validate-form" class="form-layout" novalidate>
                    <div class="set-row">
                        <div class="set-col">
                            <div class="input-container">
                                <label class="input-label">Full Name</label>
                                <div class="input-wrap-for-icon">
                                    <span>
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input class="form-input" type="text" name="fullName" value="<?php echo $user_full_name; ?>" placeholder="First Name" required="">
                                </div>
                            </div>
                            <div class="form-input-response">
                                <?php echo $user_full_name_error; ?>
                            </div>
                        </div>
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
                                <label class="input-label">Contact</label>
                                <div class="input-wrap-for-icon">
                                    <span>
                                        <i class="fa fa-phone"></i>
                                    </span>
                                    <input class="form-input" type="number" name="userContact" value="<?php echo $user_contact; ?>" placeholder="Contact" required="">
                                </div>
                            </div>
                            <div class="form-input-response">
                                <?php echo $user_contact_error; ?>
                            </div>
                        </div>
                        <div class="set-col">
                            <div class="input-container">
                                <label class="input-label">Role</label>
                                <div class="input-wrap-for-icon">
                                    <span>
                                        <i class="fa fa-laptop"></i>
                                    </span>
                                    <select class="select-input" name="userRole">
                                        <option value="">Choose</option>
                                        <option value="2" <?php if($user_role == '2') echo 'selected'; ?> >Admin</option>
                                        <option value="1" <?php if($user_role == '1') echo 'selected'; ?>>Privileged User</option>
                                        <option value="0" <?php if($user_role == '0') echo 'selected'; ?>>Data Operator</option>
                                    </select>
                                </div>
                            </div>    
                            <div class="form-select-input-response">
                                <?php echo $user_role_error; ?>
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
                                    <input id="password" class="form-input" type="password" name="userPassword" value="<?php echo $user_password; ?>" placeholder="Password" required="">
                                    <i id="password-show-eye-icon" class="fa fa-eye"></i>
                                    <i id="password-hide-eye-icon" class="fa fa-eye-slash"></i>
                                </div>
                            </div>
                            <div id="password-validate-response" class="form-input-response">
                                <?php echo $user_password_error; ?>
                            </div>
                        </div>
                        <div class="set-col">
                            <div class="input-container">
                                <label class="input-label">Confirm Password</label>
                                <div class="input-wrap-for-icon">
                                    <span>
                                        <i class="fa fa-key"></i>
                                    </span>
                                    <input id="conf-password" class="form-input" type="password" name="userConfirmPassword" value="<?php echo $user_confirm_password; ?>" placeholder="Confirm Password" required="">
                                    <i id="password-match-icon" class="fa fa-check"></i> <!-- Password match -->
                                    <i id="password-not-match-icon" class="fa fa-close"></i> <!-- Password not match -->
                                </div>
                            </div>
                            <div class="form-input-response">
                                <?php echo $user_confirm_password_error; ?>
                            </div>
                        </div>
                    </div>
            
                    <div class="submit-btn-wrapper">
                        <button id="submit-btn">Register</button>
                    </div>
                </form>
                <div class="form-footer"></div>
            </div>
    
        </div>
        <script type="text/javascript" src="pretty-forms-assets/js/form.js"></script>

    </body>
</html>
