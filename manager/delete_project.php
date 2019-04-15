<?php
    include '../assets/db/db.php';
    session_start();

    $project_id = $_POST['project_id'];

    $sql_delete_project = "DELETE FROM `tbl_project` WHERE project_id = $project_id";
    $sql_delete_task = "DELETE FROM `tbl_task` WHERE project_id = $project_id";
    $sql_delete_task_comment = "DELETE FROM `tbl_task_comment` WHERE project_id = $project_id";
    $sql_delete_task_status = "DELETE FROM `tbl_task_status` WHERE project_id = $project_id";

    if (mysqli_query($conn,$sql_delete_project)) {
        if (mysqli_query($conn,$sql_delete_task)) {
            if (mysqli_query($conn,$sql_delete_task_comment)) {
                if (mysqli_query($conn,$sql_delete_task_status)) {
                    $_SESSION['success'] = "Successfully Deleted";
                    header('location: my_projects.php');
                }
                header('location: my_projects.php');
            }
            header('location: my_projects.php');
        }
        header('location: my_projects.php');
    }else {
        $_SESSION['error'] = "Failed to Delete Project";
        header('location: my_projects.php');
    }






?>
