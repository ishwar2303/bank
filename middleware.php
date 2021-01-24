<?php 

function cleanInput($str){
    $str = trim($str); 
    $str = strip_tags($str); 
    $str = addslashes($str); 
    return $str;
}

function alphaSpaceValidation($name_to_validate){
    $reg_exp = "/^[a-zA-Z\s]+$/";
    return preg_match($reg_exp, $name_to_validate);
}

function amountValidation($amount_to_validate){
    $reg_exp = "/^[0-9\.]+$/";
    return preg_match($reg_exp, $amount_to_validate);
}

function contactValidation($contact_to_validate){
    $reg_exp = "/^[6789][0-9]{9}$/";
    return preg_match($reg_exp, $contact_to_validate);
}

function addressValidation($address_to_validate){
    $reg_exp = "/^[a-zA-Z0-9\/\-\,\#\.\_\s]+$/";
    return preg_match($reg_exp, $address_to_validate);
}

function alphaNumericSpaceValidation($string_to_validate){
    $reg_exp = "/^[a-zA-Z0-9\s]+$/";
    return preg_match($reg_exp, $string_to_validate);
}

function dateValidation($date_to_validate){
    /*
    $reg_exp = "/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/";
    return preg_match($reg_exp, $date_to_validate);
    */
    return true;
}

function emailValidation($email_to_validate){
    $reg_exp = "/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/"; // regular expression for email
    return preg_match($reg_exp, $email_to_validate);
}

function passwordValidation($password_to_validate){
    $reg_exp = "/^(?=.*[0-9])"."(?=.*[a-z])(?=.*[A-Z])"."(?=.*[@#$%^&+=])"."(?=\\S+$).{8,20}$/"; // regular expression for password
    return preg_match($reg_exp, $password_to_validate);
}
?>