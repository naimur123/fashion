<?php
	if( ! ini_get('date.timezone') )
    {
        date_default_timezone_set('GMT');
    }
    				if(!isset($_SESSION)) 
					{ 
						session_start(); 
					} 
	require_once  'Cart.php';
	$cart = new Cart;
	
	$count_lp =0
?>

<!DOCTYPE html>
<html>

<head>
	<title>Kazi Fashion</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
	
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/fontawesome.min.js"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


	<link rel="stylesheet" href="include/css/menunavbar.css" />
	<link rel="stylesheet" href="include/css/foooter.css" />
	<!-- <link rel="stylesheet" href="include/css/style.css" /> -->
	
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	
	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
	
<style type="text/css">

/* .body {
  background-image: url("./include/images/background.png");
  
  
} */

  /* Note: Try to remove the following lines to see the effect of CSS positioning */
  .affix {
      top: 0;
      width: 100%;
      z-index: 9999 !important;
  }
	  
.navbar-login-session
{
    padding: 10px;
    padding-bottom: 0px;
    padding-top: 0px;
}

.icon-size
{
    font-size: 87px;
}
.navbar-login
{
    width: 305px;
    padding: 10px;
    padding-bottom: 0px;
}

  


#shoppingcart{
    /* padding:0px;
    margin:0px;
    position:fixed;
    right:-0px;
    top:330px;
    width: 60px;
	height: 20px; */
	position:relative;
    margin-top: -25px;
    margin-left: -68px;
} 

.icon-bar a {
    list-style-type:none;
    
    color:#efefef;
    padding:0px;
    margin:0px 0px 1px 0px;
    -webkit-transition:all 0.25s ease-in-out;
    -moz-transition:all 0.25s ease-in-out;
    -o-transition:all 0.25s ease-in-out;
    transition:all 0.25s ease-in-out;
    cursor:pointer;
}

/* Formatting search box */
/* .search-box{
	padding: 5px;
} */
.btn-lg{
	height: 37px;
	margin-left: -30px;
	padding: 9px 15px;
}
.result{
        position: absolute;        
        z-index: 999;
        top: 100%;
        left: 0;
    }
    .search-box input[type="text"], .result{
        width: 120%;
		height: 37px;
        box-sizing: border-box;
    }
    /* Formatting search box */
    
.result{
        position: absolute;        
        z-index: 999;
        top: 100%;
        left: 0;
    }
    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #F1CF98;
        border-top: none;
        cursor: pointer;
		background-color: white;
		color:black;
		
    }
    .result p:hover{
		font-weight:bold;
        background: white;
		
		color: #F1CF98;
    }
	/* .fa-cart-plus{
		width:50px;
		height:40px;
	} */
	#span{
		background: #F1CF98;
        border-radius: 50px;
		color:white; 
		font-size: 10px; 
		padding:2px 4px 2px 4px;
		position: relative;
        top: -66px;
		margin-left: 85px;
		color: black;

		/* background: #F1CF98;
		border-radius: 50px;
		color: white;
		font-size: 10px;
		padding: 10px 6px 2px 7px;
		position: relative;
		top: -66px;
		margin-left: 85px; */
	}
	/*@media only screen and (max-width: 600px) {
		#pull-right2{
			margin-top: -30px;
              margin-right: 20px;
			  
		}
		#pull-right1{
			  margin-top: -30px;
              margin-right: -60px;
		}
    }*/
	#pull-right1{
		margin-right: -60px;
	}
    
    
   #img{
	   background-image: url("./include/images/background.png");
	   
   } 
  
    

  </style>
  
<script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>
  
<script type="text/javascript">
		function validateForm() {
    var searchvalue = document.forms["myformsearchvalue"]["query"].value;
   	
    if (searchvalue == "") {
        alert("Please insert your search item");
        return false;
    }
}
</script>

</head>

<body id="img" style="width:100%;overflow-x: hidden;">


