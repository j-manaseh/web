<?php
// Start the session
session_start();

// Check if user is logged in
if(!isset($_SESSION['email'])) {
  header("Location: signin.php"); // Redirect to login page if user is not logged in
  exit();
}

if(isset($_POST['add_class']))
{
    $class_name = $_POST['class_name'];
    $description = $_POST['description'];
    $trainer = $_POST['instructor_name'];

      if (!empty($class_name) || !empty($description) || !empty($trainer)) {
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
             $SELECT = "SELECT class_name From classes Where class_name = ? Limit 1";
             $INSERT = "INSERT Into classes (class_name, description, instructor_name) values(?, ?, ?)";
     
             //prepare statement
             $stmt = $conn->prepare($SELECT);
             $stmt->bind_param("s", $class_name);
             $stmt->execute();
             $stmt->bind_result($class_name);
             $stmt->store_result();
             $rnum = $stmt->num_rows;
     
             if ($rnum==0) {
                 $stmt->close();
     
                 $stmt = $conn->prepare($INSERT);
                 $stmt->bind_param("sss", $class_name, $description, $trainer);
                 $stmt->execute();
                 ?>
                 <script type="text/javascript">
                 window.location.href = 'classes.php';
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
    <title> Add New Fitness Class </title>
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
            <div class="title">Add New Class</div>
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
                                                <input type="hidden" name="class_id">
                                                <div class="input-box">
                                                    <label for="">Class Name</label>
                                                    <input type="text" name="class_name" class="form-control" required>
                                                </div>

                                                <div class="input-box">
                                                    <label for="">Class Description</label>
                                                    <input type="text" name="description" class="form-control" required>
                                                </div>

                                                <div class="input-box">
                                                    <label for="">Head Instructor</label>
                                                    <input type="text" name="instructor_name" class="form-control" required>
                                                </div>

                                                <div class="button">
                                                    <button name="add_class" type="submit">Add Class</button>
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


    