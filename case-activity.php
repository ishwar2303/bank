<?php
  session_start();
  require_once('connection.php');
  require_once('middleware.php');

  if(isset($_SESSION['user_role'])){ 
    if($_SESSION['user_role'] == '0'){// Data operator not allowed
        $_SESSION['error_msg'] = 'Only Admin and Privileged user can access that resource';
        header('Location: login.php');
        exit;
    }
  }


  date_default_timezone_set("Asia/Kolkata");
  $epoch_time = time();
  $timestamp = date("y-m-d h:i:sa", $epoch_time);


  if(isset($_GET['cid']) && isset($_GET['loan'])){
        $case_id = base64_decode(cleanInput($_GET['cid']));
        $loan = cleanInput($_GET['loan']);
        if($loan == '1')
          $loan_name = 'Home Loan';
        else if($loan == '2')
          $loan_name = 'Car Loan';
        else{
          $_SESSION['error_msg'] = 'Something went wrong';
          header('Location: index.php');
          exit;
        }
        $sql = "SELECT user_registration.user_full_name, user_registration.user_email, user_registration.user_mobile, user_registration.user_role, user_activity.timestamp, activity_list.operation_name FROM user_registration JOIN user_activity ON user_registration.user_id = user_activity.user_id JOIN activity_list ON user_activity.operation_id = activity_list.operation_id WHERE user_activity.case_id = '$case_id' AND user_activity.loan = '$loan' ORDER BY user_activity.activity_id DESC";
        $activity_result = $conn->query($sql);
        if($activity_result->num_rows == 0){
          $_SESSION['error_msg'] = 'View Activity Log case wise';
          header('Location: index.php');
          exit;
        }
  }
  else{
      $_SESSION['error_msg'] = 'Select a case to view its activity';
      header('Location: index.php');
      exit;
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

            <div class="row ht-100">

              <div class="col-lg grid-margin stretch-card mb-0">
                <div class="card">
                  <div class="card-body set-table-height">
                    <h4 class="card-title form-inline justify-content-between">
                      <?php echo $loan_name; ?> Case Activity Log
                    </h4>
            
                
                    <!-- Flash Message  -->
                    <?php require 'includes/flash-message.php'; ?>

                    <div class="table-container">
                            <div class="table table-hover">
                            <table>
                                <tr>
                                    <th>S No</th>
                                    <th>Activity</th>
                                    <th>User Name</th>
                                    <th>Role</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>E-mail</th>
                                    <th>Contact</th>
                                </tr>
                                <?php 
                                    $serial_no = 1;
                                    while($row = $activity_result->fetch_assoc()){
                                    ?>
                                    <tr>
                                        <td><?php echo $serial_no; ?></td>
                                        <td><?php echo $row['operation_name']; ?></td>
                                        <td><?php echo $row['user_full_name']; ?></td>
                                        <td>
                                            <?php 
                                                $role = $row['user_role'];
                                                if($role == '2')
                                                    $role_value = 'Admin';
                                                else if($role == '1')
                                                    $role_value = 'Privileged User';
                                                else if($role == '0')
                                                    $role_value = 'Data Operator';
                                                echo $role_value;
                                            ?>
                                        </td>

                                        <?php 
                                            $timestamp = new DateTime($row['timestamp']);
                                            $activity_date = $timestamp->format('d-m-Y');
                                            $activity_time = $timestamp->format('h:i:sa');
                                        ?>
                                            
                                        <td><?php echo $activity_date; ?></td>
                                        <td><?php echo $activity_time; ?></td>
                                        <td><?php echo base64_decode($row['user_email']); ?></td>
                                        <td><?php echo base64_decode($row['user_mobile']); ?></td>
                                      </tr>
                                    <?php 
                                    
                                    $serial_no += 1;
                                        }
                                
                                ?>
                            </table>
                            </div>
                        </div>

                  </div>
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
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>