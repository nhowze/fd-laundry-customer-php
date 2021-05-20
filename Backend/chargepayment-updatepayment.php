<?php 
include_once("../LoginSystem-CodeCanyon/cooks.php");
//session_start();
include_once('../LoginSystem-CodeCanyon/db.php');
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';


require_once('../includes/stripe-php-master/init.php');

$sqlct = "SELECT * FROM Contact WHERE ID = 5 ";
$contactinf = mysqli_query($mysqli, $sqlct);
$contactinf = mysqli_fetch_assoc($contactinf);

$sql = "SELECT * FROM users WHERE username = '".$_SESSION['username']."' ";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_assoc($result);


$sql = "SELECT * FROM OrderGroup WHERE Username = '".$_SESSION['username']."' AND Payment_Status = 'Declined' ";
$result = mysqli_query($mysqli, $sql);
$ordersummary = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM users WHERE username = '".$ordersummary['Username']."' ";
$result = mysqli_query($mysqli, $sql);
$user = mysqli_fetch_assoc($result);


if($row['Type'] == "Test"){

$sql2 = "SELECT * FROM `Keys` WHERE `ID` = 4 ";
$result2 = mysqli_query($mysqli, $sql2);
$keys = mysqli_fetch_assoc($result2);

}else{


$sql2 = "SELECT * FROM `Keys` WHERE `ID` = 12 ";
$result2 = mysqli_query($mysqli, $sql2);
$keys = mysqli_fetch_assoc($result2);

}


if($ordersummary['Payment_Status'] != "Approved"){



//discount calculation start
if(!is_null($ordersummary['PromoID'])){
	
	$sqlpromo = "SELECT * FROM PromoCodes WHERE ID = ".$ordersummary['PromoID']." ";
	$resultpromo = mysqli_query($mysqli, $sqlpromo);
	$resultpromo= mysqli_fetch_assoc($resultpromo);
	
	
	if($resultpromo['Type'] == "Percentage"){		//percentage discount
		
		
		$total =	number_format($ordersummary['TotalPrice'] -  ($resultpromo['AmountOff'] * $ordersummary['TotalPrice']), 2);
		
	}else if($resultpromo['Type'] == "Delivery"){	//delivery discount
		
		
		$total =	number_format(($ordersummary['TotalPrice'] -  $ordersummary['DeliveryTotal']), 2);
		
	}else if($resultpromo['Type'] == "Money"){			//money discount
		
		
		$total =	number_format($ordersummary['TotalPrice'] - $resultpromo['AmountOff'], 2);
	}
	
	
	
	
	
}else{
	
	$total =	number_format($ordersummary['TotalPrice'], 2);
	
}



$total = $total * 100;

//discount calculation end

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
		
		
			$charge = \Stripe\Charge::create(array("amount" => $total,
					"currency" => "usd",
					"description" => $ordersummary['Name'],
					"receipt_email" => "garb@delivrmat.com",
					'customer' => $user['Stripe']));
					
		
		
		$mysqli->query("UPDATE users SET Stripe = '".$customer->id."', CardName = '".$_POST['cardname']."', CardSource = '".$_POST['stripeToken']."'  WHERE username = '".$_SESSION['username']."' ");
		
		
	}else{
		
		
	
	//update
	\Stripe\Stripe::setApiKey($keys['Key']);
	
	$customer = \Stripe\Customer::update($row['Stripe'], [
			'source' => $_POST['stripeToken'],
	]);
	
	
		$charge = \Stripe\Charge::create(array("amount" => $total,
					"currency" => "usd",
					"description" => $ordersummary['OrderNum'],
					"receipt_email" => "garb@delivrmat.com",
					'customer' => $user['Stripe']));
					
					
	
	
	$mysqli->query("UPDATE users SET  CardName = '".$_POST['cardname']."', CardSource = '".$_POST['stripeToken']."'  WHERE username = '".$_SESSION['username']."' ");
	
	}
	
	
		
	
	
		$mysqli->query("UPDATE OrderGroup SET Payment_Status = 'Approved'  WHERE OrderNum = '".$ordersummary['OrderNum']."' ");
	
	
		$_SESSION['paymessage'] = "Your payment method has successfully been updated and charged for your most recent purchase.";
		
		
		
		
		
		
		
		
		
		
		
		if($ordersummary['Delivery'] == "False"){


$sql = "SELECT * FROM users WHERE username = '".$ordersummary['Username']."' ";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_assoc($result);


if($row['OneSignal_IOS'] != "" || $row['OneSignal_Android'] != ""){

$playerid = array($row['OneSignal_IOS'], $row['OneSignal_Android']);
$fields = array(
		'app_id' => '4ab03baa-ba83-4456-9aec-20722a178737',
		'include_player_ids' => $playerid,
		'contents' => array("en" =>"It is ready for pickup at ".$ordersummary['Name']."."),
		'headings' => array("en"=>"Your laundry has finished!"),
		'url' => 'https://'.$_SERVER['SERVER_NAME'].'/Users/orderdetail.php?orderID='.$ordersummary['OrderNum'],
		
);

$fields = json_encode($fields);
//print("\nJSON sent:\n");
//print($fields);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
		'Authorization: Basic M2ZNDYtMjA4ZGM2ZmE5ZGFj'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

$response = curl_exec($ch);
curl_close($ch);
//print_r($response);

// End OneSignal

}



}else{
	
	
	
	
	$sql = "SELECT * FROM users WHERE username = '".$ordersummary['Username']."' ";
	$result = mysqli_query($mysqli, $sql);
	$row = mysqli_fetch_assoc($result);
	
	$playerid = array();
if($row['OneSignal_IOS'] != ""){

array_push($playerid,$row['OneSignal_IOS']);

}
if($row['OneSignal_Android'] != ""){
    
array_push($playerid,$row['OneSignal_Android']);

}

	$fields = array(
			'app_id' => '4ab03baa-ba83-4456-9aec-20722a178737',
			'include_player_ids' => $playerid,
			'contents' => array("en" =>"A ".$contactinf['Name']." Driver will pick up your laundry soon."),
			'headings' => array("en"=>"Your laundry has finished!"),
			'url' => "https://".$_SERVER['SERVER_NAME']."/Users/orderdetail.php?orderID=".$ordersummary['OrderNum'],
	);
	
	$fields = json_encode($fields);
	//print("\nJSON sent:\n");
	//print($fields);
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
			'Authorization: Basic M2ZNDYtMjA4ZGM2ZmE5ZGFj'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	
	$response = curl_exec($ch);
	curl_close($ch);
	//print_r($response);
	
	// End OneSignal
	}
		
		
		
		
		
		
		
		
	

}catch (Exception $e) {
//	$error = $e->getMessage();
//	echo($error);
	
	$_SESSION['paymessage'] = "There was an error updating your payment method. Please choose a different card.";
	  // echo($error);
	
}


}


$reurl = "https://".$_SERVER['SERVER_NAME']."/Users/orderdetail.php?orderID=".$ordersummary['OrderNum']."#updatep";

//
echo'<script> window.location.href = "'.$reurl.'"; </script>';


?>