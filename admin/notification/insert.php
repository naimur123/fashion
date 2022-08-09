<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		else
		{
			echo 'Data image';
		}
		
		$statement = $connection->prepare("INSERT INTO notification (notification_text, image_name, remarks, active, create_id, create_date ) VALUES ( :coupcode ,:image, :remark ,:active, '1', Now())");
		
		$result = $statement->execute(
			array(
				':coupcode'	=>	$_POST["coupcode"],
				':remark'		=>	$_POST["remarks"],
				':active'	=>	$_POST["active"],
				':image'	=>	$image
			)
		);
		
		if(!empty($result))
		{
			echo 'Notification is Inserted';
		}
		else
		{
			echo 'Notification is Not  Inserted';
		}
	}
	
	if($_POST["operation"] == "Edit")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		else
		{
			$image = $_POST["hidden_user_image"];
		}
		$statement = $connection->prepare(
			"UPDATE notification 
			SET image_name = :image, active = :active, notification_text=:coupocode,remarks=:remark, create_id='1', create_date=Now()
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':active'	=>	$_POST["active"],
				':image'	=>	$image,
				':coupocode'	=>	$_POST["coupcode"],
				':remark'		=>	$_POST["remarks"],
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Notification is Updated';
		}
		else{
			echo 'Notification is Not Updated';
		}
	}
}

?>