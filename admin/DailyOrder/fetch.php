<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM orders where status='1' and created >=(CURDATE() - INTERVAL 7 DAY) order by id desc";

$search_query='';
$search_query .= "SELECT * FROM orders ";

if(isset($_POST["search"]["value"]))
{
	$search_query .= 'WHERE id LIKE "%'.$_POST["search"]["value"].'%" ';	
}

// if(isset($_POST["order"]))
// {
// 	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
// }
// else
// {
// 	//$query .= 'ORDER BY created';
// }

// if($_POST["length"] != -1)
// {
// 	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
// }

$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$active = '';
	if($row['status'] == 1) {
		$active = '<label class="label label-info">Pending</label>';
	}   else if($row['status'] == 2) {
		$active = '<label class="label label-success">Delivered</label>'; 
	} else if($row['status'] == 3) {
		$active = '<label class="label label-warning">Rejected</label>'; 
	} else if($row['status'] == 4) {
		$active = '<label class="label label-primary">Shipping</label>'; 
	} else if($row['status'] == 0) {
		$active = '<label class="label label-danger">Deleted</label>'; 
	} 
	
	//$areaflag = '';
	//if($row['insideoroutside'] == 1) {
	//	$areaflag = '<label class="label label-success">Inside Dhaka</label>';
	//} else {
	//	$areaflag = '<label class="label label-danger">Outside Dhaka</label>'; 
	//}

	
	$sub_array = array();
	$sub_array[] = $row["id"];
	$sub_array[] = $row["customer_id"];
	$sub_array[] = $row["total_price"];
	$sub_array[] = $row["sub_total_price"];
	$sub_array[] = $row["shipping_cost"];
	$sub_array[] = $row["discount_amount"];
	$sub_array[] = $row["created"];
	$sub_array[] = $active;
	$sub_array[] = $row["delivery_man"];
	$sub_array[] = $row["modified"];
	$sub_array[] = $row["admin_message"];
	
	$sub_array[] = '<a class="btn btn-info btn-xs detail" target="_blank" name="detail" href="details.php?id='.$row["id"].'" >Details</a>';
	$sub_array[] = '<a class="btn btn-primary btn-xs print" target="_blank" name="print" href="print.php?id='.$row["id"].'" >Print</a>';
	
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