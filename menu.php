<?php

include_once("LoginSystem-CodeCanyon/cooks.php");
//session_start();
include_once('LoginSystem-CodeCanyon/db.php');
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';



$sql = "SELECT * FROM `Keys` WHERE ID = 9 ";
$taxkey= mysqli_query($mysqli, $sql);
$taxkey= mysqli_fetch_assoc($taxkey);


//require  __DIR__ . '/tax/vendor/autoload.php';
//$client = TaxJar\Client::withApiKey($taxkey['Key']);

$sqlct = "SELECT * FROM Contact WHERE ID = 5 ";
$contactinf = mysqli_query($mysqli, $sqlct);
$contactinf = mysqli_fetch_assoc($contactinf);

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



$sql = "SELECT * FROM users WHERE username = '".$_SESSION['username']."' ";
$confirm= mysqli_query($mysqli, $sql);
$confirm= mysqli_fetch_assoc($confirm);


/**
$taxrates = $client->ratesForLocation($confirm['Zip'], [
		'city' => $confirm['City'],
		'state' => $confirm['State'],
		'country' => 'US'
]); **/


//$taxrates =  $taxrates->combined_rate
$taxrates =  0.0;








if($confirm['Terms'] != "True"){
	
	
	echo'<script>
window.location.href = "agreement.php";
</script>';
	
	
}else if($confirm['Address'] == "" || $confirm['City'] == "" || $confirm['State'] == "" || $confirm['Zip'] == "" || $confirm['Phone_Confirmed'] == "False" || $confirm['Stripe'] == "" || $confirm['Phone'] == 0){
	
	
	echo'<script>
						window.location.href = "confirm.php";
			</script>';
	
}




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


$sqldriver = "SELECT * FROM DriverRates WHERE Unit = 'Minute'";


$driverrates = mysqli_query($mysqli, $sqldriver);
$driverratesminute = mysqli_fetch_assoc($driverrates);




$sqldriver = "SELECT * FROM DriverRates WHERE Unit = 'Mile'";


$driverrates = mysqli_query($mysqli, $sqldriver);
$driverratesmile = mysqli_fetch_assoc($driverrates);




$sql = "SELECT * FROM users WHERE username = '".$_SESSION['username']."' ";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_assoc($result);


if($row["Profile_Pic"] != ""){
    $profilepic = $row["Profile_Pic"];
}else{
$profilepic ="images/avatar.jpg";
}

$ur = str_replace("/Users/","",$_SERVER['REQUEST_URI']);




$sql22 = "SELECT * FROM Laundromat WHERE ID = '".$_GET['storenum']."' ";


$result22 = mysqli_query($mysqli, $sql22);
$launInfo = mysqli_fetch_assoc($result22);

$dayname = date("l");

	require_once 'includes/Mobile-Detect-master/Mobile_Detect.php';
$detect = new Mobile_Detect;


$addadd= $row['Address']." ".$row['Unit']. " ".$row['City'].", ". $row['State']. " ". $row['Zip'];
$launadd= $launInfo['Address']." ".$launInfo['Unit']. " ".$launInfo['City'].", ". $launInfo['State']. " ". $launInfo['Zip'];


	$fromadd = $addadd;
$toadd = $launadd;
$fromadd = urlencode($fromadd);
$toadd = urlencode($toadd);
$dataadd = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?origins=$fromadd&destinations=$toadd&language=en-EN&sensor=false&key=");
$dataadd = json_decode($dataadd);

$distanceadd = 0;
$timeadd =0;
foreach($dataadd->rows[0]->elements as $roadadd) {
    $timeadd += $roadadd->duration->value;
    $distanceadd += $roadadd->distance->value;
}


$milesadd = $distanceadd * 0.000621371;

$duration = $timeadd / 60;




$ratedriver = $duration * $driverratesminute['Rate'];
$ratemile = floatval($milesadd) * floatval($driverratesmile['Rate']);



$ratetotal =  $ratemile;



$estttotal = $ratemile + $ratedriver;
//echo($estttotal);


$sql2 = "SELECT * FROM `Keys` WHERE `ID` = 3 ";
$result2 = mysqli_query($mysqli, $sql2);
$keys = mysqli_fetch_assoc($result2);


