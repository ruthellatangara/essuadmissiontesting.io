<?php
session_start();
include 'connect.php';
include 'includes/header.php';
error_reporting (E_ALL ^ E_NOTICE); 

$province = "SELECT * FROM province_tab where provName='$prov'";
$prov_res = mysqli_query($con,$province);
if (mysqli_num_rows($prov_res) == 0) {
  mysqli_query($con,"INSERT INTO province_tab (provName) VALUES ('$prov')");
}


if (isset($_SESSION['email'])) {
echo '
    <div class="container mt-3 mb-4">
        <div class="col-12 img-fluid">
            <img src="img/HEADER.jpg" style="width: 35%">
        </div>
        <h2 class="fw-bold text-center">UNIVERSITY ADMISSION APPLICATION FORM</h2>

        <form class="row g-3 needs-validation" name="forms" id="forms" action="" method="POST" enctype="multipart/form-data"  onsubmit="return validate()" novalidate>

             <div class="col-md-4">
                <label for="fchoice" class="form-label">Academic Year</label>
                <div class="input-group has-validation">
                    <select name="acadyear" id="acadyear" class="form-select select2" required>
                    <option selected=""></option>';
}
?>
            <?php
            if (isset($_SESSION['email'])) {
              include 'connect.php';

              
                $column1="acad_year";
                $column2="sem";
                $column3 = "code";
                $query="SELECT * FROM academic_year where status=1";
                $run=mysqli_query($con,$query);

                if($run){
                  while($row=mysqli_fetch_array($run)){
                  echo"<option value='".$row["$column3"]."'>".$row["$column1"]." ".$row["$column2"]."</option>";
                  }
                 }
                }
            ?>
            </select>
                      <div class="invalid-feedback">
                        Please enter an input in this field.
                      </div>
                </div>
            </div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" href="img/essu-logo.png">
    <link rel="shortcut icon" href="img/essu-logo.png">
    <link rel="stylesheet" href="select2-4.0.13\dist\css\select2.min.css">
    <link rel="stylesheet" href="select2-bootstrap4-theme-master\dist\select2-bootstrap4.min.css">
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="select2-4.0.13\dist\js\select2.min.js"></script>
    <title>Student Admission Form</title>
