<?php

//action.php

$connect = new PDO("mysql:host=localhost; dbname=essu_admissiondb", "root", "");

if($_POST['action'] == 'edit')
{
 $data = array(
  ':college'  => $_POST['college'],
  ':program'  => $_POST['program'],
  ':progID'    => $_POST['progID']
 );

 $query = "
 UPDATE program_tab 
 SET college = :college, 
 program = :program
 WHERE progID = :progID
 ";
 $statement = $connect->prepare($query);
 $statement->execute($data);
 echo json_encode($_POST);
}


?>