?>
<html>
	<head>
	<?php echo'<link rel="icon" 
      type="image/jpg" 
      href="https://'.$_SERVER['SERVER_NAME'].'/images/app-logo.png">'; ?>
	    
		<title><?php echo $contactinf['Name']; ?> | <?php echo $launInfo['Name'];?>'s Products</title>
		
		
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
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<link rel="stylesheet" href="assets/css/main.css" />
		
		<script src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script type="text/javascript" src="http://usmntcenter.com/js/jquery-ui-1.8.21.custom.min.js"></script>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
		
	<?php 
	
	if($row['Stripe'] == ''){
	
	?>
	
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
                    var form$ = $("#payment-form").attr('action', 'Backend/processorder.php');
                    
                    
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
        
        
        <?php }  ?>
			<style>
		    
		    input[type="submit"],
	input[type="reset"],
	input[type="button"],
	.button {
	    padding-left:10px !important; 
	    padding-right:10px !important;
	    
	}
		    
		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
    </style>
		<style>
		    
		    #addid:hover, #phoneid:hover, #inittimehead:hover, #totaltimehead:hover{
		        
		        
		        color: #4acaa8;
		        
		    }
		    
		    
		</style>
		
		<style>
/* The container */
.container2 {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default checkbox */
.container2 input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container2:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container2 input:checked ~ .checkmark {
    background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.container2 input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.container2 .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}

.checkmark{

background:#C0C0C0;

}


</style>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: block; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 0%; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
 
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 100%;
  height:100%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>

<style>
* {box-sizing: border-box}
body {font-family: Verdana, sans-serif; margin:0}
.mySlides {display: none}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 70%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  background-color: rgba(0,0,0,0.8);
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

.prev {
  left: 0;
  border-radius: 3px 0 0 3px;
}


/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}
</style>

<link rel="stylesheet" href="https://rawgit.com/anhr/InputKeyFilter/master/InputKeyFilter.css" type="text/css">		
	<script type="text/javascript" src="https://rawgit.com/anhr/InputKeyFilter/master/Common.js"></script>
	<script type="text/javascript" src="https://rawgit.com/anhr/InputKeyFilter/master/InputKeyFilter.js"></script>




  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="http://rawgit.com/vitmalina/w2ui/master/dist/w2ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://rawgit.com/vitmalina/w2ui/master/dist/w2ui.min.css" />
<style>

 div.w2ui-time{
 
 color:black;
 
 }
</style>


	<?php
	
	echo'<script src="includes/moment.js"></script>
<script>
	
setInterval(function(){ myTotalFunction(); }, 1000);


function myTotalFunction() {
 

 var total = 0;
var totalqty = 0;
var optiontotal = 0;


for (i = 0, len = document.getElementsByClassName("product").length; i < len; i++) { 
  
  


			var x = document.getElementsByClassName("product")[i].value;
		var p = document.getElementsByClassName("price")[i].value;
		


for (T = 0, llen = document.getElementsByClassName("options").length; T < llen; T++) { 			//OPTIONS


var price = document.getElementsByClassName("options")[T].value;
var productname = document.getElementsByClassName("options")[T].value;


//if checked

if(document.getElementsByClassName("options")[T].checked){
var optiontotal = Number(x) * Number(price);

totalqty = totalqty + optiontotal

}



}

var total = Number(x) * Number(p);
		
		
		totalqty = totalqty + total;
		
	
		
		
		
}	




var delivery = document.getElementById("deliverycheck").checked;

var deliveryrate = '.$ratetotal.';


if(deliveryrate < 5){
//var deliveryrate = 2.5
var deliveryrate = 2.495
}

 if(delivery == true){
   // alert("delivery");
   deliverytotal =  Number(deliveryrate) + Number(deliveryrate);
   
   document.getElementById("unavailable").disabled = false;

}else{
    
    deliverytotal =  Number(deliveryrate) ;
    
      document.getElementById("unavailable").disabled = true;
 document.getElementById("deliverytime").disabled = true;
     document.getElementById("deliverytime2").disabled = true;
document.getElementById("unavailable").checked = false;
 document.getElementById("deliverytime").value = "";
     document.getElementById("deliverytime2").value = "";


}


tt2 =  deliverytotal + totalqty;
tt5 = '.$taxrates.';
taxtotal = tt5.toFixed(2) * tt2.toFixed(2);

document.getElementById("Taxtotal").innerHTML  = "$" + taxtotal.toFixed(2);
document.getElementById("Deliverytotal").innerHTML = "$" + deliverytotal.toFixed(2);



	document.getElementById("totalprice").innerHTML = "$" + totalqty.toFixed(2);
			
		
		var totaltotal = deliverytotal + totalqty + taxtotal;
		
		document.getElementById("Totalorder").innerHTML = "$" + totaltotal.toFixed(2);
		
document.getElementById("itemspricep").value = totalqty;
document.getElementById("totalpricep").value = totaltotal;
document.getElementById("deliveryfeep").value = deliverytotal;
document.getElementById("taxt").value = taxtotal;





}


