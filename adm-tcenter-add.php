<?php

include 'connect.php';

if(isset($_POST['adddata']))
{ 
    $tcenter = $_POST['tcenter'];
    $taddress = $_POST['taddress'];

    $query = "INSERT INTO tcenter_tab (tcenter,tcenterAdd,tcenterYear) VALUES ('$tcenter','$taddress',YEAR(NOW()))";
    $query_run = mysqli_query($con, $query);
    if($query_run==FALSE)
    {
        die(mysqli_error($con));
    }
    if($query_run)
    {
        header('Location: adm-tcenter.php');
    }
    else
    {
        echo '<script> alert("Data Not Saved"); </script>';
        echo "<script>location.href='adm-tcenter.php'</script>";
    }
}

?>