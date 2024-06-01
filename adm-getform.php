<?php
session_start();
include 'connect.php';
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" href="img/essu-logo.png">
    <link rel="shortcut icon" href="img/essu-logo.png">
    <title>Admission Form</title>
</head>
<body>
    <?php
    if (isset($_SESSION['email'])) {
        $apprefno=$_GET['id'];
    $sql="Select * from account_tab where apprefno='$apprefno'";
    $result=mysqli_query($con,$sql);
    if($result==FALSE)
    {
        die(mysqli_error($con));
    }
    $row=mysqli_fetch_assoc($result);
            $apprefno = $row['apprefno'];
            $t_site = $row['tsite'];
            $schoolyear = $row['sy'];
            $campus = $row['campus'];
            $fchoice = $row['fchoice'];
            $schoice = $row['schoice'];
            $tchoice = $row['tchoice'];
            $lname = $row['lname'];
            $fname = $row['fname'];
            $mname = $row['mname'];
            $emailadd = $row['email'];
            $contactno = $row['contact'];
            $dob = $row['dob'];
            $pob = $row['pob'];
            $sex = $row['sex'];
            $status = $row['civstat'];
            $brgy = $row['brgy'];
            $municip = $row['mun'];
            $prov = $row['prov'];
            $school = $row['lschool'];
            $address = $row['lsaddress'];
            $year = $row['lsy'];
            $genave = $row['genave'];
            $q1=$row['q1'];
            $q1a=$row['q1a'];
            $q2=$row['q2'];
            $q2a=$row['q2a'];

    $select = mysqli_query($con, "SELECT acad_year, sem FROM academic_year where code='".$schoolyear."'");
    $rows=mysqli_fetch_assoc($select);
    $acadYear = $rows['acad_year'];
    $sem = $rows['sem'];
        echo '
        <div class="container mt-3 mb-4">
        <div class="col-12 img-fluid">
            <img src="img/HEADER.jpg" style="width: 35%">
        </div>
        <h2 class="fw-bold text-center">UNIVERSITY ADMISSION APPLICATION FORM</h2>
        <br>

        <form class="row g-3" action="file-upload.php" method="post" enctype="multipart/form-data">
            <div class="col-md-6">
                <label for="appref" class="form-label">Application Reference No. </label>
                <input type="text" class="form-control" id="appref" name="appref" value="'.$apprefno.'" readonly>
            </div>
            <div class="col-md-6">
                <label for="appref" class="form-label">Testing Center</label>
                <input type="text" class="form-control" id="appref" name="appref" value="'.$t_site.'" readonly>
            </div>
            <div class="col-md-6">
                <label for="schoolyear" class="form-label">School Year</label>
                <input type="text" class="form-control" id="schoolyear" name="schoolyear" value="AY '.$acadYear.' '.$sem.'" readonly>
            </div>
            <div class="col-md-6">
                <label for="campus" class="form-label">Campus</label>
                <input type="text" class="form-control" id="campus" name="campus" value="'.$campus.'" readonly>
            </div>
            <div class="fw-bolder">Degree/Program Choices:</div>
            <div class="col-md-4">
                <label for="fchoice" class="form-label">First Choice</label>
                <input type="text" class="form-control" id="fchoice" name="fchoice" value="'.$fchoice.'" readonly>
            </div>
            <div class="col-md-4">
                <label for="schoice" class="form-label">Second Choice</label>
                <input type="text" class="form-control" id="schoice" name="schoice" value="'.$schoice.'" readonly>
            </div>
            <div class="col-md-4">
            <label for="tchoice" class="form-label">Third Choice</label>
            <input type="text" class="form-control" id="tchoice" name="tchoice" value="'.$tchoice.'" readonly>
            </div>
            <div class="fw-bolder">Applicants Name</div>
            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" id="lname" name="lname" value="'.$lname.'" readonly>
                <label for="lname">Last Name</label>
            </div>
            <div class="col-md-4 form-floating">
            <input type="text" class="form-control" id="fname" name="fname" value="'.$fname.'" readonly>
                <label for="fname">First Name</label>
            </div>
            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" id="mname" name="mname" value="'.$mname.'" readonly>
                <label for="mname">Middle Name</label>
            </div>
            <div class="col-md-8">
                <label for="emailadd" class="form-label">Email Address</label>
                <input type="text" class="form-control" id="emailadd" name="emailadd" value="'.$emailadd.'" readonly>
            </div>
            <div class="col-md-4">
                <label for="contactno" class="form-label">Contact Number</label>
                <input type="text" class="form-control" id="contactno" name="contactno" value="'.$contactno.'" readonly>
            </div>
            <div class="col-md-3">
            <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" name="dob" value="'.$dob.'" readonly>
            </div>
            <div class="col-md-4">
                <label for="pob" class="form-label">Place of Birth</label>
                <input type="text" class="form-control" id="pob" name="pob" value="'.$pob.'" readonly>
            </div>
            <div class="col-md-2">
                <label for="sex" class="form-label">Sex</label>
                <input type="text" class="form-control" id="sex" name="sex" value="'.$sex.'" readonly>
            </div>
            <div class="col-md-3">
            <label for="status" class="form-label">Civil Status</label>
            <input type="text" class="form-control" id="status" name="status" value="'.$status.'" readonly>
            </div>
            <div class="fw-bolder">Permanent Address</div>
            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" id="brgy" name="brgy" value="'.$brgy.'" readonly>
                <label for="brgy">Barangay</label>
            </div>
            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" id="municip" name="municip" value="'.$municip.'" readonly>
                <label for="municip">Municipality</label>
            </div>
            <div class="col-md-4 form-floating">
            <input type="text" class="form-control" id="prov" name="prov" value="'.$prov.'" readonly>
                <label for="prov">Province</label>
            </div>
            <div class="fw-bolder">Last School Attended</div>
            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" id="school" name="school" value="'.$school.'" readonly>
                <label for="school">Name of School</label>
            </div>
            <div class="col-md-4 form-floating">
            <input type="text" class="form-control" id="address" name="address" value="'.$address.'" readonly>
                <label for="address">Address</label>
            </div>
            <div class="col-md-2 form-floating">
            <input type="text" class="form-control" id="year" name="year" value="'.$year.'" readonly>
                <label for="year">Year</label>
            </div>
            <div class="col-md-2 form-floating">
            <input type="text" class="form-control" id="genave" name="genave" value="'.$genave.'" readonly>
                <label for="genave">General Average</label>
            </div>

            <h3 class="fw-bolder">DECLARATION</h3>
            <div class="col-12">
            <label for="q1" class="form-label">1. Do you have a physical condition which may affect your performance in college?</label>
            <input type="text" class="form-control" id="q1" name="q1" value="'.$q1,'. ', $q1a.'" readonly>
            </div>

            <div class="col-12 ">
            <label for="q2" class="form-label">2. Have you been subjected to any disciplinary action?</label>
            <input type="text" class="form-control" id="q2" name="q2" value="'.$q2,'. ', $q2a.'" readonly>
            </div>

            
            
            
            <p style="font-style: italic; text-align: center;">The information on this form will be used in 
                accordance with the University policy on personal data.</p>
                <div class="form-check">
                    <label for="" class="form-check-label">I agree that the information above is true, complete, and correct. I understand that falsificaction
                        or withholding of information on this form will nullify and/or subject me to dismissal from the University.
                    </label>
                </div>

            <div class="col-md-1">
                <a href="adm-all-app.php" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
            <div class="col-md-3">
            <a href="adm-file-uploads.php? id='.$apprefno.'" class=" btn btn-primary btn-sm"><i class="fa fa-folder-open-o"></i> See required files uploaded</a>
            </div>
        </form>
    </div>
        ';
    }
    ?>
</body>
</html>