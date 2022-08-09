<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		
		$statement = $connection->prepare("
			INSERT INTO subcategory (sub_catname, cat_name, remarks, flag, create_id, create_date) 
			VALUES (:subcatname, :catname, :remark, :active, '1', Now())
		");
		$result = $statement->execute(
			array(
				':subcatname'	=>	$_POST["subcat_name"],
				':catname'	=>	$_POST["scatname"],
				':remark'	=>	$_POST["remarks"],
				':active'	=>	$_POST["active"]
			)
		);
		if(!empty($result))
		{
			echo 'Sub Category Inserted';
		}
		else{
			echo 'Sub Category Not Inserted';
		}
	}
	
	if($_POST["operation"] == "Edit")
	{
		
		$statement = $connection->prepare(
			"UPDATE subcategory 
			SET sub_catname=:subcatname, cat_name = :catname, remarks = :remark, flag = :active
			WHERE sub_id = :id
			"
		);
		$result = $statement->execute(
			array(
				':subcatname'	=>	$_POST["subcat_name"],
				':catname'	=>	$_POST["scatname"],
				':remark'		=>	$_POST["remarks"],
				':active'	    =>	$_POST["active"],
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Sub Category Updated';
		}
		else{
			echo 'Sub Category Not Updated';
		}
	}
}

?>