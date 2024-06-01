<?php
session_start();
include 'connect.php';

    if(isset($_POST['updatedata']))
    {   
        $id = $_POST['update_id'];
        
        $tcenter = $_POST['tcenter'];
        $taddress = $_POST['taddress'];

        $query = "UPDATE tcenter_tab SET tcenter='$tcenter', tcenterAdd='$taddress' WHERE tcenterID='$id'  ";
        $query_run = mysqli_query($con, $query);

        if($query_run)
        {
            header("Location:adm-tcenter.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
            echo "<script>location.href='adm-tcenter.php'</script>";
        }
    }
?>