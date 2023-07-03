<?php
// Start the session
session_start();

// Check if user is logged in
if(!isset($_SESSION['email'])) {
  header("Location: signin.php"); // Redirect to login page if user is not logged in
  exit();
}

$errors = [];

if(isset($_POST['add_user']))
{
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $gender = trim($_POST['gender']);
    $password = trim($_POST['password']);
    $cpassword = trim($_POST['cpassword']);
    $plan_name = trim($_POST['plan_name']);
    $status = trim($_POST['status']);
    $account_type = trim($_POST['account_type']);

    if($password != $cpassword) {
        $errors[] = 'Your Passwords Do Not Match';
    }

    if (empty($fname) || empty($lname) || empty($email) || empty($gender) || empty($password) || empty($phone) || empty($plan_name) || empty($status) || empty($account_type)) {
        $errors[] = 'You are required to fill all fields';
    }

    if (count($errors) == 0) {
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbname = "afr";

        //creating connection
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

        if (mysqli_connect_error()) {
            die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
        } else {
            $SELECT = "SELECT email From members Where email = ? Limit 1";
            $INSERT = "INSERT INTO members (fname, lname, email, gender, password, phone, plan_name, status, date_added, account_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            //prepare statement
            $stmt = $conn->prepare($SELECT);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            $rnum = $stmt->num_rows;
            
            if ($rnum == 0) {
                $stmt->close();
            
                $secure_pass = password_hash($password, PASSWORD_ARGON2ID);
                $date_added = date("Y-m-d H:i:s");
            
                $stmt = $conn->prepare($INSERT);
                $stmt->bind_param("sssssisiss", $fname, $lname, $email, $gender, $secure_pass, $phone, $plan_name, $status, $date_added, $account_type);

                $stmt->execute();
            
                header('Location: members.php');
                exit();
            } else {
                $errors[] = 'This email is already registered.';
            }

        $stmt->close();
        $conn->close();

        }
    }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Add New User </title>
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
            <a href="t2.php">
              <i class='bx bx-user-pin'></i>
              <span class="link_name">User Profile</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="t2.php">User Profile</a></li>
            </ul>
          </li>
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
            <div class="title">Add New User</div>
            <div class="content">
            <?php
            if(isset($error)){
           foreach($error as $error){
           echo '<div style="padding:20px 0px;" role="alert">
                    <strong>Hey!</strong>
                    <span style="color:black; font:bold;">'.$error.'</span> 
                    <button class="btn-close" type="button" aria-label="close" data-bs-dismiss="alert"></button>
                 </div>';
                }
            }
            ?>


            <form method="POST">
                                            <div class="user-details">
                                                <input type="hidden" name="id">
                                                <div class="input-box">
                                                    <label for="">First Name</label>
                                                    <input type="text" name="fname" class="form-control" required>
                                                </div>

                                                <div class="input-box">
                                                    <label for="">Last Name</label>
                                                    <input type="text" name="lname" class="form-control" required>
                                                </div>

                                                <div class="input-box">
                                                    <label for="">Email</label>
                                                    <input type="text" name="email" class="form-control" required>
                                                </div>

                                                <div class="input-box">
                                                    <label for="">Gender</label>
                                                    <select name="gender" required class="form-control">
                                                        <option value="">--Select Gender--</option>
                                                        <option value="m" >Male</option>
                                                        <option value="f" >Female</option>
                                                        <option value="o" >Other</option>
                                                    </select>
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
                                                    <label for="">Phone</label>
                                                    <input type="phone" name="phone" class="form-control" required>
                                                </div>

                                                <div class="input-box">
                                                    <label for="">Membership Plan</label>
                                                    <select name="plan_name" required class="form-control">
                                                        <option value="">--Select Membership Plan--</option>
                                                        <option value="Basic" >Basic</option>
                                                        <option value="Gold" >Gold</option>
                                                        <option value="Platinum" >Platinum</option>
                                                    </select>
                                                </div>

                                                <div class="input-box">
                                                    <label for="">Payment Status</label>
                                                    <select name="status" required class="form-control">
                                                        <option value="">--Select Payment Status--</option>
                                                        <option value="1" >Paid</option>
                                                        <option value="0" >Not Paid</option>
                                                    </select>
                                                </div>

                                                <div class="input-box">
                                                    <label for="">Account Type</label>
                                                    <select name="account_type" required class="form-control">
                                                        <option value="">--Select Account Type--</option>
                                                        <option value="Member">Member</option>
                                                        <option value="Receptionist">Receptionist</option>
                                                        <option value="Admin">Admin</option>
                                                    </select>
                                                </div>

                                                <div class="button">
                                                    <button name="add_user" type="submit">Add User</button>
                                                </div>
                                            </div>
            </form>
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



