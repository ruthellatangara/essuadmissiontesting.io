<?php
session_start();
require 'connect.php';
// Include the main TCPDF library (search for installation path).
require_once('TCPDF-main/tcpdf.php');
 
if(isset($_SESSION['email'])){
    $apprefno=$_GET['scoreid'];

    $query="SELECT sy,lname,fname,mname,email,contact, DATE_FORMAT(FROM_DAYS(DATEDIFF(now(),dob)),'%Y')+0 as age,sex,apprefno,tsched,tsite,lschool,campus,fchoice,schoice,tchoice,scaledscr,sai,perrank,stanine,vcscore,vrscore,frscore,qrscore from student_archive where apprefno='$apprefno'";

    $result = mysqli_query($con,$query);
    while ($row = mysqli_fetch_array($result))
    {
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

    }
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

    $fetch = mysqli_query($con, "SELECT sched, code FROM tsched_tab where sched='".$tsched."'");
    $t_sched = date_create($tsched);
    $formatd = date_format($t_sched, "F d, Y h:i a");
    $frow=mysqli_fetch_assoc($fetch);
    $code = $frow['code'];

    $select = mysqli_query($con, "SELECT acad_year, sem FROM academic_year where code='".$code."'");
    $rows=mysqli_fetch_assoc($select);
    $acadYear = $rows['acad_year'];
    $sem = $rows['sem'];
 
/*
*

*/
class PDF extends TCPDF{
    public function Header(){
        //$imageFile = K_PATH_IMAGES.'HEADER.jpg';
        //$sy=$_GET['sy'];
        //$this->Image($imageFile, 10, 5, 60, '', 'JPG', '', 'T', false, 300, '', false, false,
        //0, false, false, false);
        //$this->Ln(5);
        //$this->setFont('helvetica','B','9');
        //$this->Cell(118,5,'',0,0,'C');
        //$this->Cell(7,5,'UNIVERSITY CENTER FOR COUNSELING & PSYCHOSOCIAL DEVELOPMENT',0,1,'C');
        //$this->Cell(118,5,'',0,0,'C');
        //$this->Cell(7,5,'COLLEGE PLACEMENT TEST AY: '.$sy,0,0,'C');
    }
    /*public function Footer(){
        $this->SetY(-26);
        $this->Ln(5);
        $this->SetFont('helvetica','I',10);


        // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
        $this->Multicell(189,15,'The information on this form will be used in accordance with the University\'s policy and personal data.', 0, 'L', 0, 1, '', '', true);
        
        $this->setFont('helvetica', 'I', 8);

        $this->Cell(164,5,'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(),
        0,false,'R',0,'',0,false,'T','M');
    }*/
}

// create new PDF document
$pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Admission Services Office');
$pdf->setTitle('University Entrance Exam Result');
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

$style3 = array('width' => 1, 'cap' => 'round', 'join' => '2,10', 'color' =>  array(0,0,0));
$imageFile = K_PATH_IMAGES.'HEADER.jpg';
        //$sy=$_GET['sy'];
$pdf->Image($imageFile, 10, 5, 60, '', 'JPG', '', 'T', false, 300, '', false, false,
        0, false, false, false);
$pdf->Ln(5);
$pdf->setFont('helvetica','B','9');
$pdf->Cell(118,5,'',0,0,'C');
$pdf->Cell(7,5,'UNIVERSITY CENTER FOR COUNSELING & PSYCHOSOCIAL DEVELOPMENT',0,1,'C');
$pdf->Cell(118,1,'',0,0,'C');
$pdf->Cell(7,1,'COLLEGE PLACEMENT TEST AY: '.$acadYear,0,1,'C');
$pdf->Ln(4);
$pdf->SetFont('helvetica','',9);
$pdf->Cell(20,3,'Copy for: ',0,0,'L');
$pdf->Rect(30,22,5,7,'DF',$style3,array(220,220,200));
$pdf->Cell(21,3,'Applicant',0,0,'L');
$pdf->Rect(51,22,5,7,'DF',$style3,array(220,220,200));
$pdf->Cell(25,3,'Admissions',0,0,'L');
$pdf->Rect(75,22,5,7,'DF',$style3,array(220,220,200));
$pdf->Cell(20,3,'UCCPD',0,0,'L');
$pdf->SetFont('helvetica','B',10);
$pdf->Cell(53,3,'',0,0,'R');
$pdf->Cell(55,3,'ASSESSMENT REPORT',0,1,'R',true);
$pdf->Cell(139,3,'',0,0,'R');
$pdf->Cell(55,3,'CONFIDENTIAL',0,1,'R',true);
$pdf->Ln(2);


$pdf->SetFont('helvetica','B',9);
$pdf->Cell(80,3,'LEGAL NAME OF APPLICANT:',0,0,'L');
$pdf->Cell(33,3,'CONTACT NUMBER:',0,0,'L');
$pdf->Cell(50,3,''.$contact,1,1,'L');
$pdf->Ln(2);

$pdf->setFont('helvetica','',9);
$pdf->Cell(18,3,'Last Name:',0,0,'L');
$pdf->Cell(40,3,''.$lname,1,0,'L');
$pdf->Cell(18,3,'First Name:',0,0,'L');
$pdf->Cell(40,3,''.$fname,1,0,'L');
$pdf->Cell(22,3,'Middle Name: ',0,0,'L');
$pdf->Cell(40,3,''.$mname,1,1,'L');
$pdf->Ln(2);

$pdf->SetFont('helvetica','B',9);
$pdf->Cell(13,3,'AGE:',0,0,'L');
$pdf->SetFont('helvetica','',9);
$pdf->Cell(20,3,''.$age,1,0,'L');
$pdf->SetFont('helvetica','B',9);
$pdf->Cell(25,3,'SEX AT BIRTH: ',0,0,'L');
$pdf->SetFont('helvetica','',9);
$pdf->Cell(30,3,''.$sex,1,0,'L');
$pdf->Cell(25,3,'TESTING SITE:',0,0,'L');
$pdf->SetFont('helvetica','',9);
$pdf->Cell(75,3,''.$tsite,1,1,'L');
$pdf->Ln(2);

$pdf->SetFont('helvetica','B',9);
$pdf->Cell(12,3,'TPN:',0,0,'L');
$pdf->SetFont('helvetica','',9);
$pdf->Cell(35,3,''.$apprefno,1,0,'L');
$pdf->SetFont('helvetica','B',9);
$pdf->Cell(30,3,'TESTING DATE:',0,0,'L');
$pdf->SetFont('helvetica','',9);
$pdf->Cell(23,4,'AY '.$acadYear.' '.$sem.' '.$formatd,0,1,'L');
$pdf->SetFont('helvetica','B',9);
$pdf->Ln(1);
$pdf->SetFont('helvetica','B',9);
$pdf->Cell(33,3,'CURRENT SCHOOL:',0,0,'L');
$pdf->Cell(155,5,''.$lschool,1,1,'L');
//$pdf->Multicell(120,8,''.$campus, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(1);

$pdf->Cell(69,3,'CHOICE OF CAMPUS & DEGREE',0,0,'L');
$pdf->Cell(40,3,'',0,0,'L');
$pdf->Cell(69,3,'INTENDED DEGREE PROGRAM TO ENROLL',0,1,'L');
$pdf->Ln(2);

$pdf->setFont('helvetica','',9);
$pdf->Cell(30,3,'First Choice:',0,0,'L');
$pdf->Cell(50,3,''.$campus,1,0,'L');
$pdf->Cell(30,3,'First Choice:',0,0,'L');
$pdf->setFont('helvetica','',8);
$pdf->Multicell(77,8,''.$fchoice, 1, 'L', 1, 1, '', '', true);
$pdf->Cell(30,3,'',0,0,'L');
$pdf->Cell(50,3,'',0,0,'L');
$pdf->Cell(30,3,'Second Choice:',0,0,'L');
$pdf->setFont('helvetica','',8);
$pdf->Multicell(77,8,''.$schoice, 1, 'L', 1, 1, '', '', true);
$pdf->Cell(30,3,'',0,0,'L');
$pdf->Cell(50,3,'',0,0,'L');
$pdf->Cell(30,3,'Third Choice:',0,0,'L');
$pdf->setFont('helvetica','',8);
$pdf->Multicell(77,8,''.$tchoice, 1, 'L', 1, 1, '', '', true);

$pdf->setFont('helvetica','B',9);
$pdf->Cell(189,3,'OTIS-LENNON ABILITY TEST (OLSAT, Seventh Edition) RESULTS',0,0,'L');
$pdf->Ln(4);

$pdf->Cell(80,8,'SCHOOL ABILITY (Performance by Age)',1,0,'C',true);
$pdf->Cell(4,8,'',0,0,'C');
$pdf->Cell(105,8,'CLUSTER ANALYSIS)',1,1,'C',true);
$pdf->setFont('helvetica','',9);
$pdf->Cell(30,3,'Raw Score',1,0,'L');
$pdf->Cell(50,3,'Total: '.$tscore,1,0,'C');
$pdf->Cell(4,8,'',0,0,'C');

$pdf->setFont('helvetica','B',9);
$pdf->Cell(45,3,'COMPONENTS',1,0,'L');
$pdf->Cell(25,3,'RAW SCORE',1,0,'L');
$pdf->Cell(35,3,'DESCRIPTION',1,1,'C');

$pdf->setFont('helvetica','',9);
$pdf->Cell(30,3,'Scaled Score',1,0,'L');
$pdf->Cell(50,3,''.$scaledscore,1,0,'C');

$pdf->Cell(4,8,'',0,0,'C');

$pdf->setFont('helvetica','B',9);
$pdf->Cell(45,3,'Verbal',1,0,'L');
$pdf->Cell(25,3,''.$vscore,1,0,'C');
$pdf->Cell(35,3,''.$des,1,1,'C');

$pdf->setFont('helvetica','',9);
$pdf->Cell(30,3,'SAI',1,0,'L');
$pdf->Cell(50,3,''.$sai,1,0,'C');

$pdf->Cell(4,8,'',0,0,'C');

$pdf->Cell(45,3,'  Verbal Comprehension',1,0,'L');
$pdf->Cell(25,3,''.$vcscore,1,0,'C');
$pdf->Cell(35,3,''.$vcdes,1,1,'C');

$pdf->Cell(30,3,'Percentile Rank',1,0,'L');
$pdf->Cell(50,3,''.$perrank,1,0,'C');

$pdf->Cell(4,8,'',0,0,'C');

$pdf->Cell(45,3,'  Verbal Reasoning',1,0,'L');
$pdf->Cell(25,3,''.$vrscore,1,0,'C');
$pdf->Cell(35,3,''.$vrdes,1,1,'C');

$pdf->Cell(30,3,'Stanine',1,0,'L');
$pdf->Cell(50,3,''.$stanine,1,0,'C');

$pdf->Cell(4,8,'',0,0,'C');

$pdf->setFont('helvetica','B',9);
$pdf->Cell(45,3,'Nonverbal',1,0,'L');
$pdf->Cell(25,3,''.$nvscore,1,0,'C');
$pdf->Cell(35,3,''.$nvdes,1,1,'C');

$pdf->setFont('helvetica','',9);
$pdf->Cell(30,3,'Description',1,0,'L');
$pdf->Cell(50,3,''.$tdes,1,0,'C');

$pdf->Cell(4,8,'',0,0,'C');

$pdf->Cell(45,3,'  Figurative Reasoning',1,0,'L');
$pdf->Cell(25,3,''.$frscore,1,0,'C');
$pdf->Cell(35,3,''.$frdes,1,1,'C');

$pdf->Cell(30,3,'',0,0,'L');
$pdf->Cell(50,3,'',0,0,'L');

$pdf->Cell(4,8,'',0,0,'C');

$pdf->Cell(45,3,'  Quantitative Reasoning',1,0,'L');
$pdf->Cell(25,3,''.$qrscore,1,0,'C');
$pdf->Cell(35,3,''.$qrdes,1,1,'C');

$pdf->Cell(189,2,'_______________________________________________________________________________________________________________',0,1,'C');

$imageFile = K_PATH_IMAGES.'HEADER.jpg';
        //$sy=$_GET['sy'];
$pdf->Image($imageFile, 10, 140, 60, '', 'JPG', '', 'T', false, 300, '', false, false,
        0, false, false, false);
$style3 = array('width' => 1, 'cap' => 'round', 'join' => '2,10', 'color' =>  array(0,0,0));
$pdf->Ln(5);
$pdf->setFont('helvetica','B','9');
$pdf->Cell(118,3,'',0,0,'C');
$pdf->Cell(7,3,'UNIVERSITY CENTER FOR COUNSELING & PSYCHOSOCIAL DEVELOPMENT',0,1,'C');
$pdf->Cell(118,1,'',0,0,'C');
$pdf->Cell(7,1,'COLLEGE PLACEMENT TEST AY: '.$acadYear,0,1,'C');
$pdf->Ln(4);
$pdf->SetFont('helvetica','',9);
$pdf->Cell(20,3,'Copy for: ',0,0,'L');
$pdf->Rect(30,157,5,7,'DF',$style3,array(220,220,200));
$pdf->Cell(21,3,'Applicant',0,0,'L');
$pdf->Rect(51,157,5,7,'DF',$style3,array(220,220,200));
$pdf->Cell(25,3,'Admissions',0,0,'L');
$pdf->Rect(75,157,5,7,'DF',$style3,array(220,220,200));
$pdf->Cell(20,3,'UCCPD',0,0,'L');
$pdf->SetFont('helvetica','B',10);
$pdf->Cell(53,3,'',0,0,'R');
$pdf->Cell(55,3,'ASSESSMENT REPORT',0,1,'R',true);
$pdf->Cell(139,3,'',0,0,'R');
$pdf->Cell(55,3,'CONFIDENTIAL',0,1,'R',true);
$pdf->Ln(2);


$pdf->SetFont('helvetica','B',9);
$pdf->Cell(80,3,'LEGAL NAME OF APPLICANT:',0,0,'L');
$pdf->Cell(33,3,'CONTACT NUMBER:',0,0,'L');
$pdf->Cell(50,3,''.$contact,1,1,'L');
$pdf->Ln(2);

$pdf->setFont('helvetica','',9);
$pdf->Cell(18,3,'Last Name:',0,0,'L');
$pdf->Cell(40,3,''.$lname,1,0,'L');
$pdf->Cell(18,3,'First Name:',0,0,'L');
$pdf->Cell(40,3,''.$fname,1,0,'L');
$pdf->Cell(22,3,'Middle Name: ',0,0,'L');
$pdf->Cell(40,3,''.$mname,1,1,'L');
$pdf->Ln(2);

$pdf->SetFont('helvetica','B',9);
$pdf->Cell(13,3,'AGE:',0,0,'L');
$pdf->SetFont('helvetica','',9);
$pdf->Cell(20,3,''.$age,1,0,'L');
$pdf->SetFont('helvetica','B',9);
$pdf->Cell(25,3,'SEX AT BIRTH: ',0,0,'L');
$pdf->SetFont('helvetica','',9);
$pdf->Cell(30,3,''.$sex,1,0,'L');
$pdf->Cell(25,3,'TESTING SITE:',0,0,'L');
$pdf->SetFont('helvetica','',9);
$pdf->Cell(75,3,''.$tsite,1,1,'L');
$pdf->Ln(2);

$pdf->SetFont('helvetica','B',9);
$pdf->Cell(12,3,'TPN:',0,0,'L');
$pdf->SetFont('helvetica','',9);
$pdf->Cell(35,3,''.$apprefno,1,0,'L');
$pdf->SetFont('helvetica','B',9);
$pdf->Cell(30,3,'TESTING DATE:',0,0,'L');
$pdf->SetFont('helvetica','',9);
$pdf->Cell(23,4,'AY '.$acadYear.' '.$sem.' '.$formatd,0,1,'L');
$pdf->SetFont('helvetica','B',9);
$pdf->Ln(1);
$pdf->SetFont('helvetica','B',9);
$pdf->Cell(33,3,'CURRENT SCHOOL:',0,0,'L');
$pdf->Cell(155,5,''.$lschool,1,1,'L');
//$pdf->Multicell(120,8,''.$campus, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(1);

$pdf->Cell(69,3,'CHOICE OF CAMPUS & DEGREE',0,0,'L');
$pdf->Cell(40,3,'',0,0,'L');
$pdf->Cell(69,3,'INTENDED DEGREE PROGRAM TO ENROLL',0,1,'L');
$pdf->Ln(2);

$pdf->setFont('helvetica','',9);
$pdf->Cell(30,3,'First Choice:',0,0,'L');
$pdf->Cell(50,3,''.$campus,1,0,'L');
$pdf->Cell(30,3,'First Choice:',0,0,'L');
$pdf->setFont('helvetica','',8);
$pdf->Multicell(77,8,''.$fchoice, 1, 'L', 1, 1, '', '', true);
$pdf->Cell(30,3,'',0,0,'L');
$pdf->Cell(50,3,'',0,0,'L');
$pdf->Cell(30,3,'Second Choice:',0,0,'L');
$pdf->setFont('helvetica','',8);
$pdf->Multicell(77,8,''.$schoice, 1, 'L', 1, 1, '', '', true);
$pdf->Cell(30,3,'',0,0,'L');
$pdf->Cell(50,3,'',0,0,'L');
$pdf->Cell(30,3,'Third Choice:',0,0,'L');
$pdf->setFont('helvetica','',8);
$pdf->Multicell(77,8,''.$tchoice, 1, 'L', 1, 1, '', '', true);

$pdf->setFont('helvetica','B',9);
$pdf->Cell(189,3,'OTIS-LENNON ABILITY TEST (OLSAT, Seventh Edition) RESULTS',0,0,'L');
$pdf->Ln(4);

$pdf->Cell(80,8,'SCHOOL ABILITY (Performance by Age)',1,0,'C',true);
$pdf->Cell(4,8,'',0,0,'C');
$pdf->Cell(105,8,'CLUSTER ANALYSIS)',1,1,'C',true);
$pdf->setFont('helvetica','',9);
$pdf->Cell(30,3,'Raw Score',1,0,'L');
$pdf->Cell(50,3,'Total: '.$tscore,1,0,'C');
$pdf->Cell(4,3,'',0,0,'C');

$pdf->setFont('helvetica','B',9);
$pdf->Cell(45,3,'COMPONENTS',1,0,'L');
$pdf->Cell(25,3,'RAW SCORE',1,0,'L');
$pdf->Cell(35,3,'DESCRIPTION',1,1,'C');

$pdf->setFont('helvetica','',9);
$pdf->Cell(30,3,'Scaled Score',1,0,'L');
$pdf->Cell(50,3,''.$scaledscore,1,0,'C');

$pdf->Cell(4,3,'',0,0,'C');

$pdf->setFont('helvetica','B',9);
$pdf->Cell(45,3,'Verbal',1,0,'L');
$pdf->Cell(25,3,''.$vscore,1,0,'C');
$pdf->Cell(35,3,''.$des,1,1,'C');

$pdf->setFont('helvetica','',9);
$pdf->Cell(30,3,'SAI',1,0,'L');
$pdf->Cell(50,3,''.$sai,1,0,'C');

$pdf->Cell(4,3,'',0,0,'C');

$pdf->Cell(45,3,'  Verbal Comprehension',1,0,'L');
$pdf->Cell(25,3,''.$vcscore,1,0,'C');
$pdf->Cell(35,3,''.$vcdes,1,1,'C');

$pdf->Cell(30,3,'Percentile Rank',1,0,'L');
$pdf->Cell(50,3,''.$perrank,1,0,'C');

$pdf->Cell(4,3,'',0,0,'C');

$pdf->Cell(45,3,'  Verbal Reasoning',1,0,'L');
$pdf->Cell(25,3,''.$vrscore,1,0,'C');
$pdf->Cell(35,3,''.$vrdes,1,1,'C');

$pdf->Cell(30,3,'Stanine',1,0,'L');
$pdf->Cell(50,3,''.$stanine,1,0,'C');

$pdf->Cell(4,3,'',0,0,'C');

$pdf->setFont('helvetica','B',9);
$pdf->Cell(45,3,'Nonverbal',1,0,'L');
$pdf->Cell(25,3,''.$nvscore,1,0,'C');
$pdf->Cell(35,3,''.$nvdes,1,1,'C');

$pdf->setFont('helvetica','',9);
$pdf->Cell(30,3,'Description',1,0,'L');
$pdf->Cell(50,3,''.$tdes,1,0,'C');

$pdf->Cell(4,3,'',0,0,'C');

$pdf->Cell(45,3,'  Figurative Reasoning',1,0,'L');
$pdf->Cell(25,3,''.$frscore,1,0,'C');
$pdf->Cell(35,3,''.$frdes,1,1,'C');

$pdf->Cell(30,3,'',0,0,'L');
$pdf->Cell(50,3,'',0,0,'L');

$pdf->Cell(4,3,'',0,0,'C');

$pdf->Cell(45,3,'  Quantitative Reasoning',1,0,'L');
$pdf->Cell(25,3,''.$qrscore,1,0,'C');
$pdf->Cell(35,3,''.$qrdes,1,1,'C');

//Close and output PDF document
$pdf->Output('essu-exam-result.pdf','I');
}

?>