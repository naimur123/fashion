<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		
		$statement = $connection->prepare("
			INSERT INTO delivery_man ( delivery_name, phone, remarks, active, create_id, create_date) VALUES ( :coupocode, :coupoamt, :remark, :active, '1', Now())
		");
		$result = $statement->execute(
			array(
				':coupocode'	=>	$_POST["coupcode"],
				':coupoamt'		=>	$_POST["coupamt"],
				':remark'		=>	$_POST["remarks"],
				':active'	    =>	$_POST["active"]
			)
		);
		if(!empty($result))
		{
			echo 'Delivery Man Inserted';
		}
		else{
			echo 'Delivery Man Not Inserted';
		}
	}
	
	if($_POST["operation"] == "Edit")
	{
		
		$statement = $connection->prepare(
			"UPDATE delivery_man 
			SET delivery_name=:coupocode, phone=:coupoamt, remarks = :remark, active = :active
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':coupocode'	=>	$_POST["coupcode"],
				':coupoamt'		=>	$_POST["coupamt"],
				':remark'		=>	$_POST["remarks"],
				':active'	    =>	$_POST["active"],
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Delivery Man Updated';
		}
		else{
			echo 'Delivery Man Not Updated';
		}
	}
}
?>