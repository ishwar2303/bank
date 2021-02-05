<?php 
    session_start();
    require_once('connection.php');
    require_once('middleware.php');

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

    $users_array = array();
    $temp_array = array();
    $search_user = '';
    $search_user_error = '';
    if(isset($_REQUEST['searchUser'])){
      $search_user = strtoupper(cleanInput($_REQUEST['searchUser']));
      if($search_user == '')
        $search_user_error = 'Search user by name...';
    }

    $sql = "SELECT * FROM user_registration ORDER BY user_role DESC";
    $result = $conn->query($sql);
    $str_len_search = strlen($search_user);
    while($row = $result->fetch_assoc()){
      array_push($temp_array, $row);
      $control = 1;
      $user_name = strtoupper($row['user_full_name']);
      $str_len_name = strlen($user_name);
      if($str_len_search > $str_len_name)
        $str_len = $str_len_name;
      else $str_len = $str_len_search;
      for($i=0; $i<$str_len; $i++){
        if($user_name[$i] != $search_user[$i]){
          $control = 0;
          break;
        }
      }
      if($control){
        array_push($users_array, $row);
      }
    }
    if(sizeof($users_array) == 0){
      $users_array = $temp_array;
      $_SESSION['error_msg'] = 'No user found with the given name';
    }
    else if($search_user != ''){
      $_SESSION['success_msg'] = 'Search result for `'.$search_user.'` &nbsp;&nbsp; <a href="view-users.php">View all users</a>';
    }
    if($conn->error != ''){
      $_SESSION['error_msg'] = $conn->error;
    }
    
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require 'includes/layout.php'; ?>
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

                    <!-- Flash Message  -->
                    <?php require 'includes/flash-message.php'; ?>

                      <?php 
                        if($db_error == ''){
                          if(sizeof($users_array) > 0){
                            ?>
                            <h4 class="card-title">Users</h4>
                            <form action="" method="POST">
                              <div class="form-group mb-3">
                                <div class="row">
                                  <div class="col-md-6 mb-2">
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                          <i class="fas fa-search"></i>
                                        </span>
                                      </div>
                                      <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control form-input" name="searchUser" value="<?php echo $search_user; ?>" placeholder="Search user by name...">
                                    </div>
                                    <div class="form-input-response">
                                      <?php echo $search_user_error; ?>
                                    </div>
                                  </div>
                                  <div class="col-md-6 mb-3 form-inline">
                                      <button type="submit" class="btn btn-gradient-primary mr-2">Search</button>
                                  </div>
                                </div>
                              </div>
                            </form>
                            <div class="row bank-card-container">
                            <?php
                            foreach($users_array as $user){
                                $encoded_user_id = base64_encode($user['user_id']);
                                $created_date = new DateTime($user['user_updated_timestamp']);

                                $full_name = $user['user_full_name'];
                                $role = $user['user_role'];
                                if($role == '2'){
                                  $role_value = 'Admin';
                                  $css_card = 'card bg-gradient-danger card-img-holder text-white';
                                }
                                if($role == '1'){
                                  $role_value = 'Privileged User';
                                  $css_card = 'card bg-gradient-info card-img-holder text-white';
                                }
                                if($role == '0'){
                                  $role_value = 'Data operator';
                                  $css_card = 'card bg-gradient-success card-img-holder text-white';
                                }
                                $email = base64_decode($user['user_email']);
                                $contact = base64_decode($user['user_mobile']);
                                $password = base64_decode($user['user_password'])
                                ?>
                                <div class="col-md-4 stretch-card grid-margin">
                                  <div class="<?php echo $css_card; ?>">
                                    <div class="card-body">
                                      <h4 class="font-weight-normal mb-3 capt">
                                        <?php echo $full_name; ?>
                                        <i class="fas fa-user mdi-24px float-right"></i>
                                      </h4>
                                      <h5 class="mb-2 user-role">
                                        <?php echo $role_value; ?>
                                      </h5>
                                      <h5 class="mb-2">
                                        <?php echo $email; ?>
                                      </h5>
                                      <h6 class="mb-2">
                                        <?php echo $contact; ?>
                                      </h6>
                                      <?php if($_SESSION['user_id'] == $user['user_id']){ ?>
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
                                        <?php if($_SESSION['user_id'] == $user['user_id'] || $role != '2'){ ?>
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
