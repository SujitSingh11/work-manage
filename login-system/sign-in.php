<?php
/* User login process, checks if user exists and password is correct */
require '../assets/db/db.php';
session_start();

// Escape email to protect against SQL injections
$email = mysqli_real_escape_string($conn,$_POST['email']);
$result = $conn->query("SELECT * FROM tbl_users WHERE email='$email'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: ../index.php");
}
else {
    // User exists
    $user = $result->fetch_assoc();

    // Password verify
    if ($_POST['password'] == $user['password']) {

        // Initilize the session variables
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['user_type'] = $user['user_type'];

        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;

        // Redirect to logged-in page
        if ($_SESSION['user_type'] == 0) {
            $result_usertype = $conn->query("SELECT admin_id FROM tbl_admin WHERE user_id='{$_SESSION['user_id']}'");
            $usertype = $result_usertype->fetch_assoc();
            $_SESSION['admin_id'] = $usertype['admin_id'];
            header("location: ../admin/admin_index.php");
        }
        elseif ($_SESSION['user_type'] == 1) {
            $result_usertype = $conn->query("SELECT e_id FROM tbl_employee WHERE user_id='{$_SESSION['user_id']}'");
            $usertype = $result_usertype->fetch_assoc();
            $_SESSION['e_id'] = $usertype['e_id'];
            header("location: ../employee/employee_index.php");
        }
        elseif ($_SESSION['user_type'] == 2) {
            $result_usertype = $conn->query("SELECT m_id FROM tbl_manager WHERE user_id='{$_SESSION['user_id']}'");
            $usertype = $result_usertype->fetch_assoc();
            $_SESSION['m_id'] = $usertype['m_id'];
            header("location: ../manager/manager_index.php");
        }
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: ../index.php");
    }
}
