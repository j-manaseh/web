<?php
// Start the session
session_start();

// Check if user is logged in
if(!isset($_SESSION['email'])) {
  header("Location: signin.php"); // Redirect to login page if user is not logged in
  exit();
}


if(isset($_POST['book_class']))
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $member_id = $_POST['id'];
    $class_name = $_POST['class_name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];

      if (!empty($fname) || !empty($lname) || !empty($member_id) || !empty($class_name) || !empty($date) || !empty($time) || !empty($location)) {
         $host = "localhost";
         $dbUsername = "root";
         $dbPassword = "";
         $dbname = "afr";
     
          //creating connection
         $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
     
         if (mysqli_connect_error()) {
             die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
         } else 
           {
             $SELECT = "SELECT class_name From booked_classes WHERE class_name = ?";
             $INSERT = "INSERT Into booked_classes (fname, lname, id, class_name, date, time, location) values(?, ?, ?, ?, ?, ?, ?)";
     
             //prepare statement
             $stmt = $conn->prepare($SELECT);
             $stmt->bind_param('s', $class_name);
             $stmt->execute();
             $stmt->bind_result($class_name);
             $stmt->store_result();
             $rnum = $stmt->num_rows;
     
             if ($rnum==0) {
                 $stmt->close();
     
                 $stmt = $conn->prepare($INSERT);
                 $stmt->bind_param("ssissss", $fname, $lname, $member_id, $class_name, $date, $time, $location);
                 $stmt->execute();
                 ?>
                 <script type="text/javascript">
                 window.location.href = 'booked-classes.php';
                 </script>
                 <?php
             }
             else
             {
                $error[] = 'This email is already registered.';  
             } 
            
             
             $stmt->close();
             $conn->close();
           } 
           
     }
     else
     {
      $error[] = 'You are required to fill all fields';
      die();
     }
}
?>







<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Book a Class </title>
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
            <div class="title">Book a Class</div>
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
                                                <input type="hidden" name="class_booking_id">

                                                <div class="input-box">
                                                    <label for=""> First Name</label>
                                                    <input type="text" name="fname" class="form-control" required>
                                                </div>

                                                <div class="input-box">
                                                    <label for=""> Last Name</label>
                                                    <input type="text" name="lname" class="form-control" required>
                                                </div>

                                                <div class="input-box">
                                                    <label for="">Your member ID</label>
                                                    <input type="number" name="id" class="form-control" required placeholder="find in your profile page">
                                                </div>

                                                <div class="input-box">
                                                    <label for="">Class Name</label>
                                                    <select name="class_name" required class="form-control">
                                                        <option value="">--Select a class--</option>
                                                        <option value="Yoga" >Yoga</option>
                                                        <option value="Boxing" >Boxing</option>
                                                        <option value="Indoor Cycling" >Indoor Cycling</option>
                                                        <option value="Pilates" >Pilates</option>
                                                        <option value="Zumba Fitness" >Zumba Fitness</option>
                                                        <option value="Barre" >Barre</option>
                                                        <option value="HIIT" >HIIT</option>
                                                        <option value="UFC Gym: Fight Fit" >UFC Gym: Fight Fit</option>
                                                        <option value="CorePower Yoga: Yoga Sculpt" >CorePower Yoga: Yoga Sculpt</option>
                                                    </select>
                                                </div>

                                                <div class="input-box">
                                                    <label for="">Class Date</label>
                                                    <input type="date" name="date" class="form-control" required>
                                                </div>

                                                <div class="input-box">
                                                    <label for="">Class Time</label>
                                                    <select name="time" required class="form-control">
                                                        <option value="">--Pick the best time for your class--</option>
                                                        <option value="6:00 AM" >6:00 AM</option>
                                                        <option value="8:00 AM" >8:00 AM</option>
                                                        <option value="10:00 AM" >10:00 AM</option>
                                                        <option value="12:00 AM" >12:00 AM</option>
                                                        <option value="2:00 PM" >2:00 PM</option>
                                                        <option value="4:00 PM" >4:00 PM</option>
                                                        <option value="6:00 PM" >6:00 PM</option>
                                                        <option value="8:00 PM" >8:00 PM</option>
                                                        <option value="10:00 PM" >10:00 PM</option>
                                                    </select>
                                                </div>

                                                <div class="input-box">
                                                    <label for="">Gym Location</label>
                                                    <select name="location" required class="form-control">
                                                        <option value="">--Select your prefered gym location--</option>
                                                        <option value="Westlands" >Westlands</option>
                                                        <option value="Upperhill" >Upper Hill</option>
                                                        <option value="Kilimani" >Kilimani</option>
                                                        <option value="Lang'ata" >Lang'ata</option>
                                                        <option value="Kitisuru" >Kitisuru</option>
                                                    </select>
                                                </div>

                                                <div class="button">
                                                    <button name="book_class" type="submit">Book Class</button>
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


    