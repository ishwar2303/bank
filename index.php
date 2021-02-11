<?php
  session_start();
  require_once('connection.php');
  require_once('middleware.php');

  if(!isset($_SESSION['user_role'])){ // all access
    $_SESSION['error_msg'] = 'Sign In to view that resource';
    header('Location: login.php');
    exit;
  }

  if(isset($_GET['eaid']) && isset($_GET['delete'])){
    $e_auction_id = base64_decode(cleanInput($_GET['eaid']));

    $sql = "DELETE FROM e_auction WHERE e_auction_id = '$e_auction_id'";
    if($conn->query($sql) === TRUE){
      $_SESSION['success_msg'] = 'E-Auction Details removed successfully';
    }
    else{
      $_SESSION['error_msg'] = 'Something went wrong!';
    }
    header('Location: index.php');
    exit;

  }

  $sql = "SELECT user_id FROM user_registration WHERE user_permitted = '1'";
  $result = $conn->query($sql);
  $total_users = $result->num_rows;

  $sql = "SELECT user_id FROM user_registration WHERE user_role = '2' AND user_permitted = '1'";
  $result = $conn->query($sql);
  $total_admin = $result->num_rows;

  $sql = "SELECT user_id FROM user_registration WHERE user_role = '1' AND user_permitted = '1'";
  $result = $conn->query($sql);
  $total_privileged_user = $result->num_rows;

  $sql = "SELECT user_id FROM user_registration WHERE user_role = '0' AND user_permitted = '1'";
  $result = $conn->query($sql);
  $total_data_operator = $result->num_rows;

  $sql = "SELECT home_loan_cid FROM home_loan";
  $result = $conn->query($sql);
  $total_home_loan = $result->num_rows;

  $sql = "SELECT car_loan_cid FROM car_loan";
  $result = $conn->query($sql);
  $total_car_loan = $result->num_rows;
  
  $sql = "SELECT * FROM e_auction";
  $result = $conn->query($sql);
  $e_auction = array();
  while($row = $result->fetch_assoc()){
    array_push($e_auction, $row);
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
            <?php require 'includes/flash-message.php'; ?>
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
                    <h4 class="form-inline justify-content-end z-ind-10">
                      <a class="status-link" href="home-loan-current-status.php">View Status</a>
                    </h4>
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
                    <h4 class="form-inline justify-content-end z-ind-10">
                      <a class="status-link" href="car-loan-current-status.php">View Status</a>
                    </h4>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Users <i class="fas fa-users mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-3"><?php echo $total_users; ?></h2>
                    <!-- <h6 class="card-text">Increased by 5%</h6> -->
                    <h5>Admin : <?php echo $total_admin; ?></h5>
                    <h5>Privileged User : <?php echo $total_privileged_user; ?></h5>
                    <h5>Data Operator : <?php echo $total_data_operator; ?></h5>
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin stretch-card mb-0 mtp-5">
                <div class="card bg-transparent">
                  <div class="card-body max-height" style="padding-left : 0; padding-right : 0">
                    <div class="e-auction">
                        <img src="assets/css/auction-bg.png" alt="">
                        <a class="e-auction-btn" href="add-e-auction.php" target="_blank">
                          <button class="btn btn-primary"><i class="fas fa-plus mr-1"></i> Add E-Auction Details</button>
                        </a>
                        <div class="e-auction-count set-theme-bg theme-gradient-e-auction">
                          <img src="assets/images/dashboard/circle.svg" class="card-img-absolute e-auction-count-bg-img" alt="circle-image" />
                          <h4 class="font-weight-normal mb-3 form-inline justify-content-between">Property Sold Open E-Auction<i class="fas fa-gavel fs-25 mr-2"></i>
                          </h4>
                          <h2 class="mb-3"><?php echo sizeof($e_auction); ?></h2>
                          <h4 class="form-inline justify-content-end z-ind-10 mt-3">
                            <label onclick="return false" class="status-link mr-2" id="scroll-to-e-auction-details">View Details</label>
                          </h4>
                        </div>
                    </div>
                    <script>
                        // scroll to e-auction-details
                        $("#scroll-to-e-auction-details").on('click',function() {
                              window.scrollTo(0,document.getElementById('e-auction-details-table').offsetTop)
                          });
                    </script>
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin stretch-card mb-0 mtp-5">
                <div class="card">
                  <div class="card-body max-height">
                    <h4 class="theme-text"><i class="fas fa-pen-alt mr-1"></i>   To do</h4>
                    <form class="d-flex" method="POST">
                      <input style="margin-right: 10px;" type="text" id="to-do-work" class="form-control todo-list-input form-input" placeholder="What do you need to do today?">
                      <button class="add btn btn-gradient-primary font-weight-bold todo-list-add-btn btn-setting" type="submit" id="add-task"><i class="fas fa-plus mr-2"></i>Add <i class="mr-1"></i></button>
                    </form>
                    <div id="form-error" class="form-input-response mb-2"></div>
                    <div class="">
                      <ul id="all-to-do-list" class="">
                        <?php 
                            $sql = "SELECT * FROM to_do WHERE user_id = '$_SESSION[user_id]' ORDER BY to_do_id DESC";
                            $result = $conn->query($sql);
                            $index = 0;
                            $statusIndexDone = 0;
                            $statusIndexIncomplete = 0;
                          ?>
                          <?php 
                            if($result->num_rows == 0){
                              ?>
                              <div class="direction-col">
                                  <img src="assets/images/faces-clipart/to-do-list.png" class="to-do-img mt-1" alt="">
                                  <label class="set-theme-color mt-2">Add Your To Do Work...</label>
                              </div>
                              <?php
                            }
                          ?>
                          <?php
                            while($row = $result->fetch_assoc()){
                              if($row['status'] == '0')
                                  $css_class = 'bg-gradient-dang';
                              if($row['status'] == '1')
                                  $css_class = 'bg-gradient-suc'
                          ?>
                          <li class="<?php echo $css_class; ?>">
                              <div>
                                  <span><?php echo ($index+1).'.'; ?></span>
                                  <label><?php echo $row['to_do_work']; ?></label>
                              </div>
                              <span>
                                  <?php if($row['status'] == '0'){ ?>
                                          <i class="far fa-check-circle make-status-success"></i>
                                  <script>
                                      $('.make-status-success').eq(<?php echo $statusIndexDone; ?>).click(() => {
                                          showCustomConfirmation('Mark as Done!')
                                          $('#cancel').click(() => {
                                              $('#confirm').off()
                                              hideCustomConfirmation()
                                          })
                                          $('#confirm').click(() => {
                                              hideCustomConfirmation()
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
                                      })
                                  </script>
                                  <?php
                                          $statusIndexDone += 1;
                                      } 
                                  ?>
                                  <?php if($row['status'] == '1'){ ?>
                                          <i class="far fa-times-circle make-status-incomplete"></i>
                                  <script>
                                      $('.make-status-incomplete').eq(<?php echo $statusIndexIncomplete; ?>).click(() => {
                                          showCustomConfirmation('Mark as Incomplete!')
                                          $('#cancel').click(() => {
                                              $('#confirm').off()
                                              hideCustomConfirmation()
                                          })
                                          $('#confirm').click(() => {
                                              hideCustomConfirmation()
                                              let toDoIncomplete = '<?php echo $row['to_do_id']; ?>'
                                              let reqData = {
                                                  toDoIncomplete
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
                                      
                                      })
                                  </script>
                                  <?php
                                          $statusIndexIncomplete += 1;
                                      } 
                                  ?>
                                  <i class="far fa-trash-alt remove-to-do-work"></i>
                              </span>
                          </li>
                          <script>
                              $('.remove-to-do-work').eq(<?php echo $index; ?>).click(() => {
                                  showCustomConfirmation('Remove from list!')
                                $('#cancel').click(() => {
                                  $('#confirm').off()
                                  hideCustomConfirmation()
                                })
                                $('#confirm').click(() => {
                                  hideCustomConfirmation()
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
        <div  id="e-auction-details-table"></div>
        <?php if(sizeof($e_auction) > 0){ ?>
        <div class="card mt-5">
          <div class="card-body">
            
            <h4 class="card-title form-inline justify-content-between">
              E-Auction Details
            </h4>
            <div class="table-container">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>S No.</th>
                    <th>Bank Name</th>
                    <th>Branch Address</th>
                    <th>Borrower Name</th>
                    <th>Mortgaged Property Address</th>
                    <th>Sold Price</th>
                    <th>Bidder Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $serial_no = 1; 
                  foreach($e_auction as $auction_detail){
                ?>
                  <tr>
                    <td><?php echo $serial_no; ?></td>
                    <td><?php echo $auction_detail['bank_name']; ?></td>
                    <td><?php echo $auction_detail['branch_address']; ?></td>
                    <td><?php echo $auction_detail['borrower_name']; ?></td>
                    <td><?php echo $auction_detail['property_address']; ?></td>
                    <td><?php echo $auction_detail['sold_price']; ?></td>
                    <td><?php echo $auction_detail['bidder_name']; ?></td>
                    <td>
                      <div class="icon-btn-container">
                        <a class="edit" href="edit-e-auction.php?eaid=<?php echo base64_encode($auction_detail['e_auction_id']); ?>" target="_blank">
                          <i class="fas fa-pencil-alt"></i>
                          <span class="operation-name">Edit Details</span>
                        </a>
                        <a onclick="return false" class="delete delete-e-auction">
                          <i class="fas fa-trash-alt"></i>
                          <span class="operation-name">Remove</span>
                        </a>
                      </div>
                        <script>
                            $('.delete-e-auction').eq(<?php echo $serial_no-1; ?>).click(() => {
                              showCustomConfirmation('Remove E-Auction')
                              $('#cancel').click(() => {
                                $('#confirm').off()
                                hideCustomConfirmation()
                              })
                              $('#confirm').click(() => {
                                location.href = 'index.php?eaid=<?php echo base64_encode($auction_detail['e_auction_id']) ?>&delete=true'
                              })
                            })  
                        </script>
                    </td>
                  </tr>
                <?php $serial_no += 1; } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <?php } ?>

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