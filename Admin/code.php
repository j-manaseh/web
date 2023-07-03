<?php
include('C:/xampp/htdocs/WEB/config.php');


if(isset($_POST['user_delete']))
{
    $id = $_POST['user_delete'];
    $sql = "DELETE  FROM registration WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if($result){
        ?>
                 <script type="text/javascript">
                 window.location.href = 'active.php';
                 </script>
                 <?php
    } else {
        $error[] = "User Record Deletion Unsuccessful";
    }

}   



if(isset($_POST['active_user_delete']))
{
    $id = $_POST['active_user_delete'];
    $sql = "DELETE  FROM active_members WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if($result){
        ?>
                 <script type="text/javascript">
                 window.location.href = 'active.php';
                 </script>
                 <?php
    } else {
        $error[] = "User Record Deletion Unsuccessful";
    }

}   


if(isset($_POST['inactive_user_delete']))
{
    $id = $_POST['inactive_user_delete'];
    $sql = "DELETE  FROM inactive_members WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if($result){
        ?>
                 <script type="text/javascript">
                 window.location.href = 'inactive.php';
                 </script>
                 <?php
    } else {
        $error[] = "User Record Deletion Unsuccessful";
    }

} 



if(isset($_POST['class_delete']))
{
    $id = $_POST['class_delete'];
    $sql = "DELETE  FROM classes WHERE class_id = $id";
    $result = mysqli_query($conn, $sql);
    if($result){
        ?>
                 <script type="text/javascript">
                 window.location.href = 'classes.php';
                 </script>
                 <?php
    } else {
        $error[] = "User Record Deletion Unsuccessful";
    }

}   



if(isset($_POST['invoice_delete']))
{
    $id = $_POST['invoice_delete'];
    $sql = "DELETE  FROM invoices WHERE invoice_id = $id";
    $result = mysqli_query($conn, $sql);
    if($result){
        ?>
                 <script type="text/javascript">
                 window.location.href = 'invoices.php';
                 </script>
                 <?php
    } else {
        $error[] = "User Record Deletion Unsuccessful";
    }

}   



if(isset($_POST['plan_delete']))
{
    $id = $_POST['plan_delete'];
    $sql = "DELETE  FROM membership_plans WHERE plan_id = $id";
    $result = mysqli_query($conn, $sql);
    if($result){
        ?>
                 <script type="text/javascript">
                 window.location.href = 'plans.php';
                 </script>
                 <?php
    } else {
        $error[] = "User Record Deletion Unsuccessful";
    }

}   


if(isset($_POST['trainer_delete']))
{
    $id = $_POST['trainer_delete'];
    $sql = "DELETE  FROM trainers WHERE trainer_id = $id";
    $result = mysqli_query($conn, $sql);
    if($result){
        ?>
                 <script type="text/javascript">
                 window.location.href = 'trainers.php';
                 </script>
                 <?php
    } else {
        $error[] = "User Record Deletion Unsuccessful";
    }

}  




if(isset($_POST['booking_delete']))
{
    $id = $_POST['booking_delete'];
    $sql = "DELETE  FROM booked_classes WHERE class_booking_id = $id";
    $result = mysqli_query($conn, $sql);
    if($result){
        ?>
                 <script type="text/javascript">
                 window.location.href = 'booked-classes.php';
                 </script>
                 <?php
    } else {
        $error[] = "User Record Deletion Unsuccessful";
    }

}   






if(isset($_POST['sub_delete']))
{
    $id = $_POST['sub_delete'];
    $sql = "DELETE  FROM subscriptions WHERE sub_id = $id";
    $result = mysqli_query($conn, $sql);
    if($result){
        ?>
                 <script type="text/javascript">
                 window.location.href = 'subscriptions.php';
                 </script>
                 <?php
    } else {
        $error[] = "User Record Deletion Unsuccessful";
    }

}  



if(isset($_POST['sub_delete2']))
{
    $id = $_POST['sub_delete'];
    $sql = "DELETE  FROM subscriptions WHERE sub_id = $id";
    $result = mysqli_query($conn, $sql);
    if($result){
        ?>
                 <script type="text/javascript">
                 window.location.href = 'expired_subscriptions.php';
                 </script>
                 <?php
    } else {
        $error[] = "User Record Deletion Unsuccessful";
    }

}  



if(isset($_POST['sub_delete3']))
{
    $id = $_POST['sub_delete'];
    $sql = "DELETE  FROM subscriptions WHERE sub_id = $id";
    $result = mysqli_query($conn, $sql);
    if($result){
        ?>
                 <script type="text/javascript">
                 window.location.href = 'expiring_subscriptions.php';
                 </script>
                 <?php
    } else {
        $error[] = "User Record Deletion Unsuccessful";
    }

}  







if(isset($_POST['schedule_delete']))
{
    $id = $_POST['schedule_delete'];
    $sql = "DELETE  FROM classes_schedule WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if($result){
        ?>
                 <script type="text/javascript">
                 window.location.href = 'classes-schedule.php';
                 </script>
                 <?php
    } else {
        $error[] = "User Record Deletion Unsuccessful";
    }

}   





if(isset($_POST['payment_delete']))
{
    $id = $_POST['payment_delete'];
    $sql = "DELETE  FROM payments WHERE payment_id = $id";
    $result = mysqli_query($conn, $sql);
    if($result){
        ?>
                 <script type="text/javascript">
                 window.location.href = 'payments.php';
                 </script>
                 <?php
    } else {
        $error[] = "User Record Deletion Unsuccessful";
    }

}   




if(isset($_POST['spa_booking_delete']))
{
    $id = $_POST['spa_booking_delete'];
    $sql = "DELETE  FROM spa_session_bookings WHERE booking_id = $id";
    $result = mysqli_query($conn, $sql);
    if($result){
        ?>
                 <script type="text/javascript">
                 window.location.href = 'bookings.php';
                 </script>
                 <?php
    } else {
        $error[] = "User Record Deletion Unsuccessful";
    }

}




if(isset($_POST['equipment_delete']))
{
    $id = $_POST['equipment_delete'];
    $sql = "DELETE  FROM equipments WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if($result){
        ?>
                 <script type="text/javascript">
                 window.location.href = 'equipments.php';
                 </script>
                 <?php
    } else {
        $error[] = "User Record Deletion Unsuccessful";
    }

}





if(isset($_POST['instructor_delete']))
{
    $id = $_POST['instructor_delete'];
    $sql = "DELETE  FROM instructors WHERE instructor_id = $id";
    $result = mysqli_query($conn, $sql);
    if($result){
        ?>
                 <script type="text/javascript">
                 window.location.href = 'instructors.php';
                 </script>
                 <?php
    } else {
        $error[] = "User Record Deletion Unsuccessful";
    }

}


?>  