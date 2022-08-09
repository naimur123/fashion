<?php
	if( ! ini_get('date.timezone') )
    {
        date_default_timezone_set('GMT');
    }
// include database configuration file
include ('include/config/dbConfig.php');

// initializ shopping cart class
include 'Cart.php';
$cart = new Cart;

// redirect to home if cart is empty
if($cart->total_items() <= 0){
    header("Location: index.php");
}

if(!isset($_SESSION['full_name']) || empty($_SESSION['full_name'])){
  header("location: login.php");
  exit;
}

else{

//$_SESSION['additioncomment'] = $_POST['txtaddcomment'];
// set customer ID in session
$sessionvalue=$_SESSION['userid'] ;
//$emailvalue = 'nirjhor.aiub@gmail.com';

//require_once 'dbConfig.php';
// get customer details by session customer ID
$query = $db->query("SELECT * FROM customer_registration WHERE id = '$sessionvalue'");
$custRow = $query->fetch_assoc();

}

?>



<!DOCTYPE html>
<html lang="en">
<head>

<script type="text/javascript">
		function validateForm() {
    var coupon = document.forms["myformcoupon"]["txtcoupon"].value;
   	
    if (coupon == "") {
        alert("Please insert your coupon code");
        return false;
    }
}
</script>
    
</head>



<body>

	<?php include ("header.php"); ?>


<div class="container-fluid">
	
	<div class="row"> 
		
	</div>
	
	<div class="row">
	
		<div class="col-md-1">
		
		</div>
		
		<div class="col-md-3">			
			
			<div class="row">
				<div class="panel">
				
				<div class="panel-header">
					
					<div class="col-md-12" align="center" style="background-color:#3964B9">
						<h4 class="h4" style="color:#fff">SHIPPING DETAILS</h4>
					</div>
					
				</div>
				
				<div class="panel-body">
			    	 <p><b>Full Name: </b><?php echo $custRow['full_name']; ?></p>
					 <p><b>Email: </b><?php echo $custRow['email']; ?></p>
					 <p><b>Phone: </b><?php echo $custRow['phone']; ?></p>
					 <p><b>Address: </b><?php echo $custRow['address']; ?></p>	
				</div>
				
				</div>
			</div>

		</div>
		
		<div class="col-md-7">			
			
			<div class="panel">
			
			<div class="panel-header">	
					<div class="col-md-12" align="center" style="background-color:#3964B9">
						<h4 class="h4" style="color:#fff">ORDER DETAILS</h4>
					</div>
				</div>
								
			<div class="panel-body">
				<table class="table table-striped table-hover table-bordered">
			
			<thead>
			<tr>
				<th width="300px">Product Name</th>
				<th width="150px">Price(TK)</th>
				<th width="150px">Unit</th>
				<th width="150px">Quantity</th>
				<th width="150px">Subtotal(TK)</th>
			</tr>
			</thead>
			
			<tbody>
        <?php
        if($cart->total_items() > 0){
            //get cart items from session
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
        ?>
        <tr>
            <td><?php echo $item["prdname"]; ?></td>
            <td><?php echo $item["price"]; ?></td>
			<td><?php echo $item["unit"]; ?></td>
            <td><?php echo $item["qty"]; ?></td>
            <td><?php echo $item["subtotal"]; ?></td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="4"><p>No items in your cart......</p></td>
        <?php } ?>
    </tbody>
	
	
    
    </table>
			
		</div>
			
			</div>
			</div>
			
			</div>
		
		<div class="col-md-1">
		
		</div>
		
	</div>
	
	<div class="row">
        
        <div class="col-md-2">
		
		</div>
		
		<!-- <div class="col-md-10">
			<div class="form-group">
					
				<b>Additional Comment </b> <textarea name="txtaddcomment" id="txtaddcomment" placeholder="If you have any instruction please tell us"></textarea>
					
			</div>			
		</div> -->

	    
	</div>
				
	<div class="row">
				<div class="col-md-2">
					
				</div>
				
				<div class="col-md-4">
				
					<!-- cupon  code -->
					<?php
							// if(!isset($_SESSION['couponPrice'])){
							// 	$_SESSION['couponPrice'] = 0;
							// }
							
							// $couponValue = 0;
							// if( isset($_POST['ApplyCouponeCode']))
							// {
							// 	$code = $_POST['couponCode'];
							// 	$st = "SELECT * FROM coupon_apply WHERE coupon_code ='$code' And coupon_flag = 1";
							// 	$result = $db->query($st);
							// 	if(mysqli_num_rows($result)>0)
							// 	{
							// 	while($cval = mysqli_fetch_assoc($result)){
							// 		$couponValue = $cval['coupon_amount'];
							// 		$_SESSION['couponPrice'] = $couponValue;
							// 	}
							// 	}
								
							// }
							
						?>
					
					<!-- <div class="form-group">
					
						<b>Discount Code</b> 
						<form method="post">
			            <input type="text" name="couponCode" placeholder="Coupon Code" style="height:35px;">
			            <button type="submit" name="ApplyCouponeCode" class="btn btn-info" style="border-radious:none;height:35px;">Apply</button>
			            </form>
					
					</div>	 -->
					
					
					
				</div>
				
				<div class="col-md-3">
										
					<table class="table table-striped table-hover table-bordered">
						
						<tbody>
							
							<tr>
								<td><b>Sub Total</b></td>
								<td name="subtotal"><?php if($cart->total_items() > 0){ ?>
										<?php echo $cart->total(); ?>						
										<?php } ?>
								</td>
							</tr>
							<tr>
                            <?php if($_SESSION['free']){ ?>
							<tr>
							    <th>Discount</th>
							    <td> <?php echo $_SESSION['free']  ?>Tk. </td>
							</tr>
							<?php } ?>
							</tr>
							<tr>
								<td><b>Shipping Charge</b></td>
								<?php
								//$con = mysqli_connect("localhost", "root", "", "totalbazarbd");
								$con = mysqli_connect("localhost", "guidelin_kazifashoin_house_website", "Total@1010", "guidelin_kazifashion_house");
								$res = mysqli_query($con, "SELECT shippingcost FROM shipping_fee WHERE active='1'");
								$row = mysqli_fetch_assoc($res);
								$value = $row["shippingcost"];
								?>
								<td><?php echo $value . ' TK (Inside Dhaka)' ?></td>
							</tr>
							
							<tr>
								<td><b>Total</b></td>
								
								<td name="total"><?php if($_SESSION['total']){?>
									    <?php 
										echo $_SESSION['total'];
					
										 } ?>
								</td>
							</tr>
								
							
						</thead>
					
					</table>
					
				</div>

				<div class="col-md-3">
						
				
				</div>
				

			
						
	</div>
	
	
	
	<div class="row">
				
				<div class="col-md-3">
								
				</div>
				
				<div class="col-md-3">
					
					<a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Shopping</a>
				
				</div>
				
				
				<div class="col-md-3" align="right">
					
					<button type="button" class="btn btn-success" name="placeOrder" id="placeOrder">Place Order </button>
				
				</div>
				
				<div class="col-md-3">
									
				</div>
				
			</div>
	
	
</div>

<script>
    $(document).ready(function(){
        $('#placeOrder').click(function(){
            var x = $('#txtaddcomment').val();
            window.location.href="cartAction.php?action=placeOrder&txtaddcomment="+x;
        });
        
    });
</script>


<br/>

<br/>

<br/>
<br/>

<br/>


<div class="container-fluid">


</div>

<br/>

<br/>

<br/>
<br/>

<br/>
<br/>

<br/>


<?php include('footer.php');?>