<?php

//include_once("Users/LoginSystem-CodeCanyon/cooks.php");

session_start();

include_once 'includes/db_connect.php';
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
	Twenty by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
    
    <style>
        
       #logo > a, #nav > ul > li.current > a, #nav > ul > li:nth-child(2) > a, #nav > ul > li:nth-child(3) > a{
            color:grey;
           
        }
        
    </style>
	<head>
	    
	    <base href="https://<?php echo $_SERVER['HTTP_HOST']; ?>" >
	    <link rel="icon" 
      type="image/jpg" 
      href="images/app-logo.png">
	    
		<title><?php echo $contactinf['Name']; ?></title>
		
		
	<?php 	
		


		$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


		
		?>
		
		
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		
		
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
	<body class="index is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header" class="alt"  >
					<h1 id="logo"><a href="index.php"><?php echo $contactinf['Name']; ?></a></h1>
					<nav id="nav">
						<ul>
							<li class="current"><a href="index.php">Home</a></li>
							<li class="current"><a href="Users/index.php#main">About</a></li>
							<li class="current"><a href="Users/faq.php">FAQ</a></li>
							 <li class="current"><a href="Drivers/about-driver.php" target="_blank">Become a driver</a></li>
								    
								  <li class="current"><a href="Users/login.php" >Login</a></li>
							
					
							<li><a href="Users/register.php" class="button primary">Sign Up</a></li>
						</ul>
					</nav>
				</header>

			<!-- Banner -->
			<?php
				require_once 'includes/Mobile-Detect-master/Mobile_Detect.php';
$detect = new Mobile_Detect;

if($detect->isMobile()) {
			
			echo'	<section id="banner" style="background: #83d3c9">';
			
			}else{
			
			echo'	<section id="banner" style="background: URL(images/launback.jpg); background-repeat: no-repeat;
    background-size: 100%; background-position: 0% 30%  ">';
    
    }
    
    ?>
    

					<!--
						".inner" is set up as an inline-block so it automatically expands
						in both directions to fit whatever's inside it. This means it won't
						automatically wrap lines, so be sure to use line breaks where
						appropriate (<br />).
					-->
					<div class="inner" >
<img src="images/app-logo-transparent.png" style="width:100px;" alt="" />
						<header>
						<h2>	<?php echo $contactinf['Name']; ?></h2>
						</header>
					
						
						
						<footer>
							
						<!--	<ul class="buttons" style="text-align:center;">
										    <li><a href="Users/login.php" class="button">Login</a></li>
											<li><a href="Users/register.php" class="button">Sign Up</a></li>
										</ul>-->
											    <ul class="actions special"  style="list-style-type:none; text-align:center;">
<li style="display:inline;"><a href="Users/login.php" class="button">Login</a></li>
<li style="display:inline;"><a href="Users/register.php" class="button">Sign Up</a></li>
							</ul>
										
						</footer>

					</div>

				</section>

			<!-- Main -->
				<article id="main">

					<header class="special container">
						<span class="icon fa-bar-chart-o"></span>
						<h2><?php echo $contactinf['Name']; ?> is a laundry delivery service which originated in Birmingham, Alabama.</h2>
						
					
						<?php
							
							require_once 'includes/Mobile-Detect-master/Mobile_Detect.php';
$detect = new Mobile_Detect;

if($detect->isMobile()) {

echo'
<video style="width:100%; margin-top:5%; margin-bottom:10%;" controls>
  <source src="delivrmat.mp4" type="video/mp4">

</video><br><Br><br>

<img src="images/Dry+Cleaning+Pick+up+and+Delivery.jpeg" style="width:100%; margin-bottom:5%; margin-top:5%;" alt="" />';

echo'<p style="text-align:left">"<strong>'.$contactinf['Name'].'</strong> connects users to laundromats near them. Doing laundry is time consuming<br> and may not fit in your busy schedule.  <strong>'.$contactinf['Name'].'\'s</strong> mission is to save you time in your day by picking up your dirty laundry <br>at your door and delivering it to you when it\'s done.
						"</p>';

}else{
	
	echo'
<video style="width:50%; margin-top:5%;" controls>
  <source src="delivrmat.mp4" type="video/mp4">

</video>


<br><Br>
<p>"<strong>'.$contactinf['Name'].'</strong> connects users to laundromats near them. Doing laundry is time consuming<br> and may not fit in your busy schedule.  <strong>'.$contactinf['Name'].'\'s</strong> mission is to save you time in your day by picking up your dirty laundry <br>at your door and delivering it to you when it\'s done.
						"</p>';
	
	
}
?>
						
					
					</header>

					<!-- One -->
						<section id="sec2" class="wrapper style2 container special-alt">
							<div class="row gtr-50">
								<div class="col-8 col-12-narrower">

									<header>
										<h2>Do you not have enough time to do your laundry? If so, then <strong><?php echo $contactinf['Name']; ?></strong> is the perfect app for you.</h2>
									</header>
									
									
										<?php
							
							require_once 'includes/Mobile-Detect-master/Mobile_Detect.php';
$detect = new Mobile_Detect;

if($detect->isMobile()) {
								echo'<div class="col-4 col-12-narrower imp-narrower">

									<ul class="featured-icons">
										<li><span class="icon fa-clock-o"><span class="label">Feature 1</span></span></li>
										<li><span class="icon fa-volume-up"><span class="label">Feature 2</span></span></li>
										<li><span class="icon fa-laptop"><span class="label">Feature 3</span></span></li>
										<li><span class="icon fa-inbox"><span class="label">Feature 4</span></span></li>
										<li><span class="icon fa-lock"><span class="label">Feature 5</span></span></li>
										<li><span class="icon fa-cog"><span class="label">Feature 6</span></span></li>
									</ul>

								</div>';
								}
								?>
									
									
									
									
							
											
	
										
										
									</footer>

								</div>
								
								<?php
							
							require_once 'includes/Mobile-Detect-master/Mobile_Detect.php';
