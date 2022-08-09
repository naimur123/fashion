<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM products ";

if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE products_name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR company_name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR products_category LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR prdsubcategory LIKE "%'.$_POST["search"]["value"].'%" ';
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
		$offer = '';
	if($row['offer_item'] == 1) {
		$offer = '<label class="label label-success">Active</label>';
	} else {
		$offer = '<label class="label label-danger">Deactive</label>'; 
	}
	
	$active = '';
	if($row['status'] == 1) {
		$active = '<label class="label label-success">Active</label>';
	} else {
		$active = '<label class="label label-danger">Deactive</label>'; 
	}

	$image = '';
	if($row["name"] != '')
	{
		$image = '<img src="../items/upload/'.$row["name"].'" class="img-thumbnail" width="50" height="35" />';
	}
	else
	{
		$image = '';
	}
	$sub_array = array();
	$sub_array[] = $row["id"];
	$sub_array[] = $image;
	$sub_array[] = $row["products_name"];
	$sub_array[] = $row["company_name"];
	$sub_array[] = $row["price"];
	$sub_array[] = $offer;
	$sub_array[] = $row["offer_percentage"];
	$sub_array[] = $row["offer_price"];
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