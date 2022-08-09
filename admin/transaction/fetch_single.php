<?php
include('db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM gift_card WHERE id = '".$_POST["user_id"]."' LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["card_number"] = $row["card_number"];
		$output["card_details"] = $row["card_details"];
		$output["card_validity_from"] = $row["card_validity_from"];
		$output["card_validity_to"] = $row["card_validity_to"];
		$output["card_amount"] = $row["card_amount"];
		$output["status"] = $row["status"];
		$output["remarks"] = $row["remarks"];
		$output["create_by"] = $row["create_by"];
		$output["create_date"] = $row["create_date"];
		$output["modified_by"] = $row["modified_by"];
		$output["modified_date"] = $row["modified_date"];
		
		// if($row["name"] != '')
		// {
		// 	$output['user_image'] = '<img src="../items/upload/'.$row["name"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["name"].'" />';
		// }
		// else
		// {
		// 	$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
		// }
		
		// $output["itemname"] = $row["products_name"];
		
		
	}
	echo json_encode($output);
}
?>