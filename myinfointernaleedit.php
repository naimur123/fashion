<?php
	include('connnew.php');
 
	$id=$_GET['id'];
 
	$phonenum=$_POST['phonenum'];
	$address=$_POST['address'];
 
	mysqli_query($conn,"update customer_registration set phone='$phonenum',  address='$address' where id='$id'");
	header('location:myinfo.php');
 
    ?>