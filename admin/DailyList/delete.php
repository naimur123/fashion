<?php
include('db.php');
include("function.php");
if(isset($_POST["user_id"]))
{
	$statement = $connection->prepare(
		//"DELETE FROM orders WHERE id = :id"
		"update orders set status='0' where id=:id"
	);
	$result = $statement->execute(
		array(
			':id'	=>	$_POST["user_id"]
		)
	);
	if(!empty($result))
	{
		echo 'Order ID Deleted';
	}
	else
	{
		echo 'Order ID Not Deleted';
	}
}
?>