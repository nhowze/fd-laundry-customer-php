<?php 	



include_once("LoginSystem-CodeCanyon/cooks.php");

//session_start();

include('LoginSystem-CodeCanyon/db.php');

include_once 'includes/db_connect.php';

include_once 'includes/functions.php';





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









if($row["Profile_Pic"] != ""){

	$profilepic = $row["Profile_Pic"];

}else{

	$profilepic ="images/avatar.jpg";

}





$sqlnum = "SELECT * FROM OrderGroup WHERE OrderNum = '".$_GET['orderID']."' ";

$resultnum = mysqli_query($mysqli, $sqlnum);

$ordersummary = mysqli_fetch_assoc($resultnum);





$sql = "SELECT * FROM users WHERE id = '".$ordersummary['UserID']."' ";

$result = mysqli_query($mysqli, $sql);

$row = mysqli_fetch_assoc($result);



$sql = "SELECT * FROM users WHERE id = '".$ordersummary['UserID']."' ";

$confirm= mysqli_query($mysqli, $sql);

$confirm= mysqli_fetch_assoc($confirm);





$sql2 = "SELECT * FROM `Keys` WHERE `ID` = 3 ";

$result2 = mysqli_query($mysqli, $sql2);

$keys = mysqli_fetch_assoc($result2);







$sqllun = "SELECT * FROM Laundromat WHERE ID = ".$ordersummary['Laundromat_ID']." ";

$resultlan = mysqli_query($mysqli, $sqllun);

$rowlan = mysqli_fetch_assoc($resultlan);





?>

<html>

	<head>

	<?php echo'	<link rel="icon" 

      type="image/jpg" 

      href="https://'.$_SERVER['SERVER_NAME'].'/images/app-logo.png">

	    

		<title>'.$contactinf['Name'].' | Order Details</title>

		

		

				

		

		

<meta name="description" content="'.$contactinf['Name'].' is a laundry delivery service. Download the '.$contactinf['Name'].' App today!">

<meta name="application-name" content="'.$contactinf['Name'].'">

<meta name="author" content="ICI Technologies LLC">



 <meta name="keywords" content="'.$contactinf['Name'].' order,'.$contactinf['Name'].' order details,'.$contactinf['Name'].',laundry app,laundry delivery app,laundry delivery,deliver laundry,laundry delivery service,delivery my laundry,laundry service,laundry pickup,pickup my laundry,

laundromat delivery service,laundromat app,laundromat pickup">';  





		$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";





echo'<!-- Twitter Card data -->

<meta name="twitter:title" content="Deliv'.$contactinf['Name'].'rmat | Order Details" >

<meta name="twitter:card" content="summary" >

<meta name="twitter:site" content="@publisher_handle" >

<meta name="twitter:description" content="'.$contactinf['Name'].' is a laundry delivery service. Download the '.$contactinf['Name'].' App today!" >

<meta name="twitter:creator" content="@author_handle" >

<meta name="twitter:image" content="https://'.$_SERVER['SERVER_NAME'].'/images/app-logo.png" >







<!-- Open Graph data -->

<meta property="og:title" content="'.$contactinf['Name'].' | Order Details" />

<meta property="og:url" content="'.$actual_link.'" />

<meta property="og:image" content="https://'.$_SERVER['SERVER_NAME'].'/images/app-logo.png" />

<meta property="og:description" content="'.$contactinf['Name'].' is a laundry delivery service. Download the '.$contactinf['Name'].' App today!" /> 

<meta property="og:site_name" content="'.$contactinf['Name'].'" />

		

		

		

		

		<meta charset="utf-8" />

		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

		<link rel="stylesheet" href="https://'.$_SERVER['SERVER_NAME'].'/Users/assets/css/main.css" />';

			?><style>

		    

		    input[type="submit"],

	input[type="reset"],

	input[type="button"],

	.button {

	    padding-left:10px !important; 

	    padding-right:10px !important;

	    

	    

	    

	    

	}

	

		  td{

	    font-size:90%;

	    

	    }  

	    

	    table{

	    

	    width:100% !important;

	    

	    }

	    

		</style>

	

		

		<script src="http://code.jquery.com/jquery-latest.min.js"></script>

		<script type="text/javascript" src="http://usmntcenter.com/js/jquery-ui-1.8.21.custom.min.js"></script>

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	

	

	<script type="text/javascript" src="https://js.stripe.com/v1/"></script>

        <!-- jQuery is used only for this example; it isn't required to use Stripe -->

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>



	

	

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

