<?php

//fetch.php

//include('database_connection.php');
$connect = new PDO("mysql:host=localhost; dbname=essu_admissiondb", "root", "");

$column = array("code", "acad_year", "sem","status");

$query = "SELECT * FROM academic_year ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE code LIKE "%'.$_POST["search"]["value"].'%" 
 OR acad_year LIKE "%'.$_POST["search"]["value"].'%" 
 OR sem LIKE "%'.$_POST["search"]["value"].'%" 
 OR status LIKE "%'.$_POST["search"]["value"].'%" 
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY code ASC ';
}
$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

foreach($result as $row)
{
 $sub_array = array();
 $sub_array[] = $row['code'];
 $sub_array[] = $row['acad_year'];
 $sub_array[] = $row['sem'];
 $sub_array[] = $row['status'];
 $data[] = $sub_array;
}

function count_all_data($connect)
{
 $query = "SELECT * FROM academic_year";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
 'draw'   => intval($_POST['draw']),
 'recordsTotal' => count_all_data($connect),
 'recordsFiltered' => $number_filter_row,
 'data'   => $data
);

echo json_encode($output);

?>