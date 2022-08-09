
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<!-- <link rel="stylesheet" type="text/css" href="./include/css/foooter.css"> -->
    <link rel="stylesheet" href="./include/css/foooter.css" />

<!-- <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    
<script>
    $(document).ready(function(){
        $value = $('#cart_val').val();
        if($value > 0){
            $('#place-order').show();
            $('#continue-shoping').hide();
        }else{
            $('#place-order').hide();
            $('#continue-shoping').show();
        }
    });
    function go(ids){
            
				$.ajax({
                    url:'insertCart.php',
                    method:'POST',
                    data:{
                        id:ids,
						qty:1
                    },
                    success:function(data){
                        // alert(data);
                        $('#span').html(''+data+'');
                   }
                });
			}

			function decrease(id){
				var x = document.getElementById(id);				
				var a = parseInt(x.value);	
				if(a>1){
				a = a-1;
				}				
				x.value = a;
				
			}
			function increase(id){
				var x = document.getElementById(id);
				var a = parseInt(x.value);
				a = a+1;
				x.value = a;
			}
</script>

<br/>

<footer>
    <div class="footer" id="footer">
        <div class="container">
			
			<!-- <div class="row">
				<div>
                    <img src="admin/include/logo.png" alt="Kazi Fashion House" height="100px">	
                </div>
				<!-- <div class="col-lg-10  col-md-10 col-sm-10 col-xs-12">
                    <p class="lead">Out of the traditional market system, the name of a modern and technologically marketable market is Kazi Fashion'</p>
                </div> -->
			<!-- </div> -->

			
            <div class="row">
                <div class="col-lg-3  col-md-3 col-sm-6 col-xs-6">
                    <img src="admin/include/logo.png" alt="Kazi Fashion House" height="100px">
                    <p style="color:#D9A84E;margin-top: 8px; margin-left: -55px; font-size: 18px;">KAZI FASHION HOUSE</p>	
                </div>
                <div class="col-lg-3  col-md-3 col-sm-6 col-xs-6">
                    <h3 class="h3" style="margin-top: -8px; margin-left: -82px;"> Product Category</h3>
                    <ul style="margin-left: -82px;">
                        <li> <a href="homedecors.php"> Home DECOR </a> </li>
                        <li> <a href="officeaccessorieses.php">  OFFICE ACCESSORIES </a> </li>
                        <li> <a href="gifts.php">  GIFT CORNERS</a> </li>
                        <li> <a href="jewelerys.php"> JEWELERY CORNERS </a>  </li>
						<li> <a href="todaySpecials.php"> TODAY'S SPECIAL </a> </li>
                    </ul>
                </div>
                
                <div class="col-lg-3  col-md-3 col-sm-6 col-xs-6">
                    <h3 class="h3" style="margin-top: -8px; margin-left: -92px;"> Customer Service </h3>
                    <ul style="margin-left: -92px;">
                        <li> <a href="#"> CONTACT US </a> </li>
                        <li> <a href="#"> ABOUT US </a> </li>
                        <li> <a href="#"> PRIVACY POLICY </a> </li>
                        <li> <a href="#"> FAQS </a> </li>
						<li> <a href="#"> TERMS OF USE </a> </li>
                    </ul>
                </div>
                <div class="col-lg-3  col-md-3 col-sm-6 col-xs-6">
                    <h3 class="h3" style="margin-top: -8px; margin-left: -125px;"> Payment Option </h3>
                    <ul>
                        <li style="margin-top: -60px; margin-left: -26px;"><img src="include/images/b-01.svg" alt="Bkash" height="40px"> &nbsp; &nbsp; &nbsp; &nbsp; <img src="include/images/n-01.svg" alt="Cash on Delivery" height="60x"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <img src="include/images/r-01.svg" alt="rocket" height="40px"></li>
                    </ul>
                </div>
                <div class="col-lg-3  col-md-3 col-sm-6 col-xs-12 ">
                    <h3 class="h3" style="margin-top: -184px; margin-left: 125px;"> Be Connected </h3>
                    <ul class="social" style="margin-left: 125px;"> 
						<li><a href="#"><i class="fa-brands fa-facebook-f" style="font-size: 24px; color:#00414D; margin-top: 10px;"></i></a></li>
						<li><a href="#"><i class="fa-brands fa-twitter" style="font-size: 24px; color:#00414D; margin-top: 10px;"></i></i></a></li>
						<!-- <li><a href="#"><i class="fa fa-lg fa-google-plus"></i></a></li>
						<li><a href="#"><i class="fa fa-lg fa-pinterest"></i></a></li> -->
                        <li><a href="#"><i class="fa-brands fa-instagram" style="font-size: 24px; color:#00414D; margin-top: 10px;"></i></a></li>
                        <!-- <li><a href="#"><i class="fa fa-lg fa-youtube-play"></i></a></li> -->
                    </ul>
                </div>
            </div>
            <!--/.row--> 

        <!--/.container--> 
    </div>
    <!--/.footer-->
    </div>
    
    <div class="footer-bottom">
        <div class="container">
            <p class="pull-left"> Copyright &copy; Kazi Fashion. All right reserved. </p>
            <div class="pull-right">
                
            </div>
        </div>
    </div>
    <!--/.footer-bottom--> 
</footer>