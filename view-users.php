

<?php 
    session_start();
    require_once('connection.php');
    

    if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role'] != '2'){ // only admin
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

    if(isset($_GET['user_id'])){
      $user_id = base64_decode($_GET['user_id']);

      $sql = "DELETE FROM user_registration WHERE user_id = '$user_id'";
      $conn->query($sql);
      $sql = "DELETE FROM to_do WHERE user_id = '$user_id'";
      $conn->query($sql);
      if($conn->error == ''){
        $_SESSION['success_msg'] = 'User deleted successfully';
        if($_SESSION['user_id'] == $user_id){
          unset($_SESSION['login_time']);
          unset($_SESSION['user_id']);
          unset($_SESSION['user_role']);
          unset($_SESSION['user_full_name']);
          $_SESSION['success_msg'] = 'Your account has been removed successfully';
          header('Location: login.php');
          exit;
        }
        header('Location: view-users.php');
        exit;
      }
      else{
        $_SESSION['error_msg'] = 'Something went wrong';
      }
    }

    $db_error = '';
    $sql = "SELECT * FROM user_registration ORDER BY user_role DESC";
    $result = $conn->query($sql);

    if($conn->error != ''){
        $_SESSION['error_msg'] = 'Something went wrong!';
        $db_error = $conn->error;
    }
    else if($result->num_rows == 0){
      $_SESSION['error_msg'] = 'No user';
    }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Users</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <script src="https://kit.fontawesome.com/196c90f518.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                    <h4 class="card-title">Users</h4>
            
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
                            <p class="card-description"> User Details </p>
                                  
                            <div class="row bank-card-container">
                            <?php
                            while($row = $result->fetch_assoc()){
                                $encoded_user_id = base64_encode($row['user_id']);
                                $created_date = new DateTime($row['user_updated_timestamp']);

                                $full_name = $row['user_full_name'];
                                $role = $row['user_role'];
                                if($role == '2'){
                                  $role_value = 'Admin';
                                  $css_class = 'admin';
                                  $css_card = 'card bg-gradient-danger card-img-holder text-white';
                                }
                                if($role == '1'){
                                  $role_value = 'Privileged User';
                                  $css_class = 'privileged-user';
                                  $css_card = 'card bg-gradient-info card-img-holder text-white';
                                }
                                if($role == '0'){
                                  $role_value = 'Data operator';
                                  $css_class = 'data-operator';
                                  $css_card = 'card bg-gradient-success card-img-holder text-white';
                                }
                                $email = base64_decode($row['user_email']);
                                $contact = base64_decode($row['user_mobile']);
                                $password = base64_decode($row['user_password'])
                                ?>
                                <div class="col-md-4 stretch-card grid-margin">
                                  <div class="<?php echo $css_card; ?>">
                                    <div class="card-body">
                                      <h4 class="font-weight-normal mb-3 capt">
                                        <?php echo $full_name; ?>
                                        <i class="fas fa-user mdi-24px float-right"></i>
                                      </h4>
                                      <h5 class="mb-2 <?php echo $css_class; ?>">
                                        <?php echo $role_value; ?>
                                      </h5>
                                      <h5 class="mb-2">
                                        <?php echo $email; ?>
                                      </h5>
                                      <h6 class="mb-2">
                                        <?php echo $contact; ?>
                                      </h6>
                                      <?php if($_SESSION['user_id'] == $row['user_id']){ ?>
                                      <h6 class="mb-5">
                                        <?php echo 'Password : '.$password; ?>
                                      </h6>
                                      <?php }
                                      else{
                                        ?>
                                        <div class="mb-5"></div>
                                        <div class="mb-3"></div>
                                        <?php
                                      }
                                      ?>
                                      
                                      <h6 class="mb-2">
                                        <?php echo 'Created : '.$created_date->format('d-m-Y'); ?>
                                      </h6>
                                      <h6 class="mb-2">
                                        <?php echo 'Time : '.$created_date->format('h:i:sa'); ?>
                                      </h6>

                                      <div class="bank-operation form-inline justify-content-end">
                                        <!-- <a href="edit-user.php?bankId=<?php echo $encoded_user_id; ?>">Edit
                                          <i class="fas fa-edit"></i>
                                        </a> -->
                                        <?php if($_SESSION['user_id'] == $row['user_id'] || $role != '2'){ ?>
                                        <label class="delete-btn" onclick="confirmResourceDeletion('<?php echo $encoded_user_id; ?>','user')">Delete
                                          <i class="fas fa-trash-alt"></i>
                                        </label>
                                        <?php } ?>
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
