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

    $bank_name = '';
    $bank_branch = '';
    $bank_city = '';
    $bank_address = '';
    $bank_contact_person_name = '';
    $bank_contact_person_number = '';
    $bank_name_error = '';
    $bank_branch_error = '';
    $bank_city_error = '';
    $bank_address_error = '';
    $bank_contact_person_name_error = '';
    $bank_contact_person_number_error = '';
    

    function cleanInput($str){
        $str = trim($str); 
        $str = strip_tags($str); 
        $str = addslashes($str);
        return $str;
    }

    function nameValidation($name_to_validate){
        $reg_exp = "/^[a-zA-Z\s]+$/";
        return preg_match($reg_exp, $name_to_validate);
    }
    
    function addressValidation($address_to_validate){
        $reg_exp = "/^[a-zA-Z0-9\/\-\,\#\.\_\s]+$/";
        return preg_match($reg_exp, $address_to_validate);
    }

    function contactValidation($contact_to_validate){
        $reg_exp = "/^[6789][0-9]{9}$/";
        return preg_match($reg_exp, $contact_to_validate);
    }

    if(isset($_POST['bankName']) && isset($_POST['bankBranch']) && isset($_POST['bankCity']) && isset($_POST['bankAddress']) && isset($_POST['bankContactPersonName']) && isset($_POST['bankContactPersonNumber'])){

        $bank_name = cleanInput($_POST['bankName']);
        $bank_branch = cleanInput($_POST['bankBranch']);
        $bank_city = cleanInput($_POST['bankCity']);
        $bank_address = cleanInput($_POST['bankAddress']);
        $bank_contact_person_name = cleanInput($_POST['bankContactPersonName']);
        $bank_contact_person_number = cleanInput($_POST['bankContactPersonNumber']);
        $control = 1;

        if(!empty($bank_name)){
            if(!nameValidation($bank_name)){
                $bank_name_error = 'Invalid name';
                $control = 0;
            }
        }
        else{
            $bank_name_error = 'Bank name required';
            $conrol = 0;
        }

        if(!empty($bank_branch)){
            if(!nameValidation($bank_branch)){
                $bank_branch_error = 'Invalid name';
                $control = 0;
            }
        }
        else{
            $bank_branch_error = 'Branch name required';
            $conrol = 0;
        }
        
        if(!empty($bank_city)){
            if(!nameValidation($bank_city)){
                $bank_city_error = 'Invalid name';
                $control = 0;
            }
        }
        else{
            $bank_city_error = 'City required';
            $conrol = 0;
        }

        if(!empty($bank_address)){
            if(!addressValidation($bank_address)){
                $bank_address_error = 'Invalid address';
                $control = 0;
            }
        }
        else{
            $bank_address_error = 'Address required';
            $conrol = 0;
        }

        if(!empty($bank_contact_person_name)){
            if(!nameValidation($bank_contact_person_name)){
                $bank_contact_person_name_error = 'Invalid name';
                $control = 0;
            }
        }
        else{
            $bank_contact_person_name_error = 'Name required';
            $conrol = 0;
        }

        if(!empty($bank_contact_person_number)){
            if(!contactValidation($bank_contact_person_number)){
                $bank_contact_person_number_error = 'Invalid contact';
                $control = 0;
            }
        }
        else{
            $bank_contact_person_number_error = 'Contact required';
            $control = 0;
        }

        if($control){
            $sql = "INSERT INTO `bank` (`bank_id`, `bank_name`, `bank_branch`, `bank_city`, `bank_address`, `bank_contact_person_name`, `bank_contact_person_number`) VALUES (NULL, '$bank_name', '$bank_branch', '$bank_city', '$bank_address', '$bank_contact_person_name', '$bank_contact_person_number')";
            $conn->query($sql);

            if($conn->error == ''){
                $bank_name = '';
                $bank_branch = '';
                $bank_city = '';
                $bank_address = '';
                $bank_contact_person_name = '';
                $bank_contact_person_number = '';
                $_SESSION['success_msg'] = 'Bank added successfully';
            }
            else{
                $_SESSION['error_msg'] = 'Something went wrong!';
            }
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
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
                    <h4 class="card-title">Add Bank</h4>
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
                    <p class="card-description"> Bank Details </p>
                    <form class="forms-sample" method="POST">
                      <div class="form-group">
                        <label for="exampleInputName1">Bank Name</label>
                        <div class="input-group">
                          <div class="input-group-prepend ">
                            <span class="input-group-text bg-gradient-primary text-white br"><i class="fas fa-university"></i></span>
                          </div>
                          <input type="text" class="form-control form-input" name="bankName" value="<?php echo $bank_name; ?>" placeholder="Bank Name">
                        </div>
                        <div class="form-input-response">
                            <?php echo $bank_name_error; ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="exampleInputCity1">Bank Branch</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white br"><i class="fa fa-code-branch"></i></span>
                              </div>
                              <input type="text" class="form-control form-input" name="bankBranch" value="<?php echo $bank_branch; ?>" placeholder="Branch Name">
                            </div>
                            <div  class="form-input-response">
                                <?php echo $bank_branch_error; ?>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label for="exampleInputCity1">Bank City</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white br"><i class="fa fa-map-marker-alt"></i></span>
                              </div>
                              <input type="text" class="form-control form-input" name="bankCity" value="<?php echo $bank_city; ?>" placeholder="Bank Name">
                            </div>
                            <div class="form-input-response">
                                <?php echo $bank_city_error; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="exampleTextarea1">Address</label>
                        <textarea class="form-control form-input" name="bankAddress" id="exampleTextarea1" rows="6"><?php echo $bank_address; ?></textarea>
                        <div class="form-input-response">
                            <?php echo $bank_address_error; ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="exampleInputCity1">Contact Person Name</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white br"><i class="fa fa-user"></i></span>
                              </div>
                              <input type="text" class="form-control form-input" name="bankContactPersonName" value="<?php echo $bank_contact_person_name; ?>" placeholder="Bank Name">
                            </div>
                            <div class="form-input-response">
                                <?php echo $bank_contact_person_name_error; ?>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label for="exampleInputCity1">Contact Person Number</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white br"><i class="fas fa-phone-alt"></i></span>
                              </div>
                              <input type="text" class="form-control form-input" name="bankContactPersonNumber" value="<?php echo $bank_contact_person_number; ?>" placeholder="Bank Name">
                            </div>
                            <div class="form-input-response">
                                <?php echo $bank_contact_person_number_error; ?>
                            </div>
                          </div>
                        </div>
                      </div>              
                      <button type="submit" class="btn btn-gradient-primary mr-2">Add</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
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