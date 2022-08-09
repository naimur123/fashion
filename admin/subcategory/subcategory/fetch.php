<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM subcategory ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE sub_catname LIKE "%'.$_POST["search"]["value"].'%" ';
	
}

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY sub_catname asc ';
}

if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
		$active = '';
	if($row['flag'] == 1) {
		$active = '<label class="label label-success">Active</label>';
	} else {
		$active = '<label class="label label-danger">Deactive</label>'; 
	}

	
	$sub_array = array();
	$sub_array[] = $row["sub_id"];
	$sub_array[] = $row["sub_catname"];
	$sub_array[] = $row["cat_name"];
	$sub_array[] = $row["remarks"];
	$sub_array[] = $active;
	$sub_array[] = '<button type="button" name="update" id="'.$row["sub_id"].'" class="btn btn-warning btn-xs update">Update</button>';
	$sub_array[] = '<button type="button" name="delete" id="'.$row["sub_id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
	$data[] = $sub_array;
	
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>