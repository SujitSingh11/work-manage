<?php
    include '../assets/db/db.php';
    session_start();

    $user_id = $_POST['user_id'];
    $e_id = $_POST['e_id'];

    if (isset($_POST['approve'])) {
        $sql_approve = "UPDATE `tbl_employee` SET `active`= 1 WHERE e_id = $e_id AND user_id = $user_id";
        if (mysqli_query($conn,$sql_approve)) {
            $_SESSION['approve'] = "Active";
            header('location: all_employee.php');
        }else {
            $_SESSION['not_approve'] = "Not Active";
            header('location: all_employee.php');
        }
    }
    if (isset($_POST['deactivate'])) {
        $sql_deactivate = "UPDATE `tbl_employee` SET `active`= 0 WHERE e_id = $e_id AND user_id = $user_id";
        if (mysqli_query($conn,$sql_deactivate)) {
            $_SESSION['deactivate'] = "Active";
            header('location: all_employee.php');
        }else {
            $_SESSION['not_deactivate'] = "Not Active";
            header('location: all_employee.php');
        }
    }

    if (isset($_POST['remove'])) {
        $sql_remove_user = "DELETE FROM `tbl_users` WHERE user_id = $user_id";
        $sql_remove_emp = "DELETE FROM `tbl_employee` WHERE e_id = $e_id AND user_id = $user_id";
        if (mysqli_query($conn,$sql_remove_user)&&mysqli_query($conn,$sql_remove_emp)) {
            $_SESSION['remove'] = "Removed";
            header('location: all_employee.php');
        }else {
            $_SESSION['not_remove'] = "Not Removed";
            header('location: all_employee.php');
        }
    }
?>
