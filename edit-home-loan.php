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

    $db_error = '';
    $sql = "SELECT * FROM bank ORDER BY bank_name ASC";
    $bank_list = $conn->query($sql);

    if($conn->error != ''){
        $_SESSION['error_msg'] = 'Something went wrong!';
        $db_error = $conn->error;
    }

    require_once('middleware.php');

    $db_error = '';
    if(isset($_GET['cid'])){
        $home_loan_cid = base64_decode($_GET['cid']);
        $sql = "SELECT * FROM home_loan WHERE home_loan_cid = '$home_loan_cid'";
        $result = $conn->query($sql);

        if($conn->error == ''){
            if($result->num_rows == 1){
                $home_loan = $result->fetch_assoc();

                $case_date = $home_loan['case_date'];
                $npa_case = $home_loan['npa_case'];
                $bank_name = $home_loan['bank_name'];
                $bank_contact_person_name = $home_loan['bank_contact_person_name'];
                $bank_contact_person_number = $home_loan['bank_contact_person_number'];
                $bank_contact_person_designation = $home_loan['bank_contact_person_designation'];
                $bank_address = $home_loan['bank_address'];
                $bank_contact_person_email = $home_loan['bank_contact_person_email'];
                $borrower_name = $home_loan['borrower_name'];
                $amount = $home_loan['amount'];
                $outstanding_on = $home_loan['outstanding_on'];
                $ra_agreement_signed_on = $home_loan['ra_agreement_signed_on'];
                $ra_agreement_expired_on = $home_loan['ra_agreement_expired_on'];
                $date_of_notice13_2 = $home_loan['date_of_notice13_2'];
                $date_of_notice13_3 = $home_loan['date_of_notice13_3'];
                $primary_security = $home_loan['primary_security'];
                $collateral_security = $home_loan['collateral_security'];
                $total_security = $home_loan['total_security'];
                $date_of_symbolic_possession = $home_loan['date_of_symbolic_possession'];
                $publication_hindu_newspaper = $home_loan['publication_hindi_newspaper_on'];
                $publication_english_newspapaer = $home_loan['publication_english_newspaper_on'];
                $requested_bank_for_documentation_on = $home_loan['requested_bank_for_documents'];
                $documents_received_on = $home_loan['documents_received_on'];
                $documents_given_to_advocate_on = $home_loan['documents_given_to_advocate_on'];
                $application_file_dm_cmm_advocate_on = $home_loan['application_file_dm_cmm_by_advocate_on'];
                $date_of_hearing = $home_loan['date_of_hearing'];
                $compromise = $home_loan['compromise'];
                $date_of_compromise = $home_loan['date_of_compromise'];
                $amount_of_compromise = $home_loan['amount_of_compromise'];
                $full_compromise_paid_upto = $home_loan['full_compromise_paid_upto'];
                $ots = $home_loan['ots'];
                $date_of_ots_accepted = $home_loan['date_of_ots_accepted'];
                $full_ots_paid_upto = $home_loan['amount_of_ots_paid_upto'];
                $compromise_ots_failed = $home_loan['compromise_ots_failed'];
                $property_sold_on = $home_loan['property_sold_on'];
                $property_sold_for = $home_loan['property_sold_for'];
                $full_amount_of_compromise_received_on = $home_loan['full_amount_compromise_received_on'];
                $full_amount_of_ots_received_on = $home_loan['full_amount_ots_received_on'];
                $date_of_ra_bill = $home_loan['date_of_ra_bill'];
                $amount_of_ra_bill = $home_loan['amount_of_ra_bill'];
                $ra_bill_forward_to_bank_on = $home_loan['ra_bill_forward_to_bank_on'];
                $ra_bill_paid_on = $home_loan['ra_bill_paid_on'];
                $ra_bill_paid_amount = $home_loan['ra_bill_paid_amount'];
                $total_amount_of_expenses_incurred = $home_loan['total_amount_of_expenses_incurred'];
                $income_case_wise_profit_loss = $home_loan['income_case_wise_profit_loss'];
                
            }
            else{
                $_SESSION['error_msg'] = 'No loan exist with the give case ID';
                $db_error = 'No loan exist with the give case ID';
                header('Location: view-car-loans.php');
                exit;
            }
        }
        else{
            $_SESSION['error_msg'] = 'Something went wrong!';
            $db_error = $conn->error;
            header('Location: view-car-loans.php');
            exit;
        }
    }

    //errors
    $case_date_error = '';
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

    if(isset($_POST['caseDate']) && isset($_POST['npaCase']) && isset($_POST['bankName']) && isset($_POST['bankContactPersonName']) && isset($_POST['bankContactPersonDesignation']) && isset($_POST['bankContactPersonNumber']) && isset($_POST['bankContactPersonEmail']) && isset($_POST['bankAddress']) && isset($_POST['borrowerName']) && isset($_POST['amount']) && isset($_POST['outstandingOn']) && isset($_POST['raAgreementSignedOn']) && isset($_POST['raAgreementExpiredOn']) && isset($_POST['dateOfNotice132']) && isset($_POST['dateOfNotice133']) && isset($_POST['primarySecurity']) && isset($_POST['collateralSecurity']) && isset($_POST['totalSecurity']) && isset($_POST['dateOfSymbolicPossession']) && isset($_POST['publicationHindiNewspaperOn']) && isset($_POST['publicationEnglishNewspaperOn']) && isset($_POST['requestedBankForDocumentsOn']) && isset($_POST['documentsReceivedOn']) && isset($_POST['documentsGivenToAdvocate']) && isset($_POST['applicationFileDmCmmByAdvocateOn']) && isset($_POST['dateOfHearing']) && isset($_POST['compromise']) && isset($_POST['dateOfCompromise']) && isset($_POST['amountOfCompromise']) && isset($_POST['fullCompromisePaidUpto']) && isset($_POST['ots']) && isset($_POST['dateOfOtsAccepted']) && isset($_POST['fullOtsPaidUpto']) && isset($_POST['propertySoldOn']) && isset($_POST['propertySoldFor']) && isset($_POST['fullAmountCompromiseReceivedOn']) && isset($_POST['fullAmountOtsReceivedOn']) && isset($_POST['dateOfRaBill']) && isset($_POST['amountOfRaBill']) && isset($_POST['raBillForwardToBankOn']) && isset($_POST['raBillPaidOn']) && isset($_POST['raBillPaidAmount']) && isset($_POST['totalAmountOfExpensesIncurred']) && isset($_POST['incomeCaseWiseProfitLoss'])){
        // initialize variables with loan data
        $control = 1;

        $case_date = cleanInput($_POST['caseDate']);
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


        if(!empty($case_date)){
            if(!dateValidation($case_date)){
                $case_date_error = 'Invalid Date';
                $control = 0;
            }
        }
        else{
            $case_date_error = 'Required';
            $control = 0;
        }
        
        if($npa_case != '1' && $npa_case != '2' && $npa_case != '3'){
            $npa_case_error = 'Required';
            $control = 0;
        }
        else{
            if($npa_case == '1'){
                $npa_case_value = 'Upto Rs 20 Lac';
            }
            
            if($npa_case == '2')
                $npa_case_value = 'From Rs. 20 Lac + to Rs. 10 Crore';

            if($npa_case == '3')
                $npa_case_value = 'Over 10 Crore';
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
            $sql = "UPDATE home_loan SET case_date = '$case_date', npa_case = '$npa_case', bank_name = '$bank_name', bank_contact_person_name = '$bank_contact_person_name', bank_contact_person_number = '$bank_contact_person_number', bank_contact_person_designation = '$bank_contact_person_designation', bank_address = '$bank_address', bank_contact_person_email = '$bank_contact_person_email', borrower_name = '$borrower_name', amount = '$amount', outstanding_on = '$outstanding_on', ra_agreement_signed_on = '$ra_agreement_signed_on', ra_agreement_expired_on = '$ra_agreement_expired_on', date_of_notice13_2 = '$date_of_notice13_2', date_of_notice13_3 = '$date_of_notice13_3', primary_security = '$primary_security', collateral_security = '$collateral_security', total_security = '$total_security', date_of_symbolic_possession = '$date_of_symbolic_possession', publication_hindi_newspaper_on = '$publication_hindu_newspaper', publication_english_newspaper_on = '$publication_english_newspapaer', requested_bank_for_documents = '$requested_bank_for_documentation_on', documents_received_on = '$documents_received_on', documents_given_to_advocate_on = '$documents_given_to_advocate_on', application_file_dm_cmm_by_advocate_on = '$application_file_dm_cmm_advocate_on', date_of_hearing = '$date_of_hearing', compromise = '$compromise', date_of_compromise = '$date_of_compromise', amount_of_compromise = '$amount_of_compromise', full_compromise_paid_upto = '$full_compromise_paid_upto', ots = '$ots', date_of_ots_accepted = '$date_of_ots_accepted', amount_of_ots_paid_upto = '$full_ots_paid_upto', compromise_ots_failed = '$compromise_ots_failed', property_sold_on = '$property_sold_on', property_sold_for = '$property_sold_for', full_amount_compromise_received_on = '$full_amount_of_compromise_received_on', full_amount_ots_received_on = '$full_amount_of_ots_received_on', date_of_ra_bill = '$date_of_ra_bill', amount_of_ra_bill = '$amount_of_ra_bill', ra_bill_forward_to_bank_on = '$ra_bill_forward_to_bank_on', ra_bill_paid_on = '$ra_bill_paid_on', ra_bill_paid_amount = '$ra_bill_paid_amount', total_amount_of_expenses_incurred = '$total_amount_of_expenses_incurred', income_case_wise_profit_loss = '$income_case_wise_profit_loss' WHERE home_loan_cid = '$home_loan_cid'";
            $conn->query($sql); 
            
            if($conn->error == ''){ 
                $_SESSION['success_msg'] = 'Updated successfully';
                header('Location: view-home-loans.php');
                exit;   
            }   
            else{
                $_SESSION['error_msg'] = 'Something went wrong!';
                header('Location: view-home-loans.php');
                exit;   
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
                    <h4 class="card-title">Home Loan <?php echo $npa_case; ?></h4>
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
                                    <label for="exampleInputCity1">Case Date</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="case-date" type="date" class="form-control form-input" name="caseDate" placeholder="Password" value="<?php  ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $case_date_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('case-date').defaultValue = '<?php echo $case_date; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">NPA Cases</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-university"></i>
                                        </span>
                                    </div>
                                    <select class="form-control form-input" name="npaCase" >
                                        <option >Choose</option>
                                        <option value="1" <?php if($npa_case == '1') echo 'Selected'; ?>>New NPA Cases upto Rs 20 Lac</option>
                                        <option value="2" <?php if($npa_case == '2') echo 'Selected'; ?>>New NPA Cases From Rs. 20 Lac + to Rs. 10 Crore</option>
                                        <option value="3" <?php if($npa_case == '3') echo 'Selected'; ?>>New NPA Cases Over 10 Crore</option>
                                    </select>
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $npa_case_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Bank-list -->
                        <?php if($bank_list->num_rows > 0){ ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Select from listed Banks</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-university"></i>
                                        </span>
                                    </div>
                                    <select id="bank-list" class="form-control form-input">
                                        <option value="-1" selected>Choose</option>
                                        <?php 
                                            while($bank = $bank_list->fetch_assoc()){
                                                ?>
                                                <option value="<?php echo base64_encode($bank['bank_id']); ?>"><?php echo $bank['bank_name']; ?>&nbsp;(<?php echo $bank['bank_branch']; ?>)&nbsp;[<?php echo $bank['bank_contact_person_name']; ?>]</option>
                                                <?php 
                                            }
                                        ?>
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <script>
                            $(document).ready(() => {
                                $('#bank-list').on('change', () => {
                                    bank_id = $('#bank-list').val()
                                    if(bank_id != '-1'){
                                        let url = 'retrieve-bank-information.php'
                                        let reqData = {
                                            bank_id
                                        }
                                        $.ajax({
                                            url,
                                            type : 'POST',
                                            dataType : 'html',
                                            success : (msg) => {
                                            },
                                            complete : (res) => {
                                                setDetailsInHomeLoanForm(res.responseText)
                                            },
                                            data : reqData
                                        })
                                    }
                                })

                                function setDetailsInHomeLoanForm(resData){
                                
                                    resData = JSON.parse(resData)
                                    if(resData.success){
                                        let bankName = resData.bank.bank_name
                                        let branchName = resData.bank.branch_name
                                        let bankAddress = resData.bank.bank_address
                                        let personName = resData.bank.bank_contact_person_name
                                        let personNumber = resData.bank.bank_contact_person_number
                                        document.getElementById('bank-name').value = bankName
                                        document.getElementById('bank-address').value = bankAddress.replace(/<br\/>/g, "\n").trim()
                                        document.getElementById('bank-person-name').value = personName
                                        document.getElementById('bank-person-number').value = personNumber
                                    }
                                    if(resData.error){
                                        alert(`Error : ${resData.error}`)
                                    }

                                }
                            })
                        </script>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Bank Name</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-university"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-input" id="bank-name" name="bankName" placeholder="Name" value="<?php echo $bank_name; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $bank_name_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Bank Contact Person Name</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-input" id="bank-person-name" name="bankContactPersonName" placeholder="Name" value="<?php echo $bank_contact_person_name; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $bank_contact_person_name_error; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Bank Contact Person Designation</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-dot-circle"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-input" id="" name="bankContactPersonDesignation" placeholder="Designation" value="<?php echo $bank_contact_person_designation; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $bank_contact_person_designation_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Bank Contact Person Number</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-phone-alt"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control form-input" id="bank-person-number" name="bankContactPersonNumber" placeholder="Number" value="<?php echo $bank_contact_person_number; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $bank_contact_person_number_error; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Bank Contact Person E-mail</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input  type="email" name="bankContactPersonEmail" value="<?php echo $bank_contact_person_email; ?>" placeholder="E-mail" class="form-control form-input">
                                    </div>   
                                    <div class="form-input-response">
                                        <?php echo $bank_contact_person_email_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md">
                                    <label for="exampleInputCity1">Bank Address</label>
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
                                    <label for="exampleInputCity1">Borrower Name</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input type="text"  class="form-control form-input" id="" name="borrowerName" placeholder="Name" value="<?php echo $borrower_name; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $borrower_name_error; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Amount</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="text" step="0.01" class="form-control form-input"  name="amount" placeholder="Number" value="<?php echo $amount; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $amount_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Outstanding on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="outstanding-on" type="date" class="form-control form-input" id="" name="outstandingOn" placeholder="Password" value="<?php  ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $outstanding_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('outstanding-on').defaultValue = '<?php echo $outstanding_on; ?>'
                                </script>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">RA agreement signed on</label>
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
                                    <label for="exampleInputCity1">RA agreement expired on</label>
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
                                    <label for="exampleInputCity1">Date of Notice 13(2)</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="date-of-notice13-2" name="dateOfNotice132">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $date_of_notice13_2_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('date-of-notice13-2').defaultValue = '<?php echo $date_of_notice13_2; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Date of Notice 13(3) If applicable</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="date-of-notice13-3" name="dateOfNotice133">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $date_of_notice13_3_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('date-of-notice13-3').defaultValue = '<?php echo $date_of_notice13_3; ?>'
                                </script>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md">
                                    <label for="exampleInputCity1">Primary Security</label>
                                    <div class="input-group">
                                    <textarea class="form-control form-input" name="primarySecurity" id="" cols="30" rows="10"><?php echo $primary_security; ?></textarea>
                                    </div>
                                    <div id="password-validate-response" class="form-input-response">
                                        <?php echo $primary_security_error; ?>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <label for="exampleInputCity1">Collateral Security</label>
                                    <div class="input-group">
                                    <textarea class="form-control form-input" name="collateralSecurity" id="" cols="30" rows="10"><?php echo $collateral_security; ?></textarea>
                                    </div>
                                    <div id="password-validate-response" class="form-input-response">
                                        <?php echo $collateral_security_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md">
                                    <label for="exampleInputCity1">Total Security</label>
                                    <div class="input-group">
                                    <textarea class="form-control form-input" name="totalSecurity" id="" cols="30" rows="10"><?php echo $total_security; ?></textarea>
                                    </div>
                                    <div id="password-validate-response" class="form-input-response">
                                        <?php echo $total_security_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Date of symbolic possession</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="symbolic-possession-date" name="dateOfSymbolicPossession">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $date_of_symbolic_possession_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('symbolic-possession-date').defaultValue = '<?php echo $date_of_symbolic_possession; ?>'
                                </script>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Publication in Hindi Newspaper on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="hindi-newspaper" name="publicationHindiNewspaperOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $publication_hindu_newspaper_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('hindi-newspaper').defaultValue = '<?php echo $publication_hindu_newspaper; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Publication in English Newspaper on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="english-newspaper" name="publicationEnglishNewspaperOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $publication_english_newspapaer_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('english-newspaper').defaultValue = '<?php echo $publication_english_newspapaer; ?>'
                                </script>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Requested Bank for Documents on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="requested-documents-on" name="requestedBankForDocumentsOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $requested_bank_for_documentation_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('requested-documents-on').defaultValue = '<?php echo $requested_bank_for_documentation_on; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Documents Received on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="documents-received-on" name="documentsReceivedOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $documents_received_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('documents-received-on').defaultValue = '<?php echo $documents_received_on; ?>'
                                </script>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Documents given to Advocate on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="documents-to-advocate" name="documentsGivenToAdvocate">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $documents_given_to_advocate_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('documents-to-advocate').defaultValue = '<?php echo $documents_given_to_advocate_on; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Application file DM/CMM by Advocate on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="application-dm-cmm" name="applicationFileDmCmmByAdvocateOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $application_file_dm_cmm_advocate_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('application-dm-cmm').defaultValue = '<?php echo $application_file_dm_cmm_advocate_on; ?>'
                                </script>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Date Of hearing</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="date-of-hearing" name="dateOfHearing">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $date_of_hearing_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('date-of-hearing').defaultValue = '<?php echo $date_of_hearing; ?>'
                                </script>
                            </div>
                        </div>
                        <!-- if compromise -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="exampleInputCity1">Compromise</label>
                                    <div class="radio-inputs">
                                        <label>
                                            <input type="radio" name="compromise" value="1" <?php if($compromise == '1') echo 'checked'; ?>>
                                            <span>
                                                <i class="fa fa-check radio-check-icon"></i>
                                                Yes
                                            </span>
                                        </label>
                                        <label>
                                        <input type="radio" name="compromise" value="0" <?php if($compromise == '0') echo 'checked'; ?>>
                                            <span>
                                                <i class="fa fa-close radio-cross-icon"></i>
                                                No
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group compromise-part">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Date of Compromise</label>
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
                                    <label for="exampleInputCity1">Amount of compromise</label>
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
                        <div class="form-group compromise-part">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Full Compromise paid upto</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="number" step=".01" class="form-control form-input" name="fullCompromisePaidUpto" placeholder="Amount" value="<?php echo $full_compromise_paid_upto; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $full_compromise_paid_upto_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- if OTS -->

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="exampleInputCity1">OTS</label>
                                    <div class="radio-inputs">
                                        <label>
                                            <input type="radio" name="ots" value="1" <?php if($ots == '1') echo 'checked'; ?>>
                                            <span>
                                                <i class="fa fa-check radio-check-icon"></i>
                                                Yes
                                            </span>
                                        </label>
                                        <label>
                                        <input type="radio" name="ots" value="0" <?php if($ots == '0') echo 'checked'; ?>>
                                            <span>
                                                <i class="fa fa-close radio-cross-icon"></i>
                                                No
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ots-part">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Date of OTS accepted</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="date-of-ots-accepted" name="dateOfOtsAccepted">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $date_of_ots_accepted_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('date-of-ots-accepted').defaultValue = '<?php echo $date_of_ots_accepted; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Full amount of OTS paid upto</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="number" step=".01" class="form-control form-input" name="fullOtsPaidUpto" placeholder="Amount" value="<?php echo $full_ots_paid_upto; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $full_ots_paid_upto_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ots-part">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Compromise OTS Failed</label>
                                    <div class="radio-inputs">
                                        <label>
                                            <input type="radio" name="compromiseOtsFailed" value="1" <?php if($compromise_ots_failed == '1') echo 'checked'; ?>>
                                            <span>
                                                <i class="fa fa-check radio-check-icon"></i>
                                                Yes
                                            </span>
                                        </label>
                                        <label>
                                        <input type="radio" name="compromiseOtsFailed" value="0" <?php if($compromise_ots_failed == '0') echo 'checked'; ?>>
                                            <span>
                                                <i class="fa fa-close radio-cross-icon"></i>
                                                No
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $compromise_ots_failed_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Property Sold On</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="property-sold-on" name="propertySoldOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $property_sold_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('property-sold-on').defaultValue = '<?php echo $property_sold_on; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Property Sold for</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step=".01" class="form-control form-input" name="propertySoldFor" placeholder="Amount" value="<?php echo $property_sold_for; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $property_sold_for_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Full amount of compromise received on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="full-amount-of-compromise-received-on" name="fullAmountCompromiseReceivedOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $full_amount_of_compromise_received_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('full-amount-of-compromise-received-on').defaultValue = '<?php echo $full_amount_of_compromise_received_on; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Full amount of ots received on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="full-amount-of-ots-received-on" name="fullAmountOtsReceivedOn" >
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $full_amount_of_ots_received_on_error; ?>
                                    </div>
                                </div>
                            </div>
                            <script>
                                document.getElementById('full-amount-of-ots-received-on').defaultValue = '<?php echo $full_amount_of_ots_received_on; ?>'
                            </script>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Date Of RA Bill</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="date-of-ra-bill" name="dateOfRaBill">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $date_of_ra_bill_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('date-of-ra-bill').defaultValue = '<?php echo $date_of_ra_bill; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Amount of RA Bill</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step=".01" class="form-control form-input" name="amountOfRaBill" placeholder="Amount" value="<?php echo $amount_of_ra_bill; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $amount_of_ra_bill_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">RA Bill forward to Bank on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="ra-bill-forward-to-bank-on" name="raBillForwardToBankOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $ra_bill_forward_to_bank_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('ra-bill-forward-to-bank-on').defaultValue = '<?php echo $ra_bill_forward_to_bank_on; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">RA Bill paid on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="ra-bill-paid-on" name="raBillPaidOn" >
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $ra_bill_paid_on_error; ?>
                                    </div>
                                </div>
                            </div>
                            <script>
                                document.getElementById('ra-bill-paid-on').defaultValue = '<?php echo $ra_bill_paid_on; ?>'
                            </script>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">RA Bill paid amount</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step="0.01" class="form-control form-input" name="raBillPaidAmount" placeholder="Amount" value="<?php echo $ra_bill_paid_amount; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $ra_bill_paid_amount_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Total amount of expenses incurred</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step="0.01" class="form-control form-input" name="totalAmountOfExpensesIncurred" placeholder="Amount" value="<?php echo $total_amount_of_expenses_incurred; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $total_amount_of_expenses_incurred_error; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Income case wise profit/loss</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step="0.01" class="form-control form-input" name="incomeCaseWiseProfitLoss" value="<?php echo $income_case_wise_profit_loss; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $income_case_wise_profit_loss_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 form-inline justify-content-end">
                            <button class="btn btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Update</button>
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

<script>
    compromise = document.getElementsByName('compromise')
    for(i = 0; i<compromise.length; i++){
        compromise[i].addEventListener('click', compromiseFields)
    }
</script>
<?php if($compromise != ''){?>
    <script>compromiseFields()</script>
<?php } ?>


<script>
    ots = document.getElementsByName('ots')
    for(i = 0; i<ots.length; i++){
        ots[i].addEventListener('click', otsFields)
    }
</script>
<?php if($ots != ''){?>
    <script>otsFields()</script>
<?php } ?>