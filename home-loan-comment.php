<?php 
    session_start();
    require_once('connection.php');

    if(!isset($_SESSION['user_role'])){ // all access
        $_SESSION['error_msg'] = 'Sign In to view that resource';
        header('Location: login.php');
        exit;
    }

    date_default_timezone_set("Asia/Kolkata");
    $epoch_time = time();
    $timestamp = date("y-m-d h:i:sa", $epoch_time);


    require_once('middleware.php');
    $npa_case = '';
    $bank_name = '';
    $bank_contact_person_name = '';
    $bank_contact_person_number = '';
    $bank_contact_person_designation = '';
    $bank_address = '';
    $bank_contact_person_email = '';
    $borrower_name = '';
    $amount = '';
    $outstanding_on = '';
    $ra_agreement_signed_on = '';
    $ra_agreement_expired_on = '';
    $date_of_notice13_2 = '';
    $date_of_notice13_3 = '';
    $primary_security = '';
    $collateral_security = '';
    $total_security = '';
    $date_of_symbolic_possession = '';
    $publication_hindu_newspaper = '';
    $publication_english_newspapaer = '';
    $requested_bank_for_documentation_on = '';
    $documents_received_on = '';
    $documents_given_to_advocate_on = '';
    $application_file_dm_cmm_advocate_on = '';
    $date_of_hearing = '';
    $compromise = '0';
    $date_of_compromise = '';
    $amount_of_compromise = '';
    $full_compromise_paid_upto = '';
    $ots = '0';
    $date_of_ots_accepted = '';
    $full_ots_paid_upto = '';
    $compromise_ots_failed = '';
    $property_sold_on = '';
    $property_sold_for = '';
    $full_amount_of_compromise_received_on = '';
    $full_amount_of_ots_received_on = '';
    $date_of_ra_bill = '';
    $amount_of_ra_bill = '';
    $ra_bill_forward_to_bank_on = '';
    $ra_bill_paid_on = '';
    $ra_bill_paid_amount = '';
    $total_amount_of_expenses_incurred = '';
    $income_case_wise_profit_loss = '';
    //errors
    $npa_case_error = '';
    $bank_name_error = '';
    $bank_contact_person_name_error = '';
    $bank_contact_person_number_error = '';
    $bank_contact_person_designation_error = '';
    $bank_address_error = '';
    $bank_contact_person_email_error = '';
    $borrower_name_error = '';
    $amount_error = '';
    $outstanding_on_error = '';
    $ra_agreement_signed_on_error = '';
    $ra_agreement_expired_on_error = '';
    $date_of_notice13_2_error = '';
    $date_of_notice13_3_error = '';
    $primary_security_error = '';
    $collateral_security_error = '';
    $total_security_error = '';
    $date_of_symbolic_possession_error = '';
    $publication_hindu_newspaper_error = '';
    $publication_english_newspapaer_error = '';
    $requested_bank_for_documentation_on_error = '';
    $documents_received_on_error = '';
    $documents_given_to_advocate_on_error = '';
    $application_file_dm_cmm_advocate_on_error = '';
    $date_of_hearing_error = '';
    $date_of_compromise_error = '';
    $amount_of_compromise_error = '';
    $full_compromise_paid_upto_error = '';
    $date_of_ots_accepted_error = '';
    $full_ots_paid_upto_error = '';
    $compromise_ots_failed_error = '';
    $property_sold_on_error = '';
    $property_sold_for_error = '';
    $full_amount_of_compromise_received_on_error = '';
    $full_amount_of_ots_received_on_error = '';
    $date_of_ra_bill_error = '';
    $amount_of_ra_bill_error = '';
    $ra_bill_forward_to_bank_on_error = '';
    $ra_bill_paid_on_error = '';
    $ra_bill_paid_amount_error = '';
    $total_amount_of_expenses_incurred_error = '';
    $income_case_wise_profit_loss_error = '';

    if(isset($_POST['npaCase']) && isset($_POST['bankName']) && isset($_POST['bankContactPersonName']) && isset($_POST['bankContactPersonDesignation']) && isset($_POST['bankContactPersonNumber']) && isset($_POST['bankContactPersonEmail']) && isset($_POST['bankAddress']) && isset($_POST['borrowerName']) && isset($_POST['amount']) && isset($_POST['outstandingOn']) && isset($_POST['raAgreementSignedOn']) && isset($_POST['raAgreementExpiredOn']) && isset($_POST['dateOfNotice132']) && isset($_POST['dateOfNotice133']) && isset($_POST['primarySecurity']) && isset($_POST['collateralSecurity']) && isset($_POST['totalSecurity']) && isset($_POST['dateOfSymbolicPossession']) && isset($_POST['publicationHindiNewspaperOn']) && isset($_POST['publicationEnglishNewspaperOn']) && isset($_POST['requestedBankForDocumentsOn']) && isset($_POST['documentsReceivedOn']) && isset($_POST['documentsGivenToAdvocate']) && isset($_POST['applicationFileDmCmmByAdvocateOn']) && isset($_POST['dateOfHearing']) && isset($_POST['compromise']) && isset($_POST['dateOfCompromise']) && isset($_POST['amountOfCompromise']) && isset($_POST['fullCompromisePaidUpto']) && isset($_POST['ots']) && isset($_POST['dateOfOtsAccepted']) && isset($_POST['fullOtsPaidUpto']) && isset($_POST['propertySoldOn']) && isset($_POST['propertySoldFor']) && isset($_POST['fullAmountCompromiseReceivedOn']) && isset($_POST['fullAmountOtsReceivedOn']) && isset($_POST['dateOfRaBill']) && isset($_POST['amountOfRaBill']) && isset($_POST['raBillForwardToBankOn']) && isset($_POST['raBillPaidOn']) && isset($_POST['raBillPaidAmount']) && isset($_POST['totalAmountOfExpensesIncurred']) && isset($_POST['incomeCaseWiseProfitLoss'])){
        // initialize variables with loan data
        $control = 1;

        $npa_case = cleanInput($_POST['npaCase']);
        $bank_name = cleanInput($_POST['bankName']);
        $bank_contact_person_name = cleanInput($_POST['bankContactPersonName']);
        $bank_contact_person_number = cleanInput($_POST['bankContactPersonNumber']);
        $bank_contact_person_designation = cleanInput($_POST['bankContactPersonDesignation']);
        $bank_address = cleanInput($_POST['bankAddress']);
        $bank_contact_person_email = cleanInput($_POST['bankContactPersonEmail']);
        $borrower_name = cleanInput($_POST['borrowerName']);
        $amount = cleanInput($_POST['amount']);
        $outstanding_on = cleanInput($_POST['outstandingOn']);
        $ra_agreement_signed_on = cleanInput($_POST['raAgreementSignedOn']);
        $ra_agreement_expired_on = cleanInput($_POST['raAgreementExpiredOn']);
        $date_of_notice13_2 = cleanInput($_POST['dateOfNotice132']);
        $date_of_notice13_3 = cleanInput($_POST['dateOfNotice133']);
        $primary_security = cleanInput($_POST['primarySecurity']);
        $collateral_security = cleanInput($_POST['collateralSecurity']);
        $total_security = cleanInput($_POST['totalSecurity']);
        $date_of_symbolic_possession = cleanInput($_POST['dateOfSymbolicPossession']);
        $publication_hindu_newspaper = cleanInput($_POST['publicationHindiNewspaperOn']);
        $publication_english_newspapaer = cleanInput($_POST['publicationEnglishNewspaperOn']);
        $requested_bank_for_documentation_on = cleanInput($_POST['requestedBankForDocumentsOn']);
        $documents_received_on = cleanInput($_POST['documentsReceivedOn']);
        $documents_given_to_advocate_on = cleanInput($_POST['documentsGivenToAdvocate']);
        $application_file_dm_cmm_advocate_on = cleanInput($_POST['applicationFileDmCmmByAdvocateOn']);
        $date_of_hearing = cleanInput($_POST['dateOfHearing']);
        $compromise = cleanInput($_POST['compromise']);
        $date_of_compromise = cleanInput($_POST['dateOfCompromise']);
        $amount_of_compromise = cleanInput($_POST['amountOfCompromise']);
        $full_compromise_paid_upto = cleanInput($_POST['fullCompromisePaidUpto']);
        $ots = cleanInput($_POST['ots']);
        $date_of_ots_accepted = cleanInput($_POST['dateOfOtsAccepted']);
        $full_ots_paid_upto = cleanInput($_POST['fullOtsPaidUpto']);
        if(isset($_POST['compromiseOtsFailed'])){
            $compromise_ots_failed = cleanInput($_POST['compromiseOtsFailed']);
        }
        else{
            $compromise_ots_failed = '-1';
        }

        $property_sold_on = cleanInput($_POST['propertySoldOn']);
        $property_sold_for = cleanInput($_POST['propertySoldFor']);
        $full_amount_of_compromise_received_on = cleanInput($_POST['fullAmountCompromiseReceivedOn']);
        $full_amount_of_ots_received_on = cleanInput($_POST['fullAmountOtsReceivedOn']);
        $date_of_ra_bill = cleanInput($_POST['dateOfRaBill']);
        $amount_of_ra_bill = cleanInput($_POST['amountOfRaBill']);
        $ra_bill_forward_to_bank_on = cleanInput($_POST['raBillForwardToBankOn']);
        $ra_bill_paid_on = cleanInput($_POST['raBillPaidOn']);
        $ra_bill_paid_amount = cleanInput($_POST['raBillPaidAmount']);
        $total_amount_of_expenses_incurred = cleanInput($_POST['totalAmountOfExpensesIncurred']);
        $income_case_wise_profit_loss = cleanInput($_POST['incomeCaseWiseProfitLoss']);

        if($npa_case != '1' && $npa_case != '2' && $npa_case != '3'){
            $npa_case_error = 'Required';
            $control = 0;
        }
        else{
            if($npa_case == '1'){
                $npa_case_value = 'New NPA Cases upto Rs 20 Lac';
            }
            
            if($npa_case == '2')
                $npa_case_value = 'New NPA Cases From Rs. 20 Lac + to Rs. 10 Crore';

            if($npa_case == '3')
                $npa_case_value = 'New NPA Cases Over 10 Crore';
        }

        if(!empty($bank_name)){
            if(!alphaSpaceValidation($bank_name)){
                $bank_name_error = 'Invalid Name';
                $control = 0;
            }
        }
        else{
            $bank_name_error = 'Required';
            $control = 0;
        }
        if(!empty($bank_contact_person_name)){
            if(!alphaSpaceValidation($bank_contact_person_name)){
                $bank_contact_person_name_error = 'Invalid Name';
                $control = 0;
            }
        }
        else{
            $bank_contact_person_name_error = 'Required';
            $control = 0;
        }
        
        if(!empty($bank_contact_person_designation)){
            if(!alphaSpaceValidation($bank_contact_person_designation)){
                $bank_contact_person_designation_error = 'Invalid Name';
                $control = 0;
            }
        }
        else{
            $bank_contact_person_designation_error = 'Required';
            $control = 0;
        }

        if(!empty($bank_contact_person_number)){
            if(!contactValidation($bank_contact_person_number)){
                $bank_contact_person_number_error = 'Invalid contact';
                $control = 0;
            }
        }
        else{
            $bank_contact_person_number_error = 'Required';
            $control = 0;
        }

        if(!empty($bank_contact_person_email)){
            if(!emailValidation($bank_contact_person_email)){
                $bank_contact_person_email_error = 'Invalid E-mail';
                $control = 0;
            }
        }
        else{
            $bank_contact_person_email_error = 'Required';
            $control = 0;
        }

        if(!empty($bank_address)){
            if(!addressValidation($bank_address)){
                $bank_address_error = 'Invalid address';
                $control = 0;
            }
        }
        else{
            $bank_address_error = 'Required';
            $control = 0;
        }

        if(!empty($borrower_name)){
            if(!alphaSpaceValidation($borrower_name)){
                $borrower_name_error = 'Invalid Name';
                $control = 0;
            }
        }
        else{
            $borrower_name_error = 'Required';
            $control = 0;
        }

        if(!empty($amount)){
            if(!amountValidation($amount)){
                $amount_error = 'Invalid Amount';
                $control = 0;
            }
        }
        else{
            $amount_error = 'Required';
            $control = 0;
        }

        if(!empty($outstanding_on)){
            if(!dateValidation($outstanding_on)){
                $outstanding_on_error = 'Invalid Date';
                $control = 0;
            }
        }
        else{
            $outstanding_on_error = 'Required';
            $control = 0;
        }

        if(!empty($ra_agreement_signed_on)){
            if(!dateValidation($ra_agreement_signed_on)){
                $ra_agreement_signed_on_error = 'Invalid Date';
                $control = 0;
            }
        }
        else{
            $ra_agreement_signed_on_error = 'Required';
            $control = 0;
        }
        if(!empty($ra_agreement_expired_on)){
            if(!dateValidation($ra_agreement_expired_on)){
                $ra_agreement_expired_on_error = 'Invalid Date';
                $control = 0;
            }
        }
        else{
            $ra_agreement_expired_on_error = 'Required';
            $control = 0;
        }
        if(!empty($date_of_notice13_2)){
            if(!dateValidation($date_of_notice13_2)){
                $date_of_notice13_2_error = 'Invalid Date';
                $control = 0;
            }
        }
        else{
            $date_of_notice13_2_error = 'Required';
            $control = 0;
        }

        if(!empty($date_of_notice13_3)){
            if(!dateValidation($date_of_notice13_3)){
                $date_of_notice13_3_error = 'Invalid Date';
                $control = 0;
            }
        }

        if(!empty($date_of_symbolic_possession)){
            if(!dateValidation($date_of_symbolic_possession)){
                $date_of_symbolic_possession_error = 'Invalid Date';
                $control = 0;
            }
        }
        else{
            $date_of_symbolic_possession_error = 'Required';
            $control = 0;
        }

        if(!empty($publication_hindu_newspaper)){
            if(!dateValidation($publication_hindu_newspaper)){
                $publication_hindu_newspaper_error = 'Invalid Date';
                $control = 0;
            }
        }
        else{
            $publication_hindu_newspaper_error = 'Required';
            $control = 0;
        }

        if(!empty($publication_english_newspapaer)){
            if(!dateValidation($publication_english_newspapaer)){
                $publication_english_newspapaer_error = 'Invalid Date';
                $control = 0;
            }
        }
        else{
            $publication_english_newspapaer_error = 'Required';
            $control = 0;
        }

        if(!empty($requested_bank_for_documentation_on)){
            if(!dateValidation($requested_bank_for_documentation_on)){
                $requested_bank_for_documentation_on_error = 'Invalid Date';
                $control = 0;
            }
        }
        else{
            $requested_bank_for_documentation_on_error = 'Required';
            $control = 0;
        }

        if(!empty($documents_received_on)){
            if(!dateValidation($documents_received_on)){
                $documents_received_on_error = 'Invalid Date';
                $control = 0;
            }
        }
        else{
            $documents_received_on_error = 'Required';
            $control = 0;
        }

        if(!empty($documents_given_to_advocate_on)){
            if(!dateValidation($documents_given_to_advocate_on)){
                $documents_given_to_advocate_on_error = 'Invalid Date';
                $control = 0;
            }
        }
        else{
            $documents_given_to_advocate_on_error = 'Required';
            $control = 0;
        }

        if(!empty($application_file_dm_cmm_advocate_on)){
            if(!dateValidation($application_file_dm_cmm_advocate_on)){
                $application_file_dm_cmm_advocate_on_error = 'Invalid Date';
                $control = 0;
            }
        }
        else{
            $application_file_dm_cmm_advocate_on_error = 'Required';
            $control = 0;
        }

        if(!empty($date_of_hearing)){
            if(!dateValidation($date_of_hearing)){
                $date_of_hearing_error = 'Invalid Date';
                $control = 0;
            }
        }
        else{
            $date_of_hearing_error = 'Required';
            $control = 0;
        }

        // compromise
        if($compromise == '1'){
            if(!empty($date_of_compromise)){
                if(!dateValidation($date_of_compromise)){
                    $date_of_compromise_error = 'Invalid Date';
                    $control = 0;
                }
            }
            else{
                $date_of_compromise_error = 'Required';
                $control = 0;
            }

            if(!empty($amount_of_compromise)){
                if(!amountValidation($amount_of_compromise)){
                    $amount_of_compromise_error = 'Invalid Amount';
                    $control = 0;
                }
            }
            else{
                $amount_of_compromise_error = 'Required';
                $control = 0;
            }

            if(!empty($full_compromise_paid_upto)){
                if(!dateValidation($full_compromise_paid_upto)){
                    $full_compromise_paid_upto_error = 'Invalid Amount';
                    $control = 0;
                }
            }
            else{
                $full_compromise_paid_upto_error = 'Required';
                $control = 0;
            }
        }

        //ots
        if($ots == '1'){
            if(!empty($date_of_ots_accepted)){
                if(!dateValidation($date_of_ots_accepted)){
                    $date_of_ots_accepted_error = 'Invalid Date';
                    $control = 0;
                }
            }
            else{
                $date_of_ots_accepted_error = 'Required';
                $control = 0;
            }

            if(!empty($full_ots_paid_upto)){
                if(!amountValidation($full_ots_paid_upto)){
                    $full_ots_paid_upto_error = 'Invalid Amount';
                    $control = 0;
                }
            }
            else{
                $full_ots_paid_upto_error = 'Required';
                $control = 0;
            }

            if($compromise_ots_failed != ''){
                if($compromise_ots_failed != '1' && $compromise_ots_failed != '0' && $compromise_ots_failed != '-1'){
                    $compromise_ots_failed_error = 'Invalid';
                    $control = 0;
                }
            }
            else{
                $compromise_ots_failed_error = 'Required';
                $control = 0;
            }
        }

        if($control){ // Insert data into database control = 1
            $sql = "INSERT INTO `home_loan` (`home_loan_cid`, `npa_case`, `bank_name`, `bank_address`, `bank_contact_person_name`, `bank_contact_person_number`, `bank_contact_person_designation`, `bank_contact_person_email`, `borrower_name`, `amount`, `outstanding_on`, `ra_agreement_signed_on`, `ra_agreement_expired_on`, `date_of_notice13_2`, `date_of_notice13_3`, `primary_security`, `collateral_security`, `total_security`, `date_of_symbolic_possession`, `publication_hindi_newspaper_on`, `publication_english_newspaper_on`, `requested_bank_for_documents`, `documents_received_on`, `documents_given_to_advocate_on`, `application_file_dm_cmm_by_advocate_on`, `date_of_hearing`, `compromise`, `date_of_compromise`, `amount_of_compromise`, `full_compromise_paid_upto`, `ots`, `date_of_ots_accepted`, `amount_of_ots_paid_upto`, `compromise_ots_failed`, `property_sold_on`, `property_sold_for`, `full_amount_compromise_received_on`, `full_amount_ots_received_on`, `date_of_ra_bill`, `amount_of_ra_bill`, `ra_bill_forward_to_bank_on`, `ra_bill_paid_on`, `ra_bill_paid_amount`, `total_amount_of_expenses_incurred`, `income_case_wise_profit_loss`) VALUES (NULL, '$npa_case_value', '$bank_name', '$bank_address', '$bank_contact_person_name', '$bank_contact_person_number', '$bank_contact_person_designation', '$bank_contact_person_email', '$borrower_name', '$amount', '$outstanding_on', '$ra_agreement_signed_on', '$ra_agreement_expired_on', '$date_of_notice13_2', '$date_of_notice13_3', '$primary_security', '$collateral_security', '$total_security', '$date_of_symbolic_possession', '$publication_hindu_newspaper', '$publication_english_newspapaer', '$requested_bank_for_documentation_on', '$documents_received_on', '$documents_given_to_advocate_on', '$application_file_dm_cmm_advocate_on', '$date_of_hearing', '$compromise', '$date_of_compromise', '$amount_of_compromise', '$full_compromise_paid_upto', '$ots', '$date_of_ots_accepted', '$full_ots_paid_upto', '$compromise_ots_failed', '$property_sold_on', '$property_sold_for', '$full_amount_of_compromise_received_on', '$full_amount_of_ots_received_on', '$date_of_ra_bill', '$amount_of_ra_bill', '$ra_bill_forward_to_bank_on', '$ra_bill_paid_on', '$ra_bill_paid_amount', '$total_amount_of_expenses_incurred', '$income_case_wise_profit_loss')";
            $conn->query($sql); 
            
            if($conn->error == ''){ 
                $_SESSION['success_msg'] = 'Added successfully';
                header('Location: home-loan.php');
                exit;   
            }   
            else{
                $_SESSION['error_msg'] = 'Something went wrong!';
            }
            
        }
        else{
            $_SESSION['note_msg'] = 'Fill required fields and make sure they are valid';
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/home-loan.js"></script>
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
                    <h4 class="card-title">Add Status</h4>
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
                      <?php 
                          if(isset($_SESSION['note_msg'])){
                              ?>
                              <div class="note-msg">
                                  <i class="far fa-comment-dots"></i>
                                  <span>
                                      <?php echo $_SESSION['note_msg']; ?>
                                  </span>
                              </div>
                              <?php
                              unset($_SESSION['note_msg']);
                          }
                      ?>
                      

                    <!-- Home loan form -->
                    <form class="pt-3" method="POST">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Date of Next Hearing</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="ra-agreement-signed" type="date" class="form-control form-input" name="raAgreementSignedOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $ra_agreement_signed_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('ra-agreement-signed').defaultValue = '<?php echo $ra_agreement_signed_on; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Order received on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="ra-agreement-expired" type="date" class="form-control form-input" name="raAgreementExpiredOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $ra_agreement_expired_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('ra-agreement-expired').defaultValue = '<?php echo $ra_agreement_expired_on; ?>'
                                </script>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Order forwarded to bank on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="ra-agreement-signed" type="date" class="form-control form-input" name="raAgreementSignedOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $ra_agreement_signed_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('ra-agreement-signed').defaultValue = '<?php echo $ra_agreement_signed_on; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Lease on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="ra-agreement-expired" type="date" class="form-control form-input" name="raAgreementExpiredOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $ra_agreement_expired_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('ra-agreement-expired').defaultValue = '<?php echo $ra_agreement_expired_on; ?>'
                                </script>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Physical Possession on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="ra-agreement-signed" type="date" class="form-control form-input" name="raAgreementSignedOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $ra_agreement_signed_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('ra-agreement-signed').defaultValue = '<?php echo $ra_agreement_signed_on; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Possession taken on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="ra-agreement-expired" type="date" class="form-control form-input" name="raAgreementExpiredOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $ra_agreement_expired_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('ra-agreement-expired').defaultValue = '<?php echo $ra_agreement_expired_on; ?>'
                                </script>
                            </div>
                        </div>
                        <div class="form-group postpone-part">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Possession postpone on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="ra-agreement-signed" type="date" class="form-control form-input" name="raAgreementSignedOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $ra_agreement_signed_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('ra-agreement-signed').defaultValue = '<?php echo $ra_agreement_signed_on; ?>'
                                </script>
                            </div>
                        </div>
                        <div class="form-group postpone-part">
                            <div class="row">
                                <div class="col-md">
                                    <label for="exampleInputCity1">Postpone reason</label>
                                    <div class="input-group">
                                    <textarea class="form-control form-input" name="bankAddress" id="bank-address" cols="30" rows="10"><?php echo $bank_address; ?></textarea>
                                    </div>
                                    <div id="password-validate-response" class="form-input-response">
                                        <?php echo $bank_address_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Property on Auction</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="date-of-compromise" name="dateOfCompromise">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $date_of_compromise_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('date-of-compromise').defaultValue = '<?php echo $date_of_compromise; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Reserve Price</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="number" step=".01" class="form-control form-input" name="amountOfCompromise" placeholder="Amount" value="<?php echo $amount_of_compromise; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $amount_of_compromise_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">EMD Amount</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="number" step=".01" class="form-control form-input" name="amountOfCompromise" placeholder="Amount" value="<?php echo $amount_of_compromise; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $amount_of_compromise_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Property visit by prospective buyers on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="date-of-compromise" name="dateOfCompromise">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $date_of_compromise_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('date-of-compromise').defaultValue = '<?php echo $date_of_compromise; ?>'
                                </script>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Auction Date</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="date-of-compromise" name="dateOfCompromise">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $date_of_compromise_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('date-of-compromise').defaultValue = '<?php echo $date_of_compromise; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label class="exampleInputCity1">Auction Status</label>
                                    <div class="radio-inputs">
                                        <label>
                                            <input type="radio" name="compromise" value="1" <?php if($compromise == '1') echo 'checked'; ?>>
                                            <span>
                                                <i class="fa fa-check radio-check-icon"></i>
                                                Success
                                            </span>
                                        </label>
                                        <label>
                                        <input type="radio" name="compromise" value="0" <?php if($compromise == '0') echo 'checked'; ?>>
                                            <span>
                                                <i class="fa fa-close radio-cross-icon"></i>
                                                Fail
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Documents for redirection of order given to advocate on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="date-of-compromise" name="dateOfCompromise">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $date_of_compromise_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('date-of-compromise').defaultValue = '<?php echo $date_of_compromise; ?>'
                                </script>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Redirection order filled with DM/CMM on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="date-of-compromise" name="dateOfCompromise">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $date_of_compromise_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('date-of-compromise').defaultValue = '<?php echo $date_of_compromise; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Redirection order received on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="date-of-compromise" name="dateOfCompromise">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $date_of_compromise_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('date-of-compromise').defaultValue = '<?php echo $date_of_compromise; ?>'
                                </script>
                            </div>
                        </div>

                        <div class="mt-3 form-inline justify-content-end">
                            <button class="btn btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Add</button>
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