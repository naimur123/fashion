<?php
	if( ! ini_get('date.timezone') )
    {
        date_default_timezone_set('GMT');
    }
	// include("pageurl.php");
	include ('include/config/dbConfig.php');
	include("header.php");
?>


<style>	
		.tkinline{
		display:inline;
        font-family: 'Roboto';
        font-size: 16px;
	}
    .default {
        padding: 0px 10px 0px 10px;
        background-color: #F1CF98;
        margin-top: 8px;
        border-radius: 50px;
        /* font-size: 10px; */
        
    }

</style>

<div class="container-fluid">

	<div class="row">
	

	<div class="col-sm-12">
	
	<br/>
	<div class="row">
		<div class="col-md-12" align="center" style="background-color:#F1CF98">
			<h4 class="h4" style="color:Balck">Today's Special</h4>
		</div>
	</div>
	
	<br/>
	
	<div class="row">		
    <div  class="list-group list-group-horizontal">    
		<?php
        //get rows query
        $limitStart ="";
        if(!isset($_GET['pageNo']) || $_GET['pageNo'] == 1 || $_GET['pageNo'] <=0 ){
            $limitStart = 0;
        }else{
            $limitStart = ($_GET['pageNo']-1)*18;
        }
        
        
        $query = $db->query("SELECT * FROM `products` where today_special='1' ORDER BY products_name LIMIT $limitStart ,30");
        if($query->num_rows > 0){ 
            while($row = $query->fetch_assoc()){
        ?>

        <div class="item col-xs-6 col-sm-2" style="padding:5px" !important>
					
					<div class="row" align="center">
						<div class="col-sm-12">
                        <img src="admin/items/upload/<?php echo $row['name']; ?>"  class="img-responsive " style="pointer-events: none; width:100%; height: 200px"/>

                        <a name="product_details" style="text-decoration:none; color: black;" href="details.php?id=<?php echo $row["id"];?>"><h5 class="h5"  style="font-weight:bold;"><?php echo $row["products_name"]; ?></h5></a>
                        <h5 class="h5  tkinline"><?php if($row['today_special']){echo ' <h5 class="h5 tkinline" style="color:#D9A84E"> ৳ ' .$row["today_special_price"].'</h5>'; }else if($row['hot_deals']){echo '<del><h5 class="h5 tkinline"> TK '.$row["price"].'</h5></del> <h5 class="h5 tkinline" style="color:red"> TK ' .$row["hotdeal_price"].'</h5>'; } else if($row['offer_item']){echo '<del><h5 class="h5 tkinline"> TK '.$row["price"].'</h5></del> <h5 class="h5 tkinline" style="color:red"> TK ' .$row["offer_price"].'</h5>'; } else {echo '<h5 class="h5 tkinline"> TK '.$row["price"].'</h5>';}?></h5><br>

                        <a class="btn default" name="product_code" type="button" onclick="go(<?php echo $row["id"];?>)";> <p style="color:black; font-size:12px !important;margin: 0 0 2px !important;"> ADD TO CART</p></a>

						</div>
                    </div>
					<br/>            
        </div>
		
        <?php } 
            
        } 
        else{ ?>
			<p class="lead" style="color:red"><b>Hot Deals Items NOT AVAILABLE!</b></p>
        <?php } ?>
		
    </div>
	
	</div>
	
	<?php
	// Pagination List Here
	    $query = $db->query("SELECT * FROM `products` WHERE hot_deals='1'");
	    $count = $query->num_rows /18;
	    $loop = round($query->num_rows /18);
	    if($loop < $count){
	        $loop +=1;
	    }
	    if($loop >1){
	?>
	<div class="row text-center">
	    <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php
                    if(!isset($_GET['pageNo']) || (isset($_GET['pageNo']) && $_GET['pageNo']==1) ){
                ?>
                <li class="disabled">
                  <a href="#"  aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <?php
                    }
                    else{ ?>
                <li>
                  <a href="?pageNo=<?php echo $_GET['pageNo']-1 ?>"  aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>    
                    <?php }
                    $ck = 0; 
                    $pageNo = $_GET['pageNo'];
                    if($pageNo <= 3){$pageNo = 3;}
                    
                    if($pageNo >=4){
                        echo '<li> <a href="?pageNo=1">1</a> </li>';
                        
                    }
                    if($pageNo >=5){
                        echo '<li> <a href="#">...</a> </li>';
                    }
                    
                    for($i = ($pageNo-2); $i <= $loop; $i++){
                        if($ck <5){
                            ?>
                           
                           <li <?php if(!isset($_GET['pageNo']) && $i==1 ){echo 'class="active"';}elseif(isset($_GET['pageNo']) && $_GET['pageNo']== $i) {echo 'class="active"';} ?>><a href="?pageNo=<?=$i?>"><?=$i?></a></li>
                           <?php
                        }
                        
                        $ck++;
                        
                    }
                    if($pageNo <= ($loop-4)){
                            echo '<li> <a href="#">...</a> </li>';
                        }
                        
                        if($pageNo < ($loop-3)){ ?>
                           <li><a href="?pageNo=<?=($loop-1)?>"><?=($loop-1)?></a></li>
                           <?php
                        }  
                        
                if($count<=1 || $_GET['pageNo'] >= $count ){
                ?>
                <li class="disabled">
                  <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
                <?php
                } else{
                    if(!isset($_GET['pageNo'])){
                        $_GET['pageNo']=1;
                    }
                ?>
                <li>
                  <a href="?pageNo=<?php echo $_GET['pageNo']+1 ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
                <?php } ?>
            </ul>
        </nav>
	</div>
	<?php } ?>
	
	<!-- <div class="row">
		<div class="col-md-12" align="center" style="background-color:gray">
			<h5 class="h5" style="color:#fff"></h5>
		</div>
	</div> -->
	
	<br/>
	
	<br/>
	
	</div>
	
	</div>
	
</div>

<?php include('footer.php');?>