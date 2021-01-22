<?php 
    session_start();
    require_once('connection.php');
    

    if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role'] != '2'){
            $_SESSION['error_msg'] = 'Only Admin can access that resource';
            header('Location: login.php');
            exit;
        }
    }
    else{
        $_SESSION['error_msg'] = 'LogIn to view that resource';
        header('Location: login.php');
        exit;
    }

    $bank_name = '';
    $bank_branch = '';
    $bank_city = '';
    $bank_address = '';
    $bank_contact_person_name = '';
    $bank_contact_person_number = '';
    $bank_name_error = '';
    $bank_branch_error = '';
    $bank_city_error = '';
    $bank_address_error = '';
    $bank_contact_person_name_error = '';
    $bank_contact_person_number_error = '';
    

    function cleanInput($str){
        $str = trim($str); 
        $str = strip_tags($str); 
        $str = addslashes($str);
        return $str;
    }

    function nameValidation($name_to_validate){
        $reg_exp = "/^[a-zA-Z\s]+$/";
        return preg_match($reg_exp, $name_to_validate);
    }
    
    function addressValidation($address_to_validate){
        $reg_exp = "/^[a-zA-Z0-9\/\-\,\#\.\_\s]+$/";
        return preg_match($reg_exp, $address_to_validate);
    }

    function contactValidation($contact_to_validate){
        $reg_exp = "/^[6789][0-9]{9}$/";
        return preg_match($reg_exp, $contact_to_validate);
    }

    if(isset($_POST['bankName']) && isset($_POST['bankBranch']) && isset($_POST['bankCity']) && isset($_POST['bankAddress']) && isset($_POST['bankContactPersonName']) && isset($_POST['bankContactPersonNumber'])){

        $bank_name = cleanInput($_POST['bankName']);
        $bank_branch = cleanInput($_POST['bankBranch']);
        $bank_city = cleanInput($_POST['bankCity']);
        $bank_address = cleanInput($_POST['bankAddress']);
        $bank_contact_person_name = cleanInput($_POST['bankContactPersonName']);
        $bank_contact_person_number = cleanInput($_POST['bankContactPersonNumber']);
        $control = 1;

        if(!empty($bank_name)){
            if(!nameValidation($bank_name)){
                $bank_name_error = 'Invalid name';
                $control = 0;
            }
        }
        else{
            $bank_name_error = 'Bank name required';
            $conrol = 0;
        }

        if(!empty($bank_branch)){
            if(!nameValidation($bank_branch)){
                $bank_branch_error = 'Invalid name';
                $control = 0;
            }
        }
        else{
            $bank_branch_error = 'Branch name required';
            $conrol = 0;
        }
        
        if(!empty($bank_city)){
            if(!nameValidation($bank_city)){
                $bank_city_error = 'Invalid name';
                $control = 0;
            }
        }
        else{
            $bank_city_error = 'City required';
            $conrol = 0;
        }

        if(!empty($bank_address)){
            if(!addressValidation($bank_address)){
                $bank_address_error = 'Invalid address';
                $control = 0;
            }
        }
        else{
            $bank_address_error = 'Address required';
            $conrol = 0;
        }

        if(!empty($bank_contact_person_name)){
            if(!nameValidation($bank_contact_person_name)){
                $bank_contact_person_name_error = 'Invalid name';
                $control = 0;
            }
        }
        else{
            $bank_contact_person_name_error = 'Name required';
            $conrol = 0;
        }

        if(!empty($bank_contact_person_number)){
            if(!contactValidation($bank_contact_person_number)){
                $bank_contact_person_number_error = 'Invalid contact';
                $control = 0;
            }
        }
        else{
            $bank_contact_person_number_error = 'Contact required';
            $control = 0;
        }

        if($control){
            $sql = "INSERT INTO `bank` (`bank_id`, `bank_name`, `bank_branch`, `bank_city`, `bank_address`, `bank_contact_person_name`, `bank_contact_person_number`) VALUES (NULL, '$bank_name', '$bank_branch', '$bank_city', '$bank_address', '$bank_contact_person_name', '$bank_contact_person_number')";
            $conn->query($sql);

            if($conn->error == ''){
                $bank_name = '';
                $bank_branch = '';
                $bank_city = '';
                $bank_address = '';
                $bank_contact_person_name = '';
                $bank_contact_person_number = '';
                $_SESSION['success_msg'] = 'Bank added successfully';
            }
            else{
                $_SESSION['error_msg'] = 'Something went wrong!';
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Bank</title>
    <link rel="stylesheet" type="text/css" href="pretty-forms-assets/css/form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
     <div class="wrapper">
        <div class="form-container">
                <h5 class="form-header">
                    <label>Add Bank</label>
                </h5>
                <?php 
                    if(isset($_SESSION['success_msg'])){
                        ?>
                        <div class="success">
                            <i class="fa fa-check"></i>
                            <span>
                                <?php echo $_SESSION['success_msg']; ?>
                            </span>
                        </div>
                        <?php
                        unset($_SESSION['success_msg']);
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
                <form action="" method="POST" id="validate-form" class="form-layout" novalidate="">
                    <div class="set-row">
                        <div class="set-col">
                            <div class="input-container">
                                <label class="input-label">Bank Name</label>
                                <div class="input-wrap-for-icon">
                                    <span>
                                        <i class="fa fa-bank"></i>
                                    </span>
                                    <input class="form-input" type="text" name="bankName" value="<?php echo $bank_name; ?>" placeholder="Bank Name" required="">
                                </div>
                            </div>
                            <div class="form-input-response">
                                <?php echo $bank_name_error; ?>
                            </div>
                        </div>
                    </div>
                    <div class="set-row">
                        <div class="set-col">
                            <div class="input-container">
                                <label class="input-label">Bank Branch</label>
                                <input  class="form-input"  name="bankBranch" value="<?php echo $bank_branch; ?>" placeholder="Bank Branch" required="">
                            </div>
                            <div  class="form-input-response">
                                <?php echo $bank_branch_error; ?>
                            </div>
                        </div>
                        <div class="set-col">
                            <div class="input-container">
                                <label class="input-label">Bank City</label>
                                <input class="form-input"  name="bankCity" value="<?php echo $bank_city; ?>" placeholder="Bank City" required="">
                            </div>
                            <div class="form-input-response">
                                <?php echo $bank_city_error; ?>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    <div class="set-row">
                        <div class="set-col">
                            <div class="input-container">
                                <label class="input-label">Address</label>
                                <textarea class="form-input" rows="6" name="bankAddress"><?php echo $bank_address; ?></textarea>
                            </div>
                            <div class="form-input-response">
                                <?php echo $bank_address_error; ?>
                            </div>
                        </div>
                    </div>
                    <div class="set-row">
                        <div class="set-col">
                            <div class="input-container">
                                <label class="input-label">Contact Person Name</label>
                                <div class="input-wrap-for-icon">
                                    <span>
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input  class="form-input"  name="bankContactPersonName" value="<?php echo $bank_contact_person_name; ?>">
                                </div>
                            </div>
                            <div id="password-validate-response" class="form-input-response">
                                <?php echo $bank_contact_person_name_error; ?>
                            </div>
                        </div>
                        <div class="set-col">
                            <div class="input-container">
                                <label class="input-label">Contact Person Number</label>
                                <div class="input-wrap-for-icon">
                                    <span>
                                        <i class="fa fa-phone"></i>
                                    </span>
                                    <input type="number" class="form-input" name="bankContactPersonNumber" value="<?php echo $bank_contact_person_number; ?>">
                                </div>
                            </div>
                            <div class="form-input-response">
                                <?php echo $bank_contact_person_number_error; ?>
                            </div>
                        </div>
                    </div>
            
                    
                    <div class="submit-btn-wrapper">
                        <button id="submit-btn">Add</button>
                    </div>
                </form>
                <div class="form-footer"></div>
            </div>
     </div>
</body>
</html>