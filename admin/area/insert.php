<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		
		$statement = $connection->prepare("
			INSERT INTO customer_area ( area_name, insideoroutside, remarks, area_flag, create_by, create_date) VALUES ( :coupocode, :coupoamt, :remark, :active, '1', Now())
		");
		$result = $statement->execute(
			array(
				':coupocode'	=>	$_POST["areaname"],
				':coupoamt'		=>	$_POST["areaflag"],
				':remark'		=>	$_POST["remarks"],
				':active'	    =>	$_POST["active"]
			)
		);
		if(!empty($result))
		{
			echo 'Customer Area Inserted';
		}
		else{
			echo 'Customer Area Not Inserted';
		}
	}
	
	if($_POST["operation"] == "Edit")
	{
		
		$statement = $connection->prepare(
			"UPDATE customer_area 
			SET area_name=:coupocode, insideoroutside=:coupoamt, remarks = :remark, area_flag = :active
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':coupocode'	=>	$_POST["areaname"],
				':coupoamt'		=>	$_POST["areaflag"],
				':remark'		=>	$_POST["remarks"],
				':active'	    =>	$_POST["active"],
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Customer Area Updated';
		}
		else{
			echo 'Customer Area Not Updated';
		}
	}
}
?>