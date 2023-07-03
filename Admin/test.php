<?php
// Start the session
//session_start();

// Check if the user is logged in
//if (!isset($_SESSION['loggedin'])) {
  // Redirect the user to the login page
  //header('Location: signin.php');
  //exit;
//}
?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Profile Page </title>
    <link rel="stylesheet" href="sidebar.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="sidebar close">
    <div class="logo-details">
      <i class='bx bx-dumbbell'></i>
      <span class="logo_name"> AFR Fitness</span>
    </div>
    <ul class="nav-links">
      <li>
        <div class="iocn-link">
          <a href="sidebar.php">
            <i class='bx bx-user-pin'></i>
            <span class="link_name">Members</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="sidebar.php">Members</a></li>
          <li><a href="sidebar.php">All Members</a></li>
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
        <a href="classes.php">
          <i class='bx bx-cycling'></i>
          <span class="link_name">Classes</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="classes.php">Classes</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="bookings.php">
            <i class='bx bx-spa'></i>
            <span class="link_name">Spa Bookings</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="bookings.php">Spa Bookings</a></li>
          <li><a href="bookings.php">All Bookings</a></li>
          <li><a href="expired-bookings.php">Expired Bookings</a></li>
        </ul>
      </li>
      <li>
        <a href="trainers.php">
          <i class='bx bx-run'></i>
          <span class="link_name">Trainers</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="trainers.php">Trainers</a></li>
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
        <a href="messages.php">
        <i class='bx bx-message-square-dots'></i>
          <span class="link_name">Messages</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="messages.php">Messages</a></li>
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
        <a href="staff.php">
          <i class='bx bxs-id-card'></i>
          <span class="link_name">Staff</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="staff.php">Staff</a></li>
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
      <a href="index.html">
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
      <span class="text">Drop Down Sidebar</span>
    </div>

    <div class="wrapper">
    <div class="left">
        <img src="images/twists 2.jpg" 
        alt="user" width="100">
        <h4>Alex William</h4>
         <p>UI Developer</p>
    </div>
    <div class="right">
        <div class="info">
            <h3>Information</h3>
            <div class="info_data">
                 <div class="data">
                    <h4>Email</h4>
                    <p>alex@gmail.com</p>
                 </div>
                 <div class="data">
                   <h4>Phone</h4>
                    <p>0001-213-998761</p>
              </div>
            </div>
        </div>
      
      <div class="projects">
            <h3>Projects</h3>
            <div class="projects_data">
                 <div class="data">
                    <h4>Recent</h4>
                    <p>Lorem ipsum dolor sit amet.</p>
                 </div>
                 <div class="data">
                   <h4>Most Viewed</h4>
                    <p>dolor sit amet.</p>
              </div>
            </div>
        </div>
      
        <div class="social_media">
            <ul>
              <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
              <li><a href="#"><i class="fab fa-twitter"></i></a></li>
              <li><a href="#"><i class="fab fa-instagram"></i></a></li>
          </ul>
      </div>
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
