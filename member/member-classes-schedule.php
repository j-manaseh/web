<?php
include('C:/xampp/htdocs/WEB/config.php');
// Start the session
session_start();

// Check if user is logged in
if(!isset($_SESSION['email'])) {
  header("Location: signin.php"); // Redirect to login page if user is not logged in
  exit();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Class Schedules </title>
    <link rel="stylesheet" href="member-sidebar.css">
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
      <span class="text">Member Dashboard</span>
    </div>

    <div class="container">
            <div class="title">Our Class Schedules</div>
            <div class="content">
            <div class="attendance-list">
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
            <div class="heading">
              <button class="btn"><a href="member-book-class.php" >Book a Class</a></button>
            </div>
          <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Class Name</th>
                    <th>Instructor</th>
                    <th>Start Time </th>
                    <th>End Time </th>
                    <th>Day of Week</th>
                    <th>Room Number</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM classes_schedule";
                $query_run = mysqli_query($conn, $query);

                if(mysqli_num_rows($query_run) > 0)
                {
                    foreach($query_run as $row)
                    {
                        ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= $row['class_name']; ?></td>
                            <td><?= $row['instructor_name']; ?></td>
                            <td><?= $row['start_time']; ?></td>
                            <td><?= $row['end_time']; ?></td>
                            <td><?= $row['day_of_week']; ?></td>
                            <td><?= $row['room_number']; ?></td>
                        </tr>
                        <?php
                    }

                }
                else{
                    ?>
                       <tr>
                        <td colspan="6">No Record Found</td>
                       </tr>
                    <?php
                }
                ?>
                
            </tbody>
          </table>
        </div>
            </div>
            <?php
          } else {
      echo "Your account is -<strong>INACTIVE</strong>!- Please pay for your membership to access all our features.";


        ?>
 <?php
    }
} else {
    echo "User not found";
}

// Close the database connection
mysqli_close($conn);
?>
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


   