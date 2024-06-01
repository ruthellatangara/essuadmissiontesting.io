<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'mail/PHPMailer.php';
require 'mail/SMTP.php';
require 'mail/Exception.php';

session_start();
include 'connect.php';

error_reporting (E_ALL ^ E_NOTICE); 

if (isset($_SESSION['email'])) {
    $date2=date('Y', strtotime('+1 Years'));
    for ($i=date('Y'); $i<$date2+0; $i++){
            //echo ''.$i.'-'.($i+1).'';
    }

    $apprefno=$_GET['scoreid'];
    $sql="SELECT sex,lname,fname,mname,email,contact,DATE_FORMAT(FROM_DAYS(DATEDIFF(now(),dob)),'%Y')+0 as age,lschool,campus,sy,fchoice,schoice,tchoice,apprefno, tsched, tsite  
    FROM account_tab where apprefno='$apprefno'";
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($result);
        $apprefno = $row['apprefno'];
        $sex = $row['sex'];
        $laname = $row['lname'];
        $finame = $row['fname'];
        $miname = $row['mname'];
        $emailadd = $row['email'];
        $contactno = $row['contact'];
        $age = $row['age'];
        $lschool = $row['lschool'];
        $campus = $row['campus'];
        $fchoice = $row['fchoice'];
        $schoice = $row['schoice'];
        $tchoice = $row['tchoice'];
        $t_sched = $row['tsched'];
        $test_site = $row['tsite'];
        $sy = $row['sy'];

        /*$fetch = mysqli_query($con, "SELECT acadYear, sem FROM tsched_tab where sched='".$t_sched."'");
        $tsched = date_create($t_sched);
        $formatd = date_format($tsched, "F d, Y h:i a");
        $frow=mysqli_fetch_assoc($fetch);
        $acadYear = $frow['acadYear'];
        $sem = $frow['sem'];*/

        $fetch = mysqli_query($con, "SELECT sched, code FROM tsched_tab where sched='".$t_sched."'");
        $tsched = date_create($t_sched);
        $formatd = date_format($tsched, "F d, Y h:i a");
        $frow=mysqli_fetch_assoc($fetch);
        $code = $frow['code'];

        $select = mysqli_query($con, "SELECT acad_year, sem FROM academic_year where code='".$code."'");
        $rows=mysqli_fetch_assoc($select);
        $acadYear = $rows['acad_year'];
        $sem = $rows['sem'];

        echo'
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
        <div class="container mt-3 mb-4">
        <form class="row g-3 needs-validation" name="forms" id="forms" action="adm-score-form.php" method="POST" onsubmit="return validate()" novalidate>
        <div class="col-12">
            <h4 class="fw-bold">OTIS-LENNON SCHOOL OF ABILITY TEST (OLSAT, Seventh Edition) RESULTS</h4>
        </div>

            <div class="col-md-4 form-floating">
                ';
    }
    ?>
    <?php
    if (isset($_SESSION['email'])) {
        $date2=date('Y', strtotime('+1 Years'));
                for ($i=date('Y'); $i<$date2+0; $i++){
                    echo '<input type="text" class="form-control" name="sy" value="'.$i.'-'.($i+1).'" readonly>
                    ';
                }
    }
    ?>
    <?php
    if (isset($_SESSION['email'])) {
        echo '
        <label for="schoolyear" class="form-label">Academic Year</label>
        </div>
            <div class="col-md-3 form-floating">
                <input type="text" class="form-control" name="tpn" value="'.$apprefno.'" readonly required>
                <label for="tpn" class="form-label">TPN</label>
            </div>
            <div class="col-md-5 form-floating">
                <input type="text" class="form-control" name="tdate" value="AY '.$acadYear.' '.$sem.' '.$formatd.'" readonly>
                <label for="tdate" class="form-label">TESTING DATE</label>
            </div>

            <div class="col-md-12">
                <label class="fw-bold">LEGAL NAME OF APPLICANT:</label>
            </div>
            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" name="lname" value="'.$laname.'" readonly>
                <label for="lname" class="form-label">LAST NAME</label>
            </div>
            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" name="fname" value="'.$finame.'" readonly>
                <label for="fname" class="form-label">FIRST NAME</label>
            </div>
            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" name="mname" value="'.$miname.'" readonly>
                <label for="mi" class="form-label">MIDDLE NAME</label>
            </div>
            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" name="email" value="'.$emailadd.'" readonly>
                <label for="email" class="form-label">EMAIL ADDRESS</label>
            </div>
            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" name="contact" value="'.$contactno.'" readonly>
                <label for="contact" class="form-label">CONTACT</label>
            </div>
            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" name="tsite" value="'.$test_site.'" readonly>
                <label for="tsite" class="form-label">TESTING SITE</label>
            </div>
            

            

            <!--thead-->
            <div class="col-md-5">
                <table class="table">
                    <thead>
                        <h6 class="fw-bold text-center bg-gray">SCHOOL ABILITY (Performance by Age)</h6></thead>
                    <tbody>
                        <tr>
                            <td scope="col">Scaled Score</td>
                            <td scope="col"><input type="number" name="scaledscore" autocomplete="off" min="0" required></td>
                        </tr>
                        <tr>
                            <td scope="col">SAI</td>
                            <td scope="col"><input type="number" name="sai" autocomplete="off" min="0" required></td>
                        </tr>
                        <tr>
                            <td scope="col">Percentile Rank</td>
                            <td scope="col"><input type="text" name="perrank" autocomplete="off" required></td>
                        </tr>
                        <tr>
                            <td scope="col">Stanine</td>
                            <td scope="col"><input type="number" name="stanine" autocomplete="off" min="0" required></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-7">
                <table class="table">
                    <thead class="table-secondary">
                        <tr class="text-center"><h6 class="fw-bold text-center">CLUSTER ANALYSIS</h6></tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <td>Verbal Comprehension</td>
                            <td>
                                <input type="number" name="vcrawscr" id="vcrawscr" autocomplete="off" min="0" max="12" required>
                                <div class="invalid-feedback">
                                    Please enter a valid input in this field.
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td>Verbal Reasoning</td>
                            <td>
                                <input type="number" name="vrrawscr" id="vrrawscr" autocomplete="off" min="0" max="24" required>
                                <div class="invalid-feedback">
                                    Please enter a valid input in this field.
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Figurative Reasoning</td>
                            <td>
                                <input type="number" name="frrawscr" id="frrawscr" autocomplete="off" min="0" max="18" required>
                                <div class="invalid-feedback">
                                    Please enter a valid input in this field.
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Quantitative Reasoning</td>
                            <td>
                                <input type="number" name="qrrawscr" id="qrrawscr" autocomplete="off" min="0" max="18" required>
                                <div class="invalid-feedback">
                                    Please enter a valid input in this field.
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-10">

            </div>
            <div class="col-1 mb-3">
                <a href="adm-result.php" class="btn btn-primary btn-sm text-light"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
            <div class="col-1">
                <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
        ';
}
if(isset($_POST['submit'])){

        $lname=$con->real_escape_string($_POST['lname']);
        $fname=$con->real_escape_string($_POST['fname']);
        $mname=$con->real_escape_string($_POST['mname']);
        $email=$con->real_escape_string($_POST['email']);
        $tpn=$con->real_escape_string($_POST['tpn']);
        $tsite=$con->real_escape_string($_POST['tsite']);
        $vcscore=$con->real_escape_string($_POST['vcrawscr']);
        $vrscore=$con->real_escape_string($_POST['vrrawscr']);
        $frscore=$con->real_escape_string($_POST['frrawscr']);
        $qrscore=$con->real_escape_string($_POST['qrrawscr']);
        $scaledscore=$con->real_escape_string($_POST['scaledscore']);
        $sai=$con->real_escape_string($_POST['sai']);
        $perrank=$con->real_escape_string($_POST['perrank']);
        $stanine=$con->real_escape_string($_POST['stanine']);

        $vscore=$vcscore + $vrscore;
        $nvscore=$frscore + $qrscore;
        $tscore = $vscore + $nvscore;

         $query = "SELECT apprefno,CONCAT (fname, ' ', mname, ' ', lname) AS name,email,contact,tsite,sy,tsched from account_tab WHERE apprefno='".$_POST['tpn']."'";
        $result = mysqli_query($con,$query);
        $row=mysqli_fetch_assoc($result);
        $apprefno = $row['apprefno'];
        $name = $row['name'];
        $tsite = $row['tsite'];
        $t_sched = $row['tsched'];
        $sy = $row['sy'];

        $tsched = date_create($t_sched);
        $formatd = date_format($tsched, "F d, Y h:i a");
        $select = mysqli_query($con, "SELECT acad_year, sem FROM academic_year where code='".$sy."'");
        $rows=mysqli_fetch_assoc($select);
        $acadYear = $rows['acad_year'];
        $sem = $rows['sem'];

        $insert = mysqli_query($con,"INSERT into `result_tab`(stuID,email,vcscore,vrscore,frscore,qrscore,scaledscore,sai,perrank,stanine,stat,resYear) values('$tpn','$email','$scaledscore','$sai','$perrank','$stanine','$vcscore','$vrscore','$frscore','$qrscore',1,YEAR(NOW()))");
        $update = mysqli_query($con,"UPDATE account_tab set stat2=0 WHERE apprefno='".$_POST['tpn']."'");


        require_once('TCPDF-main/config/tcpdf_config.php');
        require_once('TCPDF-main/tcpdf.php');
        if ($tscore <= 37) {
        $tdes = "Below Average";
        }elseif($tscore <= 58){
            $tdes = "Average";
        }elseif ($tscore <= 72) {
            $tdes = "Above Average";
        }else{
            $tdes = "Invalid";
        }

        class PDF extends TCPDF{
            public function Header(){
            $imageFile = K_PATH_IMAGES.'HEADER.jpg';
            $this->Image($imageFile, 10, 5, 80, '', 'JPG', '', 'T', false, 300, '', false, false,
            0, false, false, false);
            $this->Ln(5);
            }
        }

        // create new PDF document
        $pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

        // set document information
        $pdf->setCreator(PDF_CREATOR);
        $pdf->setAuthor('Admission Services Office');
        $pdf->setTitle('University Admission and Application Form');
        $pdf->setSubject('');
        $pdf->setKeywords('');

        // set default header data
        $pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 014', PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->setHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->setFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // IMPORTANT: disable font subsetting to allow users editing the document
        $pdf->setFontSubsetting(false);

        // set font
        $pdf->SetFont('helvetica', '', 10, '', false);

        // add a page
        $pdf->AddPage();

        $pdf->Ln(5);
        $pdf->SetFont('helvetica','B',12);
        $pdf->Cell(189,3,'UNIVERSITY EXAMINATION RESULT',0,1,'C');
        $pdf->Ln(6);
        $pdf->SetFont('helvetica','B',9);
        $pdf->Cell(18,3,'TPN: NO.',0,0,'L');
        $pdf->Cell(40,3,''.$tpn,0,0,'L');
        $pdf->Cell(48,3,'LEGAL NAME OF APPLICANT: ',0,0,'L');
        $pdf->Cell(50,3,''.$fname.' '.$mname.' '.$lname,0,1,'L');
        $pdf->SetFont('helvetica','',9);
        $pdf->Cell(30,3,'Testing Schedule:',0,0,'L');
        $pdf->Cell(25,4,'AY '.$acadYear.' '.$sem.' '.$formatd,0,1,'L');
        $pdf->Cell(25,3,'Testing Site:',0,0,'L');
        $pdf->Cell(40,3,''.$tsite,0,1,'L');
        $pdf->Ln(4);

        $pdf->SetFont('helvetica','B    ',9);
        $pdf->Cell(50,5,'OTIS-LENNON SCHOOL ABILITY TEST (OLSAT, Seventh Edition) RESULTS',0,1,'L');
        $pdf->Ln(1);
        $pdf->Cell(20,5,'Raw Score: ',0,0,'L');
        $pdf->Cell(20,5,''.$tscore,0,0,'L');
        $pdf->Cell(20,5,'Description: ',0,0,'L');
        $pdf->Cell(20,5,''.$tdes,0,1,'L');
        $pdf->Ln(3);

        $pdfFile = $pdf->Output('essu-entrance-result.pdf','S');

        $query = "SELECT apprefno,CONCAT (fname, ' ', mname, ' ', lname) AS name,email,contact,tsite,sy,tsched from account_tab WHERE apprefno='".$_POST['tpn']."'";
        $result = mysqli_query($con,$query);
        $row=mysqli_fetch_assoc($result);
        $apprefno = $row['apprefno'];
        $name = $row['name'];
        $tsite = $row['tsite'];
        $t_sched = $row['tsched'];
        $sy = $row['sy'];

        $tsched = date_create($t_sched);
        $formatd = date_format($tsched, "F d, Y h:i a");
        $select = mysqli_query($con, "SELECT acad_year, sem FROM academic_year where code='".$sy."'");
        $rows=mysqli_fetch_assoc($select);
        $acadYear = $rows['acad_year'];
        $sem = $rows['sem'];

        $body = "Hi,";
            $body .= '<p>Your Entrance Exam result is already available. Kindly check it in your account or download the attached file below. Thank you.</p>
            <div class= "container mt-3 mb-4">
                    <br>
                    <div class="col-md-12">
                        Name of Applicant: '.$name.'
                        <br>
                        TPN: '.$tpn.'
                        <br>
                        Date of Examination: AY '.$acadYear.' '.$sem.' '.$formatd.'
                        <br>
                        Testing Center: '.$tsite.'
                        <br>
                        Raw Score: '.$tscore.'
                        Description: '.$tdes.'
                    </div>
            </div>
            ';
            $subject = "Entrance Exam Result";
            $email_to = $email;
                                    
            //autoload the PHPMailer
            //require("vendor/autoload.php");
            $mail = new PHPMailer(true);
            $mail->IsSMTP();
            $mail->Host = "smtp.gmail.com";   // Enter your host here
            $mail->SMTPAuth = true;
            $mail->Username = "essuadmissionandtesting0@gmail.com";                   // SMTP username
            $mail->Password = "lxyuiyamgcyluiqq";   //Enter your passwrod here
            $mail->SMTPSecure = "tls";       // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587; 
            $mail->IsHTML(true);
            $mail->setFrom('essuadmissionandtesting0@gmail.com');
            $mail->addStringAttachment($pdfFile,'essu-entrance-result.pdf');
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AddAddress($email_to);
            if (!$mail->Send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }else {
                echo '<script> alert("Data saved successfully."); </script>';
                echo '<script>location.href="adm-result.php"</script>';
            }
        
    }      