<!-- <div class="shoppingcart">
	
</div> -->

<div class="container-fluid" style="margin-top:30px">

	
	<div class="row" >
		
	<div class="col-md-2" align="center" style="margin-left: 71px;">
		<a href="index.php" style="text-decoration:none;color:black" ><img src="admin/include/logo.png" alt="Kazi Fashion House" height="30px">
		&nbsp;&nbsp;&nbsp;&nbsp;
		 <b style="font-family:'Roboto';">Kazi Fashion House</b></a>
    </div>
	<div class="col-md-6">
			<form action="search.php" method="GET" name="myformsearchvalue" onsubmit="return validateForm()">
		<div class="input-group" style="padding:0px;">
		
		<div class="search-box">
			<input type="text" class="form-control input-lg" style="color:#F1CF98;font-weight:bold;font-family:Roboto;" placeholder="Search"  type="text" name="query">
			<div class="result" align="left"></div>
			
		</div>
		
		<div class="input-group-btn">
			<button class="btn btn-block btn-lg" type="submit" style="background-color:#F1CF98;"  value="Search"><i class="fa-solid fa-magnifying-glass" style="color:#ffff;margin-left: -2px; size:2em"></i></button>
			
		</div>
      </div>
		</form>
	 </div>
	 <div class="col-md-2" id="shoppingcart">
	 <div align="center" >
	 <a href="viewCart.php" style="text-decoration:none;"><img src="./include/images/cart.png" alt="My Bag" style="pointer-events: none; width:50px;height:80px;"><b style="color:black;"> My Cart</b></div>
		<?php if($cart->total_items() > 0){ ?>
		
		<span id="span">
			<b><?php
		    
				//get cart items from session
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
				echo $count ;
			}  
				
           ?></b>
		
		</span>
		<?php if($cart->total_items() == 0){ ?>
		
		<span id="span">
			<b><?php
				echo 0 ;
			}  
				
           ?></b>
		
		</span>
		
	    </a>

	    </div>
		
		
	 </div>
    
	
	<!-- <div class="col-md-8 pv" align="center" style="padding-top:0px;" >
	    <p class="pv" style="color:#08B066;font-weight: bold" style="padding-right:0px;"><h5><b><span class="glyphicon glyphicon-earphone" style="color:#EE3232;font-weight: bold" height="40px"> </span> 01977868484, 01302254543</b></h5></p>
	    <p class="pv" style="color:#08B066;font-weight: bold"><h5><i class="fa fa-whatsapp" style="font-size:20px;color:green;font-weight: bold"></i> <b>01977868411</b></h5></p>
	</div> -->

	<div class="col-md-4" style="margin-top: -68px; margin-left: 62%;">
	<?php
					 if(!isset($_SESSION)) 
					{ 
						session_start(); 
					} 
					 if (isset($_SESSION['full_name'])) {
					 ?>
					 
			<div class="pull-right" id="pull-right1" height="40px">
                <ul class="nav pull-right">
					
                    <li class="dropdown" ><button class="btn btn-default pv"><a style="text-decoration:none;" href="#" class="dropdown-toggle pv" data-toggle="dropdown"><b>Welcome, User </b><b class="caret"></b></a></button>
                        <ul class="dropdown-menu" style="padding:20px">
                            <li><b><p><?php echo htmlspecialchars($_SESSION['full_name']); ?></p></b></li>
                            <li><b><p hidden><?php echo htmlspecialchars($_SESSION['userid']); ?></p></b></li>
							<li><b><p><a href="myinfo.php" style="text-decoration:none;">My Information</a></p></b></li>
							<li><b><p><a href="orderHistory.php" style="text-decoration:none;">My Order</a></p></b></li>
                            
                            <li class="divider"></li>
                            <li><p><a href="logout.php" style="text-decoration:none;"><span class="glyphicon glyphicon-log-out" ></span><b>&nbsp; Logout</b></span></a></p></li>
                        </ul>
                    </li>
                </ul>
	
              </div>

					 <?php
                   
					 }
					  else {
						  
					   ?>
					  <div class="pull-right" id="pull-right2" >
			                    <img src="./include/images/login-icon.png" height="20px"><a href="login.php" style="color:black;text-decoration:none;">&nbsp; Login</a>
		                              &nbsp;&nbsp;&nbsp;&nbsp;
			                    <img src="./include/images/registration.png" height="20px">  <a href="customer_register.php" style="color:black;text-decoration:none;">Register</a>
		                          </div>
					   <?php
					 }
		?>

  </div>
