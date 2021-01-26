<?php
  session_start();
  require_once('connection.php');

  if(!isset($_SESSION['user_role'])){ // all access
    $_SESSION['error_msg'] = 'Sign In to view that resource';
    header('Location: login.php');
    exit;
  }

  $sql = "SELECT user_id FROM user_registration";
  $result = $conn->query($sql);
  $total_users = $result->num_rows;

  $sql = "SELECT home_loan_cid FROM home_loan";
  $result = $conn->query($sql);
  $total_home_loan = $result->num_rows;

  $sql = "SELECT car_loan_cid FROM car_loan";
  $result = $conn->query($sql);
  $total_car_loan = $result->num_rows;
  
  
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Loan Management</title>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
              </h3>
            </div>
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Home Loan Cases <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo $total_home_loan; ?></h2>
                    <!-- <h6 class="card-text">Increased by 60%</h6> -->
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Car Loan Cases <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo $total_car_loan; ?></h2>
                    <!-- <h6 class="card-text">Decreased by 10%</h6> -->
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Users <i class="fas fa-users mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo $total_users; ?></h2>
                    <!-- <h6 class="card-text">Increased by 5%</h6> -->
                  </div>
                </div>
              </div>
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="theme-text">Todo</h4>
                    <form class="d-flex" method="POST">
                      <input style="margin-right: 10px;" type="text" id="to-do-work" class="form-control todo-list-input form-input" placeholder="What do you need to do today?">
                      <button class="add btn btn-gradient-primary font-weight-bold todo-list-add-btn" type="submit" id="add-task">Add</button>
                    </form>
                    <div id="form-error" class="form-input-response mb-2"></div>
                    <div class="">
                      <ul id="all-to-do-list" class="">
                        <?php 
                            $sql = "SELECT * FROM to_do WHERE user_id = '$_SESSION[user_id]' ORDER BY to_do_id DESC";
                            $result = $conn->query($sql);
                            $index = 0;
                            $statusIndex = 0;
                            while($row = $result->fetch_assoc()){
                                if($row['status'] == '0')
                                    $css_class = 'bg-gradient-danger';
                                if($row['status'] == '1')
                                    $css_class = 'bg-gradient-success'
                            ?>
                            <li class="<?php echo $css_class; ?>">
                                <div>
                                    <span><?php echo ($index+1).'.'; ?></span>
                                    <label><?php echo $row['to_do_work']; ?></label>
                                </div>
                                <span>
                                    <?php if($row['status'] == '0'){ ?>
                                            <i class="fas fa-check-circle make-status-success"></i>
                                    <?php
                                            $statusIndex += 1;
                                        } 
                                    ?>
                                    <i class="fas fa-trash-alt remove-to-do-work"></i>
                                </span>
                            </li>
                            <script>
                                $('.remove-to-do-work').eq(<?php echo $index; ?>).click(() => {
                                  let confirmation = confirm('Remove : Are your sure!')
                                  if(confirmation){
                                    let toDoIdDelete = '<?php echo $row['to_do_id']; ?>'
                                    let reqData = {
                                        toDoIdDelete
                                    }
                                    let url = 'to-do-work.php'
                                    $.ajax({
                                        url,
                                        type : 'POST',
                                        dataType : 'html',
                                        success : (msg) => {
                                        },
                                        complete : (res) => {
                                            $('#all-to-do-list').html(res.responseText)
                                        },
                                        data : reqData
                                    })
                                  }
                                })
                            </script>
                            <script>
                                $('.make-status-success').eq(<?php echo $statusIndex-1; ?>).click(() => {
                                let toDoSuccess = '<?php echo $row['to_do_id']; ?>'
                                let reqData = {
                                    toDoSuccess
                                }
                                let url = 'to-do-work.php'
                                $.ajax({
                                    url,
                                    type : 'POST',
                                    dataType : 'html',
                                    success : (msg) => {
                                    },
                                    complete : (res) => {
                                        $('#all-to-do-list').html(res.responseText)
                                    },
                                    data : reqData
                                })
                                })
                            </script>
                            <?php
                            $index += 1;
                            }
                        ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <script>
                  $('#add-task').click(() => {
                    
                    let toDoWork = $('#to-do-work').val()
                    if(toDoWork != ''){
                      let url = 'to-do-work.php'
                      let reqData = {
                        toDoWork
                      }
                      $.ajax({
                          url,
                          type : 'POST',
                          dataType : 'html',
                          success : (msg) => {
                          },
                          complete : (res) => {
                              $('#all-to-do-list').html(res.responseText)
                          },
                          data : reqData
                      })
                    }
                    else{
                      $('#form-error').html('What do you need to do today?')
                    }
                  })
              </script>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <!-- <footer class="footer">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates </a> from Bootstrapdash.com</span>
            </div>
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