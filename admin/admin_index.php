<?php
    include '../assets/db/db.php';
    session_start();
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
</head>
<body>
    <div class="wrapper">
        <?php include 'inc_nav_admin.php'; ?>

        <div class="main-panel">
			<div class="content">
                <div class="panel-header bg-info-gradient">
					<div class="page-inner py-3">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold mt-2">Dashboard</h2>
							</div>
						</div>
					</div>
				</div>
                <div class="row m-3">
                    <div class="col">
                        <div class="card card-info card-annoucement card-round">
                            <div class="card-body text-center">
                                <div class="card-opening">Welcome <?=$_SESSION['first_name'].' '.$_SESSION['last_name']?>,</div>
                                <div class="card-desc">
                                    To add Manager accounts click on add.!
                                </div>
                                <div class="card-detail">
                                    <div class="btn btn-light btn-rounded" data-toggle="modal" data-target="#addmanagermodal">Add</div>
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
								<a class="nav-link" href="admin_index.php">
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
									Support Us
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

    <?php include 'add_manager.php'; ?>
    <?php include '../includes/inc_js.php'; ?>
    <script>
        document.getElementById("logout").onclick = function () {
            location.href = "../login-system/logout.php";
        };
        document.getElementById("logout2").onclick = function () {
            location.href = "../login-system/logout.php";
        };
        <?php
        if (isset($_SESSION['message']) AND !empty($_SESSION['message'])) { ?>
            $('#alert_success').ready(function(e) {
                swal({
                    title: "<?=$_SESSION['message']?>",
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
        unset($_SESSION['message']);
        }
    ?>
    //== Class Initialization
    jQuery(document).ready(function() {
        SweetAlert2Demo.init();
    });
    </script>
</body>
</html>
