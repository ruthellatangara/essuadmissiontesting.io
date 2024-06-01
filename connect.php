<?php

$con=new mysqli('localhost','root','','essu_admissiondb');

if(!$con){
    die(mysqli_error($con));
}
$error = "";
?>