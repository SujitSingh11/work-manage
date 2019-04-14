<?php
    include '../assets/db/db.php';
    session_start();

    $sql_projects="SELECT tbl_project.`m_id`,tbl_project.`project_id`,tbl_project.`client_id`,tbl_project.`project_name` , tbl_project.`project_price`, tbl_project.`project_deadline`, tbl_client.`first_name`,tbl_client.`last_name` FROM tbl_project ,tbl_client WHERE tbl_project.`project_id` = tbl_client.`project_id`";
    $query_projects = mysqli_query($conn,$sql_projects);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Manager</title>
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
    <script>
        .alert .close{

        }
    </script>
</head>
<body>
    <div class="wrapper">
        <?php include 'inc_nav_manager.php'; ?>

        <div class="main-panel">
			<div class="content">
                <div class="panel-header bg-info-gradient">
					<div class="page-inner py-3">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold mt-2">All Projects</h2>
							</div>
						</div>
					</div>
				</div>
                <div class="row m-3">
                    <?php
                    if (mysqli_num_rows($query_projects) > 0) {
                        while ($row = mysqli_fetch_assoc($query_projects)) {
                            $m_id = $row['m_id'];
                            $sql_manager = "SELECT tbl_users.user_id AS user_id, tbl_manager.m_id AS m_id, tbl_users.first_name AS first_name, tbl_users.last_name AS last_name FROM tbl_users INNER JOIN tbl_manager ON tbl_manager.user_id = tbl_users.user_id";
                            $query_manager = mysqli_query($conn,$sql_manager);
                            while ($row_manager = mysqli_fetch_assoc($query_manager)) {
                                if ($row_manager['m_id'] == $m_id) {
                                ?>
                                <div class="col col-md-4">
                                    <div class="card">
                                        <div class="card-header bg-dark-gradient">
                                            <div class="card-title" style="color:#fff;"><?= $row['project_name']?></div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mr-2">
                                                <div class="col-md-12">
                                                    <p>Project Created by: <?= $row_manager['first_name'].' '.$row_manager['last_name']?> </p>

                                                    <p>Customer Name: <?= $row['first_name'].' '.$row['last_name']?></p>

                                                    <p>Project Revenew: <?= $row['project_price']?></p>

                                                    <p>Deadline: <?= $row['project_deadline']?></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row mt-1 mr-2 ">
                                                <form class="col-md-12" method="POST" action="view_task.php">
                                                    <input type="hidden" name="project_id" value="<?=$row['project_id']?>">
                                                    <input type="hidden" name="client_id" value="<?=$row['client_id']?>">
                                                    <button type="submit" class="btn btn-round btn-primary mr-2">
                                                        <i class="fa fa-clipboard-list mr-1"></i>
                                                        <span>View Task</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                            }
                        }
                    }
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
						2019 by <a href="https://github.com/baby-developers">Sujit_Singh</a>
					</div>
				</div>
			</footer>
		</div>
    </div>
    <script>
        document.getElementById("logout").onclick = function () {
            location.href = "../login-system/logout.php";
        };
        document.getElementById("logout2").onclick = function () {
            location.href = "../login-system/logout.php";
        };
    </script>
    <?php include 'add_project.php'; ?>
    <?php include '../includes/inc_js.php'; ?>
</body>
</html>
