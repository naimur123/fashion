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

<html>
	<head>
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
				<h2 class="h2" align="center"><b>Customer Daily Orders</b></h2>
			</div>
			
			<div class="row">
				

				
				<div class="col-md-12">
				<div class="table-responsive">
				<br />

				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Order ID</th>
							<th>Customer ID</th>
							<th>Total Price</th>
							<th>Sub Total</th>
							<th>Shipping</th>
							<th>Discount</th>
							<th>Order Date</th>
							<th>Status</th>
							<th>Delivery</th>
							<th>Status Date</th>
							<th>Admin</th>
							<th>Details</th>
							<th>Print</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
				</table>
				
			</div>
				
				<div class="col-md-2">
				
				</div>
			
			</div>
			
			</div>
		
		</div>
	</body>
</html>



<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add New Orders</h4>
				</div>
				
				<div class="modal-body">
					
					<div class="container-fluid">
						
						<div class="row">
						
							<div class="col-md-3">

							</div>
								
							<div class="col-md-6">
									
					<label>Enter Total Amount</label>
					<input type="text" name="total_amt" id="total_amt" class="form-control" />
					<br />
					<label>Enter Sub Total Amount</label>
					<input type="text" name="subtotal_amt" id="subtotal_amt" class="form-control" />
					<br />
					<label>Enter Shipping Amount</label>
					<input type="text" name="shipping_amt" id="shipping_amt" class="form-control" />
					<br />
					<label>Enter Discount Amount</label>
					<input type="text" name="discount_amt" id="discount_amt" class="form-control" />
					<br />
					<b style="color:red">***</b><label> Select Delivery Boy</label>
						<select class="form-control round" id="delv_man" name="delv_man">
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
									<option value="<?php echo $delivery_name; ?>"><?php echo $delivery_name; ?></option>
							
							<?php
									}
							?>
							</select>
					<br />
					<label>Enter Admin Message</label>
					<input type="text" name="admin_text" id="admin_text" class="form-control" />
					<br />			
					<b style="color:red">***</b><label>Select Status</label>
					<select class="form-control" name="active" id="active">
			      	<option value="0">Deleted</option>
					<option value="1">Pending</option>
			      	<option value="2">Delivered</option>
					<option value="3">Rejected</option>
					<option value="4">Shipping</option>
					</select>
					
							</div>
							
							<div class="col-md-3">

							</div>
							
						</div>
					
					</div>
					
					
				</div>
				<div class="modal-footer">
					<input type="hidden" name="user_id" id="user_id" />
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn btn-primary" value="Add" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>



<script type="text/javascript" language="javascript" >
$(document).ready(function(){
	
	
	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"fetch.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14],
				"orderable":false,
			},
		],

	});

	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();

		var couponcode = $('#delv_man').val();
		var couponamount = $('#admin_text').val();
		var remarks = $('#total_amt').val();
		var active = $('#active').val();
		
		
			$.ajax({
				url:"insert.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					alert(data);
					$('#user_form')[0].reset();
					$('#userModal').modal('hide');
					dataTable.ajax.reload();
					location.reload();				
				}
			});
		
	});
	
	
	$(document).on('click', '.update', function(){
		var user_id = $(this).attr("id");
		
		$.ajax({
			url:"fetch_single.php",
			method:"POST",
			data:{user_id:user_id},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#total_amt').val(data.total_amt);
				$('#subtotal_amt').val(data.subtotal_amt);
				$('#shipping_amt').val(data.shipping_amt);
			    $('#discount_amt').val(data.discount_amt);
				$('#delv_man').val(data.delv_man);
				$('#admin_text').val(data.admin_text);
				$('#active').val(data.active);
				$('.modal-title').text("Edit Orders Information");
				$('#user_id').val(user_id);
				$('#action').val("Edit");
				$('#operation').val("Edit");
			}
		})
	});
	
	
	
	$(document).on('click', '.delete', function(){
		var user_id = $(this).attr("id");
		if(confirm("Are you sure you want to delete this?"))
		{
			$.ajax({
				url:"delete.php",
				method:"POST",
				data:{user_id:user_id},
				success:function(data)
				{
					alert(data);
					dataTable.ajax.reload();
					
				}
			});
		}
		else
		{
			return false;	
		}
	});
	
	
});
</script>