<?php
    include '../assets/db/db.php';
    session_start();

    $sql_employees = "SELECT tbl_users.user_id AS user_id, tbl_employee.e_id AS e_id, tbl_users.first_name AS first_name, tbl_users.last_name AS last_name,
    tbl_users.email AS email, tbl_employee.active AS active
            FROM tbl_users
            INNER JOIN tbl_employee ON tbl_employee.user_id = tbl_users.user_id";
    $query_employee = mysqli_query($conn,$sql_employees);

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
                <div class="panel-header bg-warning-gradient">
					<div class="page-inner py-3">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">All Employees</h2>
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
                <div class="row m-5">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-dark-gradient">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title" style="color:#fff;">Employees</h4>
                                    <button class="btn btn-dark btn-round ml-auto" data-toggle="modal" data-target="#addemployee">
                                        <i class="fa fa-plus"></i>
                                        Add Employee
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Modal -->
                                <div id="addemployee" class="modal fade" tabindex="-1" role="dialog">
                            		<div class="modal-dialog" role="document">
                            			<div class="modal-content">
                            				<div class="modal-header bg-dark-gradient">
                            					<h5 class="modal-title display-4" style="font-size:30px; color:#fff;">Add Employee</h5>
                            					<button type="button" style=" color:#fff;"class="close" data-dismiss="modal" aria-label="Close">
                            					<span aria-hidden="true">&times;</span>
                            					</button>
                            				</div>
                            				<div class="modal-body">
                            					<form  method="POST" action="add_employee.php">
                            						<div class="form-row">
                            							<div class="col">
                            								<label class="col-form-label">First Name</label>
                            								<input type="text" class="form-control" name="first" placeholder="First name">
                            							</div>
                            							<div class="col">
                            								<label class="col-form-label">Last Name</label>
                            								<input type="text" class="form-control" name="last" placeholder="Last name">
                            							</div>
                            						</div>
                            						<div class="form-row">
                            							<div class="col">
                            								<label class="col-form-label">E-mail</label>
                            								<input type="email" class="form-control" name="email" placeholder="Email">
                            							</div>
                            						</div>
                            						<div class="form-row">
                            							<div class="col">
                            								<label class="col-form-label">Password</label>
                            								<input type="password" class="form-control" name="password" placeholder="Password">
                            							</div>
                            							<div class="col mb-3">
                            								<label class="col-form-label">Re-Enter Password</label>
                            								<input type="password" class="form-control" name="re-password" placeholder="Re-Enter Password">
                            								<input type="hidden" name="user_type" value="1">
                            							</div>
                            						</div>
                            						<div class="modal-footer">
                            							<button type="submit" name="register" class="btn btn-dark">Sign-up</button>
                            							<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            						</div>
                            					</form>
                            				</div>
                            			</div>
                            		</div>
                            	</div>

                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover" >
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Approved</th>
                                                <th style="width: 10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                while ($row = mysqli_fetch_assoc($query_employee)) {
                                            ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $row['first_name'].' '.$row['last_name']?></td>
                                                    <td><?= $row['email']?></td>
                                                    <td><?php
                                                        if ($row['active'] == 1) {
                                                            echo "Approved";
                                                        }else {
                                                            echo "Not Approved";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <form class="form-button-action" action="employee_edit.php" method="POST">
                                                            <input type="hidden" name="user_id" value="<?=$row['user_id']?>">
                                                            <input type="hidden" name="e_id" value="<?=$row['e_id']?>">
                                                            <?php
                                                            if ($row['active'] == 0) {
                                                            ?>
                                                            <button type="submit" data-toggle="tooltip" name="approve" class="btn btn-link btn-primary" data-original-title="Approve">
                                                                <i class="fa fa-check-circle"></i>
                                                            </button>
                                                            <?php
                                                            }else { ?>
                                                                <button type="submit" data-toggle="tooltip" name="deactivate" class="btn btn-link btn-warning" data-original-title="Deactivate">
                                                                    <i class="fa fa-times-circle"></i>
                                                                </button> <?php
                                                            }
                                                            ?>
                                                            <button type="submit" data-toggle="tooltip" name="remove" class="btn btn-link btn-danger" data-original-title="Remove Employee">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php
                                                $no++;
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
            if (isset($_SESSION['approve']) AND !empty($_SESSION['approve'])) { ?>
                $('#alert_success').ready(function(e) {
                    swal({
                        title: "Employee Account Approved",
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
            unset($_SESSION['approve']);
            }
            if (isset($_SESSION['not_approve']) AND !empty($_SESSION['not_approve'])) { ?>
                $('#alert_success').ready(function(e) {
                    swal({
                        title: "Employee Account Failed to be Approved",
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
            unset($_SESSION['not_approve']);
            }
        ?>
        <?php
            if (isset($_SESSION['deactivate']) AND !empty($_SESSION['deactivate'])) { ?>
                $('#alert_success').ready(function(e) {
                    swal({
                        title: "Employee Account Deactivated",
                        text: "Click OK to continue",
                        icon: "info",
                        buttons: {
                            confirm: {
                                text: "OK",
                                value: true,
                                visible: true,
                                className: "btn btn-info",
                                closeModal: true
                            }
                        }
                    });
                });
            <?php
            unset($_SESSION['deactivate']);
            }
            if (isset($_SESSION['not_deactivate']) AND !empty($_SESSION['not_deactivate'])) { ?>
                $('#alert_success').ready(function(e) {
                    swal({
                        title: "Employee Failed to Deactivated",
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
            unset($_SESSION['not_deactivate']);
            }
        ?>
        <?php
            if (isset($_SESSION['exists']) AND !empty($_SESSION['exists'])) { ?>
                $('#alert_success').ready(function(e) {
                    swal({
                        title: "Employee Already Exists",
                        text: "Click OK to continue",
                        icon: "info",
                        buttons: {
                            confirm: {
                                text: "OK",
                                value: true,
                                visible: true,
                                className: "btn btn-info",
                                closeModal: true
                            }
                        }
                    });
                });
            <?php
            unset($_SESSION['exists']);
            }
            if (isset($_SESSION['not_added']) AND !empty($_SESSION['not_added'])) { ?>
                $('#alert_success').ready(function(e) {
                    swal({
                        title: "<?=$_SESSION['not_added']?>",
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
            unset($_SESSION['not_added']);
            }
        ?>
        <?php
            if (isset($_SESSION['added']) AND !empty($_SESSION['added'])) { ?>
                $('#alert_success').ready(function(e) {
                    swal({
                        title: "Employee Added Successfully",
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
            unset($_SESSION['added']);
        } ?>
        <?php
            if (isset($_SESSION['remove']) AND !empty($_SESSION['remove'])) { ?>
                $('#alert_success').ready(function(e) {
                    swal({
                        title: "Employee Account Removed",
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
            unset($_SESSION['remove']);
            }
            if (isset($_SESSION['not_remove']) AND !empty($_SESSION['not_remove'])) { ?>
                $('#alert_success').ready(function(e) {
                    swal({
                        title: "Employee Account Failed to Remove",
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
            unset($_SESSION['not_remove']);
            }
        ?>
        //== Class Initialization
		jQuery(document).ready(function() {
			SweetAlert2Demo.init();
		});
    </script>
</body>
</html>
