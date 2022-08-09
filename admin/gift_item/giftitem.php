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
    }
    else
    {
		header("Location:../login.php");
	}
?>
<html>
	<head>
		<title>Kazi Fashion House Admin</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<!-- <script src="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"></script>
		<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
		<link rel="stylesheet" href="../include/css/menunavbar.css" />
</head>
<body>
    
	<div class="container-fluid">
			
			<div class="row">
				<h2 class="h2" align="center"><b>Gift Item Show</b></h2>
			</div>
			
			<div class="row">
				
				<div class="col-md-12">
					
				<div class="table-responsive">
				<div align="right">
					<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info"><span class="glyphicon glyphicon-plus-sign"></span>Add Gift Card </button>
				</div>
				<br/>
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Card Number</th>
							<th>Card Details</th>
							<th>Card Amount</th>
							<th>Card validity From</th>
							<th>Card validity To</th>
							<th>Status</th>
							<th>Remarks</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
				</table>
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
					<h4 class="modal-title">Add Gift Card</h4>
				</div>
				<div class="modal-body">
					
					<div class="container-fluid">
						
					<div class="row">
								
					<div class="col-md-6">
									
					<b style="color:red">***</b><label> Enter Gift Card Number</label>
					<input type="text" name="card_number" id="card_number" class="form-control" />
					<br />
					
					<label>Enter Item Description</label>
					<textarea class="form-control" id="card_details" name="card_details"></textarea>
					<br />

					<b style="color:red">***</b><label> Enter Item Price</label>
					<input type="text" name="card_amount" id="card_amount" class="form-control" />
					<br />
					
					<b style="color:red">***</b><label> Select Item Status</label>
					<select class="form-control" name="active" id="active">
			      	<option value="">SELECT Item Status</option>
			      	<option value="1">Activate</option>
			      	<option value="0">Deactivate</option>
					</select>
					<br />

					<!-- <b style="color:red">***</b><label> Select Today Special Item</label>
					<select class="form-control" name="offitem" id="offitem">
			      	<option value="">SELECT Offer Item</option>
			      	<option value="1">Activate</option>
			      	<option value="0">Deactivate</option>
					</select>
					<br /> -->

					<!-- <b style="color:red">***</b><label> Enter Today Special Item Price</label>
					<input type="text" name="offprice" id="offprice" class="form-control" />
					<br /> -->
					<label> Reamrks</label>
					<input type="text" name="remarks" id="remarks" class="form-control" />
					<br />

					<!-- <b style="color:red">***</b><label> Select Item Image</label>
					<input type="file" name="user_image" id="user_image" />
					<span id="user_uploaded_image"></span>
							
							</div>
							
						</div>
					
					</div> -->
					<label>Card Validity From</label>
					<input type="datetime-local" name="card_validity_from" id="card_validity_from" class="form-control" />
					<br />

					<label>Card Validity To</label>
					<input type="datetime-local" name="card_validity_to" id="card_validity_to" class="form-control" />
					<br />
					
					
				</div>
				</div>
				</div>
				
				<div class="modal-footer">
					<input type="hidden" name="user_id" id="user_id" />
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn btn-primary" value="Add" />
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
			</div>
		</form>
	</div>
</div>



<script type="text/javascript" language="javascript" >
$(document).ready(function(){
	$('#add_button').click(function(){
		$('#user_form')[0].reset();
		$('.modal-title').text("Add New Gift Card");
		$('#action').val("Add");
		$('#operation').val("Add");
		// $('#user_uploaded_image').html('');
	});
	
	
	var dataTable = $('#user_data').DataTable({
	
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"fetch.php",
			type:"POST",
			
		},
		"columnDefs":[
			{
			    // "targets": [ 0, 2 ],
				"orderable":false,
			},
		],

	
    });

	$(document).on('submit', '#user_form', function(event){
		
		event.preventDefault();
		
		var card_number = $('#card_number').val();
		var card_details = $('#card_details').val();	
		var card_amount = $('#card_amount').val();
		var card_validity_from= $('#card_validity_from').val();
		var card_validity_to = $('#card_validity_to').val();
		var remarks = $('#remarks').val();
	    var active = $('#active').val();
		
		// var offeritm = $('#offitem').val();
		// var offerprice = $('#offprice').val();
		// var offerpercent = $('#offpercent').val();
		
		// var extension = $('#user_image').val().split('.').pop().toLowerCase();
		
		// if(extension != '')
		// {
		// 	if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
		// 	{
		// 		alert("Invalid Image File");
		// 		$('#user_image').val('');
		// 		return false;
		// 	}
		// }	
		
		if(card_number!= '' &&  card_amount!= '' && card_validity_from!='' && card_validity_to!='' && active!='')
		{
		
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
		}
		else
		{
			alert(" *** Fields are Required");
		}
		
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
				
				var card_number = $('#card_number').val();
				var card_details = $('#card_details').val();	
				var card_amount = $('#card_amount').val();
				var card_validity_from= $('#card_validity_from').val();
				var card_validity_to = $('#card_validity_to').val();
				var remarks = $('#remarks').val();
				var active = $('#active').val();
				
				$('.modal-title').text("Edit Gift Card");
				$('#user_id').val(user_id);
				// $('#user_uploaded_image').html(data.user_image);
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