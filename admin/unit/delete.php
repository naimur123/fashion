<?php

include('db.php');
include("function.php");

if(isset($_POST["user_id"]))
{
	
	$statement = $connection->prepare(
		"DELETE FROM unit WHERE unit_id = :id"
	);
	$result = $statement->execute(
		array(
			':id'	=>	$_POST["user_id"]
		)
	);
	
	if(!empty($result))
	{
		echo 'Data Deleted';
	}
}



?>