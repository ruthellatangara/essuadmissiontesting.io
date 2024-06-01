<?php
session_start();
require 'connect.php';
// Include the main TCPDF library (search for installation path).
require_once('TCPDF-main/tcpdf.php');
 
if (isset($_SESSION['email'])) {
    if(isset($_GET['id'])){
            $apprefno=$_GET['id'];

            $query="SELECT apprefno, CONCAT (fname, ' ', mname, ' ', lname) AS fullname, tsched, tsite, date_format(relresult, '%M %e, %Y') as relresult from account_tab where apprefno='$apprefno'";

            $result = mysqli_query($con,$query);
            while ($row = mysqli_fetch_array($result))
            {
                    $apprefno=$row['apprefno'];
                    $name=$row['fullname'];
                    $t_sched=$row['tsched'];
                    $test_site=$row['tsite'];
                    $dresult=$row['relresult'];
            }

    $fetch = mysqli_query($con, "SELECT sched, code FROM tsched_tab where sched='".$t_sched."'");
    $tsched = date_create($t_sched);
    $formatd = date_format($tsched, "F d, Y h:i a");
    $frow=mysqli_fetch_assoc($fetch);
    $code = $frow['code'];

    $select = mysqli_query($con, "SELECT acad_year, sem FROM academic_year where code='".$code."'");
    $rows=mysqli_fetch_assoc($select);
    $acadYear = $rows['acad_year'];
    $sem = $rows['sem']; 
    //$sem = $frow['sem'];
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

    $style3 = array('width' => 1, 'cap' => 'round', 'join' => '2,10', 'color' =>  array(0,0,0));

    $pdf->SetFont('helvetica','',9);
    $pdf->Rect(90,25,40,40,'DF',$style3,array(220,220,200));
    $pdf->Cell(189,5,'ID Picture taken within',0,1,'C');
    $pdf->Cell(189,1,'the last 6 months',0,1,'C');
    $pdf->Cell(189,2,'3.5 cm X 4.5 cm',0,1,'C');
    $pdf->Cell(189,2,'(passport size)',0,1,'C');
    $pdf->Cell(189,2,'Computer generated',0,1,'C');
    $pdf->Cell(189,2,'or photocopied picture',0,1,'C');
    $pdf->Cell(189,2,'is not acceptable',0,1,'C');
    $pdf->Ln(3);
    $pdf->Cell(189,2,'PHOTO',0,1,'C');

    $pdf->Ln(4);
    $pdf->SetFont('helvetica','B',10);
    $pdf->Cell(189,3,'UNIVERSITY ENTRANCE EXAMINATION PERMIT',0,1,'C');
    $pdf->Ln(1);
    $pdf->SetFont('helvetica','B',9);
    $pdf->Cell(23,4,'APP_REF NO.',0,0,'L');
    $pdf->Cell(80,4,''.$apprefno,0,1,'L');
    $pdf->SetFont('helvetica','',9);
    $pdf->Cell(30,4,'Name of Examinee:',0,0,'L');
    $pdf->Cell(80,4,''.$name,0,1,'L');
    $pdf->SetFont('helvetica','',9);
    $pdf->Cell(32,4,'Date of Examination:',0,0,'L');
    $pdf->Cell(25,4,'AY '.$acadYear.' '.$sem.' '.$formatd,0,1,'L');
    $pdf->Cell(20,4,'Testing Site:',0,0,'L');
    $pdf->Cell(35,4,''.$test_site,0,1,'L');
    $pdf->Cell(57,4,'Date of Release of Examination Result: ',0,0,'L');
    $pdf->Cell(10,4,''.$dresult,0,1,'L');
    $pdf->Ln(1);

    $pdf->SetFont('helvetica','I',9);
    $pdf->Cell(50,4,'Reminder: Bring the following:',0,1,'L');
    $pdf->Cell(50,4,'     1.   Examination Permit',0,1,'L');
    $pdf->Cell(50,4,'     2.   Pencil No.2 sharpener and eraser',0,1,'L');
    $pdf->Cell(50,4,'     3.   School ID and blue ballpen',0,1,'L');
    $pdf->Cell(50,4,'     4.   Snacks (optional)',0,1,'L');

    $pdf->Ln(5);
    $pdf->SetFont('helvetica','B',9);
    $pdf->Cell(189,3,'INFORMED CONSENT',0,1,'C');
    $pdf->SetFont('helvetica','',9);
    $pdf->Multicell(185,4,'This is for your awareness as to the nature, purpose, and limitations of the test and its administration as well as the handling of the test results and report. Please read carefully and indicate your agreement by affixing your signature.', 0, 'J', 0, 1, '', '', true);
    $pdf->Ln(3);

    $pdf->SetFont('helvetica','b',9);
    $pdf->Cell(32,4,'Purpose of the test. ',0,0,'L');
    $pdf->SetFont('helvetica','',9);
    $pdf->Cell(120,4,'The test is given to provide a brief assessment of your cognitive and academic capabilities which is helpful in ',0,1,'L');
    $pdf->Cell(20,4,'your degree program placement. You cannot enroll in any course in the University without taking the test.',0,1,'L');


    $pdf->SetFont('helvetica','B',9);
    $pdf->Cell(38,4,'Professionals-in-charge.',0,0,'L');
    $pdf->SetFont('helvetica','',9);
    $pdf->Cell(120,4,'The test may be administered by college instructors who were trained by a licensed university counselor. ',0,1,'L');
    $pdf->Cell(20,4,'Both the university counselor and the university psychometrician oversee the administration, scoring, result interpretation, and',0,1,'L');
    $pdf->Cell(20,4,'reporting of the test.',0,1,'L');

    $pdf->SetFont('helvetica','b',9);
    $pdf->Cell(24,4,'Confidentiality.',0,0,'L');
    $pdf->SetFont('helvetica','',9);
    $pdf->Cell(120,4,'Test results will be kept with utmost confidentiality. Only the personnel assigned in the testing and admission',0,1,'L');
    $pdf->Cell(20,4,'processes can access your test result. However, the UCCPD may use the data for research and academic purposes.',0,1,'L');

    $pdf->SetFont('helvetica','b',9);
    $pdf->Cell(21,4,'Participation.',0,0,'L');
    $pdf->SetFont('helvetica','',9);
    $pdf->Cell(120,4,'Taking the test is your decision. At any time, you can withdraw your application for this test without any fees',0,1,'L');
    $pdf->Cell(20,4,'or fines. You can also withdraw your participation during the test and in such case, your answers will not be checked and',0,1,'L');
    $pdf->Cell(20,4,'you cannot proceed with the enrollment.',0,1,'L');

    $pdf->SetFont('helvetica','b',9);
    $pdf->Cell(28,4,'Release of result.',0,0,'L');
    $pdf->SetFont('helvetica','',9);
    $pdf->Cell(120,4,'Schedule of release of results will be announced in the official university FB page. You will be showing your test',0,1,'L');
    $pdf->Cell(20,4,'result to the college personnel in charge of admissions who will be asking from you the copy of your test report. Only',0,1,'L');
    $pdf->Cell(20,4,'the university counselor, university psychometrician or the campus guidance head can release the result.',0,1,'L');

    $pdf->SetFont('helvetica','b',9);
    $pdf->Cell(12,4,'Report.',0,0,'L');
    $pdf->SetFont('helvetica','',9);
    $pdf->Cell(120,4,'A summary of the test results and a concise written report will be provided to the personnel assigned for admissions',0,1,'L');
    $pdf->Cell(20,4,'to help them in their decision.',0,1,'L');

    $pdf->SetFont('helvetica','b',9);
    $pdf->Cell(40,4,'Fees and payment policy.',0,0,'L');
    $pdf->SetFont('helvetica','',9);
    $pdf->Cell(120,4,'Taking the test and the release of the result are free of charge.',0,1,'L');

    $pdf->SetFont('helvetica','b',9);
    $pdf->Cell(20,4,'Use of data.',0,0,'L');
    $pdf->SetFont('helvetica','',9);
    $pdf->Cell(120,4,'Data will be archived either electronically or manually (or both) and may be used for research endeavors and other',0,1,'L');
    $pdf->Cell(20,4,'academic purposes by the UCCPD only. In such cases, all personal information will be kept with utmost',0,1,'L');
    $pdf->Cell(20,4,'confidentiality and anonymity will be maintained.',0,1,'L');

    $pdf->Ln(3);
    $pdf->SetFont('helvetica','B',9);
    $pdf->Cell(189,3,'UNDERTAKING',0,1,'C');

    $pdf->SetFont('helvetica','I',9);
    $pdf->Cell(50,4,'I have fully understood the information outlined above and will voluntarily take the test.',0,1,'L');

    $pdf->Ln(3);
    $pdf->SetFont('helvetica','',9);
    $pdf->Cell(28,4,'Name of applicant: ',0,0,'L');
    $pdf->Cell(50,4,'______________________________ ',0,1,'L');
    $pdf->Ln(3);
    $pdf->Cell(33,4,'Signature of applicant:  ',0,0,'L');
    $pdf->Cell(65,4,'______________________________ ',0,0,'L');
    $pdf->Cell(20,4,'Date signed:  ',0,0,'L');
    $pdf->Cell(50,4,'_________________________ ',0,0,'L');

    $pdf->Ln(7);
    $pdf->SetFont('helvetica','b',9);
    $pdf->Cell(36,4,'For applicants who are ',0,0,'L');
    $pdf->SetFont('helvetica','b,u',9);
    $pdf->Cell(30,4,'below 18 years old ',0,0,'L');
    $pdf->SetFont('helvetica','b',9);
    $pdf->Cell(40,4,'please include this part:   ',0,1,'L');

    $pdf->Ln(4);
    $pdf->SetFont('helvetica','',9);
    $pdf->Cell(42,4,'Name of parent/guardian: ',0,0,'L');
    $pdf->Cell(50,4,'______________________________ ',0,1,'L');
    $pdf->Ln(3);
    $pdf->Cell(42,4,'Signature of parent/guardian:  ',0,0,'L');
    $pdf->Cell(65,4,'______________________________ ',0,0,'L');
    $pdf->Cell(20,4,'Date signed:  ',0,0,'L');
    $pdf->Cell(50,4,'_________________________ ',0,0,'L');

    $pdf->Ln(7);
    $pdf->Cell(189,4,'_______________________________________________________________________________________________________ ',0,1,'L');
    $pdf->Cell(70,4,'ESSU-ACAD-200b|Version 4',0,1,'L');
    $pdf->Cell(50,4,'March 1, 2023 ',0,0,'L');

    }
    $pdf->Output('essu-admission-permit.pdf','I');
}
//Close and output PDF document



?>