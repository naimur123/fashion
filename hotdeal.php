<?php
	if( ! ini_get('date.timezone') )
    {
        date_default_timezone_set('GMT');
    }
	// include("pageurl.php");
	include ('include/config/dbConfig.php');
?>

<style>

	.tkinline{
		display:inline;
	}
	hr.new1{
		border-top: 2px solid #0080ff;
		margin-top: 2px;
	
	}

</style>

<br/>

<div class="container">

	<!-- <div class="row" style="border-left: 1px solid gray; border-right: 1px solid gray;"> -->

	<div class="col-sm-12">
	
	<div class="row">
		<div class="col-md-12" >
			<h2 class="h4" style="font-family:Courier;"><b>*HOT DEALS*<b><hr class="new1"></h2>

		</div>
	</div>
	
	<br/>
	
	<div class="row">		
    <div  class="list-group list-group-horizontal">    
		<?php
        //get rows query
        $query = $db->query("SELECT * FROM products where hot_deals='1' order by id DESC LIMIT 6");
        if($query->num_rows > 0){ 
            while($row = $query->fetch_assoc()){
        ?>

        <div class="item col-xs-6 col-sm-2" style="padding:5px" !important>
					
					<div class="row" align="center">
						<div class="col-sm-12">
							<img src="admin/items/upload/<?php echo $row['name']; ?>"  class="img-responsive " style="width:100%; height: 150px"/>

							<a name="product_details" style="text-decoration:none;" href="details.php?id=<?php echo $row["id"];?>"><h5 class="h5"  style="font-weight:bold;padding-top:10px;height:45px;"><?php echo $row["products_name"]; ?></h5></a> 
							<h5 class="h5" style="padding-top:5px;"><?php echo $row["quantity"]; ?></h5>
							<h5 class="h5  tkinline"><?php if($row['hot_deals']){echo '<del><h5 class="h5 tkinline"> TK '.$row["price"].'</h5></del> <h5 class="h5 tkinline" style="color:red"> TK ' .$row["hotdeal_price"].'</h5>'; } else if($row['offer_item']){echo '<del><h5 class="h5 tkinline"> TK '.$row["price"].'</h5></del> <h5 class="h5 tkinline" style="color:red"> TK ' .$row["offer_price"].'</h5>'; } else {echo '<h5 class="h5 tkinline"> TK '.$row["price"].'</h5>';}?></h5>
							
							<a class="btn btn-default" name="product_code" style="width:100%" type="button" onclick="go(<?php echo $row["id"];?>)";> <p style="color:#FF7067;font-weight:bold"><span class="glyphicon glyphicon-shopping-cart" style="color:#FF7067;font-weight:bold" ></span> Add to Cart</p></a>
                            
						</div>
                    </div>
					<br/>            
        </div>
		
        <?php } }else{ ?>
			<p class="lead" style="color:red; padding-left: 14px;"><b>Hot Deals Items Not Available!</b></p>
        <?php } ?>
		
    </div>
	
	</div>
	
	<!-- <div class="row">
		<div class="col-md-12" align="center" style="background-color:#EE3232;height:20px;">
			<h5 class="h5" style="color:#fff"></h5>
		</div>
	</div> -->
	</div>
	
	<!-- </div> -->
	
</div>