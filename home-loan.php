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
        $_SESSION['error_msg'] = 'Sign In to view that resource';
        header('Location: login.php');
        exit;
    }

    date_default_timezone_set("Asia/Kolkata");
    $epoch_time = time();
    $timestamp = date("y-m-d h:i:sa", $epoch_time);

    $home_branch = '';
    $account_number = '';
    $customer_name = '';
    $npa_date = '';
    $outstanding = '';
    $arr_co_nd = '';
    $notice13_sent_on = '';
    $principal_outstanding = '';
    $bounce_charges = '';
    $overdue_charges = '';
    $other_charges = '';
    $loan_emi_amount = '';
    $no_of_emi_outstanding = '';
    $reg_no = '';
    $residence_address = '';
    $residence_contact_no = '';
    $office_address = '';
    $office_contact_no = '';
    $make = '';
    $engine_no = '';
    $chassis_no = '';
    $tenure = '';
    $co_applicant_name = '';
    $co_applicant_mobile = '';
    $co_applicant_address = '';
    $employer_name = '';
    $employer_mobile = '';
    $employer_address = '';
    $amount_recovered = '';
    $bill_raised = '';
    $payment_received = '';
    // errors
    $home_branch_error = '';
    $account_number_error = '';
    $customer_name_error = '';
    $npa_date_error = '';
    $outstanding_error = '';
    $arr_co_nd_error = '';
    $notice13_sent_on_error = '';
    $principal_outstanding_error = '';
    $bounce_charges_error = '';
    $overdue_charges_error = '';
    $other_charges_error = '';
    $loan_emi_amount_error = '';
    $no_of_emi_outstanding_error = '';
    $reg_no_error = '';
    $residence_address_error = '';
    $residence_contact_no_error = '';
    $office_address_error = '';
    $office_contact_no_error = '';
    $make_error = '';
    $engine_no_error = '';
    $chassis_no_error = '';
    $tenure_error = '';
    $co_applicant_name_error = '';
    $co_applicant_mobile_error = '';
    $co_applicant_address_error = '';
    $employer_name_error = '';
    $employer_mobile_error = '';
    $employer_address_error = '';
    $amount_recovered_error = '';
    $bill_raised_error = '';
    $payment_received_error = '';


    function cleanInput($str){
        $str = trim($str); 
        $str = strip_tags($str); 
        $str = addslashes($str); 
        return $str;
    }
    
    function contactValidation($contact_to_validate){
        $reg_exp = "/^[6789][0-9]{9}$/";
        return preg_match($reg_exp, $contact_to_validate);
    }
    if(isset($_POST['homeBranch']) && isset($_POST['accountNo']) && isset($_POST['customerName']) && isset($_POST['npaDate']) && isset($_POST['outstanding']) && isset($_POST['arrCoNd']) && isset($_POST['notice13SentOn']) && isset($_POST['principalOutstanding']) && isset($_POST['bounceCharges']) && isset($_POST['overdueCharges']) && isset($_POST['otherCharges']) && isset($_POST['loanEmiAmount']) && isset($_POST['noOfEmiOutstanding']) && isset($_POST['regNo']) && isset($_POST['residenceAddress']) && isset($_POST['residenceContactNo']) && isset($_POST['officeAddress']) && isset($_POST['officeContactNo']) && isset($_POST['make']) && isset($_POST['engineNo']) && isset($_POST['chassisNo']) && isset($_POST['tenure']) && isset($_POST['coApplicantName']) && isset($_POST['coApplicantMobile']) && isset($_POST['coApplicantAddress']) && isset($_POST['employerName']) && isset($_POST['employerMobile']) && isset($_POST['employerAddress']) && isset($_POST['amountRecovered']) && isset($_POST['billRaised']) && isset($_POST['paymentReceived'])){
        // initialize variables with user data
        print_r($_POST);
        $control = 1;
        if($control){ // Insert data into database control = 1
            $sql = "INSERT INTO `user_registration` (`user_id`, `user_full_name`, `user_email`, `user_mobile`, `user_password`, `user_role`, `user_updated_timestamp`) VALUES (NULL, '$user_full_name', '$encoded_user_email', '$encoded_user_contact', '$encoded_user_password', '$user_role', '$timestamp')";
            $conn->query($sql); 
            
            if($conn->error == ''){    

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
    <title>Home Loan</title>
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
      <!-- partial:partials/_navbar.html -->
      <?php require 'includes/dashboard-header.php'; ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php require 'includes/side-navigation.php'; ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Home Loan</h4>
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
                      <?php 
                          if(isset($_SESSION['error_msg'])){
                              ?>
                              <div class="error-msg">
                                  <i class="fa fa-close"></i>
                                  <span>
                                      <?php echo $_SESSION['error_msg']; ?>
                                  </span>
                              </div>
                              <?php
                              unset($_SESSION['error_msg']);
                          }
                      ?>
                    <p class="card-description">It only takes a few steps</p>
                    <form class="pt-3" method="POST">
                    <div class="form-group">
                        <div class="row">
                        <div class="col-md-6">
                            <label for="exampleInputCity1">Home Branch</label>
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white br">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control form-input" id="" name="homeBranch" placeholder="Name" value="<?php echo $home_branch; ?>">
                            </div>
                            <div class="form-input-response">
                                <?php echo $home_branch_error; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputCity1">Account Number</label>
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white br">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                            <input type="number" class="form-control form-input" id="" name="accountNo" placeholder="Number" value="<?php echo $account_number; ?>">
                            </div>
                            <div class="form-input-response">
                                <?php echo $account_number_error; ?>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                        <div class="col-md-6">
                            <label for="exampleInputCity1">Customer Name</label>
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white br">
                                    <i class="fas fa-phone-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control form-input" id="" name="customerName" placeholder="Name" value="<?php echo $customer_name; ?>">
                            </div>
                            <div class="form-input-response">
                                <?php echo $customer_name_error; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputCity1">NPA Date</label>
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white br">
                                    <i class="fas fa-users"></i>
                                </span>
                            </div>
                            <input type="date" name="npaDate" class="form-control form-input">
                            </div>   
                            <div class="form-input-response">
                                <?php echo $npa_date_error; ?>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                        <div class="col-md-6">
                            <label for="exampleInputCity1">Outstanding</label>
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white br">
                                    <i class="fas fa-key"></i>
                                </span>
                            </div>
                            <input type="date" class="form-control form-input" id="" name="outstanding" >
                            </div>
                            <div class="form-input-response">
                                <?php echo $outstanding_error; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputCity1">ARR-CO ND</label>
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white br">
                                    <i class="fas fa-check-double"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control form-input"  name="arrCoNd"  value="<?php echo $arr_co_nd; ?>">
                            </div>
                            <div class="form-input-response">
                                <?php echo $arr_co_nd_error; ?>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                        <div class="col-md-6">
                            <label for="exampleInputCity1">Notice 13(2) Sent On</label>
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white br">
                                    <i class="fas fa-key"></i>
                                </span>
                            </div>
                            <input type="date" class="form-control form-input" id="" name="notice13SentOn" placeholder="Password" value="<?php  ?>">
                            </div>
                            <div class="form-input-response">
                                <?php echo $notice13_sent_on_error; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputCity1">Principal Out Standing</label>
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white br">
                                    <i class="fas fa-check-double"></i>
                                </span>
                            </div>
                            <input type="number" class="form-control form-input" id="" name="principalOutstanding" placeholder="Amount" value="<?php echo $principal_outstanding; ?>">
                            </div>
                            <div class="form-input-response">
                                <?php echo $principal_outstanding_error; ?>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                        <div class="col-md-6">
                            <label for="exampleInputCity1">Bounce Charges</label>
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white br">
                                    <i class="fas fa-key"></i>
                                </span>
                            </div>
                            <input type="number" class="form-control form-input" id="" name="bounceCharges" placeholder="Amount" value="<?php echo $bounce_charges; ?>">
                            </div>
                            <div class="form-input-response">
                                <?php echo $bounce_charges_error; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputCity1">Overdue Charges</label>
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white br"><i class="fas fa-check-double"></i></span>
                            </div>
                            <input type="number" class="form-control form-input" id="" name="overdueCharges" placeholder="Amount" value="<?php echo $overdue_charges; ?>">
                            </div>
                            <div class="form-input-response">
                                <?php echo $overdue_charges_error; ?>
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                        <div class="col-md-6">
                            <label for="exampleInputCity1">Other Charges</label>
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white br">
                                    <i class="fas fa-key"></i>
                                </span>
                            </div>
                            <input type="number" class="form-control form-input" id="" name="otherCharges" placeholder="Amount" value="<?php echo $other_charges; ?>">
                            </div>
                            <div class="form-input-response">
                                <?php echo $other_charges_error; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputCity1">Loan EMI Amount</label>
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white br">
                                    <i class="fas fa-check-double"></i>
                                </span>
                            </div>
                            <input type="number" class="form-control form-input" id="" name="loanEmiAmount" placeholder="Amount" value="<?php echo $loan_emi_amount; ?>">
                            </div>
                            <div class="form-input-response">
                                <?php echo $loan_emi_amount_error; ?>
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInputCity1">No Of EMI Outstanding</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-gradient-primary text-white br">
                                        <i class="fas fa-key"></i>
                                    </span>
                                </div>
                                <input type="number" class="form-control form-input" id="" name="noOfEmiOutstanding" placeholder="Number" value="<?php echo $no_of_emi_outstanding; ?>">
                                </div>
                                <div class="form-input-response">
                                    <?php echo $no_of_emi_outstanding_error; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputCity1">REG No</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-gradient-primary text-white br">
                                        <i class="fas fa-check-double"></i>
                                    </span>
                                </div>
                                <input type="number" class="form-control form-input" id="" name="regNo" placeholder="Number" value="<?php echo $reg_no; ?>">
                                </div>
                                <div class="form-input-response">
                                    <?php echo $reg_no_error; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md">
                                <label for="exampleInputCity1">Residence Address</label>
                                <div class="input-group">
                                <textarea class="form-control form-input" name="residenceAddress" id="" cols="30" rows="10"><?php echo $residence_address; ?></textarea>
                                </div>
                                <div id="password-validate-response" class="form-input-response">
                                    <?php echo $residence_address_error; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInputCity1">Residence Contact No</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-gradient-primary text-white br">
                                        <i class="fas fa-check-double"></i>
                                    </span>
                                </div>
                                <input type="number" class="form-control form-input" id="" name="residenceContactNo" placeholder="Number" value="<?php echo $residence_contact_no; ?>">
                                </div>
                                <div class="form-input-response">
                                    <?php echo $residence_contact_no_error; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md">
                                <label for="exampleInputCity1">Office Address</label>
                                <div class="input-group">
                                <textarea class="form-control form-input" name="officeAddress" id="" cols="30" rows="10"><?php echo $office_address; ?></textarea>
                                </div>
                                <div class="form-input-response">
                                    <?php echo $office_address_error; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInputCity1">Office Contact No</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-gradient-primary text-white br">
                                        <i class="fas fa-check-double"></i>
                                    </span>
                                </div>
                                <input type="number" class="form-control form-input" id="" name="officeContactNo" placeholder="Number" value="<?php echo $office_contact_no; ?>">
                                </div>
                                <div class="form-input-response">
                                    <?php echo $office_contact_no_error; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md">
                                <label for="exampleInputCity1">Make</label>
                                <div class="input-group">
                                <textarea class="form-control form-input" name="make" id="" cols="30" rows="10"><?php echo $make; ?></textarea>
                                </div>
                                <div class="form-input-response">
                                    <?php echo $make_error; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInputCity1">Engine Number</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-gradient-primary text-white br">
                                        <i class="fas fa-key"></i>
                                    </span>
                                </div>
                                <input type="number" class="form-control form-input" id="" name="engineNo" placeholder="Number" value="<?php echo $engine_no; ?>">
                                </div>
                                <div class="form-input-response">
                                    <?php echo $engine_no_error; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputCity1">Chassis Number</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-gradient-primary text-white br">
                                        <i class="fas fa-check-double"></i>
                                    </span>
                                </div>
                                <input type="number" class="form-control form-input" id="" name="chassisNo" placeholder="Number" value="<?php echo $chassis_no; ?>">
                                </div>
                                <div class="form-input-response">
                                    <?php echo $chassis_no_error; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInputCity1">Tenure</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-gradient-primary text-white br">
                                        <i class="fas fa-key"></i>
                                    </span>
                                </div>
                                <input type="number" class="form-control form-input" id="" name="tenure" placeholder="Number" value="<?php echo $tenure; ?>">
                                </div>
                                <div class="form-input-response">
                                    <?php echo $tenure_error; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInputCity1">Co Applicant Name</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-gradient-primary text-white br">
                                        <i class="fas fa-key"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control form-input" id="" name="coApplicantName" placeholder="Name" value="<?php echo $co_applicant_name; ?>">
                                </div>
                                <div class="form-input-response">
                                    <?php echo $co_applicant_name_error; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputCity1">Co Applicant Mobile</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-gradient-primary text-white br">
                                        <i class="fas fa-check-double"></i>
                                    </span>
                                </div>
                                <input type="number" class="form-control form-input" id="" name="coApplicantMobile" placeholder="Number" value="<?php echo $co_applicant_mobile; ?>">
                                </div>
                                <div class="form-input-response">
                                    <?php echo $co_applicant_mobile_error; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md">
                                <label for="exampleInputCity1">Co Applicant Address</label>
                                <div class="input-group">
                                <textarea class="form-control form-input" name="coApplicantAddress" id="" cols="30" rows="10"><?php echo $co_applicant_address; ?></textarea>
                                </div>
                                <div class="form-input-response">
                                    <?php echo $co_applicant_address_error; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInputCity1">Employer Name</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-gradient-primary text-white br">
                                        <i class="fas fa-key"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control form-input" id="" name="employerName" placeholder="Name" value="<?php echo $employer_name; ?>">
                                </div>
                                <div class="form-input-response">
                                    <?php echo $employer_name_error; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputCity1">Employer Mobile</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-gradient-primary text-white br">
                                        <i class="fas fa-check-double"></i>
                                    </span>
                                </div>
                                <input type="number" class="form-control form-input" id="" name="employerMobile" placeholder="Number" value="<?php echo $employer_mobile; ?>">
                                </div>
                                <div class="form-input-response">
                                    <?php echo $employer_mobile_error; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md">
                                <label for="exampleInputCity1">Employer Address</label>
                                <div class="input-group">
                                <textarea class="form-control form-input" name="employerAddress" id="" cols="30" rows="10"><?php echo $employer_address; ?></textarea>
                                </div>
                                <div class="form-input-response">
                                    <?php echo $employer_address_error; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInputCity1">Amount Recovered</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-gradient-primary text-white br">
                                        <i class="fas fa-key"></i>
                                    </span>
                                </div>
                                <input type="number" class="form-control form-input" id="" name="amountRecovered" placeholder="Amount" value="<?php echo $amount_recovered; ?>">
                                </div>
                                <div class="form-input-response">
                                    <?php echo $amount_recovered_error; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputCity1">Bill Raised</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-gradient-primary text-white br">
                                        <i class="fas fa-check-double"></i>
                                    </span>
                                </div>
                                <input type="number" class="form-control form-input" id="" name="billRaised" placeholder="Amount" value="<?php echo $bill_raised; ?>">
                                </div>
                                <div class="form-input-response">
                                    <?php echo $bill_raised_error; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInputCity1">Payment Received</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-gradient-primary text-white br">
                                        <i class="fas fa-key"></i>
                                    </span>
                                </div>
                                <input type="number" class="form-control form-input" id="" name="paymentReceived" placeholder="Amount" value="<?php echo $payment_received; ?>">
                                </div>
                                <div class="form-input-response">
                                    <?php echo $payment_received_error; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php print_r($_POST); ?>
                    <div class="mt-3">
                        <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Create</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates </a> from Bootstrapdash.com</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
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
    <!-- Custom js for this page -->
    <script src="assets/js/file-upload.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>
<?php 
    $conn->close();
?>