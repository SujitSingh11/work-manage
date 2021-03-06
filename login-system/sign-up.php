<?php
require '../assets/db/db.php';
session_start();

// Escape all $_POST variables to protect against SQL injections
$first_name = mysqli_real_escape_string($conn,$_POST['first']);
$last_name = mysqli_real_escape_string($conn,$_POST['last']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$pass = mysqli_real_escape_string($conn,$_POST['password']);
$passcheck = mysqli_real_escape_string($conn,$_POST['re-password']);
$user_type = $_POST['user_type'];

if($pass=$passcheck)
{

    // Check if user with that email already exists
    $result = $conn->query("SELECT * FROM tbl_users WHERE email='$email'");

    // We know user email exists if the rows returned are more than 0
    if ( $result->num_rows > 0 ) {
        $_SESSION['message'] = 'User with this email already exists!';
        if (empty($user_type)) {
            header("location: ../index.php");
        }elseif ($user_type == 2) {
            header("location: ../admin/admin_index.php");
        }
    }
    else {
        // Email doesn't already exist in a database, proceed...

        // active is 0 by DEFAULT (no need to include it here)
        $sql_users = "INSERT INTO `tbl_users`(`user_type`, `first_name`, `last_name`, `email`, `password`) VALUES ('$user_type','$first_name','$last_name','$email','$pass')";

        // Add user to the users table
        $query = mysqli_query($conn,$sql_users);

        // Add user to the coorsponding table
        $result_userid = $conn->query("SELECT user_id FROM tbl_users WHERE email='$email'");

        if ($result_userid->num_rows > 0) {
            $user_id_fetch = mysqli_fetch_assoc($result_userid);
            $user_id = (int) $user_id_fetch['user_id'];
            if ($user_type == 1) {
                $sql_employee = "INSERT INTO tbl_employee (user_id) VALUES ($user_id)";
                $query_employee = mysqli_query($conn,$sql_employee);
                $_SESSION['message'] = "Successful Please Sign-in to get started.!";
                header("location: ../index.php");
            }elseif ($user_type == 2) {
                $sql_manager = "INSERT INTO tbl_manager (user_id) VALUES ($user_id)";
                $query_manager = mysqli_query($conn,$sql_manager);
                $_SESSION['message'] = "Manager Successfully Added";
                header("location: ../admin/admin_index.php");
            }

        }else {
            $_SESSION['message'] = "Error occur while signing up please try again.";
            if ($user_type == 1) {
                header("location: ../index.php");
            }elseif ($user_type == 2) {
                header("location: ../admin/admin_index.php");
            }
        }
    }
}
else{
    $_SESSION['message'] = 'Password do not match please try again';
    if ($user_type == 1) {
        header("location: ../index.php");
    }elseif ($user_type == 2) {
        header("location: ../admin/admin_index.php");
    }
}
