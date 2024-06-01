<?php
session_start();
include 'connect.php';
error_reporting (E_ALL ^ E_NOTICE); 
        
if(isset($_POST['submit'])){
    $email = $con->real_escape_string($_POST['email']);
    $pass = $con->real_escape_string($_POST['pass']);


    $sql="SELECT * FROM account_tab WHERE email='$email' AND pword=md5('$pass') LIMIT 1";
    $result = mysqli_query($con,$sql);

    if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            if($row['verify']==1){
                if($row['usertype']=="admin"){
                    $_SESSION['email']=$_POST['email'];
                    header("Location: adm-dashboard.php");
                }elseif($row['usertype']=="user"){
                	$_SESSION['email']=$_POST['email'];
                    header("Location: stu-dashboard.php");
                }else{
                    $_SESSION['message']="Please check your inputs.";
                    header("Location: login.php");
                    exit(0);
                }
            }else{
            	$_SESSION['message']="User not verified. Please activate account";
			    header("Location: login.php");
			    exit(0);
                
            }
	}else{
	    $_SESSION['message']="Access denied";
	    header("Location: login.php");
	    exit(0);
	}
}
?>