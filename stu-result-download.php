<?php 
session_start();
require 'connect.php';
// Include the main TCPDF library (search for installation path).
require_once('TCPDF-main/tcpdf.php');
 
if(isset($_SESSION['email'])){
            $tpn=$_GET['id'];

            $query = "SELECT account_tab.apprefno,CONCAT (account_tab.fname, ' ', account_tab.mname, ' ', account_tab.lname) AS name, account_tab.email, account_tab.contact,  account_tab.sy, account_tab.tsite, account_tab.tsched, result_tab.vcscore, result_tab.vrscore, result_tab.frscore, result_tab.qrscore from account_tab INNER JOIN result_tab ON account_tab.apprefno = result_tab.stuID where account_tab.email='".$_SESSION['email']."'";

            
            $result = mysqli_query($con,$query);
            $row=mysqli_fetch_assoc($result);
            $apprefno = $row['apprefno'];
            $name = $row['name'];
            $email = $row['email'];
            $contact = $row['contact'];
            $t_sched = $row['tsched'];
            $tsite = $row['tsite'];
            $sy = $row['sy'];

        $tsched = date_create($t_sched);
        $formatd = date_format($tsched, "F d, Y h:i a");
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


/*
*

*/
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
$pdf->Cell(40,3,''.$apprefno,0,0,'L');
$pdf->Cell(53,3,'LEGAL NAME OF APPLICANT: ',0,0,'L');
$pdf->Cell(40,3,''.$name,0,1,'L');
$pdf->Ln(1);
$pdf->SetFont('helvetica','',9);
$pdf->Cell(30,3,'Testing Schedule:',0,0,'L');
$pdf->Cell(25,4,'AY '.$acadYear.' '.$sem.' '.$formatd,0,1,'L');
$pdf->Cell(25,3,'Testing Site:',0,0,'L');
$pdf->Cell(40,3,''.$tsite,0,1,'L');
$pdf->Ln(4);

$pdf->SetFont('helvetica','B    ',9);
$pdf->Cell(50,5,'OTIS-LENNON SCHOOL ABILITY TEST (OLSAT, Seventh Edition) RESULTS',0,1,'L');
$pdf->Ln(1);
$pdf->Cell(25,5,'Raw Score: ',0,0,'L');
$pdf->Cell(40,5,''.$raw,0,0,'L');
$pdf->Cell(25,5,'Description: ',0,0,'L');
$pdf->Cell(40,5,''.$rdes,0,1,'L');
$pdf->Ln(3);


}
//Close and output PDF document
$pdf->Output('essu-entrance-result.pdf','D');


?>