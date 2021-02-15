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
    if(isset($_GET['cl_cid'])){
        $case_id = base64_decode(cleanInput($_GET['cl_cid']));
        $sql = "SELECT car_loan_cid FROM car_loan WHERE car_loan_cid = '$case_id'";
        $result = $conn->query($sql);
        
        if($conn->error == ''){
            if($result->num_rows != 1){
                $_SESSION['error_msg'] = 'No status with the given case ID';
                header('Location: view-home-loans.php');
                exit;
            }
        }
        else{
            $_SESSION['error_msg'] = 'Something went wrong!';
            $db_error = $conn->error;
            header('Location: view-car-loans.php');
        }
    }

    $amount_recovered = '';
    $bill_raised = '';
    $payment_received = '';
    $payment_received_on = '';
    $auction_date = '';
    $auction_amount = '';
    $recovery_date = '';
    $full_amount = '';
    $part_amount = '';
    $regularise_date = '';
    $full_payment_paid_on = '';
    // errors
    $amount_recovered_error = '';
    $bill_raised_error = '';
    $payment_received_error = '';
    $payment_received_on_error = '';
    $auction_date_error = '';
    $auction_amount_error = '';
    $recovery_date_error = '';
    $full_amount_error = '';
    $part_amount_error = '';
    $regularise_date_error = '';
    $full_payment_paid_on_error = '';

    if(isset($_POST['billRaised']) && isset($_POST['paymentReceived']) && isset($_POST['paymentReceivedOn']) && isset($_POST['auctionDate']) && isset($_POST['auctionAmount']) && isset($_POST['recoveryDate']) && isset($_POST['fullAmount']) && isset($_POST['partAmount']) && isset($_POST['regulariseDate'])){
        $control = 1;
        //$amount_recovered = cleanInput($_POST['amountRecovered']);
        $bill_raised = cleanInput($_POST['billRaised']);
        $payment_received_on = cleanInput($_POST['paymentReceivedOn']);
        $payment_received = cleanInput($_POST['paymentReceived']);
        $auction_date = cleanInput($_POST['auctionDate']);
        $auction_amount = cleanInput($_POST['auctionAmount']);
        $recovery_date = cleanInput($_POST['recoveryDate']);
        $full_amount = cleanInput($_POST['fullAmount']);
        $part_amount = cleanInput($_POST['partAmount']);
        $regularise_date = cleanInput($_POST['regulariseDate']);
        $full_payment_paid_on = cleanInput($_POST['fullPaymentPaidOn']);

        if($amount_recovered != ''){
            if(!amountValidation($amount_recovered)){
                $amount_recovered_error = 'Invalid amount';
                $control = 0;
            }
        }
        // else{
        //     $amount_recovered_error = 'Required';
        //     $control = 0;
        // }

        if($bill_raised != ''){
            if(!amountValidation($bill_raised)){
                $bill_raised_error = 'Invalid amount';
                $control = 0;
            }
        }
        // else{
        //     $bill_raised_error = 'Required';
        //     $control = 0;
        // }

        if($payment_received != ''){
            if(!amountValidation($payment_received)){
                $payment_received_error = 'Invalid amount';
                $control = 0;
            }
        }
        // else{
        //     $payment_received_error = 'Required';
        //     $control = 0;
        // }
        
        if($control){ // Insert data into database control = 1
            $postpone_reason = str_replace("\n", "<br/>", $postpone_reason);
            $sql = "INSERT INTO `car_loan_status` (`status_id`, `case_id`, `auction_date`, `auction_amount`, `recovery_date`, `full_amount`, `part_amount`, `bill_raised`, `payment_received_on`, `payment_received`, `regularise_date`, `full_payment_paid_on`) VALUES (NULL, '$case_id', '$auction_date', '$auction_amount', '$recovery_date', '$full_amount', '$part_amount', '$bill_raised', '$payment_received_on', '$payment_received', '$regularise_date', '$full_payment_paid_on')";
            
            if($conn->query($sql) === TRUE){ 
                $sql = "INSERT INTO `user_activity` (`activity_id`, `loan`, `case_id`, `user_id`, `operation_id`, `timestamp`) VALUES (NULL, '2', '$case_id', '$_SESSION[user_id]', '3', '$timestamp')";
                $conn->query($sql);
                $_SESSION['success_msg'] = 'Status added successfully';
                header('Location: view-car-loans.php');
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
              <div class="col-12 grid-margin stretch-card mb-0">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Status</h4>

                
                    <!-- Flash Message  -->
                    <?php require 'includes/flash-message.php'; ?>


                    <!-- car loan status form -->
                    <form class="pt-3" method="POST">

                        <h4 class="form-part-heading mb-3">Auction </h4>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Date</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="auction-date" name="auctionDate" value="<?php echo $auction_date; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $auction_date_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('auction-date').defaultValue = '<?php echo $auction_date; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Amount</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step="0.000001" class="form-control form-input"  name="auctionAmount" value="<?php echo $auction_amount; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $auction_amount_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4 class="form-part-heading mb-3">Recovery </h4>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Date</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="recovery-date" name="recoveryDate" value="<?php echo $recovery_date; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $recovery_date_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('recovery-date').defaultValue = '<?php echo $recovery_date; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Full Amount</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step="0.000001" class="form-control form-input"  name="fullAmount" value="<?php echo $full_amount; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $full_amount_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Part Amount</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step="0.000001" class="form-control form-input"  name="partAmount" value="<?php echo $part_amount; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $part_amount_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <!-- <div class="col-md-6">
                                    <label for="exampleInputCity1">Amount Recovered</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step="0.000001" class="form-control form-input"  name="amountRecovered" placeholder="Amount" value="<?php echo $amount_recovered; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $amount_recovered_error; ?>
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Bill Raised</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step="0.000001" class="form-control form-input"  name="billRaised" placeholder="Amount" value="<?php echo $bill_raised; ?>">
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
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step="0.000001" class="form-control form-input"  name="paymentReceived" placeholder="Amount" value="<?php echo $payment_received; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $payment_received_error; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Payment Received on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="payment-received-on" type="date" class="form-control form-input" name="paymentReceivedOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $payment_received_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('payment-received-on').defaultValue = '<?php echo $payment_received_on; ?>'
                                </script>
                            </div>
                        </div>
                        <h4 class="form-part-heading mb-3">Regularise Account </h4>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Date</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="regularise-date" type="date" class="form-control form-input" name="regulariseDate">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $regularise_date_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('regularise-date').defaultValue = '<?php echo $regularise_date; ?>'
                                </script>
                            </div>
                        </div>
                        <h4 class="form-part-heading mb-3">Full Payment Paid</h4>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Date</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="full-payment-paid-on" type="date" class="form-control form-input" name="fullPaymentPaidOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $full_payment_paid_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('full-payment-paid-on').defaultValue = '<?php echo $full_payment_paid_on; ?>'
                                </script>
                            </div>
                        </div>
                        <div class="form-inline justify-content-end">
                            <button class="btn btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Create</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <!-- <footer class="footer">
          </footer> -->
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