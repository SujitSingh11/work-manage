<?php
    include '../assets/db/db.php';
    session_start();

    $user_id = $_POST['user_id'];
    // Escape all $_POST variables to protect against SQL injections
    $first_name = mysqli_real_escape_string($conn,$_POST['first']);
    $last_name = mysqli_real_escape_string($conn,$_POST['last']);
    $pass = mysqli_real_escape_string($conn,$_POST['password']);
    $passcheck = mysqli_real_escape_string($conn,$_POST['re-password']);

    if($pass=$passcheck)
    {
        $sql = "UPDATE `tbl_users` SET `first_name`= '$first_name',`last_name`='$last_name',`password`='$pass' WHERE user_id = $user_id";
        mysqli_query($conn,$sql);
        $_SESSION['success'] = "Profile Successfully Updated";
        header('location: my_profile.php');
    }else {
        $_SESSION['error'] = "Password Don't Match";
        header('location: my_profile.php');
    }
?>
