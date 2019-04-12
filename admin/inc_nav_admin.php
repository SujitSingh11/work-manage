
    <div class="main-header">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark2">
            <a href="manager_index.php" class="logo">
                <div alt="navbar brand" class="navbar-brand"><h3 style="color:#fff;">Work Management</h3></div>
            </a>
            <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i class="icon-menu"></i>
                </span>
            </button>
            <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="icon-menu"></i>
                </button>
            </div>
        </div>
        <!-- End Logo Header -->
        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-expand-lg" data-background-color="dark">
            <div class="container-fluid">
                <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                    <!--<li class="nav-item dropdown hidden-caret">
                        <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-envelope"></i>
                        </a>
                        <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
                            <li>
                                <div class="dropdown-title d-flex justify-content-between align-items-center">
                                    Notifications
                                    <a href="#" class="small">Mark all as read</a>
                                </div>
                            </li>
                            <li>
                                <div class="message-notif-scroll scrollbar-outer">
                                    <div class="notif-center">
                                        <a href="#">
                                            <div class="notif-img">
                                                <img src="../assets/img/jm_denis.jpg" alt="Img Profile">
                                            </div>
                                            <div class="notif-content">
                                                <span class="subject">Jimmy Denis</span>
                                                <span class="block">
                                                    How are you ?
                                                </span>
                                                <span class="time">5 minutes ago</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-img">
                                                <img src="../assets/img/chadengle.jpg" alt="Img Profile">
                                            </div>
                                            <div class="notif-content">
                                                <span class="subject">Chad</span>
                                                <span class="block">
                                                    Ok, Thanks !
                                                </span>
                                                <span class="time">12 minutes ago</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-img">
                                                <img src="../assets/img/mlane.jpg" alt="Img Profile">
                                            </div>
                                            <div class="notif-content">
                                                <span class="subject">Jhon Doe</span>
                                                <span class="block">
                                                    Ready for the meeting today...
                                                </span>
                                                <span class="time">12 minutes ago</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-img">
                                                <img src="../assets/img/talha.jpg" alt="Img Profile">
                                            </div>
                                            <div class="notif-content">
                                                <span class="subject">Talha</span>
                                                <span class="block">
                                                    Hi, Apa Kabar ?
                                                </span>
                                                <span class="time">17 minutes ago</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                    </li>-->
                    <li class="nav-item dropdown hidden-caret">
                        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                            <i class="fas fa-layer-group"></i>
                        </a>
                        <div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
                            <div class="quick-actions-header">
                                <span class="title mb-1">Quick Actions</span>
                                <span class="subtitle op-8">Shortcuts</span>
                            </div>
                            <div class="quick-actions-scroll scrollbar-outer">
                                <div class="quick-actions-items">
                                    <div class="row m-0">
                                        <a class="col-6 col-md-6 p-0" href="#">
                                            <div class="quick-actions-item">
                                                <i class="flaticon-file-1"></i>
                                                <span class="text">Approve Employee</span>
                                            </div>
                                        </a>
                                        <a class="col-6 col-md-6 p-0" href="#">
                                            <div class="quick-actions-item">
                                                <i class="flaticon-add"></i>
                                                <span class="text">Add Manager</span>
                                            </div>
                                        </a>
                                        <a class="col-6 col-md-6 p-0" href="#">
                                            <div class="quick-actions-item">
                                                <i class="flaticon-interface-1"></i>
                                                <span class="text">Edit Project</span>
                                            </div>
                                        </a>
                                        <a class="col-6 col-md-6 p-0" href="#">
                                            <div class="quick-actions-item">
                                                <i class="flaticon-list"></i>
                                                <span class="text">View Project</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown hidden-caret">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                            <div class="avatar-sm">
                                <img src="../assets/img/profile4.png" alt="..." class="avatar-img rounded-circle">
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-user animated fadeIn">
                            <div class="dropdown-user-scroll scrollbar-outer">
                                <li>
                                    <div class="user-box">
                                        <div class="avatar-lg"><img src="../assets/img/profile4.png" alt="image profile" class="avatar-img rounded"></div>
                                        <div class="u-text">
                                            <h4><?=$_SESSION['first_name'].' '.$_SESSION['last_name']?></h4>
                                            <p class="text-muted"><?=$_SESSION['email']?></p><a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">My Profile</a>
                                    <a class="dropdown-item" href="#">Inbox</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Account Setting</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" id="logout2">Logout</a>
                                </li>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
        <!-- End Navbar -->
    <div class="sidebar sidebar-style-2">
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <div class="user">
                    <div class="avatar-sm float-left mr-2">
                        <img src="../assets/img/profile4.png" alt="..." class="avatar-img rounded-circle">
                    </div>
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                            <span>
                                <?=$_SESSION['first_name'].' '.$_SESSION['last_name']?>
                                <span class="user-level">Administrator</span>
                                <span class="caret"></span>
                            </span>
                        </a>
                        <div class="clearfix"></div>

                        <div class="collapse in" id="collapseExample">
                            <ul class="nav">
                                <li>
                                    <a href="#profile">
                                        <span class="link-collapse">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#edit">
                                        <span class="link-collapse">Edit Profile</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-primary">
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Dashboard</h4>
                    </li>
                    <li class="nav-item">
                        <a href="#base" data-toggle="modal" data-target="#addmanagermodal">
                            <i class="fas fa-layer-group"></i>
                            <p>Add Manager</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#base">
                            <i class="fas fa-check"></i>
                            <p>Approve Employee</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#base">
                            <i class="fas fa-folder"></i>
                            <p>All Projects</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#base">
                            <i class="fas fa-user"></i>
                            <p>Managers</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#base">
                            <i class="fas fa-users"></i>
                            <p>Employees</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#base">
                            <i class="fas fa-cogs"></i>
                            <p>Settings</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#base" id="logout">
                            <i class="fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- End Sidebar -->
