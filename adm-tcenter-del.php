<?php
include 'connect.php';

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM tcenter_tab WHERE tcenterID='$id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        header("Location:adm-tcenter.php");
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
        echo "<script>location.href='adm-tcenter.php'</script>";
    }
        
         $queryy=mysqli_query($con," SELECT * from  tcenter_tab");
         $number = 1;
         while($row= mysqli_fetch_array($queryy)){
            $id=$row['tcenterID'];
            $sql = "UPDATE tcenter_tab SET tcenterID= $number WHERE tcenterID= $id ";
            $sql_run = mysqli_query($con, $sql);
            $number++;
         }
            mysqli_query($con, "ALTER TABLE tcenter_tab AUTO_INCREMENT =1") or die(mysqli_error($con));
}

?>