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
        font-family: 'Roboto';
        font-size: 16px;
	}
    .default {
        /*padding: 0px 10px 0px 10px;*/
        background-color: #F1CF98;
        margin-top: 8px;
        border-radius: 50px;
        /* font-size: 10px; */
        
    }

  
	

</style>

<br/>

<div class="container">
       <?php
        //get rows query
        $query = $db->query("SELECT name FROM category where cat_name='Today Special' ");
        if($query->num_rows > 0){ 
            while($row = $query->fetch_assoc()){
				// $s=$row['name'];
                // // echo $row['name'];
        ?>   
			<a href="todaySpecials.php"><img src="admin/items/upload/<?php echo $row['name']; ?>"  class="img-responsive " style="width:100%; height: 164px"/></a>
			<br>
			&nbsp;
			&nbsp;
			&nbsp; <?php } }else{ ?>
			<p class="lead" style="color:red; padding-left: 14px;"><b></b></p>
        <?php } ?>
    <!-- <a href="todaySpecials.php"><img src="./include/images/today.png" style="width:100%; height:150px"></a>
    <br>
    &nbsp;
    &nbsp;
    &nbsp; -->
	<!-- <div class="row" style="border-left: 1px solid gray; border-right: 1px solid gray;"> -->
     
	<div class="col-sm-12">
	
	<div class="row">
		<div class="col-md-12" >
	    <h2 class="h4" style="font-family:Roboto; text-decoration: underline; text-decoration-color: #F1CF98; margin-left: -12px;"><b>TODAY'S SPECIAL<b></h2>

		</div>
	</div>
	
	<br/>
	
	<div class="row">		
    <div  class="list-group list-group-horizontal">    
		<?php
        //get rows query
        $query = $db->query("SELECT * FROM products where today_special='1' order by id DESC LIMIT 6");
        if($query->num_rows > 0){ 
            while($row = $query->fetch_assoc()){
        ?>

        <div class="item col-xs-6 col-sm-2" style="padding:5px" !important>
					
					<div class="row" align="center">
						<div class="col-sm-12">
							<img src="admin/items/upload/<?php echo $row['name']; ?>"  class="img-responsive " style="pointer-events: none; width:100%; height: 200px"/>

							<a name="product_details" style="text-decoration:none; color: black;" href="details.php?id=<?php echo $row["id"];?>"><h5 class="h5"  style="font-weight:bold;"><?php echo $row["products_name"]; ?></h5></a>
							<h5 class="h5  tkinline"><?php if($row['today_special']){echo ' <h5 class="h5 tkinline" style="color:#D9A84E"> ৳ ' .$row["today_special_price"].'</h5>'; }else if($row['hot_deals']){echo '<del><h5 class="h5 tkinline" style="color:#D9A84E"> ৳ '.$row["price"].'</h5></del> <h5 class="h5 tkinline" style="color:#D9A84E"> ৳ ' .$row["hotdeal_price"].'</h5>'; } else if($row['offer_item']){echo '<del><h5 class="h5 tkinline" style="color:#D9A84E"> ৳ '.$row["price"].'</h5></del> <h5 class="h5 tkinline" style="color:#D9A84E"> ৳ ' .$row["offer_price"].'</h5>'; } else {echo '<h5 class="h5 tkinline" style="color:#D9A84E"> ৳'.$row["price"].'</h5>';}?></h5><br>
                            <a class="btn default" style=" padding: 3px 10px 0px 10px;"  name="product_code" type="button" onclick="go(<?php echo $row["id"];?>)";> <p style="color:black; font-size:12px !important;margin: 0 0 2px !important;"> ADD TO CART</p></a>
                            
						</div>
                    </div>
					<br/>            
        </div>
		
        <?php } }else{ ?>
			<p class="lead" style="color:red; padding-left: 14px;"><b> Items Not Available!</b></p>
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