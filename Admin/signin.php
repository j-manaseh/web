<?php
@include 'config.php';

session_start();

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = mysqli_connect("localhost", "root", "", "afr");
    if(mysqli_connect_errno()) {
        die("Failed to connect: " . mysqli_connect_error());
    }

    $stmt = $conn->prepare("SELECT * FROM members WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        if(password_verify($password, $data['password'])) {
            $_SESSION['email'] = $data['email'];
            $account_type = $data['account_type'];
            if ($account_type == 'Member') {
              header('location:member-t.php');
              exit();
            } elseif ($account_type == 'Receptionist') {
              header('location:t2.php');
              exit();
            } elseif ($account_type == 'Admin') {
              header('location:t.php');
              exit();
            } else {
              $error[] = 'Invalid account type.';
            }
        } else {
            $error[] = 'Invalid email or password.';
        }
    } else {
        $error[] = 'Invalid email or password.';
    }

    $stmt->close();
    mysqli_close($conn);
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<div class="form-container">

    <form action="" method="post">
        <h3 class="title">login now</h3>
        <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span style="color:white">'.$error.'</span>';
            }
         }
        ?>
        <input type="email" name="email" placeholder="enter your email" class="box" required>
        <input type="password" name="password" placeholder="enter your password" class="box" required>
        <input type="submit" value="login now" class="form-btn" name="submit">
        <p>Don't have an account? <a href="register.php">Register Now!</a></p>
        <p class="back">back to website? <a href="index.html">Home</a></p>
    </form>

</div>

</body>
</html>
