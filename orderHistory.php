<?php
	if( ! ini_get('date.timezone') )
    {
        date_default_timezone_set('GMT');
    }
	include("header.php");
?>


<div class="container-fluid">

<div class="row">
	<div class="col-sm-2 col-xs-2"></div>
	<div class="col-sm-8 col-xs-8" align="center">
		
		<h3 class="h3">My Orders</h3>
	
	<div class="table-responsive">
      
      
      <table class="table table-striped table-bordered table-hover">
			<thead>
				<th>Order ID</th>
				<th>Product Name</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Unit</th>
				<th>Order Date</th>
                <th>Status</th>
			</thead>
			<tbody>
			<?php
			    include('connnew.php');
                $useridvalue = $_SESSION['userid'];
				$query=mysqli_query($conn,"SELECT orders.status, orders.created, orders.id as ordid, products.id,products.products_name,products.quantity,order_items.product_price,order_items.quantity as qty,order_items.product_price*order_items.quantity as total FROM orders join order_items on orders.id = order_items.order_id JOIN products on order_items.product_id= products.id where orders.customer_id='$useridvalue'");

				while($row=mysqli_fetch_array($query)){
				    $active = '';
	if($row['status'] == 1) {
		$active = '<label class="label label-info">Pending</label>';
	}   else if($row['status'] == 2) {
		$active = '<label class="label label-success">Delivered</label>'; 
	} else if($row['status'] == 3) {
		$active = '<label class="label label-warning">Rejected</label>'; 
	} else if($row['status'] == 4) {
		$active = '<label class="label label-primary">Shipping</label>'; 
	} else if($row['status'] == 0) {
		$active = '<label class="label label-danger">Deleted</label>'; 
	} 
					?>
					<tr>
						<td><?php echo $row['ordid']; ?></td>
						<td><?php echo $row['products_name']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo $row['product_price']; ?></td>
                        <td><?php echo $row['qty']; ?></td>
                        <td><?php echo $row['created']; ?></td>
						<td><?php echo $active; ?></td>
					</tr>
					<?php
				}
 
			?>
			</tbody>
		</table>
      
    </div>
	
	</div>
	<div class="col-sm-2 col-xs-2"></div>
</div>


