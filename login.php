<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" href="img/essu-logo.png">
    <link rel="shortcut icon" href="img/essu-logo.png">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">

    <title>Login</title>
</head>
<body style="background: linear-gradient(rgba(51, 50, 50, 0.7), rgba(51, 50, 50, 0.7)), url(img/abstract-green.jpg); background-size: cover;">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <form action="login-code.php" method="POST" class="border shadow p-3 rounded bg-light" style="width: 450px;">
            <h1 class="text-center p-1">Login</h1>
            <hr>
            <?php

                if(isset($_SESSION['message'])){
                    ?>
                    <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                            <span class="badge badge-pill badge-danger">Failed</span> <?php echo $_SESSION['message']; ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    unset($_SESSION['message']);
                }
            ?>
            <div class="input-group mb-3">
                <span class="input-group-text" name="email"><i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control" name="email" placeholder="Enter your email address" autocomplete="off" required>
                
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" name="email"><i class="fa fa-key"></i></span>
                <input type="password" class="form-control" name="pass" id="pass" placeholder="Enter your password" required>
                <span class="input-group-text">
                    <a href="#" class="text-dark" id="icon-click">
                        <i class="fa fa-eye" id="icon"></i>
                    </a>
                </span> 
            </div>
            <div class="mb-3 mt-4">
                <a href="stu-forgot-password.php" style="text-decoration: none;">Forgot Password?</a>
            </div>
            <div class="mt-3 p-1">
                <input type="submit" class="btn btn-primary btn-sm fs-5" id="submit" name="submit" value="Login" style="width:100%; height: 40px">
            </div>
        </form>
    </div>
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#icon-click").click(function(){
                $("#icon").toggleClass('fa-eye-slash');

                var input = $("#pass");
                if(input.attr("type")==="password"){
                    input.attr("type","text");
                }else{
                    input.attr("type","password");
                }
            })
        });
    </script>
</body>
</html>