function myConfirmFunction() {
 if (confirm("'.$contactinf['Name'].' will charge the difference if the item amount is below $15.") == true) {
    
  } else {

   event.preventDefault();
return false;

  }
}


function validateForm(){

myTotalFunction()



var checkthetotal = document.getElementById("itemspricep").value;


var productsinput = document.getElementsByClassName("product"); 
var empty = [].filter.call( productsinput, function( el ) {
   return !el.checked
});



if (productsinput.length == empty.length) {
    



 alert("Please select a item.");
    return false;

}else{

myConfirmFunction()


}




var delivertime = document.getElementById("deliverytime").value;
var delivertime2 = document.getElementById("deliverytime2").value;
var unavailable = document.getElementById("unavailable").checked;

if(delivertime == "" && delivertime2 == "" && unavailable == true){

alert("Please specify the period of time that you will be unavailable for delivery.");
return false;
}





var delivertime = moment(delivertime, "HH:mm a");

var delivertime2 = moment(delivertime2, "HH:mm a");

var time =  moment();





var datediff =  moment(delivertime, "HH:mm a").format("HH") - moment().format("HH");
var minutediff =  moment(delivertime, "HH:mm a").format("mm") - moment().format("mm");
minutediff = Math.abs(minutediff);




if( delivertime2.isAfter(delivertime) == false  && unavailable == true){

alert("Invalid delivery time");
return false;
}


if( delivertime.isAfter(time) == false  && unavailable == true){
    
    alert("Invalid delivery time, please select a time at least 2 hours in the future");
    
    return false;
    
}

if(datediff == 1  && minutediff < 59  && unavailable == true){


    
        
        alert("Invalid delivery time, please select a time at least 2 hours in the future");
    
   
    
    
    return false;
    
}


if(datediff == 0  && unavailable == true){
    
    alert("Invalid delivery time, please select a time at least 2 hours in the future");
    
    return false;
    
}








}



function validateUnavaiable() {

var unavailable = document.getElementById("unavailable").checked;


 if(unavailable == true){

document.getElementById("deliverytime").disabled = false;
document.getElementById("deliverytime2").disabled = false;

 
}else{

document.getElementById("deliverytime").disabled = true;
document.getElementById("deliverytime2").disabled = true;
document.getElementById("deliverytime").value = "";
document.getElementById("deliverytime2").value = "";

}

}






		
		</script>';
		
		?>
		
		
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
						<li><a href="home.php" class="active">Home</a></li>
						<li><a href="recent.php" >My Recent Orders</a></li>
						<li><a href="promopage.php" >Promo Codes</a></li>
						<li><a href="account.php" >Account</a></li>
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

<!-- Popup window -->


<div id="myModal" class="modal" >

  <!-- Modal content -->
  <div class="modal-content"><br><br>
    <span class="close" style="display:none;">&times;</span>
    
    <div ><h3>Acceptable Laundry Bags </h3>

    
    <!-- Slideshow container -->
