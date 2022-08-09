<?php
	if(!ini_get('date.timezone'))
    {
        date_default_timezone_set('GMT');
    }
    if(!isset($_SESSION)) 
	{ 
		session_start(); 
	} 
    if(isset($_SESSION['email_name_total'])) {
		include('../header.php');
	}
	else 
	{
        include('../login.php');
	}
?>


<?php

if(isset($_SESSION['email_name_total'])) {
		//include('../header.php');
	


$mysqli = new mysqli("localhost", "guidelin_kazifashoin_house_website", "Total@1010", "guidelin_kazifashion_house");
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
 
// Attempt select query execution
$sql = "SELECT count(id) FROM orders where status='1'";
if($result = $mysqli->query($sql)){
    if($result->num_rows > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </th>";
                echo "<th>Pending Orders</th>";
            echo "</tr>";
        while($row = $result->fetch_array()){
            echo "<tr>";
                echo "<th> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </th>";
                echo "<td> &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;" . $row['count(id)'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        $result->free();
    } else{
        echo "No Pending Orders Found";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}
 
// Close connection
$mysqli->close();

}

?>



<?php

if(isset($_SESSION['email_name_total'])) {
		//include('../header.php');
	

$mysqli = new mysqli("localhost", "guidelin_kazifashoin_house_website", "Total@1010", "guidelin_kazifashion_house");
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
 
// Attempt select query execution
$sql = "SELECT count(id) FROM customer_registration where flag='0'";
if($result = $mysqli->query($sql)){
    if($result->num_rows > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </th>";
                echo "<th>Pending Customer</th>";
            echo "</tr>";
        while($row = $result->fetch_array()){
            echo "<tr>";
                echo "<th> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </th>";
                echo "<td> &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;" . $row['count(id)'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        $result->free();
    } else{
        echo "No Pending Customers Found";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}
 
// Close connection
$mysqli->close();

}

?>