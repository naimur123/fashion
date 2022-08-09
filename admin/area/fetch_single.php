<?php
include('db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM customer_area 
		WHERE id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
	
		$output["areaname"] = $row["area_name"];
		$output["areaflag"] = $row["insideoroutside"];
		$output["remarks"] = $row["remarks"];
		$output["active"] = $row["area_flag"];
		
	}
	echo json_encode($output);
}
?>