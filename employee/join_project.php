<?php
    include '../assets/db/db.php';
    session_start();

    $e_id = $_POST['e_id'];
    $project_id = $_POST['project_id'];

    $sql_join_project = "INSERT INTO `tbl_employee_project`(`e_id`, `project_id`) VALUES ($e_id,$project_id)";

    if (mysqli_query($conn,$sql_join_project)) {
        $_SESSION['message'] = "Project Successfully Joined";
        header('location: employee_index.php');
    }else {
        $_SESSION['message'] = "Project Failed to Join";
        header('location: employee_index.php');
    }
?>
