<?php
include('db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM customer_registration WHERE id = '".$_POST["user_id"]."' LIMIT 1" );
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
	
	
		$output["fullname"] = $row["full_name"];
		$output["address"] = $row["address"];
		$output["cusarea"] = $row["customer_area"];
		$output["cusphone"] = $row["phone"];
		$output["cusemail"] = $row["email"];
		$output["active"] = $row["flag"];
		
	}
	echo json_encode($output);
}
?>