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
	
	$username = 'guidelin_kazifashoin_house_website';
    $password = 'Total@1010';
    $con = mysqli_connect("localhost", $username, $password, "totalbazarbd_totalbazarbd");
	
	if(isset($_POST['orderDetailsInfo'])){
	    $total = 0;
	    $oid =  $_POST['oid'];
	    $items= $_POST['items'];
	    $qty="";
	    for($i=0;$i<$items;$i++){
	        $id = $_POST['dId'.$i];
	        if(isset($_POST['deleteId']) && $_POST['deleteId'] == $id){
	            $qty = 0;
	        }else{
	           $qty = $_POST['dqty'.$i]; 
	        }
	        
	        $price = $_POST['dprice'.$i];
	        $total += $qty*$price;
	        $st = "";
	        if($qty <= 0){
	           $st ="Delete from order_items WHERE id=$id";
	        }else{
	            $st= "UPDATE `order_items` SET product_price=$price,quantity=$qty WHERE id=$id";
	        }
	        mysqli_query($con,$st);
	    }
	    
	    $st ="select * from orders where id= $oid";
        $row = mysqli_query($con,$st);
        $data = mysqli_fetch_assoc($row);
        $s_total = ($data['shipping_cost'] + $total) - $data['discount_amount'];
	    $st = "UPDATE `orders` SET total_price=$total,sub_total_price=$s_total where id = $oid";
	    mysqli_query($con,$st);
	    echo'<script> alert("Update Success")</script>';
	}
	
	if(isset($_POST['orderInfo'])){
	    $oid =  $_POST['oid'];
	    $total_amt = $_POST['total_amt'];
	    $subtotal_amt = $_POST['subtotal_amt'];
	    $shipping_amt = $_POST['shipping_amt'];
	    $discount_amt = $_POST['discount_amt'];
	    $delv_man = $_POST['delv_man'];
	    $active = $_POST['active'];
	    $date = date('Y-m-d');
	    $admin_message = $POST['admin_message'];
	    $st = "UPDATE orders SET total_price=$total_amt,sub_total_price=$subtotal_amt,shipping_cost=$shipping_amt,discount_amount=$discount_amt,delivery_man='$delv_man',admin_message ='$admin_message',modified='$date',status='$active' where id=$oid" ;
	    //echo $st;
	    if(mysqli_query($con,$st)){
	        echo'<script> alert("Update Success")</script>';
	    }else{
	        echo'<script> alert("Error in Update")</script>';
	    }
	    
	}
	
	
    $oid= "";
    if(isset($_GET['oid'])){
        $oid = $_GET['oid'];
    }else{
        $oid=0;
    }
    $st ="select * from orders where id= $oid";
    $data = mysqli_query($con,$st);
    $order = mysqli_num_rows($data) > 0 ? mysqli_fetch_assoc($data):0;
    $st = "SELECT order_items.*,products.products_name FROM order_items,products WHERE order_items.product_id=products.id and order_items.order_id=$oid";
    $orderDetailsAll = mysqli_query($con,$st);
    
