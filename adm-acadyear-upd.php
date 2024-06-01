<?php
session_start();
include 'connect.php';

    if(isset($_POST['updatedata']))
    {   
        $id = $_POST['update_id'];
        $code = $_POST['code'];
        $ay = $_POST['ay'];
        $sem = $_POST['sem'];

        $query = mysqli_query($con,"UPDATE academic_year SET code=$code, acad_year='$ay', sem='$sem' WHERE ay_ID='$id'  ");

	        if($query)
	        {
	        	echo '<script> alert("Data Updated"); </script>';
	            header("Location:adm-acadyear.php");
	        }
	        else
	        {
	            echo '<script> alert("Data Not Updated"); </script>';
	            echo "<script>location.href='adm-acadyear.php'</script>";
	        }
    }
?>