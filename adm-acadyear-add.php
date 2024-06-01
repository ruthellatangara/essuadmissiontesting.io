<?php
include 'connect.php';


if(isset($_POST['insertdata']))
{ 
    $code = $_POST['code'];
    $acad = $_POST['acad'];
    $semester = $_POST['semester'];
    
    $sql = "Select * from academic_year where code='$code'";
    $sql_run = mysqli_query($con,$sql);
    
    if(mysqli_num_rows($sql_run) > 0){
        echo '<script> alert("Failed. Trying to save duplicate data"); </script>';
    }
    else{
        $query = "INSERT INTO academic_year (code,acad_year,sem) VALUES ('$code','$acad','$semester')";
        $query_run = mysqli_query($con, $query);
        if($query_run==FALSE)
        {
            die(mysqli_error($con));
        }
        else
        {
            header('Location: adm-acadyear.php');
        }
    }
}
else
    {
        echo '<script> alert("Data Not Saved"); </script>';
        echo "<script>location.href='adm-acadyear.php'</script>";
    }

?>