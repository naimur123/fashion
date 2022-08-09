<?php
	if( ! ini_get('date.timezone') )
    {
        date_default_timezone_set('GMT');
    }
	include ('include/config/db.php');
	include('header.php');
?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
		
<div class="container-fluid">

<div class="row">
	
	<div class="col-sm-1 col-xs-1">
		
	</div>
	
	<div class="col-sm-10 col-xs-10">
		
		<div class="row" align="center">
		
			<h3 class="h3"><b>My Profile</b></h3>
	
		</div>
	
	<div class="row">

				<div class="table-responsive">
				<br />
				
				<table class="table table-striped table-bordered table-hover">
			<thead>
				<th>ID</th>
				<th>Full Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Shipping Address</th>
				<!-- <th>Country</th> -->
				<!-- <th>District</th> -->
				<th>Area</th>
				<th>Edit</th>
			</thead>
			<tbody>
			<?php
				include('connnew.php');
                $useridvalue = $_SESSION['userid'];
				$query=mysqli_query($conn,"select * from `customer_registration` where id = '$useridvalue'");
				while($row=mysqli_fetch_array($query)){
					?>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['full_name']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['phone']; ?></td>
						<td><?php echo $row['address']; ?></td>
						<!-- <td><?php echo $row['country']; ?></td> -->
						<!-- <td><?php echo $row['district']; ?></td> -->
						<td><?php echo $row['customer_area']; ?></td>
						<td>
							<a href="#edit<?php echo $row['id']; ?>" data-toggle="modal" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Edit</a> 
						    <?php include('myinfoedit.php'); ?>
						</td>
					</tr>
					<?php
				}
 
			?>
			</tbody>
		</table>
				
			</div>
				
				
		
	</div>
	
</div>

	<div class="col-sm-1 col-xs-1">
		
	</div>

</div>

</div>

