<?php



include_once("../LoginSystem-CodeCanyon/cooks.php");

//session_start();

include('../LoginSystem-CodeCanyon/db.php');

include_once '../includes/db_connect.php';

include_once '../includes/functions.php';



$sqlct = "SELECT * FROM Contact WHERE ID = 5 ";

$contactinf = mysqli_query($mysqli, $sqlct);

$contactinf = mysqli_fetch_assoc($contactinf);



$sqldel = "SELECT * FROM Delivery_Hours WHERE ID = 1 ";





$deliveryhours = mysqli_query($mysqli, $sqldel);

$deliveryhours= mysqli_fetch_assoc($deliveryhours);





$sql22 = "SELECT * FROM Laundromat WHERE ID = '".$_SESSION['storenum']."' ";





$result22 = mysqli_query($mysqli, $sql22);

$launInfo = mysqli_fetch_assoc($result22);





$datenum = date("w");





if($datenum == 0 || $datenum == 6){ // weekend

	

	

	if($datenum == 0 && $launInfo['Sunday'] == "Open"){

	$now = $now = date("H:i:s");

	$close = $launInfo['Weekend_Closing_Time'];

	$open = $launInfo['Weekend_Opening_Time'];

	

	}else if($datenum == 6 && $launInfo['Saturday'] == "Open"){

		

		

		$now = $now = date("H:i:s");

		$close = $launInfo['Weekend_Closing_Time'];

		$open = $launInfo['Weekend_Opening_Time'];

		

	}else{

		

		

		$datestatus = "closed";

		

	}

	

}else{

	

	

	if($datenum == 1 && $launInfo['Monday'] == "Open"){ //monday

	

	$now = date("H:i:s");

	$close = $launInfo['Week_Closing_Time'];

	$open = $launInfo['Week_Opening_Time'];

	

	

	}else if($datenum == 2 && $launInfo['Tuesday'] == "Open"){ //tuesday

		

		$now = date("H:i:s");

		$close = $launInfo['Week_Closing_Time'];

		$open = $launInfo['Week_Opening_Time'];

		

		

		

	} else if($datenum == 3 && $launInfo['Wednesday'] == "Open"){  //wednesday

		

		$now = date("H:i:s");

		$close = $launInfo['Week_Closing_Time'];

		$open = $launInfo['Week_Opening_Time'];

		

		

	}else  if($datenum == 4 && $launInfo['Thursday'] == "Open"){	//thursday

	

	

		$now = date("H:i:s");

		$close = $launInfo['Week_Closing_Time'];

		$open = $launInfo['Week_Opening_Time'];

		

	}else if($datenum == 5 && $launInfo['Friday'] == "Open"){	//friday

		

		

		$now = date("H:i:s");

		$close = $launInfo['Week_Closing_Time'];

		$open = $launInfo['Week_Opening_Time'];

		

		

	}else{

		

		

		$datestatus = "closed";

		

	}

	

	

	

}









if($datestatus == "closed"){

	

	$datestatus = "closed";

	

	

}else{



	

	

	if($open <= $now  && $close >= $now){

	

		

		$datestatus = "open";

//echo' open: '.$open.'<br><br>  close: '.$close.'<br><br>  now: '.$now.'<br><br>';





}else{

	

	$datestatus = "closed";

	

}



}









//delivery check





if($datenum == 0 || $datenum == 6){ // weekend

	$now = $now = date("H:i:s");

	if($deliveryhours['Weekend_Open'] <= $now && $deliveryhours['Weekend_Close'] >= $now){

	

		$datestatus = "open";

	

}else{

	

	$datestatus = "closed2";

}

	

	



}else{

	

	$now = $now = date("H:i:s");

	if($deliveryhours['Week_Open'] <= $now && $deliveryhours['Week_Close'] >= $now){

		

		$datestatus = "open";

		

	}else{

		

		$datestatus = "closed2";

	}

	

	

}









if($datestatus == "closed"){

	$_SESSION['closedmessage'] = 'Sorry but this laundromat is closed for the day.';

	echo'<script>

	

window.location.href = "https://'.$_SERVER['SERVER_NAME'].'/Users/laundry/laundromat.php?lid='.$_SESSION['storenum'].'";

	

	</script>';

	

	

}else if($datestatus == "closed2"){	//delivery hours closed

	

	$_SESSION['closedmessage'] = 'Sorry but '.$contactinf['Name'].' delivery hours have closed.';

	echo'<script>

			

window.location.href = "https://".$_SERVER["SERVER_NAME"]."/Users/laundry/laundromat.php?lid='.$_SESSION["storenum"].'";

		

	</script>';

	

}





?>