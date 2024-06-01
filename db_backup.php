<?php
include_once('Mysqldump/Mysqldump.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'mail/PHPMailer.php';
require 'mail/SMTP.php';
require 'mail/Exception.php';

$dump = new \Ifsnop\Mysqldump\Mysqldump('mysql:host=localhost;dbname=essu_admissiondb','root','');
$f=date('d-m-Y');
$dump->start("sql_dump/$f.sql");


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
$mail->addAttachment("sql_dump/$f.sql");
$mail->Subject = "Database Backup".$f;
$mail->Body = "Database Backup";
$mail->AddAddress('essuadmissionandtesting0@gmail.com');
if (!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "A copy of your database has been sent to your email. <a href='adm-dashboard.php' class='btn btn-primary'>Go back</a>";
}
?>