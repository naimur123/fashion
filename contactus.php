<?php
	if( ! ini_get('date.timezone') )
    {
        date_default_timezone_set('GMT');
    }
    ob_start();
    include('header.php');
	if (isset($_POST["submit"])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['msg'];
		$phone = $_POST['phone'];
		
		$to='totalbazarbd@gmail.com'; // Receiver Email ID, Replace with your email ID
		$subject='Total Bazar';
		$message="Name :".$name."\n"."Phone :".$phone."\n"."Wrote the following :"."\n".$message;
		$headers="From: ".$email;
 
		// Check if name has been entered
		if (!$_POST['name']) {
			$errMSG = 'Please enter your name';
		}
		
		// Check if email has been entered and is valid
	   else	if (!$_POST['email']) {
			$errMSG = 'Please enter an email address';
		}
		
		//Check if message has been entered
	  else if (!$_POST['msg']) {
			$errMSG = 'Please enter your message';
		}
		
	
        if(mail($to, $subject, $message, $headers))
        {
            $successMSG = "Sent Successfully! Thank you"." ".$name.", We will contact you shortly!";
			header("refresh:3;contactus.php"); // redirects image view page after 5 seconds.
		}
		else
		{
			 $errMSG = 'Email Not Sent Successfully';
			//header("refresh:3;contactus.php"); // redirects image view page after 5 seconds.
		}
		
	}
?>





<style>
	
	/*Font-awesome integration*/
@import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
/*Google font integration*/
@import url('https://fonts.googleapis.com/css?family=Roboto');

#contact{
    background-color:#f1f1f1;
    font-family: 'Roboto', sans-serif;
}

#contact .well{
    margin-top:30px;
    border-radius:0;
}

#contact .form-control{
    border-radius: 0;
    border:2px solid #1e1e1e;
}

#contact button{
    border-radius:0;
    border:2px solid #1e1e1e;
}

#contact .row{
    margin-bottom:30px;
}

@media (max-width: 768px) { 
    #contact iframe {
        margin-bottom: 15px;
    }
    
}

</style>

<?php ?>

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


<!------ Include the above in your HEAD tag ---------->

<section id="contact">
  <div class="container">

	<div class="row">
	  
      <div class="col-md-6">
        
		
			<h2 class="h2" style="color:#3498DB"><strong>Contact Us</strong></h2>
		
			<h4 class="h4" style="color:#3498DB"><strong>Contact Information</strong></h4>
		
		
        <form name="contactform" method="post">
          <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Name">
          </div>
          <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="E-mail">
          </div>
          <div class="form-group">
            <input type="tel" class="form-control" name="phone" placeholder="Phone">
          </div>
          <div class="form-group">
            <textarea class="form-control" id="msg" name="msg" rows="3" placeholder="Message"></textarea>
          </div>
		  <div class="form-group" align="right">
			<button type="submit" name="submit"  class="btn btn-primary"><b> <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Send Message</b></button>
		  </div>
        </form>
      </div>
    
	  <div class="col-md-6">
			
			<br/>
			<br/>
			<br/>
			<h3 class="h3" style="color:#3498DB"><strong>Location</strong></h3>

			<h5 class="h5"><strong><span class="glyphicon glyphicon-map-marker" style="color:#F14F12"></span> Address: </strong>57, Distrilary Road, Gandaria, Dhaka</h5>
			<h5 class="h5"><strong><span class="glyphicon glyphicon-envelope" style="color:#F14F12"></span> Email: </strong>totalbazarbd@gmail.com</h5>
			<h5 class="h5"><strong><span class="glyphicon glyphicon-earphone" style="color:#F14F12"></span> Contact: </strong>01977868411,01977868484</h5>
				
	  
	  </div>
	  
	  
	</div>
  </div>
</section>

<br/>
<br/>

<?php include('footer.php');?>