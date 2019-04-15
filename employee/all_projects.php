<?php
    include '../assets/db/db.php';
    session_start();
    if ($_SESSION['logged_in'] == false) {
        $_SESSION['message'] = "You are not Signed In.! <br> Please Sign in.";
        die(header('Location: ../index.php'));
    }
    $sql_projects="SELECT  tbl_project.`project_id`,tbl_project.`m_id`,tbl_project.`project_name` , tbl_project.`project_price`, tbl_project.`project_deadline`, tbl_client.`first_name`,tbl_client.`last_name` FROM tbl_project ,tbl_client WHERE tbl_project.`project_id` = tbl_client.`project_id`";
    $query_projects = mysqli_query($conn,$sql_projects);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>All Projects</title>
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
        <?php include 'inc_nav_employee.php'; ?>

        <div class="main-panel">
			<div class="content">
                <div class="panel-header bg-warning-gradient">
					<div class="page-inner py-3">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">All Projects</h2>
							</div>
						</div>
					</div>
				</div>
                <?php
                    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ){?>
                        <div class="alert alert-info alert-dismissible fade show mt-2" role="alert">
                            <?=$_SESSION['message']?>
                            <button type="button" class="close" style="line-height: 0px;" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php
                        unset($_SESSION['message']);
                    }
                ?>
                <div class="row m-3">
                    <?php
                    if (mysqli_num_rows($query_projects) > 0) {
                        while ($row = mysqli_fetch_assoc($query_projects)) {
                            $e_id = $_SESSION['e_id'];
                            $m_id = $row['m_id'];
                            $project_id = $row['project_id'];
                            $sql_manager = "SELECT tbl_users.user_id AS user_id, tbl_manager.m_id AS m_id, tbl_users.first_name AS first_name, tbl_users.last_name AS last_name FROM tbl_users INNER JOIN tbl_manager ON tbl_manager.user_id = tbl_users.user_id";
                            $query_manager = mysqli_query($conn,$sql_manager);
                            $sql_join = "SELECT * FROM tbl_employee_project WHERE e_id = $e_id AND project_id = $project_id";
                            $query_join = mysqli_query($conn,$sql_join);

                            while ($row_manager = mysqli_fetch_assoc($query_manager)) {

                                if ($row_manager['m_id'] == $m_id) {
                                ?>
                                <div class="col col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title"><?= $row['project_name']?></div>
                                        </div>
                                        <form class="card-body" action="join_project.php" method="POST">
                                            <div class="row mr-2">
                                                <div class="col-md-12">
                                                    <p>Project Created by: <?= $row_manager['first_name'].' '.$row_manager['last_name']?> </p>
                                                    <p>Customer Name: <?= $row['first_name'].' '.$row['last_name']?></p>
                                                    <p>Project Revenew: <?= $row['project_price']?></p>
                                                    <p>Deadline: <?= $row['project_deadline']?></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row mt-1 mr-2">
                                                <div class="col-md-12">
                                                    <input type="hidden" name="e_id" value="<?=$e_id?>">
                                                    <input type="hidden" name="project_id" value="<?=$project_id?>">
                                                    <?php
                                                        if (mysqli_num_rows($query_join) > 0) { ?>
                                                            <button type="button" class="btn btn-round btn-primary mr-2" disabled="disabled">
                                                                <i class="fa fa-external-link-alt mr-1"></i>
                                                                <span>Joined</span>
                                                            </button>
                                                            <button type="submit" name="leave" class="btn btn-round btn-danger mr-2">
                                                                <i class="fa fa-external-link-alt mr-1"></i>
                                                                <span>Leave</span>
                                                            </button>
                                                        <?php }else { ?>
                                                            <button type="submit" name="join" class="btn btn-round btn-primary mr-2">
                                                                <i class="fa fa-external-link-alt mr-1"></i>
                                                                <span>Join</span>
                                                            </button>
                                                        <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </form>
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
        <?php
            if (isset($_SESSION['join']) AND !empty($_SESSION['join'])) { ?>
                $('#alert_success').ready(function(e) {
                    swal({
                        title: "Project Joined",
                        text: "Click ok to continue",
                        icon: "success",
                        buttons: {
                            confirm: {
                                text: "OK",
                                value: true,
                                visible: true,
                                className: "btn btn-success",
                                closeModal: true
                            }
                        }
                    });
                });
            <?php
            unset($_SESSION['join']);
            }
            if (isset($_SESSION['leave']) AND !empty($_SESSION['leave'])) { ?>
                $('#alert_success').ready(function(e) {
                    swal({
                        title: "Project Left",
                        text: "Click OK to continue",
                        icon: "warning",
                        buttons: {
                            confirm: {
                                text: "OK",
                                value: true,
                                visible: true,
                                className: "btn btn-warning",
                                closeModal: true
                            }
                        }
                    });
                });
            <?php
            unset($_SESSION['leave']);
            }
        ?>
        <?php
        if (isset($_SESSION['active']) AND !empty($_SESSION['active'])) { ?>
            $('#alert_success').ready(function(e) {
                swal({
                    title: "<?=$_SESSION['active']?>",
                    text: "Click OK to continue",
                    icon: "warning",
                    buttons: {
                        confirm: {
                            text: "OK",
                            value: true,
                            visible: true,
                            className: "btn btn-warning",
                            closeModal: true
                        }
                    }
                });
            });
        <?php
        unset($_SESSION['active']);
        }
        ?>
        //== Class Initialization
		jQuery(document).ready(function() {
			SweetAlert2Demo.init();
		});
    </script>
</body>
</html>
