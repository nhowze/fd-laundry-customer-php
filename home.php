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
	
	
	header('Location: '.$_SESSION['loginmsg']);
	
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



function getLatLong($address){
	if(!empty($address)){
		//Formatted address
		$formattedAddr = str_replace(' ','+',$address);
		//Send request and receive json data by address
		$geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false&key=');
		$output = json_decode($geocodeFromAddr);
		//Get latitude and longitute from json data
		$data['latitude']  = $output->results[0]->geometry->location->lat;
		$data['longitude'] = $output->results[0]->geometry->location->lng;
		
		//Return latitude and longitude of the given address
		if(!empty($data)){
			//echo('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false&key=');
			return $data;
		}else{
			return false;
		}
	}else{
		return false;
	}
}



function get_distance_between_points($latitude1, $longitude1, $latitude2, $longitude2) {
$latitude1 = floatval($latitude1);
$longitude1 = floatval($longitude1);
$latitude2 = floatval($latitude2);
$longitude2 = floatval($longitude2);

	$theta = $longitude1 - $longitude2;
	$miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
	$miles = acos($miles);
	$miles = rad2deg($miles);
	$miles = $miles * 60 * 1.1515;
	$feet = $miles * 5280;
	$yards = $feet / 3;
	$kilometers = $miles * 1.609344;
	$meters = $kilometers * 1000;
	return compact('miles'); 
}





$sql = "SELECT * FROM users WHERE username = '".$_SESSION['username']."' ";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_assoc($result);


if($row["Profile_Pic"] != ""){
    $profilepic = $row["Profile_Pic"];
}else{
$profilepic ="images/avatar.jpg";
}



	   


?>
<html>
	<head>
		<link rel="icon" 
      type="image/jpg" 
      href="../images/app-logo.png">
	    
		<title><?php echo $contactinf['Name']; ?> | Laundry Delivery Service</title>
		
		
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
		<script type="text/javascript" src="http://usmntcenter.com/js/jquery-ui-1.8.21.custom.min.js"></script>
		
			<style>
		    
		    input[type="submit"],
	input[type="reset"],
	input[type="button"],
	.button {
	    padding-left:10px !important; 
	    padding-right:10px !important;
	    
	}
		    
		</style>
		
		
		<style>
