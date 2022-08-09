<?php
	if( ! ini_get('date.timezone') )
    {
        date_default_timezone_set('GMT');
    }
	include("pageurl.php");
	include ('include/config/dbConfig.php');
	include("header.php");
?>

<style>	
		/* .tkinline{
		display:inline;
		} */
		.col-sm-4{
			margin-left: 18em;
			border: 3px solid #F1CF98;
			margin-top: 4em;
		}
		/* .btn{
			background-color: #F1CF98;
			color: black;
			font-weight: bold;
			padding: 7px 10px 0px 13px;
			width: 32%;
			border-radius: 10px;
		} */
</style>

<div class="container-fluid">

	<div class="row">

	<div class="col-sm-10">
	<!-- <div class="row">
		<div class="col-md-12" align="center" style="background-color:gray">
			<h4 class="h4" style="color:#fff"> Product Details </h4>
		</div>
	</div> -->
	
	
	
	<div class="row">		
    <div  class="list-group list-group-horizontal">    
		<?php
        //get rows query
		$id = $_GET['id'];
		$productName = array();
        $query = $db->query("SELECT * FROM products where id="."'".$id."'"." ORDER BY products_name");
        if($query->num_rows > 0){ 
            while($row = $query->fetch_assoc()){
				array_push($productName,$row["products_name"]);
        ?>
		
		<div class="item col-sm-4">
			
			<img src="admin/items/upload/<?php echo $row['name']; ?>"  class="img-responsive" style="pointer-events: none; width:100%; height: 400px"/>
		
		</div>


        <div class="item col-sm-5" style="margin-top: 10em; margin-left: 2em;">
							<h3 class="h3" name="prdname"  style="font-weight:bold;padding-top:10px;height:35px;"><?php echo $row["products_name"]; ?></h3>	
							<hr style="border: 1px solid #F1CF98; width:15%;text-align:left;margin-left:0">
							<p style="padding-top:5px;"><?php echo $row["description"]; ?></p>
							<!-- <h3 class="h3" style="padding-top:5px;">Item Qty: <?php echo $row["quantity"]; ?></h3> -->
							<h4 class="h4  tkinline"><?php if($row['hot_deals']){echo '<del><h4 class="h4 tkinline"> ৳ '.$row["price"].'</h4></del> <h4 class="h4 tkinline" style="color:red"> ৳ ' .$row["hotdeal_price"].'</h4>'; } else if($row['offer_item']){echo '<del><h4 class="h4 tkinline"> ৳ '.$row["price"].'</h4></del> <h4 class="h4 tkinline" style="color:red"> ৳ ' .$row["offer_price"].'</h4>'; } else {echo '<h4 class="h4 tkinline"> ৳ '.$row["price"].'</h4>';}?></h4>

							<a class="btn" style="background-color: #F1CF98;color: black;font-weight: bold;padding: 7px 10px 0px 13px;width: 32%;border-radius: 10px;" name="product_code" href="cartAction.php?action=addToCart&id=<?php echo $row["id"];?>&pageurl=<?php echo curPageURL();?>"><p style="color:black;font-weight:bold"> Add to Cart</p></a>
       
        </div>
		
		
        
		
		
		
    </div>
	
	</div>
	<!-- <div class="row">
		<div class="col-md-12" align="left" style="background-color:gray">
			<h4 class="h4" style="color:#fff">Item Description</h4>
		</div>
		
		<div class="item col-sm-12">
			<br/>
			
			<p class="lead"><?php echo $row["description"]; ?></p>
		
		</div>
		
	</div>
	 -->
	<?php } }else{ ?>
			<p class="lead" style="color:red"><b>Product Details Not Available!</b></p>
        <?php } ?>
	
	<br/>
	
	
	
	<!-- <div class="row">
		<div class="col-md-12" align="center" style="background-color:gray">
			<h5 class="h5" style="color:#fff"></h5>
		</div>
	</div> -->
	
	<br/>
	
	<br/>
	
	</div>
	
	
	<div class="col-sm-1">
	
	
	</div>
	
	</div>
	
</div>

<?php include('footer.php');?>

