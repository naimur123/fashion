<?php

	$DB_HOST = 'localhost';
	$DB_USER = 'guidelin_kazifashoin_house_website';
	$DB_PASS = 'Total@1010';
	$DB_NAME = 'guidelin_kazifashion_house';
	
	try{
		$DB_con = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}",$DB_USER,$DB_PASS);
		$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	
?>