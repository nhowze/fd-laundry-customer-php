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
	     <?php echo'<base href="https://'.$_SERVER['SERVER_NAME'].'" >'; ?>
	    <link rel="icon" 
      type="image/jpg" 
      href="images/app-logo.png">
	    
		<title><?php echo $contactinf['Name']; ?> | Frequently Asked Questions</title>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
		
	<?php 	
		
echo'<meta name="description" content="'.$contactinf['Name'].' is a laundry delivery service. Download the '.$contactinf['Name'].' App today!">
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
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		
		
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
							<li class="current"><a href="Users/index.php">Home</a></li>
							<li class="current"><a href="Users/index.php#main">About</a></li>
							<li class="current"><a href="Users/faq.php">FAQ</a></li>
							 <li class="current"><a href="Drivers/about-driver.php" target="_blank">Become a driver</a></li>
								    
								  <li class="current"><a href="Users/login.php" >Login</a></li>
							
					
							<li><a href="Users/register.php" class="button primary">Sign Up</a></li>
						</ul>
					</nav>
				</header>
			


			<!-- Main -->
				<article id="main">

					<header class="special container">
						<span class="icon fa-bar-chart-o"></span>
						<h2>Frequently Asked Questions</h2>
						
						
						<?php
						
								require_once 'includes/Mobile-Detect-master/Mobile_Detect.php';
$detect = new Mobile_Detect;

if($detect->isMobile()) {
						
						echo'<ul style="text-align:left;">';
						
}else{
    
    
    	echo'<ul style="list-style-type:none;">';
    
}
						
						   echo' <li><a href="Users/faq.php#1">Do I need to provide my own laundry bag?</a></li>
						     <li><a href="Users/faq.php#2">What type of laundry bags are accepted?</a></li>
						     <li><a href="Users/faq.php#3">What if I lose a item of clothing?</a></li>
						     <li><a href="Users/faq.php#4">What if one of '.$contactinf['Name'].'’s partnering laundromats damages one of your items?</a></li>
						    
						    
						    
						</ul>';
						?>
						
						
						<div id="1" style=" text-align:left;">
						    <h2>Do I need to provide my own laundry bag?</h2>
						    
						    <p>
						        Yes, customers are required to provide their own laundry bag.
						        <br><br>
						    </p>
						    
						</div>
						
							<div id="2" style=" text-align:left;">
						    <h2>What type of laundry bags are accepted?</h2>
						  
						  
						      <!-- Slideshow container -->
<div class="slideshow-container">
<?php
echo'
  <!-- Full-width images with number and caption text -->
  <div class="mySlides fade" style="text-align:center;">
   <p>Laundry bag with drawstring</p>
    <i class=\'fas fa-check\' style=\'font-size:48px;color:green; text-align:center;\'><br>
    <img src="https://'.$_SERVER['SERVER_NAME'].'/Users/images/bag1.jpg" style="width:auto; max-height:400px; max-width:100%;"></i>

  </div>
  
  
    <div class="mySlides fade" style="text-align:center;">
    <p>Plastic Laundry bag that can be tied closed</p>
   <i class=\'fas fa-check\' style=\'font-size:48px;color:green; text-align:center;\'><br>
    <img src="https://'.$_SERVER['SERVER_NAME'].'/Users/images/bag2.jpg" style="width:auto; max-height:400px; max-width:100%;"></i>

  </div>
  
  
    <div class="mySlides fade" style="text-align:center;">
    <p>We suggest placing dresses, suits, and dry cleaning items in a garment bag.</p>
 <i class=\'fas fa-check\' style=\'font-size:48px;color:green; text-align:center;\'><br>
    <img src="https://'.$_SERVER['SERVER_NAME'].'/Users/images/bag3.jpg" style=" max-width:100%; width:auto; max-height:400px;"></i>
 
  </div>
  
  
    <div class="mySlides fade" style="text-align:center;">
     <p>We do not accept overflowing laundry bags.</p>
   <i class=\'fas fa-times\' style=\'font-size:48px;color:red; text-align:center;\'><br>
    <img src="https://'.$_SERVER['SERVER_NAME'].'/Users/images/badbag1.jpg" style=" max-width:100%; width:auto; max-height:400px;"></i>

  </div>
  
  
    <div class="mySlides fade" style="text-align:center;">
     <p>We do not accept luggage bags, laundry baskets, or bags with wheels attached.</p>
    <i class=\'fas fa-times\' style=\'font-size:48px;color:red; text-align:center;\'><br>
    <img src="https://'.$_SERVER['SERVER_NAME'].'/Users/images/badbag2.jpg" style=" max-width:100%; width:auto; max-height:400px;"></i>
  </div>
  
  
    <div class="mySlides fade" style="text-align:center;">
    <p>We do not accept laundry bags without a drawstring, zipper, or the ability to be closed with velcro.</p>
   <i class=\'fas fa-times\' style=\'font-size:48px;color:red; text-align:center;\'><br>
    <img  src="https://'.$_SERVER['SERVER_NAME'].'/Users/images/badbag3.jpg" style="width:auto; max-width:100%; max-height:400px; "></i> 

  </div>'; ?>



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
						
						<?php

							echo'<div id="3" style=" text-align:left;">
						    <h2>What if I lose a item of clothing?</h2>
						    <p>
						        If you wish to report a missing or stolen item, you must be able to provide a specific description of the
