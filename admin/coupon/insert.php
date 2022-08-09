<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		
		$statement = $connection->prepare("
			INSERT INTO coupon_apply ( coupon_code, coupon_amount, remarks, coupon_flag, create_by, create_date) VALUES ( :coupocode, :coupoamt, :remark, :active, '1', Now())
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
			echo 'Apply Coupon Inserted';
		}
		else{
			echo 'Apply Coupon Not Inserted';
		}
	}
	
	if($_POST["operation"] == "Edit")
	{
		
		$statement = $connection->prepare(
			"UPDATE coupon_apply 
			SET coupon_code=:coupocode, coupon_amount=:coupoamt, remarks = :remark, coupon_flag = :active
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
			echo 'Apply Coupon Updated';
		}
		else{
			echo 'Apply Coupon Not Updated';
		}
	}
}
?>