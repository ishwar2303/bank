<?php 

  $sql = "SELECT home_loan_cid FROM home_loan";
  $home_loans_res = $conn->query($sql);
  $total_home_loan_cases = $home_loans_res->num_rows;

  $sql = "SELECT car_loan_cid FROM car_loan";
  $car_loans_res = $conn->query($sql);
  $total_car_loan_cases = $car_loans_res->num_rows;



?>
<div id="black-cover-side-navigation"></div>
<div class="sidebar-space-cover"></div>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
  <li class="nav-item nav-profile">
      <a onclick="return false" href="" class="nav-link">
        <div class="nav-profile-image">
            <img src="assets/images/faces-clipart/pic-1.png" alt="">
          <span class="login-status online"></span>
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2"><?php echo $_SESSION['user_full_name']; ?></span>
          <span class="text-secondary text-small">
            <?php
              $logged_in_user_role = $_SESSION['user_role']; 
              if($logged_in_user_role == '2')
                echo 'Admin';
              if($logged_in_user_role == '1')
                echo 'Privileged User';
              if($logged_in_user_role == '0')
                echo 'Data operator';
            ?>
          </span>
        </div>
        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php">
        <span class="menu-title">Dashboard</span>
        <i class="fas fa-chalkboard-teacher menu-icon"></i>
      </a>
    </li>
    
    <!-- <li class="nav-item">           
        <button class="btn btn-block btn-lg btn-gradient-primary ">+ Add a Bank</button>
    </li> -->
    <?php if($logged_in_user_role == '2'){ ?>
    <li class="nav-item">
      <a class="nav-link" href="create-user.php  ">
        <span class="menu-title">Create User</span>
        <i class="mdi mdi-account-plus menu-icon"></i>
      </a>
    </li>
    <?php } ?>

    <?php if($logged_in_user_role == '2'){ ?>
    <li class="nav-item">
      <a class="nav-link" href="view-users.php  ">
        <span class="menu-title">View Users</span>
        <i class="fas fa-users menu-icon"></i>
      </a>
    </li>
    <?php } ?>
    
    <li class="nav-item">
      <a class="nav-link" href="add-bank.php  ">
        <span class="menu-title">Add Bank</span>
        <i class="mdi mdi-message-plus menu-icon"></i>
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="view-banks.php  ">
        <span class="menu-title">View Banks</span>
        <i class="fas fa-university menu-icon"></i>
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="home-loan.php  ">
        <span class="menu-title">Add Home Loan</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>
    
    <?php if($total_home_loan_cases){ ?>
    <li class="nav-item">
      <a class="nav-link" href="view-home-loans.php  ">
        <span class="menu-title">View Home Loans</span>
        <i class="fas fa-eye menu-icon"></i>
      </a>
    </li>
    <?php } ?>
    
    <li class="nav-item">
      <a class="nav-link" href="car-loan.php  ">
        <span class="menu-title">Add Car Loan</span>
        <i class="mdi mdi-car menu-icon"></i>
      </a>
    </li>

    <?php if($total_car_loan_cases){ ?>
    <li class="nav-item">
      <a class="nav-link" href="view-car-loans.php  ">
        <span class="menu-title">View Car Loans</span>
        <i class="fas fa-eye menu-icon"></i>
      </a>
    </li>
    <?php } ?>

  </ul>
</nav>



<!-- custom confirmation Cancel Ok -->

<div class="custom-confirmation">
    <div>
      <div id="custom-confirmation-msg"></div>
      <div class="custom-btn-container">
        <button id="cancel" class="bg-gradient-danger">Cancel</button>
        <button id="confirm" class="bg-gradient-success">Ok</button>
      </div>
    </div>
  </div>
<div class="black-cover-for-confirmation"></div>
<!-- custom confirmation DELETE ME-->

<div class="black-cover-resource-delete"></div>
<div id="confirm-resource-delete-popup">
  <div id="confirm-resource-delete-popup-content-container">
    <i class="fas fa-trash-alt resource-delete-icon-on-popup"></i>
    <div style="display: flex; flex-direction: column; padding: 0px 15px;">
    <h5>To confirm deletion</h5>
    <label class="deleteme-label-in-popup">
    Write '<span style="color :#9a55ff; font-weight: 400;">DELETE ME</span>' in  input box
    </label>
    </div>
    <input oninput="checkUserConfirmation()" id="delete-me" type="text" name="checkDeleteConfirmation" required>
    <div class="delete-yes-no-btn-container">
      <button onclick="hideConfirmationPOPUP()" id="delete-no">Cancel</button>
      <button onclick="deleteThisResource()" id="delete-yes">Delete</button>
  </div>
  </div>
</div>



<!-- Change password popup -->

