<?php 
include_once("../LoginSystem-CodeCanyon/cooks.php");
//session_start();
include_once('../LoginSystem-CodeCanyon/db.php');
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';


require_once('../includes/stripe-php-master/init.php');



$sql = "SELECT * FROM users WHERE username = '".$_SESSION['username']."' ";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_assoc($result);


if($row['Type'] == "Test"){

$sql2 = "SELECT * FROM `Keys` WHERE `ID` = 4 ";
$result2 = mysqli_query($mysqli, $sql2);
$keys = mysqli_fetch_assoc($result2);

}else{


$sql2 = "SELECT * FROM `Keys` WHERE `ID` = 12 ";
$result2 = mysqli_query($mysqli, $sql2);
$keys = mysqli_fetch_assoc($result2);

}

try {
	
	
	if (!isset($_POST['stripeToken']))
		throw new Exception("The Stripe Token was not generated correctly");
	
	if($row['Stripe'] == ''){
		
		\Stripe\Stripe::setApiKey($keys['Key']);
		
		
		// Create a Customer:
		$customer = \Stripe\Customer::create([
				'source' => $_POST['stripeToken'],
				'email' =>  $row['email'],
				'customer' => $customer->id,
				
				
				
		]);
		
		$mysqli->query("UPDATE users SET Stripe = '".$customer->id."', CardName = '".$_POST['cardname']."', CardSource = '".$_POST['stripeToken']."'  WHERE username = '".$_SESSION['username']."' ");
		
		
	}else{
		
		
	
	//update
	\Stripe\Stripe::setApiKey($keys['Key']);
	
	$customer = \Stripe\Customer::update($row['Stripe'], [
			'source' => $_POST['stripeToken'],
	]);
	
	
	$mysqli->query("UPDATE users SET  CardName = '".$_POST['cardname']."', CardSource = '".$_POST['stripeToken']."'  WHERE username = '".$_SESSION['username']."' ");
	
	}
	
	$_SESSION['paymessage'] = "Your payment method has successfully been updated.";
	
	//echo("success");
	
	
	
}
catch (Exception $e) {
	$error = $e->getMessage();
	
	
	$_SESSION['paymessage'] = "There was an error updating your payment method. Please choose a different card.";
	  // echo($error);
	
}


echo'<script> window.location.href = "../confirm.php"; </script>';


?>