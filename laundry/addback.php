<?php
include_once("../LoginSystem-CodeCanyon/cooks.php");
//session_start();
include_once('../LoginSystem-CodeCanyon/db.php');
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';


require_once('../stripe-php-master/init.php');


$sql = "SELECT * FROM users WHERE username = '".$_SESSION['username']."' ";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_assoc($result);


$sql2 = "SELECT * FROM Laundromat WHERE ID = '".$_POST['laundromatnum']."' ";
$result2 = mysqli_query($mysqli, $sql2);
$row2 = mysqli_fetch_assoc($result2);


$sql2 = "SELECT * FROM `Keys` WHERE `ID` = 4 ";
$result2 = mysqli_query($mysqli, $sql2);
$keys = mysqli_fetch_assoc($result2);
	

	
$uniqueidorder =  uniqid('', true);
$uniqueidorder =    date("y.m.d").$uniqueidorder;
$uniqueidorder =    $row['id'].".".$uniqueidorder;

	$typearray=array();


	foreach($_POST as $key => $value)
			{
				
				
				
				if($key == "laundromatnum" || $key == "price" || $key == "pickupcheck" || $key == "pickuptime" || $key == "deliverytime" || $key == "deliverycheck" || $key == "totalpricep" || $key == "deliveryfeep" || $key == "itemspricep"){
					
					
					
					
				}else{


$sql2 = "SELECT * FROM Products WHERE Laundromat = '".$_POST['laundromatnum']."' AND Type = 'Pound' ";
$type = mysqli_query($mysqli, $sql2);

	
array_push($typearray,$key);


}

}


print_r($typearray);

$sql2 = "SELECT * FROM Products WHERE Laundromat = '".$_POST['laundromatnum']."' AND Type = 'Pound' ";
$type = mysqli_query($mysqli, $sql2);




$_POST['totalpricep'] = round($_POST['totalpricep'], 2);


if($_POST['totalpricep'] < 5){
		
	$ttprice = 5.00 * 100;
		
	}
	
	$ttprice = $_POST['totalpricep']* 100;
	
	
	
	
if ($_POST) {
	\Stripe\Stripe::setApiKey($keys['Key']);
	$error = '';
	$success = '';
	try {

		
			
			
			
			
			if($row['Stripe'] == ''){
				
				
				if (!isset($_POST['stripeToken']))
					throw new Exception("The Stripe Token was not generated correctly");
				
				
			// Create a Customer:
			$customer = \Stripe\Customer::create([
			'source' => $_POST['stripeToken'],
			'email' =>  $row['email'],
			'customer' => $customer->id,
			
		
			
			]);
		
			
			$mysqli->query("UPDATE users SET Stripe = '".$customer->id."', CardName = '".$_POST['cardname']."', CardSource = '".$_POST['stripeToken']."'  WHERE username = '".$_SESSION['username']."' ");
			
			
			
			if ($type->num_rows > 0) {
			
			echo'pending';
			
			}else{
			    
			echo'nonpending';
			$charge = \Stripe\Charge::create(array("amount" => $ttprice,
					"currency" => "usd",
					"description" => $uniqueidorder,
					"receipt_email" => $row['email'],
					'customer' => $customer->id));
			
			
			}
			
			
			
			}else{
			
			
			
			
			
			
				if ($type->num_rows > 0) {
			
			echo'pending';
			
			}else{
				echo'nonpending';
				$charge = \Stripe\Charge::create(array("amount" => $ttprice,
					"currency" => "usd",
					"description" => $uniqueidorder,
					"receipt_email" => $row['email'],
					'customer' => $row['Stripe']));
			
			
			}
			
			
			
			}
			
			
			
			
			
			
			
			
			
			$chargeID = $charge->id;
			
			
			
			
		
			
			$success = 'Your payment was successful.';
			
			$_SESSION['paymessage'] = 'Your payment was successful.';
			
	//		$mysqli->query("UPDATE OrderGroup SET Status = 'Driver Requested' WHERE OrderNum = '".$uniqueidorder."' ");
			
			
			
			
		
			
			
			$_POST['totalpricep'] = round($_POST['totalpricep'], 2);
			
			
			
			foreach($_POST as $key => $value)
			{
				
				
				
				if($key == "laundromatnum" || $key == "price" || $key == "pickupcheck" || $key == "pickuptime" || $key == "deliverytime" || $key == "deliverycheck" || $key == "totalpricep" || $key == "deliveryfeep" || $key == "itemspricep"){
					
					
					
					
				}else{
					
					
					
					
						
						
						
						$SQL = "INSERT INTO Orders (Laundromat_num,  Product_Name, QTY, Price, Username, Ordernum, UserID)
								
VALUES (".$_POST['laundromatnum'].", '".$key."', ".$value.", ".$_POST['price'].", '".$_SESSION['username']."', '".$uniqueidorder."', '".$row['id']."');";
						
						
						
						$mysqli->query($SQL);
						
					
					
					
					
					
				}
				
				
			}
			
			
			
			//  echo($success);
			
			
			
			
			if($_POST['deliverycheck'] == "on"){
				
				$deliverycheck = "True";
			}else{
				
				$deliverycheck = "False";
			}
			
			if (isset($_POST['unavailable'])){
				
				$unavailable = "true";
				
				
			}else{
				$unavailable = "false";
			}
			
			
			$pickupcheck = "True";
			
			
			
			$orderdate = date("Y-m-d");
			
			$pickuptime = date('H:i:s',time());
			$deliverytime = date('H:i:s',strtotime($_POST['deliverytime']));
			$deliverytime2 = date('H:i:s',strtotime($_POST['deliverytime2']));
			
			$lid =	rand(100000, 999999);
			$usid =	rand(100000, 999999);
			
			
$sqlord = "INSERT INTO OrderGroup (OrderNum, Name, Laundromat_ID, Date, Delivery_Time, Pickup_Time, Delivery, Pickup, Username, UserID, ItemTotal, DeliveryTotal, TotalPrice, Laundro_Code, User_Code, ChargeID,Delivery_Time2,Unavailable) 
VALUES ('".$uniqueidorder."', '".$row2['Name']."', '".$row2['ID']."', '".$orderdate."', '".$deliverytime."', '".$pickuptime."', '".$deliverycheck."',
 '".$pickupcheck."', '".$row['username']."', '".$row['id']."', '".$_POST['itemspricep']."','".$_POST['deliveryfeep']."', '".$_POST['totalpricep']."', ".$lid.", ".$usid.", '".$chargeID."','".$deliverytime2."','".$unavailable."')";
			
			
			$mysqli->query($sqlord);
			
			
			
			
			
			
			
			
			
			
			//OneSignal Start
			
			$playerid = array($row['OneSignal_IOS'], $row['OneSignal_Android']);
			$fields = array(
					'app_id' => 'd62fc64f-c224-487d-8398-e775dd8e5a13',
					'include_player_ids' => $playerid,
					'contents' => array("en" =>"You Have a Pending Order Waiting for Approval!"),
					'headings' => array("en"=>"New Pending Order, User Action Necessary!"),
					'url' => 'https://'.$_SERVER['SERVER_NAME'].'/Laundromats/orders.php',
					
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
	catch (Exception $e) {
		$error = $e->getMessage();
		
		
		$_SESSION['paymessage'] = "Your card was declined. Please enter a valid payment method.";
		 //  echo($error);
		
	}
}


//echo($row['Stripe']);
	
	

//echo'<script> window.location.href = "../recent.php#transferdiv"; </script>';
	
	?>

	

	