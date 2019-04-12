<?php
    include '../assets/db/db.php';
    session_start();

    $e_id = $_POST['e_id'];
    $project_id = $_POST['project_id'];

    if (isset($_POST['join'])) {
        $sql_join_project = "INSERT INTO `tbl_employee_project`(`e_id`, `project_id`) VALUES ($e_id,$project_id)";

        if (mysqli_query($conn,$sql_join_project)) {
            $_SESSION['join'] = "Project Successfully Joined";
            header('location: all_projects.php');
        }else {
            $_SESSION['join'] = "Project Failed to Join";
            header('location: all_projects.php');
        }
    }

    if (isset($_POST['leave'])) {
        $sql_leave_project = "DELETE FROM `tbl_employee_project` WHERE e_id = $e_id AND project_id = $project_id";

        if (mysqli_query($conn,$sql_leave_project)) {
            $_SESSION['leave'] = "Project Successfully Joined";
            header('location: all_projects.php');
        }else {
            $_SESSION['leave'] = "Project Failed to Join";
            header('location: all_projects.php');
        }
    }
?>
