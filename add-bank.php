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
    else{
        $_SESSION['error_msg'] = 'Sign In to view that resource';
        header('Location: login.php');
        exit;
    }

    $bank_name = '';
    $bank_branch = '';
    $bank_state = '';
    $bank_city = '';
    $bank_address = '';
    $bank_contact_person_name = '';
    $bank_contact_person_number = '';
    $bank_name_error = '';
    $bank_branch_error = '';
    $bank_state_error = '';
    $bank_city_error = '';
    $bank_address_error = '';
    $bank_contact_person_name_error = '';
    $bank_contact_person_number_error = '';
    

    if(isset($_POST['bankName']) && isset($_POST['bankBranch']) && isset($_POST['bankState']) && isset($_POST['bankCity']) && isset($_POST['bankAddress']) && isset($_POST['bankContactPersonName']) && isset($_POST['bankContactPersonNumber'])){

        $bank_name = cleanInput($_POST['bankName']);
        $bank_branch = cleanInput($_POST['bankBranch']);
        $bank_state = cleanInput($_POST['bankState']);
        $bank_city = cleanInput($_POST['bankCity']);
        $bank_address = cleanInput($_POST['bankAddress']);
        $bank_contact_person_name = cleanInput($_POST['bankContactPersonName']);
        $bank_contact_person_number = cleanInput($_POST['bankContactPersonNumber']);
        $control = 1;

        if(!empty($bank_name)){
            if(!alphaSpaceValidation($bank_name)){
                $bank_name_error = 'Invalid name';
                $control = 0;
            }
            else{
              $bank_name = strtoupper($bank_name);
            }
        }
        else{
            $bank_name_error = 'Bank name required';
            $control = 0;
        }

        if(!empty($bank_branch)){
            if(!alphaSpaceValidation($bank_branch)){
                $bank_branch_error = 'Invalid name';
                $control = 0;
            }
        }
        else{
            $bank_branch_error = 'Branch name required';
            $control = 0;
        }
        
        if(!empty($bank_state)){
          if(!alphaSpaceValidation($bank_state)){
              $bank_state_error = 'Invalid state name';
              $control = 0;
          }
        }
        else{
            $bank_state_error = 'State required';
            $control = 0;
        }

        if(!empty($bank_city)){
            if(!alphaSpaceValidation($bank_city)){
                $bank_city_error = 'Invalid name';
                $control = 0;
            }
        }
        else{
            $bank_city_error = 'City required';
            $control = 0;
        }

        if(!empty($bank_address)){
            if(!addressValidation($bank_address)){
                $bank_address_error = 'Invalid address';
                $control = 0;
            }
        }
        else{
            $bank_address_error = 'Address required';
            $control = 0;
        }

        if(!empty($bank_contact_person_name)){
            if(!alphaSpaceValidation($bank_contact_person_name)){
                $bank_contact_person_name_error = 'Invalid name';
                $control = 0;
            }
        }
        // else{
        //     $bank_contact_person_name_error = 'Name required';
        //     $control = 0;
        // }

        if(!empty($bank_contact_person_number)){
            if(!contactValidation($bank_contact_person_number)){
                $bank_contact_person_number_error = 'Invalid contact';
                $control = 0;
            }
        }
        // else{
        //     $bank_contact_person_number_error = 'Contact required';
        //     $control = 0;
        // }
        
        // $sql = "SELECT bank_id FROM bank WHERE bank_name = '$bank_name' AND bank_branch = '$bank_branch' AND bank_contact_person_name = '$bank_contact_person_name'";
        // $result = $conn->query($sql);

        // if($conn->error == ''){
        //   if($result->num_rows > 0){
        //     $_SESSION['error_msg'] = 'Similar bank details exist';
        //     $control = 0;
        //   }
        // }
        // else{
        //   $_SESSION['error_msg'] = 'Something went wrong!';
        // }

        if($control){
            $sql = "INSERT INTO `bank` (`bank_id`, `bank_name`, `bank_branch`, `bank_state`, `bank_city`, `bank_address`, `bank_contact_person_name`, `bank_contact_person_number`) VALUES (NULL, '$bank_name', '$bank_branch', '$bank_state', '$bank_city', '$bank_address', '$bank_contact_person_name', '$bank_contact_person_number')";
            $conn->query($sql);

            if($conn->error == ''){
                $_SESSION['success_msg'] = 'Bank added successfully';
                header('Location: add-bank.php');
                exit;
            }
            else{
                $_SESSION['error_msg'] = 'Something went wrong!';
                header('Location: add-bank.php');
                exit;
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
                
                    <!-- Flash Message  -->
                    <?php require 'includes/flash-message.php'; ?>

                    <form class="forms-sample" method="POST">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="exampleInputName1">Bank Name</label>
                            <div class="input-group">
                              <div class="input-group-prepend ">
                                <span class="input-group-text bg-gradient-primary text-white br"><i class="fas fa-university"></i></span>
                              </div>
                              <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control form-input" name="bankName" value="<?php echo $bank_name; ?>" placeholder="Bank Name">
                            </div>
                            <div class="form-input-response">
                                <?php echo $bank_name_error; ?>
                            </div>
                          </div>
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
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="exampleInputCity1">Bank State</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white br"><i class="fab fa-stripe-s"></i></span>
                              </div>
                              <input type="text" class="form-control form-input" name="bankState" value="<?php echo $bank_state; ?>" placeholder="State">
                            </div>
                            <div  class="form-input-response">
                                <?php echo $bank_state_error; ?>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label for="exampleInputCity1">Bank City</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white br"><i class="fa fa-map-marker-alt"></i></span>
                              </div>
                              <input type="text" class="form-control form-input" name="bankCity" value="<?php echo $bank_city; ?>" placeholder="City Name">
                            </div>
                            <div class="form-input-response">
                                <?php echo $bank_city_error; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="exampleTextarea1">Address</label>
                            <textarea class="form-control form-input" name="bankAddress" id="exampleTextarea1" rows="6"><?php echo $bank_address; ?></textarea>
                            <div class="form-input-response">
                                <?php echo $bank_address_error; ?>
                            </div>
                          </div>
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
                              <input type="text" class="form-control form-input" name="bankContactPersonName" value="<?php echo $bank_contact_person_name; ?>" placeholder="Name">
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
                              <input type="number" class="form-control form-input" name="bankContactPersonNumber" value="<?php echo $bank_contact_person_number; ?>" placeholder="Number">
                            </div>
                            <div class="form-input-response">
                                <?php echo $bank_contact_person_number_error; ?>
                            </div>
                          </div>
                        </div>
                      </div>              
                      <div class="form-inline justify-content-between"> 
                        <button class="btn btn-light" type="reset" >Reset</button>
                        <button type="submit" class="btn btn-gradient-primary mr-2">Add</button>
                      </div>
                    </form>
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