item such as the type of garment, brand, color, size. While we will investigate any claim of stolen or
missing items to the best of our ability, we do not offer any compensation for missing or stolen items.
As our partnering laundromats take care in individually handling and sorting garments, we find that
the vast majority of claims are in fact the fault of the customer misplacing or simply not including a
garment that they thought was in their laundry bag. We recommend including a detailed list of all items
in the bag which will be checked upon reaching one of our partnering laundromat’s facility if this is a
concern. This list will not be considered a formal form of inventory, but it will help us to identify the
items you include.
						        
						    </p>
						    <br>
						    <p>
							'.$contactinf['Name'].'’s partnering laundromats carefully check all items for damages, contents, and total weight.
This happens before and after the wash-dry-fold and dry-cleaning process. We accept no financial
responsibility for any items left in the customer’s garments. We check for any items such as ink pens,
markers, highlighters, makeup, or other items which may cause serious damage to your garments but
accept no responsibility for damages that are caused by these items. The best way to ensure that
these damages never occur is to do what we do before you leave it in our care. Check each individual
item before putting it in the laundry or dry-cleaning bag; even if it doesn\'t have pockets. And also,
double check to make sure nothing other than your garments found its way into your laundry or dry
cleaning bag.
						        
						    </p>
						    
						    <p>
						        While we try as hard as we can to make our service as convenient for you as possible, we do not
accept responsibility for items lost or stolen if they are left for pickup or delivery at a pre-designated
area rather than a hand to hand exchange from customer to driver.
						        
						    </p>
						    
						</div>
						
						
							<div id="4" style=" text-align:left;">
						    <h2>What if one of '.$contactinf['Name'].'’s partnering laundromats damages one of your items?</h2>
						    
						    <p>
							'.$contactinf['Name'].'’s partnering laundromats, individually inspect every item at their facility before and after they
are processed and do their best to find any items that may have been forgotten by a customer in
pockets or other areas of the laundry. However, '.$contactinf['Name'].' – ICI Technologies LLC and '.$contactinf['Name'].'’s
partnering laundromats are not responsible for any items left in pockets such as pens or other items
which may harm laundry during the washing or drying processes. Additionally, any items which are
purposely torn or damaged such as jeans, denim garments, etc. by the manufacturer of the garment
or the customer can never be included in any damage claim for any reason.
						        
						    </p>
						   
						    <p>
						        All of our partnering laundromats wash, dry and fold cycles use cold washes unless requested. This
means that we will never honor any claims of shrinking, color fading, or color blending. These are all
normal occurrences to some degree in all laundry processes and will never be considered a form of
damage by '.$contactinf['Name'].' – ICI Technologies LLC or our partnering laundromats. Additionally, some stains
cannot be removed in a cold wash. We do not promise to remove any stain but make sure to
adequately spot treat any stain prior to washing and re-check the stain before drying.
						        
						    </p>
						    
						     <p>
						        There are some stains that do not appear until exposed to water or heat. Such stains typically have a
