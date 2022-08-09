<?php
// initialize shopping cart class
include 'Cart.php';
$cart = new Cart;
// include database configuration file
include ('include/config/dbConfig.php');
$productID = $_POST['id'];
$qty = $_POST['qty'];
$query = $db->query("SELECT * FROM products WHERE id = ".$productID);
        $row = $query->fetch_assoc();
		
		
		$current_price = $row['price'];
		
		 
		if($row['offer_item'])
		{
			$current_price = $row["offer_price"];
		}
		
		if($row['hot_deals'])
		{
			$current_price = $row["hotdeal_price"];
		}
		if($row['today_special'])
		{
			$current_price = $row["today_special_price"];
		}
		
        $itemData = array(
            'id' => $row['id'],
            'name' => $row['name'],
			'prdname' => $row['products_name'],
            'price' => $current_price,
			'unit' => $row['quantity'],
            'qty' => $qty,
        );
        
        $insertItem = $cart->insert($itemData);
		$cart->remove(999999);
		
				$cartItems = $cart->contents();
				$prvId = null;
				$count = 0;
				$totat_cart_items = 0;
				foreach($cartItems as $item)
				{	
					if($prvId != $item["id"])
					{
						if($item["id"] != 999999){
							$count++;
							$prvId = $item["id"];
						}
					}
					$totat_cart_items += $item["qty"]; 
				}
				
				echo $count;
			
				
?>

