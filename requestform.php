<?php



include_once("LoginSystem-CodeCanyon/cooks.php");

//session_start();

include('LoginSystem-CodeCanyon/db.php');

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



echo'<script>







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





</script>';





$sql = "SELECT * FROM users WHERE username = '".$_SESSION['username']."' ";

$confirm= mysqli_query($mysqli, $sql);

$confirm= mysqli_fetch_assoc($confirm);







if($confirm['Address'] == "" || $confirm['City'] == "" || $confirm['State'] == "" || $confirm['Zip'] == "" || $confirm['Phone_Confirmed'] == "False" || $confirm['Stripe'] == "" || $confirm['Phone'] == 0){

	

	

	echo'<script>

						window.location.href = "confirm.php";

			</script>';

	

}







$sql = "SELECT * FROM Request WHERE UserID = ".$confirm['id']." and Date = DATE(NOW()) ";

$request= mysqli_query($mysqli, $sql);





if ($request->num_rows == 0) {

	

	



$mysqli->query("INSERT INTO Request (UserID, Date, Time, Latitude, Longitude)

VALUES (".$confirm['id'].", DATE(NOW()), TIME(NOW()), '".$_SESSION['newlat']."', '".$_SESSION['newlng']."')");





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

			<section id="header" style="height:100%; min-height:800px;">

			<header>

					 <?php

				    

					 

			

				

    

				    echo'

					<span class="image avatar" ><a href="account.php"><img src="../images/app-logo-transparent.png"  alt="" /></a></span>';

					

					

					?>

					<h1 id="logo"><a href="home.php">Welcome

					

					

					<?php   echo $row['First_Name'];?></a></h1>

				

				</header>

				<nav id="nav">

						<ul>

						<li><a href="home.php" class="active">Home</a></li>

						<li><a href="recent.php" >My Recent Orders</a></li>

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

							<section id="one">

							

								<div class="container">

									<header class="major">

										<h2>Thank you for your request!</h2>

									

							</header>

						<?php echo'<p>Our team at '.$contactinf['Name'].' appreciates your interest in our services. We are a small team but are growing every day. 

						Your request helps us identify our next locations as we look to expand. We\'ll contact you once '.$contactinf['Name'].' is available in your location. Once again thank you for your request!</p>

';?>

										

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

					<section id="footer">

						<div class="container">

							<ul class="copyright">

								<li><a href="http://icitechnologies.com" target="_blank">&copy;

ICI Technologies LLC All rights reserved.</a></li>

							</ul>

						</div>

					</section>



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