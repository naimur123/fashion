<?php
	if( ! ini_get('date.timezone') )
    {
        date_default_timezone_set('GMT');
    }
include ('include/config/dbConfig.php');
// initializ shopping cart class
include 'Cart.php';
$cart = new Cart;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include ("header.php");  ?>

   
	<script type="text/javascript">
    function updateCartItem(obj,id){
        $.get("cartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
            if(data == 'ok'){
                location.reload();
            }else{
                alert('Cart update failed, please try again.');
            }
        });
    }
    </script>
	
	<script type="text/javascript">
		function validateForm() {
    var coupon = document.forms["myformcoupon"]["txtcoupon"].value;
   	
    if (coupon == "") {
        alert("Please insert your coupon code");
        return false;
    }
}
</script>
<style>
	.table{
		border: 5px solid #F1CF98 !important;
		height: 30%;
		background-color: #f7f0df;
	}
	/* .btn-block{
			background-color: #F1CF98;
			color: black;
			font-weight: bold;
			padding: 8px 10px 10px 13px;
			width: 32%;
			margin-left: 10em;
			border-radius: 50px;
	} */
	.btn{
		background-color: #F1CF98;
		
	}
</style>
		

</head>




<body>



<div class="container" align="center">
		
			<div class="row">
			
			<div class="col-md-8" style="margin-left: -50px;">
						
				<table class="table">
					<thead  style="background-color: white">
						<tr>
							<th>Product</th>
							<th>Name</th>
							<th>Price(TK)</th>
							<th>Unit</th>
							<th>Quantity</th>
							<th>Subtotal(TK)</th>
							<th></th>
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
            <td><img src="admin/items/upload/<?php echo $item['name']; ?>"  class="img-responsive " style="pointer-events: none; width:130px; height: 150px"/></td>
			<td><?php echo $item["prdname"]; ?></td>
            <td><?php echo $item["price"]; ?></td>
			<td><?php echo $item["unit"]; ?></td>
            <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
            <td><?php echo $item["subtotal"]; ?></td>
            <td>
                <!--<a href="cartAction.php?action=updateCartItem&id=" class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i></a>-->
                <a  href="cartAction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?> " onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-trash" style="margin-top:13em;margin-left: -2em; color:#706f6d"></i></a>
            </td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="6"><p>Your cart is empty.....</p></td>
        <?php } ?>		
    </tbody>
	
    </table>
	           <div class="col-md-6" style="margin-left: 34em;">
					
					<a href="index.php" <?php  unset($_SESSION['couponPrice']); ?> class="btn" style="text-decoration:none; color:black;"><i class="glyphicon glyphicon-menu-left"></i><b> Continue Shopping <b></a>
				
				</div>
		</div>
						
			</div>
			
		</div>	
			
			<div class="row">
					
					<!-- <div class="col-md-4"> -->
					
				
						<!-- <div class="form-group">
						
							<b>Discount Code</b> 
							<form method="post">
							<input type="text" name="couponCode" placeholder="Coupon Code" style="height:35px;">
							<button type="submit" name="ApplyCouponeCode" class="btn btn-info" style="border-radius:none;height:35px;">Apply</button>
							</form>
						
						</div>	
						 -->
						
						
					<!-- </div> -->
					<?php
					if($cart->total_items() > 0){
					?>
				<div class="col-md-4" style="margin-left: 61em; margin-top: -20.5em;">
								<!-- cupon  code -->
						<?php
								if(!isset($_SESSION['couponPrice'])){
									$_SESSION['couponPrice'] = 0;
								}
								
								$couponValue = 0;
								if( isset($_POST['ApplyCouponeCode']))
								{
									$code = $_POST['couponCode'];
									$st = "SELECT * FROM coupon_apply WHERE coupon_code ='$code' And coupon_flag = 1";
									$result = $db->query($st);
									if(mysqli_num_rows($result)>0)
									{
									while($cval = mysqli_fetch_assoc($result)){
										$couponValue = $cval['coupon_amount'];
										$_SESSION['couponPrice'] = $couponValue;
									}
									}
									
								}
								
							?>
									
					<table class="table">
						<thead style="background-color: white">
						<tr style="box-shadow: 2px 2px #d4d1cb !important;">
						
						 <td style="padding:10px" ><b style="font-family:'Roboto'">SUMMARY &nbsp; &nbsp;</b></td>
						 <td >
						 </td>
						
						
						</tr>
						</thead>
						<tr>
							<td>
								<b>Discount Code </b>
							</td>
							<td>
							<form method="post">
							<input type="text" name="couponCode" placeholder="Coupon Code" style="margin-left: -157px; width: 130px;">
							<span><button type="submit" name="ApplyCouponeCode">Apply</button></span>
							</form>
							</td>
						</tr>
							<tr>
								
								<td><b>Sub Total</b></td>
								<td name="subtotal"><?php if($cart->total_items() > 0){ ?>
										<?php echo $cart->total(); ?>						
										<?php } ?>
								</td>
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
								<td><?php echo $value ?></td>
							</tr>
							</tr>
							<?php if($_SESSION['couponPrice']>0){ ?>
							<tr>
							    <th>Discount</th>
								<?php $free = $_SESSION['couponPrice']; ?>
							    <td> <?php echo $free  ?>Tk. </td>
								<?php $_SESSION['free'] = $free; ?>
							</tr>
							<?php } ?>
							
							<tr>
							
							<tr>
								<td><b>Total</b></td>
								
								<td name="total"><?php if($cart->total_items() > 0){ ?>
									    <?php if($_SESSION['couponPrice']>0){
										   $to = $cart->total(); if($value)
										   {
											   echo  $_SESSION['total'] = $to+$value-$free;
											}
										  
											
										}
										else{
											$to = $cart->total(); if($value){echo  $_SESSION['total'] = $to+$value;}
											
										}?>
										
										<?php } ?>
								</td>
							</tr>
								
							<tr>
								<td><a href="checkout.php" class="btn-block" style="text-decoration:none;color:black;background-color: #F1CF98;font-weight: bold;padding: 8px 10px 10px 13px;width: 35%;margin-left: 10em;border-radius: 50px;">Checkout <i class="glyphicon glyphicon-menu-right"></i></a></td>
							</tr>
					
					</table>
					
					
				</div> <?php } ?>

				
				
			</div>
			
			<div class="row">
				
				<div class="col-md-1">
								
				</div>
				
				
				
				<div class="col-md-2">
				
				</div>
				
				<!-- <div class="col-md-2">
					
					<a href="checkout.php" class="btn btn-success btn-block">Checkout <i class="glyphicon glyphicon-menu-right"></i></a>
				
				</div> -->
				
				<div class="col-md-1">
									
				</div>
				
			</div>
			
		</div>


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