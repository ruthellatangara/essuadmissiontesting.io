<?php
session_start();
require 'connect.php';
// Include the main TCPDF library (search for installation path).
require_once('TCPDF-main/tcpdf.php');

if(isset($_SESSION['email'])){
    $apprefno = $_GET['id'];

    $sql="SELECT apprefno,sy,campus,tsite,fchoice,schoice,tchoice,lname,fname,mname,email,contact,date_format(dob, '%M %e, %Y') as dob,pob,sex,civstat,brgy,mun,prov,lschool,lsaddress,lsy,genave,q1,q1a,q2,q2a from student_archive where apprefno='$apprefno'";

    $query = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($query)){
        $apprefno = $row['apprefno'];
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
    }


/*
*

*/
class PDF extends TCPDF{
    public function Header(){
        $imageFile = K_PATH_IMAGES.'HEADER.jpg';
        $this->Image($imageFile, 15, 5, 75, '', 'JPG', '', 'T', false, 300, '', false, false,
        0, false, false, false);
    }
    public function Footer(){
        $this->SetY(-26);
        $this->Ln(5);
        $this->SetFont('helvetica','I',9);


        // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
        $this->Multicell(189,15,'The information on this form will be used in accordance with the University\'s policy and personal data.', 0, 'L', 0, 1, '', '', true);
        
        $this->setFont('helvetica', 'I', 8);

        $this->Cell(164,5,'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(),
        0,false,'R',0,'',0,false,'T','M');
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

$style3 = array('width' => 1, 'cap' => 'round', 'join' => '2,10', 'color' =>  array(0,0,0));

$pdf->SetFont('helvetica','B',12);
$pdf->Cell(189,3,'UNIVERSITY ADMISSION APPLICATION FORM',0,1,'C');


$pdf->SetFont('helvetica','',10);
$pdf->Cell(189,3,'(Undergraduate Program)',0,1,'C');
$pdf->Ln(3);

$pdf->setFont('helvetica','',10);

$pdf->setFillColor(255,255,255);
$pdf->Cell(50,6,'Application Reference No. :',1,0,'L',1);
$pdf->Cell(133,6,''.$apprefno,1,1,'L',1);

$pdf->setFont('helvetica','',10);
$pdf->Cell(50,6,'School Year: ',1,0,'L',1);
$pdf->Cell(50,6,'AY '.$acadYear.' '.$sem,1,0,'L',1);
$pdf->Cell(25,6,'Campus: ',1,0,'L',1);
$pdf->Cell(58,6,''.$campus,1,1,'L',1);

$pdf->Cell(183,6,'Degree/Program Choices: ',1,1,'L',1);

$pdf->setFont('helvetica','',8);
// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
$pdf->Multicell(61,12,''.$fchoice, 1, 'L', 0, 0, '', '', true);
$pdf->Multicell(61,12,''.$schoice, 1, 'L', 0, 0, '', '', true);
$pdf->Multicell(61,12,''.$tchoice, 1, 'L', 0, 1, '', '', true);
//$pdf->Cell(61,6,''.$tchoice,1,1,'L',0);


$pdf->setFont('helvetica','',10);
$pdf->setFillColor(224,235,255);
$pdf->Cell(61,6,'First Choice:',1,0,'L',1);
$pdf->Cell(61,6,'Second Choice:',1,0,'L',1);
$pdf->Cell(61,6,'Third Choice:',1,0,'L',1);
$pdf->Ln(1);

$pdf->Ln(5);
$pdf->setFillColor(255,255,255);
$pdf->setFont('helvetica','B',10);
$pdf->Cell(183,6,'Applicant Details: ',1,1,'L',1);
$pdf->setFont('helvetica','',10);

$pdf->Cell(61,6,''.$lname,1,0,'C',1);
$pdf->Cell(61,6,''.$fname,1,0,'C',1);
$pdf->Cell(61,6,''.$mname,1,1,'C',1);

$pdf->setFillColor(224,235,255);
$pdf->Cell(61,6,'Last Name:',1,0,'L',1);
$pdf->Cell(61,6,'First Name:',1,0,'L',1);
$pdf->Cell(61,6,'Middle Name:',1,1,'L',1);

$pdf->setFillColor(255,255,255);
$pdf->Cell(30,6,'Email Address: ',1,0,'L',1);
$pdf->Cell(77,6,''.$emailadd,1,0,'L',1);
$pdf->Cell(18,6,'Campus: ',1,0,'L',1);
$pdf->Cell(58,6,''.$contactno,1,1,'L',1);

$pdf->Cell(50,6,''.$dob,1,0,'C',1);
$pdf->Cell(65,6,''.$pob,1,0,'C',1);
$pdf->Cell(35,6,''.$sex,1,0,'C',1);
$pdf->Cell(33,6,''.$status,1,1,'C',1);

$pdf->setFillColor(224,235,255);
$pdf->Cell(50,6,'Date of Birth (mm/dd/yyyy):',1,0,'L',1);
$pdf->Cell(65,6,'Place of Birth (Town, Province):',1,0,'L',1);
$pdf->Cell(35,6,'Sex:',1,0,'L',1);
$pdf->Cell(33,6,'Status:',1,1,'L',1);

$pdf->setFillColor(255,255,255);
$pdf->Cell(183,6,'Permanent Address: ',1,1,'L',1);

$pdf->Cell(61,6,''.$brgy,1,0,'C',1);
$pdf->Cell(61,6,''.$municip,1,0,'C',1);
$pdf->Cell(61,6,''.$prov,1,1,'C',1);

$pdf->setFillColor(224,235,255);
$pdf->Cell(61,6,'Barangay:',1,0,'L',1);
$pdf->Cell(61,6,'Municipality:',1,0,'L',1);
$pdf->Cell(61,6,'Province:',1,1,'L',1);

$pdf->setFillColor(255,255,255);
$pdf->Cell(183,6,'LAST SCHOOL ATTENDED: ',1,1,'L',1);

$pdf->setFont('helvetica','',9);
$pdf->Multicell(50,12,''.$school, 1, 'L', 0, 0, '', '', true);
$pdf->Multicell(65,12,''.$address, 1, 'L', 0, 0, '', '', true);
$pdf->setFont('helvetica','',10);
$pdf->Cell(35,12,''.$year,1,0,'C',1);
$pdf->Cell(33,12,''.$genave,1,1,'C',1);

$pdf->setFillColor(224,235,255);
$pdf->Cell(50,6,'Name of School:',1,0,'L',1);
$pdf->Cell(65,6,'Address:',1,0,'L',1);
$pdf->Cell(35,6,'Year:',1,0,'L',1);
$pdf->Cell(33,6,'Gen. Average:',1,1,'L',1);

$pdf->setFillColor(255,255,255);
$pdf->setFont('helvetica','B',10);
$pdf->Cell(183,5,'DECLARATION: ',1,1,'L',1);

$pdf->setFillColor(224,235,255);
$pdf->setFont('helvetica','',10);
$pdf->Cell(183,6,'Do you have a physical condition which may affect your performance in College? ',1,1,'L',1);
$pdf->setFillColor(255,255,255);
$pdf->Cell(10,6,''.$q1,1,0,'L',1);
$pdf->Cell(173,6,''.$q1a,1,1,'L',1);
$pdf->setFillColor(224,235,255);
$pdf->Cell(183,6,'Have you been sybjected to any disciplinary action? ',1,1,'L',1);

$pdf->setFillColor(255,255,255);
$pdf->Cell(10,6,''.$q2,1,0,'L',1);
$pdf->Cell(173,6,''.$q2a,1,1,'L',1);

$pdf->setFillColor(255,255,255);
$pdf->setFont('helvetica','B',10);
$pdf->Cell(183,5,'To be filled up byt ATO & evaluating college (Date and Signature)',1,1,'L',1);

$pdf->setFont('helvetica','B',10);
$pdf->Cell(30,6,'Degree/Program',1,0,'C',1);
$pdf->setFillColor(224,235,255);
$pdf->setFont('helvetica','',10);
$pdf->Cell(51,6,'First Choice: ',1,0,'L',1);
$pdf->Cell(51,6,'Second Choice: ',1,0,'L',1);
$pdf->Cell(51,6,'Third Choice: ',1,1,'L',1);

$pdf->setFillColor(255,255,255);
$pdf->setFont('helvetica','B',10);
$pdf->Cell(30,6,'Admitted:',1,0,'C',1);
$pdf->Cell(51,6,'',1,0,'L',1);
$pdf->Cell(51,6,' ',1,0,'L',1);
$pdf->Cell(51,6,'',1,1,'L',1);

$pdf->setFont('helvetica','B',10);
$pdf->Cell(30,6,'Forwarded:',1,0,'C',1);
$pdf->Cell(51,6,'',1,0,'L',1);
$pdf->Cell(51,6,' ',1,0,'L',1);
$pdf->Cell(51,6,'',1,1,'L',1);

$pdf->setFont('helvetica','B',10);
$pdf->Cell(30,6,'Not Admitted:',1,0,'C',1);
$pdf->Cell(51,6,'',1,0,'L',1);
$pdf->Cell(51,6,' ',1,0,'L',1);
$pdf->Cell(51,6,'',1,1,'L',1);

$pdf->setFont('helvetica','B',10);
$pdf->Cell(30,6,'Others:',1,0,'C',1);
$pdf->Cell(51,6,'',1,0,'L',1);
$pdf->Cell(51,6,' ',1,0,'L',1);
$pdf->Cell(51,6,'',1,1,'L',1);
$pdf->setFont('helvetica','',10);


$pdf->Cell(183,6,'Remarks:',1,1,'L',1);
$pdf->cell(183,10,'Admitted in the College of ____________________________ with the degree of ___________________________.',1,1,'L',1);
$pdf->setFont('helvetica','',10);
$pdf->Cell(92,8,'',1,0,'C',1);
$pdf->cell(91,8,'',1,1,'C',1);
$pdf->setFillColor(224,235,255);
$pdf->Cell(92,5,'HEAD ADMISSION SERVICES OFFICE',1,0,'C',1);
$pdf->cell(91,5,'DATE',1,1,'C',1);
$pdf->Ln(3);
$pdf->setFont('helvetica','',10);
$pdf->Multicell(185,5,'I agree that the information above is true, complete and correct. I understand that falsification or withholding of information on this form will nullify and/or subject me to dismissal from the University.', 0, 'L', 0, 1, '', '', true);

$pdf->Output('essu-applicationform.pdf','I');
}


?>