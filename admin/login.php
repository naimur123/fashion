<?php
	if( ! ini_get('date.timezone') )
    {
        date_default_timezone_set('GMT');
    }
    require_once ('dbconfigin.php');
    // Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
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
        $sql = "SELECT id,email FROM admin_user WHERE email = :pemail and pass=:pconfpass";
        
        if($stmt = $DB_con->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':pemail', $param_username, PDO::PARAM_STR);
            $stmt->bindParam(':pconfpass', $param_pass, PDO::PARAM_STR);
            // Set parameters
            $param_username = trim($_POST["username"]);
			$param_pass = trim($_POST["password"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                            session_start();
							$_SESSION['email_name_total'] = $username; 
							$_SESSION['userid_total'] = $row['id'];
							$_SESSION['signed_in'] = true;
							//$_SESSION['timeout'] = time();
                            header("location: index.php");
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $messageerror = 'No account found with that email.';
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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kazi Fashion Login</title>
</head>

<body>
			<br/>
			<br/>
			<br/>
	
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
			
			<div class="col-md-4" align="center">
				<b><h2 class="h2">Admin Login</h2></b>
				<div class="panel panel-default">
					
					<div class="panel-heading">
						<h3 class="panel-title">Please fill in your credentials to login</h3>
					</div>
					
					<div class="panel-body">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
							<label>User Email</label>
							<input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
							<span class="help-block"><?php echo $username_err; ?></span>
						</div>    
						<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
							<label>User Password</label>
							<input type="password" name="password" class="form-control">
							<span class="help-block"><?php echo $password_err; ?></span>
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-lg btn-success btn-block" value="Login">
						</div>
						
						</form>
					</div>
				
				</div>
			</div>

			<div class="col-md-4">
			
			</div>

		</div>
		
	</div>
    
</body>
</html>