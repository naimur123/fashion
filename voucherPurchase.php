<?php
	// if( ! ini_get('date.timezone') )
    // {
    //     date_default_timezone_set('GMT');
    // }
	include("pageurl.php");
	// include ('include/config/dbConfig.php');
	include("header.php");
   
    $servername = "localhost";
    $username = "guidelin_kazifashoin_house_website";
    $password = "Total@1010";
    $dbname = "guidelin_kazifashion_house";

    // Create connection
    $db = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
      }
    $user_id = $_SESSION['userid'];
    // $amount = $_SESSION['amount'];
    $transaction_id = rand();
    $status = "0";
    $create_by = $_SESSION['userid'];
   
    $id = $_SESSION['id'];
    $query = $db->query("SELECT card_amount FROM gift_card where id='$id'");
    if($query->num_rows > 0){ 
        while($row = $query->fetch_assoc()){
            $amount = $row['card_amount'];

            $sql = "INSERT INTO transaction (transaction_id, transaction_amount, user_id , status,  create_by)
            VALUES ( $transaction_id, $amount,  $user_id, '0',  $create_by)";

            if (mysqli_query($db, $sql)) {
                echo "Pending";
                $_SESSION['amount'] = $amount;
                } 
            else {
                echo "Error: " . $sql . "<br>" . $db->error;
                }
                }
            }

    
    // $date=date_create("2013-05-25",timezone_open("Indian/Kerguelen"));
    // $create_date = date_format($date,"Y-m-d H:i:sP");
    // $create_date =$timezone; 
    // $create_date = DateTimeInterface::format();
    // $create_date = ($now->format('Y-m-d'));

    

    // $statement = $db->prepare("INSERT INTO transaction (transaction_id, transaction_amount, user_id , status , create_by, create_date	
    // ) VALUES (:transaction_id, :transaction_amount, :user_id, :card_validity_to, :card_amount, :status, :create_by, Now())");
    // $result = $statement->execute(
    //     array(
    //         ':transaction_id'	=>	$transaction_id,
    //         ':transaction_amount'	=>	$amount,
    //         ':user_id'	=>	$user_id,
    //         ':status'	=>	$status,
    //         ':create_by'	=>	$user_id,
            
    //     )
    // );
    // if(!empty($result))
	// 	{
	// 		echo 'Pending';
	// 	}
	// 	else
	// 	{
	// 		echo 'Error';
	// 	}
?>
<div class="">
    
    <div class="col-md-6">
					
	<a href="index.php" <?php  unset($_SESSION['amount']); ?> class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Shopping</a>
				
	</div>
</div>