?>
<html>
	<head>
		<title>Kazi Fashion House Admin</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
		<link rel="stylesheet" href="../include/css/menunavbar.css" />		
	</head>
	
	<body>
		<div class="container-fluid">
		    <div class="row">
		        <div class="col-sm-6">
		            <div class="panel panel-info">
		                <div class="panel-heading">
		                    <h4>Edit Order Info</h4>
		                </div>
		                <div class="panel-body">
		                    <form method="post" class="form-horizontal">
		                        <div class="row">
    		                        <div class="col-sm-4 from-group">
    		                            <label>Enter Total Amount</label>
    		                            <input type="hidden" name="oid" value="<?=$order['id']?>" >
                					    <input type="text" name="total_amt" required  value="<?=$order['total_price']?>" class="form-control" />
    		                        </div>
    		                        <div class="col-sm-4 from-group">
    		                            <label>Enter Sub Total Amount</label>
                					    <input type="text" name="subtotal_amt" required value="<?=$order['sub_total_price']?>" class="form-control" />
    		                        </div>
    		                        <div class="col-sm-4 from-group">
    		                            <label>Enter Shipping Amount</label>
                					    <input type="text" name="shipping_amt" required value="<?=$order['shipping_cost']?>" id="shipping_amt" class="form-control" />
    		                        </div>
    		                    </div>
		                        <hr/>
		                        
		                        <div class="row">
    		                        <div class="col-sm-4 from-group">
    		                            <label>Enter Discount Amount</label>
                					    <input type="text" name="discount_amt" required  value="<?=$order['discount_amount']?>" id="discount_amt" class="form-control" />
    		                        </div>
    		                        <div class="col-sm-4 from-group">
    		                            <b style="color:red">***</b><label> Select Delivery Boy</label>
    		                            <select class="form-control round" id="delv_man" name="delv_man" required>
                							<option value="">Select Delivery Man</option>												
                							<?php
                									require_once 'config.php';
                									$f_value = '1';
                									$stmt = $dbcon->prepare('SELECT delivery_name FROM delivery_man where active=:fvalue order by id');
                									$stmt->bindParam(':fvalue', $f_value);
                									$stmt->execute();
                        
                									while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                									{
                										extract($row);
                							?>
                									<option value="<?php echo $delivery_name; ?>" <?php if($delivery_name == $order['delivery_man']) {echo 'selected';} ?> ><?php echo $delivery_name; ?></option>
                							
                							<?php
                									}
                							?>
                							</select>
    		                        </div>
    		                        <div class="col-sm-4 from-group">
    		                            <b style="color:red">***</b><label>Select Status</label>
                    					<select class="form-control" name="active" id="active">
                    			      	<option value="0" <?php if($order['status'] ==0) {echo 'selected';} ?> >Deleted</option>
                    					<option value="1" <?php if($order['status'] ==1) {echo 'selected';} ?> >Pending</option>
                    			      	<option value="2" <?php if($order['status'] ==2) {echo 'selected';} ?> >Delivered</option>
                    					<option value="3" <?php if($order['status'] ==3) {echo 'selected';} ?> >Rejected</option>
                    					<option value="4" <?php if($order['status'] ==4) {echo 'selected';} ?> >Shipping</option>
                    					</select>
    		                        </div>
    		                        <div class="col-sm-12 from-group">
            					        <label>Enter Admin Message</label>
					                    <input type="text" name="admin_message" value="<?=$order['admin_message']?>" placeholder="Admin Message"  class="form-control" />
            					    </div>
            					</div>
            					
            					<div class="row">
            					    <div class="col-sm-6 col-sm-offset-3 from-group" style="margin-top:10px;">
            					        <button class="btn btn-info form-control" type="submit" name="orderInfo">Update Info</button>
            					    </div>
            					</div>
		                    </form>
		                </div>
		            </div>
		        </div>
		    
		        <div class="col-sm-6">
		            <div class="panel panel-info">
		                <div class="panel-heading">
		                    <h4>Edit Order Items Info</h4>
		                </div>
		                <div class="panel-body">
		                    <form method="post" class="form-horizontal">
		                        <!-- order details -->
		                        <div class="row">
		                            <?php
		                                $i=0;
		                                $count = mysqli_num_rows($orderDetailsAll);
		                                while($row = mysqli_fetch_assoc($orderDetailsAll) ){
		                            ?>
    		                        <div class="col-sm-4 from-group">
    		                            <lable>Order Items Name</lable>
    		                            <input type="hidden" name="oid" value="<?=$order['id']?>" >
    		                            <input type="hidden" name="items" value="<?=$count?>">
        		                        <input type="hidden" name="dId<?=$i?>" value="<?=$row['id']?>">
        		                        <input type="text" name="dOname<?=$i?>" value="<?=$row['products_name']?>" class="form-control" readonly>
    		                        </div>
    		                        <div class="col-sm-4 from-group">
    		                            <lable>Item Quantity</lable>
    		                            <input type="text" name="dqty<?=$i?>" value="<?=$row['quantity']?>" class="form-control" >
    		                        </div>
    		                        <div class="col-sm-3 from-group">
    		                            <lable>Item Price</lable>
    		                            <input type="text" name="dprice<?=$i?>" value="<?=$row['product_price']?>" class="form-control" >
    		                        </div>
    		                        <div class="col-sm-1 from-group">
    		                            <lable> &nbsp; </lable>
    		                            <button onclick="CheckId(<?=$row['id']?>)" type="button" class="btn btn-sm btn-danger form-control text-center">X</button>
    		                        </div>
    		                        <?php $i++; } ?>
		                        </div>
		                        <div class="row">
		                            <input type="hidden"  name="deleteId" id="delId">
            					    <div class="col-sm-6 col-sm-offset-3 from-group" style="margin-top:10px;">
            					        <button class="btn btn-info form-control" type="submit" id="orderDetailsInfo" name="orderDetailsInfo">Update Info</button>
            					    </div>
            					</div>
		                    </form>
		              </div>
		            </div>
		      </div>
		  </div>
		</div>
		<script>
		    function CheckId(id){
		        $('#delId').val(id);
		        $('#orderDetailsInfo').click();
		        
		    }
		</script>
    </body>
</html>