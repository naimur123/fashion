<?php
include('db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM home_image_slideshow WHERE id = '".$_POST["user_id"]."' LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["active"] = $row["slideshow_active"];
		
		if($row["image_name"] != '')
		{
			$output['user_image'] = '<img src="slideshow/'.$row["image_name"].'" class="img-thumbnail" width="200" height="100" /><input type="hidden" name="hidden_user_image" value="'.$row["image_name"].'" />';
		}
		else
		{
			$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}
	}
	echo json_encode($output);
}
?>