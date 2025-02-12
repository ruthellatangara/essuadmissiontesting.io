<?php

//fetch.php

//include('database_connection.php');
$connect = new PDO("mysql:host=localhost; dbname=essu_admissiondb", "root", "");

$column = array("progID", "college", "program");

$query = "SELECT * FROM program_tab ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE college LIKE "%'.$_POST["search"]["value"].'%" 
 OR program LIKE "%'.$_POST["search"]["value"].'%" 
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY progID ASC ';
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
 $sub_array[] = $row['progID'];
 $sub_array[] = $row['college'];
 $sub_array[] = $row['program'];
 $data[] = $sub_array;
}

function count_all_data($connect)
{
 $query = "SELECT * FROM program_tab";
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