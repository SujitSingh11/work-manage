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
                <?php
                    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ){?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?=$_SESSION['message']?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php
                        unset($_SESSION['message']);
                    }
                ?>
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
						2019 by <a href="https://github.com/baby-developers">baby-developer</a>
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
    <?php include 'add_manager.php'; ?>
    <?php include '../includes/inc_js.php'; ?>
</body>
</html>
