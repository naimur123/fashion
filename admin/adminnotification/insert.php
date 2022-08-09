<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		
		$statement = $connection->prepare("
			INSERT INTO scrolling_notification ( notification, remarks, status, create_by, create_date) VALUES ( :coupocode, :remark, :active, '1', Now())
		");
		$result = $statement->execute(
			array(
				':coupocode'	=>	$_POST["coupcode"],
				':remark'		=>	$_POST["remarks"],
				':active'	    =>	$_POST["active"]
			)
		);
		if(!empty($result))
		{
			echo 'Notification Message Inserted';
		}
		else{
			echo 'Notification Message Not Inserted';
		}
	}
	
	if($_POST["operation"] == "Edit")
	{
		
		$statement = $connection->prepare(
			"UPDATE scrolling_notification 
			SET notification=:coupocode, remarks = :remark, status = :active
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':coupocode'	=>	$_POST["coupcode"],
				':remark'		=>	$_POST["remarks"],
				':active'	    =>	$_POST["active"],
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Notification Message Updated';
		}
		else{
			echo 'Notification Message Not Updated';
		}
	}
}
?>