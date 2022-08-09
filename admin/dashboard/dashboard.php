<?php
	if( ! ini_get('date.timezone') )
    {
        date_default_timezone_set('GMT');
    }
	if(!isset($_SESSION)) 
	{ 
		session_start(); 
	} 
	if(isset($_SESSION['signed_in']))
	{
		include('../header.php');
	} else
	{
		header("Location:../login.php");
	}
?>



<!DOCTYPE html>
<html lang="en">
<head>


	<style>
		.pvi{
			display: inline;
			font-family:Courier;
			
			color: #36332F;
			font-size:22px;
			font-weight:bold;
		}
	
	</style>
</head>


<body>

<div class="container">
	
	<div class="row">
	
	<div class="col-md-12">
		
		<div class="row" >
			
			<div class="col-md-4" >
				<a href="../PendingOrders/pendingorders.php"><div style="border: 2px solid #D0D3D4" align="center">
					<div class="row">
						<div class="col-md-12" align="center" style="padding:40px;"><p class="pvi">Pending Orders</p></div>
						
					</div>	
				</div></a>	
			</div>
			
			<div class="col-md-4">
				<a href="../shipping_order/shippingorders.php"><div style="border: 2px solid #D0D3D4" align="center">
					<div class="row">
						<div class="col-md-12" align="center" style="padding:40px;"><p class="pvi">Shipping Orders</p></div>
					</div>	
				</div></a>	
			</div>
			
			<div class="col-md-4" style="background-color: blue;">
				<a href="../customer/customer.php"><div style="border: 2px solid #D0D3D4" align="center">
					<div class="row">
						<div class="col-md-12" align="center" style="padding:40px;"><p class="pvi">Customer Information</p></div>
					</div>	
				</div></a>	
			</div>
		
		</div>
		
		<br/>
		
	
	</div>
	
</div>

</body>
</html>
