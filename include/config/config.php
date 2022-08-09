<?Php

 $dbhost = 'localhost';
 $dbname = 'guidelin_kazifashion_house';  
 $dbuser = 'guidelin_kazifashoin_house_website';                  
 $dbpass = 'Total@1010';                  
 
 try{
  
  $dbcon = new PDO("mysql:host={$dbhost};dbname={$dbname}",$dbuser,$dbpass);
  $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
 }catch(PDOException $ex){
  
  die($ex->getMessage());
 }