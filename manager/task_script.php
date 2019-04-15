<?php
    include '../assets/db/db.php';
    session_start();

    $project_id = $_POST['project_id'];
    $client_id = $_POST['client_id'];
    $_SESSION['project_id'] = $_POST['project_id'];
    $_SESSION['client_id'] = $_POST['client_id'];


    if (isset($_POST['add_task'])) {
        $m_id = $_POST['m_id'];
        $user_id = $_POST['user_id'];
        $task_title = mysqli_real_escape_string($conn,$_POST['title']);
        $task_decription = nl2br(mysqli_real_escape_string($conn,$_POST['decription']),false);
        $sql_add_task = "INSERT INTO `tbl_task`(`project_id`, `m_id`, `user_id`, `task_title`, `task_decription`) VALUES ($project_id, $m_id, $user_id,'$task_title' ,'$task_decription')";
        if (mysqli_query($conn,$sql_add_task)) {
            $task_id = mysqli_insert_id($conn);;
            if (!empty($_POST['comment'])) {
                $task_comment = nl2br(mysqli_real_escape_string($conn,$_POST['comment']),false);
                $sql_task_comment = "INSERT INTO `tbl_task_comment`(`task_id`, `project_id`, `m_id`,`task_comment`) VALUES ($task_id,$project_id,$m_id,'$task_comment')";
                if (mysqli_query($conn,$sql_task_comment)) {
                    $sql_task_satus = "INSERT INTO `tbl_task_status`(`task_id`, `project_id`) VALUES ($task_id,$project_id)";
                    if (mysqli_query($conn,$sql_task_satus)) {
                        $_SESSION['added'] = "Task & Task Comment Successfully Added";
                        header('location: task.php');
                    }
                }else {
                    $_SESSION['not_added'] = "Task Comment Failed to be Added";
                    header('location: task.php');
                }
            }else {
                $sql_task_satus = "INSERT INTO `tbl_task_status`(`task_id`, `project_id`) VALUES ($task_id,$project_id)";
                if (mysqli_query($conn,$sql_task_satus)) {
                    $_SESSION['added'] = "Task Successfully Added";
                    header('location: task.php');
                }
            }
        }else {
            $_SESSION['not_added'] = "Task Failed to Add";
            header('location: task.php');
        }
    }

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
    if (isset($_POST['delete'])) {
        $_SESSION['not_done'] = "Delete is under maintance";
        header('location: task.php');
    }

    if (isset($_POST['plus'])) {
        $e_id = $_POST['e_id'];
        $project_id = $_POST['project_id'];
        $sql_plus = "INSERT INTO `tbl_employee_project`(`e_id`, `project_id`) VALUES ($e_id,$project_id)";
        if (mysqli_query($conn,$sql_plus)) {
            $_SESSION['done'] = "Member added to Project";
            header('location: task.php');
        }
    }
    if (isset($_POST['minus'])) {
        $e_id = $_POST['e_id'];
        $project_id = $_POST['project_id'];
        $sql_minus = "DELETE FROM `tbl_employee_project` WHERE e_id = $e_id AND project_id = $project_id";
        if (mysqli_query($conn,$sql_minus)) {
            $_SESSION['not_done'] = "Member removed from Project";
            header('location: task.php');
        }
    }
?>
