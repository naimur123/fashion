<?php
include('db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM orders 
		WHERE id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
	
		$output["total_amt"] = $row["total_price"];
		$output["subtotal_amt"] = $row["sub_total_price"];
		$output["shipping_amt"] = $row["shipping_cost"];
		$output["discount_amt"] = $row["discount_amount"];
		$output["delv_man"] = $row["delivery_man"];
		$output["admin_text"] = $row["admin_message"];
		$output["active"] = $row["status"];
		
	}
	echo json_encode($output);
}
?>