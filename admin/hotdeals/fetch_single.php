<?php
include('db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM products WHERE id = '".$_POST["user_id"]."' LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["item_name"] = $row["products_name"];
		$output["company_name"] = $row["company_name"];
		$output["scatname"] = $row["products_category"];
		$output["subcatname"] = $row["prdsubcategory"];
		$output["slquantity"] = $row["quantity"];
		$output["item_price"] = $row["price"];
		$output["active"] = $row["status"];
		$output["offitem"] = $row["hot_deals"];
		$output["offpercent"] = $row["hotdeal_percent"];
		$output["offprice"] = $row["hotdeal_price"];
		
		if($row["name"] != '')
		{
			$output['user_image'] = '<img src="../items/upload/'.$row["name"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["name"].'" />';
		}
		else
		{
			$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}
		
		$output["itemname"] = $row["products_name"];
		
		
	}
	echo json_encode($output);
}
?>