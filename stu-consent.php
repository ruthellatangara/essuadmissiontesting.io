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
    <title>Consent</title>
</head>
<body>
<div class= "container my-5">
        <h3 class="fw-bold text-center my-4">CONSENT</h3>
        <label for="checkcertify" class="form-check-label">In the observance of the Data Privacy Act, by clicking YES, 
            I am allowing the personnel in ESSU Main Admission office to access all information in this form relevant to my application for entrance examination for AY <?php
                $date2=date('Y', strtotime('+1 Years'));
                for ($i=date('Y'); $i<$date2+0; $i++){
                    echo ''.$i.'-'.($i+1).'';
                }
                ?>.
        </label>
        <div class="mt-3">
            <?php

                    if(!isset($_GET['email'])){
                        header("location: stu-dashboard.php");
                        exit();
                    }
                        $email = $_GET['email'];
                        $url = "stu-admform.php?email=".$email;
                        echo '
                        <a href='.$url.' class="btn btn-primary btn-sm btn-flat text-light">Yes</a>
                    ';

            ?>
            <?php

            if(!isset($_GET['email'])){
                header("location: stu-dashboard.php");
                exit();
            }
                $email = $_GET['email'];
                $url = "stu-dashboard.php?email=".$email;
                echo '
                <a href='.$url.' class="btn btn-primary btn-sm btn-flat text-light ml-3">No</a>
            ';

            ?>
        </div>
</div>

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>