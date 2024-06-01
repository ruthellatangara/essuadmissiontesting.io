<?php
include 'connect.php';

    if(isset($_POST['updatedata']))
    {   
        $id = $_POST['update_id'];
        
        $college = $_POST['college'];
        $program = $_POST['program'];

        $query = "UPDATE program_tab SET college='$college', program='$program' WHERE progID='$id'  ";
        $query_run = mysqli_query($con, $query);

        if($query_run)
        {
            header("Location:adm-program-list.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
?>