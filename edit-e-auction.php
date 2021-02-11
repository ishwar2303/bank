<?php 
    session_start();
    require_once('connection.php');
    require_once('middleware.php');
    

    if(!isset($_SESSION['user_role'])){ // all access
      $_SESSION['error_msg'] = 'Sign In to view that resource';
      header('Location: login.php');
      exit;
    }

    if(isset($_GET['eaid'])){
        $e_auction_id = base64_decode(cleanInput($_GET['eaid']));

        $sql = "SELECT * FROM e_auction WHERE e_auction_id = '$e_auction_id'";
        $result = $conn->query($sql);

        if($result->num_rows == 0){
            $_SESSION['error_msg'] = 'Something went wrong!';
            header('Location: index.php');
            exit;
        }

        $row = $result->fetch_assoc();
        $bank_name = $row['bank_name'];
        $branch_address = $row['branch_address'];
        $borrower_name = $row['borrower_name'];
        $address_of_mortgaged_property = $row['property_address'];
        $sold_price = $row['sold_price'];
        $bidder_name = $row['bidder_name'];
        $branch_address = str_replace("<br/>", "\n", $branch_address);
        $address_of_mortgaged_property = str_replace("<br/>", "\n", $address_of_mortgaged_property);

    }
    else{
        $_SESSION['error_msg'] = 'Something went wrong!';
        header('Location: index.php');
        exit;
    }

    $bank_name_error = '';
    $branch_address_error = '';
    $borrower_name_error = '';
    $address_of_mortgaged_property_error = '';
    $sold_price_error = '';
    $bidder_name_error = '';
    

    if(isset($_POST['bankName']) && isset($_POST['branchAddress']) && isset($_POST['borrowerName']) && isset($_POST['propertyAddress']) && isset($_POST['soldPrice']) && isset($_POST['bidderName'])){

        $bank_name = cleanInput($_POST['bankName']);
        $branch_address = cleanInput($_POST['branchAddress']);
        $sold_price = cleanInput($_POST['soldPrice']);
        $address_of_mortgaged_property = cleanInput($_POST['propertyAddress']);
        $bidder_name = cleanInput($_POST['bidderName']);
        $borrower_name = cleanInput($_POST['borrowerName']);

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

        if(!empty($branch_address)){
            if(!addressValidation($branch_address)){
                $branch_address_error = 'Invalid address';
                $control = 0;
            }
        }
        else{
            $branch_address_error = 'Branch address required';
            $control = 0;
        }
        
        if(!empty($address_of_mortgaged_property)){
          if(!addressValidation($address_of_mortgaged_property)){
              $address_of_mortgaged_property_error = 'Invalid address';
              $control = 0;
          }
        }
        else{
            $address_of_mortgaged_property_error = 'Address required';
            $control = 0;
        }

        if(!empty($borrower_name)){
          if(!alphaSpaceValidation($borrower_name)){
              $borrower_name_error = 'Invalid name';
              $control = 0;
          }
        }
        else{
            $borrower_name_error = 'Name required';
            $control = 0;
        }

        if(!empty($bidder_name)){
            if(!alphaSpaceValidation($bidder_name)){
                $bidder_name_error = 'Invalid name';
                $control = 0;
            }
        }
        else{
            $bidder_name_error = 'Name required';
            $control = 0;
        }

        if(!empty($sold_price)){
          if(!amountValidation($sold_price)){
              $sold_price_error = 'Invalid amount';
              $control = 0;
          }
        }
        else{
            $sold_price_error = 'Amount required';
            $control = 0;
        }

        if($control){

            $branch_address = str_replace("\n", "<br/>", $branch_address);
            $address_of_mortgaged_property = str_replace("\n", "<br/>", $address_of_mortgaged_property);
            $sql = "INSERT INTO `e_auction` (`e_auction_id`, `bank_name`, `branch_address`, `borrower_name`, `property_address`, `sold_price`, `bidder_name`) VALUES (NULL, '$bank_name', '$branch_address', '$borrower_name', '$address_of_mortgaged_property', '$sold_price', '$bidder_name')";
            $sql = "UPDATE e_auction SET
            bank_name = '$bank_name', 
            branch_address = '$branch_address', 
            borrower_name = '$borrower_name', 
            property_address = '$address_of_mortgaged_property', 
            sold_price = '$sold_price', 
            bidder_name = '$bidder_name'
            WHERE e_auction_id = '$e_auction_id'";

            if($conn->query($sql) === TRUE){

              $_SESSION['success_msg'] = 'E-Auction Details updated successfully';
              header('Location: index.php');
              exit;
            }
            else{
                $_SESSION['error_msg'] = 'Something went wrong!';
                header('Location: index.php');
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
              <div class="col-12 grid-margin stretch-card mb-0">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add E-Auction Details</h4>
                
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
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="exampleTextarea1">Branch Address</label>
                            <textarea class="form-control form-input" name="branchAddress" id="exampleTextarea1" rows="6"><?php echo $branch_address; ?></textarea>
                            <div class="form-input-response">
                                <?php echo $branch_address_error; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="exampleInputCity1">Borrower Name</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white br"><i class="fa fa-user"></i></span>
                              </div>
                              <input type="text" class="form-control form-input" name="borrowerName" value="<?php echo $borrower_name; ?>" placeholder="Name">
                            </div>
                            <div class="form-input-response">
                                <?php echo $borrower_name_error; ?>
                            </div>
                          </div>
                        </div>
                      </div>  
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="exampleTextarea1">Address of Mortgaged Property</label>
                            <textarea class="form-control form-input" name="propertyAddress" id="exampleTextarea1" rows="6"><?php echo $address_of_mortgaged_property; ?></textarea>
                            <div class="form-input-response">
                                <?php echo $address_of_mortgaged_property_error; ?>
                            </div>
                          </div>
                        </div>
                      </div>   
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="exampleInputCity1">Sold Price</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white br"><i class="fas fa-rupee-sign"></i></span>
                              </div>
                              <input type="number" step="0.000001" class="form-control form-input" name="soldPrice" value="<?php echo $sold_price; ?>" placeholder="Amount">
                            </div>
                            <div class="form-input-response">
                                <?php echo $sold_price_error; ?>
                            </div>
                          </div>
                        </div>
                      </div>  
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="exampleInputCity1">Bidder Name</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white br"><i class="fa fa-user"></i></span>
                              </div>
                              <input type="text" class="form-control form-input" name="bidderName" value="<?php echo $bidder_name; ?>" placeholder="Name">
                            </div>
                            <div class="form-input-response">
                                <?php echo $bidder_name_error; ?>
                            </div>
                          </div>
                        </div>
                      </div>           
                      <div class="form-inline justify-content-between"> 
                        <button class="btn btn-light" type="reset" >Reset</button>
                        <button type="submit" class="btn btn-gradient-primary mr-2">Update</button>
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