<?php



include_once("../LoginSystem-CodeCanyon/cooks.php");

//session_start();

include('../LoginSystem-CodeCanyon/db.php');

include_once '../includes/db_connect.php';

include_once '../includes/functions.php';





$sql = "SELECT * FROM users WHERE username = '".$_SESSION['username']."' ";

$result = mysqli_query($mysqli, $sql);

$row = mysqli_fetch_assoc($result);





$sql = "SELECT * FROM PromoCodes WHERE  Code = '".$_POST['prcode']."' ";

$result2 = mysqli_query($mysqli, $sql);





if($result2->num_rows == 0){

	

	$_SESSION['errcode'] = "The promotional code that you entered does not exist.";

	

}else{

	

	while($row2 = $result2->fetch_assoc()) {

	

	//check if expired

		if(date("Y-m-d") > $row2['Expire_Date']){

		

			$_SESSION['errcode'] = "This promo code has expired.";

	

	}else{		//enter code

		

		

		

		

		$mysqli->query("INSERT INTO PromoHistory (PromoID, UserID, ExpireDate)

VALUES ('".$row2['ID']."','".$row['id']."', '".$row2['Expire_Date']."' )");

		

		$_SESSION['successcode'] = "Your promo code has been activated!";

		

		

	}

	

	

	}

	

	

}



header('Location: ../promopage.php');











?>