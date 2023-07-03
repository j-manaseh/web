<?php
// Start the session
session_start();

// Check if user is logged in
if(!isset($_SESSION['email'])) {
  header("Location: signin.php"); // Redirect to login page if user is not logged in
  exit();
}
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'afr');

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user ID from the URL query string
$id = $_GET['id'];

// Prepare a SELECT statement to fetch the user record
$stmt = $conn->prepare("SELECT * FROM invoices WHERE invoice_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Check if a user record was found
if ($result->num_rows > 0) {
    // Fetch the user record as an associative array
    $user = $result->fetch_assoc();
} else {
    die("User not found");
}

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get the form data
    $member_id = $_POST['id'];
    $member_fname = $_POST['fname'];
    $member_lname = $_POST['lname'];
    $email = $_POST['email'];
    $subscription = $_POST['plan_name'];
    $sub_id = $_POST['sub_id'];
    $amount = $_POST['amount'];
    $status = $_POST['paid'];

    // Validate the form data
    if (empty($member_id) || empty($member_fname) || empty($member_lname) || empty($email) || empty($subscription) || empty($sub_id) || empty($amount) || empty($status)) {
        // Handle validation errors
        die("Every field MUST be filled");
    }

    // Prepare an UPDATE statement to update the user record
    $stmt = $conn->prepare("UPDATE invoices SET member_id=?, fname=?, lname=?, email=?, plan_name=?, sub_id=?, amount=?, status=? WHERE invoice_id=?");
    $stmt->bind_param("issssissi", $member_id, $member_fname, $member_lname, $email, $subscription, $sub_id, $amount, $status, $id);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        echo "Record updated successfully";
        header("Location: invoices.php");
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Edit Invoice Details </title>
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
            <div class="title">Edit Invoice Details</div>
            <div class="content">




<form method="POST">
 
  <div class="user-details">
                                                
    <div class="input-box">
        <label for="">Member ID</label>
        <input type="text" name="id" value="<?= $user['id'];?>" class="form-control" required>
    </div>

    <div class="input-box">
      <label for=""> First Name</label>
      <input type="text" name="fname" value="<?= $user['fname'];?>" class="form-control" required>
    </div>

    <div class="input-box">
      <label for=""> Last Name</label>
      <input type="text" name="lname" value="<?= $user['lname'];?>" class="form-control" required>
    </div>

    <div class="input-box">
      <label for="">Email</label>
      <input type="text" name="email" value="<?= $user['email'];?>" class="form-control" required>
    </div>

    <div class="input-box">
      <label for=""> Subscription </label>
      <input type="text" name="plan_name" value="<?= $user['plan_name'];?>" class="form-control" required>
    </div>

    <div class="input-box">
      <label for=""> Sub ID </label>
      <input type="text" name="sub_id" value="<?= $user['sub_id'];?>" class="form-control" required>
    </div>

    <div class="input-box">
      <label for="">Amount</label>
      <input type="text" name="amount" value="<?= $user['amount'];?>" class="form-control" required>
    </div>

    <div class="input-box">
      <label for="">Payment Status</label>
      <select name="paid" required class="form-control">
        <option value="">--Select Payment Status--</option>
        <option value="paid" <?= $user['paid'] == 1 ? 'selected':'';?> >Paid</option>
        <option value="unpaid" <?= $user['paid'] == 0 ? 'selected':'';?> >unpaid</option>
      </select>
    </div>

    <div class="button">
      <button name="submit" type="submit">Edit Invoice</button>
    </div>
  </div>
  
</form>
            
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
