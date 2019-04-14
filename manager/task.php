<?php
    include '../assets/db/db.php';
    session_start();

    if (isset( $_POST['project_id'])) {
        $project_id = $_POST['project_id'];
        $client_id = $_POST['client_id'];
    }else {
        $project_id = $_SESSION['project_id'];
        $client_id = $_SESSION['client_id'];
    }

    $sql_project = "SELECT * FROM `tbl_project` WHERE project_id = $project_id";
    $sql_task = "SELECT  tbl_task.task_id AS task_id, tbl_task.project_id AS project_id, tbl_task.m_id AS m_id, tbl_task.e_id AS e_id, tbl_task.user_id AS user_id, tbl_task.task_title AS task_title, tbl_task.task_decription AS task_decription, tbl_task.task_time AS task_time, tbl_task_status.new AS new, tbl_task_status.hold AS hold, tbl_task_status.completed AS completed FROM tbl_task INNER JOIN tbl_task_status ON tbl_task_status.task_id = tbl_task.task_id WHERE tbl_task.project_id = $project_id";
    $sql_client = "SELECT * FROM `tbl_client` WHERE client_id = $client_id";
    $sql_employee_project = "SELECT * FROM `tbl_employee_project` WHERE project_id = $project_id";
    $sql_task_satus = "SELECT * FROM `tbl_task_status` WHERE project_id = $project_id AND completed = 1";

    $query_project = mysqli_query($conn,$sql_project);
    $query_task = mysqli_query($conn,$sql_task);
    $query_client = mysqli_query($conn,$sql_client);
    $query_employee_project = mysqli_query($conn,$sql_employee_project);
    $query_task_status = mysqli_query($conn,$sql_task_satus);

    $data_project = mysqli_fetch_assoc($query_project);
    $data_client = mysqli_fetch_assoc($query_client);
    $num_employee_project = mysqli_num_rows($query_employee_project);
    $num_task = mysqli_num_rows($query_task);
    $num_task_status = mysqli_num_rows($query_task_status);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Manager Task</title>
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
        <?php include 'inc_nav_manager.php'; ?>

        <div class="main-panel">
			<div class="content">
                <div class="panel-header bg-secondary-gradient">
					<div class="page-inner py-3">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold mt-2"><?=$data_project['project_name']?></h2>
                                <h5 class="text-white op-7 mb-2">Client: <?=$data_client['first_name'].' '.$data_client['last_name']?></h5>
							</div>
                            <div class="ml-md-auto py-2 py-md-0">
								<button class="btn btn-secondary btn-round" data-toggle="modal" data-target="#addtask"><i class="far fa-plus-square mr-1"></i>Add Task</button>
							</div>
						</div>
					</div>
				</div>
                <!-- Modal -->
                <div id="addtask" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-dark-gradient">
                                <h5 class="modal-title display-4" style="font-size:30px; color:#fff;">Add Task</h5>
                                <button type="button" style=" color:#fff;"class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form  method="POST" action="task_script.php">
                                    <div class="col">
                                        <label class="col-form-label">Task Title</label>
                                        <input type="text" class="form-control" name="title" placeholder="Task Title">
                                    </div>
                                    <div class="col">
                                        <label class="col-form-label">Comment (Optional)</label>
                                        <input type="text" class="form-control" name="comment" placeholder="Comment (Optional)">
                                    </div>
                                        <div class="col mb-3">
                                            <label class="col-form-label">Task Decription</label>
                                            <textarea type="textarea" class="form-control" name="decription" placeholder="Task Decription"></textarea>
                                            <input type="hidden" name="project_id" value="<?=$project_id?>">
                                            <input type="hidden" name="client_id" value="<?=$client_id?>">
                                            <input type="hidden" name="m_id" value="<?=$_SESSION['m_id']?>">
                                            <input type="hidden" name="user_id" value="<?=$_SESSION['user_id']?>">
                                        </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="add_task" class="btn btn-dark">Add Task</button>
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-card-no-pd">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-users text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Members</p>
                                            <h4 class="card-title"><?=$num_employee_project?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-coins text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Revenue</p>
                                            <h4 class="card-title">$ <?=$data_project['project_price']?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-success text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Completed Task</p>
                                            <h4 class="card-title"><?=$num_task_status?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-list text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Total Task</p>
                                            <h4 class="card-title"><?=$num_task?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8 mt-2">
                        <div class="card">
                            <div class="card-header bg-dark-gradient">
                                <div class="card-title"  style="color:#fff;">Available Task</div>
                            </div>
                            <div class="card-body"  style="height:450px; overflow-y: scroll;">
                                <div class="row">
                                    <?php
                                    if ($num_task > 0) {
                                        $no = 1;
                                        while ($data_task = mysqli_fetch_assoc($query_task)) {
                                            if ($data_task['new'] == 1) {
                                            ?>
                                            <div class="col-12">
                                                <div class="card">
                    								<div class="card-header">
                    									<h4 class="card-title"><?=$data_task['task_title']?></h4>
                    								</div>
                    								<div class="card-body">
                    									<div class="row">
                    										<div class="col-5 col-md-4">
                    											<div class="nav flex-column nav-pills nav-secondary nav-pills-no-bd" id="v-pills-tab-without-border<?=$no?>" role="tablist" aria-orientation="vertical">
                    												<a class="nav-link active" id="v-pills-home-tab-nobd<?=$no?>" data-toggle="pill" href="#v-pills-home-nobd<?=$no?>" role="tab" aria-controls="v-pills-home-nobd" aria-selected="true">Decription</a>
                    												<a class="nav-link" id="v-pills-profile-tab-nobd<?=$no?>" data-toggle="pill" href="#v-pills-profile-nobd<?=$no?>" role="tab" aria-controls="v-pills-profile-nobd" aria-selected="false">Comment</a>
                    												<a class="nav-link" id="v-pills-messages-tab-nobd<?=$no?>" data-toggle="pill" href="#v-pills-messages-nobd<?=$no?>" role="tab" aria-controls="v-pills-messages-nobd" aria-selected="false">Info</a>
                    											</div>
                    										</div>
                    										<div class="col-7 col-md-8">
                    											<div class="tab-content" id="v-pills-without-border-tabContent<?=$no?>">
                    												<div class="tab-pane fade show active" id="v-pills-home-nobd<?=$no?>" role="tabpanel" aria-labelledby="v-pills-home-tab-nobd">
                                                                        <p><?=$data_task['task_decription']?></p>
                    												</div>
                    												<div class="tab-pane fade" id="v-pills-profile-nobd<?=$no?>" role="tabpanel" aria-labelledby="v-pills-profile-tab-nobd">

                    												</div>
                    												<div class="tab-pane fade" id="v-pills-messages-nobd<?=$no?>" role="tabpanel" aria-labelledby="v-pills-messages-tab-nobd">
                                                                        <?php
                                                                            $user_id = $data_task['user_id'];
                                                                            $sql_task_info = "SELECT * FROM `tbl_users` WHERE user_id = $user_id";
                                                                            $query_task_info = mysqli_query($conn,$sql_task_info);
                                                                            if (mysqli_num_rows($query_task_info) > 0) {
                                                                                $data_task_info = mysqli_fetch_assoc($query_task_info);
                                                                                echo "<p><b>Created By:</b> ".$data_task_info['first_name']." ".$data_task_info['last_name']."</p>";
                                                                                echo "<b>Created Time</b>: <p>".$data_task['task_time']."</p>";
                                                                            }
                                                                        ?>
                    												</div>
                    											</div>
                    										</div>
                    									</div>
                                                        <hr>
                                                        <div class="row">
                                                            <form class="col-md-3 ml-auto" method="POST" action="task_script.php">
                                                                <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                                <div class="dropdown-menu">
                                                                    <input type="hidden" name="task_id" value="<?=$data_task['task_id']?>">
                                                                    <input type="hidden" name="project_id" value="<?=$project_id?>">
                                                                    <input type="hidden" name="client_id" value="<?=$client_id?>">
                                                                    <button class="dropdown-item" type="submit" name="hold">Move To Hold</button>
                                                                    <button class="dropdown-item" type="submit" name="done">Move To Completed</button>
                                                                    <div role="separator" class="dropdown-divider"></div>
                                                                    <button class="dropdown-item" type="submit" name="delete">Delete</button>
                                                                </div>
                                                            </form>
                                                        </div>
                    								</div>
                    							</div>
                    						</div>
                                            <?php
                                                $no++;
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 mt-2">
                        <div class="card card-round">
                            <div class="card-header">
                                <div class="card-title fw-mediumbold">Add Members to the project</div>
                            </div>
                            <div class="card-body" style="height:450px; overflow-y: scroll;">
                                <div class="card-list">
                                    <?php
                                        $sql_suggest = "SELECT tbl_users.`user_id`, tbl_employee.`e_id`, tbl_users.`first_name`, tbl_users.`last_name`,tbl_users.`email` FROM tbl_users, tbl_employee WHERE tbl_users.user_id=tbl_employee.user_id";
                                        $query_suggest = mysqli_query($conn,$sql_suggest);
                                        if (mysqli_num_rows($query_suggest) > 0) {
                                            while ($data_suggest = mysqli_fetch_assoc($query_suggest)) {
                                                $e_id = $data_suggest['e_id'];
                                                $sql_join = "SELECT * FROM tbl_employee_project WHERE e_id = $e_id AND project_id = $project_id";
                                                $query_join = mysqli_query($conn,$sql_join);
                                                if (mysqli_num_rows($query_join) == 0) {
                                                ?>
                                                <div class="item-list">
                                                    <div class="avatar">
                                                        <img src="../assets/img/profile4.png" alt="..." class="avatar-img rounded-circle">
                                                    </div>
                                                    <div class="info-user ml-3">
                                                        <div class="username"><?=$data_suggest['first_name']." ".$data_suggest['last_name']?></div>
                                                        <div class="status"><?=$data_suggest['email']?></div>
                                                    </div>
                                                    <button class="btn btn-icon btn-primary btn-round btn-xs">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                                <?php
                                                }
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 mt-2 ">
                        <div class="card">
                            <div class="card-header bg-dark-gradient">
                                <div class="card-title"  style="color:#fff;">Task on Hold</div>
                            </div>
                            <div class="card-body"  style="height:450px; overflow-y: scroll;">
                                <div class="row">
                                    <?php
                                    $query_task_2 = mysqli_query($conn,$sql_task);
                                    if (mysqli_num_rows($query_task_2) > 0) {
                                        $no_2 = 100;
                                        while ($data_task_2 = mysqli_fetch_assoc($query_task_2)) {
                                            if ($data_task_2['hold'] == 1) {
                                            ?>
                                            <div class="col-12">
                                                <div class="card">
                    								<div class="card-header">
                    									<h4 class="card-title"><?=$data_task_2['task_title']?></h4>
                    								</div>
                    								<div class="card-body">
                    									<div class="row">
                    										<div class="col-5 col-md-4">
                    											<div class="nav flex-column nav-pills nav-secondary nav-pills-no-bd" id="v-pills-tab-without-border<?=$no_2?>" role="tablist" aria-orientation="vertical">
                    												<a class="nav-link active" id="v-pills-home-tab-nobd<?=$no_2?>" data-toggle="pill" href="#v-pills-home-nobd<?=$no_2?>" role="tab" aria-controls="v-pills-home-nobd" aria-selected="true">Decription</a>
                    												<a class="nav-link" id="v-pills-profile-tab-nobd<?=$no_2?>" data-toggle="pill" href="#v-pills-profile-nobd<?=$no_2?>" role="tab" aria-controls="v-pills-profile-nobd" aria-selected="false">Comment</a>
                    												<a class="nav-link" id="v-pills-messages-tab-nobd<?=$no_2?>" data-toggle="pill" href="#v-pills-messages-nobd<?=$no_2?>" role="tab" aria-controls="v-pills-messages-nobd" aria-selected="false">Info</a>
                    											</div>
                    										</div>
                    										<div class="col-7 col-md-8">
                    											<div class="tab-content" id="v-pills-without-border-tabContent<?=$no_2?>">
                    												<div class="tab-pane fade show active" id="v-pills-home-nobd<?=$no_2?>" role="tabpanel" aria-labelledby="v-pills-home-tab-nobd">
                                                                        <p><?=$data_task_2['task_decription']?></p>
                    												</div>
                    												<div class="tab-pane fade" id="v-pills-profile-nobd<?=$no_2?>" role="tabpanel" aria-labelledby="v-pills-profile-tab-nobd">

                    												</div>
                    												<div class="tab-pane fade" id="v-pills-messages-nobd<?=$no_2?>" role="tabpanel" aria-labelledby="v-pills-messages-tab-nobd">
                                                                        <?php
                                                                            $user_id = $data_task_2['user_id'];
                                                                            $sql_task_info = "SELECT * FROM `tbl_users` WHERE user_id = $user_id";
                                                                            $query_task_info = mysqli_query($conn,$sql_task_info);
                                                                            if (mysqli_num_rows($query_task_info) > 0) {
                                                                                $data_task_info = mysqli_fetch_assoc($query_task_info);
                                                                                echo "<p><b>Created By:</b> ".$data_task_info['first_name']." ".$data_task_info['last_name']."</p>";
                                                                                echo "<b>Created Time</b>: <p>".$data_task_2['task_time']."</p>";
                                                                            }
                                                                        ?>
                    												</div>
                    											</div>
                    										</div>
                    									</div>
                                                        <hr>
                                                        <div class="row">
                                                            <form class="col-md-3 ml-auto" method="POST" action="task_script.php">
                                                                <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                                <div class="dropdown-menu">
                                                                    <input type="hidden" name="task_id" value="<?=$data_task_2['task_id']?>">
                                                                    <input type="hidden" name="project_id" value="<?=$project_id?>">
                                                                    <input type="hidden" name="client_id" value="<?=$client_id?>">
                                                                    <button class="dropdown-item" type="submit" name="available">Move To Available</button>
                                                                    <button class="dropdown-item" type="submit" name="done">Move To Completed</button>
                                                                    <div role="separator" class="dropdown-divider"></div>
                                                                    <button class="dropdown-item" type="submit" name="delete">Delete</button>
                                                                </div>
                                                            </form>
                                                        </div>
                    								</div>
                    							</div>
                    						</div>
                                            <?php
                                                $no_2++;
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-2 ">
                        <div class="card">
                            <div class="card-header bg-dark-gradient">
                                <div class="card-title"  style="color:#fff;">Completed Task</div>
                            </div>
                            <div class="card-body"  style="height:450px; overflow-y: scroll;">
                                <div class="row">
                                    <?php
                                    $query_task_3 = mysqli_query($conn,$sql_task);
                                    if (mysqli_num_rows($query_task_3) > 0) {
                                        $no_3 = 200;
                                        while ($data_task_3 = mysqli_fetch_assoc($query_task_3)) {
                                            if ($data_task_3['completed'] == 1) {
                                            ?>
                                            <div class="col-12">
                                                <div class="card">
                    								<div class="card-header">
                    									<h4 class="card-title"><?=$data_task_3['task_title']?></h4>
                    								</div>
                    								<div class="card-body">
                    									<div class="row">
                    										<div class="col-5 col-md-4">
                    											<div class="nav flex-column nav-pills nav-secondary nav-pills-no-bd" id="v-pills-tab-without-border<?=$no_3?>" role="tablist" aria-orientation="vertical">
                    												<a class="nav-link active" id="v-pills-home-tab-nobd<?=$no_3?>" data-toggle="pill" href="#v-pills-home-nobd<?=$no_3?>" role="tab" aria-controls="v-pills-home-nobd" aria-selected="true">Decription</a>
                    												<a class="nav-link" id="v-pills-profile-tab-nobd<?=$no_3?>" data-toggle="pill" href="#v-pills-profile-nobd<?=$no_3?>" role="tab" aria-controls="v-pills-profile-nobd" aria-selected="false">Comment</a>
                    												<a class="nav-link" id="v-pills-messages-tab-nobd<?=$no_3?>" data-toggle="pill" href="#v-pills-messages-nobd<?=$no_3?>" role="tab" aria-controls="v-pills-messages-nobd" aria-selected="false">Info</a>
                    											</div>
                    										</div>
                    										<div class="col-7 col-md-8">
                    											<div class="tab-content" id="v-pills-without-border-tabContent<?=$no_3?>">
                    												<div class="tab-pane fade show active" id="v-pills-home-nobd<?=$no_3?>" role="tabpanel" aria-labelledby="v-pills-home-tab-nobd">
                                                                        <p><?=$data_task_3['task_decription']?></p>
                    												</div>
                    												<div class="tab-pane fade" id="v-pills-profile-nobd<?=$no_3?>" role="tabpanel" aria-labelledby="v-pills-profile-tab-nobd">

                    												</div>
                    												<div class="tab-pane fade" id="v-pills-messages-nobd<?=$no_3?>" role="tabpanel" aria-labelledby="v-pills-messages-tab-nobd">
                                                                        <?php
                                                                            $user_id3 = $data_task_3['user_id'];
                                                                            $sql_task_info3 = "SELECT * FROM `tbl_users` WHERE user_id = $user_id3";
                                                                            $query_task_info3 = mysqli_query($conn,$sql_task_info3);
                                                                            if (mysqli_num_rows($query_task_info3) > 0) {
                                                                                $data_task_info3 = mysqli_fetch_assoc($query_task_info3);
                                                                                echo "<p><b>Created By:</b> ".$data_task_info3['first_name']." ".$data_task_info3['last_name']."</p>";
                                                                                echo "<b>Created Time</b>: <p>".$data_task_3['task_time']."</p>";
                                                                            }
                                                                        ?>
                    												</div>
                    											</div>
                    										</div>
                    									</div>
                                                        <hr>
                                                        <div class="row">
                                                            <form class="col-md-3 ml-auto" method="POST" action="task_script.php">
                                                                <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                                <div class="dropdown-menu">
                                                                    <input type="hidden" name="task_id" value="<?=$data_task_3['task_id']?>">
                                                                    <input type="hidden" name="project_id" value="<?=$project_id?>">
                                                                    <input type="hidden" name="client_id" value="<?=$client_id?>">
                                                                    <button class="dropdown-item" type="submit" name="available">Move To Available</button>
                                                                    <button class="dropdown-item" type="submit" name="hold">Move To Hold</button>
                                                                    <div role="separator" class="dropdown-divider"></div>
                                                                    <button class="dropdown-item" type="submit" name="delete">Delete</button>
                                                                </div>
                                                            </form>
                                                        </div>
                    								</div>
                    							</div>
                    						</div>
                                            <?php
                                                $no_3++;
                                            }
                                        }
                                    }
                                    ?>
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


    <?php include '../includes/inc_js.php'; ?>
    <script>
        document.getElementById("logout").onclick = function () {
            location.href = "../login-system/logout.php";
        };
        document.getElementById("logout2").onclick = function () {
            location.href = "../login-system/logout.php";
        };

        <?php
            if (isset($_SESSION['added']) AND !empty($_SESSION['added'])) { ?>
                $('#alert_success').ready(function(e) {
                    swal({
                        title: "<?=$_SESSION['added']?>",
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
            if (isset($_SESSION['available']) AND !empty($_SESSION['available'])) { ?>
                $('#alert_success').ready(function(e) {
                    swal({
                        title: "<?=$_SESSION['available']?>",
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
            unset($_SESSION['available']);
            }
            if (isset($_SESSION['hold']) AND !empty($_SESSION['hold'])) { ?>
                $('#alert_success').ready(function(e) {
                    swal({
                        title: "<?=$_SESSION['hold']?>",
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
            unset($_SESSION['hold']);
            }
        ?>
        <?php
        if (isset($_SESSION['done']) AND !empty($_SESSION['done'])) { ?>
            $('#alert_success').ready(function(e) {
                swal({
                    title: "<?=$_SESSION['done']?>",
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
        unset($_SESSION['done']);
        }
        ?>
        <?php
            if (isset($_SESSION['not_available']) AND !empty($_SESSION['not_available'])) { ?>
                $('#alert_success').ready(function(e) {
                    swal({
                        title: "<?=$_SESSION['not_available']?>",
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
            unset($_SESSION['not_available']);
            }
            if (isset($_SESSION['not_hold']) AND !empty($_SESSION['not_hold'])) { ?>
                $('#alert_success').ready(function(e) {
                    swal({
                        title: "<?=$_SESSION['not_hold']?>",
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
            unset($_SESSION['not_hold']);
            }
        ?>
        <?php
        if (isset($_SESSION['not_done']) AND !empty($_SESSION['not_done'])) { ?>
            $('#alert_success').ready(function(e) {
                swal({
                    title: "<?=$_SESSION['not_done']?>",
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
        unset($_SESSION['not_done']);
        }
        ?>
        //== Class Initialization
		jQuery(document).ready(function() {
			SweetAlert2Demo.init();
		});
    </script>
</body>
</html>
