

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

    if(isset($_GET['bankId'])){
      $bank_id = base64_decode($_GET['bankId']);

      $sql = "DELETE FROM bank WHERE bank_id = '$bank_id'";
      $conn->query($sql);
      if($conn->error == ''){
        $_SESSION['success_msg'] = 'Bank deleted successfully';
        header('Location: view-banks.php');
        exit;
      }
      else{
        $_SESSION['error_msg'] = 'Something went wrong';
      }
    }

    $db_error = '';
    $sql = "SELECT * FROM bank";
    $result = $conn->query($sql);

    if($conn->error != ''){
        $_SESSION['error_msg'] = 'Something went wrong!';
        $db_error = $conn->error;
    }
    else if($result->num_rows == 0){
      $_SESSION['error_msg'] = 'No results';
    }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>View Banks</title>
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
                    <h4 class="card-title">Banks</h4>
            
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
                    
                        if($db_error == ''){
                          if($result->num_rows > 0){
                            ?>
                            <p class="card-description"> Bank Details </p>
                                  
                            <div class="row">
                            <?php
                            while($row = $result->fetch_assoc()){
                                $encoded_bank_id = base64_encode($row['bank_id']);
                                ?>
                                <div class="col-md-4 stretch-card grid-margin">
                                  <div class="card bg-gradient-info card-img-holder text-white">
                                    <div class="card-body">
                                      <h4 class="font-weight-normal mb-3">
                                        <?php echo $row['bank_name']; ?>
                                        <i class="mdi mdi-bank mdi-24px float-right"></i>
                                      </h4>
                                      <h5 class="mb-2">
                                        <?php echo $row['bank_branch']; ?>
                                      </h5>
                                      <h5 class="mb-2">
                                        <?php echo $row['bank_city']; ?>
                                      </h5>
                                      <h6 class="mb-5">
                                        <?php echo $row['bank_address']; ?>
                                      </h6>
                                      <h6 class="mb-2">
                                        <?php echo $row['bank_contact_person_name']; ?>
                                      </h6>
                                      <h6 class="mb-2">
                                        <?php echo $row['bank_contact_person_number']; ?>
                                      </h6>

                                      <div class="bank-operation">
                                        <a href="edit-bank.php?bankId=<?php echo $encoded_bank_id; ?>">Edit
                                          <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="view-banks.php?bankId=<?php echo $encoded_bank_id; ?>">Delete
                                          <i class="fas fa-trash-alt"></i>
                                        </a>
                                      </div>


                                    </div>
                                  </div>
                                </div>
                                <?php
                              
                            }
                            ?>
                            </div>
                            <?php 
                          }

                        }
                    
                    ?>
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
