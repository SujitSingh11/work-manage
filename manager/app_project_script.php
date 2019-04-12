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
        if (isset($_POST['project_email'])) {
            $client_email= mysqli_real_escape_string($conn,$_POST['client_email']);
        }
        if (isset($_POST['project_deadline'])) {
            $project_deadline = date('d-m-Y',strtotime($_POST['project_deadline']));
        }

        $m_id = $_SESSION['m_id'];
    }
?>