sugar base. Examples of such stains are alcohol and juices. These stains can be proved in a
laboratory. This testing is expensive, often in excess of $250. Should a stain damage claim be made,
'.$contactinf['Name'].' - ICI Technologies LLC will send the item in question for laboratory testing. Should it be
determined that '.$contactinf['Name'].' - ICI Technologies LLC or one of our partnering laundromats are
responsible for the stain damage in question, '.$contactinf['Name'].' - ICI Technologies LLC will assume the testing
charge and make suitable remuneration for the item or items up to a combined value of $150. Should
the laboratory determine that the stain or discoloration is sugar based that was not apparent prior to
exposure to heat and/or water the customer assumes all responsibility for lab fees and will not be
remunerated for the damaged item. No garment will ever be sent for testing without the express written
consent of the customer and a fully refundable testing deposit of $250 be made by the
customer. Should the item be shown to have been damaged by '.$contactinf['Name'].' - ICI Technologies LLC or
one of our partnering laundromats the testing deposit will be immediate refunded. '.$contactinf['Name'].' - ICI
Technologies LLC and our partnering laundromats do not use sugar-based stains as an escape clause
for damaged items due to the ease with which an expert can identify the cause of a stain.
						        
						    </p>
						    
						     <p>
						        By putting any item into your laundry or dry-cleaning bags, you are guaranteeing ownership and
responsibility of that item. We highly recommend not including items that do not belong to you such
as your roommates’ or friends’ to avoid any conflict. If another party really needs a specific item to be
washed, have them set up a separate account.
						        
						    </p>
						    
						    
						    
						    
						</div>';
						
					
						
							
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



					<!-- Three -->
						<section class="wrapper style3 container special">
<?php
							
							require_once 'includes/Mobile-Detect-master/Mobile_Detect.php';
$detect = new Mobile_Detect;

if(!$detect->isMobile()) {

echo'<img src="images/Dry+Cleaning+Pick+up+and+Delivery.jpeg" style="width:100%; margin-bottom:10%;" alt="" />';

}



							echo'<header class="major">
								<h2>Become a <strong>'.$contactinf['Name'].'</strong> driver!</h2>
							</header>

							<div class="row">
								<div class="col-6 col-12-narrower">

									<section>
										<img src="images/19404081.jpg" style="max-height:400px; width:100%;" alt="" />
										<header>
											<h3>Become a <strong>'.$contactinf['Name'].'</strong> driver!</h3>
										</header>
										<p>'.$contactinf['Name'].' is looking for passionate individuals to join our team. We are seeking drivers who can transport laundry between near by users and laundromats.</p>
										
										<a href="https://'.$_SERVER['SERVER_NAME'].'/Drivers/about-driver.php" class="button primary" target="_blank">Become a Driver!</a>
									</section>

								</div>
								<div class="col-6 col-12-narrower">

									<section>
										<img src="images/laundry-day-630x355.jpg" style="width:100%;" alt="" />
										<header>
											<h3>Contact Us</h3>
										</header>
										<ul style="list-style-type: none;">
										    <li style="margin-bottom:7%;">Email:  <a href="mailto:contactus@icitechnologies.com">contactus@icitechnologies.com</a></li>
										    <li>Monday: 8:00 AM - 5 PM</li>
										    <li>Tuesday: 8:00 AM - 5 PM</li>
										    <li>Wednesday: 8:00 AM - 5 PM</li>
										    <li>Thursday: 8:00 AM - 5 PM</li>
										    <li>Friday: 8:00 AM - 5 PM</li>
										    <li>Saturday: Closed</li>
										    <li>Sunday: Closed</li>
										    <li></li>
										    
										</ul>
									</section>

								</div>
							</div>
						
						

						</section>

				</article>

		

			<!-- Footer -->
				<footer id="footer">


					<ul class="icons">
						<li><a href="'.$twitter.'" class="icon circle fa-twitter" target="_blank"><span class="label">Twitter</span></a></li>
						<li><a href="'.$facebook.'" class="icon circle fa-facebook" target="_blank"><span class="label">Facebook</span></a></li>
					<!--	<li><a href="'.$google.'" class="icon circle fa-google-plus" target="_blank"><span class="label">Google+</span></a></li>-->
						</ul>
					
					
					

					<ul class="copyright">
						<li><a href="http://icitechnologies.com" target="_blank">&copy;
ICI Technologies LLC All rights reserved.</a></li>

<li><a href="https://'.$_SERVER['SERVER_NAME'].'/legal/delivrmat-privacy-policy.php">Privacy Policy</a></li>
<li><a href="https://'.$_SERVER['SERVER_NAME'].'/legal/delivrmat-terms-conditions.php">Terms</a></li>

					</ul>

				</footer>'; ?>

		</div>

		<!-- Scripts -->
		
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





  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>
		
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