<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'mail/PHPMailer.php';
require 'mail/SMTP.php';
require 'mail/Exception.php';
include 'connect.php';
session_start();
include 'connect.php';

$prov = "SELECT * FROM province_tab ORDER BY provName ASC";
$prov_run = mysqli_query($con,$prov);
        $msg="";  
        if(isset($_POST['submit'])){

        function check_input($data){
            $data=trim($data);
            $data=stripslashes($data);
            $data=htmlspecialchars($data);
            return $data;
        }

        
        $lname = $con->real_escape_string($_POST['lname']);
        $fname = $con->real_escape_string($_POST['fname']);
        $mname = $con->real_escape_string($_POST['mname']);
        $emailadd = check_input($_POST['emailadd']);
        $contactno = $con->real_escape_string($_POST['contactno']);
        $sex = $con->real_escape_string($_POST['sex']);
        $dob = $con->real_escape_string($_POST['dob']);
        $pob = $con->real_escape_string($_POST['pob']);
        $civstat = $con->real_escape_string($_POST['civstat']);
        $brgy = $con->real_escape_string($_POST['brgy']);
        $municip = $con->real_escape_string($_POST['municip']);
        $prov = $con->real_escape_string($_POST['prov']);
        $pass = md5(check_input($_POST['pass']));
        $repass = md5(check_input($_POST['repass']));

        $province = "SELECT * FROM province_tab where provName='$prov'";
        $prov_res = mysqli_query($con,$province);
        if (mysqli_num_rows($prov_res) == 0) {
            mysqli_query($con,"INSERT INTO province_tab (provName) VALUES ('$prov')");
        }

                $set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $code=substr(str_shuffle($set), 0, 12);

                $sql = mysqli_query($con, "INSERT INTO account_tab (lname, fname, mname, email, contact, sex, dob, pob, civstat,brgy, mun, prov, pword,code,accYear) VALUES ('$lname','$fname','$mname','$emailadd','$contactno','$sex','$dob','$pob',
                '$civstat','$brgy','$municip','$prov','$pass','$code',YEAR(NOW()))");
                if (!$sql) {
                    die(mysqli_error($con));
                }
                
                
                $uid=mysqli_insert_id($con);
                $output="
                <html>
                <head>
                <title>Verify your account</title>
                </head>
                <body>
                <h2>Thank you for Registering.</h2>
                <p>Please click the link below to activate your account.</p>
                <h4><a href='http://localhost/essu-admission-system/stu-signup-activate.php?uid=$uid&code=$code'>Activate account</h4>
                </body>
                </html>
                ";
                $body = $output;
                $subject = "Sign Up Verification Message";

                $email_to = $emailadd;

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
                        header("location: verify.php");
                    }
        }
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
    <link rel="stylesheet" href="select2-4.0.13\dist\css\select2.min.css">
    <link rel="stylesheet" href="select2-bootstrap4-theme-master\dist\select2-bootstrap4.min.css">
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="select2-4.0.13\dist\js\select2.min.js"></script>
    <title>Register</title>
