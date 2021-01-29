<?php 

    session_start();
    require_once('connection.php');
    require_once('middleware.php');

    if(!isset($_SESSION['user_role'])){ // all access
    $_SESSION['error_msg'] = 'Sign In to view that resource';
    header('Location: login.php');
    exit;
    }


    class response{
        public $success;
        public $error;

        function set_response($suc, $err){
            $this->success = $suc;
            $this->error = $err;
            print_r(json_encode($this));
        }
    }
    $res_data = new response();
    if(isset($_POST['newPassword']) && isset($_POST['confirmPassword'])){
        $new_password = cleanInput($_POST['newPassword']);
        $confirm_password = cleanInput($_POST['confirmPassword']);

        if(!empty($new_password)){
            if(!passwordValidation($new_password)){
                $error = 'Minimum 8 characters, at least one uppercase letter, one lowercase letter, one number and one special character
                <br>Maximum limit 20 characters';
                $res_data->set_response(false, $error);
                return;
            }
        }
        else{
            $error = 'New password required!';
            $res_data->set_response(false, $error);
            return;
        }
        if(!empty($confirm_password)){
            if($new_password != $confirm_password){
                $error = 'Password not matched!';
                $res_data->set_response(false, $error);
                return;
            }
        }
        else{
            $error = 'Confirm password required!';
            $res_data->set_response(false, $error);
            return;
        }

        // if no error occur
        $hash_password = base64_encode($new_password);
        $sql = "UPDATE user_registration SET user_password = '$hash_password' WHERE user_id = '$_SESSION[user_id]'";
        $conn->query($sql);
        if($conn->error == ''){
            unset($_SESSION['login_time']);
            unset($_SESSION['user_id']);
            unset($_SESSION['user_role']);
            unset($_SESSION['user_full_name']);
            $_SESSION['success_msg'] = 'Password changed successfully';
            $error = '';
            $res_data->set_response(true, $error);
            return;
        }
        else{
            $error = "Couldn't update password, Try again later";
            $res_data->set_response(false, $error);
            return;
        }
    }

?>