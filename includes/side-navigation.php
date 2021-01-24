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