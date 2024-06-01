<?php
session_start();
include 'connect.php';

error_reporting (E_ALL ^ E_NOTICE); 

if (isset($_SESSION['email'])) {
    $sqli="SELECT sy,tsite from account_tab where email='".$_SESSION['email']."'";
    $sqli_result=mysqli_query($con,$sqli);
          
        $row=mysqli_fetch_assoc($sqli_result);
        $sy = $row['sy'];
        $tsite = $row['tsite'];

        $select = mysqli_query($con, "SELECT acad_year, sem FROM academic_year where code='".$sy."'");
        $rows=mysqli_fetch_assoc($select);
        $acadYear = $rows['acad_year'];
        $sem = $rows['sem'];
        
        echo '
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
            <div class="container mt-3 mb-4">
            <div class="col-12 img-fluid">
                <img src="img/HEADER.jpg" style="width: 35%">
            </div>
            <h2 class="fw-bold text-center">UNIVERSITY ADMISSION APPLICATION FORM</h2>
    
            <form class="row g-3 needs-validation" name="forms" id="forms" action="stu-admform-existing.php" method="POST" enctype="multipart/form-data" onsubmit="return validate()" novalidate>
                 <div class="col-md-4">
                <label for="" class="form-label">Academic Year</label>
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
        <?php
            if (isset($_SESSION['email'])) {
                $sqli="SELECT sy,tsite from account_tab where email='".$_SESSION['email']."'";
                $sqli_result=mysqli_query($con,$sqli);
          
                $row=mysqli_fetch_assoc($sqli_result);
                $tsite = $row['tsite'];
                echo '
                <div class="col-md-4">
                  <label for="campus" class="form-label">Campus</label>
                  <input type="text" class="form-control" name="campus" value="ESSU Main - Borongan City" readonly>
                </div>
                <div class="col-md-4">
                <label for="fchoice" class="form-label">Testing Center</label>
                <div class="input-group has-validation">
                    <select name="t_site" id="t_site" class="form-select select2" required>
                    <option selected="'.$tsite.'">'.$tsite.'</option>
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
                $sqli="SELECT fchoice from account_tab where email='".$_SESSION['email']."'";
                $sqli_result=mysqli_query($con,$sqli);
                  
                $row=mysqli_fetch_assoc($sqli_result);
                $fchoice = $row['fchoice'];
                echo '
                <div class="fw-bolder">Degree/Program Choices:</div>
                <div class="col-md-4">
                    <label for="fchoice" class="form-label">First Choice: </label>
                    <div class="input-group has-validation">
                        <select name="fchoice" id="fchoice" class="form-select" required>
                        <option selected="'.$fchoice.'">'.$fchoice.'</option>
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
                $sqli="SELECT schoice from account_tab where email='".$_SESSION['email']."'";
                $sqli_result=mysqli_query($con,$sqli);
                              
                $row=mysqli_fetch_assoc($sqli_result);
                $schoice = $row['schoice'];
                echo '
                <div class="col-md-4">
                <label for="schoice" class="form-label">Second Choice: </label>
                <div class="input-group has-validation">
                    <select name="schoice" id="schoice" class="form-select" required>
                    <option selected="'.$schoice.'">'.$schoice.'</option>
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
                $sqli="SELECT tchoice from account_tab where email='".$_SESSION['email']."'";
                $sqli_result=mysqli_query($con,$sqli);
                              
                $row=mysqli_fetch_assoc($sqli_result);
                $tchoice = $row['tchoice'];
                echo '
                <div class="col-md-4">
                <label for="tchoice" class="form-label">Third Choice: </label>
                <div class="input-group has-validation">
                    <select name="tchoice" id="tchoice" class="form-select" required>
                    <option selected="'.$tchoice.'">'.$tchoice.'</option>
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
               $sqli="SELECT apprefno,campus,tsite,fchoice,schoice,tchoice,lname,fname,mname,email,contact,dob,pob,sex,civstat,brgy,mun,prov,lschool,lsaddress,lsy,genave,q1,q1a,q2,q2a from account_tab where email='".$_SESSION['email']."'";
                $sqli_result=mysqli_query($con,$sqli);
                      
                    $row=mysqli_fetch_assoc($sqli_result);
                    $apprefno = $row['apprefno'];
                    $sy = $row['sy'];
                    $campus = $row['campus'];
                    $lname = $row['lname'];
                    $fname = $row['fname'];
                    $mname = $row['mname'];
                    $email = $row['email'];
                    $contact = $row['contact'];
                    $sex = $row['sex'];
                    $dob = $row['dob'];
                    $pob = $row['pob'];
                    $stat = $row['civstat'];
                    $brgy = $row['brgy'];
                    $mun = $row['mun'];
                    $prov = $row['prov'];
                    $lschool = $row['lschool'];
                    $laddress = $row['lsaddress'];
                    $lsy = $row['lsy'];
                    $genave = $row['genave'];
                    $q1 = $row['q1'];
                    $q1a = $row['q1a'];
                    $q2= $row['q2'];
                    $q2a= $row['q2a'];
                    
                    echo '

                <div class="fw-bolder">Applicant Name</div>
                <div class="col-md-4">
                <label for="lname"  class="form-label">Last Name</label>
                    <div class="input-group has-validation">
                        <input type="text" class="form-control" name="lname" id="lname" minlength="2" value="'.$lname.'" autocomplete="off" required>
                        <div class="invalid-feedback">
                          Please input this field with a valid format.
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                <label for="" class="form-label">First Name</label>
                    <div class="input-group has-validation">
                        <input type="text" class="form-control" name="fname" id="fname" minlength="2" value="'.$fname.'" autocomplete="off" required>
                        <div class="invalid-feedback">
                          Please input this field with a valid format.
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                <label for="" class="form-label">Middle Name</label>
                    <div class="input-group has-validation">
                      <input type="text" class="form-control" name="mname" id="mname" value="'.$mname.'" minlength="2">
                      <div class="invalid-feedback">
                        Please input this field with a valid format.
                      </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <label for="emailadd" class="form-label">Email Address</label>
                    <input type="text" class="form-control" name="email" value="'.$email.'" readonly required>
                    <small id="mesg" style="color: red;"></small>
                </div>
                <div class="col-md-4">
                    <label for="" class="form-label">Contact Number</label>
                    <div class="input-group has-validation">
                        <input type="tel" class="form-control" id="contactno" name="contactno" value="'.$contact.'" pattern="^(09|\+639)\d{9}$" autocomplete="off" required>
                        <div class="invalid-feedback">
                            Contact number must be numeric with a maximum length of 11 digits.
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                <label for="" class="form-label">Date of Birth</label>
                    <div class="input-group has-validation">
                      <input type="date" class="form-control" name="dob"  max="'.date("Y-m-d",strtotime('- 10 years')).'" value="'.$dob.'" autocomplete="off" required>
                      <div class="invalid-feedback">
                        Please enter an input to this field.
                      </div>
                    </div>
                </div>
                <div class="col-md-4">
                <label for="" class="form-label">Place of Birth</label>
                    <div class="input-group has-validation">
                      <input type="text" class="form-control" name="pob" value="'.$pob.'" autocomplete="off" minlength="2" required>
                      <div class="invalid-feedback">
                        Please enter an input to this field.
                      </div>
                    </div>
                </div>
                <div class="col-md-2">
                <label for="" class="form-label">Sex</label>
                    <div class="input-group has-validation">
                      <select class="form-select select2" name="sex" id="sex" required>
                        <option selected="'.$sex.'">'.$sex.'</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                      <div class="invalid-feedback">
                        Please input this field.
                      </div>
                    </div>
                </div>
                <div class="col-md-3">
                <label for="" class="form-label">Civil Status</label>
                    <div class="input-group has-validation">
                      <select class="form-select select2" name="stat" id="stat" required>
                        <option selected="'.$stat.'">'.$stat.'</option>
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
                      <input type="text" class="form-control" name="brgy" value="'.$brgy.'" autocomplete="off" minlength="2" required>
                      <div class="invalid-feedback">
                        Please input this field.
                      </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="" class="form-label">Municipality</label>
                    <div class="input-group has-validation">
                        <select class="form-control select2" name="municip" id="municip" required>
                            <option selected="'.$mun.'">'.$mun.'</option>
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
                    </div>
                </div>
                <div class="col-md-4">
            <label for="" class="form-label">Province</label>
            <div class="input-group has-validation">
              <select class="form-control select2" name="prov" id="prov" required>
              <option selected="'.$prov.'">'.$prov.'</option>
                ';
        }
        ?>
        <?php
        if (isset($_SESSION['email'])) {
            $prov = "SELECT * FROM province_tab ORDER BY provName ASC";
            $prov_run = mysqli_query($con,$prov);
                      
            $row=mysqli_fetch_assoc($sqli_result);
            $prov = $row['prov'];

            foreach($prov_run as $row)
                {
                  echo '<option value="'.$row['provName'].'">'.$row['provName'].'</option>';
                }
        }
        ?>
        </select>
            </div>
          </div>
        <?php
        if(isset($_SESSION['email']))
        {
            echo '
                
            <div class="fw-bolder">Last School Attended</div>
            <div class="col-md-4">
            <label for="school" class="form-label">Name of School</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="school" id="school" minlength="2" autocomplete="off" value="'.$lschool.'" required>
                    <div class="invalid-feedback">
                        Please enter an input in this field.
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <label for="address" class="form-label">Address</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="address" minlength="2" autocomplete="off" value="'.$laddress.'" required>
                      <div class="invalid-feedback">
                        Please enter an input in this field.
                      </div>
                </div>
            </div>

            <div class="col-md-2">
                <label for="year" class="form-label">Year</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control check_year" name="year" autocomplete="off" value="'.$lsy.'" required>
                      <div class="invalid-feedback">
                        Please enter an input in this field.
                      </div>
                      <small id="ymesg" style="color: red;"></small>
                </div>
            </div>

            <div class="col-md-2">
                <label for="genave" class="form-label">General Average</label>
                <input type="text" class="form-control check_gen" name="genave" id="genave" pattern="^\d+(\.\d+)*$)" value="'.$genave.'" autocomplete="off" required>
                <small id="genmsg" style="color: red;"></small>
            </div>
    
                <h3 class="fw-bolder">DECLARATION</h3>
                <div class="row g-3 col-md-12">
                    <label for="q1" class="form-label">1. Do you have a physical condition which may affect your performance in college?</label>
                    <br>
                    <div class="col-md-1">
                        <input type="text" class="form-control" name="q1" value="'.$q1.'" required>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="q1a" value="'.$q1a.'">
                    </div>
                </div>

                <div class="row g-3 col-md-12">
                    <label for="q1" class="form-label">2. Have you been subjected to any disciplinary action?</label>
                    <br>
                    <div class="col-md-1">
                        <input type="text" class="form-control" name="q2" value="'.$q2.'" required>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="q2a" value="'.$q2a.'">
                    </div>
                </div>


                <div class="col-md-3">
                    <h5 class="fw-bolder">Uploaded required files:</h5>
                </div>';
    }
    ?>

                <?php
                include 'connect.php';
                if (isset($_SESSION['email'])) {
                    $apprefno=$_GET['id'];
                    $sql = mysqli_query($con, "SELECT idPic,rCard,gMoral FROM account_tab where email='".$_SESSION['email']."'");
                    $uploads = mysqli_fetch_array($sql);
                    ?>
                    <!--<a href="stu-admform-existing.php" class="btn btn-primary btn-sm">&#8592;</a>-->
                            <div style="width: 100%; height: 100%; padding: 5px;">
                                <table>
                                    <tr class="text-center">
                                        <td><label>ID Picture</label></td>
                                        <td><label>Report Card</label></td>
                                        <td><label>Good Moral</label></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>
                                            <img src="<?php echo $uploads['idPic']?>" alt="" style="width: 80%;height: 80%;">
                                        </td>
                                        <td>
                                            <img src="<?php echo $uploads['rCard']?>" alt="" style="width: 80%;height: 80%;">
                                        </td>
                                        <td>
                                            <img src="<?php echo $uploads['gMoral']?>" alt="" style="width: 80%;height: 80%;">
                                        </td>
                                    </tr>
                                </table>
                                
                            </div>
                    <?php
                }
                ?>
<?php
if (isset($_SESSION['email'])) {
    echo '

                <h5 class="fw-bolder">Resubmit the appropriate images of the following if you want to alter the saved data: </h5>
                <div class="col-md-4">
                <label for="inputidpic" class="form-label">ID Picture</label>
                <div class="input-group has-validation">
                  <input type="file" class="form-control" name="id_pic" value="">
                  <div class="invalid-feedback">
                    Please add an input to this field.
                  </div>
                  <small id="picmsg" style="color: red;"></small>
                </div>
              </div>

              <div class="col-md-4">
                <label for="reportcard" class="form-label">Form 138 (Report Card)</label>
                <div class="input-group has-validation">
                  <input type="file" class="form-control" name="rep_card" value="">
                  <div class="invalid-feedback">
                    Please add an input to this field.
                  </div>
                </div>
                <small id="picmsg" style="color: red;"></small>
              </div>

              <div class="col-md-4">
                <label for="cert" class="form-label">Certificate of Good Moral</label>
                <div class="input-group has-validation">
                  <input type="file" class="form-control" name="g_moral" value="">
                  <div class="invalid-feedback">
                    Please add an input to this field.
                  </div>
                  <small id="picmsg" style="color: red;"></small>
                </div>
              </div>';
          }?>

                <?php
                if (isset($_SESSION['email'])) {
                    echo '
                    <div class="col-md-5">
                        <a href="stu-dashboard.php" class="btn btn-danger btn-sm">Back</a>
                        <button type="submit" name="save" id="save" class="btn btn-primary btn-sm">Save </button>
                
                    </div>
                

                    <div class="col-md-3">
                
                    </div>
                    ';
                }
                ?>
            </form>
        </div>
    </body>
<?php
if (isset($_POST['save'])) {
    $sql = "SELECT * from account_tab where stat=1 and stat1=0 AND email='".$_SESSION['email']."'";
    $query_run =mysqli_query($con,$query);
    /**/

    if(mysqli_num_rows($query_run) == true){

        /*$img1 = $_FILES['id_pic']['name'];
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

        ,idPic='$tar_file1',rCard='$tar_file2',gMoral='$tar_file3'
        */
        if ($_FILES['id_pic']['name'] != '') {
                $sy=$con->real_escape_string($_POST['acadyear']);
                $campus=$con->real_escape_string($_POST['campus']);
                $t_site=$con->real_escape_string($_POST['t_site']);
                $fchoice=$con->real_escape_string($_POST['fchoice']);
                $schoice=$con->real_escape_string($_POST['schoice']);
                $tchoice=$con->real_escape_string($_POST['tchoice']);
                $lname = $con->real_escape_string($_POST['lname']);
                $fname = $con->real_escape_string($_POST['fname']);
                $mname = $con->real_escape_string($_POST['mname']);
                $email = $con->real_escape_string($_POST['email']);
                $contactno = $con->real_escape_string($_POST['contactno']);
                $sex = $con->real_escape_string($_POST['sex']);
                $dob = $con->real_escape_string($_POST['dob']);
                $pob = $con->real_escape_string($_POST['pob']);
                $civstat = $con->real_escape_string($_POST['stat']);
                $brgy = $con->real_escape_string($_POST['brgy']);
                $municip = $con->real_escape_string($_POST['municip']);
                $prov = $con->real_escape_string($_POST['prov']);
                $school=$con->real_escape_string($_POST['school']);
                $address=$con->real_escape_string($_POST['address']);
                $year=$con->real_escape_string($_POST['year']);
                $genave=$con->real_escape_string($_POST['genave']);
                $q1=$con->real_escape_string($_POST['q1']);
                $q1a=$con->real_escape_string($_POST['q1a']);
                $q2=$con->real_escape_string($_POST['q2']);
                $q2a=$con->real_escape_string($_POST['q2a']);

                $img1 = $_FILES['id_pic']['name'];
                $n_file1 = uniqid("ID",true).'-'.$img1;
                $targetdir = "uploads/";
                $tar_file1 = str_replace(' ','_',$targetdir . $n_file1);
                move_uploaded_file($_FILES["id_pic"]["tmp_name"],$tar_file1);

                $insert = "UPDATE account_tab set sy='$sy',campus='$campus',tsite='$t_site',fchoice='$fchoice',schoice='$schoice',tchoice='$tchoice',lname='$lname',fname ='$fname',mname='$mname',email='$email',contact='$contact',sex='$sex',dob='$dob',pob='$pob',civstat='$civstat',brgy='$brgy',mun='$municip',prov='$prov',lschool=' $school',lsaddress='$address',lsy='$year',genave=' $genave',q1='$q1',q1a='$q1a',q2='$q2',q2a='$q2a',idPic='$tar_file1' WHERE email='".$_SESSION['email']."'";
        
                $res = mysqli_query($con,$insert);
                
                $province = mysqli_query($con, "SELECT * FROM province_tab where provName='$prov'");
                if (mysqli_num_rows($province) == 0) {
                    mysqli_query($con,"INSERT INTO province_tab (provName) VALUES ('$prov')");
                }

                if($res){
                    
                       echo '<script> alert("You have successfully updated your data."); </script>';
                        echo '<script>location.href="stu-dashboard.php"</script>'; 
                }else{
                    echo '<script> alert("There is a problem while saving the data."); </script>';
                    echo "<script>location.href='stu-dashboard.php'</script>";
                }

        }if ($_FILES['rep_card']['name'] != '') {
                $sy=$con->real_escape_string($_POST['acadyear']);
                $campus=$con->real_escape_string($_POST['campus']);
                $t_site=$con->real_escape_string($_POST['t_site']);
                $fchoice=$con->real_escape_string($_POST['fchoice']);
                $schoice=$con->real_escape_string($_POST['schoice']);
                $tchoice=$con->real_escape_string($_POST['tchoice']);
                $lname = $con->real_escape_string($_POST['lname']);
                $fname = $con->real_escape_string($_POST['fname']);
                $mname = $con->real_escape_string($_POST['mname']);
                $email = $con->real_escape_string($_POST['email']);
                $contactno = $con->real_escape_string($_POST['contactno']);
                $sex = $con->real_escape_string($_POST['sex']);
                $dob = $con->real_escape_string($_POST['dob']);
                $pob = $con->real_escape_string($_POST['pob']);
                $civstat = $con->real_escape_string($_POST['stat']);
                $brgy = $con->real_escape_string($_POST['brgy']);
                $municip = $con->real_escape_string($_POST['municip']);
                $prov = $con->real_escape_string($_POST['prov']);
                $school=$con->real_escape_string($_POST['school']);
                $address=$con->real_escape_string($_POST['address']);
                $year=$con->real_escape_string($_POST['year']);
                $genave=$con->real_escape_string($_POST['genave']);
                $q1=$con->real_escape_string($_POST['q1']);
                $q1a=$con->real_escape_string($_POST['q1a']);
                $q2=$con->real_escape_string($_POST['q2']);
                $q2a=$con->real_escape_string($_POST['q2a']);

                $img2 = $_FILES['rep_card']['name'];
                $n_file2 = uniqid("RCARD",true).'-'.$img2;
                $targetdir = "uploads/";
                $tar_file2 = str_replace(' ','_',$targetdir . $n_file2);
                move_uploaded_file($_FILES["rep_card"]["tmp_name"],$tar_file2);

                $insert = "UPDATE account_tab set sy='$sy',campus='$campus',tsite='$t_site',fchoice='$fchoice',schoice='$schoice',tchoice='$tchoice',lname='$lname',fname ='$fname',mname='$mname',email='$email',contact='$contact',sex='$sex',dob='$dob',pob='$pob',civstat='$civstat',brgy='$brgy',mun='$municip',prov='$prov',lschool=' $school',lsaddress='$address',lsy='$year',genave=' $genave',q1='$q1',q1a='$q1a',q2='$q2',q2a='$q2a',rCard='$tar_file2' WHERE email='".$_SESSION['email']."'";
        
                $res = mysqli_query($con,$insert);
                $province = mysqli_query($con, "SELECT * FROM province_tab where provName='$prov'");
                if (mysqli_num_rows($province) == 0) {
                    mysqli_query($con,"INSERT INTO province_tab (provName) VALUES ('$prov')");
                }
                if($res){
                    
                       echo '<script> alert("You have successfully updated your data."); </script>';
                        echo '<script>location.href="stu-dashboard.php"</script>'; 
                }else{
                    echo '<script> alert("There is a problem while saving the data."); </script>';
                    echo "<script>location.href='stu-dashboard.php'</script>";
                }

        }if ($_FILES['g_moral']['name'] != '') {
                $sy=$con->real_escape_string($_POST['acadyear']);
                $campus=$con->real_escape_string($_POST['campus']);
                $t_site=$con->real_escape_string($_POST['t_site']);
                $fchoice=$con->real_escape_string($_POST['fchoice']);
                $schoice=$con->real_escape_string($_POST['schoice']);
                $tchoice=$con->real_escape_string($_POST['tchoice']);
                $lname = $con->real_escape_string($_POST['lname']);
                $fname = $con->real_escape_string($_POST['fname']);
                $mname = $con->real_escape_string($_POST['mname']);
                $email = $con->real_escape_string($_POST['email']);
                $contactno = $con->real_escape_string($_POST['contactno']);
                $sex = $con->real_escape_string($_POST['sex']);
                $dob = $con->real_escape_string($_POST['dob']);
                $pob = $con->real_escape_string($_POST['pob']);
                $civstat = $con->real_escape_string($_POST['stat']);
                $brgy = $con->real_escape_string($_POST['brgy']);
                $municip = $con->real_escape_string($_POST['municip']);
                $prov = $con->real_escape_string($_POST['prov']);
                $school=$con->real_escape_string($_POST['school']);
                $address=$con->real_escape_string($_POST['address']);
                $year=$con->real_escape_string($_POST['year']);
                $genave=$con->real_escape_string($_POST['genave']);
                $q1=$con->real_escape_string($_POST['q1']);
                $q1a=$con->real_escape_string($_POST['q1a']);
                $q2=$con->real_escape_string($_POST['q2']);
                $q2a=$con->real_escape_string($_POST['q2a']);

                $img3 = $_FILES['g_moral']['name'];
                $n_file3 = uniqid("GMORAL",true).'-'.$img3;
                $targetdir = "uploads/";
                $tar_file3 = str_replace(' ','_',$targetdir . $n_file3);
                move_uploaded_file($_FILES["g_moral"]["tmp_name"],$tar_file3);

                $insert = "UPDATE account_tab set sy='$sy',campus='$campus',tsite='$t_site',fchoice='$fchoice',schoice='$schoice',tchoice='$tchoice',lname='$lname',fname ='$fname',mname='$mname',email='$email',contact='$contact',sex='$sex',dob='$dob',pob='$pob',civstat='$civstat',brgy='$brgy',mun='$municip',prov='$prov',lschool=' $school',lsaddress='$address',lsy='$year',genave=' $genave',q1='$q1',q1a='$q1a',q2='$q2',q2a='$q2a',gMoral='$tar_file3' WHERE email='".$_SESSION['email']."'";
        
                $res = mysqli_query($con,$insert);
                $province = mysqli_query($con, "SELECT * FROM province_tab where provName='$prov'");
                if (mysqli_num_rows($province) == 0) {
                    mysqli_query($con,"INSERT INTO province_tab (provName) VALUES ('$prov')");
                }
                if($res){
                    
                       echo '<script> alert("You have successfully updated your data."); </script>';
                        echo '<script>location.href="stu-dashboard.php"</script>'; 
                }else{
                    echo '<script> alert("There is a problem while saving the data."); </script>';
                    echo "<script>location.href='stu-dashboard.php'</script>";
                }
            }
            if ($_FILES['id_pic']['name'] == '' || $_FILES['rep_card']['name'] == '' || $_FILES['g_moral']['name'] != '') {
                $sy=$con->real_escape_string($_POST['acadyear']);
                $campus=$con->real_escape_string($_POST['campus']);
                $t_site=$con->real_escape_string($_POST['t_site']);
                $fchoice=$con->real_escape_string($_POST['fchoice']);
                $schoice=$con->real_escape_string($_POST['schoice']);
                $tchoice=$con->real_escape_string($_POST['tchoice']);
                $lname = $con->real_escape_string($_POST['lname']);
                $fname = $con->real_escape_string($_POST['fname']);
                $mname = $con->real_escape_string($_POST['mname']);
                $email = $con->real_escape_string($_POST['email']);
                $contactno = $con->real_escape_string($_POST['contactno']);
                $sex = $con->real_escape_string($_POST['sex']);
                $dob = $con->real_escape_string($_POST['dob']);
                $pob = $con->real_escape_string($_POST['pob']);
                $civstat = $con->real_escape_string($_POST['stat']);
                $brgy = $con->real_escape_string($_POST['brgy']);
                $municip = $con->real_escape_string($_POST['municip']);
                $prov = $con->real_escape_string($_POST['prov']);
                $school=$con->real_escape_string($_POST['school']);
                $address=$con->real_escape_string($_POST['address']);
                $year=$con->real_escape_string($_POST['year']);
                $genave=$con->real_escape_string($_POST['genave']);
                $q1=$con->real_escape_string($_POST['q1']);
                $q1a=$con->real_escape_string($_POST['q1a']);
                $q2=$con->real_escape_string($_POST['q2']);
                $q2a=$con->real_escape_string($_POST['q2a']);


                $insert = "UPDATE account_tab set sy='$sy',campus='$campus',tsite='$t_site',fchoice='$fchoice',schoice='$schoice',tchoice='$tchoice',lname='$lname',fname ='$fname',mname='$mname',email='$email',contact='$contact',sex='$sex',dob='$dob',pob='$pob',civstat='$civstat',brgy='$brgy',mun='$municip',prov='$prov',lschool=' $school',lsaddress='$address',lsy='$year',genave=' $genave',q1='$q1',q1a='$q1a',q2='$q2',q2a='$q2a' WHERE email='".$_SESSION['email']."'";
        
                $res = mysqli_query($con,$insert);
                $province = mysqli_query($con, "SELECT * FROM province_tab where provName='$prov'");
                if (mysqli_num_rows($province) == 0) {
                    mysqli_query($con,"INSERT INTO province_tab (provName) VALUES ('$prov')");
                }
                if($res){
                    
                       echo '<script> alert("You have successfully updated your data."); </script>';
                        echo '<script>location.href="stu-dashboard.php"</script>'; 
                }else{
                    echo '<script> alert("There is a problem while saving the data."); </script>';
                    echo "<script>location.href='stu-dashboard.php'</script>";
                }
            }
        

    }else{
        echo '<script> alert("You cannot perform any alterations in your data. We are now processing it."); </script>';
        echo "<script>location.href='stu-dashboard.php'</script>";
    }
}
?>
</html>

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
          tags: true
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
        if (img1.value) {
            var img1_ext=img1.value.substring(img1.value.lastIndexOf('.')+1);
            var result1 = validExt.includes(img1_ext);

            if (result1 == true) {
                alert("Selected file is not an image.");
                return false;
            }else{
                if (parseFloat(img1.files[0].size/(1024*1024))>=5) {
                    alert("File size must be smaller than 5mb");
                    return false;
                }
            }
        }
        if (img2.value) {
            var img2_ext=img2.value.substring(img2.value.lastIndexOf('.')+1);
            var result2 = validExt.includes(img2_ext);

            if (result2==false) {
                alert("Selected file is not an image.");
                return false;
            }else{
                if (parseFloat(img2.files[0].size/(1024*1024))>=5) {
                    alert("File size must be smaller than 5mb");
                    return false;
                }
            }

        }
        if (img3.value) {
            var img3_ext=img3.value.substring(img3.value.lastIndexOf('.')+1);
            var result3 = validExt.includes(img3_ext);
            if (result3==false) {
                alert("Selected file is not an image.");
                return false;
            }else{
                if (parseFloat(img3.files[0].size/(1024*1024))>=5) {
                    alert("File size must be smaller than 5mb");
                    return false;
                }
            }
        }
    }
</script>