<div class="slideshow-container">
<?php echo'
  <!-- Full-width images with number and caption text -->
  <div class="mySlides fade" style="text-align:center;">
   <p style="text-align:left;">Laundry bag with drawstring<br><br><br></p>
    <i class=\'fas fa-check\' style=\'font-size:48px;color:green; text-align:center;\'><br>
    <img src="https://'.$_SERVER['SERVER_NAME'].'/Users/images/bag1.jpg" style="width:auto; max-width:100%; height:180px;"></i>

  </div>
  
  
    <div class="mySlides fade" style="text-align:center;">
    <p style="text-align:left;">Plastic Laundry bag that can be tied closed<br><br></p>
   <i class=\'fas fa-check\' style=\'font-size:48px;color:green; text-align:center;\'><br>
    <img src="https://'.$_SERVER['SERVER_NAME'].'/Users/images/bag2.jpg" style="width:auto; max-width:100%; height:180px; "></i>

  </div>
  
  
    <div class="mySlides fade" style="text-align:center;">
    <p style="text-align:left;">We suggest placing dresses, suits, and dry cleaning items in a garment bag.<br><br></p>
 <i class=\'fas fa-check\' style=\'font-size:48px;color:green; text-align:center;\'><br>
    <img src="https://'.$_SERVER['SERVER_NAME'].'/Users/images/bag3.jpg" style="width:auto; max-width:100%; height:180px;"></i>
 
  </div>
  
  
    <div class="mySlides fade" style="text-align:center;">
     <p style="text-align:left;">We do not accept overflowing laundry bags.<br><br></p>
   <i class=\'fas fa-times\' style=\'font-size:48px;color:red; text-align:center;\'><br>
    <img src="https://'.$_SERVER['SERVER_NAME'].'/Users/images/badbag1.jpg" style="width:auto; max-width:100%; height:180px;"></i>

  </div>
  
  
    <div class="mySlides fade" style="text-align:center;">
     <p style="text-align:left;">We do not accept luggage bags, laundry baskets, or bags with wheels attached.<br><br></p>
    <i class=\'fas fa-times\' style=\'font-size:48px;color:red; text-align:center;\'><br>
    <img src="https://'.$_SERVER['SERVER_NAME'].'/Users/images/badbag2.jpg" style="width:auto; max-width:100%; height:180px;"></i>
  </div>
  
  
    <div class="mySlides fade" style="text-align:center;">
    <p style="text-align:left;">We do not accept laundry bags without a drawstring, zipper, or the ability to be closed with velcro.</p>
   <i class=\'fas fa-times\' style=\'font-size:48px;color:red; text-align:center;\'><br>
    <img  src="https://'.$_SERVER['SERVER_NAME'].'/Users/images/badbag3.jpg" style="width:auto; max-width:100%; height:180px;"></i> 

  </div>';

  ?>

  <!-- Next and previous buttons -->
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
  <span class="dot" onclick="currentSlide(4)"></span> 
  <span class="dot" onclick="currentSlide(5)"></span> 
  <span class="dot" onclick="currentSlide(6)"></span> 
</div>
    
    
    
    <!-- End Slideshow -->
    
    
    
    </div>
  </div>

</div>

<!-- The Modal -->

		<!-- Wrapper -->
			<div id="wrapper" >

				<!-- Main -->
					<div id="main">

						<!-- One -->
							<section id="one">
					<?php
					
				echo'	<div class="container">	
								
									<header class="major">
										<h3 style="color: #4acaa8;">'.$launInfo['Name'].'\'s Laundry Options</h3>
							</header>';
							
													$sql2 = "SELECT * FROM Products WHERE Laundromat='".$_GET['storenum']."' AND Active = 'True' ";
