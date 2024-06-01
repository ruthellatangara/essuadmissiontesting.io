<?php
include 'connect.php';


if(isset($_POST['insertdata']))
{ 
    $college = $_POST['college'];
    $program = $_POST['program'];
    
    $sql = "Select * from program_tab where program='$program'";
    $sql_run = mysqli_query($con,$sql);
    
    if(mysqli_num_rows($sql_run) > 0){
        echo '<script> alert("Failed. Trying to save duplicate data"); </script>';
    }
    else{
        $query = "INSERT INTO program_tab (college,program) VALUES ('$college','$program')";
        $query_run = mysqli_query($con, $query);
        if($query_run==FALSE)
        {
            die(mysqli_error($con));
        }
        else
        {
            header('Location: adm-program-list.php');
        }
    }
}
else
    {
        echo '<script> alert("Data Not Saved"); </script>';
        echo "<script>location.href='adm-program-list.php'</script>";
    }

?>