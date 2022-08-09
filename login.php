<?php
	if( ! ini_get('date.timezone') )
    {
        date_default_timezone_set('GMT');
    }
    ob_start();
    include('header.php');
// Include config file
require_once ('include/config/dbconfigin.php');
//include('header.php');
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter email or phone number.';
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id,email FROM customer_registration WHERE (email = :pemail and conf_pass=:pconfpass and flag=:pflag) or (phone=:pphone and conf_pass=:pconfpass and flag=:pflag)";
        
        if($stmt = $DB_con->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':pemail', $param_username, PDO::PARAM_STR);
			$stmt->bindParam(':pphone', $param_username, PDO::PARAM_STR);
            $stmt->bindParam(':pconfpass', $param_pass, PDO::PARAM_STR);
			$stmt->bindParam(':pflag', $flagid, PDO::PARAM_STR);
            // Set parameters
            $param_username = trim($_POST["username"]);
			$param_pass = trim($_POST["password"]);
            $flagid ='1';
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                            if(!isset($_SESSION)) 
					{ 
						session_start(); 
					} 
							$_SESSION['full_name'] = $username; 
							$_SESSION['userid'] = $row['id'];
							//$_SESSION['valid'] = true;
							//$_SESSION['timeout'] = time();
                            header("location: index.php");
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $messageerror = 'No account found with that Email or Phone Number.';
					//$_SESSION['msgerror'] = $messageerror;
					
                }
            } else{
                $messageerror = "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Kazi Fashion</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- <link rel="stylesheet" href="include/css/menunavbar.css" /> -->
	<link rel="stylesheet" href="include/css/foooter.css" />
    
   <style>
	    input {
        border-top-style: hidden;
        border-right-style: hidden;
        border-left-style: hidden;
        /* border-bottom-style: groove; */
        background-color: #F4EED1;
		width:60%;
		height: 5%;
      }
      
      .no-outline:focus {
        outline: none;
      }
	  .btn-block{
		  background-color: #F1CF98;
		  color: black;
		  font-weight: bold;
		  /* padding: 5px 15px 5px 15px; */
		  
	  }
   </style>
</head>


<body>

	<div class="container">
	
		<div class="row">
		<?php
	if(isset($messageerror)){
			?>
            <div class="alert alert-danger">
            	<span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $messageerror; ?></strong>
            </div>
            <?php
	}
	else if(isset($successMSG)){
		?>
        <div class="alert alert-success">
              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
        </div>
        <?php
	}
	?>   
		</div>
		
		<div class="row">
			
			<div class="col-md-4">
			
			</div>
			
			<img src="./include/images/login.png" style="pointer-events: none; margin-left:-20%; height:80%;">
            <div class="col-md-4" style=" margin-top: -35em; margin-left: 18em;">
				<h2><b>SIGN IN</b></h2>
				<br>
				<!-- <div class="panel panel-default">  -->
					
					<!-- <div class="panel-heading">
						<h3 class="panel-title">Please fill in your credentials to login</h3>
					</div> -->
					
					<!-- <div class="panel-body"> -->
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
							<!-- <label>User Email or Phone No.</label> -->
							<i class="fa-solid fa-circle-user"></i> &nbsp;<input type="text" name="username" placeholder="phone or email" class="no-outline" value="<?php echo $username; ?>">
							<span class="help-block"><?php echo $username_err; ?></span>
						</div>    
						<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
							<!-- <label>User Password</label> -->
							<i class="fa-solid fa-lock-open"></i> &nbsp;<input type="password" name="password" class="no-outline" placeholder="password">
							<span class="help-block"><?php echo $password_err; ?></span>
						</div>
						<div class="form-group">
							<input type="submit" class="btn-block" style="width: 20%; height: 5%; margin-left:22px; border: background 1px; border-radius:  2px;" value="Login">
						</div>
						<div class="form-group"> 
							<p style="font-size: 10px; margin-left:22px;">Don't have an account?</p>
							<button type="button" style="background-color:#F1CF98;margin-left:22px; width:20%; height: 5%; border: background 1px; border-radius:  2px;" class="btn-block"><a href="login.php" style="text-decoration:none;color:black" ><b> Register </b></a></button>
						</div>
						</form>
					<!-- </div> -->
				
				</div>
			</div>

			

		</div>
		
	</div>
</body>
</html>
    
<?php include('footer.php');?>