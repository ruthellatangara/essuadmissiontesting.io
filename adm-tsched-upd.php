<?php
include 'connect.php';
    if(isset($_POST['updatedata']))
    {   
        $id = $_POST['update_id'];
        
        $code = $_POST['code'];
        $sched_day = $_POST['uptday'];

        $query = "UPDATE tsched_tab SET code='$code',sched='$sched_day' WHERE schedID='$id'  ";
        $query_run = mysqli_query($con, $query);

        if($query_run)
        {
            header("Location:adm-tsched.php");
        }
        else
        {
            //die(mysqli_error($con));
            echo '<script> alert("Data Not Updated"); </script>';
            echo "<script>location.href='adm-tsched.php'</script>";
        }
    }
?>