<div class="change-password-popup">
  <div class="change-password-form">
    <h4 class="set-theme-color mb-2">
    <i class="fas fa-lock" class="margin-right-icon"></i>
      Change Password
    </h4>
    <div class="form-group mt-2 mb-0">
      <div class="row">
        <div class="col-md-12">
          <label for="exampleInputCity1">New Password</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-gradient-primary text-white br">
                <i class="fas fa-key"></i>
              </span>
            </div>
            <input id="new-password" type="password" class="form-control form-input" placeholder="Password">
          </div>
        </div>
    </div>
    <div class="form-group mt-3 mb-0">
      <div class="row">
        <div class="col-md-12">
          <label for="exampleInputCity1">Confirm Password</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-gradient-primary text-white br">
                <i class="fas fa-check-double"></i>
              </span>
            </div>
            <input id="confirm-password" type="password" class="form-control form-input" placeholder="Confirm Password">
          </div>
        </div>
      </div>
    </div>
    </div>
    <div id="change-password-form-response" class="form-input-response mb-2"></div>
    <div class="form-inline justify-content-end">
      <button id="update-password" class="btn btn-primary">Update</button>
    </div>
  </div>
</div>

<div class="change-password-popup-black-cover"></div>

<!-- Change password script -->
<script>

  function showChangePasswordPopup(){
    $('.change-password-popup').slideDown()
    $('.change-password-popup-black-cover').slideDown()
    return false
  }
  $(document).ready(() => {
    $('.change-password-popup-black-cover').click(() => {
      $('.change-password-popup').slideUp()
      $('.change-password-popup-black-cover').slideUp()
    })
  })
  $('#update-password').click(() => {
    let newPassword = document.getElementById('new-password').value
    let confirmPassword = document.getElementById('confirm-password').value
    let reqData = {
      newPassword,
      confirmPassword
    }
    let url = 'change-password.php'
    $.ajax({
      url,
      type : 'POST',
      dataType : 'html',
      success : (msg) => {
      },
      complete : (res) => {
          changePasswordResponse(res.responseText)
      },
      data : reqData
    })
  })

  function changePasswordResponse(resData){
    resData = JSON.parse(resData)
    console.log(resData)
    let formResponse = document.getElementById('change-password-form-response')
    if(resData.success){
      location.href = 'login.php'
    }
    if(resData.error){
      formResponse.innerHTML = resData.error
    }
  }
</script>

<!-- Custom  confirmation DELETE ME script -->

<script type="text/javascript">
    var DeleteRESOURCEID;
    var ResourceTypeID;
    function checkUserConfirmation(){
      var x = document.getElementById('delete-me').value;
      if(x == 'DELETE ME'){
        document.getElementById('delete-yes').style.display = 'block';
      }
      else{
        document.getElementById('delete-yes').style.display = 'none';
      }
  
    }
    function deleteThisResource(){
      let URL
      if(ResourceTypeID == 'bank')
        URL = 'view-banks.php?bankId=' + DeleteRESOURCEID;
      if(ResourceTypeID == 'home-loan')
        URL = 'view-home-loans.php?cid=' + DeleteRESOURCEID;
      if(ResourceTypeID == 'car-loan')
        URL = 'view-car-loans.php?cid=' + DeleteRESOURCEID;
      if(ResourceTypeID == 'user')
        URL = 'view-users.php?user_id=' + DeleteRESOURCEID;
      if(ResourceTypeID == 'home-loan-status')
        URL = 'view-home-loans.php?status_id=' + DeleteRESOURCEID;
      location.href= URL;
    }
    function confirmResourceDeletion(RID, TID){
      DeleteRESOURCEID = RID;
      ResourceTypeID = TID;
      document.getElementById('delete-yes').style.display = 'none';
      var x = document.getElementById('delete-me');
      x.value = '';
      document.getElementById('confirm-resource-delete-popup').style.display='block';
      document.getElementsByClassName('black-cover-resource-delete')[0].style.display = 'block';
    }
    function hideConfirmationPOPUP(){
      document.getElementById('confirm-resource-delete-popup').style.display='none';
      document.getElementsByClassName('black-cover-resource-delete')[0].style.display = 'none';
    }
  </script>


<!-- Custom confirmation Cancel Ok  script-->
<script type="text/javascript">
  
  function showCustomConfirmation(msg){
    let customDialog = document.getElementsByClassName('custom-confirmation')[0]
    customDialog.style.display='block'
    let msgBlock = document.getElementById('custom-confirmation-msg')
    msgBlock.innerHTML = msg
    document.getElementsByClassName('black-cover-for-confirmation')[0].style.display='block'
  }
  function hideCustomConfirmation(){
    document.getElementsByClassName('custom-confirmation')[0].style.display='none'
    document.getElementsByClassName('black-cover-for-confirmation')[0].style.display='none'
  }
</script>


