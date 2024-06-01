<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'mail/PHPMailer.php';
require 'mail/SMTP.php';
require 'mail/Exception.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/all.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
        <link rel="apple-touch-icon" href="img/essu-logo.png">
        <link rel="shortcut icon" href="img/essu-logo.png">
        <title>Password Recovery</title>
    </head>
    <body>
        <div class="row g-3">
            <div class="container">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <?php
                    include('connect.php');
                    if (isset($_POST["email"]) && (!empty($_POST["email"]))) {
                        $email = $_POST["email"];
                        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
                        if (!$email) {
                            $error .="Invalid email address";
                        } else {
                            $sel_query = "SELECT * FROM `account_tab` WHERE email='" . $email . "'";
                            $results = mysqli_query($con, $sel_query);
                            $row = mysqli_num_rows($results);
                            if ($row == "") {
                                $error .= "User Not Found";
                            } 
                        }
                        if ($error != "") {
                            echo $error;
                        } else {

                            $output = '';

                            $expFormat = mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y"));
                            $expDate = date("Y-m-d H:i:s", $expFormat);
                            $key = md5(time());
                            $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
                            $key = $key . $addKey;
                            
                            mysqli_query($con, "INSERT INTO `password_reset_temp` (`email`, `keyy`, `expDate`) VALUES ('" . $email . "', '" . $key . "', '" . $expDate . "');");


                            $output.='<p>Please click on the following link to reset your password.</p>';
                            //replace site
                            $output.='<p><a href="http://localhost/essu-admission-system/stu-reset-password.php?key=' . $key . '&email=' . $email . '&action=reset" target="_blank">http://localhost/essu-admission-system/stu-reset-password.php?key=' . $key . '&email=' . $email . '&action=reset</a></p>';
                            $body = $output;
                            $subject = "Password Recovery";

                            $email_to = $email;


                            
                            $mail = new PHPMailer(true);
                            $mail->IsSMTP();
                            $mail->Host = "smtp.gmail.com";   
                            $mail->SMTPAuth = true;
                            $mail->Username = "essuadmissionandtesting0@gmail.com";   
                            $mail->Password = "lxyuiyamgcyluiqq";   
                            $mail->SMTPSecure = "tls";       
                            $mail->Port       = 587; 
                            $mail->IsHTML(true);
                            $mail->setFrom('essuadmissionandtesting0@gmail.com');

                            $mail->Subject = $subject;
                            $mail->Body = $body;
                            $mail->AddAddress($email_to);
                            if (!$mail->Send()) {
                                echo "Mailer Error: " . $mail->ErrorInfo;
                            } else {
                                echo "An email has been sent";
                            }
                        }
                    }
                    ?>
                        <div class="container">
                            
                        <form action="" method="POST" name="reset" class="row g-3 my-3">
                            <div class="col-md-2">
                            
                                    
                            </div>
                            <div class="col-md-10">
                            <h2 class="">Forgot Password</h2> 
                                <p>An email will be sent to you with instructions on to reset your password.</p>
                            <input type="email" class="form-control" name="email" placeholder="Enter your Email Address" autocomplete="off" required>
                            <br>
                            <input type="submit" id="reset" value="Reset Password"  class="btn btn-primary"/>
                            </div>
                            
                            <div>
                            
                                    
                            </div>  
                                
                        </form>
                              
                        </div>
                        
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </body>
</html>