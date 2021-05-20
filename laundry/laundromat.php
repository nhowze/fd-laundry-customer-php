<?php

include_once("../LoginSystem-CodeCanyon/cooks.php");
//session_start();
include_once('../LoginSystem-CodeCanyon/db.php');
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';


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

$sqlct = "SELECT * FROM Contact WHERE ID = 5 ";
$contactinf = mysqli_query($mysqli, $sqlct);
$contactinf = mysqli_fetch_assoc($contactinf);


if(isset($_SESSION['loginmsg'])){
	
	unset($_SESSION['loginmsg']);
}

$sql22 = "SELECT * FROM Laundromat WHERE ID = ".$_GET['lid']." ";


$result22 = mysqli_query($mysqli, $sql22);
$launInfo = mysqli_fetch_assoc($result22);

$sql = "SELECT * FROM users WHERE username = '".$_SESSION['username']."' ";
$confirm= mysqli_query($mysqli, $sql);
$confirm= mysqli_fetch_assoc($confirm);



if($confirm['Terms'] != "True"){
	
	
	echo'<script>
window.location.href = "../agreement.php";
</script>';
	
	
}else if($confirm['Address'] == "" || $confirm['City'] == "" || $confirm['State'] == "" || $confirm['Zip'] == "" || $confirm['Phone_Confirmed'] == "False" || $confirm['Stripe'] == "" || $confirm['Phone'] == 0){
	
	
	echo'<script>
						window.location.href = "../confirm.php";
			</script>';
	
}

$sqldel = "SELECT * FROM Delivery_Hours WHERE ID = 1 ";


$deliveryhours = mysqli_query($mysqli, $sqldel);
$deliveryhours= mysqli_fetch_assoc($deliveryhours);


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

$ur = str_replace("/Users/","",$_SERVER['REQUEST_URI']);






$dayname = date("l");

	require_once '../Mobile-Detect-master/Mobile_Detect.php';
$detect = new Mobile_Detect;


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
			return $data;
		}else{
			return false;
		}
	}else{
		return false;
	}
}