?>
<body>
    

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>

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
    
    <!--<script>
        $(document).ready(function(){
            $("#vcrawscr, #vrrawscr").keyup(function(){
                var vtotal = 0;
                var a = Number($("#vcrawscr").val());
                if(a == 0 && a <= 5){
                    var vcbadesc = "Below Average";
                    $('#vcdescrp').val(vcbadesc);
                }
                if(a > 5 && a <= 10){
                    var vcadesc = "Average";
                    $('#vcdescrp').val(vcadesc);
                }
                if(a > 10 && a <= 12){
                    var vcaadesc = "Above Average";
                    $('#vcdescrp').val(vcaadesc);
                }
                if(a > 12){
                    var vcndesc = "Invalid";
                    $('#vcdescrp').val(vcndesc);
                    alert("Invalid input.");
                }
                
                var b = Number($("#vrrawscr").val());
                if(b == 0 && b <= 11){
                    var vrbadesc = "Below Average";
                    $('#vrdescrp').val(vrbadesc);
                }
                if(b > 11 && b <= 18){
                    var vradesc = "Average";
                    $('#vrdescrp').val(vradesc);
                }
                if(b > 18 && b <= 24){
                    var vraadesc = "Above Average";
                    $('#vrdescrp').val(vraadesc);
                }
                if(b > 24){
                    var vrndesc = "Invalid";
                    $('#vrdescrp').val(vrndesc);
                    alert("Invalid input.");
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            $("#frrawscr, #qrrawscr").keyup(function(){
                var nvtotal = 0;
                var c = Number($("#frrawscr").val());
                if(c == 0 && c <= 8){
                    var frbadesc = "Below Average";
                    $('#frdescrp').val(frbadesc);
                }
                if(c > 8 && c <= 14){
                    var fradesc = "Average";
                    $('#frdescrp').val(fradesc);
                }
                if(c > 14 && c <= 18){
                    var fraadesc = "Above Average";
                    $('#frdescrp').val(fraadesc);
                }
                if(c > 18){
                    var frndesc = "Invalid";
                    $('#frdescrp').val(frndesc);
                    alert("Invalid input.");
                }
                
                var d = Number($("#qrrawscr").val());
                if(d == 0 && d <= 9){
                    var qrbadesc = "Below Average";
                    $('#qrdescrp').val(qrbadesc);
                }
                if(d > 9 && d <= 16){
                    var qradesc = "Average";
                    $('#qrdescrp').val(qradesc);
                }
                if(d > 16 && d <= 18){
                    var qraadesc = "Above Average";
                    $('#qrdescrp').val(qraadesc);
                }
                if(d > 18){
                    var qrndesc = "Invalid";
                    $('#qrdescrp').val(qrndesc);
                    alert("Invalid input.");
                }
            })
        })
    </script>-->
</body>
</html>