$result2 = mysqli_query($mysqli, $sql2);
							
							if(mysqli_num_rows($result2) == 0){
							    
							   echo'<h3>Sorry but there are no options currently avaiable :(</h3>';
							    
							}else{
							
									echo'<form id="payment-form"  name="orderForm" method="post" enctype="multipart/form-data"   action="Backend/processorder.php" onsubmit="return validateForm(this);">	
									
									<input type="hidden" name="laundromatnum" value="'.$_GET['storenum'].'">
									<input type="hidden" name="EstDist" value="'.$estttotal.'">
									<input type="hidden" name="EstDuration" value="'.$duration.'">';
						
									
						echo'<ul style="list-style-type:none; padding-bottom:0; margin-bottom:0;">';
						
						
						while($row2 = $result2->fetch_assoc()) {
						
						
					if($row2['Pickup_Available'] == "True"){
						$colorav ="green";
						$av = "Available";
					}else{
					    
					    $colorav ="red";
					    $av = "Not Available";
					}
						
						
						
							if($row2['Delivery_Available'] == "True"){
						$coloravv ="green";
						$avv = "Available";
					}else{
					    
					    $coloravv ="red";
					    $avv = "Not Available";
					}
						
						
						echo'<li style="">
						';
							


						
						echo'<table><tr >
						
						
						
						
						<td colspan="2">
						<div class="row">
						<div class="col-md-4"><span class="image avatar"><img style="height:200px; width:auto;" src="https://'.$_SERVER['SERVER_NAME'].'/Laundromats/'.$row2['Image'].'"   alt="" /></span>
						
						</div>
						
						<div class="col-md-8"><h4>
						'.$row2['Product_name'].'</h4><h4>
						Price: $'.$row2['Price'].' /'.$row2['Type'].'</h4>
						
						
						<h4 style="color:'.$colorav.'">
						<strong style="color:grey;">Pickup:</strong>
						
						'.$av.'
						</h4>
						
						<h4 style="color:'.$coloravv.'">
						<strong style="color:grey;">Delivery:</strong>
						
						'.$avv.'
						</h4>';
						
						if($row2['Type'] == "Pound"){
						    
				    			    echo'<h4 style="display:inline;">Select: </h4> <label class="container2" style="display:inline;">
						
  <input type="checkbox"  name="'.$row2['Product_name'].'" id="pound" class="product" value="0"  onchange="myTotalFunction()">
  <span class="checkmark"></span> 
</label>';
						    
						    
						}else{
						
						
					echo'	

<h4 style="display:inline;">Select: </h4> <label class="container2" style="display:inline;">
						
  <input type="checkbox"  name="'.$row2['Product_name'].'" id="item" class="product" value="0"  onchange="myTotalFunction()">
  <span class="checkmark"></span> 
</label>


';
						}
						
					echo'	</div></div></td>
						</tr></table><input type="hidden" name="price" class="price" value="'.$row2['Price'].'" onchange="myTotalFunction()">

';

						
						
					
					//options pc start
					
					$sql2 = "SELECT * FROM Options WHERE LaundromatID=".$_GET['storenum']." AND ProductID = ".$row2['ID']." AND Active = 'True' ";
					$optionsr= mysqli_query($mysqli, $sql2);
					
					
					if(mysqli_num_rows($optionsr) > 0){
						echo'<table style="width:80%;">


<tr style="border:none; background:rgba(0,0,0,0);"><td colspan="3"><h4>Extra Options</h4></td></tr>';
						while($optionrow = $optionsr->fetch_assoc()) {
							
							echo'<tr>
<td style="width:10%;"><label class="container2" style="display:inline;">
 		
 									 <input type="checkbox"  name="HowzeDelivrmatOption'.$row2['ID'].'OTherwiseID'.$optionrow['ID'].'"  class="options" value="'.$optionrow['Price'].'"  onchange="myTotalFunction()">
  									<span class="checkmark"></span>
									</label></td>
								<td style="width:40%;">'.$optionrow['Name'].'</td>
								<td style="width:40%;">$'.$optionrow['Price'].'</td>
		
								</tr>';
							
							
						}
						
						echo'</table>';
						
					}
					//options pc end
					
					
						
					//	}
						
						echo'</li>';
						
						
						}
						
						$zip = substr($row['Zip'], 0, strpos($row['Zip'], "-"));
						echo'	';
						
						
				
						
						
						echo'<li><div style="width:100% !important;">	Delivery/Pickup Address: <br>'.$row['Address'].' '.$row['Unit'].'  '.$row['City'].', '.$row['State'].'
							'.$zip.'<br><a class="button" href="account.php#address">Change Address</a><br><br></li>';
							
					
							
							echo'	<input type="hidden" name="itemspricep" id="itemspricep"   onchange="myTotalFunction()">
						
						<input type="hidden" id="deliveryfeep" name="deliveryfeep"  onchange="myTotalFunction()">
						
						<input type="hidden" id="totalpricep" name="totalpricep"   onchange="myTotalFunction()">';
							
							
							
							
		
							
							echo'<li ><label class="container2" style="font-size:100%;">
							Uncheck to pick up your clothes from the laundromat.
  <input type="checkbox" checked="checked" name="deliverycheck" id="deliverycheck" onchange="myTotalFunction()">
  <span class="checkmark"></span> 
</label></li>




';

							
							if($detect->isMobile()) {
								
								echo'<li style="visibility: hidden;">
<label class="container2">						
  <input type="checkbox"  name="unavailable" id="unavailable"  value="true" onchange="validateUnavaiable()">
  <span class="checkmark"></span> 
</label>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
 Delivery unavailable between<br>(At least 2 hours after pickup):<br><input type="us-time" name="deliverytime" placeholder="Start" style="width:100px;"
id="deliverytime"

 disabled>';
								
								
								echo' - <input type="us-time" name="deliverytime2" placeholder="End"  style="width:100px;"
id="deliverytime2"

 disabled>
</li>
</ul>';
								
							}else{
echo'<li style="visibility: hidden;">
<label class="container2">						
  <input type="checkbox"  name="unavailable" id="unavailable" value="true" onchange="validateUnavaiable()">
  <span class="checkmark"></span> 
</label>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
Delivery unavailable between (At least 2 hours after pickup):<br><input type="us-time" name="deliverytime" placeholder="Start" style="width:100px;"
id="deliverytime"

 disabled>';

		
echo' - <input type="us-time" name="deliverytime2" placeholder="End" style="width:100px;"
id="deliverytime2"

 disabled>
</li>
</ul>
<h3>Payment Info</h3>';

							}

							if($row['Stripe'] == ''){
	echo'
						
						
						
						
						
						<style>
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
					
         <div class="form-row">
                <label>Card Name</label>
                <input type="text" name="cardname"  required/>
            </div>

            <div class="form-row">
                <label>Card Number</label>
                <input type="text" size="20" maxlength="20" autocomplete="off" class="card-number" required/>
            </div>
            <div class="form-row">
                <label>CVC</label>
                <input type="text" size="4" maxlength="4" autocomplete="off" class="card-cvc" required/>
            </div>
            <div class="form-row">
                <label>Expiration (MM/YYYY)</label>
                <ul class="action">
                
                <li class="action"><input type="text" size="2" maxlength="2" style="width:80px;" class="card-expiry-month" required/></li>
                <li class="action"><span> / </span></li>
                <li class="action"><input type="text" size="4" maxlength="4" style="width:100px;" class="card-expiry-year" required/></li>
                
                </li>
                </ul>
            </div>
            <br>
         


 ';

}else{
	
	
	echo'<h4>Card Name: '.$row['CardName'].'</h4><a href="account.php" class="button">Change Payment Method</a><br>';
	
	
	
}




$sqlh = "SELECT * FROM PromoHistory WHERE UserID = ".$row['id']." AND ExpireDate >= DATE(NOW()) ORDER BY ExpireDate";
$resulth= mysqli_query($mysqli, $sqlh);



if ($resulth->num_rows > 0) {
	
	echo'<br><br><div >';
	
	while($rowh = $resulth->fetch_assoc()) {
		
		$sqlc = "SELECT * FROM PromoCodes WHERE ID = '".$rowh['PromoID']."' ";
		$resultc = mysqli_query($mysqli, $sqlc);
		$rowc = mysqli_fetch_assoc($resultc);
		
		$expire = date("n-d-Y", strtotime($rowc['Expire_Date']));
		$min = number_format($rowc['Min'], 2);
		
		if($min > 15){
			echo'
<table style="padding:0;">
 		
<th>Discount</th><th>Minimum Item Total</th>
<tr style="border:none;">
 		
<td>'.$rowc['Description'].'</td>
<td>$'.$min.'</td>
</tr>';
				
				echo'<tr style="background: rgba(0,0,0,0); border:none;"><td colspan="2">Discounts will be applied once the laundry garments have been counted and/or weighed. </td></tr>';
			
			
echo'</table></div>';
			
		}else{
			
			
			echo'
<table style="padding:0;">
		
<th>Discount</th><th>Minimum Item Total</th>
<tr style="border:none;">
		
<td>'.$rowc['Description'].'</td>
<td>N/A</td>
</tr>';
			
				
				
echo'<tr style="background: rgba(0,0,0,0); border:none;"><td colspan="2">Discounts will be applied once the laundry garments have been counted and/or weighed. </td></tr>';
			

echo'</table></div>';
			
			
			
		}
		
		
		
	}
	


}




echo'<div style="visibility:hidden;">Est. Items Total: <strong id="totalprice" style="float:right;">$0.00</strong></div><br>
				Est. Items Total: <strong  style="float:right;">TBD</strong>
				<br>Est. Delivery Fee: <strong id="Deliverytotal" style="float:right;">$0.00</strong>

<br>
Minimum $15 order
				<div style="visibility:hidden;">

				Est. Tax: <strong id="Taxtotal" style="float:right;">$0.00<br></strong>
				>Est. Total: <strong id="Totalorder" style="float:right;">$0.00<br></strong></div>
						


<input type="hidden" name="taxt" id="taxt">';


				echo'<input type="submit" id="checkout" value="Checkout" class="submit-button" style="display:block;">	
						</form>
						
						
						
								
								';
								
								
								
								
							?>
							</section>

					

					

					
<?php  } 




$_SESSION['storenum'] = $_GET['storenum'];


?>
					

					</div>

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
			
<div id="ajaxDiv"> 

</div>
	<script>
function updateOrders() {
  setInterval(function(){ 
	
	  $("#ajaxDiv").load("ajaxopencheck.php");

	  }, 500);
}


	updateOrders()
	



</script>
<script>
// Get the modal
var modal = document.getElementById('myModal');


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];



// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}


</script>

<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");



  
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }



if(slideIndex == 6){

	var span = document.getElementsByClassName("close")[0];

	span.style.display = "block";
  
}

  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>


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