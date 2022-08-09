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
		<title>Moshla Bazar Admin</title>
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
				<h2 class="h2" align="center"><b>Shipping Fee Show</b></h2>
			</div>
			
			<div class="row">
				
				<div class="col-md-2">
				
				</div>
				
				<div class="col-md-8">
				<div class="table-responsive">
				<br />
				<div align="right">
					<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info"><span class="glyphicon glyphicon-plus-sign"></span> Add New Shipping Fee</button>
				</div>
				<br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Shipping ID</th>
							<th>Inside Dhaka Fee</th>
							<th>Inside Dhaka Fee Will Be Free After</th>
							<th>Outside Dhaka Fee</th>
							<th>Outside Dhaka Fee Will Be Free After</th>
							<th>Remarks</th>
							<th>Flag</th>
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
					<h4 class="modal-title">Add New Shipping Fee</h4>
				</div>
				
				<div class="modal-body">
					
					<div class="container-fluid">
						
						<div class="row">
						
							<div class="col-md-2">

							</div>
								
							<div class="col-md-8">
									
					<b style="color:red">***</b><label> Enter Inside Dhaka Fee</label>
					<input type="text" name="coupcode" id="coupcode" class="form-control" />
					<br />
					<b style="color:red">***</b><label>Inside Dhaka Fee will be Free After</label>
					<input type="text" name="insideFreeAfter" id="insideFreeAfter" class="form-control" />
					<br />
					<b style="color:red">***</b><label> Enter Outside Dhaka Fee</label>
					<input type="text" name="coupamt" id="coupamt" class="form-control" />
					<br />	
					<b style="color:red">***</b><label>Outside Dhaka Fee will be Free After</label>
					<input type="text" name="outsideFreeAfter" id="outsideFreeAfter" class="form-control" />
					<label>Enter Remarks</label>
					<input type="text" name="remarks" id="remarks" class="form-control" />
					<br />
					<b style="color:red">***</b><label> Select Flag</label>
					<select class="form-control" name="active" id="active">
			      	<option value="">SELECT</option>
			      	<option value="1">Activate</option>
			      	<option value="0">Deactivate</option>
					</select>
					
							</div>
							
							<div class="col-md-2">

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
	$('#add_button').click(function(){
		$('#user_form')[0].reset();
		$('.modal-title').text("Add Shipping Fee");
		$('#action').val("Add");
		$('#operation').val("Add");
	});
	
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
				"targets":[0,3,4,5],
				"orderable":false,
			},
		],

	});

	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();

		var couponcode = $('#coupcode').val();
		var couponamount = $('#coupamt').val();
		var remarks = $('#remarks').val();
		var active = $('#active').val();
		
		if(couponcode != '' && couponamount !='' && active != '')
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
			alert("*** Fields are Required");
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
				$('#coupcode').val(data.coupcode);
				$('#coupamt').val(data.coupamt);
				$('#outsideFreeAfter').val(data.outsideFreeAfter);
				$('#insideFreeAfter').val(data.insideFreeAfter);
				$('#remarks').val(data.remarks);
				$('#active').val(data.active);
				$('.modal-title').text("Edit Shipping Fee");
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