?>
<html>
	<head>
		<?php echo'<link rel="icon" 
      type="image/jpg" 
      href="https://'.$_SERVER['SERVER_NAME'].'/images/app-logo.png">'; ?>
	    
		<title><?php echo $contactinf['Name'];?> | <?php echo $launInfo['Name'];?></title>
		
		
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
		
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
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
					<span class="image avatar"><a href="../account.php"><img style="width:50%;" src="../../images/app-logo-transparent.png" alt="" /></a></span>';
					
					
					?>
					<h1 id="logo"><a href="../home.php">Welcome
					
					
					<?php echo $row['First_Name'];?></a></h1>
				
				</header>
				<nav id="nav">
						<ul>
						<li><a href="redirecthome.php" class="active">Home</a></li>
						<li><a href="redirectrecent.php" >My Recent Orders</a></li>
						<li><a href="promopage.php" >Promo Codes</a></li>
						<li><a href="redirectaccount.php" >Account</a></li>
						<li><a href="driver.php" target="_blank">Become A Driver</a></li>
						<li><a href="redirectlogout.php">Logout</a></li>
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
							
							
							$add = $launInfo['Address']. " " . $launInfo['City']. " " . $launInfo['State'] . " " . $launInfo['Zip'];
							$add2 = $add;
				//	$add =	str_replace(' ',"%",$add);
							
							
							if($detect->isMobile()) {
								echo'<div class="container" style="text-align:center">';
								
							}else{
							    
							    echo'<div class="container" style="text-align:center; padding-top:2%;">';
							    
							}
								
									echo'<header class="major">
										<h2>'.$launInfo['Name'].'</h2>
							</header>';
							
									if(isset($_SESSION['closedmessage'])){
								
										echo' <h4 style="color:red;">'.$_SESSION['closedmessage'].'</h4>';
								
									unset($_SESSION['closedmessage']);
							}
							
							
							echo'<div id="map" style="height:300px"></div>
							

							
							
						<br><a target="_blank" id="addid" href="https://www.google.com/maps/search/?api=1&query='.$add.'">	'.$launInfo['Address'].'<br>
							'.$launInfo['City'].', '.$launInfo['State'].'<br>
							'.$launInfo['Zip'].'
							</a>
							';
							
							
							
							$Phone = substr_replace($launInfo['Phone'], "(", 0, 0);
							$Phone = substr_replace($Phone, ")", 4, 0);
							$Phone = substr_replace($Phone, "-", 8, 0);
							$Phone = substr_replace($Phone, " ", 5, 0);
							
							
							
							if($detect->isMobile()) {
							
							echo'<div id="phoneid"><a target="_blank" href="tel:'.$Phone.'" style="text-decoration:none;">'.$Phone.'</a></div>';
							
							}else{
							    
							    
							    	echo'<div id="phoneid"><a  style="text-decoration:none;">'.$Phone.'</a></div>';
							    
							}
							
							
							echo'<form action="options.php" method="get" style="padding:5; margin-bottom:0;">
							
							<input type="hidden" name="storenum" value="'.$launInfo['ID'].'">
							<input type="hidden" name="storename" value="'.$launInfo['Name'].'">';
							
						
							
							
							
							if(date("w") == 0 || date("w") == 6){ //weekend
								
								
								$otime  = date("H:i:s", strtotime($launInfo['Weekend_Opening_Time']));
								$oclose = date("H:i:s", strtotime($launInfo['Weekend_Closing_Time']));
								
							}else{ //week
								
								$otime  = date("H:i:s", strtotime($launInfo['Week_Opening_Time']));
								$oclose = date("H:i:s", strtotime($launInfo['Week_Closing_Time']));
								
							}
							
							$daydate = date("w");
							
							if($daydate == 0 || $daydate == 6){ //weekend
								
								$now = $now = date("H:i:s");
							
							
								if(date("H:i:s") >= $otime && date("H:i:s") <= $oclose   && $deliveryhours['Weekend_Open'] <= $now && $deliveryhours['Weekend_Close'] >= $now){
								
								echo'<input type="submit"  value="Browse Laundry Options" style="background:#4acaa8; color: white !important;"></form>';
								
							}else{
								
								$openfor   = date("g:i A", strtotime($deliveryhours['Weekend_Open']));
								$closedfor = date("g:i A", strtotime($deliveryhours['Weekend_Close']));
								
								echo'</form>
<script>

function launCloseFunc() {
alert("Laundry delivery service is available between '.$openfor.' - '.$closedfor.' during the weekend. Orders will not be accepted after '.$closedfor.'. Store hours still apply.");
}
</script>

<button class="button" style="background:#4acaa8; color: white !important; font-size:100%;" onclick="launCloseFunc()">Browse Laundry Options</button>';
								
							}
							
							
							
							
							
							
							}else{  //week day
								
								$now = $now = date("H:i:s");
								if($_SESSION['username'] == "nhowze"){
									
									$oapptime = $otime;	//open weektime
									
								}else{
									
									$oapptime = $oclose; 		//close week time
								}
								
								if(date("H:i:s") >= $otime &&  date("H:i:s") <= $oclose && $deliveryhours['Week_Open'] <= $now && $deliveryhours['Week_Close'] >= $now){
									
									echo'<input type="submit"  value="Browse Laundry Options" style="background:#4acaa8; color: white !important;"></form>';
									
								}else{
									
									
									
									$openfor   = date("g:i A", strtotime($deliveryhours['Week_Open']));
									$closedfor = date("g:i A", strtotime($deliveryhours['Week_Close']));
									
									echo'</form>
<script>
 		
function launCloseFunc() {
alert("Laundry delivery service is available between '.$openfor.' - '.$closedfor.' on weekdays. Orders will not be accepted after '.$closedfor.'. Store hours still apply.");
}
</script>
 		
<button class="button" style="background:#4acaa8; color: white !important; font-size:100%;" onclick="launCloseFunc()">Browse Laundry Options</button>';
									
								}
								
								
							}
							
							
							
							
							
							
							//Check if open today
							if($launInfo[$dayname] == "Open"){
							    
							  
							    //Check if week or weekend
							if($launInfo[$dayname] == "Saturday" || $launInfo[$dayname] == "Sunday"){
						$datestat = "Weekend";
							}else{
							    $datestat = "Week";
							}
						
					
					
					if($datestat == "Week"){
						    
						  $opentime=  date("g:i A",strtotime($launInfo['Week_Opening_Time']));
						  
						  
						    $closetime=  date("g:i A",strtotime($launInfo['Week_Closing_Time']));
						    
						}else if($datestat == "Weekend"){
						    
						   $opentime=  date("g:i A",strtotime($launInfo['Weekend_Opening_Time']));
						  
						  
						    $closetime=  date("g:i A",strtotime($launInfo['Weekend_Closing_Time']));
						    
						    
						}
						
						
						echo'<div id="inittime"><div onclick="myShowFunction()" style="cursor:pointer;" id="inittimehead">Laundromat Hours &dArr;		</div> 
						
					'.$dayname.'	'.$opentime.' - '.$closetime.'</div>';
						
						
					
						
						
					echo'	<div id="totaltime" style="display:none;">
						<div onclick="myShowFunction2()" id="totaltimehead" style="cursor:pointer;">Laundromat Hours &uArr;		</div>
						<ul class="actions">
						
						<li>Monday '; if(!$detect->isMobile()) {
							echo'<br>';
							}	if($launInfo['Monday'] == "Open"){
						    
						    
						    
						    if($detect->isMobile()) {
						    
						   echo date("g:i A",strtotime($launInfo['Week_Opening_Time']));
						    
						    echo' - ';
						    
						   echo date("g:i A",strtotime($launInfo['Week_Closing_Time']));
						   
						   
						   
						    }else{
						        
						        echo'<div style="font-size:80%;"> ';
						        
						           
						    
						   echo date("g:i A",strtotime($launInfo['Week_Opening_Time']));
						    
						    echo' - ';
						    
						   echo date("g:i A",strtotime($launInfo['Week_Closing_Time']));
						        echo'</div>';
						    }
						    
						    
						    
						    
						    
						}else{
						    
						    echo''.$launInfo['Monday'].'';
						} echo'</li>
						
						
						
						
						<li>Tuesday '; if(!$detect->isMobile()) {
							echo'<br>';
							} 	if($launInfo['Tuesday'] == "Open"){
						    
						  if($detect->isMobile()) {
						    
						   echo date("g:i A",strtotime($launInfo['Week_Opening_Time']));
						    
						    echo' - ';
						    
						   echo date("g:i A",strtotime($launInfo['Week_Closing_Time']));
						   
						   
						   
						    }else{
						        
						        echo'<div style="font-size:80%;"> ';
						        
						           
						    
						   echo date("g:i A",strtotime($launInfo['Week_Opening_Time']));
						    
						    echo' - ';
						    
						   echo date("g:i A",strtotime($launInfo['Week_Closing_Time']));
						        echo'</div>';
						    }
						    
						}else{
						    
						    echo''.$launInfo['Tuesday'].'';
						} echo'</li>
						
						
						<li>Wednesday ';  if(!$detect->isMobile()) {
							echo'<br>';
							}	if($launInfo['Wednesday'] == "Open"){
						    
						   if($detect->isMobile()) {
						    
						   echo date("g:i A",strtotime($launInfo['Week_Opening_Time']));
						    
						    echo' - ';
						    
						   echo date("g:i A",strtotime($launInfo['Week_Closing_Time']));
						   
						   
						   
						    }else{
						        
						        echo'<div style="font-size:80%;"> ';
						        
						           
						    
						   echo date("g:i A",strtotime($launInfo['Week_Opening_Time']));
						    
						    echo' - ';
						    
						   echo date("g:i A",strtotime($launInfo['Week_Closing_Time']));
						        echo'</div>';
						    }
						    
						}else{
						    
						    echo''.$launInfo['Wednesday'].'';
						} echo'</li>
						
						
						<li>Thursday '; if(!$detect->isMobile()) {
							echo'<br>';
							}	if($launInfo['Thursday'] == "Open"){
						    
						  if($detect->isMobile()) {
						    
						   echo date("g:i A",strtotime($launInfo['Week_Opening_Time']));
						    
						    echo' - ';
						    
						   echo date("g:i A",strtotime($launInfo['Week_Closing_Time']));
						   
						   
						   
						    }else{
						        
						        echo'<div style="font-size:80%;"> ';
						        
						           
						    
						   echo date("g:i A",strtotime($launInfo['Week_Opening_Time']));
						    
						    echo' - ';
						    
						   echo date("g:i A",strtotime($launInfo['Week_Closing_Time']));
						        echo'</div>';
						    }
						    
						}else{
						    
						    echo''.$launInfo['Thursday'].'';
						} echo'</li>
						
						
						<li>Friday '; 	if($launInfo['Friday'] == "Open"){
						    
						   if($detect->isMobile()) {
						    
						   echo date("g:i A",strtotime($launInfo['Week_Opening_Time']));
						    
						    echo' - ';
						    
						   echo date("g:i A",strtotime($launInfo['Week_Closing_Time']));
						   
						   
						   
						    }else{
						        
						        echo'<div style="font-size:80%;"> ';
						        
						           
						    
						   echo date("g:i A",strtotime($launInfo['Week_Opening_Time']));
						    
						    echo' - ';
						    
						   echo date("g:i A",strtotime($launInfo['Week_Closing_Time']));
						        echo'</div>';
						    }
						    
						}else{
						    
						    echo''.$launInfo['Friday'].'';
						} echo'</li>
						
						
						<li>Saturday '; 	if($launInfo['Saturday'] == "Open"){
						    
						  if($detect->isMobile()) {
						    
						   echo date("g:i A",strtotime($launInfo['Weekend_Opening_Time']));
						    
						    echo' - ';
						    
						   echo date("g:i A",strtotime($launInfo['Weekend_Closing_Time']));
						   
						   
						   
						    }else{
						        
						        echo'<div style="font-size:80%;"> ';
						        
						           
						    
						   echo date("g:i A",strtotime($launInfo['Weekend_Opening_Time']));
						    
						    echo' - ';
						    
						   echo date("g:i A",strtotime($launInfo['Weekend_Closing_Time']));
						        echo'</div>';
						    }
						    
						}else{
						    
						    echo''.$launInfo['Saturday'].'';
						} echo'</li>
						
						
						<li>Sunday'; 	if($launInfo['Sunday'] == "Open"){
						    
						    if($detect->isMobile()) {
						    
						   echo date("g:i A",strtotime($launInfo['Weekend_Opening_Time']));
						    
						    echo' - ';
						    
						   echo date("g:i A",strtotime($launInfo['Weekend_Closing_Time']));
						   
						   
						   
						    }else{
						        
						        echo'<div style="font-size:80%;"> ';
						        
						           
						    
						   echo date("g:i A",strtotime($launInfo['Weekend_Opening_Time']));
						    
						    echo' - ';
						    
						   echo date("g:i A",strtotime($launInfo['Weekend_Closing_Time']));
						        echo'</div>';
						    }
						    
						}else{
						    
						    echo''.$launInfo['Sunday'].'';
						} echo'</li>
						</ul>
						
						
						
						</div>
						
						
						';
						
						
						
						
					
						
							}else{
							    
							    $status="Closed";
							    
							}
							
							
						

										
								echo'</div>';
								
								
								echo'<Br><Br>';
								
								?>
							</section>

					

					

					

					

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
			<?php
			

			
			$address = getLatLong($add2); // Address

		
	$latLong = getLatLong($add2);
	
	
	
	if($latLong['latitude'] != "Not found" AND $latLong['longitude'] != "Not found"){
$latitude = $latLong['latitude']?$latLong['latitude']:'Not found';
$longitude = $latLong['longitude']?$latLong['longitude']:'Not found';


}else{
    
   echo'<script> location.reload(); </script>';
    
}



	echo'  <script>

      function initMap() {
        var myLatLng = {lat:'.$latitude.', lng: '.$longitude.'};

        var map = new google.maps.Map(document.getElementById("map"), {
          zoom: 17,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: ""
        });
      }
    </script>';	



	?>


		
		
		
	
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap">
    </script>	
		
		
			
			
<script>
function myShowFunction() {
    
   
  document.getElementById("totaltime").style.display = 'block';
  document.getElementById("inittime").style.display = 'none';
   
   
}

function myShowFunction2() {
    
   
  document.getElementById("inittime").style.display = 'block';
  document.getElementById("totaltime").style.display = 'none';
   
   
}

</script>



		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/jquery.scrollex.min.js"></script>
			<script src="../assets/js/jquery.scrolly.min.js"></script>
			<script src="../assets/js/browser.min.js"></script>
			<script src="../assets/js/breakpoints.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>

	</body>
</html>
