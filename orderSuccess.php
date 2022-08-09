<?php
	if( ! ini_get('date.timezone') )
    {
        date_default_timezone_set('GMT');
    }
if(!isset($_REQUEST['id'])){
    header("Location: index.php");
}
include("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Kazi Fashion</title>
    <meta charset="utf-8">
    <style>

    </style>
</head>
</head>
<body>


<div class="container">
    <h1>Order Status</h1>
    <p style="color: #34a853;font-size: 18px;">Your order has been submitted successfully. </p>
	
</div>


<br/>
<br/>

<br/>
<br/>
<br/>

<br/>
<br/>
<br/>

<br/>
<br/>
<br/>

<br/>
<br/>
<br/>

<br/>
<br/>
<br/>
<br/>
<br/>
<br/>

<br/>
<br/>


<?php include('footer.php');?>