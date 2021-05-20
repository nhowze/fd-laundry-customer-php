<?php

include_once("LoginSystem-CodeCanyon/cooks.php");
unset($_COOKIE[$cookie_name]);
session_destroy();

//session_start();
 

include_once 'includes/functions.php';

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

$sqlct = "SELECT * FROM Contact WHERE ID = 5 ";
$contactinf = mysqli_query($mysqli, $sqlct);
$contactinf = mysqli_fetch_assoc($contactinf);


?>
<!DOCTYPE HTML>
<!--
	Read Only by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<link rel="icon" 
      type="image/jpg" 
      href="../images/app-logo.png">
	    
		<title><?php echo $contactinf['Name']; ?> | User Login</title>
		
		
		
			<?php 	
		



		$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";



		
		
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
		    
		    a, li {
		    
		    vertical-align:top;
		    outline:0;
		    text-decoration:none;
		    
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
			<section id="header" style="height:100%; ">
				<header>
					<span class="image avatar"><img src="../images/app-logo-transparent.png" alt="" /></span>
					<h1 id="logo"><a href="../index.php"><?php echo $contactinf['Name']; ?></a></h1>
				
				</header>
				<nav id="nav">
					<ul>
<li><a href="index.php" class="active">Home</a></li>
						<li><a href="driver.php" target="_blank">Become A Driver</a></li>
							<li><a href="faq.php" >FAQ</a></li>
						<li><a href="login.php" class="active">Login</a></li>
						<li><a href="register.php">Sign Up</a></li>
						
						
					</ul>
				</nav>
			<footer>
				    <?php
				    
					echo'<ul class="icons">
						<li><a href="'.$twitter.'" target="_blank" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="'.$facebook.'" target="_blank" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="'.$instagram.'" target="_blank" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						
						<li><a href="mailto:'.$contactinf['Email'].'" class="icon fa-envelope" ><span class="label">Email</span></a></li>
						
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
										<h2>User Login</h2>
												<h2><?php 

if(isset($_SESSION['errormessage'])){



echo'<h3>'.$_SESSION['errormessage'].'</h3>';



unset($_SESSION['errormessage']);

}
?></h2>
</header>
										
										<form method="post" action="LoginSystem-CodeCanyon/login.php">
										    
										    Username: <input type="text" id="inputEmail" name="username" required>
										    Password: <input type="password" id="inputPassword" name="password" required>
										   
										<br>
										<ul class="actions">
										    
										    <li>
										        
										         <input type="submit" value="Login">
										    
										    
										</form>
										    </li>
										    
										    <li><a href="register.php">Create Account</a></li>
<li><a href="forgotpassword.php">Forgot Password</a></li>
										    </ul>
										    <ul class="actions">
										    <li>	<a href="LoginSystem-CodeCanyon/facebook_connect.php" ><img src="LoginSystem-CodeCanyon/img/fb.png"  alt="Facebook"></a></li>
										    
										    
										<!--     <li>	<a href="" ><img src="LoginSystem-CodeCanyon/img/twitter.png"  alt="Twitter"></a></li>-->
										    
										  	<!--  <li><a href="LoginSystem-CodeCanyon/google_connect.php" ><img src="LoginSystem-CodeCanyon/img/gplus.png"  alt="Google"></a></li>-->
										    
								

</ul>
										
								</div>
							</section>

					

					

					

					

					</div>

				<!-- Footer -->
					<section id="footer">
						<div class="container">
								<?php	echo'<ul class="copyright">
						<li><a href="http://icitechnologies.com" target="_blank">&copy;
ICI Technologies LLC All rights reserved.</a></li>

<li><a href="https://'.$_SERVER['HTTP_HOST'].'/legal/delivrmat-privacy-policy.php">Privacy Policy</a></li>
<li><a href="https://'.$_SERVER['HTTP_HOST'].'/legal/delivrmat-terms-conditions.php">Terms</a></li>

					</ul>'; ?>
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