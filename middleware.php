<?php 

    function cleanInput($str){
        $str = trim($str); 
        $str = strip_tags($str); 
        $str = addslashes($str); 
        return $str;
    }

    function alphaSpaceValidation($name_to_validate){ // only alphabets and spaces
        $reg_exp = "/^[a-zA-Z\s]+$/";
        return preg_match($reg_exp, $name_to_validate);
    }

    function amountValidation($amount_to_validate){ // only numbers and .
        $reg_exp = "/^[0-9\.]+$/";
        return preg_match($reg_exp, $amount_to_validate);
    }

    function contactValidation($contact_to_validate){
        $reg_exp = "/^[1-9][0-9]{9}$/";
        return preg_match($reg_exp, $contact_to_validate);
    }

    function addressValidation($address_to_validate){ // only alphabets, numbers, space and special characters(/ , - . # _)
        $reg_exp = "/^[a-zA-Z0-9\/\-\,\#\.\_\s]+$/";
        return preg_match($reg_exp, $address_to_validate);
    }

    function alphaNumericSpaceValidation($string_to_validate){ // only alphabets and numbers
        $reg_exp = "/^[a-zA-Z0-9\s]+$/";
        return preg_match($reg_exp, $string_to_validate);
    }

    function dateValidation($date_to_validate){ 
        /*
        $reg_exp = "";
        return preg_match($reg_exp, $date_to_validate);
        */
        return true;
    }

    function emailValidation($email_to_validate){
        $reg_exp = "/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/"; // regular expression for email
        return preg_match($reg_exp, $email_to_validate);
    }

    function passwordValidation($password_to_validate){ 
        // Minimum 8 characters, at least one uppercase letter, one lowercase letter, one number and one special character Maximum limit 20 characters
        $reg_exp = "/^(?=.*[0-9])"."(?=.*[a-z])(?=.*[A-Z])"."(?=.*[@#$%^&+=])"."(?=\\S+$).{8,20}$/"; // regular expression for password
        return preg_match($reg_exp, $password_to_validate);
    }
?>