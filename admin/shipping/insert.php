<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		
		$statement = $connection->prepare("
			INSERT INTO shipping_fee ( shippingcost, outsidedhaka, remarks, active, create_by, create_date,insideFreeAfter,outsideFreeAfter) VALUES ( :coupocode, :coupoamt, :remark, :active, '1', Now(),:insideFreeAfter,:outsideFreeAfter)
		");
		$result = $statement->execute(
			array(
				':coupocode'	=>	$_POST["coupcode"],
				':coupoamt'		=>	$_POST["coupamt"],
				':remark'		=>	$_POST["remarks"],
				':active'	    =>	$_POST["active"],
				':insideFreeAfter' => $_POST["insideFreeAfter"],
				':outsideFreeAfter'	=> $_POST["outsideFreeAfter"]
			)
		);
		if(!empty($result))
		{
			echo 'Shipping Fee Inserted';
		}
		else{
			echo 'Shipping Fee Not Inserted';
		}
	}
	
	if($_POST["operation"] == "Edit")
	{
		
		$statement = $connection->prepare(
			"UPDATE shipping_fee 
			SET shippingcost=:coupocode, outsidedhaka=:coupoamt, remarks = :remark, active = :active,insideFreeAfter = :insideFreeAfter,outsideFreeAfter = :outsideFreeAfter
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':coupocode'	=>	$_POST["coupcode"],
				':coupoamt'		=>	$_POST["coupamt"],
				':remark'		=>	$_POST["remarks"],
				':active'	    =>	$_POST["active"],
				':id'			=>	$_POST["user_id"],
				':insideFreeAfter' => $_POST["insideFreeAfter"],
				':outsideFreeAfter'	=> $_POST["outsideFreeAfter"]
			)
		);
		if(!empty($result))
		{
			echo 'Shipping Fee Updated';
		}
		else{
			echo 'Shipping Fee Not Updated';
		}
	}
}
?>