</div>

  



<nav class="navbar navbar-default navbar-custom" data-spy="affix" data-offset-top="197" style="width:100%; background-color: #F4EED1">   
            
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" >
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>                        
					</button>
					<a class="navbar-brand" href="index.php"><img src="include/images/home.png" height="25px" alt="Home" style="pointer-events: none; margin-top: -4px; margin-left: 120px;"></a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
				    
                <ul class="nav navbar-nav "> 

							<li><a href="homedecors.php" style="font-family: 'Roboto'; font-size: 15px; color: black;">Home Decor</a></li>
							
							<!-- <li class="dropdown">
                				<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #ffffff;">Daily Bazar<span class="caret"></span></a>
                				<ul class="dropdown-menu">
										<li><a href="cookings.php" style="color: #ffffff;">Cooking</a></li>
										<li><a href="freshfishmeat.php" style="color: #ffffff;">Fresh Fish & Meat</a></li>
										<li><a href="freshfruitvegetable.php" style="color: #ffffff;">Fruits & Vegetables</a></li>
								</ul>
                			</li> -->
							
							<!-- <li class="dropdown">
                				<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #ffffff;">Food<span class="caret"></span></a>
                				<ul class="dropdown-menu">
										
										<li><a href="beverage.php" style="color: #ffffff;">Beverages</a></li>
										<li><a href="breakfasts.php" style="color: #ffffff;">Breakfast</a></li>
										<li><a href="dairyfood.php" style="color: #ffffff;">Dairy Food</a></li>
										<li><a href="fastfoods.php" style="color: #ffffff;">Fast Food</a></li>
										<li><a href="organic.php" style="color: #ffffff;">Organic & Traditional Food</a></li>
										<li><a href="snack.php" style="color: #ffffff;">Snacks</a></li>
								</ul>
                			</li> -->
							
							<li><a href="officeaccessorieses.php" style="font-family: 'Roboto'; font-size: 15px; color: black;">Office Stationery</a></li>
                			
                			<li>
                				<a href="#" style="font-family: 'Roboto'; font-size: 15px; color: black;">Hand Craft</a>								
                			</li>
							
							<li>
                				<a href="gifts.php" style="font-family: 'Roboto'; font-size: 15px; color: black;">Gift Corner</a>								
                			</li>
                            
							<!-- <li class="dropdown">
                				<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #ffffff;">Appliances<span class="caret"></span></a>	
									<ul class="dropdown-menu">
									    <li><a href="Electronics.php" style="color: #ffffff;">Electronics</a></li>
										<li><a href="ElectricalItem.php" style="color: #ffffff;">Electrical Item</a></li>
										<li><a href="Furniture.php" style="color: #ffffff;">Furniture</a></li>
										<li><a href="KitchenAppliance.php" style="color: #ffffff;">Kitchen Appliances</a></li>
										
									</ul>
                			</li>
							
							<li class="dropdown">
                				<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #ffffff;">Lifestyle<span class="caret"></span></a>	
									<ul class="dropdown-menu">
										<li><a href="cosmetic.php" style="color: #ffffff;">Cosmetics</a></li>
										<li><a href="men.php" style="color: #ffffff;">Men</a></li>
										<li><a href="women.php" style="color: #ffffff;">Women</a></li>
										
									</ul>
                			</li>
                			
                			<li class="dropdown">
                				<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #ffffff;">Household<span class="caret"></span></a>	
									<ul class="dropdown-menu">
										<li><a href="AmateurAccessories.php" style="color: #ffffff;">Amateur Accessories</a></li>
										<li><a href="AirFreshners.php" style="color: #ffffff;">Air Freshners</a></li>
										<li><a href="CleaningItems.php" style="color: #ffffff;">Cleaning Items</a></li>
										<li><a href="kitchenAccessories.php" style="color: #ffffff;">kitchen Accessories</a></li>
										<li><a href="PestControl.php" style="color: #ffffff;">Pest Control</a></li>
									    <li><a href="PlasticProducts.php" style="color: #ffffff;">Plastic Products</a></li>
										<li><a href="Shoecare.php" style="color: #ffffff;">Shoe care</a></li>
										<li><a href="ToiletItems.php" style="color: #ffffff;">Toilet Items</a></li>
									    <li><a href="WashingItems.php" style="color: #ffffff;">Washing Items</a></li>
									</ul>
                			</li>

							<li class="dropdown">
                				<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #ffffff;">Builders<span class="caret"></span></a>	
									<ul class="dropdown-menu">
										<li><a href="BricksSilica.php" style="color: #ffffff;">Bricks & Silica</a></li>
										<li><a href="CementPaint.php" style="color: #ffffff;">Cement & Paints</a></li>
										<li><a href="GlassInteriorItems.php" style="color: #ffffff;">Glass & Interior Items</a></li>
										<li><a href="Hardware.php" style="color: #ffffff;">Hardware</a></li>
										<li><a href="MetalItem.php" style="color: #ffffff;">Metal & Steal Items</a></li>
										<li><a href="StoneCeramics.php" style="color: #ffffff;">Stone & Ceramics</a></li>
										<li><a href="SanitaryBathroomFittings.php" style="color: #ffffff;">Sanitary & Bathroom Fittings</a></li>

									</ul>
                			</li> -->
							
							<li><a href="jewelerys.php" style="font-family: 'Roboto'; font-size: 15px; color: black;">Jewellery Corner</a></li>
							
							<li>
                				<a href="#"  style="font-family: 'Roboto'; font-size: 15px; color: black;">Life Style</a>						
                			</li>	
							<li >
                				<a href="todaySpecials.php"  style="font-family: 'Roboto'; font-size: 15px; color: black;">Today's Special</a>						
                			</li>
							<li >
                				<a href="#"  style="font-family: 'Roboto'; font-size: 15px; color: black;">Offers</a>						
                			</li>	
							<li >
                				<a href="#"  style="font-family: 'Roboto'; font-size: 15px; color: black;">Voucher</a>						
                			</li>							
							
							<li >
                				<a href="request_daily_bazar.php"  style="font-family: 'Roboto'; font-size: 15px; color: black;">Request</a>						
                			</li>
                </ul>   
				</div>
			
</nav>

</body>

<!-- <div class="container">
	
	<div class="row">
		<div class="col-md-3">
		
		</div>
		
		
		
		<div class="col-md-3">
		
		</div>
	</div>
	
	<br/>

</div> -->




<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5b0d8f7b10b99c7b36d46df8/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<!--<script type="text/javascript">
 document.onkeydown = function(e)
 {
	 if(event.keyCode == 123){
		 return false;
	 }
	 if(e.ctrlKey && e.shiftKey && e.keyCode== 'I'.charCodeAt(0)){
		 return false;
	 }
	 if(e.ctrlKey && e.shiftKey && e.keyCode=='J'.charCodeAt(0)){
		 return false;
	 }
	 if(e.ctrlKey && e.keyCode=='U'.charCodeAt(0)){
		 return false;
	 }
	 
 }
</script>-->




