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
	    
		<title><?php echo $contactinf['Name']; ?> | Recent Orders</title>
		
		
		
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
			<style>
		    
		    input[type="submit"],
	input[type="reset"],
	input[type="button"],
	.button {
	    padding-left:10px !important; 
	    padding-right:10px !important;
	    
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
					<span class="image avatar"><a href="account.php"><img style="width:50%;" src="../images/app-logo-transparent.png" alt="" /></a></span>';
					
					
					?>
					<h1 id="logo"><a href="home.php">Welcome
					
					
					<?php echo $row['First_Name'];?></a></h1>
				
				</header>
				<nav id="nav">
					<ul>
						<li><a href="home.php" >Home</a></li>
						<li><a href="recent.php" class="active">My Recent Orders</a></li>
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
			<div id="wrapper" >

				<!-- Main -->
					<div id="main" >

						<!-- One -->
							<section id="one" >
							
								<div  style="width:100% !important; padding:0 !important; margin:0 !imporant;">
									<header class="major" style="padding:5%; padding-bottom:0;">
										<h2>My Recent Orders</h2>
							</header>
							
								<?php
							
								
								if(isset($_SESSION['paymessage'])){
								
						echo'<h4>'.$_SESSION['paymessage'].'</h4>';
						
						unset($_SESSION['paymessage']);
								}
						
						$sqlrecent = "SELECT * FROM OrderGroup WHERE UserID = ".$row['id']." ORDER BY CASE Status 
WHEN 'In Progress' THEN '0'
WHEN 'Driver In Transit' THEN '1'
WHEN 'Driver In Transit With Laundry' THEN '2'
WHEN  'Approved'  THEN '3'
WHEN  'Received'  THEN '4'
WHEN 'Laundry Complete' THEN '5'
WHEN 'Order Complete' THEN '6'
WHEN 'Rejected' THEN '6'
END,
Date DESC, Pickup_Time DESC, Pickup_Time DESC";
$resultrecent = mysqli_query($mysqli, $sqlrecent);

						
						echo'<table style="width:100%;">';
						
								require_once 'includes/Mobile-Detect-master/Mobile_Detect.php';
$detect = new Mobile_Detect;
						
						while($row4 = $resultrecent->fetch_assoc()) {
							
						

if($detect->isMobile()) {
							$dateform = date('m/d/Y', strtotime($row4['Date']));
							$timeformpick = date('h:i A',strtotime($row4['Pickup_Time']));
							$timeformdelivr = date('h:i A',strtotime($row4['Delivery_Time']));
							
							echo'<tr >
						
						
						
						
						<td style="vertical-align:middle;  padding-left:5%; padding-right:5%;">
						<h4>'.$row4['Name'].'</h4>
						<p>Order #: '.$row4['OrderNum'].'<br>
Status: '.$row4['Status'].'
						<br>Date: '.$dateform.'
						
						
						
						
						<Br</p>
						
						
						
						<form action="orderdetail.php" method="get" enctype="multipart/form-data">
						<input type="hidden" name="orderID" value="'.$row4['OrderNum'].'">
						<input type="submit" value="View Order">
						
						</form>
						
						</td></tr>';
}else{
    
    
    
    
    
    		$dateform = date('m/d/Y', strtotime($row4['Date']));
							$timeformpick = date('h:i A',strtotime($row4['Pickup_Time']));
							$timeformdelivr = date('h:i A',strtotime($row4['Delivery_Time']));
							
							echo'<tr >
						
						
						
						
						<td style="vertical-align:middle;  padding-left:5%;">
						<h4>'.$row4['Name'].'</h4>
						<p>
Order #: '.$row4['OrderNum'].'<br>
Status: '.$row4['Status'].'
						<br>Date: '.$dateform.'
						
						
						
						
						<Br</p>
						
						</td>
						<td style="vertical-align:middle; width:30%; padding-right:5%;">
						
						<form action="orderdetail.php" method="get">
						<input type="hidden" name="orderID" value="'.$row4['OrderNum'].'">
						<input type="submit" value="View Order">
						
						</form>
						
						</td></tr>';
    
    
    
    
    
    
}		
							
							
						}
							
						echo'</table>';
						
						
						?>
						
						
								</div>
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