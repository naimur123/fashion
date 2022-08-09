<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		// $image = '';
		// if($_FILES["user_image"]["name"] != '')
		// {
		// 	$image = upload_image();
		// }
		// else
		// {
		// 	echo 'Data image';
		// }
		
		$statement = $connection->prepare("INSERT INTO gift_card (card_number, card_details, card_validity_from, card_validity_to, card_amount, status, remarks, create_by, create_date	
		) VALUES (:card_number, :card_details, :card_validity_from, :card_validity_to, :card_amount, :active, :remarks, '1', Now())");
		$result = $statement->execute(
			array(
				':card_number'	=>	$_POST["card_number"],
				':card_details'	=>	$_POST["card_details"],
				':card_amount'	=>	$_POST["card_amount"],
				':card_validity_from'	=>	$_POST["card_validity_from"],
				':card_validity_to'	=>	$_POST["card_validity_to"],
				':remarks'	=>	$_POST["remarks"],
				':active'	=>	$_POST["active"],
			)
		);
		
		if(!empty($result))
		{
			echo 'Gift Card Item Inserted';
		}
		else
		{
			echo 'Gift Card Item Not  Inserted';
		}
	}
	
	
	if($_POST["operation"] == "Edit")
	{
		
		$statement = $connection->prepare(
			"UPDATE gift_card 
			SET  card_number =:card_number, card_details =:card_details, card_validity_from =:card_validity_from, card_validity_to =:card_validity_to, card_amount =:card_amount, status =:active, remarks =:remarks, modified_by='1', modified_date=Now()
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':card_number'	=>	$_POST["card_number"],
				':card_details'	=>	$_POST["card_details"],
				':card_amount'	=>	$_POST["card_amount"],
				':card_validity_from'	=>	$_POST["card_validity_from"],
				':card_validity_to'	=>	$_POST["card_validity_to"],
				':remarks'	=>	$_POST["remarks"],
				':active'	=>	$_POST["active"],
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Gift Card Item Updated';
		}
		else{
			echo 'Gift Card Item Updated';
		}
	}
}

?>