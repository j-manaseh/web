<?php
session_start();

if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $secure_pass = password_hash($password, PASSWORD_ARGON2ID);
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $plan = $_POST['plan_name'];

    if($password == $cpassword) {
      if (!empty($fname) || !empty($lname) || !empty($email) || !empty($password) || !empty($gender) || !empty($phone)  || !empty($plan)) {
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
             $SELECT = "SELECT email From members Where email = ? Limit 1";
             $INSERT = "INSERT Into members (fname, lname, email, password, gender, phone, plan_name) values(?, ?, ?, ?, ?, ?, ?)";

             //prepare statement
             $stmt = $conn->prepare($SELECT);
             $stmt->bind_param("s", $email);
             $stmt->execute();
             $stmt->bind_result($email);
             $stmt->store_result();
             $rnum = $stmt->num_rows;

             if ($rnum==0) {
                 $stmt->close();

                 $stmt = $conn->prepare($INSERT);
                 $stmt->bind_param("sssssis", $fname, $lname, $email, $secure_pass, $gender, $phone, $plan);
                 $stmt->execute();
                 header('location:signin.php');
             }
             else{
                 $error[] = 'This email is already registered.';
             }


             $stmt->close();
             $conn->close();
           }

     }
     else {
      $error[] = 'You are required to fill all fields';
      die();
     }
    } else {
      $error[] = 'Your Passwords Do Not Match';
      }
}

?>






<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="reg.css">
</head>
<body>
    
<div class="form-container">

   <form action="" method="post">
      <h3 class="title">register now</h3>
      <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span style="color:white;">'.$error.'</span>';
            }
         }
      ?>
<div class="form-flex">
    <input type="username" name="fname" placeholder="enter your first name" class="box" required>
    <input type="username" name="lname" placeholder="enter your last name" class="box" required>
    <input type="email" name="email" placeholder="enter your email" class="box" required>
    <input type="password" name="password" placeholder="enter your password" class="box" required>
    <input type="password" name="cpassword" placeholder="confirm your password" class="box" required>
    <input type="phone" name="phone" placeholder="enter phone number" class="box" required>
    <div class="box" id="gender">
        <label for="gender">Gender</label>
        <div class="radioline">
            <label for="male" class="radio"><input type="radio" name="gender" id="male" value="m" required>  Male</label>
            <label for="female" class="radio"><input type="radio" name="gender" id="female" value="f" required>  Female</label>
            <label for="other" class="radio"><input type="radio" name="gender" id="other" value="o" required>  Other</label>
        </div>
    </div>
    <div class="box" id="plan" name=>
        <label for="plan_name">Membership Plan</label>
        <select name="plan_name" required class="form-control">
           <option value="">--Select Membership Plan--</option>
           <option value="Basic" >Basic (15000)</option>
           <option value="Gold" >Gold (23000)</option>
           <option value="Platinum" >Platinum (35000) </option>
          </select>
    </div> 
</div>

      <input type="submit" value="register now" class="form-btn" name="submit">
      <p>already have an account? <a href="signin.php">login now!</a></p>
      <p class="back">back to website? <a href="index.html">home</a></p>
   </form>

</div>

</body>
</html>