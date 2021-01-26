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
    // Deleting home loan
    if(isset($_GET['cid'])){
      $home_loan_cid = base64_decode($_GET['cid']);
      $sql = "DELETE FROM home_loan WHERE home_loan_cid = '$home_loan_cid'";
      $conn->query($sql);
      $sql = "DELETE FROM home_loan_comments WHERE case_id = '$home_loan_cid'";
      $conn->query($sql);

      if($conn->error == ''){
        
        $_SESSION['success_msg'] = 'Deleted Successfully';
        header('Location: view-home-loans.php');
        exit;
      }
      else{
        $_SESSION['error_msg'] = 'Something went wrong!';
        $db_error = $conn->error;
        header('Location: view-home-loans.php');
        exit;
      }
    }

    // Deleting home loan comment
    if(isset($_GET['comment_id'])){
      $comment_id = base64_decode($_GET['comment_id']);
      $sql = "DELETE FROM home_loan_comments WHERE comment_id = '$comment_id'";
      $conn->query($sql);

      if($conn->error == ''){
        $_SESSION['success_msg'] = 'Deleted Successfully';
        header('Location: view-home-loans.php');
        exit;
      }
      else{
        $_SESSION['error_msg'] = 'Something went wrong!';
        $db_error = $conn->error;
      }
    }

    $sql = "SELECT * FROM home_loan";
    $result = $conn->query($sql);

    if($conn->error != ''){
        $_SESSION['error_msg'] = 'Something went wrong!';
        $db_error = $conn->error;
    }
    else if($result->num_rows == 0){
        $_SESSION['error_msg'] = 'No Home loans';
    }


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>View Home Loans</title>
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
    <!-- case status popup -->
    <div class="show-case-status">
      <div class="show-case-content">
          <div style="padding: 19px 0px;"></div>
          <div class="case-status-heading">
            <span>Status...</span>
            <i id="close-case-status-container" class="fas fa-window-close"></i>
          </div>
          <div class="comments-section">
          </div>
      </div>
    </div>
    <!-- -->
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
                    <h4 class="card-title">Home Loans</h4>
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
                                  <th>Case Date</th>
                                  <th>Bank Name</th>
                                  <th>NPA Cases</th>
                                  <th>Bank Representative</th>
                                  <th>Designation</th>
                                  <th>Contact</th>
                                  <th>E-mail</th>
                                  <th>Bank Address</th>
                                  <th>Borrower Name</th>
                                  <th>Amount ₹</th>
                                  <th>Outstanding</th>
                                  <th>RA agreement signed</th>
                                  <th>RA agreement expired</th>
                                  <th>Notice 13(2)</th>
                                  <th>Notice 13(3)</th>
                                  <th>Primary security</th>
                                  <th>Collateral security</th>
                                  <th>Total security</th>
                                  <th>Symbolic Possession</th>
                                  <th>Hindi Newspaper</th>
                                  <th>English Newspaper</th>
                                  <th>Requested Bank for documents</th>
                                  <th>Documents received on</th>
                                  <th>Documents given to advocate</th>
                                  <th>Application file DM/CMM by Advocate</th>
                                  <th>Date of hearing</th>
                                  <th>Date of compromise</th>
                                  <th>Amount of compromise ₹</th>
                                  <th>Full compromise paid upto ₹</th>
                                  <th>OTS accepted</th>
                                  <th>Full amount of OTS paid upto ₹</th>
                                  <th>Compromise OTS Failed</th>
                                  <th>Property sold on</th>
                                  <th>Property sold for</th>
                                  <th>Full amount of compromise received on</th>
                                  <th>Full amount of ots received on</th>
                                  <th>Date of RA Bill</th>
                                  <th>Amount of RA Bill</th>
                                  <th>RA Bill forward to Bank On</th>
                                  <th>RA Bill Paid On</th>
                                  <th>RA Bill Paid Amount</th>
                                  <th>Total amount of expenses incurred</th>
                                  <th>Income case wise profit/loss</th>
                                  <th>Edit</th>
                                  <th>Status</th>
                                  <th>Delete</th>
                                </tr>
                              </thead>

                            <tbody>
                            <?php 
                                $serial_no = 1;
                                $index = 0;
                                while($home_loan = $result->fetch_assoc()){
                                    $encoded_cid = base64_encode($home_loan['home_loan_cid']);
                                    $npa_case = $home_loan['npa_case'];
                                    if($npa_case == '1')
                                      $npa_case_value = 'Upto Rs 20 Lac';
                                  
                                    if($npa_case == '2')
                                        $npa_case_value = 'From Rs. 20 Lac + to Rs. 10 Crore';

                                    if($npa_case == '3')
                                        $npa_case_value = 'Over 10 Crore';
                                    ?>
                                    <tr>
                                      <td><?php echo $serial_no; ?></td>
                                      <td><?php echo $home_loan['case_date']!= '0000-00-00'? $home_loan['case_date'] : '-'; ?></td>
                                      <td><?php echo $home_loan['bank_name']; ?></td>
                                      <td><?php echo $npa_case_value; ?></td>
                                      <td><?php echo $home_loan['bank_contact_person_name']; ?></td>
                                      <td><?php echo $home_loan['bank_contact_person_designation']; ?></td>
                                      <td><?php echo $home_loan['bank_contact_person_number']; ?></td>
                                      <td><?php echo $home_loan['bank_contact_person_email']; ?></td>
                                      <td><?php echo $home_loan['bank_address']; ?></td>
                                      <td><?php echo $home_loan['borrower_name']; ?></td>
                                      <td><?php echo $home_loan['amount']; ?></td>
                                      <td><?php echo $home_loan['outstanding_on']; ?></td>
                                      <td><?php echo $home_loan['ra_agreement_signed_on']!= '0000-00-00'? $home_loan['ra_agreement_signed_on'] : '-'; ?></td>
                                      <td><?php echo $home_loan['ra_agreement_expired_on']!= '0000-00-00'? $home_loan['ra_agreement_expired_on'] : '-'; ?></td>
                                      <td><?php echo $home_loan['date_of_notice13_2']!= '0000-00-00'? $home_loan['date_of_notice13_2'] : '-'; ?></td>
                                      <td><?php echo $home_loan['date_of_notice13_3']!= '0000-00-00'? $home_loan['date_of_notice13_3'] : '-'; ?></td>
                                      <td><?php echo $home_loan['primary_security']; ?></td>
                                      <td><?php echo $home_loan['collateral_security']; ?></td>
                                      <td><?php echo $home_loan['total_security']; ?></td>
                                      <td><?php echo $home_loan['date_of_symbolic_possession']!= '0000-00-00'? $home_loan['date_of_symbolic_possession'] : '-'; ?></td>
                                      <td><?php echo $home_loan['publication_hindi_newspaper_on']!= '0000-00-00'? $home_loan['publication_hindi_newspaper_on'] : '-'; ?></td>
                                      <td><?php echo $home_loan['publication_english_newspaper_on']!= '0000-00-00'? $home_loan['publication_english_newspaper_on'] : '-'; ?></td>
                                      <td><?php echo $home_loan['requested_bank_for_documents']!= '0000-00-00'? $home_loan['requested_bank_for_documents'] : '-'; ?></td>
                                      <td><?php echo $home_loan['documents_received_on']!= '0000-00-00'? $home_loan['documents_received_on'] : '-'; ?></td>
                                      <td><?php echo $home_loan['documents_given_to_advocate_on']!= '0000-00-00'? $home_loan['documents_given_to_advocate_on'] : '-'; ?></td>
                                      <td><?php echo $home_loan['application_file_dm_cmm_by_advocate_on']!= '0000-00-00'? $home_loan['application_file_dm_cmm_by_advocate_on'] : '-'; ?></td>
                                      <td><?php echo $home_loan['date_of_hearing']!= '0000-00-00'? $home_loan['date_of_hearing'] : '-'; ?></td>
                                      <td><?php echo $home_loan['date_of_compromise']!= '0000-00-00'? $home_loan['date_of_compromise'] : '-'; ?></td>
                                      <td><?php echo $home_loan['amount_of_compromise']; ?></td>
                                      <td><?php echo $home_loan['full_compromise_paid_upto']; ?></td>
                                      <td><?php echo $home_loan['date_of_ots_accepted']!= '0000-00-00'? $home_loan['date_of_ots_accepted'] : '-'; ?></td>
                                      <td><?php echo $home_loan['amount_of_ots_paid_upto']; ?></td>
                                      <td><?php echo $home_loan['compromise_ots_failed']; ?></td>
                                      <td><?php echo $home_loan['property_sold_on']!= '0000-00-00'? $home_loan['property_sold_on'] : '-'; ?></td>
                                      <td><?php echo $home_loan['property_sold_for']; ?></td>
                                      <td><?php echo $home_loan['case_date']!= 'full_amount_compromise_received_on'? $home_loan['full_amount_compromise_received_on'] : '-'; ?></td>
                                      <td><?php echo $home_loan['full_amount_ots_received_on']!= '0000-00-00'? $home_loan['full_amount_ots_received_on'] : '-'; ?></td>
                                      <td><?php echo $home_loan['date_of_ra_bill']!= '0000-00-00'? $home_loan['date_of_ra_bill'] : '-'; ?></td>
                                      <td><?php echo $home_loan['amount_of_ra_bill']; ?></td>
                                      <td><?php echo $home_loan['ra_bill_forward_to_bank_on']!= '0000-00-00'? $home_loan['ra_bill_forward_to_bank_on'] : '-'; ?></td>
                                      <td><?php echo $home_loan['ra_bill_paid_on']!= '0000-00-00'? $home_loan['ra_bill_paid_on'] : '-'; ?></td>
                                      <td><?php echo $home_loan['ra_bill_paid_amount']; ?></td>
                                      <td><?php echo $home_loan['total_amount_of_expenses_incurred']; ?></td>
                                      <td><?php echo $home_loan['income_case_wise_profit_loss']; ?></td>
                                      <td>
                                          <a class="table-edit-op mb-0" href="edit-home-loan.php?cid=<?php echo $encoded_cid; ?>">
                                              <span>Edit</span>
                                              <i class="fas fa-edit"></i>
                                          </a>
                                      </td>
                                      <td>
                                          <a class="table-add-op mb-0" href="home-loan-comment.php?cid=<?php echo $encoded_cid; ?>" target="_blank">
                                              <span>Add</span>
                                              <i class="fas fa-plus-square"></i>
                                          </a>
                                          <?php 
                                            $sql = "SELECT case_id FROM home_loan_comments WHERE case_id = '$home_loan[home_loan_cid]'";
                                            $comments = $conn->query($sql);
                                            if($comments->num_rows > 0){
                                          ?>
                                          <label class="table-view-op mb-0">
                                              <span>View</span>
                                              <i class="fas fa-eye"></i>
                                          </label>
                                          <script>
                                              $('.table-view-op').eq(<?php echo $index; ?>).click(() => {
                                                let case_id = '<?php echo $encoded_cid; ?>'
                                                let reqData = {
                                                  case_id
                                                }
                                                let url = 'retrieve-home-loan-status.php'
                                                $.ajax({
                                                    url,
                                                    type : 'POST',
                                                    dataType : 'html',
                                                    success : (msg) => {
                                                    },
                                                    complete : (res) => {
                                                        $('.comments-section').html(res.responseText)
                                                    },
                                                    data : reqData
                                                })
                                              })
                                          </script>
                                          <?php 
                                              $index += 1;
                                            }
                                          ?>
                                      </td>
                                      <td>
                                          <label onclick="confirmResourceDeletion('<?php echo $encoded_cid; ?>','home-loan')" class="table-delete-op mb-0" href="view-home-loans.php?cid=<?php echo $encoded_cid; ?>">
                                              <span>Delete</span>
                                              <i class="fas fa-trash-alt"></i>
                                          </label>
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

<script>
  document.getElementById('close-case-status-container').addEventListener('click', ()=>{
    document.getElementsByClassName('show-case-status')[0].style.display = 'none';
  })
  document.getElementsByClassName('comments-section')[0].style.height = (screen.height*0.73611111-10) +'px'
</script>