$detect = new Mobile_Detect;

if(!$detect->isMobile()) {
								echo'<div class="col-4 col-12-narrower imp-narrower">

									<ul class="featured-icons">
										<li><span class="icon fa-clock-o"><span class="label">Feature 1</span></span></li>
										<li><span class="icon fa-volume-up"><span class="label">Feature 2</span></span></li>
										<li><span class="icon fa-laptop"><span class="label">Feature 3</span></span></li>
										<li><span class="icon fa-inbox"><span class="label">Feature 4</span></span></li>
										<li><span class="icon fa-lock"><span class="label">Feature 5</span></span></li>
										<li><span class="icon fa-cog"><span class="label">Feature 6</span></span></li>
									</ul>

								</div>';
								}
								?>
								
							</div>
						</section>

					<!-- Two -->
						<section class="wrapper style1 container special">
							<div class="row">
								<div class="col-4 col-12-narrower">

									<section>
										<span class="icon featured fa-check"></span>
										<header>
											<h3>Don't know how to do your laundry?</h3>
										</header>
										<p>It's ok if you don't know how to do your laundry, that's why we are here! We will pickup, wash, and deliver your laundry back to you in a timely manner.
									</section>

								</div>
								<div class="col-4 col-12-narrower">

									<section>
										<span class="icon featured fa-check"></span>
										<header>
											<h3>Don't have the time to do your laundry?</h3>
										</header>
										<p>We know that you may have a busy schedule which prevents you from doing your laundry. <strong><?php echo $contactinf['Name']; ?></strong> is the perfect solution to this problem!
									</section>

								</div>
								<div class="col-4 col-12-narrower">

									<section>
										<span class="icon featured fa-check"></span>
										<header>
											<h3>Too Lazy?</h3>
										</header>
										<p>Everyone gets lazy from time to time and laundry can be an unappealing task to start. Thats why <strong><?php echo $contactinf['Name']; ?></strong> is perfect for you! We will pickup, wash and deliver back your laundry all with a click of a button.</p>
									</section>

								</div>
							</div>
						</section>

					<!-- Three -->
						<section class="wrapper style3 container special">
<?php
							
							require_once 'includes/Mobile-Detect-master/Mobile_Detect.php';
$detect = new Mobile_Detect;

if(!$detect->isMobile()) {

echo'<img src="images/Dry+Cleaning+Pick+up+and+Delivery.jpeg" style="width:100%; margin-bottom:10%;" alt="" />';

}
?>


							<header class="major">
								<h2>Become a <strong><?php echo $contactinf['Name']; ?></strong> driver!</h2>
							</header>

							<div class="row">
								<div class="col-6 col-12-narrower">

									<section>
										<img src="images/19404081.jpg" style="max-height:400px; width:100%;" alt="" />
										<header>
											<h3>Become a <strong><?php echo $contactinf['Name']; ?></strong> driver!</h3>
										</header>
										<p><?php echo $contactinf['Name']; ?> is looking for passionate individuals to join our team. We are seeking drivers who can transport laundry between near by users and laundromats.</p>
										
										<a href="https://<?php echo $_SERVER['HTTP_HOST']; ?>/Drivers/about-driver.php" class="button primary" target="_blank">Become a Driver!</a>
									</section>

								</div>
								<div class="col-6 col-12-narrower">

									<section>
										<img src="images/laundry-day-630x355.jpg" style="width:100%;" alt="" />
										<header>
											<h3>Contact Us</h3>
										</header>
										<ul style="list-style-type: none;">
										    <?php echo'<li style="margin-bottom:7%;">Email:  <a href="mailto:'.$contactinf['Email'].'">'.$contactinf['Email'].'</a></li>'; ?>
										   
										    
										</ul>
									</section>

								</div>
							</div>
						
						

						</section>

				</article>

			<!-- CTA -->
				<section id="cta">

					<footer>
				<h2><?php echo $contactinf['Name']; ?> Login</h2>
						
						
		    <ul class="actions special"  style="list-style-type:none;">
<li style="display:inline;"><a href="Users/login.php" class="button">Login</a></li>
<li style="display:inline;"><a href="Users/register.php" class="button">Sign Up</a></li>
							</ul> 
						
					</footer>

				</section>

			<!-- Footer -->
				<footer id="footer">
<?php

					echo'<ul class="icons">
						<li><a href="'.$twitter.'" class="icon circle fa-twitter" target="_blank"><span class="label">Twitter</span></a></li>
						<li><a href="'.$facebook.'" class="icon circle fa-facebook" target="_blank"><span class="label">Facebook</span></a></li>
					<!--	<li><a href="'.$google.'" class="icon circle fa-google-plus" target="_blank"><span class="label">Google+</span></a></li>-->
						</ul>';
					
					
					?>

				<?php	echo'<ul class="copyright">
						<li><a href="http://icitechnologies.com" target="_blank">&copy;
ICI Technologies LLC All rights reserved.</a></li>

<li><a href="https://'.$_SERVER['HTTP_HOST'].'/legal/delivrmat-privacy-policy.php">Privacy Policy</a></li>
<li><a href="https://'.$_SERVER['HTTP_HOST'].'/legal/delivrmat-terms-conditions.php">Terms</a></li>

					</ul>'; ?>

				</footer>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>