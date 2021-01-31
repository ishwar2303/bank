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
    $current_date = new DateTime($timestamp);
    $current_date = $current_date->format('d-m-Y');
    require_once('middleware.php');

    // Selecting banks
    $db_error = '';
    $sql = "SELECT * FROM bank ORDER BY bank_name ASC";
    $bank_list = $conn->query($sql);

    if($conn->error != ''){
        $_SESSION['error_msg'] = 'Something went wrong!';
        $db_error = $conn->error;
    }

    // deleting car loan
    if(isset($_GET['cid'])){
      $car_loan_cid = base64_decode($_GET['cid']);
      $sql = "DELETE FROM car_loan WHERE car_loan_cid = '$car_loan_cid'";
      $conn->query($sql);
      $sql = "DELETE FROM car_loan_remarks WHERE case_id = '$car_loan_cid'"; // Deleting remarks
      $conn->query($sql);
      if($conn->error == ''){
        $_SESSION['success_msg'] = 'Deleted Successfully';
        header('Location: view-car-loans.php');
        exit;
      }
      else{
        $_SESSION['error_msg'] = 'Something went wrong!';
        $db_error = $conn->error;
      }
    }
/*
    $sql = "SELECT * FROM car_loan";
    $result = $conn->query($sql);

    if($conn->error != ''){
        $_SESSION['error_msg'] = 'Something went wrong!';
        $db_error = $conn->error;
    }
    else if($result->num_rows == 0){
        $_SESSION['error_msg'] = 'No Car loans';
    }
*/


    // filter variables
    $select_bank = '';
    $cases_date_from = '';
    $cases_date_upto = '';
    $defaulter_name = '';
    $cases_date_from_error = '';
    $cases_date_upto_error = '';
    $select_bank_error = '';
    $defaulter_name_error = '';
    $search_box_error = '';
    //search
    $display_search_box = false;

    $result_array = array(); // search result
    $control = 0; // check that atleast one field is selected
    $error_occured = 0; // check if any validation error occured

    if(isset($_POST['search'])){ // search request
      // capture data from post
      $select_bank = cleanInput($_POST['bankName']);
      $cases_date_from = cleanInput($_POST['caseFrom']);
      $cases_date_upto = cleanInput($_POST['caseTo']);
      $defaulter_name = cleanInput($_POST['defaulterName']);

      // defalt search field set to false
      $select_bank_set = false;
      $defaulter_name_set = false;
      $cases_from_set = false;
      $cases_upto_set = false;

      $no_result_found_error = "We looked high and low, but your search result isn't here..";

      //validation
      if(!empty($select_bank)){ // bank selected
        if(alphaSpaceValidation($select_bank)){
          $select_bank_set = true;
          $control = 1;
        }
        else{
          $select_bank_error = 'Invalid Bank Name';
          $display_search_box = true;
          $error_occured = 1;
          $control = 1;
        }
      }

      if(!empty($defaulter_name)){ // defaulter name selected
        if(alphaSpaceValidation($defaulter_name)){
          $defaulter_name_set = true;
          $control = 1;
        }
        else{
          $defaulter_name_error = 'Invalid Name';
          $display_search_box = true;
          $error_occured = 1;
          $control = 1;
        }
      }
      
      if(!empty($cases_date_from)){ // cases_from_set
        if(dateValidation($cases_date_from)){
          $date = new DateTime($cases_date_from);
          $search_case_from = $date->format('U');
          $cases_date_from = $date->format('d-m-Y');
          $cases_from_set = true;
          $control = 1;
        }
        else{
          $cases_date_from_error = 'Invalid Date';
          $display_search_box = true;
          $error_occured = 1;
          $control = 1;
        }
      }
      
      if(!empty($cases_date_upto)){ // cases_upto_set
        if(dateValidation($cases_date_upto)){
          $date = new DateTime($cases_date_upto);
          $search_case_upto = $date->format('U');
          $cases_date_upto = $date->format('d-m-Y');
          $cases_upto_set = true;
          $control = 1;
        }
        else{
          $cases_date_upto_error = 'Invalid Date';
          $display_search_box = true;
          $error_occured = 1;
          $control = 1;
        }
      }
      if($cases_from_set && $cases_upto_set){
        if($search_case_from > $search_case_upto){
          $cases_date_from_error = 'Invalid Date';
          $display_search_box = true;
          $error_occured = 1;
          $control = 1;
        }
      }

      if(!$control){ // atleast one filter is selected
        $display_search_box = true;
        $search_box_error = 'Please select atleast one filter!';
      }
      //searching....
      if(!$error_occured){ // validation successfull
        $search_query = 1;
        $success_msg = '';
        $error_msg = '';
        $sql_1 = "SELECT * FROM car_loan WHERE bank_name = '$select_bank'";
        $sql_2 = "SELECT * FROM car_loan WHERE customer_name = '$defaulter_name'";
        $sql_3 = "SELECT * FROM car_loan WHERE bank_name = '$select_bank' AND customer_name = '$defaulter_name'";
        $sql_4 = "SELECT * FROM car_loan";
        if($select_bank_set && !$defaulter_name_set && !$cases_from_set && !$cases_upto_set){ // only bank B
          $result = $conn->query($sql_1);
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
              array_push($result_array, $row);
            }
            if(sizeof($result_array) == 0)
              $_SESSION['error_msg'] = $no_result_found_error;
            else $_SESSION['success_msg'] = 'Search results for '.$select_bank;
          }
          else $_SESSION['error_msg'] = $no_result_found_error;
        }

        else if(!$select_bank_set && $defaulter_name_set && !$cases_from_set && !$cases_upto_set){ // only defaulter name D
          $result = $conn->query($sql_2);
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
              array_push($result_array, $row);
            }
            if(sizeof($result_array) == 0)
              $_SESSION['error_msg'] = $no_result_found_error;
            else $_SESSION['success_msg'] = 'Search results for Defaulter Name : '.$defaulter_name;
          }
          else $_SESSION['error_msg'] = $no_result_found_error;
        }

        else if(!$select_bank_set && !$defaulter_name_set && $cases_from_set && !$cases_upto_set){ // Cases from F
          $result = $conn->query($sql_4);
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
              $date = new DateTime($row['case_date']);
              $epoch_time_of_case = $date->format('U');
              if($epoch_time_of_case >= $search_case_from){
                array_push($result_array, $row);
              }
            }
            if(sizeof($result_array) == 0)
              $_SESSION['error_msg'] = $no_result_found_error;
            else $_SESSION['success_msg'] = 'Search results for Cases From : '.$cases_date_from;
          }
          else $_SESSION['error_msg'] = $no_result_found_error;
        }

        else if(!$select_bank_set && !$defaulter_name_set && !$cases_from_set && $cases_upto_set){ // Cases Upto T
          $result = $conn->query($sql_4);
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
              $date = new DateTime($row['case_date']);
              $epoch_time_of_case = $date->format('U');
              if($epoch_time_of_case <= $search_case_upto){
                array_push($result_array, $row);
              }
            }
            if(sizeof($result_array) == 0)
              $_SESSION['error_msg'] = $no_result_found_error;
            else $_SESSION['success_msg'] = 'Search results for Cases upto : '.$cases_date_upto;
          }
          else $_SESSION['error_msg'] = $no_result_found_error;
        }
        
        else if($select_bank_set && !$defaulter_name_set && $cases_from_set && !$cases_upto_set){ // BF
          $result = $conn->query($sql_1);
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
              $date = new DateTime($row['case_date']);
              $epoch_time_of_case = $date->format('U');
              if($epoch_time_of_case >= $search_case_from){
                array_push($result_array, $row);
              }
            }
            if(sizeof($result_array) == 0)
              $_SESSION['error_msg'] = $no_result_found_error;
            else $_SESSION['success_msg'] = 'Search results for '.$select_bank.'<br/> Cases from : '.$cases_date_from;
          }
          else $_SESSION['error_msg'] = $no_result_found_error;
        }

        else if($select_bank_set && !$defaulter_name_set && !$cases_from_set && $cases_upto_set){ // BT
          $result = $conn->query($sql_1);
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
              $date = new DateTime($row['case_date']);
              $epoch_time_of_case = $date->format('U');
              if($epoch_time_of_case <= $search_case_upto){
                array_push($result_array, $row);
              }
            }
            if(sizeof($result_array) == 0)
              $_SESSION['error_msg'] = $no_result_found_error;
            else $_SESSION['success_msg'] = 'Search results for '.$select_bank.'<br/> Cases upto : '.$cases_date_upto;
          }
          else $_SESSION['error_msg'] = $no_result_found_error;
        }
        
        else if($select_bank_set && $defaulter_name_set && !$cases_from_set && !$cases_upto_set){ // BD
          $result = $conn->query($sql_3);
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push($result_array, $row);
            }
            if(sizeof($result_array) == 0)
              $_SESSION['error_msg'] = $no_result_found_error;
            else $_SESSION['success_msg'] = 'Search results for '.$select_bank.'<br/> Defaulter Name : '.$defaulter_name;
          }
          else $_SESSION['error_msg'] = $no_result_found_error;
        }
        
        else if(!$select_bank_set && !$defaulter_name_set && $cases_from_set && $cases_upto_set){ // FT
          $result = $conn->query($sql_4);
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
              $date = new DateTime($row['case_date']);
              $epoch_time_of_case = $date->format('U');
              if($epoch_time_of_case >= $search_case_from && $epoch_time_of_case <= $search_case_upto){
                array_push($result_array, $row);
              }
            }
            if(sizeof($result_array) == 0)
              $_SESSION['error_msg'] = $no_result_found_error;
            else $_SESSION['success_msg'] = 'Search results for Cases from : '.$cases_date_from.'<br/> Cases upto : '.$cases_date_upto;
          }
          else $_SESSION['error_msg'] = $no_result_found_error;
        }
        
        else if(!$select_bank_set && $defaulter_name_set && $cases_from_set && !$cases_upto_set){ // FD
          $result = $conn->query($sql_2);
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
              $date = new DateTime($row['case_date']);
              $epoch_time_of_case = $date->format('U');
              if($epoch_time_of_case >= $search_case_from){
                array_push($result_array, $row);
              }
            }
            if(sizeof($result_array) == 0)
              $_SESSION['error_msg'] = $no_result_found_error;
            else $_SESSION['success_msg'] = 'Search results for Cases from : '.$cases_date_from.'<br/> Defaulter Name : '.$defaulter_name;
          }
          else $_SESSION['error_msg'] = $no_result_found_error;
        }
        
        else if(!$select_bank_set && $defaulter_name_set && !$cases_from_set && $cases_upto_set){ // TD
          $result = $conn->query($sql_2);
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
              $date = new DateTime($row['case_date']);
              $epoch_time_of_case = $date->format('U');
              if($epoch_time_of_case <= $search_case_upto){
                array_push($result_array, $row);
              }
            }
            if(sizeof($result_array) == 0)
              $_SESSION['error_msg'] = $no_result_found_error;
            else $_SESSION['success_msg'] = 'Search results for Cases upto : '.$cases_date_upto.'<br/> Defaulter Name : '.$defaulter_name;
          }
          else $_SESSION['error_msg'] = $no_result_found_error;
        }
        
        else if($select_bank_set && !$defaulter_name_set && $cases_from_set && $cases_upto_set){ // BFT
          $result = $conn->query($sql_1);
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
              $date = new DateTime($row['case_date']);
              $epoch_time_of_case = $date->format('U');
              if($epoch_time_of_case >= $search_case_from && $epoch_time_of_case <= $search_case_upto){
                array_push($result_array, $row);
              }
            }
            if(sizeof($result_array) == 0)
              $_SESSION['error_msg'] = $no_result_found_error;
            else $_SESSION['success_msg'] = 'Search results for '.$select_bank.'<br/> Cases from : '.$cases_date_from.'<br/> Cases upto : '.$cases_date_upto;
          }
          else $_SESSION['error_msg'] = $no_result_found_error;
        }

        else if($select_bank_set && $defaulter_name_set && $cases_from_set && !$cases_upto_set){ // BFD
          $result = $conn->query($sql_3);
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
              $date = new DateTime($row['case_date']);
              $epoch_time_of_case = $date->format('U');
              if($epoch_time_of_case >= $search_case_from){
                array_push($result_array, $row);
              }
            }
            if(sizeof($result_array) == 0)
              $_SESSION['error_msg'] = $no_result_found_error;
            else $_SESSION['success_msg'] = 'Search results for '.$select_bank.'<br/> Cases from : '.$cases_date_from.'<br/> Defaulter Name : '.$defaulter_name;
          }
          else $_SESSION['error_msg'] = $no_result_found_error;
        }

        else if($select_bank_set && $defaulter_name_set && !$cases_from_set && $cases_upto_set){ // BTD
          $result = $conn->query($sql_3);
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
              $date = new DateTime($row['case_date']);
              $epoch_time_of_case = $date->format('U');
              if($epoch_time_of_case <= $search_case_upto){
                array_push($result_array, $row);
              }
            }
            if(sizeof($result_array) == 0)
              $_SESSION['error_msg'] = $no_result_found_error;
            else $_SESSION['success_msg'] = 'Search results for '.$select_bank.'<br/> Cases upto : '.$cases_date_upto.'<br/> Defaulter Name : '.$defaulter_name;
          }
          else $_SESSION['error_msg'] = $no_result_found_error;
        }

        else if($select_bank_set && $defaulter_name_set && $cases_from_set && $cases_upto_set){ // if all four parameters are set B F T D
          $result = $conn->query($sql_3);
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
              $date = new DateTime($row['case_date']);
              $epoch_time_of_case = $date->format('U');
              if($epoch_time_of_case >= $search_case_from && $epoch_time_of_case <= $search_case_upto){
                array_push($result_array, $row);
              }
            }
            if(sizeof($result_array) == 0)
              $_SESSION['error_msg'] = $no_result_found_error;
            else $_SESSION['success_msg'] = 'Search results for '.$select_bank.'<br/> Cases from '.$cases_date_from.'<br/>Cases upto '.$cases_date_upto.'<br/> Defaulter Name : '.$defaulter_name;
          }
          else $_SESSION['error_msg'] = $no_result_found_error;
          
        }

      }
    }
    if($error_occured || !$control){
      $sql = "SELECT * FROM car_loan";
      $result = $conn->query($sql);
      if($conn->error != ''){
          $_SESSION['error_msg'] = 'Something went wrong!';
          $db_error = $conn->error;
      }
      else if($result->num_rows == 0){
          $_SESSION['error_msg'] = 'No Car loans';
      }
      else{
        while($row = $result->fetch_assoc()){
          array_push($result_array, $row);
        }
      }
    }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require 'includes/layout.php'; ?>
  </head>
  <body>
    <!-- search - box -->
    
    <?php if(sizeof($result_array) > 0){ ?>
    <div class="black-cover-for-search-box"></div>
    <div class="search-loans-form-popup">
      <form class="pt-0" method="POST">
        <h3 class="form-inline justify-content-between">
          <span class="set-theme-color"><i class="fas fa-search"></i> Search...</span>
          <i id="close-search-popup" class="far fa-times-circle set-theme-color"></i>
        </h3>
        <div class="form-input-response mb-3">
            <?php echo $search_box_error; ?>
        </div>
            <!-- Bank-list -->
            <?php if($bank_list->num_rows > 0){ ?>
            <div class="form-group mb-3">
                <div class="row">
                    <div class="col-md-12">
                        <label for="exampleInputCity1">Bank</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-gradient-primary text-white br">
                                <i class="fas fa-university"></i>
                            </span>
                        </div>
                        <select id="bank-list" class="form-control form-input" name="bankName">
                            <option value="">All Banks</option>
                            <?php 
                                while($bank = $bank_list->fetch_assoc()){
                                  $option_selected = '';
                                  if($select_bank == $bank['bank_name']){
                                    $option_selected = 'Selected';
                                  }
                                    ?>
                                    <option <?php echo $option_selected; ?> value="<?php echo $bank['bank_name']; ?>"><?php echo $bank['bank_name']; ?></option>
                                    <?php 
                                }
                            ?>
                        </select>
                        </div>
                        <div class="form-input-response">
                            <?php echo $select_bank_error; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="form-group">
              <div class="row">
                  <div class="col-md-6">
                      <label for="exampleInputCity1">Cases From</label>
                      <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text bg-gradient-primary text-white br">
                              <i class="fas fa-clock"></i>
                          </span>
                      </div>
                      <input id="case-from" type="date" class="form-control form-input" name="caseFrom" value="<?php  ?>">
                      </div>
                      <div class="form-input-response">
                          <?php echo $cases_date_from_error; ?>
                      </div>
                  </div>
                  <script>
                      document.getElementById('case-from').defaultValue = '<?php echo $cases_date_from; ?>'
                  </script>
                  <div class="col-md-6">
                      <label for="exampleInputCity1">Cases upto</label>
                      <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text bg-gradient-primary text-white br">
                              <i class="fas fa-clock"></i>
                          </span>
                      </div>
                      <input id="case-upto" type="date" class="form-control form-input" name="caseTo" value="<?php  ?>">
                      </div>
                      <div class="form-input-response">
                          <?php echo $cases_date_upto_error; ?>
                      </div>
                  </div>
                  <script>
                      document.getElementById('case-upto').defaultValue = '<?php echo $cases_date_upto; ?>'
                  </script>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                    <label for="exampleInputCity1">Defaulter Name</label>
                    <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-gradient-primary text-white br">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control form-input" id="defaulter-name" name="defaulterName" placeholder="Name" value="<?php echo $defaulter_name; ?>">
                    </div>
                    <div class="form-input-response">
                        <?php echo $defaulter_name_error; ?>
                    </div>
                </div>
              </div>
            </div>
            <div class="form-inline justify-content-between">
                <div id="reset-search-form" class="btn btn-light">Reset</div>
                <button type="submit" name="search" class="btn btn-primary">
                  <span>Search</span>
                </button>
            </div>
      </form>
    </div>
    <?php } ?>
    <?php if($display_search_box){ ?>
      <script>
        document.getElementsByClassName('search-loans-form-popup')[0].style.display = 'block'
        document.getElementsByClassName('black-cover-for-search-box')[0].style.display = 'block'
      </script>
    <?php } ?>
    <!-- search - box end -->

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
                    Car Loans 
                    <div class="form-inline">
                      <!-- table scroll btn -->
                      <div class="table-scroll-btn-container">
                        <?php if(sizeof($result_array) > 0){ ?>
                        <div class="table-scroll-btn">
                          <span id="scroll-to-left-end-of-div">
                              <i  class="fas fa-chevron-circle-left"></i>
                          </span>
                          <span id="scroll-to-right-end-of-div" >
                              <i class="fas fa-chevron-circle-right"></i>
                          </span>
                        </div>
                        <?php } ?>
                      </div>
                      
                      <?php if(sizeof($result_array) > 0){ ?>
                      <button id="show-search-popup" class="btn btn-primary">
                          <i class="fas fa-search"></i> 
                          Search
                      </button>
                      <?php } ?>
                    </div>
                    </h4>
            
                
                    <!-- Flash Message  -->
                    <?php require 'includes/flash-message.php'; ?>

                    <div class="table-container">

                    <!--
                    <p class="card-description"> Add class <code>.table-hover</code>
                    </p>
                    -->
                    <?php if($db_error == ''){ ?>
                        <?php if(sizeof($result_array) > 0){ ?>
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th>S No</th>
                                  <th>Case Date</th>
                                  <th>Bank Name</th>
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
                                  <th>Activity</th>
                                  <th>Edit</th>
                                  
                                  <?php if($logged_in_user_role != '0'){ ?>
                                  <th>Remarks</th>
                                  <th>Delete</th>
                                  <?php } ?>
                                </tr>
                              </thead>

                            <tbody>
                            <?php 
                                $serial_no = 1;
                                foreach ($result_array as $car_loan){
                                    $encoded_cid = base64_encode($car_loan['car_loan_cid']);
                                    $date = $car_loan['case_date'];
                                    $case_date = new DateTime($date);
                                    $date = $car_loan['npa_date'];
                                    $npa_date = new DateTime($date);
                                    $date = $car_loan['notice13_sent_on'];
                                    $notice13_sent_on = new DateTime($date);
                                    ?>
                                    <tr>
                                      <td><?php echo $serial_no; ?></td>
                                      <td class="case-date"><?php echo $car_loan['case_date']!= '0000-00-00'? $case_date->format('d-m-Y') : '-'; ?></td>
                                      <td class="bank"><?php echo $car_loan['bank_name']; ?></td>
                                      <td><?php echo $car_loan['home_branch']; ?></td>
                                      <td><?php echo $car_loan['account_number']; ?></td>
                                      <td class="borrower text-capitalize"><?php echo $car_loan['customer_name']; ?></td>
                                      <td><?php echo $car_loan['npa_date']!= '0000-00-00'? $npa_date->format('d-m-Y') : '-'; ?></td>
                                      <td><?php echo $car_loan['outstanding']; ?></td>
                                      <td><?php echo $car_loan['arr_co_nd']; ?></td>
                                      <td><?php echo $car_loan['notice13_sent_on']!= '0000-00-00'? $notice13_sent_on->format('d-m-Y') : '-'; ?></td>
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
                                      <td class="text-capitalize"><?php echo $car_loan['co_applicant_name']; ?></td>
                                      <td><?php echo $car_loan['co_applicant_mobile']; ?></td>
                                      <td><?php echo $car_loan['co_applicant_address']; ?></td>
                                      <td class="text-capitalize"><?php echo $car_loan['employer_name']; ?></td>
                                      <td><?php echo $car_loan['employer_mobile']; ?></td>
                                      <td><?php echo $car_loan['employer_address']; ?></td>
                                      <td><?php echo $car_loan['amount_recovered']; ?></td>
                                      <td><?php echo $car_loan['bill_raised']; ?></td>
                                      <td><?php echo $car_loan['payment_received']; ?></td>
                                      <td>
                                        <a href="case-activity.php?cid=<?php echo $encoded_cid; ?>&loan=2" target="_blank">Show</a>
                                      </td>
                                      <td>
                                          <a class="table-edit-op" href="edit-car-loan.php?cid=<?php echo $encoded_cid; ?>">
                                              <span>Edit</span>
                                              <i class="fas fa-edit"></i>
                                          </a>
                                      </td>
                                      
                                    <?php if($logged_in_user_role != '0'){ ?>
                                      <td>
                                          <label class="edit-btn add-reamrk-table-btn">
                                              <span>View</span>
                                              <i class="fas fa-eye"></i>
                                          </label>
                                      </td>
                                      <script>
                                          $('.add-reamrk-table-btn').eq(<?php echo $serial_no-1; ?>).click(() => {
                                            showRemarkPopup('<?php echo $encoded_cid; ?>')
                                            let caseID = document.getElementById('case-id').innerHTML
                                            let reqData = {
                                              caseID
                                            }
                                            let url = 'add-car-loan-remark.php'
                                            $.ajax({
                                                    url,
                                                    type : 'POST',
                                                    dataType : 'html',
                                                    success : (msg) => {
                                                    },
                                                    complete : (res) => {
                                                        $('#remark-response').html(res.responseText)
                                                        document.getElementById('case-remarks').style.display = 'block'
                                                    },
                                                    data : reqData
                                              })
                                          })
                                      </script>
                                      <td>
                                          <label onclick="confirmResourceDeletion('<?php echo $encoded_cid; ?>','car-loan')" class="table-delete-op mb-0" href="view-car-loans.php?cid=<?php echo $encoded_cid; ?>">
                                              <span>Delete</span>
                                              <i class="fas fa-trash-alt"></i>
                                          </label>
                                      </td>
                                    <?php } ?>
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
    <!-- End custom js for this page -->


    <!-- Remark popup -->
    <div class="remark-popup">
        <div class="remark-form">
            <div class="remark-form-content">
              <h3 class="logo-container form-inline justify-content-between mb-2">
                <span style=" font-size:18px;">Asset Reconservices</span>
                <i id="close-remark-popup" class="far fa-times-circle set-theme-color"></i>
              </h3>
              <h5 >
                <span class="set-theme-color">Date : <?php echo $current_date; ?></span>
              </h5>
              <label id="case-id"></label>
              <label for="exampleInputCity1" class="set-theme-color">
                <i class="fas fa-pen-alt"></i>
                Case Remark
              </label>
              <textarea id="given-remark" class="form-input mb-2" name="" id="" cols="30" rows="5" placeholder="Add a remark..."></textarea>
              <div id="remark-input-response" class="form-input-response mb-2"></div>
              <div class="form-inline justify-content-between mb-2">
              <button id="view-remark-direct" class="btn btn-primary">
                  Refresh
              </button>
              <button id="add-remark" class="btn btn-primary">Add</button>
              </div>
            </div>

        </div>
        <div id="remark-response">
        </div>
    </div>
    <script>
      $('#add-remark').click(()=>{
          let caseID = document.getElementById('case-id').innerHTML
          let remark = document.getElementById('given-remark').value
          document.getElementById('given-remark').value = ''
          let reqData = {
            caseID,
            remark
          }
          let url = 'add-car-loan-remark.php'
          if(remark != ''){
            $.ajax({
                url,
                type : 'POST',
                dataType : 'html',
                success : (msg) => {
                },
                complete : (res) => {
                    $('#remark-response').html(res.responseText)
                },
                data : reqData
            })
          }
          else{
            document.getElementById('remark-input-response').innerHTML = 'Remark required!'
          }
      })
      $('#view-remark-direct').click(() => {
        let caseID = document.getElementById('case-id').innerHTML
        let reqData = {
          caseID
        }
        let url = 'add-car-loan-remark.php'
        $.ajax({
                url,
                type : 'POST',
                dataType : 'html',
                success : (msg) => {
                },
                complete : (res) => {
                    $('#remark-response').html(res.responseText)
                    document.getElementById('case-remarks').style.display = 'block'
                },
                data : reqData
          })
      })
    </script>
  </body>
</html>

<!-- remark script -->
<script>
  function showRemarkPopup(caseID){
    document.getElementById('case-id').innerHTML = caseID
    document.getElementById('given-remark').value = ''
    let popup = document.getElementsByClassName('remark-popup')[0]
    popup.style.display = 'block'
  }
  $('#close-remark-popup').click(() => {
    let popup = document.getElementsByClassName('remark-popup')[0]
    popup.style.display = 'none'
    document.getElementById('given-remark').value = ''
    document.getElementById('case-id').innerHTML = ''
    document.getElementById('remark-response').innerHTML = ''
  })
</script>

<!-- search script  -->
<script>
  document.getElementById('close-search-popup').addEventListener('click', ()=>{
    document.getElementsByClassName('search-loans-form-popup')[0].style.display = 'none'
    document.getElementsByClassName('black-cover-for-search-box')[0].style.display = 'none'
  })
  document.getElementById('show-search-popup').addEventListener('click', ()=>{
    document.getElementsByClassName('search-loans-form-popup')[0].style.display = 'block'
    document.getElementsByClassName('black-cover-for-search-box')[0].style.display = 'block'
  })
</script>

<script>
  document.getElementById('reset-search-form').addEventListener('click', ()=>{
    document.getElementById('case-from').defaultValue = 'yyyy-mm-dd'
    document.getElementById('case-upto').defaultValue = 'yyyy-mm-dd'
    document.getElementById('defaulter-name').value = ''
  })
</script>

<!-- scroll table event -->

<script>
  document.getElementById('scroll-to-left-end-of-div').addEventListener('click', ()=>{
    let tableContainer = document.getElementsByClassName('table-container')[0]
    tableContainer.scroll(0,0)
  })
  document.getElementById('scroll-to-right-end-of-div').addEventListener('click', ()=>{
    let tableContainer = document.getElementsByClassName('table-container')[0]
    let tableContainerWidth = tableContainer.scrollWidth
    tableContainer.scroll(tableContainerWidth,0)
  })
</script>