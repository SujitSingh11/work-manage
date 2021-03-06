<?php
    include '../assets/db/db.php';
    session_start();
    if ($_SESSION['logged_in'] == false) {
        $_SESSION['message'] = "You are not Signed In.! <br> Please Sign in.";
        die(header('Location: ../index.php'));
    }
    $m_id = $_SESSION['m_id'];
    $sql_projects="SELECT * FROM tbl_project WHERE m_id = $m_id";
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
                <div class="panel-header bg-danger-gradient">
					<div class="page-inner py-3">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold mt-2">My Projects</h2>
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
                    if ($query_projects->num_rows > 0) {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($query_projects)) {
                            $client_id = $row['client_id'];
                            $sql_client = "SELECT * FROM tbl_client WHERE client_id = $client_id";
                            $query_client = mysqli_query($conn,$sql_client);
                            $data_client = mysqli_fetch_assoc($query_client);
                        ?>
                        <div class="col col-md-4">
                            <div class="card">
                                <div class="card-header bg-dark-gradient">
                                    <div class="card-title" style="color:#fff;"><?= $row['project_name']?></div>
                                </div>
                                <form class="card-body" method="POST" action="task.php">
                                    <div class="row mr-2">
                                        <div class="col-md-12">
                                            <p>Customer Name: <?= $data_client['first_name'].' '.$data_client['last_name']?></p>

                                            <p>Project Revenew: <?= $row['project_price']?></p>

                                            <p>Deadline: <?= $row['project_deadline']?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mt-1 mr-2">
                                        <div class="ml-2">
                                            <input type="hidden" name="project_id" value="<?=$row['project_id']?>">
                                            <input type="hidden" name="client_id" value="<?=$data_client['client_id']?>">
                                            <button type="submit" class="btn btn-round btn-primary mr-2">
                                                <i class="fa fa-clipboard-list"></i>
                                                <span>View</span>
                                            </button>
                                        </div>
                                        </form>
                                        <button type="button" class="btn btn-round btn-warning mr-2" data-toggle="modal" data-target="#editprojectmodal<?=$no?>">
                                            <i class="fa fa-edit"></i>
                                            <span>Edit</span>
                                        </button>
                                        <form action="delete_project.php" method="post">
                                            <input type="hidden" name="project_id" value="<?=$row['project_id']?>">
                                            <button type="submit" class="btn btn-round btn-danger mr-2" data-toggle="tooltip" data-placement="right" title="Delete">
                                                <i class="fa fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div id="editprojectmodal<?=$no?>" class="modal fade" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark-gradient">
                                        <h5 class="modal-title display-4" style="font-size:30px; color:#fff;">Edit Project</h5>
                                        <button type="button" style="color:#fff;" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" style="color:#fff;">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form  method="POST" action="app_project_script.php">
                                            <div class="form-row">
                                                <div class="col">
                                                    <label class="col-form-label">Project Name</label>
                                                    <input type="text" class="form-control" name="project_name" value="<?=$row['project_name']?>">
                                                </div>
                                                <div class="col">
                                                    <label class="col-form-label">Project Revenue (Optional)</label>
                                                    <input type="number" class="form-control" name="project_price" value="<?=$row['project_price']?>">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <label class="col-form-label">Customer First Name</label>
                                                    <input type="text" class="form-control" name="client_first_name" value="<?=$data_client['first_name']?>">
                                                </div>
                                                <div class="col">
                                                    <label class="col-form-label">Customer Last Name</label>
                                                    <input type="text" class="form-control" name="client_last_name" value="<?=$data_client['last_name']?>">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <label class="col-form-label">Customer Email (Optional)</label>
                                                    <input type="email" class="form-control" name="client_email" value="<?=$data_client['email']?>">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <label class="col-form-label">Project Deadline (Optional)</label>
                                                    <input type="date" class="form-control" value="<?=$row['project_deadline']?>">
                                                </div>
                                            </div>
                                            <div class="modal-footer mt-3">
                                                <input type="hidden" name="project_id" value="<?=$row['project_id']?>">
                                                <input type="hidden" name="client_id" value="<?=$data_client['client_id']?>">
                                                <button type="submit" name="edit_project" class="btn btn-dark">Edit</button>
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        $no++;
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
						2019 by <a href="https://github.com/baby-developers">Sujit_Singh</a>
					</div>
				</div>
			</footer>
		</div>
    </div>

    <?php include 'add_project.php'; ?>
    <?php include '../includes/inc_js.php'; ?>
    <script>
        document.getElementById("logout").onclick = function () {
            location.href = "../login-system/logout.php";
        };
        document.getElementById("logout2").onclick = function () {
            location.href = "../login-system/logout.php";
        };
        <?php
            if (isset($_SESSION['success']) AND !empty($_SESSION['success'])) { ?>
                $('#alert_success').ready(function(e) {
                    swal({
                        title: "<?=$_SESSION['success']?>",
                        text: "Click OK to continue",
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
            unset($_SESSION['success']);
            }
            if (isset($_SESSION['error']) AND !empty($_SESSION['error'])) { ?>
                $('#alert_success').ready(function(e) {
                    swal({
                        title: "<?=$_SESSION['error']?>",
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
            unset($_SESSION['error']);
            }
        ?>
        //== Class Initialization
		jQuery(document).ready(function() {
			SweetAlert2Demo.init();
		});
    </script>
</body>
</html>
