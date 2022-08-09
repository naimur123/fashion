<?php
session_start();
unset($_SESSION["signed_in"]);
unset($_SESSION["full_name"]);
session_destroy ();
$url = "index.php";
if(isset($_GET["session_expired"])) {
	$url .= "?session_expired=" . $_GET["session_expired"];	
}
header("Location:$url");
?>