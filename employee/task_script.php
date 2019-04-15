<?php
    include '../assets/db/db.php';
    session_start();

    $project_id = $_POST['project_id'];
    $client_id = $_POST['client_id'];
    $_SESSION['project_id'] = $_POST['project_id'];
    $_SESSION['client_id'] = $_POST['client_id'];


    if (isset($_POST['available'])) {
        $task_id = $_POST['task_id'];
        $sql_available = "UPDATE `tbl_task_status` SET `new`=1 ,`hold`= 0,`completed`= 0 WHERE task_id = $task_id";
        if (mysqli_query($conn,$sql_available)) {
            $_SESSION['available'] = "Successfully Moved to Available";
            header('location: task.php');
        }else {
            $_SESSION['not_available'] = "Failed to move to Available";
            header('location: task.php');
        }
    }
    if (isset($_POST['hold'])) {
        $task_id = $_POST['task_id'];
        $sql_hold = "UPDATE `tbl_task_status` SET `new`= 0 ,`hold`=1,`completed`= 0 WHERE task_id = $task_id";
        if (mysqli_query($conn,$sql_hold)) {
            header('location: task.php');
            $_SESSION['hold'] = "Successfully Moved to Hold";
        }else {
            header('location: task.php');
            $_SESSION['not_hold'] = "Failed to move to Hold";
        }
    }
    if (isset($_POST['done'])) {
        $task_id = $_POST['task_id'];
        $sql_done = "UPDATE `tbl_task_status` SET `new`= 0 ,`hold`= 0,`completed`=1 WHERE task_id = $task_id";
        if (mysqli_query($conn,$sql_done)) {
            header('location: task.php');
            $_SESSION['done'] = "Successfully Moved to Completed";
        }else {
            header('location: task.php');
            $_SESSION['not_done'] = "Failed to move to Completed";
        }
    }
?>
