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
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="style.css">


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
    </style>
    <title>User</title>
</head>
<body>
    <div class="modal fade" id="consentmodal" tabindex="-1" role="dialog" aria-labelledby="consentModallbl"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="consentlbl">CONSENT</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="signup.php" method="POST">

                            <div class="modal-body">
                                <div class="form-group">
                                <label> In the observance of the Data Privacy Act, by clicking YES, I am allowing the personnel of ESSU Main Admission office to access all information in this form relevant to my application for entrance examination for AY 2023-2024. </label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" name="yes" class="btn btn-primary">Yes</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
    <section class="header" id="home">
            <nav>
                <a href="index.html"><img src="img/essu-logo.png"></a>
            </nav>
            <div class="text-box">
                <h1>Welcome to Eastern Samar State University</h1>
                <p><h6>Contact Us</h6>
                <i class="fa fa-envelope mt-3"> essuadmissionandtesting0@gmail.com</i>
                <br>
                <span>
                <a href="login.php" class="hero-btn mt-3">Login</a>
                
                <input type="button" class="hero-btn mt-3" value="Sign Up" data-toggle="modal" data-target="#consentmodal">
                </p>
            </div>

    </section>

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>