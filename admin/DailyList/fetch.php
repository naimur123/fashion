<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT orders.id as ordid, products.id as prdid,products.products_name as prdname,products.quantity as prdqty,order_items.product_price as ordprdprice,order_items.quantity as qty,order_items.product_price*order_items.quantity as total FROM orders join order_items on orders.id = order_items.order_id JOIN products on order_items.product_id= products.id where orders.status='1' and orders.created >= (CURDATE() - INTERVAL 7 DAY) order by orders.id desc";

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
	
	$sub_array = array();
	$sub_array[] = $row["ordid"];
	$sub_array[] = $row["prdid"];
	$sub_array[] = $row["prdname"];
	$sub_array[] = $row["prdqty"];
	$sub_array[] = $row["ordprdprice"];
	$sub_array[] = $row["qty"];
	$sub_array[] = $row["total"];

	$sub_array[] = '<a class="btn btn-primary btn-xs print" target="_blank" name="print" href="print.php" >Print</a>';

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