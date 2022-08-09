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
			<h2 class="h4" style="font-family:Courier;"><b>*Voucher*<b><hr class="new1"></h2>

		</div>
	</div>
	
	<br/>
	
	<div class="row">		
    <div  class="list-group list-group-horizontal">    
		<?php
        //get rows query
        $query = $db->query("SELECT * FROM gift_card where status='1' order by id DESC LIMIT 6");
        if($query->num_rows > 0){ 
            while($query->fetch_assoc()){
				$rows = $query;
				foreach($rows as $row){
        ?>

        <div class="item col-xs-6 col-sm-2" style="padding:5px" !important>
					
					<div class="row" align="center">
						<div class="col-sm-12">
							<!-- <img src="admin/items/upload/<?php echo $row['name']; ?>"  class="img-responsive " style="width:100%; height: 150px"/> -->
                            <a href="voucherPurchase.php" onclick="<?php $_SESSION = $row['id'] ?>">
							<?php echo $row['card_number']; ?>
							<br>
							<h5>Price:<?php echo $row['card_amount']; ?></h5>
							<br>
							Purchase
							</a>

                            
						</div>
                    </div>
					<br/>            
        </div>
		
        <?php } }}else{ ?>
			<p class="lead" style="color:red; padding-left: 14px;"><b>Voucher Not Available!</b></p>
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