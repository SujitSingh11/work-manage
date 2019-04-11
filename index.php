<?php
    include 'db/db.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Work Management</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
          .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
          }
          .modal-content{
              text-align: -webkit-auto;
              color: black;
          }

          @media (min-width: 768px) {
            .bd-placeholder-img-lg {
              font-size: 3.5rem;
            }
          }
        </style>
        <link href="css/cover.css" rel="stylesheet">

    </head>
    <body class="text-center" data-gr-c-s-loaded="true">
        <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
            <header class="masthead mb-auto">
                <div class="inner">
                    <h3 class="masthead-brand">Work Management</h3>
                    <nav class="nav nav-masthead justify-content-center">
                        <a class="nav-link active" href="javascript:void(0)" data-toggle="modal" data-target="#signupmodal">Sign-up</a>
                        <a class="nav-link active" href="javascript:void(0)" data-toggle="modal" data-target="#signinmodal">Sign-in</a>
                    </nav>
                </div>
            </header>

            <main role="main" class="inner cover">
                <h1 class="cover-heading">Work Management Tool</h1>
                <p class="lead">Please Sign-in/Sign-up to continue</p>
                <div class="lead">
                    <button type="button" class="btn btn-outline-light m-1 px-3" data-toggle="modal" data-target="#signupmodal">Sign-up</button>
    				<button type="button" class="btn btn-outline-light m-1 px-3" data-toggle="modal" data-target="#signinmodal">Sign-in</button>
                </div>
                <br>
                <p class="lead">
                    <?php
                        if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ){
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        }
                    ?>
                </p>
            </main>


            <footer class="mastfoot mt-auto">
            <div class="inner">
            <p>Made by @Sujit_Singh 2019</p>
            </div>
            </footer>
        </div>
        <?php include 'includes/inc_login_model.php'; ?>

    <?php include 'includes/inc_js.php'; ?>
    </body>
</html>
