<?php
include('db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM unit 
		WHERE unit_id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
	
	
	
		$output["unitname"] = $row["unitname"];
		$output["remarks"] = $row["remarks"];
		$output["active"] = $row["flag"];
		
	}
	echo json_encode($output);
}
?>