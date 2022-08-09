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
		
		$statement = $connection->prepare("INSERT INTO products (products_name, company_name, products_category, prdsubcategory, quantity, price, description, status, offer_item, offer_price, offer_percentage, name, create_id, created, modified ) VALUES (:itemname, :comname, :catname, :subcat, :qty, :itmprice, :itmdesc, :active, :offeritem, :offerprice, :offerpercent, :image, '1', Now(), Now())");
		$result = $statement->execute(
			array(
				':itemname'	=>	$_POST["item_name"],
				':itmprice'	=>	$_POST["item_price"],
				':comname'	=>	$_POST["company_name"],
				':catname'	=>	$_POST["scatname"],
				':subcat'	=>	$_POST["subcatname"],
				':qty'	    =>	$_POST["slquantity"],
				':itmdesc'	=>	$_POST["itemdesc"],
				':active'	=>	$_POST["active"],
				
				':offeritem'	=>	$_POST["offitem"],
				':offerprice'	=>	$_POST["offprice"],
				':offerpercent'	=>	$_POST["offpercent"],
				
				':image'	=>	$image
			)
		);
		
		if(!empty($result))
		{
			echo 'Offer Item Inserted';
		}
		else
		{
			echo 'Offer Item Not  Inserted';
		}
	}
	
	
	if($_POST["operation"] == "Edit")
	{
		
		$statement = $connection->prepare(
			"UPDATE products 
			SET  offer_item = :offeritem, offer_percentage = :offerperc, offer_price = :offerprice, create_id='1', modified=Now()
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':offeritem' =>	$_POST["offitem"],
				':offerperc' =>	$_POST["offpercent"],
				':offerprice' => $_POST["offprice"],	
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Offer Item Updated';
		}
		else{
			echo 'Offer Item Not Updated';
		}
	}
}

?>