<?php
include('db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM delivery_man 
		WHERE id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
	
		$output["coupcode"] = $row["delivery_name"];
		$output["coupamt"] = $row["phone"];
		$output["remarks"] = $row["remarks"];
		$output["active"] = $row["active"];
		
	}
	echo json_encode($output);
}
?>