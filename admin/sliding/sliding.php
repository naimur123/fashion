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
		<title>Moshla Bazar Admin</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
		<link rel="stylesheet" href="../include/css/menunavbar.css" />
	</head>
	
	<body>

		<div class="container-fluid">
			
			<div class="row">
				<h2 class="h2" align="center"><b>Home Image Slideshow</b></h2>
			</div>
			
			<div class="row">
				
				<div class="col-md-12">
					
				<div class="table-responsive">
				<div align="right">
					<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info"><span class="glyphicon glyphicon-plus-sign"></span> Add New Item</button>
				</div>
				<br/>
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Item ID</th>
							<th>Item Image</th>
							<th>Flag</th>
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
					<h4 class="modal-title">Add Items</h4>
				</div>
				<div class="modal-body">
					
					<div class="container-fluid">
						
						<div class="row">
								
							<div class="col-md-6">
									
					<b style="color:red">***</b><label> Select Item Flag</label>
					<select class="form-control" name="active" id="active">
			      	<option value="">SELECT Item Flag</option>
			      	<option value="1">Activate</option>
			      	<option value="0">Deactivate</option>
					</select>
					<br />
					<b style="color:red">***</b><label> Select Item Image</label>
					<input type="file" name="user_image" id="user_image" />
					<span id="user_uploaded_image"></span>
							
							</div>
							
							<div class="col-md-6">
							
							</div>
							
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
		</form>
	</div>
</div>



<script type="text/javascript" language="javascript" >
$(document).ready(function(){
	$('#add_button').click(function(){
		$('#user_form')[0].reset();
		$('.modal-title').text("Add Home Image Slideshow");
		$('#action').val("Add");
		$('#operation').val("Add");
		$('#user_uploaded_image').html('');
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
				"targets":[0,1,3,4],
				"orderable":false,
			},
		],

	});

	$(document).on('submit', '#user_form', function(event){
		
		event.preventDefault();
		
		var active = $('#active').val();
		var extension = $('#user_image').val().split('.').pop().toLowerCase();
		
		if(extension != '')
		{
			if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
			{
				alert("Invalid Image File");
				$('#user_image').val('');
				return false;
			}
		}	
		
		if(active!='')
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
				

				$('#active').val(data.active);

				$('.modal-title').text("Edit Sliding Item");
				$('#user_id').val(user_id);
				$('#user_uploaded_image').html(data.user_image);
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