<?php
    include '../assets/db/db.php';
    session_start();
    if ($_SESSION['logged_in'] == false) {
        $_SESSION['message'] = "You are not Signed In.! <br> Please Sign in.";
        die(header('Location: ../index.php'));
    }
    $e_id = $_SESSION['e_id'];
    $sql_projects="SELECT  tbl_project.`project_id`,tbl_project.`m_id`,tbl_project.`client_id`,tbl_project.`project_name` , tbl_project.`project_price`, tbl_project.`project_deadline`, tbl_employee_project.`e_id` FROM tbl_project ,tbl_employee_project WHERE tbl_project.`project_id` = tbl_employee_project.`project_id` ";
    $query_projects = mysqli_query($conn,$sql_projects);


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My Projects</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="../assets/css/atlantis.min.css">
</head>
<body>
    <div class="wrapper">
        <?php include 'inc_nav_employee.php'; ?>

        <div class="main-panel">
			<div class="content">
                <div class="panel-header bg-danger-gradient">
					<div class="page-inner py-3">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">My Projects</h2>
							</div>
						</div>
					</div>
				</div>
                <div class="row m-3">
                    <?php
                    if ($query_projects->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($query_projects)) {
                            if ($row['e_id'] == $e_id) {
                                $project_id = $row['project_id'];
                                $sql_task = "SELECT  tbl_task.task_id AS task_id, tbl_task.project_id AS project_id, tbl_task.m_id AS m_id, tbl_task.e_id AS e_id, tbl_task.user_id AS user_id, tbl_task.task_title AS task_title, tbl_task.task_decription AS task_decription, tbl_task.task_time AS task_time, tbl_task_status.new AS new, tbl_task_status.hold AS hold, tbl_task_status.completed AS completed FROM tbl_task INNER JOIN tbl_task_status ON tbl_task_status.task_id = tbl_task.task_id WHERE tbl_task.project_id = $project_id";
                                $sql_employee_project = "SELECT * FROM `tbl_employee_project` WHERE project_id = $project_id";
                                $sql_task_satus = "SELECT * FROM `tbl_task_status` WHERE project_id = $project_id AND completed = 1";

                                $query_task = mysqli_query($conn,$sql_task);
                                $query_employee_project = mysqli_query($conn,$sql_employee_project);
                                $query_task_status = mysqli_query($conn,$sql_task_satus);

                                $num_employee_project = mysqli_num_rows($query_employee_project);
                                $num_task = mysqli_num_rows($query_task);
                                $num_task_status = mysqli_num_rows($query_task_status);
                            ?>
                            <div class="col col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title"><?= $row['project_name']?></div>
                                    </div>
                                    <form class="card-body" method="POST" action="task.php">
                                        <div class="row mr-2">
                                            <div class="col-md-12">
                                                <p>Deadline: <?= $row['project_deadline']?></p>
                                                <p>Total Task: <?= $num_task?></p>
                                                <p>Completed : <?= $num_task_status?></p>
                                                <p>Remaning : <?php $rem = $num_task-$num_task_status; echo $rem;?></p>
                                                <p>Members : <?= $num_employee_project?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row mt-1 mr-2">
                                            <div class="ml-2">
                                                <input type="hidden" name="project_id" value="<?=$row['project_id']?>">
                                                <input type="hidden" name="client_id" value="<?=$row['client_id']?>">
                                                <button type="submit" name="view_task" class="btn btn-round btn-primary mr-2">
                                                    <i class="fa fa-tasks mr-1"></i>
                                                    <span>View Task</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php
                            }
                        }
                    }else {?>
                        <div class="alert alert-warning fade show mt-2" role="alert">
                            No Projects Found
                        </div>
                    <?php }
                    ?>
                </div>
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<nav class="pull-left">
						<ul class="nav">
							<li class="nav-item">
								<a class="nav-link" href="manager_index.php">
									Home
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Help
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Feedback
								</a>
							</li>
						</ul>
					</nav>
					<div class="copyright ml-auto">
						@2019 Made by <a href="https://github.com/baby-developers">Sujit_Singh</a>
					</div>
				</div>
			</footer>
		</div>
    </div>

    <?php include '../includes/inc_js.php'; ?>
    <script>
        document.getElementById("logout").onclick = function () {
            location.href = "../login-system/logout.php";
        };
        document.getElementById("logout2").onclick = function () {
            location.href = "../login-system/logout.php";
        };
    </script>
</body>
</html>
