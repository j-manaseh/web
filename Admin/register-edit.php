<?php
// Start the session
session_start();

// Check if user is logged in
if(!isset($_SESSION['email'])) {
  header("Location: signin.php"); // Redirect to login page if user is not logged in
  exit();
}

@include 'config.php';


if(isset($_POST['update_user']))
{
    $id = $_GET['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $secure_pass = password_hash($password, PASSWORD_ARGON2ID);
    $plan_name = $_POST['plan_name'];
    $status = $_POST['status'];
    $account = $_POST['account_type'];

    if($password == $cpassword) {
        $query = "UPDATE members SET fname='$fname', lname='$lname', email='$email', phone='$phone', gender='$gender', password='$secure_pass', plan_name='$plan_name', status='$status', account_type='$account'
                WHERE id=$id ";
        $query_run = mysqli_query($conn, $query);
    
    if($query_run)
    {
        ?>
        <script type="text/javascript">
        window.location.href = 'members.php';
        </script>
        <?php 
    }
    else
    {
        $error[] = 'User Record Update Unsuccessfull.'; 
    }
    }
    else
    {
      $error[] = 'Your Passwords Do Not Match';
    }

    

}


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Edit Member Details</title>
    <link rel="stylesheet" href="sidebar.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
<div class="sidebar close">
        <div class="logo-details">
          <img src="images/5f623cfd2a7b46a69e5766d4e9d8868f.png" alt="">
          <span class="logo_name"> AFR H&F CENTER</span>
        </div>
        <ul class="nav-links">
          <li>
            <div class="iocn-link">
              <a href="members.php">
                <i class='bx bx-user-pin'></i>
                <span class="link_name">Members</span>
              </a>
              <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="members.php">Members</a></li>
              <li><a href="members.php">All Members</a></li>
              <li><a href="active.php">Active Members</a></li>
              <li><a href="inactive.php">Inactive Members</a></li>
            </ul>
          </li>
          <li>
            <a href="plans.php">
              <i class='bx bx-group'></i>
              <span class="link_name">Membership Plans</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="plans.php">Membership Plans</a></li>
            </ul>
          </li>
          <li>
            <div class="iocn-link">
              <a href="invoices.php">
                <i class='bx bx-receipt'></i>
                <span class="link_name">Invoices</span>
              </a>
              <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="invoices.php">Invoices</a></li>
              <li><a href="invoices.php">All Invoices</a></li>
              <li><a href="paid.php">Paid Invoices</a></li>
              <li><a href="unpaid.php">Unpaid Invoices</a></li>
            </ul>
          </li>
          <li>
            <div class="iocn-link">
              <a href="classes.php">
                <i class='bx bx-cycling'></i>
                <span class="link_name">Classes</span>
              </a>
              <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="classes.php">Classes</a></li>
              <li><a href="booked-classes.php">Booked Classes</a></li>
              <li><a href="book-class.php">Book a class</a></li>
            </ul>
          </li>
          <li>
            <div class="iocn-link">
              <a href="bookings.php">
                <i class='bx bx-spa'></i>
                <span class="link_name">Health Spa Bookings</span>
              </a>
              <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="bookings.php">Health Spa Bookings</a></li>
              <li><a href="bookings.php">All Bookings</a></li>
              <li><a href="expired-bookings.php">Expired Bookings</a></li>
            </ul>
          </li>
          <li>
            <a href="trainers.php">
              <i class='bx bx-run'></i>
              <span class="link_name">Instructors</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="instructors.php">Instructors</a></li>
            </ul>
          </li>
          <li>
            <div class="iocn-link">
              <a href="subscriptions.php">
                <i class='bx bx-credit-card'></i>
                <span class="link_name">Subscriptions</span>
              </a>
              <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="subscriptions.php">Subscriptions</a></li>
              <li><a href="subscriptions.php">All Subscriptions</a></li>
              <li><a href="expired-subscriptions.php">Expired Subscriptions</a></li>
              <li><a href="expiring-subscriptions.php">Expiring Subscriptions</a></li>
            </ul>
          </li>
          <li>
            <a href="payments.php">
              <i class='bx bx-dollar'></i>
              <span class="link_name">Payments</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="payments.php">Payments</a></li>
            </ul>
          </li>
          <li>
            <a href="payments.php">
            <i class='bx bx-dumbbell'></i>
            <span class="link_name">Equipments</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="equipments.php">Equipments</a></li>
            </ul>
          </li>
          <li>
        <div class="profile-details">
          <div class="profile-content">
            <img src="images/twists 2.jpg" alt="profileImg">
          </div>
          <div class="name-job">
            <div class="profile_name">Joshua</div>
            <div class="job">Web Designer</div>
          </div>
          <a href="logout.php" name="logout" value="logout">
            <i class='bx bx-log-out-circle'></i>
          </a>
        </div>
      </li>
    </ul>
      </div>
  
  <section class="home">
  <div class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>
      <span class="text">Admin Dashboard</span>
    </div>

    <div class="container">
            <div class="title">Edit Member Details</div>
            <div class="content">
            <?php
            if(isset($error)){
           foreach($error as $error){
           echo '<div style="padding:20px 0px;" role="alert">
                    <strong>Hey!</strong>
                    <span style="color:black; font:bold;">'.$error.'</span> 
                 </div>';
                }
            }
            ?>

            <?php
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $users = "SELECT * FROM members WHERE id='$id' ";
                $users_run = mysqli_query($conn, $users);

                if(mysqli_num_rows($users_run) > 0)
                    {
                        foreach($users_run as $user)
                        {
            }
            ?>
            


            <form method="POST">
            <input type="hidden" name="id" value="<?=$user['id'];?>">
                                            <div class="user-details">
                                                
                                                <div class="input-box">
                                                    <label for="">First Name</label>
                                                    <input type="text" name="fname" value="<?=$user['fname'];?>" class="form-control" required>
                                                </div>

                                                <div class="input-box">
                                                    <label for="">Last Name</label>
                                                    <input type="text" name="lname" value="<?=$user['lname'];?>" class="form-control" required>
                                                </div>

                                                <div class="input-box">
                                                    <label for="">Email</label>
                                                    <input type="text" name="email" value="<?=$user['email'];?>" class="form-control" required>
                                                </div>

                                                <div class="input-box">
                                                    <label for="">Phone</label>
                                                    <input type="phone" name="phone" value="<?=$user['phone'];?>" class="form-control" required>
                                                </div>

                                                <div class="input-box">
                                                    <label for="">Password</label>
                                                    <input type="password" name="password" class="form-control" required>
                                                </div>

                                                <div class="input-box">
                                                    <label for="">Confirm Password</label>
                                                    <input type="password" name="cpassword" class="form-control" required>
                                                </div>

                                                <div class="input-box">
                                                    <label for="">Gender</label>
                                                    <select name="gender" required class="form-control">
                                                        <option value="">--Select Gender--</option>
                                                        <option value="m" <?= $user['gender'] == 'male' ? 'selected':'';?> >Male</option>
                                                        <option value="f" <?= $user['gender'] == 'female' ? 'selected':'';?> >Female</option>
                                                        <option value="o" <?= $user['gender'] == 'other' ? 'selected':'';?> >Other</option>
                                                    </select>
                                                </div>

                                                <div class="input-box">
                                                    <label for="">Membership Plan</label>
                                                    <select name="plan_name" required class="form-control">
                                                        <option value="">--Select Membership Plan--</option>
                                                        <option value="Basic" <?= $user['plan_name'] == 'basic' ? 'selected':'';?>>Basic</option>
                                                        <option value="Gold" <?= $user['plan_name'] == 'gold' ? 'selected':'';?>>Gold</option>
                                                        <option value="Platinum" <?= $user['plan_name'] == 'platinum' ? 'selected':'';?>>Platinum</option>
                                                    </select>
                                                </div>

                                                <div class="input-box">
                                                    <label for="">Payment Status</label>
                                                    <select name="status" required class="form-control">
                                                        <option value="">--Select Payment Status--</option>
                                                        <option value="1" <?= $user['status'] == '1' ? 'selected':'';?> >Paid</option>
                                                        <option value="0" <?= $user['status'] == '0' ? 'selected':'';?> >Not Paid</option>
                                                    </select>
                                                </div>

                                                <div class="input-box">
                                                    <label for="">Account Type</label>
                                                    <select name="account_type" required class="form-control">
                                                        <option value="">--Select Account Type--</option>
                                                        <option value="Member" <?= $user['account_type'] == 'Member' ? 'selected':'';?>>Member</option>
                                                        <option value="Receptionist" <?= $user['account_type'] == 'Receptionist' ? 'selected':'';?>>Receptionist</option>
                                                        <option value="Admin" <?= $user['account_type'] == 'Admin' ? 'selected':'';?>>Admin</option>
                                                    </select>
                                                </div>

                                                <div class="button">
                                                    <button name="update_user" type="submit">Update User</button>
                                                </div>
                                            </div>
            </form>
            <?php 
            }
                }
                else {
                    ?>
                    <h4>No Record Found</h4>
                    <?php
                }
            
            ?>

            
            </div>
        </div>
</div>
    </section>
  <script>
  let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
   let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
   arrowParent.classList.toggle("showMenu");
    });
  }
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
  console.log(sidebarBtn);
  sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
  });
  </script>
</body>
</html>


