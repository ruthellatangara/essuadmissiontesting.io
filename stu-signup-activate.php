<?php
    	include('connect.php');
    	if(isset($_GET['code'])){
            $user=$_GET['uid'];
            $code=$_GET['code'];

            $query = mysqli_query($con, "SELECT * from account_tab where accID='$user'");
            $row=mysqli_fetch_array($query);
        
            if($row['code']==$code){
                //activate account
                mysqli_query($con,"UPDATE account_tab set verify='1' where accID='$user'");
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
                    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
                    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
                    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
                    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
                    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">
                    <title>Verification</title>
                </head>
                <body>
                    <div class="container my-5">
                        <p>Account Verified! <a href="login.php" class="fw-bold" style="text-decoration: none">Login now!</a></p>
                        <p></p>
                    </div>
                    
                </body>
                <?php
            }
            else{
                echo "Something went wrong. Please sign up again.";
                //header('location:stu-sign-up.php');
            }
    	}
    	else{
    		header('location:index.php');
    	}
    ?>