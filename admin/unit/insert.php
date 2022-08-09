<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		
		$statement = $connection->prepare("
			INSERT INTO unit (unitname, remarks, flag, create_id, create_date) 
			VALUES (:unit_name, :remark, :active, '1', Now())
		");
		$result = $statement->execute(
			array(
				':unit_name'	=>	$_POST["unitname"],
				':remark'	=>	$_POST["remarks"],
				':active'	=>	$_POST["active"]
			)
		);
		if(!empty($result))
		{
			echo 'Unit Inserted';
		}
		else{
			echo 'Unit Not Inserted';
		}
	}
	
	if($_POST["operation"] == "Edit")
	{
		
		$statement = $connection->prepare(
			"UPDATE unit 
			SET unitname = :unit_name, remarks = :remark, flag = :active
			WHERE unit_id = :id
			"
		);
		$result = $statement->execute(
			array(
				':unit_name'	=>	$_POST["unitname"],
				':remark'		=>	$_POST["remarks"],
				':active'	    =>	$_POST["active"],
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Unit Updated';
		}
		else{
			echo 'Unit Not Updated';
		}
	}
}

?>