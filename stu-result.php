<?php
session_start();
include 'connect.php';
 
if(isset($_SESSION['email'])){
    $sql = "SELECT stat from result_tab where email='".$_SESSION['email']."'";
    $sql_run =mysqli_query($con,$sql);

    if(mysqli_num_rows($sql_run) == 1){

    $query = "SELECT account_tab.apprefno,CONCAT (account_tab.fname, ' ', account_tab.mname, ' ', account_tab.lname) AS name, account_tab.email, account_tab.contact, account_tab.tsite, account_tab.sy, account_tab.tsched, result_tab.vcscore, result_tab.vrscore, result_tab.frscore, result_tab.qrscore from account_tab INNER JOIN result_tab ON account_tab.apprefno = result_tab.stuID where account_tab.email='".$_SESSION['email']."'";
    $query_run =mysqli_query($con,$query);

        $row=mysqli_fetch_assoc($query_run);
        $apprefno = $row['apprefno'];
        $name = $row['name'];
        $email = $row['email'];
        $contact = $row['contact'];
        $tsched = $row['tsched'];
        $tsite = $row['tsite'];
        $sy = $row['sy'];

    $t_sched = date_create($tsched);
    $formatd = date_format($t_sched, "F d, Y h:i a");
    $select = mysqli_query($con, "SELECT acad_year, sem FROM academic_year where code='".$sy."'");
    $rows=mysqli_fetch_assoc($select);
    $acadYear = $rows['acad_year'];
    $sem = $rows['sem'];

    $raw = $row['vcscore'] + $row['vrscore'] + $row['frscore'] + $row['qrscore'];

    if ($raw <= 37) {
        $rdes = "Below Average";
    }elseif($raw <= 58){
            $rdes = "Average";
    }elseif ($raw <= 72) {
            $rdes = "Above Average";
    }else{
            $rdes = "Invalid";
    }

    echo '
        <div class= "container mt-3 mb-4">
            <div class="col-12 img-fluid">
                <img src="img/HEADER.jpg" style="width:35%;">
            </div>
            <h2 class="fw-bold text-center fs-3">UNIVERSITY ENTRANCE EXAMINATION RESULT</h2>
                <form class="row g-3" action="stu-result-download.php" method="GET">
                    <div class="col-md-10"></div>
                    <div class="col-md-2 mb-3">
                        <a href="stu-result-download.php? id='.$apprefno.'" class="btn btn-warning btn-sm text-light"><i class="fa fa-download"></i> Download PDF</a>
                    </div>
                    <div class="col-md-6">
                        <label for="name" class="form-label">LEGAL NAME OF APPLICANT:</label>
                        <input type="text" class="form-control" name="name" aria-describedby="addon-wrapping" value="'.$name.'" readonly required>
                    </div>
                    <div class="col-md-6">
                        <label for="tpn" class="form-label">TPN</label>
                        <input type="text" class="form-control" name="tpn" value="'.$apprefno.'" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="tdate" class="form-label">TESTING DATE</label>
                        <input type="text" class="form-control" name="d_exam" aria-describedby="addon-wrapping" value="AY '.$acadYear.' '.$sem.' '.$formatd.'" readonly required>
                    </div>
                    <div class="col-md-6">
                        <label for="tsite" class="form-label">TESTING SITE</label>
                        <input type="text" class="form-control" name="tsite" value="'.$tsite.'" readonly>
                    </div>
                    <br>
                    <hr>
                    <h3>OTIS-LENNON SCHOOL ABILITY TEST (OLSAT, Seventh Edition) RESULTS</h3>
                    <div class="col-md-6">
                        <label for="rawscr" class="form-label fw-bold">Raw Score:</label>
                        <input type="text" class="form-control" name="total" value="'.$raw.'" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="decsrp" class="form-label fw-bold">Description:</label>
                        <input type="text" class="form-control" name="descrp" value="'.$rdes.'" readonly>
                    </div>
                    <br>
                </form>
        </div>
    ';}
    else{
        echo '<script> alert("Your exam result is not yet available. We will notify you if we are done processing it."); </script>';
        echo '<script>location.href="stu-dashboard.php"</script>';
        //mysqli_error($con);
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" href="img/essu-logo.png">
    <link rel="shortcut icon" href="img/essu-logo.png">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <title>Exam Result</title>
</head>
<body>
    

    
</body>
</html>