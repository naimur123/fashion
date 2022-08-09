<?php
session_start();
unset($_SESSION["signed_in"]);
unset($_SESSION["email_name_total"]);
session_destroy ();
$url = "login.php";
if(isset($_GET["session_expired"])) {
	$url .= "?session_expired=" . $_GET["session_expired"];
	
	
}
header("Location:$url");
	
?>