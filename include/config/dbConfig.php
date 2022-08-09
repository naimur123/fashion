<?php
//DB details
 $dbhost = 'localhost';
 $dbname = 'guidelin_kazifashion_house';  
 $dbuser = 'guidelin_kazifashoin_house_website';                  
 $dbpass = 'Total@1010';  

//Create connection and select DB
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($db->connect_error) {
    die("Unable to connect database: " . $db->connect_error);
} 
?>