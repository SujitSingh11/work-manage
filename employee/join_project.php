<?php
    include '../assets/db/db.php';
    session_start();

    $e_id = $_POST['e_id'];
    $project_id = $_POST['project_id'];

    if (isset($_POST['join'])) {
        $sql_active = "SELECT * FROM tbl_employee WHERE e_id = $e_id";
        $query_active = mysqli_query($conn,$sql_active);
        $data_active = mysqli_fetch_assoc($query_active);
        $active = $data_active['active'];
        $sql_join_project = "INSERT INTO `tbl_employee_project`(`e_id`, `project_id`) VALUES ($e_id,$project_id)";
        if ($active == 1) {
            if (mysqli_query($conn,$sql_join_project)) {
                $_SESSION['join'] = "Project Successfully Joined";
                header('location: all_projects.php');
            }else {
                $_SESSION['join'] = "Project Failed to Join";
                header('location: all_projects.php');
            }
        }else {
            $_SESSION['active'] = "Account not active ask manager to active your account.";
            header('location: all_projects.php');
        }
    }

    if (isset($_POST['leave'])) {
        $sql_leave_project = "DELETE FROM `tbl_employee_project` WHERE e_id = $e_id AND project_id = $project_id";
        if (mysqli_query($conn,$sql_leave_project)) {
            $_SESSION['leave'] = "Project Successfully Left";
            header('location: all_projects.php');
        }else {
            $_SESSION['leave'] = "Project Failed to Leave";
            header('location: all_projects.php');
        }
    }
?>
