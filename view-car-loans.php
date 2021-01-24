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

    $db_error = '';
    if(isset($_GET['cid'])){
      $car_loan_cid = base64_decode($_GET['cid']);
      $sql = "DELETE FROM car_loan WHERE car_loan_cid = '$car_loan_cid'";
      $conn->query($sql);

      if($conn->error == ''){
        $_SESSION['success_msg'] = 'Deleted Successfully';
      }
      else{
        $_SESSION['error_msg'] = 'Something went wrong!';
        $db_error = $conn->error;
      }
    }

    $sql = "SELECT * FROM car_loan";
    $result = $conn->query($sql);

    if($conn->error != ''){
        $_SESSION['error_msg'] = 'Something went wrong!';
        $db_error = $conn->error;
    }
    else if($result->num_rows == 0){
        $_SESSION['error_msg'] = 'No Car loans';
    }


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>View Car Loans</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
    <script src="https://kit.fontawesome.com/196c90f518.js" crossorigin="anonymous"></script>
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

              <div class="col-lg grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Car Loans</h4>
                    <div class="table-container">
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

                    <!--
                    <p class="card-description"> Add class <code>.table-hover</code>
                    </p>
                    -->
                    <?php if($db_error == ''){ ?>
                        <?php if($result->num_rows > 0){ ?>
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th>S No</th>
                                  <th>Home Branch</th>
                                  <th>Account Number</th>
                                  <th>Customer Name</th>
                                  <th>NPA Date</th>
                                  <th>Outstanding</th>
                                  <th>ARR-CO ND</th>
                                  <th>Notice 13 Sent</th>
                                  <th>Principal Outstanding</th>
                                  <th>Bounce Charges ₹</th>
                                  <th>Overdue Charges ₹</th>
                                  <th>Other Charges ₹</th>
                                  <th>Loan EMI Amount ₹</th>
                                  <th>No Of EMI Outstanding</th>
                                  <th>Reg No</th>
                                  <th>Residence Address</th>
                                  <th>Residence Contact</th>
                                  <th>Office Address</th>
                                  <th>Office Contact</th>
                                  <th>Make</th>
                                  <th>Engine No</th>
                                  <th>Chassis No</th>
                                  <th>Tenure</th>
                                  <th>Co Applicant Name</th>
                                  <th>Co Applicant Contact</th>
                                  <th>Co Applicant Address</th>
                                  <th>Employer Name</th>
                                  <th>Employer Contact</th>
                                  <th>Employer Address</th>
                                  <th>Amount Recovered ₹</th>
                                  <th>Bill Raised ₹</th>
                                  <th>Payment Received ₹</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                                </tr>
                              </thead>

                            <tbody>
                            <?php 
                                $serial_no = 1;
                                while($car_loan = $result->fetch_assoc()){
                                    $encoded_cid = base64_encode($car_loan['car_loan_cid']);
                                    ?>
                                    <tr>
                                      <td><?php echo $serial_no; ?></td>
                                      <td><?php echo $car_loan['home_branch']; ?></td>
                                      <td><?php echo $car_loan['account_number']; ?></td>
                                      <td><?php echo $car_loan['customer_name']; ?></td>
                                      <td><?php echo $car_loan['npa_date']; ?></td>
                                      <td><?php echo $car_loan['outstanding']; ?></td>
                                      <td><?php echo $car_loan['arr_co_nd']; ?></td>
                                      <td><?php echo $car_loan['notice13_sent_on']; ?></td>
                                      <td><?php echo $car_loan['principal_outstanding']; ?></td>
                                      <td><?php echo $car_loan['bounce_charges']; ?></td>
                                      <td><?php echo $car_loan['overdue_charges']; ?></td>
                                      <td><?php echo $car_loan['other_charges']; ?></td>
                                      <td><?php echo $car_loan['loan_emi_amount']; ?></td>
                                      <td><?php echo $car_loan['no_of_emi_outstanding']; ?></td>
                                      <td><?php echo $car_loan['reg_no']; ?></td>
                                      <td><?php echo $car_loan['residence_address']; ?></td>
                                      <td><?php echo $car_loan['residence_contact_no']; ?></td>
                                      <td><?php echo $car_loan['office_address']; ?></td>
                                      <td><?php echo $car_loan['office_contact_no']; ?></td>
                                      <td><?php echo $car_loan['make']; ?></td>
                                      <td><?php echo $car_loan['engine_no']; ?></td>
                                      <td><?php echo $car_loan['chassis_no']; ?></td>
                                      <td><?php echo $car_loan['tenure']; ?></td>
                                      <td><?php echo $car_loan['co_applicant_name']; ?></td>
                                      <td><?php echo $car_loan['co_applicant_mobile']; ?></td>
                                      <td><?php echo $car_loan['co_applicant_address']; ?></td>
                                      <td><?php echo $car_loan['employer_name']; ?></td>
                                      <td><?php echo $car_loan['employer_mobile']; ?></td>
                                      <td><?php echo $car_loan['employer_address']; ?></td>
                                      <td><?php echo $car_loan['amount_recovered']; ?></td>
                                      <td><?php echo $car_loan['bill_raised']; ?></td>
                                      <td><?php echo $car_loan['payment_received']; ?></td>
                                      <td>
                                          <a class="table-edit-op" href="edit-car-loan.php?cid=<?php echo $encoded_cid; ?>">
                                              <span>Edit</span>
                                              <i class="fas fa-edit"></i>
                                          </a>
                                      </td>
                                      <td>
                                          <a class="table-delete-op" href="view-car-loans.php?cid=<?php echo $encoded_cid; ?>">
                                              <span>Delete</span>
                                              <i class="fas fa-trash-alt"></i>
                                          </a>
                                      </td>
                                    </tr>
                                    <?php
                                    $serial_no += 1;
                                }
                            ?>
                            </tbody>

                            </table>
                        <?php } ?>
                    <?php } ?>
                    </div>
                  </div>
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
    <!-- End custom js for this page -->
  </body>
</html>