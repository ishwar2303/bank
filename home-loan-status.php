<?php 
    session_start();
    require_once('connection.php');
    require_once('middleware.php');

    if(!isset($_SESSION['user_role'])){ // all access
        $_SESSION['error_msg'] = 'Sign In to view that resource';
        header('Location: login.php');
        exit;
    }

    date_default_timezone_set("Asia/Kolkata");
    $epoch_time = time();
    $timestamp = date("y-m-d h:i:sa", $epoch_time);



    $db_error = '';
    if(isset($_GET['cid'])){
        $case_id = base64_decode(cleanInput($_GET['cid']));
        $sql = "SELECT home_loan_cid FROM home_loan WHERE home_loan_cid = '$case_id'";
        $result = $conn->query($sql);
        
        if($conn->error == ''){
            if($result->num_rows != 1){
                $_SESSION['error_msg'] = 'No status with the given case ID';
                header('Location: view-home-loans.php');
                exit;
            }
            else{
                $sql = "SELECT compromise, ots FROM home_loan WHERE home_loan_cid = '$case_id'";
                $result = $conn->query($sql);
                $home_loan = $result->fetch_assoc();
                $compromise = $home_loan['compromise'];
                $ots = $home_loan['ots'];
                $valid_case = true;
            }
        }
        else{
            $_SESSION['error_msg'] = 'Something went wrong!';
            $db_error = $conn->error;
            header('Location: view-home-loans.php');
        }
    }

    $date_of_next_hearing = '';
    $ra_agreement_expired_on = '';
    $date_of_redirection_by_advocate = '';
    $lease_on = '';
    $physical_possession_fixed_on = '';
    $possession_postpone_on = '';
    $postpone_reason = '';
    $date_of_compromise = '';
    $amount_of_compromise = '';
    $full_compromise_paid_upto = '';
    $date_of_ots_accepted = '';
    $ots_amount = '';
    $full_ots_paid_upto = '';
    $compromise_ots_failed_date = '';
    $compromise_ots_failed = '-1';
    $date_of_ra_bill = '';
    $amount_of_ra_bill = '';
    $ra_bill_forward_to_bank_on = '';
    $ra_bill_paid_on = '';
    $ra_bill_paid_amount = '';
    $reserve_price = '';
    $emd_amount = '';
    $property_visit_by_prospective_buyers_on = '';
    $auction_date = '';
    
    //errors
    $date_of_next_hearing_error = '';
    $ra_agreement_expired_on_error = '';
    $date_of_redirection_by_advocate_error = '';
    $lease_on_error = '';
    $physical_possession_fixed_on_error = '';
    $possession_postpone_on_error = '';
    $postpone_reason_error = '';
    $compromise_error = '';
    $date_of_compromise_error = '';
    $amount_of_compromise_error = '';
    $full_compromise_paid_upto_error = '';
    $ots_amount_error = '';
    $date_of_ots_accepted_error = '';
    $ots_amount_error = '';
    $full_ots_paid_upto_error = '';
    $compromise_ots_failed_date_error = '';
    $compromise_ots_failed_error = '';
    $date_of_ra_bill_error = '';
    $amount_of_ra_bill_error = '';
    $ra_bill_forward_to_bank_on_error = '';
    $ra_bill_paid_on_error = '';
    $ra_bill_paid_amount_error = '';
    $reserve_price_error = '';
    $emd_amount_error = '';
    $property_visit_by_prospective_buyers_on_error = '';
    $auction_date_error = '';

    if(isset($_POST['raAgreementExpiredOn']) && isset($_POST['dateOfRedirectionByAdvocate']) && isset($_POST['dateOfHearing']) && isset($_POST['leaseOn']) && isset($_POST['physicalPossessionFixedOn']) && isset($_POST['possessionPostponeOn']) && isset($_POST['postponeReason']) && isset($_POST['reservePrice']) && isset($_POST['emdAmount']) && isset($_POST['prospectiveBuyerOn']) && isset($_POST['auctionDate']) && isset($_POST['compromise']) && isset($_POST['dateOfCompromise']) && isset($_POST['amountOfCompromise']) && isset($_POST['fullCompromisePaidUpto']) && isset($_POST['ots']) && isset($_POST['dateOfOtsAccepted']) && isset($_POST['otsAmount']) && isset($_POST['fullOtsPaidUpto']) && isset($_POST['compromiseOtsFailedDate']) && isset($_POST['dateOfRaBill']) && isset($_POST['amountOfRaBill']) && isset($_POST['raBillForwardToBankOn']) && isset($_POST['raBillPaidOn']) && isset($_POST['raBillPaidAmount'])){
        // initialize variables with loan data
        $control = 1;
        $ra_agreement_expired_on = cleanInput($_POST['raAgreementExpiredOn']);
        $date_of_redirection_by_advocate = cleanInput($_POST['dateOfRedirectionByAdvocate']);
        $date_of_next_hearing = cleanInput($_POST['dateOfHearing']);
        $lease_on = cleanInput($_POST['leaseOn']);
        $physical_possession_fixed_on = cleanInput($_POST['physicalPossessionFixedOn']);
        $possession_postpone_on = cleanInput($_POST['possessionPostponeOn']);
        $postpone_reason = cleanInput($_POST['postponeReason']);
        $reserve_price = cleanInput($_POST['reservePrice']);
        $emd_amount = cleanInput($_POST['emdAmount']);
        $property_visit_by_prospective_buyers_on = cleanInput($_POST['prospectiveBuyerOn']);
        $auction_date = cleanInput($_POST['auctionDate']);
        $compromise = cleanInput($_POST['compromise']);
        $date_of_compromise = cleanInput($_POST['dateOfCompromise']);
        $amount_of_compromise = cleanInput($_POST['amountOfCompromise']);
        $full_compromise_paid_upto = cleanInput($_POST['fullCompromisePaidUpto']);
        $ots = cleanInput($_POST['ots']);
        $date_of_ots_accepted = cleanInput($_POST['dateOfOtsAccepted']);
        $ots_amount = cleanInput($_POST['otsAmount']);
        $full_ots_paid_upto = cleanInput($_POST['fullOtsPaidUpto']);
        $compromise_ots_failed_date = cleanInput($_POST['compromiseOtsFailedDate']);
        $date_of_ra_bill = cleanInput($_POST['dateOfRaBill']);
        $amount_of_ra_bill = cleanInput($_POST['amountOfRaBill']);
        $ra_bill_forward_to_bank_on = cleanInput($_POST['raBillForwardToBankOn']);
        $ra_bill_paid_on = cleanInput($_POST['raBillPaidOn']);
        $ra_bill_paid_amount = cleanInput($_POST['raBillPaidAmount']);
        if(isset($_POST['compromiseOtsFailed'])){
            $compromise_ots_failed = cleanInput($_POST['compromiseOtsFailed']);
        }
        else{
            $compromise_ots_failed = '-1';
        }
        // compromise
        if($compromise == '1'){
            if(!empty($date_of_compromise)){
                if(!dateValidation($date_of_compromise)){
                    $date_of_compromise_error = 'Invalid Date';
                    $control = 0;
                }
            }

            if($amount_of_compromise != ''){
                if(!amountValidation($amount_of_compromise)){
                    $amount_of_compromise_error = 'Invalid Amount';
                    $control = 0;
                }
            }
            else{
                $amount_of_compromise_error = 'Required';
                $control = 0;
            }

            if($full_compromise_paid_upto != ''){
                if(!dateValidation($full_compromise_paid_upto)){
                    $full_compromise_paid_upto_error = 'Invalid Amount';
                    $control = 0;
                }
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

            if($ots_amount != ''){
                if(!amountValidation($ots_amount)){
                    $ots_amount_error = 'Invalid Amount';
                    $control = 0;
                }
            }
            else{
                $ots_amount_error = 'Required';
                $control = 0;
            }

            if($full_ots_paid_upto != ''){
                if(!amountValidation($full_ots_paid_upto)){
                    $full_ots_paid_upto_error = 'Invalid Amount';
                    $control = 0;
                }
            }
        }
        if($control){ // Insert data into database control = 1
            $postpone_reason = str_replace("\n", "<br/>", $postpone_reason);
            $sql = "INSERT INTO `home_loan_status` (`status_id`, `case_id`, `ra_agreement_expired_on`, `date_of_next_hearing`, `date_of_redirection_by_advocate`, `lease_on`, `physical_possession_fixed_on`, `compromise`, `date_of_compromise`, `amount_of_compromise`, `full_compromise_paid_upto`, `ots`,  `date_of_ots_accepted`, `amount_of_ots`, `amount_of_ots_paid_upto`, `date_of_ra_bill`, `amount_of_ra_bill`, `ra_bill_forward_to_bank_on`, `ra_bill_paid_on`, `ra_bill_paid_amount`, `possession_postpone_on`, `possession_postpone_reason`, `reserve_price`, `emd_amount`, `property_visit_by_prospective_buyers_on`, `auction_date`, `compromise_ots_failed_date`, `compromise_ots_failed`) VALUES (NULL, '$case_id', '$ra_agreement_expired_on', '$date_of_next_hearing', '$date_of_redirection_by_advocate', '$lease_on', '$physical_possession_fixed_on', '$compromise', '$date_of_compromise', '$amount_of_compromise', '$full_compromise_paid_upto', '$ots', '$date_of_ots_accepted', '$ots_amount', '$full_ots_paid_upto', '$date_of_ra_bill', '$amount_of_ra_bill', '$ra_bill_forward_to_bank_on', '$ra_bill_paid_on', '$ra_bill_paid_amount', '$possession_postpone_on', '$postpone_reason', '$reserve_price', '$emd_amount', '$property_visit_by_prospective_buyers_on', '$auction_date', '$compromise_ots_failed_date', '$compromise_ots_failed')";
            
            if($conn->query($sql) === TRUE){ 
                $sql = "INSERT INTO `user_activity` (`activity_id`, `loan`, `case_id`, `user_id`, `operation_id`, `timestamp`) VALUES (NULL, '1', '$case_id', '$_SESSION[user_id]', '3', '$timestamp')";
                $conn->query($sql);
                $_SESSION['success_msg'] = 'Status added successfully';
                header('Location: view-home-loans.php');
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
    <?php require 'includes/layout.php'; ?>
    <script src="assets/js/home-loan.js"></script>
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

                
                    <!-- Flash Message  -->
                    <?php require 'includes/flash-message.php'; ?>


                    <!-- Home loan form -->
                    <form class="pt-3" method="POST">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Revised RA Agreement Expired on , if applicable</label>
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
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Date of next hearing  if applicable</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="date-of-hearing" name="dateOfHearing">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $date_of_next_hearing_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('date-of-hearing').defaultValue = '<?php echo $date_of_next_hearing; ?>'
                                </script>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Date Of Redirection by advocate</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="date-of-redirection-by-advocate" name="dateOfRedirectionByAdvocate">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $date_of_redirection_by_advocate_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('date-of-redirection-by-advocate').defaultValue = '<?php echo $date_of_redirection_by_advocate; ?>'
                                </script>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Lease with Court Receiver/Tehsildar/SSP on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="lease-on" type="date" class="form-control form-input" name="leaseOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $lease_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('lease-on').defaultValue = '<?php echo $lease_on; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Date of  Physical Possession  fixed on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="physical-possession-fixed-on" type="date" class="form-control form-input" name="physicalPossessionFixedOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $physical_possession_fixed_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('physical-possession-fixed-on').defaultValue = '<?php echo $physical_possession_fixed_on; ?>'
                                </script>
                            </div>
                        </div>
                        <h4 class="form-part-heading mb-3">If possession pospone on or before of possession </h4>
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
                                    <input id="possession-postpone-on" type="date" class="form-control form-input" name="possessionPostponeOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $possession_postpone_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('possession-postpone-on').defaultValue = '<?php echo $possession_postpone_on; ?>'
                                </script>
                            </div>
                        </div>
                        <div class="form-group postpone-part">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Postpone reason</label>
                                    <div class="input-group">
                                    <textarea class="form-control form-input" name="postponeReason" cols="30" rows="5"><?php echo $postpone_reason; ?></textarea>
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $postpone_reason_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="form-part-heading mb-3">Bank put the property on E-auction : </h4>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Reserve Price</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step=".000001" class="form-control form-input" name="reservePrice" placeholder="Amount" value="<?php echo $reserve_price; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $reserve_price_error; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">EMD Amount</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step=".000001" class="form-control form-input" name="emdAmount" placeholder="Amount" value="<?php echo $emd_amount; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $emd_amount_error; ?>
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
                                    <input type="date" class="form-control form-input" id="prospective-buyer-on" name="prospectiveBuyerOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $property_visit_by_prospective_buyers_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('prospective-buyer-on').defaultValue = '<?php echo $property_visit_by_prospective_buyers_on; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Auction Date</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="auction-date" name="auctionDate">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $auction_date_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('auction-date').defaultValue = '<?php echo $auction_date; ?>'
                                </script>
                            </div>
                        </div>
                        
                        <!-- if compromise -->
                        
                        <h4 class="form-part-heading mb-3">If Compromise</h4>
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
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step=".000001" class="form-control form-input" name="amountOfCompromise" placeholder="Amount" value="<?php echo $amount_of_compromise; ?>">
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
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step=".000001" class="form-control form-input" name="fullCompromisePaidUpto" placeholder="Amount" value="<?php echo $full_compromise_paid_upto; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $full_compromise_paid_upto_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- if OTS -->

                        <h4 class="form-part-heading mb-3">If OTS</h4>
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
                                    <label for="exampleInputCity1">Amount of OTS</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step=".000001" class="form-control form-input" name="otsAmount" placeholder="Amount" value="<?php echo $ots_amount; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $ots_amount_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ots-part">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Full amount of OTS paid upto</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step=".000001" class="form-control form-input" name="fullOtsPaidUpto" placeholder="Amount" value="<?php echo $full_ots_paid_upto; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $full_ots_paid_upto_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="form-part-heading mb-3">Compromise/OTS - failed </h4>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Compromise/OTS failed Date</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="compromise-ots-failed-date" name="compromiseOtsFailedDate">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $compromise_ots_failed_date_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('compromise-ots-failed-date').defaultValue = '<?php echo $compromise_ots_failed_date; ?>'
                                </script>
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
                                        <label>
                                        <input type="radio" name="compromiseOtsFailed" value="-1" <?php if($compromise_ots_failed == '-1') echo 'checked'; ?>>
                                            <span>
                                                None
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
                                    <input type="number" step=".000001" class="form-control form-input" name="amountOfRaBill" placeholder="Amount" value="<?php echo $amount_of_ra_bill; ?>">
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
                                    <input type="number" step="0.000001" class="form-control form-input" name="raBillPaidAmount" placeholder="Amount" value="<?php echo $ra_bill_paid_amount; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $ra_bill_paid_amount_error; ?>
                                    </div>
                                </div>
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