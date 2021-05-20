<?php

include_once("LoginSystem-CodeCanyon/cooks.php");
//session_start();
include_once('LoginSystem-CodeCanyon/db.php');
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';


if ( !isset($_SESSION['login']) || $_SESSION['login'] !== true) {
	
	if(empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])){
		
		if ( !isset($_SESSION['token'])) {
			
			if ( !isset($_SESSION['fb_access_token'])) {
				
				$_SESSION['loginmsg'] = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				header('Location: login.php');
				
				exit;
			}
		}
	}
}


if(isset($_SESSION['loginmsg'])){
	
	unset($_SESSION['loginmsg']);
}

$sqlct = "SELECT * FROM Contact WHERE ID = 5 ";
$contactinf = mysqli_query($mysqli, $sqlct);
$contactinf = mysqli_fetch_assoc($contactinf);

$sql = "SELECT * FROM SocialNetworks WHERE Social_Name = 'Twitter' ";
$result = mysqli_query($mysqli, $sql);
$twitter = mysqli_fetch_assoc($result);
$twitter = $twitter['URL'];

$sql = "SELECT * FROM SocialNetworks WHERE Social_Name = 'Facebook' ";
$result = mysqli_query($mysqli, $sql);
$facebook = mysqli_fetch_assoc($result);
$facebook = $facebook['URL'];

$sql = "SELECT * FROM SocialNetworks WHERE Social_Name = 'Google' ";
$result = mysqli_query($mysqli, $sql);
$google = mysqli_fetch_assoc($result);
$google = $google['URL'];


$sql = "SELECT * FROM SocialNetworks WHERE Social_Name = 'Instagram' ";
$result = mysqli_query($mysqli, $sql);
$instagram = mysqli_fetch_assoc($result);
$instagram = $instagram['URL'];


$sql = "SELECT * FROM SocialNetworks WHERE Social_Name = 'Delivrmat' ";
$result = mysqli_query($mysqli, $sql);
$plugin = mysqli_fetch_assoc($result);
echo($plugin['HTML']);


$sql = "SELECT * FROM users WHERE username = '".$_SESSION['username']."' ";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_assoc($result);


if($row["Profile_Pic"] != ""){
    $profilepic = $row["Profile_Pic"];
}else{
$profilepic ="images/avatar.jpg";
}


if($row['Type'] == "Test"){

$sql2 = "SELECT * FROM `Keys` WHERE `ID` = 3 ";
$result2 = mysqli_query($mysqli, $sql2);
$keys = mysqli_fetch_assoc($result2);

}else{


$sql2 = "SELECT * FROM `Keys` WHERE `ID` = 11 ";
$result2 = mysqli_query($mysqli, $sql2);
$keys = mysqli_fetch_assoc($result2);

}



$sql = "SELECT * FROM users WHERE username = '".$_SESSION['username']."' ";
$confirm= mysqli_query($mysqli, $sql);
$confirm= mysqli_fetch_assoc($confirm);



if($confirm['Terms'] != "True"){
	
	
	echo'<script>
window.location.href = "agreement.php";
</script>';
	
	
}else if($confirm['Address'] == "" || $confirm['City'] == "" || $confirm['State'] == "" || $confirm['Zip'] == "" || $confirm['Phone_Confirmed'] == "False" || $confirm['Stripe'] == "" || $confirm['Phone'] == 0){
	
	
	echo'<script>
						window.location.href = "confirm.php";
			</script>';
	
}





?>
<html>
	<head>
		<link rel="icon" 
      type="image/jpg" 
      href="../images/app-logo.png">
	    
		<title><?php echo $contactinf['Name']; ?> | My Account</title>
		
			<?php 	
		
		echo'
<meta name="description" content="'.$contactinf['Name'].' is a laundry delivery service. Download the '.$contactinf['Name'].' App today!">
<meta name="application-name" content="'.$contactinf['Name'].'">
<meta name="author" content="ICI Technologies LLC">

 <meta name="keywords" content="'.$contactinf['Name'].' account, '.$contactinf['Name'].' my account,'.$contactinf['Name'].',laundry app,laundry delivery app,laundry delivery,deliver laundry,laundry delivery service,delivery my laundry,laundry service,laundry pickup,pickup my laundry,
laundromat delivery service,laundromat app,laundromat pickup">';  

		$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";



echo'<!-- Twitter Card data -->
<meta name="twitter:title" content="'.$contactinf['Name'].' | My Account" >
<meta name="twitter:card" content="summary" >
<meta name="twitter:site" content="@publisher_handle" >
<meta name="twitter:description" content="'.$contactinf['Name'].' is a laundry delivery service. Download the '.$contactinf['Name'].' App today!" >
<meta name="twitter:creator" content="@author_handle" >
<meta name="twitter:image" content="https://'.$_SERVER['SERVER_NAME'].'/images/app-logo.png" >



