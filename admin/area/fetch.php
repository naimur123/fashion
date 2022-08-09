<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM customer_area ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE area_name LIKE "%'.$_POST["search"]["value"].'%" ';
	
}

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id ';
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
	if($row['area_flag'] == 1) {
		$active = '<label class="label label-success">Active</label>';
	} else {
		$active = '<label class="label label-danger">Deactive</label>'; 
	}
	
	$areaflag = '';
	if($row['insideoroutside'] == 1) {
		$areaflag = '<label class="label label-success">Inside Dhaka</label>';
	} else {
		$areaflag = '<label class="label label-danger">Outside Dhaka</label>'; 
	}

	
	$sub_array = array();
	$sub_array[] = $row["id"];
	$sub_array[] = $row["area_name"];
	$sub_array[] = $areaflag;
	$sub_array[] = $row["remarks"];
	$sub_array[] = $active;
	$sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Update</button>';
	$sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
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