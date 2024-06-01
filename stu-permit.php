<?php
session_start();
if(isset($_SESSION['email'])){
    include 'connect.php'; 
    $query = "SELECT * from account_tab where stat1=1 AND email='".$_SESSION['email']."'";
    $query_run =mysqli_query($con,$query);
    /**/
    if(mysqli_num_rows($query_run) == true){

    $sql = "SELECT apprefno,fname, mname,lname, tsched,tsite,date_format(relresult, '%M %e, %Y') as relresult,sy from account_tab where email='".$_SESSION['email']."'";
    $sql_run =mysqli_query($con,$sql);

        $row=mysqli_fetch_assoc($sql_run);
        $apprefno = $row['apprefno'];
        $lname = $row['lname'];
        $fname = $row['fname'];
        $mname = $row['mname'];
        $t_sched = $row['tsched'];
        $tsite = $row['tsite'];
        $sy = $row['sy'];
        $relresult = $row['relresult'];


        $tsched = date_create($t_sched);
        $formatd = date_format($tsched, "F d, Y h:i a");
        $select = mysqli_query($con, "SELECT acad_year, sem FROM academic_year where code='".$sy."'");
        $rows=mysqli_fetch_assoc($select);
        $acadYear = $rows['acad_year'];
        $sem = $rows['sem'];

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
                <title>Permit Form</title>
            </head>
            <body>
                <div class= "container mt-3 mb-4">
                <div class="col-md-12 img-fluid">
                    <img src="img/HEADER.jpg" style="width:35%;">
                </div>
                    <h2 class="fw-bold text-center">UNIVERSITY ENTRANCE EXAMINATION PERMIT</h2>
                    <br>
                <form class="row g-3" action="stu-permit-download.php" method="GET">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                    <a href="stu-permit-download.php? id='.$apprefno.'" class="btn btn-warning btn-sm text-light"><i class="fa fa-download"></i> Download PDF</a>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group flex-nowrap col-md-12">
                        <span class="input-group-text fw-bold" id="appref">APP_REF NO.</span>
                        <input type="text" class="form-control" name="apprefno" value="'.$row['apprefno'].'" readonly required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Name of Examinee</label>
                        <input type="text" class="form-control" name="name" value="'.$lname.', '.$fname.' '.$mname.'" readonly required>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Date of Examination</label>
                        <input type="text" class="form-control" name="d_exam" aria-describedby="addon-wrapping" value="AY '.$acadYear.' '.$sem.' '.$formatd.'" readonly required>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="" class="form-label">Testing Center</label>
                        <input type="text" class="form-control" name="room" aria-describedby="addon-wrapping" value="'.$row['tsite'].'" readonly required>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Date of Release of Examination Result</label>
                        <input type="text" class="form-control" name="dresult" aria-describedby="addon-wrapping" value="'.$row['relresult'].'" readonly required>
                    </div>
                </form>
                </div>
        ';}else{
        echo '<script> alert("Your exam permit is not yet available. We will notify you if we are done processing it."); </script>';
        echo '<script>location.href="stu-dashboard.php"</script>';
    }
}
    ?>
                    
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>