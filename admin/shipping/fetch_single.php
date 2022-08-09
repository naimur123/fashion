<?php
include('db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM shipping_fee 
		WHERE id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
	
		$output["coupcode"] = $row["shippingcost"];
		$output["coupamt"] = $row["outsidedhaka"];
		$output["remarks"] = $row["remarks"];
		$output["active"] = $row["active"];
		$output["outsideFreeAfter"] = $row["outsideFreeAfter"];
		$output["insideFreeAfter"] = $row["insideFreeAfter"];
		
	}
	echo json_encode($output);
}
?>