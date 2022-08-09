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
		
		$statement = $connection->prepare("INSERT INTO home_image_slideshow (slideshow_active, image_name, create_id, create_date ) VALUES (:active, :image, '1', Now())");
		$result = $statement->execute(
			array(
				':active'	=>	$_POST["active"],
				':image'	=>	$image
			)
		);
		
		if(!empty($result))
		{
			echo 'Slideshow Image Inserted';
		}
		else
		{
			echo 'Slideshow Image Not  Inserted';
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
			"UPDATE home_image_slideshow 
			SET image_name = :image, slideshow_active = :active, create_id='1', create_date=Now()
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':active'	=>	$_POST["active"],
				':image'	=>	$image,
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Slideshow Image Updated';
		}
		else{
			echo 'Slideshow Image Not Updated';
		}
	}
}

?>