.loader {
  border: 16px solid #4acaa8;
  border-radius: 50%;
  border-top: 16px solid #f3f3f3;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
  margin-left:auto;
  margin-right:auto;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
		
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
	<body class="is-preload" onload="loadlocation()">

			<!-- Header -->
			<section id="header" style="height:100%;">
			<header>
					 <?php
				    
					
			
		
    
				    echo'
					<span class="image avatar" ><a href="account.php"><img style="width:50%;" src="../images/app-logo-transparent.png"  alt="" /></a></span>';
					
					
					?>
					<h1 id="logo"><a href="home.php">Welcome
					
					
					<?php   echo $row['First_Name'];?></a></h1>
				
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

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">

						<!-- One -->
							<section id="one" style="width:100% !important;">
							
								<div style="margin:0 !important; padding:0  !important; width:100% !important;">
									<header class="major" style="padding:5%; padding-bottom:0;">
										<h2>Nearby Laundromats</h2>
							</header>
					
							<?php
							
							
							echo'<div id="nomessage" style="display:none;">
							
							<h4>Searching for nearby laundromats...</h4>
								<div class="loader"></div>
							<br>
						<br>It looks like there aren\'t any nearby laundromats :( <br><br>';
							
							
							
							echo'<a class="button" href="requestform.php">Request '.$contactinf['Name'].' in your location!</a>
							
							
							
						';
							
							
							
							echo'<br><br></div>';
							
							
							
						echo'<div id="user" style="visibility: hidden;">'.$_SESSION['username'].'</div> <!-- android -->';
							
						
						echo'<script>


$( document ).ready(function() {



if($("#shops").children().length == 0){

$("#nomessage").css("display", "block");

}else{

$("#nomessage").css("display", "none");
//$("#nomessage").css("display", "block");
}




});

</script>';
						
						
						if($confirm['Type'] == "Test"){
						
						

$sql2 = "SELECT * FROM Laundromat WHERE Lat <> '' AND Longi <> '' AND Type = 'Test' ";
$result2 = mysqli_query($mysqli, $sql2);


						
						}else{
						    
						    	$sql2 = "SELECT * FROM Laundromat WHERE Lat <> '' AND Longi <> '' AND Type <> 'Test' ";
$result2 = mysqli_query($mysqli, $sql2);
						    
						    
						}
						
							
						echo'<ul  style="width:110% !important; padding:0 !important; margin:0 !important; list-style-type:none;" id="shops">';
						if ($result2->num_rows > 0) {
						
						while($row2 = $result2->fetch_assoc()) {
						
					
				$address = $row2['Address']." ".$row2['City'].", ".$row2['State']." ".$row2['Zip'];
							
							$latLong = getLatLong($address);
	$latituder = $latLong['latitude']?$latLong['latitude']:'Not found';
	$longituder = $latLong['longitude']?$latLong['longitude']:'Not found';
							
							/**
							echo($latituder); echo'<br>';
							echo($longituder); echo'<br>';
							echo($_SESSION['newlat']); echo'<br>';
							echo($_SESSION['newlng']); echo'<br>';
							**/
							
							
						$distance = get_distance_between_points($_SESSION['newlat'], $_SESSION['newlng'], $latituder, $longituder);
						
						
						
						
						foreach ($distance as $unit => $value) {
							
						if($value <= 15){ 
						
							
							
						
						$value= number_format($value,1);
						
						$Phone = substr_replace($row2['Phone'], "(", 0, 0);
							$Phone = substr_replace($Phone, ")", 4, 0);
							$Phone = substr_replace($Phone, "-", 8, 0);
							$Phone = substr_replace($Phone, " ", 5, 0);
						
						
						
						$day = date("l");
						$now = date("H:i:s");
						if($day == "Saturday" || $day == "Sunday"){
						    
						    $opentime = $row2['Weekend_Opening_Time'];
						    $closetime = $row2['Weekend_Closing_Time'];
						    
						    
						    if($opentime < $now && $now < $closetime){
						        
						        
						        $status ="Open";
						        
						    }else{
						        
						        $status ="Closed";
						        
						    }
						    
						    
						}else{
						    
						    $opentime = $row2['Week_Opening_Time'];
						    $closetime = $row2['Week_Closing_Time'];
						    
						    if($opentime < $now && $now < $closetime){
						        
						        
						        $status ="Open";
						        $color = "green";
						    }else{
						        
						        $status ="Closed";
						        $color = "red";
						    }
						    
						    
						}
						
						
						
						
						
						echo'<li style="width:100% !important; padding:0; margin:0;">


						';
								require_once 'includes/Mobile-Detect-master/Mobile_Detect.php';
$detect = new Mobile_Detect;

if($detect->isMobile()) {
						    
						    
						    	echo'<table><tr style="cursor:pointer;" onclick="submitForm(this);" >
<form class="submitp" method="get" action="laundromatpage.php" >
<input type="hidden" name="lid" value="'.$row2['ID'].'">
						<td style="vertical-align:middle; width:30%;">
						<span class="image avatar"><img src="https://'.$_SERVER['SERVER_NAME'].'/Laundromats/'.$row2['Profile_Pic'].'"  alt="" /></span>
						
						</td>
						<td style="vertical-align:middle !important;">
						<h4>'.$row2['Name'].'</h4>
						<h4>Phone: <a href="tel:'.$row2['Phone'].'">'.$Phone.'</a></h4>
						
						<h4>Dropoff | Pickup</h4>
						<p style="color:'.$color.'; font-weight:bold;">
						'.$status.'
						</p>
						
			
						'.$value.' mi
						
						</td>
						</tr>
</form></table>';
						
						
						    
						}else{
						    
						    
						
						echo'<table><tr style="cursor:pointer;" onclick="submitForm(this);">
						<form class="submitp" method="get" action="laundromatpage.php" >
<input type="hidden" name="lid" value="'.$row2['ID'].'">
						
						
						
						<td style="vertical-align:middle; width:30%;">
						<span class="image avatar"><img src="https://'.$_SERVER['SERVER_NAME'].'/Laundromats/'.$row2['Profile_Pic'].'"  alt="" /></span>
						
						</td>
						<td style="vertical-align:middle; width:70%;"><h4>
						'.$row2['Name'].'</h4><h4>
						Phone <a href="tel:'.$row2['Phone'].'">'.$Phone.'</a></h4>
						<h4>
						Dropoff | Pickup
						</h4><h4 style="color:'.$color.'">
						'.$status.'
						</h4>
						<h4 >
						'.$value.' mi
						</h4></td>
</form>
						</tr></table>';
						
						}
						
						echo'</li>';
						
						
						}
						
						}
						
						
						}
						
						}
						
						echo'	

</ul>';
							
						?>
										
								</div>
							</section>

					

					
		<script>
$("tr")
    .click(function(e){
        
 $(this).find(".submitp").submit();  

    });

</script>
					

					

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

<script>

$( document ).ready(function() {

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);


    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }




function showPosition(position) {
   


    $.post("Backend/getlocation.php", {
latitude: position.coords.latitude,
longitude: position.coords.longitude
});


}
});

</script>

<?php

		 if($_SESSION['newlat'] =="" || $_SESSION['newlng']== ""|| !isset($_SESSION['newlat']) || !isset($_SESSION['newlng']) ){
						
						
				
						echo'
						
						<script>

$( document ).ready(function() {

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);


    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
        
        $( document ).ready(function() {
						
setTimeout(function(){
   window.location.reload();
}, 3000);


})
        
        
    }

});


function showPosition(position) {
   


    $.post("Backend/getlocation.php", {
latitude: position.coords.latitude,
longitude: position.coords.longitude
});


}


</script>
						
						
						
						
						<script>
						$( document ).ready(function() {
						
setTimeout(function(){
   window.location.reload();
}, 2000);


})
</script>';
						
					}
					
					?>

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