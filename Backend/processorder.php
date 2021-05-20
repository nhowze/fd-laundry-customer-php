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


$sql2 = "SELECT * FROM Laundromat WHERE ID = '".$_POST['laundromatnum']."' ";
$result2 = mysqli_query($mysqli, $sql2);
$row2 = mysqli_fetch_assoc($result2);


$sql2 = "SELECT * FROM `Keys` WHERE `ID` = 4 ";
$result2 = mysqli_query($mysqli, $sql2);
$keys = mysqli_fetch_assoc($result2);
	

	
$uniqueidorder =  uniqid('', true);



$sql2 = "SELECT * FROM `OrderGroup` ORDER BY `ID` DESC LIMIT 1";
$result2 = mysqli_query($mysqli, $sql2);
$idn = mysqli_fetch_assoc($result2);


$uniqueidorder = $idn['ID'] + 1;
$uniqueidorder =    date("y.m.d").$uniqueidorder;



$paystatus = "Pending";






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
			
		
		
		/**	
			$charge = \Stripe\Charge::create(array("amount" => $ttprice,
					"currency" => "usd",
					"description" => $uniqueidorder,
					"receipt_email" => $row['email'],
					'customer' => $customer->id));
			
			**/
			
			
			
			
			}else{
			
			
			
			/**
			
				$charge = \Stripe\Charge::create(array("amount" => $ttprice,
					"currency" => "usd",
					"description" => $uniqueidorder,
					"receipt_email" => $row['email'],
					'customer' => $row['Stripe']));
			**/
			
			}
			
			
			
	
			
		
			
			$success = 'You have successfully placed your order!';
			
		$_SESSION['paymessage'] = 'You have successfully placed your order!';
			
	//		$mysqli->query("UPDATE OrderGroup SET Status = 'Driver Requested' WHERE OrderNum = '".$uniqueidorder."' ");
			
			
			
			
		
			
			
			$_POST['totalpricep'] = round($_POST['totalpricep'], 2);
			
			
			
			foreach($_POST as $key => $value)
			{
				
				
				
				if($key == "laundromatnum" || $key == "price" || $key == "pickupcheck" || $key == "pickuptime" || $key == "deliverytime" || $key == "deliverycheck" || $key == "totalpricep" || $key == "deliveryfeep" || $key == "itemspricep"){
					
					
					
					
				}else if(strpos($key, 'HowzeDelivrmatOption') === 0){
					
					
					
					$proid = str_replace('HowzeDelivrmatOption', '', $key);
					$proid= substr($proid, 0, strpos($proid, "OTherwiseID"));
					
					
					$optionid = strstr($key, 'OTherwiseID');
					$optionid = str_replace('OTherwiseID', '', $optionid);
					
					
				
					$sql2 = "SELECT * FROM Products WHERE Laundromat = ".$_POST['laundromatnum']." AND ID = ".$proid." ";
				
					$result2 = mysqli_query($mysqli, $sql2);
					$rresult = mysqli_fetch_assoc($result2);
					
					$SQL = "INSERT INTO OptionsPost (UserID,  LaundromatID, ProductID, OptionID, Ordernum)  VALUES (".$row['id'].",".$_POST['laundromatnum'].",".$rresult['ID'].",".$optionid.", '".$uniqueidorder."');";
					$mysqli->query($SQL);
					
					
					
				}else{
				
					
				
					$key = str_replace('_', ' ', $key);	
				
						
$sql2 = "SELECT * FROM Products WHERE Laundromat = '".$_POST['laundromatnum']."' AND Product_name = '".$key."' ";
$result2 = mysqli_query($mysqli, $sql2);
$productdb = mysqli_fetch_assoc($result2);
					
				//	echo($sql2);
						
if($value != 0 || $productdb['Type'] == "Pound" || $productdb['Type'] == "Item"){
						
						$_POST['price'] = $productdb['Price'];
						
						$SQL = "INSERT INTO Orders (Laundromat_num,  Product_Name, QTY, Price, Username, Ordernum, UserID,Type, ProductID)
								
VALUES (".$_POST['laundromatnum'].", '".$key."', ".$value.", ".$_POST['price'].", '".$_SESSION['username']."', '".$uniqueidorder."', '".$row['id']."', '".$productdb['Type']."', ".$productdb['ID'].");";
						
					//	echo($SQL);
						
						$mysqli->query($SQL);
						
					}
					
					
					
					
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
			
			$lid =	rand(100, 999);
			$usid =	rand(100, 999);
			
			
		
			
			
				$sqlord = "INSERT INTO OrderGroup (Address_Customer, Unit_Customer, City_Customer, State_Customer, Zip_Customer, Address_Laundromat, City_Laundromat, State_Laundromat, Zip_Laundromat, Est_total, Est_Duration, OrderNum, Name, Laundromat_ID, Date, Delivery_Time, Pickup_Time, Delivery, Pickup, Username, UserID, ItemTotal, DeliveryTotal, TotalPrice, Laundro_Code, User_Code, ChargeID,Delivery_Time2,Unavailable, Payment_Status, SalesTax)
VALUES ('".$row['Address']."', '".$row['Unit']."', '".$row['City']."', '".$row['State']."', '".$row['Zip']."', '".$row2['Address']."', '".$row2['City']."' , '".$row2['State']."', '".$row2['Zip']."', '".$_POST['EstDist']."','".$_POST['EstDuration']."', '".$uniqueidorder."', '".$row2['Name']."', '".$row2['ID']."', '".$orderdate."', '".$deliverytime."', '".$pickuptime."', '".$deliverycheck."',
 '".$pickupcheck."', '".$row['username']."', '".$row['id']."', '".$_POST['itemspricep']."','".$_POST['deliveryfeep']."', '".$_POST['totalpricep']."', ".$lid.", ".$usid.", '".$chargeID."','".$deliverytime2."','".$unavailable."', '".$paystatus."', '".$_POST['taxt']."')";
				
				
				$mysqli->query($sqlord);
				
				
			
			
			$sqlid = "SELECT * FROM Laundromat_NotificationIds WHERE LaundromatID = ".$row2['ID']." ";
			$resultid = mysqli_query($mysqli, $sqlid);
			
			
			
			$playerid = array();

			
			
			if ($resultid->num_rows > 0) {
				
				while($rowid = $resultid->fetch_assoc()) {
			

					array_push($playerid,$rowid['OneSignal']);


				}
			}
			
		
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
		//	print_r($response);
			
			// End OneSignal
			
			
			
			
			
			
			
			
			
			
	}
	catch (Exception $e) {
		$error = $e->getMessage();
		
		
		$_SESSION['paymessage'] = "Your card was declined. Please enter a valid payment method.";
		//   echo($error);
		
	}
}


//echo($row['Stripe']);
	
	

	echo'<script> window.location.href = "../orderdetail.php?orderID='.$uniqueidorder.'" </script>';
	
	?>

	

	