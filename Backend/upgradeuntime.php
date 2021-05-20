<?php 

include("LoginSystem-CodeCanyon/cooks.php");

include_once 'includes/db_connect.php';

include_once 'includes/functions.php';

//session_start();





$sql = "SELECT * FROM users WHERE username = '".$_SESSION['username']."' ";

$result = mysqli_query($mysqli, $sql);

$row = mysqli_fetch_assoc($result);











if($_POST['deliverytime'] != "" && $_POST['deliverytime2']!=""){	//Now Unavaiable







$deliverytime = date('H:i:s',strtotime($_POST['deliverytime']));

$deliverytime2 = date('H:i:s',strtotime($_POST['deliverytime2']));





$mysqli->query("UPDATE OrderGroup SET Unavailable = 'true', Delivery_Time = '".$deliverytime."', Delivery_Time2 = '".$deliverytime2."' WHERE OrderNum = '".$_POST['orderID']."' ");





echo'<script> window.location.href = "orderdetail.php?orderID='.$_POST['orderID'].'"; </script>';



$_SESSION['successmsg'] = "Delivery Status Updated!";



}else{

	// Now available

	//echo("Avaiable");

	

	

	$mysqli->query("UPDATE OrderGroup SET Unavailable = 'false', Delivery_Time = '', Delivery_Time2 = '' WHERE OrderNum = '".$_POST['orderID']."' ");

	

	

	echo'<script> window.location.href = "orderdetail.php?orderID='.$_POST['orderID'].'"; </script>';

	$_SESSION['successmsg'] = "Delivery Status Updated!";

}



?>