</head>
<body>
    <?php echo $msg;?>
            <?php
            if (isset($_SESSION['email'])) {
                echo '
                <div class="col-md-4">
                  <label for="campus" class="form-label">Campus</label>
                  <input type="text" class="form-control" name="campus" value="ESSU Main - Borongan City" readonly>
                </div>
                <div class="col-md-4">
                <label for="fchoice" class="form-label">Testing Center</label>
                <div class="input-group has-validation">
                    <select name="t_site" id="t_site" class="form-select select2" required>
                    <option selected=""></option>
                ';
            }
            ?>
            
                        <?php 
                            include 'connect.php';

                            if (isset($_SESSION['email'])) {
                                $column="tcenter";
                                $query="Select * from tcenter_tab";
                                $run=mysqli_query($con,$query);

                                if($run){
                                    while($row=mysqli_fetch_array($run)){
                                    echo"<option value='".$row["$column"]."'>".$row["$column"]."</option>";
                                    }
                                }
                            }
                        ?>
                    </select>
                      <div class="invalid-feedback">
                        Please enter an input in this field.
                      </div>
                </div>
            </div>

            <?php
            if (isset($_SESSION['email'])) {
                echo '
                <div class="fw-bolder">Degree/Program Choices:</div>
                <div class="col-md-4">
                    <label for="fchoice" class="form-label">First Choice</label>
                    <div class="input-group has-validation">
                        <select name="fchoice" id="fchoice" class="form-select select2" required>
                        <option selected=""></option>
                ';
            }
            ?>
            
                        <?php 
                            include 'connect.php';

                            if (isset($_SESSION['email'])) {
                                $column="program";
                                $query="Select * from program_tab";
                                $run=mysqli_query($con,$query);

                                if($run){
                                    while($row=mysqli_fetch_array($run)){
                                        //$progname=$row["$column"];
                                        echo"<option value='".$row["$column"]."'>".$row["$column"]."</option>";
                                    }
                                }
                            }
                        ?>
                    </select>
                      <div class="invalid-feedback">
                        Please enter an input in this field.
                      </div>
                </div>
            </div>

            <?php
            if (isset($_SESSION['email'])) {
                echo '
                <div class="col-md-4">
                <label for="schoice" class="form-label">Second Choice</label>
                <div class="input-group has-validation">
                    <select name="schoice" id="schoice" class="form-select select2" required>
                    <option selected=""></option>
                ';
            }
            ?>
            
                    <?php 
                        include 'connect.php';

                        if (isset($_SESSION['email'])) {
                                $column="program";
                                $query="Select * from program_tab";
                                $run=mysqli_query($con,$query);

                                if($run){
                                    while($row=mysqli_fetch_array($run)){
                                        //$progname=$row["$column"];
                                        echo"<option value='".$row["$column"]."'>".$row["$column"]."</option>";
                                    }
                                }
                            }
                    ?>
                    </select>
                      <div class="invalid-feedback">
                        Please enter an input in this field.
                      </div>
                </div>
            </div>

            <?php
            if (isset($_SESSION['email'])) {
                echo '
                <div class="col-md-4">
                <label for="tchoice" class="form-label">Third Choice</label>
                <div class="input-group has-validation">
                    <select name="tchoice" id="tchoice" class="form-select select2" required>
                    <option selected=""></option>
                ';
            }
            ?>
            
                    <?php 
                        include 'connect.php';

                        if (isset($_SESSION['email'])) {
                                $column="program";
                                $query="Select * from program_tab";
                                $run=mysqli_query($con,$query);

                                if($run){
                                    while($row=mysqli_fetch_array($run)){
                                        //$progname=$row["$column"];
                                        echo"<option value='".$row["$column"]."'>".$row["$column"]."</option>";
                                    }
                                }
                            }
                    ?>
                    </select>
                      <div class="invalid-feedback">
                        Please enter an input in this field.
                      </div>
                </div>
            </div>
            <?php
            if (isset($_SESSION['email'])) {
                
                echo '

            <div class="fw-bolder">Applicants Name</div>

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
              <input type="text" class="form-control" name="mname" id="mname" minlength="2" autocomplete= "off">
              <div class="invalid-feedback">
                Please input this field with a valid format.
              </div>
            </div>
          </div>

            <div class="col-md-5">
            <label for="" class="form-label">Email Address</label>
            <input type="email" class="form-control check_email" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" autocomplete="off" required>
                <div class="invalid-feedback">
                    Email address must include @.
                    
                </div>
                  <small id="mesg" style="color: red;"></small>
            </div>

            <div class="col-md-4">
                <label for="" class="form-label">Contact Number</label>
                <div class="input-group has-validation">
                    <input type="tel" class="form-control" id="contact" name="contact" pattern="^(09|\+639)\d{9}$" autocomplete="off" required>
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
              <input type="date" class="form-control" name="dob"  max="'.date("Y-m-d",strtotime('- 10 years')).'" autocomplete="off" required>
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

            <div class="fw-bolder">Permanent Address</div>
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
              <select class="form-control select2" name="prov" id="prov" required>';
          }
              ?>
                <?php
                include 'connect.php';
                $province = "SELECT * FROM province_tab";
                $prov_run = mysqli_query($con,$province);
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

          <?php
          if (isset($_SESSION['email'])) {
              echo '

            <div class="fw-bolder">Last School Attended</div>
            <div class="col-md-4">
                <label for="school">Name of School</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="school" minlength="2" autocomplete="off" required>
                      <div class="invalid-feedback">
                        Please enter an input in this field.
                      </div>
                </div>
            </div>

            <div class="col-md-4">
                <label for="address">Address</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="address" minlength="2" autocomplete="off" required>
                      <div class="invalid-feedback">
                        Please enter an input in this field.
                      </div>
                </div>
            </div>

            <div class="col-md-2">
                <label for="year">Year</label>
                <!--<?php echo $msg ?>-->
                <div class="input-group has-validation">
                    <input type="text" class="form-control check_year" name="year" autocomplete="off" required>
                      <div class="invalid-feedback">
                        Please enter an input in this field.
                      </div>
                      <small id="ymesg" style="color: red;"></small>
                </div>
            </div>

            <div class="col-md-2">
                <label for="genave">General Average</label>
                <input type="text" class="form-control check_gen" name="genave" id="genave" pattern="^\d+(\.\d+)*$)" autocomplete="off">
                <small id="genmsg" style="color: red;"></small>
            </div>
            <h3 class="fw-bolder">DECLARATION</h3>
            <div class="col-md-12">
            <label for="q1" class="form-label">1. Do you have a physical condition which may affect your performance in college?</label>
            <br>
                <input type="radio" class="" id="q1yes" name="q1" value="Yes" onclick="EnableDisable()" required>Yes
                <input type="radio" class="" id="q1no" name="q1" value="No" onclick="EnableDisable()">No
                    <br>
                    <label for="ifyes" class="form-label">If yes, please state the disciplinary action.</label>
                    <textarea name="q1a" id="ifq1yes" rows="3" class="form-control" disabled></textarea>
                    <script type="text/javascript">
                        function EnableDisable(){
                            var yes = document.getElementById("q1yes");
                            var q1yes = document.getElementById("ifq1yes");
                            q1yes.disabled = yes.checked? false:true;
                            q1yes.value="";
                            if(!q1yes.disabled){
                                q1yes.focus();
                            }
                        }
                    </script>
            </div>
            <div class="col-md-12">
            <label for="q2" class="form-label">2. Have you been subjected to any disciplinary action?</label>
            <br>
                <input type="radio" class="" id="q2yes" name="q2" value="Yes" onclick="EnableDisableTB()" required>Yes
                <input type="radio" class="" id="q2no" name="q2" value="No" onclick="EnableDisableTB()">No
                <br>
                <label for="ifyes" class="form-label">If yes, please state the disciplinary action.</label>
                <textarea name="q2a" id="ifq2yes" rows="3" class="form-control" disabled></textarea>
                <script type="text/javascript">
                    function EnableDisableTB(){
                        var yes = document.getElementById("q2yes");
                        var q2yes = document.getElementById("ifq2yes");
                        q2yes.disabled = yes.checked? false:true;
                        q2yes.value="";
                        if(!q2yes.disabled){
                            q2yes.focus();
                        }
                    }
                </script>
            </div>

            <h5 class="fw-bolder">Please upload the appropriate images of the following: </h5>
            <div class="col-md-4">
            <label for="inputidpic" class="form-label">ID Picture</label>
            <div class="input-group has-validation">
              <input type="file" class="form-control idpic" name="id_pic" >
              <div class="invalid-feedback">
                Please add an input to this field.
              </div>
              <small id="picmsg" style="color: red;"></small>
            </div>
          </div>

          <div class="col-md-4">
            <label for="reportcard" class="form-label">Form 138 (Report Card)</label>
            <div class="input-group has-validation">
              <input type="file" class="form-control repcard" name="rep_card" >
              <div class="invalid-feedback">
                Please add an input to this field.
              </div>
            </div>
            <small id="picmsg" style="color: red;"></small>
          </div>

          <div class="col-md-4">
            <label for="cert" class="form-label">Certificate of Good Moral</label>
            <div class="input-group has-validation">
              <input type="file" class="form-control gmoral" name="g_moral" >
              <div class="invalid-feedback">
                Please add an input to this field.
              </div>
              <small id="picmsg" style="color: red;"></small>
            </div>
          </div>

                
                <div class="col-md-1">
                <button type="submit" name="save" id="save" class="btn btn-primary btn-sm" onclick="insert();">Save </button>
                
                </div>
                <div class="col-md-1">
                    <a href="adm-dashboard.php" class="btn btn-primary btn-sm">Back</a>
                </div>

            <div class="container my-5"></div>
            <div class= "container my-4">
            </div>
        </form>
    </div>
                ';
            }
            ?>
