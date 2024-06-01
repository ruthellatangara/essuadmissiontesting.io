<?php
session_start();
?>
<html>
    <head>
        <title>Reset Password</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/all.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
        <link rel="apple-touch-icon" href="img/essu-logo.png">
        <link rel="shortcut icon" href="img/essu-logo.png">
        <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
        <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="vendors/jquery/dist/jquery.min.js"></script>
    </head>
    <body>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <?php
                    include('connect.php');
                    
                        if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) && ($_GET["action"] == "reset") && !isset($_POST["action"])) {
                        $key = $_GET["key"];
                        $email = $_GET["email"];
                        $curDate = date("Y-m-d H:i:s");
                        $query = mysqli_query($con, "SELECT * FROM `password_reset_temp` WHERE `keyy`='" . $key . "' and `email`='" . $email . "';");
                        $row = mysqli_num_rows($query);
                        if ($row == "") {
                            $error .= '<h2>Invalid Link</h2>';
                        } else {
                            $row = mysqli_fetch_assoc($query);
                            $expDate = $row['expDate'];
                            if ($expDate >= $curDate) {
                                ?> 
                                <h2 class="mt-5">Reset Password</h2>   
                                <form method="post" action="" name="update" onsubmit="return validate()">

                                    <input type="hidden" name="action" value="update" class="form-control"/>


                                    <div class="input-group mt-3">
                                        
                                        <input type="password"  name="pass1" id="pass1" class="form-control mb-3" onkeyup="check(this)" placeholder="Enter new password" required/>
                                        <span class="input-group-text  mb-3">
                                            <a href="#" class="text-dark" id="icon-click">
                                                <i class="fa fa-eye" id="icon"></i>
                                            </a>
                                        </span>
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="password"  name="pass2" id="pass2" class="form-control" placeholder="Confirm new password" required/>
                                        <span class="input-group-text">
                                            <a href="#" class="text-dark" id="c-icon-click">
                                                <i class="fa fa-eye" id="c-icon"></i>
                                            </a>
                                        </span>
                                    </div>
                                    <input type="hidden" name="email" value="<?php echo $email; ?>"/>
                                    <div class="form-group">
                                        <p class="text-center text-danger" id="msg"></p>
                                        <input type="submit" id="reset" value="Reset Password"  class="btn btn-primary btn-sm"/>
                                    </div>
                                </form>
                                <?php
                            }
                             else {
                                $error .= "<h2>Link Expired</h2>";
                            }
                        }
                        if ($error != "") {
                            echo "<div class='error'>" . $error . "</div><br />";
                        }
                    }


                    if (isset($_POST["email"]) && isset($_POST["action"]) && ($_POST["action"] == "update")) {
                        $error = "";
                        $pass1 = mysqli_real_escape_string($con, $_POST["pass1"]);
                        $pass2 = mysqli_real_escape_string($con, $_POST["pass2"]);
                        $email = $_POST["email"];
                        $curDate = date("Y-m-d H:i:s");
                        if ($pass1 != $pass2) {
                            $error .= "<p>Password do not match, both password should be same.<br /><br /></p>";
                        }
                        if ($error != "") {
                            echo $error;
                        } else {

                            
                            $hash = md5($pass1);
                            mysqli_query($con, "UPDATE account_tab SET `pword` = '" . $hash . "' WHERE `email` = '" . $email . "'");

                            mysqli_query($con, "DELETE FROM `password_reset_temp` WHERE `email` = '$email'");

                            echo '<div class="error"><p>Congratulations! Your password has been updated successfully.</p>';
                        }
                    }
                    ?>
 
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
        

        <script type="text/javascript">
            $(document).ready(function(){
                $("#icon-click").click(function(){
                    $("#icon").toggleClass('fa-eye-slash');

                    var input = $("#pass1");
                    if(input.attr("type")==="password"){
                        input.attr("type","text");
                    }else{
                        input.attr("type","password");
                    }
                })
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#c-icon-click").click(function(){
                    $("#c-icon").toggleClass('fa-eye-slash');

                    var input = $("#pass2");
                    if(input.attr("type")==="password"){
                        input.attr("type","text");
                    }else{
                        input.attr("type","password");
                    }
                })
            });
        </script>
        <script>
            var pword = document.getElementById('pass1');
            var flag = 1;
            function check(elem){
              if (elem.value.length > 0) {
                if (elem.value != pass1.value) {
                  document.getElementById('msg').innerText = "Passwords does not match.";
                  flag = 0;
                }else{
                  document.getElementById('msg').innerText = "";
                  flag = 1;
                }
              }else{
                document.getElementById('msg').innerText = "Please confirm your password.";
                flag = 0;
              }
            }
            function validate(){
              if (flag == 1) {
                return true;
              }else{
                return false;
              }
            }
        </script>

    </body>
</html>