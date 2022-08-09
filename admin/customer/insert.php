<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		
		$statement = $connection->prepare("
			INSERT INTO customer_registration (full_name, email, phone, address, customer_area, conf_pass, flag, create_date) 
			VALUES (:fullname, :email,:phone, :address, :area,:confpass, :active,  Now())
		");
		$result = $statement->execute(
			array(
				':fullname'	=>	$_POST["fullname"],
				':email'	=>	$_POST["cusemail"],
				':phone'	=>	$_POST["cusphone"],
				':address'	=>	$_POST["address"],
				':area'	    =>	$_POST["cusarea"],
				':confpass'	=>	$_POST["cuspass"],
				':active'	=>	$_POST["active"]
			)
		);
		if(!empty($result))
		{
			echo 'Customer Inserted';
		}
		else{
			echo 'Customer Not Inserted';
		}
	}
	
	if($_POST["operation"] == "Edit")
	{
		
		$statement = $connection->prepare(
			"UPDATE customer_registration 
			SET full_name=:fullname, email = :email, phone=:phone, address=:address, customer_area = :area, flag = :active
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':fullname'	=>	$_POST["fullname"],
				':email'	=>	$_POST["cusemail"],
				':phone'		=>	$_POST["cusphone"],
				':address'		=>	$_POST["address"],
				':area'		=>	$_POST["cusarea"],
				':active'	    =>	$_POST["active"],
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Customer Updated';
		}
		else{
			echo 'Customer Not Updated';
		}
	}
}

?>