<?php
include 'connect.php';
if (!$con) {
  die(mysqli_error($con));
}

    if (isset($_POST['save'])) {
        $sy=$con->real_escape_string($_POST['acadyear']);
        $campus=$con->real_escape_string($_POST['campus']);
        $t_site=$con->real_escape_string($_POST['t_site']);
        $fchoice=$con->real_escape_string($_POST['fchoice']);
        $schoice=$con->real_escape_string($_POST['schoice']);
        $tchoice=$con->real_escape_string($_POST['tchoice']);
        $lname=$con->real_escape_string($_POST['lname']);
        $fname=$con->real_escape_string($_POST['fname']);
        $mname=$con->real_escape_string($_POST['mname']);
        $email=$con->real_escape_string($_POST['email']);
        $contact=$con->real_escape_string($_POST['contact']);
        $sex=$con->real_escape_string($_POST['sex']);
        $dob=$con->real_escape_string($_POST['dob']);
        $pob=$con->real_escape_string($_POST['pob']);
        $civstat=$con->real_escape_string($_POST['civstat']);
        $brgy=$con->real_escape_string($_POST['brgy']);
        $municip=$con->real_escape_string($_POST['municip']);
        $prov=$con->real_escape_string($_POST['prov']);
        $school=$con->real_escape_string($_POST['school']);
        $address=$con->real_escape_string($_POST['address']);
        $year=$con->real_escape_string($_POST['year']);
        $genave=$con->real_escape_string($_POST['genave']);
        $q1=$con->real_escape_string($_POST['q1']);
        $q1a=$con->real_escape_string($_POST['q1a']);
        $q2=$con->real_escape_string($_POST['q2']);
        $q2a=$con->real_escape_string($_POST['q2a']);

        //$id_pic = addslashes(file_get_contents($_FILES['id_pic']['tmp_name']));
        //$rep_card = addslashes(file_get_contents($_FILES['rep_card']['tmp_name']));
        //$g_moral = addslashes(file_get_contents($_FILES['g_moral']['tmp_name']));

        $img1 = $_FILES['id_pic']['name'];
        $img2 = $_FILES['rep_card']['name'];
        $img3 = $_FILES['g_moral']['name'];
        
        $n_file1 = uniqid("ID",true).'-'.$img1;
        $n_file2 = uniqid("RCARD",true).'-'.$img2;
        $n_file3 = uniqid("GMORAL",true).'-'.$img3;

        $targetdir = "uploads/";
        $tar_file1 = str_replace(' ','_',$targetdir . $n_file1);
        $tar_file2 = str_replace(' ','_',$targetdir . $n_file2);
        $tar_file3 = str_replace(' ','_',$targetdir . $n_file3);

        move_uploaded_file($_FILES["id_pic"]["tmp_name"],$tar_file1);
        move_uploaded_file($_FILES["rep_card"]["tmp_name"],$tar_file2);
        move_uploaded_file($_FILES["g_moral"]["tmp_name"],$tar_file3);

        $insert = "INSERT into account_tab (lname, fname, mname, email, contact, sex, dob, pob, civstat,brgy, mun, prov,sy,campus,tsite,fchoice,schoice,tchoice,lschool,lsaddress,lsy,genave,q1,q1a,q2,q2a,idPic,rCard,gMoral,stat,accYear) VALUES ('$lname','$fname','$mname','$email','$contact','$sex','$dob','$pob','$civstat','$brgy','$municip','$prov','$sy','$campus','$t_site','$fchoice','$schoice','$tchoice','$school','$address','$year','$genave','$q1','$q1a','$q2','$q2a','$tar_file1','$tar_file2','$tar_file3',1,YEAR(NOW()))";
        $res = mysqli_query($con,$insert);
        if($res){
            $update = mysqli_query($con, "UPDATE account_tab set `apprefno` = concat('BOR-',sy,LPAD(accID-1,4,'0')) where email='$email'");
              echo '<script> alert("Data saved successfully."); </script>';
              echo '<script>location.href="adm-all-app.php"</script>';
        }else{
           die(mysqli_error($con));
            echo '<script> alert("Something went wrong."); </script>';
            echo '<script>location.href="adm-addadm.php"</script>';

        }
        
    }
    ?>
    <script>
        function save(){
            var em = document.getElementById("emailadd").pattern;
            var ave = document.getElementById("genave").pattern;
        }
    </script>
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
    <script>
        $(document).ready(function(){
            $('select').on('change', function(event ){
                var prev = $(this).data('previous');
                $('select').not(this).find('option[value="'+prev+'"]').show();
                var value = $(this).val();
                $(this).data('previous',value);
                $('select').not(this).find('option[value="'+value+'"]').hide();
            });
        });    </script>
    <script>
        $(document).ready(function(){
            $('.select2').select2({
          placeholder:'---Select---',
          theme:'bootstrap4',
        })
    });
    </script>
