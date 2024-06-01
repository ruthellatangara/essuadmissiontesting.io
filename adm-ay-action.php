<?php

//action.php

$connect = new PDO("mysql:host=localhost; dbname=essu_admissiondb", "root", "");

if($_POST['action'] == 'edit')
{
 $data = array(
  ':status'  => $_POST['status'],
  ':code'  => $_POST['code']
 );

 $query = "
 UPDATE academic_year 
 SET status = :status
 WHERE code = :code
 ";
 $statement = $connect->prepare($query);
 $statement->execute($data);
 echo json_encode($_POST);
}


?>