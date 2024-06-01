<?php
session_start();
$con=new mysqli('localhost','root','','essu_admissiondb');

$yearnow = date("Y");
$lessyear = date("Y",strtotime('- 18 years'));
if (isset($_POST['check_year'])) {
	$year = $_POST['year_id'];
	if($year > $yearnow){
        echo "Please input a valid year.";
    }elseif ($year < $lessyear) {
    	echo "Please input a valid year.";
    }

}
elseif (isset($_POST['check_gen'])) {
	$stringvar = $con->real_escape_string($_POST['gen_id']);
    $floatvar = (float)$stringvar;

    if($stringvar > 100){
    	echo "You are trying to input incorrect value in the General Average field.";
    }

}
?>