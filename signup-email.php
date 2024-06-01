<?php
session_start();
$con=new mysqli('localhost','root','','essu_admissiondb');


if (isset($_POST['check_sub'])) {
	$email = $_POST['email_id'];
	$query = "Select * from account_tab where email='$email'";
	$query_run = mysqli_query($con,$query);

  	if(mysqli_num_rows($query_run) > 0){
      echo "Email Address already existing";
    }

}
?>