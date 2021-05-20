<?php
include_once("LoginSystem-CodeCanyon/cooks.php");
//session_start();


include_once 'includes/functions.php';
include_once('LoginSystem-CodeCanyon/db.php');

include 'includes/simple_html_dom.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'includes/PHPMailer-master/src/Exception.php';
require 'includes/PHPMailer-master/src/PHPMailer.php';
require 'includes/PHPMailer-master/src/SMTP.php';


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
	    
		<title><?php echo $contactinf['Name']; ?> | Reset Password</title>
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
	
	
	<?php

$con=mysqli_connect($server, $db_user, $db_pwd,$db_name) //connect to the database server
or die ("Could not connect to mysql because ".mysqli_error());

mysqli_select_db($con,$db_name)  //select the database
or die ("Could not select to mysql because ".mysqli_error());

//prevent sql injection
$username = mysqli_real_escape_string($con,$_POST["username"]);
$email = mysqli_real_escape_string($con,$_POST["email"]);

$username = trim($username);
$email = trim($email);

if (!empty($username)) {
    if (!empty($email))
        $query = "select * from " . $table_name . " where username='$username' and email='$email'";
    else
        $query = "select * from " . $table_name . " where username='$username'";
} else
    $query = "select * from " . $table_name . " where email='$email'";


$result = mysqli_query($con,$query) or die('error');
$row = mysqli_fetch_array($result);
//update user's activation key with new key
$re_activ_key = sha1(mt_rand(10000,99999).time().$email);
$activ_key = $row['activ_key'];

if (mysqli_num_rows($result)) {
    //Update the activation status to 2-Reset in progress and new activation key 
    $query = "update " . $table_name . "	 set activ_status='2' , activ_key='$re_activ_key' where username='$username' and email='$email'";
    $result = mysqli_query($con,$query) or die('error');

  

$to = $row['email'];



         
 $subject = $contactinf['Name']." Reset Password";
         
    
        $message = "<h3>Hi ".$row['First_Name'] ."! </h3>
        <h3>Your account password has been reset</h3><br /> <a class=\"button\" href=\"https://".$_SERVER['HTTP_HOST']."/Users/passwordresetform.php?k=$re_activ_key\"> Please Click to set a new password</a><br /> <br /> ";
           
     


$bodencode = urlencode($message);

$html = file_get_html("https://".$_SERVER['HTTP_HOST']."/Users/LoginSystem-CodeCanyon/resetpasswordtemplate.php?message=".$bodencode);
         
           
           // first check if $html->find exists

$cells = $html->find('html');

if(!empty($cells)){
	
	
	foreach($cells as $cell) {
           
           
         $mail             = new PHPMailer(); // defaults to using php "mail()"
         
         
         
         $mail->AddReplyTo($contactinf['Email'], $contactinf['Name']);
         $mail->SetFrom($contactinf['Email'], $contactinf['Name']);
         $mail->AddReplyTo($contactinf['Email'], $contactinf['Name']);
         $address = $to;
         $mail->AddAddress($to, $row['First_Name']);
         
         $mail->Subject    = $subject;
         
         
         $mail->isHTML(true);
         $mail->Body    = $cell->outertext;
         
         
         
         
         
        if($mail->Send()) {
         	
         	$_SESSION['errormessage1'] = "Check your email in order to reset password.";
         	
         }
             
    	}
	}




}else{
	
	//echo json_encode( array('result'=>0,'txt'=>"User account doesn't Exist"));
	$_SESSION['errormessage'] = "The username or email is not associated with an account.";
	echo'<script>location.href = "forgotpassword.php";</script>';
	


}

?>
	 
	
	
	<body class="is-preload">

		<!-- Header -->
			<section id="header" style="height:100%;">
				<header>
					<span class="image avatar"><img src="../images/app-logo-transparent.png" alt="" /></span>
					<h1 id="logo"><a href="../index.php"><?php echo $contactinf['Name']; ?></a></h1>
				
				</header>
				<nav id="nav">
					<ul>
						<li><a href="index.php" class="active">Home</a></li>
						<li><a href="driver.php" target="_blank">Become A Driver</a></li>
							<li><a href="faq.php" >FAQ</a></li>
						<li><a href="login.php" >Login</a></li>
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
										<h2>Reset Password</h2>
										</header>
										
			<?php


            echo'<h3>'.$_SESSION['errormessage1'].'</h3>';
       
unset( $_SESSION['errormessage1']);

?>

<a  href="login.php" class="button special" >Return to Login</a><br><br><br>
										
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