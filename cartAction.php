<?php
// initialize shopping cart class
include 'Cart.php';
$cart = new Cart;

// include database configuration file
include ('include/config/dbConfig.php');

if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id']) && !empty($_REQUEST['pageurl'])){
		$pagelink = $_REQUEST['pageurl'];
        $productID = $_REQUEST['id'];
        // get product details
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
		
        $itemData = array(
            'id' => $row['id'],
            'name' => $row['name'],
			'prdname' => $row['products_name'],
            'price' => $current_price,
			'unit' => $row['quantity'],
            'qty' => 1
        );
        
        $insertItem = $cart->insert($itemData);
        //$redirectLoc = $insertItem?'$pagelink':'index.php';
		
		
		
        header("Location: ".$pagelink);
    }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
        $itemData = array(
            'rowid' => $_REQUEST['id'],
            'qty' => $_REQUEST['qty']
        );
        $updateItem = $cart->update($itemData);
        echo $updateItem?'ok':'err';die;
    }elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){
        $deleteItem = $cart->remove($_REQUEST['id']);
        header("Location: viewCart.php");
    }elseif($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['userid'])){
        // insert order details into database
		
		$con = mysqli_connect("localhost", "guidelin_kazifashoin_house_website", "Total@1010", "guidelin_kazifashion_house");
		$res = mysqli_query($con, "SELECT shippingcost FROM shipping_fee WHERE active='1'");
		$row = mysqli_fetch_assoc($res);
		$value = $row["shippingcost"];
        $total_price =  $_SESSION['total'];
        $discount = $_SESSION['couponPrice'];
		$txtaddcomment = $_GET['txtaddcomment'];

		
		
        $insertOrder = $db->query("INSERT INTO orders (customer_id, total_price, sub_total_price, shipping_cost, discount_amount , status, created,additional_comment) VALUES ('".$_SESSION['userid']."', '$total_price','".$cart->total()."', '".$value."','$discount', '1', Now(),'".$txtaddcomment."')");
        
        if($insertOrder){
            $orderID = $db->insert_id;
            $sql = '';
            // get cart items
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
                $sql .= "INSERT INTO order_items (order_id, product_id, product_price, quantity) VALUES ('".$orderID."', '".$item['id']."', '".$item['price']."', '".$item['qty']."');";
            }
            // insert order items into database
            $insertOrderItems = $db->multi_query($sql);
            
            if($insertOrderItems){
                $cart->destroy();
                header("Location: orderSuccess.php?id=$orderID");
            }else{
                header("Location: checkout.php");
            }
        }else{
            header("Location: checkout.php");
        }
    }else{
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
}