<script>
  $(document).ready(function(){
    $('.check_year').keyup(function(e){
      
      var year = $('.check_year').val();
      
      $.ajax({
        type: "POST",
        url: "stu-adm-code.php",
        data: {
          "check_year":1,
          "year_id":year,
        },
        success: function(data){
          //$('.err_email').text(data);
          if (data != 0) {
            $("#ymesg").html(
              '<p style="color: red">Please input a valid year.</p>'
              );
            $("#save").attr("disabled",true);
          }else{
            $("#ymesg").html(
              '<p style="color: red"></p>'
              );
            $("#save").attr("disabled",false);
          }
        }
      });
    });

    $('.check_gen').keyup(function(e){
      
      var genave = $('.check_gen').val();
      
      $.ajax({
        type: "POST",
        url: "stu-adm-code.php",
        data: {
          "check_gen":1,
          "gen_id":genave,
        },
        success: function(data){
          if (data != 0) {
            $("#genmsg").html(
              '<p style="color: red">You are trying to input incorrect value.</p>'
              );
            $("#save").attr("disabled",true);
          }else{
            $("#genmsg").html(
              '<p style="color: red"></p>'
              );
            $("#save").attr("disabled",false);
          }
        }
      });
    });

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
          if (data != 0) {
            $("#mesg").html(
              '<p style="color: red">Email Address already existing.</p>'
              );
            $("#save").attr("disabled",true);
          }else{
            $("#mesg").html(
              '<p style="color: red"></p>'
              );
            $("#save").attr("disabled",false);
          }
        }
      })
    })
  })
  });