<!-- Open Graph data -->
<meta property="og:title" content="'.$contactinf['Name'].' | My Account" />
<meta property="og:url" content="'.$actual_link.'" />
<meta property="og:image" content="https://'.$_SERVER['SERVER_NAME'].'/images/app-logo.png" />
<meta property="og:description" content="'.$contactinf['Name'].' is a laundry delivery service. Download the '.$contactinf['Name'].' App today!" /> 
<meta property="og:site_name" content="'.$contactinf['Name'].'" />';
		
		
		?>
		
		
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<script src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script>

function myvalFunction() {

var file= document.getElementById('fileToUpload').files[0].name;
       var reg = /(.*?)\.(jpg|jpeg|png|gif|GIF|PNG|JPEG|JPG)$/;
       if(!file.match(reg))
       {

event.preventDefault();
    	   alert("Invalid File");
    	   return false;
       }else{

document.getElementById("myForm2").submit();
}






}
</script>
		<style>
		    
		    input[type="submit"],
	input[type="reset"],
	input[type="button"],
	.button {
	    padding-left:10px !important; 
	    padding-right:10px !important;
	    
	}
		    
		</style>
	
	

<script type="text/javascript" src="https://js.stripe.com/v1/"></script>
        <!-- jQuery is used only for this example; it isn't required to use Stripe -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script type="text/javascript">
            // this identifies your website in the createToken call below
   Stripe.setPublishableKey("<?php echo $keys['Key']; ?>");
            function stripeResponseHandler(status, response) {
                if (response.error) {
                    // re-enable the submit button
                    $('.submit-button').removeAttr("disabled");
                    // show the errors on the form
                    $(".payment-errors").html(response.error.message);
                } else {
                    var form$ = $("#payment-form").attr('action', 'Backend/updatepayment.php');
                    
                    
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                    // and submit
                    form$.get(0).submit();
                }
            }
            $(document).ready(function() {
                $("#payment-form").submit(function(event) {
                    // disable the submit button to prevent repeated clicks
                    $('.submit-button').attr("disabled", "disabled");
                    // createToken returns immediately - the supplied callback submits the form if there are no errors
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                    return false; // submit from callback
                });
            });
        </script>
        
        
      
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//d79i1fxsrar4t.cloudfront.net/jquery.liveaddress/5.1/jquery.liveaddress.min.js"></script>
<script>var liveaddress = $.LiveAddress({
	key: "13690045101805762",
	debug: true,
	target: "US",
	addresses: [{
		address1: '#street-address',
		locality: '#city',
		administrative_area: '#state',
		postal_code: '#zip',
		country: '#country'
	}]
});
</script>
	
	<!-- Matomo -->
<script type="text/javascript">
  var _paq = _paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//www.icitechnologies.com/piwik/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '5']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Code -->
	
	</head>
	
	<body class="is-preload">

		<!-- Header -->
			<section id="header" style="height:100%;">
				<header>
				    
				    <?php
				    
				    echo'
					<span class="image avatar"><a href="account.php"><img style="width:50%;" src="../images/app-logo-transparent.png" alt="" /></a></span>';
					
					
					?>
					<h1 id="logo"><a href="home.php">Welcome
					
					
					<?php echo $row['First_Name'];?></a></h1>
				
				</header>
				<nav id="nav">
					<ul>
						<li><a href="home.php" >Home</a></li>
						<li><a href="recent.php" >My Recent Orders</a></li>
						<li><a href="promopage.php" >Promo Codes</a></li>
						<li><a href="account.php" class="active">Account</a></li>
						<li><a href="driver.php" target="_blank">Become A Driver</a></li>
						<li><a href="Backend/logout.php">Logout</a></li>
					</ul>
				</nav>
				<footer>
			      <?php
				    
					echo'<ul class="icons">
						<li><a href="'.$twitter.'" target="_blank" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="'.$facebook.'" target="_blank" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="'.$instagram.'" target="_blank" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						
						<li><a href="mailto:'.$contactinf['Email'].'" class="icon fa-envelope"><span class="label">Email</span></a></li>
						
					</ul>';
					
					?>
				</footer>
			</section>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">

						<!-- One -->
							<section id="one">
							
								<?php
						
						echo'<div class="container">
									<header class="major">
										<h2>My Account</h2>
							</header>';
							
							
							
							require_once 'includes/Mobile-Detect-master/Mobile_Detect.php';
$detect = new Mobile_Detect;


					//		echo'<span  style="width:20%; text-align:center;"  class="image avatar"><a href="account.php"><img src="'.$profilepic.'" alt="" /></a></span><br><br>';
							

							


