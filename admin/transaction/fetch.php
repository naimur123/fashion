<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM transaction ";

if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE card_number LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR id LIKE "%'.$_POST["search"]["value"].'%" ';
	
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id desc ';
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
	// 	$offer = '';
	// if($row['hot_deals'] == 1) {
	// 	$offer = '<label class="label label-success">Active</label>';
	// } else {
	// 	$offer = '<label class="label label-danger">Deactive</label>'; 
	// }
	
	$active = '';
	if($row['status'] == 1) {
		$active = '<label class="label label-success">Active</label>';
	} else {
		$active = '<label class="label label-danger">Pending</label>'; 
	}

	// $image = '';
	// if($row["name"] != '')
	// {
	// 	$image = '<img src="../items/upload/'.$row["name"].'" class="img-thumbnail" width="50" height="35" />';
	// }
	// else
	// {
	// 	$image = '';
	// }
	$sub_array = array();
	$sub_array[] = $row["id"];
	$sub_array[] = $row["transaction_id"];
	$sub_array[] = $row["transaction_amount"];
	$sub_array[] = $row["user_id"];
	$sub_array[] = $active;
	
	$sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Update</button>';
	$sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
	$data[] = $sub_array;
	
}
$output = array(
	// "draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
    "recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
// echo $output;
?>