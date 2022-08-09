<?php
	if( ! ini_get('date.timezone') )
    {
        date_default_timezone_set('GMT');
    }
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Kazi Fashion Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="../include/css/menunavbar.css" />
	
	<style type="text/css">
  /* Note: Try to remove the following lines to see the effect of CSS positioning */
  .affix {
      top: 0;
      width: 100%;
      /* z-index: 9999 !important; */
  }

  .affix + .container-fluid {
      padding-top: 70px;
  }
  </style>
</head>

<body id="page-top" name="page-top" class="active" >

<br/>

<div class="container-fluid" style="height:70px;padding:0px" !important>
	
	<div class="row">

	<div class="col-sm-12" align="center">  
		
		<?php
					
					 if(!isset($_SESSION)) 
					{ 
						session_start(); 
					} 

					 if(isset($_SESSION['email_name_total'])) {
					 ?>
					   							
					 <p class="pv" style="color:#2E89EA;font-weight: bold" height="40px"><?php echo htmlspecialchars($_SESSION['email_name_total']); ?></p>&nbsp;&nbsp;
					<p style="color:#F0580C;font-weight: bold" hidden><?php echo htmlspecialchars($_SESSION['userid_total']); ?></p>
					
					 <?php

					 } else {
					   ?>
					   
							<button type="button" class="btn btn-outline-default"><p class="pv"><a href="login.php" style="text-decoration:none" height="40px"><span class="glyphicon glyphicon-user"></span>&nbsp;<b>Sign In </b></a></button></p>&nbsp;&nbsp;
					   <?php
					 }
		?>
	
  </div>
  
</div>

<nav class="navbar navbar-default navbar-custom" data-spy="affix" data-offset-top="197" style="width:100%">   
            
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" >
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>                        
					</button>
					<a class="navbar-brand" href="../index.php"><img src="../include/Home-button.png" height="30px" alt="Home"></a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav "> 
							<li>
                				<a href="../dashboard/dashboard.php" style="color: #ffffff;">Dashboard</a>							
                			</li>
							
							<li>
                				<a href="../customer/customer.php" style="color: #ffffff;">Customer</a>							
                			</li>
							
							<li>
                				<a href="../orders/orders.php" style="color: #ffffff;">Orders</a>							
                			</li>
							
							<li>
                				<a href="../DailyOrder/dailyorders.php" style="color: #ffffff;">Daily Orders</a>							
                			</li>
														
							<li>
                				<a href="../DailyList/dailylist.php" style="color: #ffffff;">Daily List</a>							
                			</li>
							
							<li>
                				<a href="../category/category.php" style="color: #ffffff;">Category</a>
															
                			</li>
							
							<li>
                				<a href="../subcategory/subcategory.php" style="color: #ffffff;">Sub Category</a>								
                			</li>
                            
							<li>
                				<a href="../unit/unit.php" style="color: #ffffff;">Unit</a>								
                			</li>
                            
							<li class="dropdown">
                				<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #ffffff;">Items<span class="caret"></span></a>	
									<ul class="dropdown-menu">
										<li><a href="../items/items.php" style="color: #ffffff;">Items</a></li>
										<li><a href="../VariableItem/variableitems.php" style="color: #ffffff;">Variable Items</a></li>
										<li><a href="../PopularItem/popularitems.php" style="color: #ffffff;">Popular Items</a></li>
									</ul>
                			</li>

							<li>
                				<a href="../hotdeals/hotdeals.php" style="color: #ffffff;">Hot Deals</a>								
                			</li>
							
							<li>
                				<a href="../offersitem/offersitem.php" style="color: #ffffff;">Offer Items</a>					
                			</li>
							<li>
                				<a href="../today_special/specialitem.php" style="color: #ffffff;">Today Special Item</a>					
                			</li>
							<li>
                				<a href="../gift_item/giftitem.php" style="color: #ffffff;">Gift Item</a>					
                			</li>
							<li>
                				<a href="../transaction/transaction.php" style="color: #ffffff;">Transactions</a>					
                			</li>
 
							<li class="dropdown">
                				<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #ffffff;">Others<span class="caret"></span></a>	
									<ul class="dropdown-menu">
										<li><a href="../sliding/sliding.php" style="color: #ffffff;">Sliding</a></li>
										<li><a href="../shipping/shipping.php" style="color: #ffffff;">Shipping Fee</a></li>
										<li><a href="../area/area.php" style="color: #ffffff;">Customer Area</a></li>
										<li><a href="../coupon/coupon.php" style="color: #ffffff;">Coupon Code</a></li>							
										<li><a href="../delivery/deliveryboy.php" style="color: #ffffff;">Delivery Boy</a></li>
										<li><a href="../adminnotification/websitenotification.php" style="color: #ffffff;">Scrolling Notification</a></li>
										<!-- <li><a href="../notification/notification.php" style="color: #ffffff;">Smart Notification</a></li> -->
									</ul>
                			</li>
                			
                			<li>
                				<a href="../request/request.php" style="color: #ffffff;">Request</a>					
                			</li>

                
						</ul>
						
							<ul  class="nav navbar-nav navbar-right" >
								<li>
									<a href="../logout.php" style="color: #ffffff;"><span class="glyphicon glyphicon-log-out"></span>&nbsp;<b>Logout</b></span></a>
								</li>
							</ul>
   
				</div>
			
</nav>





