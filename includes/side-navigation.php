<div id="black-cover-side-navigation"></div>
<div class="sidebar-space-cover"></div>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
  <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-image">
          <img src="assets/images/faces/face1.jpg" alt="profile">
          <span class="login-status online"></span>
          <!--change to offline or busy as needed-->
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
        <i class="fas fa-tachometer-alt menu-icon"></i>
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

    <li class="nav-item">
      <a class="nav-link" href="add-bank.php  ">
        <span class="menu-title">Add Bank</span>
        <i class="mdi mdi-message-plus menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="view-banks.php  ">
        <span class="menu-title">View Banks</span>
        <i class="mdi mdi-format-list-bulleted menu-icon"></i>
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="home-loan.php  ">
        <span class="menu-title">Home Loan</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="view-home-loans.php  ">
        <span class="menu-title">View Home Loans</span>
        <i class="fas fa-eye menu-icon"></i>
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="car-loan.php  ">
        <span class="menu-title">Car Loan</span>
        <i class="mdi mdi-car menu-icon"></i>
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="view-car-loans.php  ">
        <span class="menu-title">View Car Loans</span>
        <i class="fas fa-eye menu-icon"></i>
      </a>
    </li>

  </ul>
</nav>





<!-- custom user confirmation -->

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

<!-- custom user confirmation script -->

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



