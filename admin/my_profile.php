<?php
    include '../assets/db/db.php';
    session_start();
    if ($_SESSION['logged_in'] == false) {
        $_SESSION['message'] = "You are not Signed In.! <br> Please Sign in.";
        die(header('Location: ../index.php'));
    }
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM tbl_users WHERE user_id = $user_id";
    $query = mysqli_query($conn,$sql);
    $data = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Employee</title>
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
                <div class="panel-header bg-success-gradient">
					<div class="page-inner py-3">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">My Profile</h2>
							</div>
						</div>
					</div>
				</div>
                <div class="row m-2">
                    <div class="col">
                        <div class="col-md-8 ml-auto mr-auto">
							<div class="card card-profile">
								<div class="card-header" style="background-image: url('../assets/img/blogpost.jpg')">
									<div class="profile-picture">
										<div class="avatar avatar-xl">
											<img src="../assets/img/profile4.png" alt="..." class="avatar-img rounded-circle">
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="user-profile text-center">
										<div class="name"><?=$data['first_name']." ".$data['last_name']?></div>
										<div class="job">Manager</div>
                                        <div class="desc"><?=$data['email']?></div>
									</div>
								</div>
								<div class="card-footer">
                                    <div class="col">
                                        <h3>Edit your profile: </h3>
                                        <form  method="POST" action="change.php">
                    						<div class="form-row">
                    							<div class="col">
                    								<label class="col-form-label">First Name</label>
                    								<input type="text" class="form-control" name="first" value="<?=$data['first_name']?>">
                    							</div>
                    							<div class="col">
                    								<label class="col-form-label">Last Name</label>
                    								<input type="text" class="form-control" name="last" value="<?=$data['last_name']?>">
                    							</div>
                    						</div>
                    						<div class="form-row">
                    							<div class="col">
                    								<label class="col-form-label">New Password</label>
                    								<input type="password" class="form-control" name="password" placeholder="Password">
                    							</div>
                    							<div class="col mb-3">
                    								<label class="col-form-label">Re-Enter Password</label>
                    								<input type="password" class="form-control" name="re-password" placeholder="Re-Enter Password">
                    								<input type="hidden" name="user_type" value="1">
                    							</div>
                    						</div>
                                            <hr>
                                            <div class="form-row mt-3">
                    							<div class="col-md-12 ml-auto">
                                                    <input type="hidden" name="user_id" value="<?=$user_id?>">
                                                    <button type="submit" class="btn btn-dark" name="change">Submit</button>
                                                </div>
                    						</div>
                                        </form>
                                    </div>
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
    ?>
    <?php
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
