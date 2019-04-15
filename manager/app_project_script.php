<?php
    include '../assets/db/db.php';
    session_start();

    if (isset($_POST['add_project'])) {

        $project_name = mysqli_real_escape_string($conn,$_POST['project_name']);
        $client_first_name = mysqli_real_escape_string($conn,$_POST['client_first_name']);
        $client_last_name = mysqli_real_escape_string($conn,$_POST['client_last_name']);
        if (isset($_POST['project_price'])) {
            $project_price = mysqli_real_escape_string($conn,$_POST['project_price']);
        }
        if (isset($_POST['client_email'])) {
            $client_email= mysqli_real_escape_string($conn,$_POST['client_email']);
        }
        if (isset($_POST['project_deadline'])) {
            $project_deadline = date('Y-m-d',strtotime($_POST['project_deadline']));
        }
        $m_id = $_SESSION['m_id'];


        if (isset($_POST['project_deadline'])&&isset($_POST['project_price'])) {
            $sql_project ="INSERT INTO `tbl_project`(`m_id`,`project_name`, `project_price`, `project_deadline`) VALUES ($m_id,'$project_name','$project_price','$project_deadline')";
        }elseif (isset($_POST['project_deadline'])) {
            $sql_project ="INSERT INTO `tbl_project`(`m_id`,`project_name`, `project_deadline`) VALUES ($m_id,'$project_name',$project_deadline)";
        }elseif (isset($_POST['project_price'])) {
            $sql_project ="INSERT INTO `tbl_project`(`m_id`,`project_name`, `project_price`) VALUES ($m_id,'$project_name','$project_price')";
        }

        if (mysqli_query($conn,$sql_project)) {
            $result_projectid = $conn->query("SELECT project_id FROM tbl_project WHERE project_name='$project_name'");

            if ($result_projectid->num_rows > 0) {
                $project_id_fetch = mysqli_fetch_assoc($result_projectid);
                $project_id = $project_id_fetch['project_id'];
                if (isset($_POST['client_email'])) {
                    $sql_client = "INSERT INTO `tbl_client`(`m_id`, `project_id`, `first_name`, `last_name`, `email`) VALUES ($m_id,$project_id,'$client_first_name','$client_last_name','$client_email')";
                }else {
                    $sql_client = "INSERT INTO `tbl_client`(`m_id`, `project_id`, `first_name`, `last_name`) VALUES ($m_id,$project_id,'$client_first_name','$client_last_name')";
                }

                if (mysqli_query($conn,$sql_client)) {
                    $result_clientid = $conn->query("SELECT `client_id` FROM `tbl_client` WHERE first_name = '$client_first_name' && last_name = '$client_last_name'");
                    if ($result_clientid->num_rows > 0) {
                        $client_id_fetch = mysqli_fetch_assoc($result_clientid);
                        $clinet_id = $client_id_fetch['client_id'];
                        $sql_update_project = $conn->query("UPDATE `tbl_project` SET `client_id`= $clinet_id WHERE project_id = $project_id ");
                        $_SESSION['message'] = "Project and Client Information Successfully Added";
                        header('location: manager_index.php');
                    }else {
                        $_SESSION['error'] = "Client Information Failed to be Added3";
                        header('location: manager_index.php');
                    }
                }else {
                    $_SESSION['error'] = "Client Information Failed to be Added2".$sql_client;
                    header('location: manager_index.php');
                }
            }else {
                $_SESSION['error'] = "Project Information Failed to be Added";
                header('location: manager_index.php');
            }
        }else {
            $_SESSION['error'] = "Project and Client Information Failed to be Added";
            header('location: manager_index.php');
        }

    }
?>