</script>
<script>
    var img1=document.forms['id_pic'];
    var img2=document.forms['rep_card'];
    var img3=document.forms['g_moral'];
    var validExt = ["jpeg","png","jpg"];


    function validate()
    {
        if ((img1.value!='') || (img2.value!='') || (img3.value!='')) {
            var img1_ext=img1.value.substring(img1.value.lastIndexOf('.')+1);
            var img2_ext=img2.value.substring(img2.value.lastIndexOf('.')+1);
            var img3_ext=img3.value.substring(img3.value.lastIndexOf('.')+1);



            var result1 = validExt.includes(img1_ext);
            var result2 = validExt.includes(img2_ext);
            var result3 = validExt.includes(img3_ext);
            //console.log(result);

            if ((result1==false) || (result2==false) || (result3==false)) {
                alert("Selected file is not an image.");
                return false;
            }else{
                if ((parseFloat(img1.files[0].size/(1024*1024))>=5) || (parseFloat(img2.files[0].size/(1024*1024))>=5) || (parseFloat(img3.files[0].size/(1024*1024))>=5)) {
                    alert("File size must be smaller than 5mb");
                    return false;
                }
            }
        }
    }
</script>
<script type="text/javascript">
    var forms = document.getElementById("forms");
    function handleForms(event) {event.preventDefault();}
    forms.addEventListener('submit' handleForms);

    function insert(){
        $(document).ready(function(){
            $.ajax({
                url: "adm-addadm.php",
                type: "POST",
                data: {

                }
            })
        })
    }
</script>
</body>
</html>