<?php
session_start();
include 'connect.php';
include 'includes/header.php';
error_reporting (E_ALL ^ E_NOTICE); 


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
    
            <?php
            if (isset($_SESSION['email'])) {
                echo '
                <div class="col-md-4">
                  <label for="campus" class="form-label">Campus</label>
                  <input type="text" class="form-control" name="campus" value="ESSU Main - Borongan City" readonly>
                </div>
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
                        <select name="fchoice" id="fchoice" class="form-select" onkeyup="check(this)" required>
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
                    <select name="schoice" id="schoice" class="form-select" required>
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
                    <select name="tchoice" id="tchoice" class="form-select" required>
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
                $sql="SELECT * from account_tab where email='".$_SESSION['email']."'";
                $result=mysqli_query($con,$sql);
                /*if($result==FALSE)
                {
                    die(mysqli_error($con));
                }*/
                        $row=mysqli_fetch_assoc($result);
                        $lname = $row['lname'];
                        $fname = $row['fname'];
                        $mname = $row['mname'];
                        $email = $row['email'];
                        $contact = $row['contact'];
                        $sex = $row['sex'];
                        $dob = $row['dob'];
                        $pob = $row['pob'];
                        $civstat = $row['civstat'];
                        $brgy = $row['brgy'];
                        $mun = $row['mun'];
                        $prov = $row['prov'];
                echo '

            <div class="fw-bolder">Applicants Name</div>

            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" name="lname" value="'.$lname.'" readonly>
                <label for="lname">Last Name</label>
            </div>

            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" name="fname" value="'.$fname.'" readonly>
                <label for="fname">First Name</label>
            </div>

            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" name="mname" value="'.$mname.'" readonly>
                <label for="mname">Middle Name</label>
            </div>

            <div class="col-md-8">
                <label for="emailadd" class="form-label">Email Address</label>
                <input type="text" class="form-control" id="emailadd" name="emailadd" value="'.$email.'" readonly>
            </div>

            <div class="col-md-4">
                <label for="contactno" class="form-label">Contact Number</label>
                <input type="text" class="form-control" id="contactno" name="contactno" value="'.$contact.'" readonly>
            </div>

            <div class="col-md-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" name="dob" value="'.$dob.'" readonly>
            </div>

            <div class="col-md-4">
                <label for="pob" class="form-label">Place of Birth</label>
                <input type="text" class="form-control" name="pob" value="'.$pob.'" readonly>
            </div>

            <div class="col-md-2">
                <label for="sex" class="form-label">Sex</label>
                <input type="text" class="form-control" name="sex" value="'.$sex.'" readonly>
            </div>

            <div class="col-md-3">
                <label for="status" class="form-label">Civil Status</label>
                <input type="text" class="form-control" name="civstat" value="'.$civstat.'" readonly>
            </div>

            <div class="fw-bolder">Permanent Address</div>
            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" name="brgy" value="'.$brgy.'" readonly>
                <label for="brgy">Barangay</label>
            </div>

            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" name="municip" value="'.$mun.'" readonly>
                <label for="municip">Municipality/City</label>
            </div>

            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" name="prov" value="'.$prov.'" readonly>
                <label for="prov">Province</label>
            </div>

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
                      <small id="mesg" style="color: red;"></small>
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
              <input type="file" class="form-control idpic" name="id_pic" required>
              <div class="invalid-feedback">
                Please add an input to this field.
              </div>
              <small id="picmsg" style="color: red;"></small>
            </div>
          </div>

          <div class="col-md-4">
            <label for="reportcard" class="form-label">Form 138 (Report Card)</label>
            <div class="input-group has-validation">
              <input type="file" class="form-control repcard" name="rep_card" required>
              <div class="invalid-feedback">
                Please add an input to this field.
              </div>
            </div>
            <small id="picmsg" style="color: red;"></small>
          </div>

          <div class="col-md-4">
            <label for="cert" class="form-label">Certificate of Good Moral</label>
            <div class="input-group has-validation">
              <input type="file" class="form-control gmoral" name="g_moral" required>
              <div class="invalid-feedback">
                Please add an input to this field.
              </div>
              <small id="picmsg" style="color: red;"></small>
            </div>
          </div>

            <div></div>
            <h3 class="fw-bold text-center my-3">UNDERTAKING</h3>
                <label for="checkcertify" class="form-check-label text-justify">By clicking YES, I affirm that:
                    <p>a.) All the information stated in this form are true, accurate, and complete.
                    <br>
                    b.) I will abide with the policies, guidelines, and procedures of the University on test administration.
                    <br>
                    c.) I am aware that any false information stated in this application or withholding information will disqualify me from taking the test. 
                    <br>
                    d.) Any information stated in this form may be cross-validated with the documents I have submitted as admission requirements.
                    <br>
                    e.) I understand that the test result will not be released until I satisfy all the required documents for admission.</p>

                </label>
                <div class="col-md-1">
                <button type="submit" name="save" id="save" class="btn btn-primary btn-sm" onclick="insert();">Yes </button>
                
                </div>
                <div class="col-md-1">
                    <a href="stu-dashboard.php" class="btn btn-primary btn-sm">Back</a>
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
    if (isset($_POST['save'])) {
        $acadyear=$con->real_escape_string($_POST['acadyear']);
        $campus=$con->real_escape_string($_POST['campus']);
        $t_site=$con->real_escape_string($_POST['t_site']);
        $fchoice=$con->real_escape_string($_POST['fchoice']);
        $schoice=$con->real_escape_string($_POST['schoice']);
        $tchoice=$con->real_escape_string($_POST['tchoice']);
        $school=$con->real_escape_string($_POST['school']);
        $address=$con->real_escape_string($_POST['address']);
        $year=$con->real_escape_string($_POST['year']);
        $genave=$con->real_escape_string($_POST['genave']);
        $q1=$con->real_escape_string($_POST['q1']);
        $q1a=$con->real_escape_string($_POST['q1a']);
        $q2=$con->real_escape_string($_POST['q2']);
        $q2a=$con->real_escape_string($_POST['q2a']);

        /*$id_pic = addslashes(file_get_contents($_FILES['id_pic']['tmp_name']));
        $rep_card = addslashes(file_get_contents($_FILES['rep_card']['tmp_name']));
        $g_moral = addslashes(file_get_contents($_FILES['g_moral']['tmp_name']));*/

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
        
        $insert = "UPDATE account_tab set sy='$acadyear',`apprefno` = concat('BOR-',sy,LPAD(accID-1,4,'0')),campus='$campus',tsite='$t_site',fchoice='$fchoice',schoice='$schoice',tchoice='$tchoice',lschool=' $school',lsaddress='$address',lsy='$year',genave='$genave',q1='$q1',q1a='$q1a',q2='$q2',q2a='$q2a',idPic='$tar_file1',rCard='$tar_file2',gMoral='$tar_file3',stat=1 WHERE email='".$_SESSION['email']."'";
        
        $res = mysqli_query($con,$insert);
        if($res){
               echo '<script> alert("You have successfully saved your data."); </script>';
                echo '<script>location.href="stu-dashboard.php"</script>';
        }else{
            echo '<script> alert("There has a problem while saving the data."); </script>';
            echo '<script>location.href="stu-dashboard.php"</script>';
        }
        echo '<script> alert("You have successfully saved your data."); </script>';
        echo '<script>location.href="stu-dashboard.php"</script>';
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
        });    
    </script>
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
            $("#mesg").html(
              '<p style="color: red">Please input a valid year.</p>'
              );
            $("#save").attr("disabled",true);
          }else{
            $("#mesg").html(
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
          //$('.err_email').text(data);
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

            //console.log(img_ext);

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
        }else{
            alert("No image is selected.");
            return false;
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
                url: "stu-admform.php",
                type: "POST",
                data: {

                }
            })
        })
    }
</script>
</body>
</html>