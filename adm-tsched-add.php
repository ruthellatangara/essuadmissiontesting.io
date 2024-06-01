<?php

include 'connect.php';

if(isset($_POST['adddata']))
{ 
    $code = $_POST['code'];
    $sched = $_POST['tday1'];

    $check = mysqli_query($con, "SELECT * from tsched_tab where code='$code'");
    if (mysqli_num_rows($check)>3) {
        echo '<script> alert("The data you are trying to save has reached its total count."); </script>';
        echo "<script>location.href='adm-tsched.php'</script>";
    }else{
        $query = "INSERT INTO tsched_tab (code,sched,schedYear) VALUES ('$code','$sched',YEAR(NOW()))";
        $query_run = mysqli_query($con, $query);
        if($query_run==FALSE)
        {
            die(mysqli_error($con));
        }
        if($query_run)
        {
            header('Location: adm-tsched.php');
        }
        else
        {
            echo '<script> alert("Data Not Saved"); </script>';
            echo "<script>location.href='adm-tsched.php'</script>";
        }
    }
}

?>