if(isset($_SESSION['accountf'])){
	
	echo'<h4>'.$_SESSION['accountf'].'</h4>';
	
	unset($_SESSION['accountf']);
}

						echo'	<form method="post" id="myForm2" name="write"  enctype="multipart/form-data" onSubmit="myvalFunction()"   action="Backend/updateaccountinfo.php">';
						
						
						$sql = "SELECT * FROM users_social WHERE username = '".$_SESSION['username']."' ";
						$ss= mysqli_query($mysqli, $sql);
						
						
						
						if($ss->num_rows == 0){
							 echo'   <input type="file" style="display:none;" name="fileToUpload" id="fileToUpload" >
							    ';
						}
							 
						
						$sql = "SELECT * FROM users_social WHERE username = '".$_SESSION['username']."' ";
						$confirm2= mysqli_query($mysqli, $sql);
						
						
						if($confirm2->num_rows == 0){
								echo'Username: <input type="text" name="username" value="'.$row['username'].'" required><br>';
						}else{
							
							echo'<input type="hidden" name="username " value="'.$row['username'].'">';
						}
										
							    echo'Email: <input type="email" name="email" value="'.$row['email'].'" required><br>
							    Phone (10 digits - numbers only): <input type="number" name="phone" value="'.$row['Phone'].'" min="1000000000" max="9999999999" style="width:100%;" required><br><br>
							    <input type="submit" value="Save" >
							    
							    
							</form>';
						
						
							    
							    
							    
							    
							    //start password change
							    
							    $sqlpass = "SELECT * FROM users_social WHERE username = '".$_SESSION['username']."' ";
							    $resultpass = mysqli_query($mysqli, $sqlpass);
							    
							    
							    
							    if($resultpass->num_rows == 0){
							    	
							    	echo'<button class="button" id="changehe" style="font-size:100%;" onClick="showpassdiv()">Change Password</button>';
							    	
							    	
							    	if(isset($_SESSION['passwordmess'])){
							    		
							    		if($_SESSION['passwordmess'] == "Your password was updated successfully!"){
							    			echo'<h4 style="color:green;">'.$_SESSION['passwordmess'].'</h4>';
							    		}else{
							    			
							    			echo'<h4 style="color:red;">'.$_SESSION['passwordmess'].'</h4>';
							    		}
							    		
							    		
							    		
							    		unset($_SESSION['passwordmess']);
							    	}
							    	
							    	
							    	echo'<script>
		
function showpassdiv(){
		
document.getElementById("passdiv").style.display = "block";
}
		
		
function review(){
		
 var newpass = document.getElementById("newpass").value;
var cnewpass = document.getElementById("cnewpass").value;
		
if(newpass != cnewpass){
alert("Passwords do not match. Please confirm your new password.");
event.preventDefault();
		
return false;
}
		
}
		
</script>
<div id="passdiv" style="display: none;">
<form action="LoginSystem-CodeCanyon/updatepasswordsecured.php" method="post" onsubmit="review()">
Old Password:
<input type="password" placeholder="Old Password" name="oldpassword" required>
New Password:
<input type="password" placeholder="New Password" id="newpass" name="password" required>
Confirm Password:
<input type="password" placeholder="Confirm New Password" id="cnewpass" name="cpassword" required><br>
<input type="submit">
</form>
</div>
';
							    	
							    }
							    
							    //end password change
							    
							    
							    
							    
							    
							    
							    
							    
							    
							    
							    
							    
						
						echo'<br><br><style>
						ul.action {
							list-style-type: none;
							margin: 0;
							padding: 0;
							overflow: hidden;
							
						}
						
						li.action {
							float: left;
						}
						
						
						
						</style>
						
