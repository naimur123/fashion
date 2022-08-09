<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		
		$statement = $connection->prepare("
			INSERT INTO orders ( total_price, delivery_man, admin_message, status, created) VALUES ( :coupocode, :coupoamt, :remark, :active,  Now())
		");
		$result = $statement->execute(
			array(
				':coupocode'	=>	$_POST["delv_man"],
				':coupoamt'		=>	$_POST["total_amt"],
				':remark'		=>	$_POST["admin_text"],
				':active'	    =>	$_POST["active"]
			)
		);
		if(!empty($result))
		{
			echo 'Order Inserted';
		}
		else{
			echo 'Order Not Inserted';
		}
	}
	
	if($_POST["operation"] == "Edit")
	{
		
		$statement = $connection->prepare(
			"UPDATE orders 
			SET total_price=:ttlprice, sub_total_price=:subtlprice, shipping_cost = :shippingcost, discount_amount = :discamt, status =:sts,  delivery_man=:delv_man, admin_message= :adm_msg, modified=Now()
			WHERE id = :id"
		);
		$result = $statement->execute(
			array(
				':ttlprice'			=>	$_POST["total_amt"],
				':subtlprice'		=>	$_POST["subtotal_amt"],
				':shippingcost'		=>	$_POST["shipping_amt"],
				':discamt'	    	=>	$_POST["discount_amt"],
				':sts'				=>	$_POST["active"],
				':delv_man'			=>	$_POST["delv_man"],
				':adm_msg'			=>	$_POST["admin_text"],
				':id'				=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Orders Information Updated';
		}
		else{
			echo 'Orders Information Not Updated';
		}
	}
}
?>