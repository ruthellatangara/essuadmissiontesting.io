<?php
session_start();
include 'connect.php';

error_reporting (E_ALL ^ E_NOTICE); 

if (isset($_SESSION['email'])) {
    $apprefno=$_GET['scoreid'];
$sql="SELECT sy,lname,fname,mname,email,contact, DATE_FORMAT(FROM_DAYS(DATEDIFF(now(),dob)),'%Y')+0 as age,sex,apprefno,tsched,tsite,lschool,campus,fchoice,schoice,tchoice,scaledscr,sai,perrank,stanine,vcscore,vrscore,frscore,qrscore from student_archive where apprefno='$apprefno'";
$result=mysqli_query($con,$sql);
if($result==FALSE)
{
    die(mysqli_error($con));
}
        $row=mysqli_fetch_assoc($result);
            $sy=$row['sy'];
            $lname=$row['lname'];
            $fname=$row['fname'];
            $mname=$row['mname'];
            $email=$row['email'];
            $contact=$row['contact'];
            $age=$row['age'];
            $sex=$row['sex'];
            $apprefno=$row['apprefno'];
            $tsched=$row['tsched'];
            $tsite=$row['tsite'];
            $lschool=$row['lschool'];
            $campus=$row['campus'];
            $fchoice=$row['fchoice'];
            $schoice=$row['schoice'];
            $tchoice=$row['tchoice'];
            $scaledscore=$row['scaledscr'];
            $sai=$row['sai'];
            $perrank=$row['perrank'];
            $stanine=$row['stanine'];
            $vcscore=$row['vcscore'];
            $vrscore=$row['vrscore'];
            $frscore=$row['frscore'];
            $qrscore=$row['qrscore'];

    $fetch = mysqli_query($con, "SELECT sched, code FROM tsched_tab where sched='".$tsched."'");
    $t_sched = date_create($tsched);
    $formatd = date_format($t_sched, "F d, Y h:i a");
    $frow=mysqli_fetch_assoc($fetch);
    $code = $frow['code'];

    $select = mysqli_query($con, "SELECT acad_year, sem FROM academic_year where code='".$code."'");
    $rows=mysqli_fetch_assoc($select);
    $acadYear = $rows['acad_year'];
    $sem = $rows['sem'];


    $vscore=$vcscore + $vrscore;
    $nvscore=$frscore + $qrscore;
    $tscore = $vscore + $nvscore;

    if ($tscore <= 37) {
    $tdes = "Below Average";
    }elseif($tscore <= 58){
        $tdes = "Average";
    }elseif ($tscore <= 72) {
        $tdes = "Above Average";
    }else{
        $tdes = "Invalid";
    }

    if ($vcscore <= 5) {
    $vcdes = "Below Average";
    }elseif($vcscore <= 10){
        $vcdes = "Average";
    }elseif ($vcscore <= 12) {
        $vcdes = "Above Average";
    }else{
        $vcdes = "Invalid";
    }

    if ($vrscore <= 11) {
    $vrdes = "Below Average";
    }elseif($vrscore <= 18){
        $vrdes = "Average";
    }elseif ($vrscore <= 24) {
        $vrdes = "Above Average";
    }else{
        $vrdes = "Invalid";
    }

    if ($vscore <= 17) {
    $des = "Below Average";
    }elseif($vscore <= 28){
        $des = "Average";
    }elseif ($vscore <= 36) {
        $des = "Above Average";
    }else{
        $des = "Invalid";
    }

    if ($frscore <= 8) {
    $frdes = "Below Average";
    }elseif($frscore <= 14){
        $frdes = "Average";
    }elseif ($frscore <= 18) {
        $frdes = "Above Average";
    }else{
        $frdes = "Invalid";
    }

    if ($qrscore <= 9) {
    $qrdes = "Below Average";
    }elseif($qrscore <= 16){
        $qrdes = "Average";
    }elseif ($qrscore <= 18) {
        $qrdes = "Above Average";
    }else{
        $qrdes = "Invalid";
    }

    if ($nvscore <= 18) {
    $nvdes = "Below Average";
    }elseif($nvscore <= 30){
        $nvdes = "Average";
    }elseif ($nvscore <= 36) {
        $nvdes = "Above Average";
    }else{
        $nvdes = "Invalid";
    }

echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="apple-touch-icon" href="img/essu-logo.png">
    <link rel="shortcut icon" href="img/essu-logo.png">
    <title>Result</title>
</head>
<body>
    <div class="container mt-3 mb-4">
        <form class="row g-3" action="adm-score-form.php" method="POST">
        <div class="col-12 img-fluid">
            <img src="img/HEADER.jpg" style="width:35%;">
        </div>
        <h1 class="fw-bold text-center">COLLEGE PLACEMENT TEST</h1>
        <h2 class="text-center">UNIVERSITY CENTER FOR COUNSELING & PSYCHOLOGICAL DEVELOPMENT</h2>

            <div class="col-md-6">
                <label for="schoolyear" class="form-label">Academic Year</label>
                <input type="text" class="form-control" name="schoolyear" value="'.$acadYear.'" readonly>
            </div>
            <div class="col-6">
                <label for="tdate" class="form-label">TESTING DATE</label>
                <input type="text" class="form-control" name="tdate" value="AY '.$acadYear.' '.$sem.' '.$formatd.'" readonly>
            </div>

            <div class="col-md-12 mt-4">
                <label class="fw-bold">LEGAL NAME OF APPLICANT:</label>
            </div>
            <div class="col-md-4">
                <label for="lname" class="form-label">LAST NAME</label>
                <input type="text" class="form-control" name="lname" value="'.$lname.'" readonly>
            </div>
            <div class="col-md-4">
                <label for="fname" class="form-label">FIRST NAME</label>
                <input type="text" class="form-control" name="fname" value="'.$fname.'" readonly>
            </div>
            <div class="col-md-4">
                <label for="mi" class="form-label">MIDDLE NAME</label>
                <input type="text" class="form-control" name="mname" value="'.$mname.'" readonly>
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">EMAIL ADDRESS</label>
                <input type="text" class="form-control" name="email" value="'.$email.'" readonly>
            </div>
            <div class="col-md-4">
                <label for="contact" class="form-label">CONTACT</label>
                <input type="text" class="form-control" name="contact" value="'.$contact.'" readonly>
            </div>
            <div class="col-md-1">
                <label for="age" class="form-label">AGE</label>
                <input type="text" class="form-control" name="age" value="'.$age.'" readonly>
            </div>
            <div class="col-md-3">
                <label for="sex" class="form-label">SEX</label>
                <input type="text" class="form-control" name="sex" value="'.$sex.'" readonly>
            </div>
            <div class="col-4">
                <label for="tpn" class="form-label">TPN</label>
                <input type="text" class="form-control" name="tpn" value="'.$apprefno.'" readonly required>
            </div>
            
            <div class="col-4">
                <label for="tsite" class="form-label">TESTING SITE</label>
                <input type="text" class="form-control" name="tsite" value="'.$tsite.'" readonly>
            </div>
            <div class="col-md-4">
                <label for="campus" class="form-label">CAMPUS</label>
                <input type="text" class="form-control" name="campus" value="'.$lschool.'" readonly>
            </div>
            <div class="col-md-6 mt-4">
                <label class="fw-bold">CHOICE OF CAMPUS & DEGREE</label>
            </div>
            
            <div class="col-md-6 mt-4">
                <label class="fw-bold">INTENDED DEGREE PROGRAM TO ENROLL</label>
            </div>
            <div class="col-6">
                <label for="cfchoice" class="form-label">First Choice</label>
                <input type="text" class="form-control" name="ccampus" value="'.$campus.'" readonly>
            </div>
            <div class="row mb-3 mt-5 col-6">
                <div class="input-group flex-nowrap col-md-6">
                <span class="input-group-text fw-bold" id="dfchoice">First Choice</span>
                <input type="text" class="form-control" name="dfchoice" value="'.$fchoice.'" readonly>
                </div>
            </div>
            <div class="col-6">
            </div>
            <div class="row mb-3 col-6">
                <div class="input-group flex-nowrap col-md-6">
                <span class="input-group-text fw-bold" id="dschoice">Second Choice</span>
                <input type="text" class="form-control" name="dschoice" value="'.$schoice.'" readonly>
                </div>
            </div>
            <div class="col-6">
            </div>
            <div class="row col-6">
                <div class="input-group flex-nowrap col-md-6">
                <span class="input-group-text fw-bold" id="dtchoice">Third Choice</span>
                <input type="text" class="form-control" name="dtchoice" value="'.$tchoice.'" readonly>
                </div>
            </div>
            <div class="col-12">
                <h4 class="fw-bold">OTIS-LENNON SCHOOL OF ABILITY TEST (OLSAT, Seventh Edition) RESULTS</h4>
            </div>
            <!--thead-->
            <div class="col-5">
                <table class="table">
                    <thead>
                        <h6 class="fw-bold text-center bg-gray">SCHOOL ABILITY (Performance by Age)</h6>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="col">Raw Score (Total)</th>
                            <th scope="col"><input type="text" class="form-control" name="total" id="total" value="'.$tscore.'" readonly></th>
                        </tr>
                        <tr>
                            <th scope="col">Scaled Score</th>
                            <td scope="col"><input type="text" class="form-control" name="scaledscore" value="'.$scaledscore.'" readonly></td>
                        </tr>
                        <tr>
                            <th scope="col">SAI</th>
                            <td scope="col"><input type="text" class="form-control" name="sai" value="'.$sai.'" readonly></td>
                        </tr>
                        <tr>
                            <th scope="col">Percentile Rank</th>
                            <td scope="col"><input type="text" class="form-control" name="perrank" value="'.$perrank.'" readonly></td>
                        </tr>
                        <tr>
                            <th scope="col">Stanine</th>
                            <td scope="col"><input type="text" class="form-control" name="stanine" value="'.$stanine.'" readonly></td>
                        </tr>
                        <tr>
                            <th scope="col">Desciption</th>
                            <td><input type="text" name="descrp" class="form-control" id="descrp" value="'.$tdes.'" readonly readonly></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-7">
                <table class="table">
                    <thead class="table-secondary">
                        <h6 class="fw-bold text-center">CLUSTER ANALYSIS</h6>
                        <tr class="text-center">
                            <th>COMPONENTS</th>
                            <th>RAW SCORE</th>
                            <th>DESCRIPTION</th>
                        </tr>
                    </thead>
                    <hr>
                    <tbody class="text-center">
                        <tr>
                            <td class="fw-bold">Verbal</td>
                            <td><input type="text" class="form-control" name="vrawscr" id="vrawscr" value="'.$vscore.'" readonly></td>
                            <td><input type="text" class="form-control" name="vdescrp" id="vdescrp" value="'.$des.'" readonly></td>
                        </tr>
                        <tr>
                            <td>Verbal Comprehension</td>
                            <td><input type="text" class="form-control" name="vcrawscr" id="vcrawscr" value="'.$vcscore.'" readonly></td>
                            <td><input type="text" class="form-control" name="vcdescrp" id="vcdescrp" value="'.$vcdes.'" readonly></td>
                        </tr>
                        <tr>
                            <td>Verbal Reasoning</td>
                            <td><input type="text" class="form-control" name="vrrawscr" id="vrrawscr" value="'.$vrscore.'" readonly></td>
                            <td><input type="text" class="form-control" name="vrdescrp" id="vrdescrp" value="'.$vrdes.'" readonly></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Non Verbal</td>
                            <td><input type="text" class="form-control" name="nvrawscr" id="nvrawscr" value="'.$nvscore.'" readonly></td>
                             <td><input type="text" class="form-control" name="nvdescrp" id="nvdescrp" value="'.$nvdes.'" readonly></td>
                        </tr>
                        <tr>
                            <td>Figurative Reasoning</td>
                            <td><input type="text" class="form-control" name="frrawscr" id="frrawscr" value="'.$frscore.'" readonly></td>
                            <td><input type="text" class="form-control" name="frdescrp" id="frdescrp" value="'.$frdes.'" readonly></td>
                        </tr>
                        <tr>
                            <td>Quantitative Reasoning</td>
                            <td><input type="text" class="form-control" name="qrrawscr" id="qrrawscr" value="'.$qrscore.'" readonly></td>
                            <td><input type="text" class="form-control" name="qrdescrp" id="qrdescrp" value="'.$qrdes.'" readonly></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-10">

            </div>
            <div class="col-1 mb-3">
                
            </div>
            <div class="col-1">
                <a href="adm-archi-result.php? ay='.$sy.'" class="btn btn-primary btn-sm text-light"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </form>
    </div>';
}
?>
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>