<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" href="img/essu-logo.png">
    <link rel="shortcut icon" href="img/essu-logo.png">

    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <style>
        .header{
                height: 100vh;
                width: 100%;
                background-image: linear-gradient(rgba(4,9,30,0.8), rgba(4,9,30,0.8)), url(img/essu-pic.jpg);
                background-size: cover;
                overflow: hidden;
            }
        .footer{
            width: 100%;
            text-align: center;
            padding: 30px 0;
        }
    </style>
    <title>User</title>
</head>
<body class="header">
     <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Are you sure you want to logout?</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                        <a href="logout.php"><button class="btn btn-primary" type="button">Yes</button></a>
                        
                    </div>
                </div>
            </div>
        </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent mt-3 mb-5">
        <div class="container">
            <a href="#" class="navbar-brand">
                <img src="img/essu-logo.png" style="width:70px ; height: 70px ;">
            </a>
            <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse mb-0 h1 " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active col-sm-3">
                        <a href="#" class="nav-link"><span style="font-size: 18px; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight:700; color:white">Home</span></a>
                    </li>
                    <?php

                    if(isset($_SESSION['email'])){
                       include 'connect.php';
                        $sql="SELECT * from account_tab where stat=1 AND email='".$_SESSION['email']."'";
                        $result=mysqli_query($con,$sql);
                        if(mysqli_num_rows($result) == true)
                        {
                            echo '
                            <li class="nav-item col-sm-5">
                                <a href="stu-admform-existing.php" class="nav-link"><span style="font-size: 18px; font-family: Tahoma, Geneva, Verdana, sans-serif; font-weight:700;">Admission Form</span></a>
                            </li>
                            ';
                        }else
                        {
                            echo '
                            <li class="nav-item col-sm-5">
                                <a href="stu-admform.php" class="nav-link"><span style="font-size: 18px; font-family: Tahoma, Geneva, Verdana, sans-serif; font-weight:700;">Admission Form</span></a>
                            </li>
                            ';
                        }
                    }
                    ?> 
                    <?php
                    if(isset($_SESSION['email'])){
                        echo '
                            <li class="nav-item col-sm-3">
                                <a href="stu-permit.php" class="nav-link"><span style="font-size: 18px; font-family: Tahoma, Geneva, Verdana, sans-serif; font-weight:700;">Permit</span></a>
                            </li>
                            ';
                    }
                    ?>
                    <?php

                    if(isset($_SESSION['email'])){
                        echo '
                        <li class="nav-item col-sm-2">
                        <a href="stu-result.php" class="nav-link"><span style="font-size: 18px; font-family: Tahoma, Geneva, Verdana, sans-serif; font-weight:700;">Result</span></a>
                        </li>
                        ';
                    }
                    ?>
                    <li class="nav-item col-sm-2">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#logoutModal"><span style="font-size: 18px; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight:700;"><i class="ti-power-off"></i></span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="text-center text-light">
        <?php
            if(isset($_SESSION['email'])){
                $sql = mysqli_query($con, "SELECT fname from account_tab where email='".$_SESSION['email']."'");
                $row=mysqli_fetch_assoc($sql);
                $fname = $row['fname'];
                echo "<h3>Hello, ".$fname."!</h3>";
            }
                
        ?>
        <p><i class="fa fa-envelope mt-3"> essuadmissionandtesting0@gmail.com</i></p>
    </div>
</body>
</html>