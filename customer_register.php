<?php
	if( ! ini_get('date.timezone') )
    {
        date_default_timezone_set('GMT');
    }
	include('header.php');
	require_once 'include/config/dbconcus.php';
	
	error_reporting( ~E_NOTICE ); // avoid notice
	
	if(isset($_POST['btnsave']))
	{
		// $vfullname= trim($_POST['full_name']);// full name
		// $vemail= trim($_POST['email']);// Email
		$vphone= trim($_POST['phonenum']);// Phone
		// $vaddress= trim($_POST['presentadd']);// Address
		// $vcusarea= trim($_POST['areaname']);// Area
		$vconfpass= trim($_POST['password_confirmation']);// Password
		$flag='1';
		require_once('include/config/config.php');
		// $duplicate=$dbcon->prepare('select email,phone from customer_registration where email=:pemail or phone=:pphone');
		$duplicate=$dbcon->prepare('select phone from customer_registration where phone=:pphone');
		// $duplicate->bindParam(':pemail', $vemail);
		$duplicate->bindParam(':pphone', $vphone);
		$duplicate->execute();
		
		if ($duplicate->rowCount()!=0){
		
			$errMSG = "Already You are Registered!";
		}
		// if no error occured, continue ....
		else		
		{
			// $stmt = $DB_con->prepare('INSERT INTO customer_registration (full_name,email,phone,address,customer_area,conf_pass,flag,create_date) VALUES(:pfname, :pemail, :pphone, :paddress, :pcusarea, :pconfpass, :pflag, Now())');
			$stmt = $DB_con->prepare('INSERT INTO customer_registration (phone,conf_pass,flag,create_date) VALUES(:pphone, :pconfpass, :pflag, Now())');
			
			// $stmt->bindParam(':pfname',$vfullname);
			// $stmt->bindParam(':pemail',$vemail);
			$stmt->bindParam(':pphone',$vphone);
			// $stmt->bindParam(':paddress',$vaddress);
			// $stmt->bindParam(':pcusarea',$vcusarea);
			$stmt->bindParam(':pconfpass',$vconfpass);
			$stmt->bindParam(':pflag',$flag);
			
			if($stmt->execute())
			{
				$successMSG = "Your Registration Succesfully Submitted";
				//header("refresh:5;customer_register.php"); // redirects image view page after 5 seconds.
			}
			else
			{
				$errMSG = "Error While Inserting!";
			}
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    

	
	<script type="text/javascript">
		function validateForm() {
    // var fullname = document.forms["myForm"]["full_name"].value;
	// var emailid = document.forms["myForm"]["email"].value;
	var phone_number = document.forms["myForm"]["phonenum"].value;
	// var present_address = document.forms["myForm"]["presentadd"].value;
	// var areazone = document.forms["myForm"]["areaname"].value;
	var pass = document.forms["myForm"]["password"].value;
	var conpass = document.forms["myForm"]["password_confirmation"].value;
	
	var atpos = emailid.indexOf("@");
    var dotpos = emailid.lastIndexOf(".");
   	
    // if (fullname == "") {
    //     alert("Please insert your full name");
    //     return false;
    // }
	// else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=emailid.length) {
    //     alert("Please insert your valid email id");
    //     return false;
    // }
	if (phone_number == "") {
        alert("Please insert your phone number");
        return false;
    }
	// else if (present_address == "") {
    //     alert("Please insert your present address");
    //     return false;
    // }
	// else if (areazone == "") {
    //     alert("Please select your area");
    //     return false;
    // }
	else if (pass.length<6) {
        alert("Please insert at least 6 digit password");
        return false;
    }
	else if (conpass.length<6) {
        alert("Please insert at least 6 digit confirm password");
        return false;
    }
	else if (pass.length>20){
        alert("Please insert maximum 20 digit password");
        return false;
    }
	else if (conpass.length>20){
        alert("Please insert maximum 20 digit confirm password");
        return false;
    }

}
</script>

	<script type="text/javascript">

function checkPass()
{
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('password');
    var pass2 = document.getElementById('password_confirmation');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1.value == pass2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Match!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Do Not Match!"
    }
}  


</script>
<style>
	 /* #img{
	   background-image: url("./include/images/box.png");
	   width: 100%;
   }  */
   /* #form{
	  
	   padding: 20px 30px 20px 10px;
   }
   */
  
  input {
        border-top-style: hidden;
        border-right-style: hidden;
        border-left-style: hidden;
        /* border-bottom-style: groove; */
        background-color: #F4EED1;
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

<div class="container-fluid">
	
        <div class="row">
		
		<div class="col-md-4">
				
		</div>
		<img src="./include/images/regbox.png" style="pointer-events: none; margin-left:-44%; height:80%;">
        <div class="col-md-4" style=" margin-top: 15em;">
			
			<!-- <div align="center" id="form"> -->
				<!-- <h3 class="h3"><b>Customer Registration</b></h3> -->
				<!--  -->
				
				<form name="myForm" onsubmit="return validateForm()" method="post" >
				<!-- <div style=" margin-top: -400px;"> -->
				            <h2> <b>Sign UP</b> </h2>
			    			<!-- <div class="form-group">
							</i><input type="text" name="full_name" id="full_name" class="form-control input-sm" placeholder="Full Name">
			    			</div> -->

			    			<!-- <div class="form-group">
			    				<input type="text" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
			    			</div> -->
							<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
							<i class="fa-solid fa-phone-flip"></i>&nbsp;<input type="text" name="phonenum" id="phonenum" class="no-outline" placeholder="Phone Number">
							<!-- <input type="text" class="no-outline" placeholder="Enter Something"> -->
							</div>
							
			    			</div>

							</div>
							
							
							<!-- <div class="form-group">
								<textarea name="presentadd" id="presentadd" class="form-control input-sm" placeholder="Present Address"></textarea>
			    				
			    			</div> -->
							
							<!-- <div class="form-group">
			    				<select class="form-control round" name="areaname" id="areaname">
							<option value="">Select Your Area</option>
                            <?php
									require_once 'include/config/config.php';
									$a_flag ='1';
									$stmt = $dbcon->prepare('SELECT area_name FROM customer_area where area_flag=:aflag order by area_name');
									$stmt->bindParam(':aflag', $a_flag);
									$stmt->execute();
        
									while($row=$stmt->fetch(PDO::FETCH_ASSOC))
									{
										extract($row);
							?>
									<option value="<?php echo $area_name; ?>"><?php echo $area_name; ?></option>
							
							<?php
									}
							?>
								</select>
			    			</div> -->
							
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    					<i class="fa-solid fa-lock"></i>&nbsp;<input type="password" name="password" id="password" class="no-outline" placeholder="Password">
			    					</div>
			    				</div>
			    			</div>
							<div class="row">
							    <div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
									<i class="fa-solid fa-lock"></i>&nbsp;<input type="password" name="password_confirmation" id="password_confirmation" class="no-outline" placeholder="Confirm Password" onkeyup="checkPass(); return false;">
			    					</div>
			    				</div>
							</div>
							
							<!-- <div class="form-group">
								<span id="confirmMessage" class="confirmMessage"></span>
								<p> **At least 6 digit password</p> 
								
							</div> -->
			    			
			    			<input type="submit" value="Register" name="btnsave" class="btn-block" style="width: 20%; height: 5%;border: background 1px; border-radius:  2px; margin-left: 16px;">
							
							<br/>
							
							<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<p style="margin-left: 16px;"><b>Already Member?</b></p>
			    					</div>
			    				</div>
			    				
			    			</div>
							<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<button type="button" style="background-color:#F1CF98; width:42%; height: 5%; border: background 1px; border-radius: 2px; margin-left: 16px;" class="btn-block"><a href="login.php" style="text-decoration:none;color:black" ><b> Login </b></a></button>
			    					</div>
			    				</div>
							</div>
				  </div>
				  <!-- </div> -->
			    		</form>
		
			</div>
				
			
        	<!-- <div class="panel panel-default"> -->
			
				
					
					<?php
	if(isset($errMSG)){
			?>
            <div class="alert alert-danger">
            	<span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
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
					
			
				
			 			<!-- <div class="panel-body"> 
						
			  
						
						
			    	</div> -->
	    		<!-- </div> -->
    		</div>
    	<!-- </div>
    </div> -->
	

	</body>

</html>
<?php include('footer.php') ?>