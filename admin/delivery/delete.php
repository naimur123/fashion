<?php
include('db.php');
include("function.php");
if(isset($_POST["user_id"]))
{
	$statement = $connection->prepare(
		"DELETE FROM delivery_man WHERE id = :id"
	);
	$result = $statement->execute(
		array(
			':id'	=>	$_POST["user_id"]
		)
	);
	if(!empty($result))
	{
		echo 'Delivery Man Deleted';
	}
	else
	{
		echo 'Delivery Man Not Deleted';
	}
}
?>