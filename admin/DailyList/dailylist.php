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
				<h2 class="h2" align="center"><b>Daily Orders List</b></h2>
			</div>
			
			<div class="row">
				

				
				<div class="col-md-12">
				<div class="table-responsive">
				<br />

				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Order ID</th>
							<th>Product ID</th>
							<th>Products Name</th>
							<th>Unit</th>
							<th>Product Price</th>
							<th>Quantity</th>
							<th>Total</th>
							<th>Print</th>
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
				"targets":[0,1,2,3,4,5,6],
				"orderable":false,
			},
		],

	});

	
	
	
});
</script>