<h3>Update Payment Info</h3><div id="updatediv">';
						
						
							if(isset($_SESSION['paymessage'])){
							echo'<h4>'.$_SESSION['paymessage'].'</h4>';
								unset($_SESSION['paymessage']);
							
							}
						
						
						
						if($row['CardName'] == ""){	
							
							
							
							
							echo'<form method="post" action="Backend/updatepayment.php" id="payment-form">';
							
						
						echo'<div class="form-row">
						<label>Card Name</label>
						<input type="text" name="cardname"  required/>
						</div>
		
						<div class="form-row">
						<label>Card Number</label>
						<input type="text" size="20" maxlength="20" autocomplete="off" class="card-number"  required/>
						</div>
						<div class="form-row">
						<label>CVC</label>
						<input type="text" size="4" maxlength="4" autocomplete="off" class="card-cvc"  required/>
						</div>
						<div class="form-row">
						<label>Expiration (MM/YYYY)</label>
						<ul class="action">
		
						<li class="action"><input type="text" size="2" maxlength="2" style="width:80px;" class="card-expiry-month"  required/></li>
						<li class="action"><span> / </span></li>
						<li class="action"><input type="text" size="4" maxlength="4" style="width:100px;" class="card-expiry-year"  required/></li>
		
						</li>
						</ul>
						</div> <br><button class="button" style="font-size:100%;" type="submit" class="submit-button">Update</button></form>
						';
							
							
						
					
						
						
						
						
							echo'
							
						<div id="address">
							<h3>Address</h3>
	    		
	    		
	    		
<form action="Backend/updateaddress.php" method="post"  enctype="multipart/form-data">Address:<input type="text" id="street-address" name="street-address" value="'.$row['Address'].'" required><br>
					Unit:<input type="text" id="unit" value="'.$row['Unit'].'" name="unit"><br>
					City:<input type="text" id="city" name="city" value="'.$row['City'].'" required><br>
					State:<input type="text" id="state" value="'.$row['State'].'" name="state" required><br>
					Zip:<input type="text" id="zip" value="'.$row['Zip'].'" name="zip" required><br>
                    		
						Special Instructions:<input type="text" id="instructions" value="'.$row['Special_Instructions'].'" name="instructions"><br>
					<input type="submit">
					</form></div>';
							
							
							
							
						}else {
							
echo'<form method="post" action="Backend/updatepayment.php" id="payment-form">
						<div class="form-row">
						<label>Card Name</label>
						<input type="text" name="cardname" value="'.$row['CardName'].'" required/>
						</div>
						
						<div class="form-row">
						<label>Card Number</label>
						<input type="text" size="20" maxlength="20" autocomplete="off" class="card-number" placeholder="XXXX - XXXX - XXXX - XXXX" required/>
						</div>
						<div class="form-row">
						<label>CVC</label>
						<input type="text" size="4" maxlength="4" autocomplete="off" class="card-cvc" placeholder="XXX" required/>
						</div>
						<div class="form-row">
						<label>Expiration (MM/YYYY)</label>
						<ul class="action">
						
						<li class="action"><input type="text" size="2" maxlength="2" style="width:80px;" class="card-expiry-month" placeholder="XX" required/></li>
						<li class="action"><span> / </span></li>
						<li class="action"><input type="text" size="4" maxlength="4" style="width:100px;" class="card-expiry-year" placeholder="XXXX" required/></li>
						
						</li>
						</ul>
						</div> <br><button class="button" style="font-size:100%;" type="submit" class="submit-button">Update</button></form>';
						
							
							echo'
							<div id="address">
							<h3>Address</h3>



<form action="Backend/updateaddress.php" method="post"  enctype="multipart/form-data">Address:<input type="text" id="street-address" name="street-address" value="'.$row['Address'].'" required><br>	
					Unit:<input type="text" id="unit" value="'.$row['Unit'].'" name="unit"><br>	
					City:<input type="text" id="city" name="city" value="'.$row['City'].'" required><br>
					State:<input type="text" id="state" value="'.$row['State'].'" name="state" required><br>
					Zip:<input type="text" id="zip" value="'.$row['Zip'].'" name="zip" required><br>
					
						Special Instructions:<input type="text" id="instructions" value="'.$row['Special_Instructions'].'" name="instructions"><br>
					<input type="submit" value="Save">
					</form></div>';
								
						}
					
								echo'<a href="mailto:'.$contactinf['Email'].'">Contact Us</a><br><br>';
						
						echo'<div id="deletediv" style="display:none; padding-top:20%;">
                    		
								Are you sure you want to delete your '.$contactinf['Name'].' profile?
								<br><Br>
								<form method="post" action="delete.php">
								<input type="hidden" name="ID" value="'.$row['id'].'">
								<input type="submit" value="Delete">
                    		
                    		
							</form>
                    		
                    		
								</div>';
						
								?>
								
						</div>		

				
					
				
							</section>

					

					

					

					

					</div>
<script>

function showd(){

	document.getElementById("deletediv").style.display = "block";
	document.getElementById("dbut").style.display = "none";
}




</script>


				<!-- Footer -->
				<?php echo'<section id="footer">
						<div class="container">
							<ul class="copyright">
								<li><a href="http://icitechnologies.com" target="_blank">&copy;
ICI Technologies LLC All rights reserved.</a></li>
<li><a href="https://'.$_SERVER['SERVER_NAME'].'/legal/delivrmat-privacy-policy.php">Privacy Policy</a></li>
<li><a href="https://'.$_SERVER['SERVER_NAME'].'/legal/delivrmat-terms-conditions.php">Terms</a></li>
							</ul>
						</div>
					</section>'; ?>

			</div>




		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>