</head>
<body style="background: linear-gradient(rgba(51, 50, 50, 0.7), rgba(51, 50, 50, 0.7)), url(img/abstract-green.jpg); background-size: cover;">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

        <form action="signup.php" method="POST" class="border shadow p-3 rounded bg-light row g-3 needs-validation" onsubmit="return validate()" novalidate>

            <h2>Register to have an account</h2>

          <div class="col-md-4">
            <label for="lname">Last Name</label>
              <div class="input-group has-validation">
                <input type="text" class="form-control" name="lname" id="lname" minlength="2" autocomplete="off" required>
                <div class="invalid-feedback">
                  Please input this field with a valid format.
                </div>
              </div>
          </div>

          <div class="col-md-4">
            <label for="" class="form-label">First Name</label>
              <div class="input-group has-validation">
                <input type="text" class="form-control" name="fname" autocomplete="off" required>
                <div class="invalid-feedback">
                  Please input this field with a valid format.
                </div>
              </div>
          </div>

          <div class="col-md-4">
            <label for="" class="form-label">Middle Name</label>
            <div class="input-group has-validation">
              <input type="text" class="form-control" name="mname" id="mname" minlength="2">
              <div class="invalid-feedback">
                Please input this field with a valid format.
              </div>
            </div>
          </div>

          <div class="col-md-5">
            <label for="" class="form-label">Email Address</label>
            <input type="email" class="form-control check_email" id="emailadd" name="emailadd" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" autocomplete="off" required>
                <div class="invalid-feedback">
                    Email address must include '@'.
                    
                </div>
                  <small id="mesg" style="color: red;"></small>
            </div>

            <div class="col-md-4">
                <label for="" class="form-label">Contact Number</label>
                <div class="input-group has-validation">
                    <input type="tel" class="form-control" id="contactno" name="contactno" pattern="^(09|\+639)\d{9}$" autocomplete="off" required>
                    <div class="invalid-feedback">
                        Contact number must be numeric with a maximum length of 11 digits.
                    </div>
                </div>
            </div>

            <div class="col-md-3">
            <label for="" class="form-label">Sex</label>
            <div class="input-group has-validation">
              <select class="form-select select2" name="sex" id="sex" required>
                <option selected="selected"></option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
              <div class="invalid-feedback">
                Please input this field.
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <label for="" class="form-label">Date of Birth</label>
            <div class="input-group has-validation">
              <input type="date" class="form-control" name="dob"  max="<?php echo date("Y-m-d",strtotime('- 10 years')); ?>" autocomplete="off" required>
              <div class="invalid-feedback">
                Please input this field.
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <label for="" class="form-label">Place of Birth</label>
            <div class="input-group has-validation">
              <input type="text" class="form-control" name="pob" autocomplete="off" minlength="2" required>
              <div class="invalid-feedback">
                Please input this field.
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <label for="" class="form-label">Civil Status</label>
            <div class="input-group has-validation">
              <select class="form-select select2" name="civstat" id="civstat" required>
                <option selected="selected"></option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Separated">Separated</option>
                <option value="Widowed">Widowed</option>
              </select>
              <div class="invalid-feedback">
                Please input this field.
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <label for="" class="form-label">Barangay</label>
            <div class="input-group has-validation">
              <input type="text" class="form-control" name="brgy" autocomplete="off" minlength="2" required>
              <div class="invalid-feedback">
                Please input this field.
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <label for="" class="form-label">Municipality</label>
            <div class="input-group has-validation">
              <select class="form-control select2" name="municip" id="municip" required>
                <option selected="selected"></option>
                <option value="Arteche">Arteche</option>
                <option value="Balangiga">Balangiga</option>
                <option value="Balangkayan">Balangkayan</option>
                <option value="Borongan">Borongan</option>
                <option value="Can-avid">Can-avid</option>
                <option value="Dolores">Dolores</option>
                <option value="General MacArthur">General MacArthur</option>
                <option value="Giporlos">Giporlos</option>
                <option value="Guiuan">Guiuan</option>
                <option value="Hernani">Hernani</option>
                <option value="Jipapad">Jipapad</option>
                <option value="Lawaan">Lawaan</option>
                <option value="Llorente">Llorente</option>
                <option value="Maslog">Maslog</option>
                <option value="Maydolong">Maydolong</option>
                <option value="Mercedes">Mercedes</option>
                <option value="Oras">Oras</option>
                <option value="Quinapondan">Quinapondan</option>
                <option value="Salcedo">Salcedo</option>
                <option value="San Julian">San Julian</option>
                <option value="San Policarpo">San Policarpo</option>
                <option value="Sulat">Sulat</option>
                <option value="Taft">Taft</option>
            </select>
              <div class="invalid-feedback">
                Please input this field.
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <label for="" class="form-label">Province</label>
            <div class="input-group has-validation">
              <select class="form-control select2" name="prov" id="prov" required>
                <?php
                foreach($prov_run as $row)
                {
                  echo '<option value="'.$row['provName'].'">'.$row['provName'].'</option>';
                }
                ?>
            </select>
              <div class="invalid-feedback">
                Please input this field.
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-text" id="">
                    <i class="fa fa-key"></i>
                </span>
                <input type="password" class="form-control" name="pass" id="pass" placeholder="Enter your Password" required>
                <span class="input-group-text">
                    <a href="#" class="text-dark" id="icon-click">
                        <i class="fa fa-eye" id="icon"></i>
                    </a>
                </span>
                <div class="invalid-feedback">
                  Please provide a password.
                </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-text" id="">
                    <i class="fa fa-key"></i>
                </span>
                <input type="password" class="form-control" name="repass" id="repass" placeholder="Confirm Password" onkeyup="check(this)" required>
                <span class="input-group-text">
                        <a href="#" class="text-dark" id="re-icon-click">
                            <i class="fa fa-eye" id="re-icon"></i>
                        </a>
                    </span>
                <div class="invalid-feedback">
                  Please confirm your password.
                </div>
            </div>
          </div>
            <div class="col-md-4"></div>
            <div class="mt-4 p-1 col-md-4">
                <p class="text-center text-danger" id="msg"></p>
                <button type="submit" name="submit" id="submit" class="btn btn-primary btn-sm text-light" style="width: 100%;"><i class="fa fa-paper-airplane"></i> Submit</button>
            </div>
            <div class="col-md-4"></div>
        </form>
        
    </div>
    <script type="text/javascript">
        (function () {
          'use strict'

          var forms = document.querySelectorAll('.needs-validation')

          Array.prototype.slice.call(forms)
            .forEach(function (form) {
              form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                  event.preventDefault()
                  event.stopPropagation()
                }

                form.classList.add('was-validated')
              }, false)
            })
        })()
    </script>

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
    <script type="text/javascript">
        $(document).ready(function(){
            $("#re-icon-click").click(function(){
                $("#re-icon").toggleClass('fa-eye-slash');

                var input = $("#repass");
                if(input.attr("type")==="password"){
                    input.attr("type","text");
                }else{
                    input.attr("type","password");
                }
            })
        });
    </script>
    <script>
        $(document).ready(function(){
            $('.select2').select2({
          placeholder:'---Select---',
          theme:'bootstrap4',
          tags:true,
        })
    });
    </script>
    <script>
        var pword = document.getElementById('pass');
        var flag = 1;
        function check(elem){
          if (elem.value.length > 0) {
            if (elem.value != pass.value) {
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
    <script>
  $(document).ready(function(){
    $('.check_email').keyup(function(e){
      
      var email = $('.check_email').val();
      
      $.ajax({
        type: "POST",
        url: "signup-email.php",
        data: {
          "check_sub":1,
          "email_id":email,
        },
        success: function(data){
          //$('.err_email').text(data); 
          if (data != 0) {
            $("#mesg").html(
              '<p style="color: red">Email Address already existing.</p>'
              );
            $("#submit").attr("disabled",true);
          }else{
            $("#mesg").html(
              '<p style="color: red"></p>'
              );
            $("#submit").attr("disabled",false);
          }
        }
      })
    })
  })
</script>
</body>
</html>