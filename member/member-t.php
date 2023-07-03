<?php
// Start the session
session_start();

// Check if user is logged in
if(!isset($_SESSION['email'])) {
  header("Location: signin.php"); // Redirect to login page if user is not logged in
  exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>User Profile</title>
	<link rel="stylesheet" href="member-t.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>
    <div class="sidebar close">
        <div class="logo-details">
          <img src="images/5f623cfd2a7b46a69e5766d4e9d8868f.png" alt="">
          <span class="logo_name"> AFR H&F CENTER</span>
        </div>
        <ul class="nav-links">
          <li>
            <a href="member-t.php">
              <i class='bx bx-user-pin'></i>
              <span class="link_name">User Profile</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="member-t.php">User Profile</a></li>
            </ul>
          </li>
          <li>
            <div class="iocn-link">
              <a href="member-invoices.php">
                <i class='bx bx-receipt'></i>
                <span class="link_name">Invoices</span>
              </a>
              <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="member-invoices.php">Invoices</a></li>
              <li><a href="member-invoices.php">All Invoices</a></li>
              <li><a href="member-paid.php">Paid Invoices</a></li>
              <li><a href="member-unpaid.php">Unpaid Invoices</a></li>
            </ul>
          </li>
          <li>
            <div class="iocn-link">
              <a href="member-classes.php">
                <i class='bx bx-cycling'></i>
                <span class="link_name">Classes</span>
              </a>
              <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="member-classes.php">Classes</a></li>
              <li><a href="member-booked-classes.php">Booked Classes</a></li>
              <li><a href="member-book-class.php">Book a class</a></li>
            </ul>
          </li>
          <li>
            <div class="iocn-link">
              <a href="member-bookings.php">
                <i class='bx bx-spa'></i>
                <span class="link_name">Health Spa Bookings</span>
              </a>
              <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="member-bookings.php">Health Spa Bookings</a></li>
              <li><a href="member-bookings.php">All Bookings</a></li>
              <li><a href="member-expired-bookings.php">Expired Bookings</a></li>
            </ul>
          </li>
          <li>
            <a href="member-trainers.php">
              <i class='bx bx-run'></i>
              <span class="link_name">Instructors</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="member-instructors.php">Instructors</a></li>
            </ul>
          </li>
          <li>
            <a href="member-payments.php">
              <i class='bx bx-dollar'></i>
              <span class="link_name">Payments</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="member-payments.php">Payments</a></li>
            </ul>
          </li>
          <li>
            <a href="member-equipments.php">
            <i class='bx bx-dumbbell'></i>
            <span class="link_name">Equipments</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="member-equipments.php">Equipments</a></li>
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
            <span class="text">User Profile Details</span>
          </div>


<div class="wrapper">
<?php 
// Connect to the database
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "afr";

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Retrieve user information from the database based on email
$email = $_SESSION['email'];
$sql = "SELECT * FROM members WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
    
    // Check if user status is active
    if ($user['status'] == 1) {
?>

        <div class="wrapper">
            <div class="left">
                <img src="images/5f623cfd2a7b46a69e5766d4e9d8868f.png" alt="user" width="100">
                <h4><?php echo $user['fname']; echo $user['lname']; ?></h4>
                <p>Admin</p>
            </div>
            <div class="right">
                <div class="info">
                    <h3>Information</h3>
                    <div class="info_data">
                        <div class="data">
                            <h4>Email</h4>
                            <p><?php echo $user['email']; ?></p>
                        </div>
                        <div class="data">
                            <h4>Phone</h4>
                            <p><?php echo $user['phone']; ?></p>
                        </div>
                        <div class="data">
                            <h4>Member ID</h4>
                            <p><?php echo $user['id']; ?></p>
                        </div>
                    </div>
                </div>

                <div class="projects">
                    <div class="projects_data">
                        <div class="data">
                            <h4>Membership Plan</h4>
                            <p><?php echo $user['plan_name']; ?></p>
                        </div>
                        <div class="data">
                            <h4>Membership Status</h4>
                            <p><?php echo ($user['status'] == 1) ? "Active" : "Inactive"; ?></p>
                        </div>

                        <div class="data">
                            <h4>Gender</h4>
                            <p><?php echo ($user['gender'] == 'm') ? "Male" : (($user['gender'] == 'f') ? "Female" : "Other"); ?></p>
                        </div>
                    </div>
                </div>

                <div class="heading">
                <div class="social_media">
                  <ul>
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                  </ul>
                </div>
                <form action="member-register-edit.php?id=<?= $user['id']; ?>" method="POST">
                  <button type="submit" name="edit_profile" value="<?= $user['id']; ?>" style="border-radius: 5px;
        border: none;
        color: #fff;
        font-size: 15px;
        font-weight: 400;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: linear-gradient(-135deg, #71b7e6, #9b59b6);
        padding: 10px;">Edit Profile Details</button>
                </form>
                </div>
            </div>
        </div>

<?php
    } else {
      echo "Your account is -<strong>INACTIVE</strong>!- Please pay for your membership to access all our features.";


        ?>

        <div class="wrapper" style="padding-top: 20px;">
            <div class="left">
                <img src="images/IMG_20220511_000038.jpg" alt="user" width="100">
                <h4><?php echo $user['fname']; ?></h4>
                <p>Admin</p>
            </div>
            <div class="right">
                <div class="info">
                    <h3>Information</h3>
                    <div class="info_data">
                        <div class="data">
                            <h4>Email</h4>
                            <p><?php echo $user['email']; ?></p>
                        </div>
                        <div class="data">
                            <h4>Phone</h4>
                            <p><?php echo $user['phone']; ?></p>
                        </div>
                        <div class="data">
                            <h4>Member ID</h4>
                            <p><?php echo $user['id']; ?></p>
                        </div>
                    </div>
                </div>

                <div class="projects">
                    <div class="projects_data">
                        <div class="data">
                            <h4>Membership Plan</h4>
                            <p><?php echo $user['plan_name']; ?></p>
                        </div>
                        <div class="data">
                            <h4>Membership Status</h4>
                            <p><?php echo ($user['status'] == 1) ? "Active" : "Inactive"; ?></p>
                        </div>

                        <div class="data">
                            <h4>Gender</h4>
                            <p><?php echo ($user['gender'] == 'm') ? "Male" : (($user['gender'] == 'f') ? "Female" : "Other"); ?></p>
                        </div>
                    </div>
                </div>

                <div class="heading">
                <div class="social_media">
                  <ul>
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                  </ul>
                </div>
                <form action="register-edit.php?id=<?= $user['id']; ?>" method="POST">
                  <button class="profile" type="submit" name="edit_profile" value="<?= $user['id']; ?>" style="border-radius: 5px;
        border: none;
        color: #fff;
        font-size: 15px;
        font-weight: 400;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: linear-gradient(-135deg, #71b7e6, #9b59b6);
        padding: 10px;">Edit Profile Details</button>
                </form>
                </div>
            </div>
        </div>

<?php
    }
} else {
    echo "User not found";
}

// Close the database connection
mysqli_close($conn);
?>

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