</style>



<?php 



require_once 'Mobile-Detect-master/Mobile_Detect.php';

$detect = new Mobile_Detect;



if($detect->isMobile()) {

	echo'

					<style>

					td, th{

					    font-size:80%;

					    vertical-align:middle;

					}

					</style>';

}



?>



<link rel="stylesheet" href="https://rawgit.com/anhr/InputKeyFilter/master/InputKeyFilter.css" type="text/css">		

	<script type="text/javascript" src="https://rawgit.com/anhr/InputKeyFilter/master/Common.js"></script>

	<script type="text/javascript" src="https://rawgit.com/anhr/InputKeyFilter/master/InputKeyFilter.js"></script>









  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

    <script type="text/javascript" src="http://rawgit.com/vitmalina/w2ui/master/dist/w2ui.min.js"></script>

    <link rel="stylesheet" type="text/css" href="http://rawgit.com/vitmalina/w2ui/master/dist/w2ui.min.css" />

    

    

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

                    var form$ = $("#payment-form").attr('action', 'updatepaymentnew.php');

                    

                    

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

    

    

    

    

<style>



 div.w2ui-time{

 

 color:black;

 

 }

</style>

	<script src="laundry/moment.js"></script>

	<script>

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







	function validateForm(){



		







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







	<!-- Wrapper -->

		



						<!-- One -->

							<section id="one" style="width:100%; margin:auto; padding:auto; text-align:left; ">

							

								<div class="container" style="margin:auto; padding:auto; text-align:center; width:100%;">











<style>



table, th, td, tr{



text-align:center !important;

padding:0 !important;

font-size:12px;







}







ul, li{



list-style-type: none;

display:inline !important;

}



</style>



<?php



$odate = date('m/d/Y',strtotime($ordersummary['Date']));



$firsttime = date('h:i A',strtotime($ordersummary['Pickup_Time']));





$secondtime =  date('h:i A',strtotime($ordersummary['Delivery_Time']));

$secondtime2 =  date('h:i A',strtotime($ordersummary['Delivery_Time2']));



echo'<div style="text-align:center;"><img src="https://'.$_SERVER['SERVER_NAME'].'/Users/images/delivrmatlogo3.png">';



echo'<h3>'.$row['First_Name'].', thank you for using '.$contactinf['Name'].'!</h3><h4>'.$contactinf['Name'].' Order Receipt</h4></div>';	





			$Phone = substr_replace($rowlan['Phone'], "(", 0, 0);

						$Phone = substr_replace($Phone, ")", 4, 0);

						$Phone = substr_replace($Phone, "-", 8, 0);

						$Phone = substr_replace($Phone, " ", 5, 0);

						

					

						

						echo'

						<table>



<tr>

						<td>Order Number:</td>

						<td>'.$ordersummary['OrderNum'].'</td>

						</tr>





<tr>

						<td>Laundromat:</td>

						<td>'.$ordersummary['Name'].'</td>

						</tr>

<tr>

						<td>Laundromat Phone:</td>

						<td><a href="tel:'.$rowlan['Phone'].'">'.$Phone.'</a></td>

						</tr>









						<tr>

						<td>Status:</td>

						<td>'.$ordersummary['Status'].'</td>

						</tr>';

						

					



						

						

						

						

						

					echo'	<tr><td>Payment Status</td>';

						

						

                    	if($ordersummary['Payment_Status'] == "Pending"){

						    

						    echo'<td style="color:yellow;">'.$ordersummary['Payment_Status'].'</td>';

						    

						}else if($ordersummary['Payment_Status'] == "Approved"){

						    

						   echo'<td style="color:green;">'.$ordersummary['Payment_Status'].'</td>';

						    

						}else if($ordersummary['Payment_Status'] == "Declined"){

						    

						    echo'<td style="color:red;">'.$ordersummary['Payment_Status'].'</td>';

						    

						}

						

						

						

						echo'</tr>

						



<tr>

						<td>Confirmation Code:</td>

						<td>'.$ordersummary['User_Code'].'</td>

						</tr>





							<tr>

						<td>Date:</td>

						<td>'.$odate.'</td>

						</tr>



<tr>

						<td>Time:</td>

						<td>'.$firsttime.'</td>

						</tr>



						';

						

						if($ordersummary['Delivery'] == "True" && $ordersummary['Laundry_Complete'] != 1 && $ordersummary['Status'] != "Rejected" && $ordersummary['Unavailable'] == "true"){

							echo'<tr>

						<td>Unavailable for Delivery:</td>

						<td style="vertical-align:middle;">'.$secondtime.' - '.$secondtime2.'</td>

						</tr>

						<br>

						

						';

						}

						

						

						if($ordersummary['DropOffLocation'] !=""){

							echo'<tr>

						<td >Drop Off Location:</td>

						<td>'.$ordersummary['DropOffLocation'].'</td></tr>';

							

						}

						

						

						if($ordersummary['Status'] == "Order Complete" && $ordersummary['DropOff_Image'] != ""){

							

							echo'<tr style="border:none;"><td colspan="2" style="text-align:center !important;"><br><img style="width:auto; max-height:300px; text-align:center;" src="https://'.$_SERVER['SERVER_NAME'].'/Drivers/'.$ordersummary['DropOff_Image'].'"></td></tr>';

							

						}

						

				echo'</table><h4>Order Detail</h4>';

						

						

				

						

						

						

						$sql2 = "SELECT * FROM Orders WHERE OrderNum = '".$ordersummary['OrderNum']."'";

$result2 = mysqli_query($mysqli, $sql2);



						



	

	echo'<table >';

	



						echo'<th>QTY</th>

						<th>Product Name</th>

						<th>Price</th>

						';

						

						

						while($row2 = $result2->fetch_assoc()) {

						

						$pnew = str_replace('_', ' ', $row2['Product_Name']);	

						



	

					

						

						echo'<tr >';

						

						

						

						if($row2['Type'] == "Pound"){

						    

						    

						    if($row2['QTY'] == 0){

						        

						 echo'<td style="width:25%;">N/A</td>';

						 

						    }else if($row2['QTY'] == 1){

						    	

						    	echo'<td style="width:25%;">'.$row2['QTY'].' lb</td>';

						    }else{

						        

						         echo'<td style="width:25%;">'.$row2['QTY'].' lbs</td>';

						    }

						    

						    

						}else{

						    

						 $qty =  number_format($row2['QTY'],0);

						 

						 

						 if($row2['QTY'] == 0){

						    

						    echo'<td style="width:25%;">N/A</td>';

						    

						 }else if($row2['QTY'] == 1){

						 	

						 	echo'<td style="width:25%;">'.$qty.' item</td>';

						 }else{

						 	

						 	echo'<td style="width:25%;">'.$qty.' items</td>';

						 	

						 }

						    

						    

						}

						

						echo'<td>'.$row2['Product_Name'].'</td>

						

						

						<td>';

						

						if($row2['Type'] == "Pound"){

						

							echo'	$'.$row2['Price'].'/lbs';

						

						}else{

					echo'	$'.$row2['Price'].'/Item';

						}

						

						echo'</td>

						

						</tr>';

						

						//options

						

						

						

						$sql = "SELECT * FROM Products WHERE ID = ".$row2['ProductID']." AND Laundromat = ".$row2['Laundromat_num']." ";

						$result = mysqli_query($mysqli, $sql);

						$result= mysqli_fetch_assoc($result);

						$result= $result['ID'];

						

						

						

						

						$sql2 = "SELECT * FROM Options WHERE ID IN (SELECT OptionID FROM OptionsPost WHERE ProductID = ".$result." AND Ordernum = '".$row2['Ordernum']."') ";

					

						$addonsr= mysqli_query($mysqli, $sql2);

						

						if(mysqli_num_rows($addonsr) > 0){

							

							

							echo'<tr ><td colspan="3">';





							

								

								echo'<table style="background:rbga(0,0,0,0); border:none; max-width:600px;">';

						

							

						while($rowaddon = $addonsr->fetch_assoc()) {

						echo'



<tr style="padding:0; background:rbga(0,0,0,0); border:none;">

<td>Add-on: '.$rowaddon['Name'].' | $'.$rowaddon['Price'].'</td>

</tr>';



}	



echo'</table>   </td></tr>';

}



									

									//end options

									

						

						

						}

						

						

						if(!is_null($ordersummary['PromoID'])){

							

							

							$sqlcov2 = "SELECT * FROM PromoCodes WHERE ID = ".$ordersummary['PromoID']." ";

							$resultcov2 = mysqli_query($mysqli, $sqlcov2);

							$resultcov2= mysqli_fetch_assoc($resultcov2);

						

						echo'<tr><td colspan="3" style="text-align:center;">Promo Code:



'.$resultcov2['Description'].'

														</td></tr>';

						}

						

						echo'<tr style="border-top:solid;">

		

						<td></td>

						<td>Items</td>

						<td>$'.$ordersummary['ItemTotal'].'</td>

		

						</tr>';

						

						

						if($ordersummary['ServiceFee'] != 0.00){

							

							echo'<tr>

						<td></td>

						<td>Minimum Order Fee</td>

						<td>$'.$ordersummary['ServiceFee'].'</td>

						</tr>';

							

						}

						

						

						

						if(!is_null($ordersummary['PromoID']) && $resultcov2['Type'] != "Delivery"){

							

							

							

							

							$discount = $resultcov['AmountOff'] * $ordersummary['TotalPrice'];

							$discount = number_format ($discount, 2);

							echo'<tr>

						<td></td>

						<td>Discount</td>

						<td>-$'.$ordersummary['DiscountAmount'].'</td>

						</tr>';

							

							

							

							

							

						}

						

						

						

						

						

						echo'<tr>

    		

						<td></td>

						<td>Delivery Fee</td>

						<td>$'.$ordersummary['DeliveryTotal'].'</td>

		

						</tr>';

						

						

						

						

						

						

						if($ordersummary['Laundry_Complete'] == 0){

							

							echo'<tr>

						<td></td>

						<td>Est. Tax</td>

						<td>$'.$ordersummary['SalesTax'].'</td>

						</tr>';

							

						}else{

							

							echo'<tr>

						<td></td>

						<td>Tax</td>

						<td>$'.$ordersummary['SalesTax'].'</td>

						</tr>';

							

							

						}

						

						

						

						echo'<tr>

        		

						<td></td>

						<td>Total</td>

						<td>$'.$ordersummary['TotalPrice'].'</td>

   		

						</tr>';

						

						





						echo'</table><br>';



						

						

						?>

						

						</div>



													</section>







					<!-- CTA -->

				<section id="cta" style="background: #4acaa8 !important; padding:5%; background-color: #4acaa8 !important; text-align:center !important;">

				



					<footer>

						

					

						</ul>-->

				

					<?php	echo'<div style="text-align:center !important;">

										<img style="width:100px;" src="https://'.$_SERVER['SERVER_NAME'].'/images/app-logo-transparent.png"  alt="" />

				

<h3 style="color:white;">'.$contactinf['Name'].' App</h3>

						

		   <a href="https://play.google.com/store/apps/details?id=com.brommko.android.delivrmat" target="_blank"><img src="https://'.$_SERVER['SERVER_NAME'].'/Users/images/playstore2.png" ></a>

<a href="https://itunes.apple.com/gb/app/delivrmat/id1426772119?mt=8" target="_blank"><img src="https://'.$_SERVER['SERVER_NAME'].'/Users/images/appstore2.png" ></a><br><br>

						</div>'; ?>

						

					</footer>



				</section>

					



					



				<!-- Footer -->

					<section id="footer" style=" width:100%; text-align:center !important;">

						<div class="container" style="text-align:center !important;">

						

						   <?php

				    

					echo'<ul class="icons">

<li><a  target="_blank" href="https://'.$_SERVER['SERVER_NAME'].'/Drivers/about-driver.php" >Become A Driver</a></li>

						<li><a href="'.$twitter.'" target="_blank"  class="icon fa-twitter"><span class="label">Twitter</span></a></li>

						<li><a href="'.$facebook.'" target="_blank"  class="icon fa-facebook"><span class="label">Facebook</span></a></li>

						<li><a href="'.$instagram.'" target="_blank"  class="icon fa-instagram"><span class="label">Instagram</span></a></li>

							

					</ul>';

					

					?>

						<br><br>

						

							<ul class="copyright">

								<li><a href="http://icitechnologies.com" target="_blank" style="" target="_blank">&copy;

ICI Technologies LLC All rights reserved.</a></li>

<li><a style="" target="_blank" href="https://delivrmat.com/legal/delivrmat-privacy-policy.php">Privacy Policy</a></li>

<li><a style="" target="_blank" href="https://delivrmat.com/legal/delivrmat-terms-conditions.php">Terms</a></li>

							</ul>

						</div>

					</section>



			</div>





<script type="text/javascript">

					

					function checkForm(form)

					{

						//

						// validate form fields

						//

						

						form.mySubmit.disabled = true;

						return true;

					}

					

					</script>





<script type="text/javascript">

var month = (new Date()).getMonth() + 1;

var year  = (new Date()).getFullYear();



// US Format

$('input[type=us-date]').w2field('date');

$('input[type=us-dateA]').w2field('date', { format: 'm/d/yyyy', start:  month + '/5/' + year, end: month + '/25/' + year });

$('input[type=us-dateB]').w2field('date', { format: 'm/d/yyyy', blocked: [ month+'/12/2014',month+'/13/2014',month+'/14/' + year]});

$('input[type=us-date1]').w2field('date', { format: 'm/d/yyyy', end: $('input[type=us-date2]') });

$('input[type=us-date2]').w2field('date', { format: 'm/d/yyyy', start: $('input[type=us-date1]') });

$('input[type=us-time]').w2field('time',  { format: 'h12' });

$('input[type=us-timeA]').w2field('time', { format: 'h12', start: '8:00 am', end: '4:30 pm' });

$('input[type=us-datetime]').w2field('datetime');



// EU Common Format

$('input[type=eu-date]').w2field('date',  { format: 'd.m.yyyy' });

$('input[type=eu-dateA]').w2field('date', { format: 'd.m.yyyy', start:  '5.' + month + '.' + year, end: '25.' + month + '.' + year });

$('input[type=eu-dateB]').w2field('date', { format: 'd.m.yyyy', blocked: ['12.' + month + '.' + year, '13.' + month + '.' + year, '14.' + month + '.' + year]});

$('input[type=eu-date1]').w2field('date', { format: 'd.m.yyyy', end: $('input[type=eu-date2]') });

$('input[type=eu-date2]').w2field('date', { format: 'd.m.yyyy', start: $('input[type=eu-date1]') });

$('input[type=eu-time]').w2field('time',  { format: 'h24' });

$('input[type=eu-timeA]').w2field('time', { format: 'h24', start: '8:00 am', end: '4:30 pm' });

$('input[type=eu-datetime]').w2field('datetime', { format: 'dd.mm.yyyy|h24:mm' });







</script>

<script>

        CreateDateFilter('date', {

                formatMessage: 'Please type date %s'

                , onblur: function (target) {

                    if (target.value == target.defaultValue)

                        return;

                    document.getElementById('date').innerHTML = target.value;

                }

                , min: new Date((new Date()).toString()).toISOString().match(/^(.*)T.*$/i)[1]//'2006-06-27'//10 years ago

               

                , dateLimitMessage: 'Invalid Date: Please verify that the date that you entered has not already past '

            }

        );

    </script>





		<!-- Scripts -->

		<?php

			echo'<script src="https://'.$_SERVER['SERVER_NAME'].'/Users/assets/js/jquery.min.js"></script>

			<script src="https://'.$_SERVER['SERVER_NAME'].'/Users/assets/js/jquery.scrollex.min.js"></script>

			<script src="https://'.$_SERVER['SERVER_NAME'].'/Users/assets/js/jquery.scrolly.min.js"></script>

			<script src="https://'.$_SERVER['SERVER_NAME'].'/Users/assets/js/browser.min.js"></script>

			<script src="https://'.$_SERVER['SERVER_NAME'].'/Users/assets/js/breakpoints.min.js"></script>

			<script src="https://'.$_SERVER['SERVER_NAME'].'/Users/assets/js/util.js"></script>

			<script src="https://'.$_SERVER['SERVER_NAME'].'/Users/assets/js/main.js"></script>';

			?>



	</body>

</html>