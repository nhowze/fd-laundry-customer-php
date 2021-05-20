<?php

set_time_limit(0);

include("../LoginSystem-CodeCanyon/cooks.php");



//session_start();

include('../LoginSystem-CodeCanyon/db.php');

include_once '../includes/db_connect.php';

include_once '../includes/functions.php';





$sqlresult2= "SELECT * FROM Delivery_Hours WHERE ID = 1 ";

$datere= mysqli_query($mysqli, $sqlresult2);

$datere= mysqli_fetch_assoc($datere);



$dated = date("w");

$currenttime = date("H:i");



if($dated == 0 || $dated== 6){ //weekend



	

	$newdattime = date("H:i", strtotime($datere['Weekend_Close']));

	

	if($newdattime == $currenttime ){



$sql = "SELECT * FROM OrderGroup WHERE Status = 'Received'  OR Status = 'In Progress'  OR Status = 'Laundry Complete'   ";

$result = mysqli_query($mysqli, $sql);





if ($result->num_rows > 0) {

	

	

	

	while($row = $result->fetch_assoc()) {

		

		

	

		

		$sqlresult= "SELECT * FROM users WHERE id = ".$row['UserID']." ";

		$userresult= mysqli_query($mysqli, $sqlresult);

		$userresult= mysqli_fetch_assoc($userresult);

		

		

		

		

		//start OneSignal

		

		$playerid = array();

		if($userresult['OneSignal_IOS'] != ""){

			

			array_push($playerid,$userresult['OneSignal_IOS']);

			

		}

		if($row2['OneSignal_Android'] != ""){

			

			array_push($playerid,$userresult['OneSignal_Android']);

			

		}

		

		

		

		

		$fields = array(

				'app_id' => '4ab03baa-ba83-4456-9aec-20722a178737',

				'include_player_ids' => $playerid,

				'contents' => array("en" =>"Your laundry will be delivered tomorrow at our earliest convenience."),

				'headings' => array("en"=>"Delivery hours have ended"),

				'url' => 'https://'.$_SERVER['SERVER_NAME'].'/Users/orderdetail.php?orderID='.$row['OrderNum'],

				

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

			print_r($response);

		

		// End OneSignal

		

		

		

		

	}



}



}



}else{		//week

	

	$newdattime = date("H:i", strtotime($datere['Week_Close']));

	

	if($newdattime == $currenttime ){

		

		$sql = "SELECT * FROM OrderGroup WHERE Status = 'Received'  OR Status = 'In Progress'  OR Status = 'Laundry Complete'   ";

		$result = mysqli_query($mysqli, $sql);

		

		

		if ($result->num_rows > 0) {

			

			while($row = $result->fetch_assoc()) {

				

				

				$sqlresult= "SELECT * FROM users WHERE id = ".$row['UserID']." ";

				$userresult= mysqli_query($mysqli, $sqlresult);

				$userresult= mysqli_fetch_assoc($userresult);

				

				

				

				

				//start OneSignal

				

				$playerid = array();

				if($userresult['OneSignal_IOS'] != ""){

					

					array_push($playerid,$userresult['OneSignal_IOS']);

					

				}

				if($row2['OneSignal_Android'] != ""){

					

					array_push($playerid,$userresult['OneSignal_Android']);

					

				}

				

				

				

				

				$fields = array(

						'app_id' => '4ab03baa-ba83-4456-9aec-20722a178737',

						'include_player_ids' => $playerid,

						'contents' => array("en" =>"Your laundry will be delivered tomorrow at our earliest convenience."),

						'headings' => array("en"=>"Delivery hours have ended"),

						'url' => 'https://'.$_SERVER['SERVER_NAME'].'/Users/orderdetail.php?orderID='.$row['OrderNum'],

						

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

					print_r($response);

				

				// End OneSignal

				

				

				

				

			}

			

		}

		

	}

	

	

	

}





?>