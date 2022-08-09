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
			// $image = $_FILES["user_image"]["name"];
			$image = upload_image();
			// $target_dir = "/include/images/";
			// $target_file = $target_dir . basename($_FILES["user_image"]["name"]);
			// $image = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		}
		else
		{
			echo 'Data image';
		}
		
		$statement = $connection->prepare("
			INSERT INTO category (cat_name, name, remarks, flag, create_id, create_date) 
			VALUES (:catname, :image, :remark, :active, '1', Now())
		");
		$result = $statement->execute(
			array(
				':catname'	=>	$_POST["cat_name"],
				':image'	=>	$image,
				':remark'	=>	$_POST["remarks"],
				':active'	=>	$_POST["active"]
			)
		);
		if(!empty($result))
		{
			echo 'Category Inserted';
		}
		else{
			echo 'Category Not Inserted';
		}
	}
	
	if($_POST["operation"] == "Edit")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			// $image = $_FILES["user_image"]["name"];
			$image = upload_image();
		}
		else
		{
			$image = $_POST["hidden_user_image"];
		}
		$statement = $connection->prepare(
			"UPDATE category 
			SET cat_name = :catname, name= :image, remarks = :remark, flag = :active
			WHERE cat_id = :id
			"
		);
		$result = $statement->execute(
			array(
				':catname'	=>	$_POST["cat_name"],
				':image'	=>	$image,
				':remark'		=>	$_POST["remarks"],
				':active'	    =>	$_POST["active"],
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Category Updated';
		}
		else{
			echo 'Category Not Updated';
		}
	}
}

?>