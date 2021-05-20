<?php



include("../LoginSystem-CodeCanyon/cooks.php");



include_once '../includes/db_connect.php';

include_once '../includes/functions.php';



//session_start();









$mysqli->query("UPDATE users SET Address = '".$_POST['street-address']."', Unit = '".$_POST['unit']."', City = '".$_POST['city']."', State = '".$_POST['state']."', Zip = '".$_POST['zip']."', Special_Instructions = '".$_POST['instructions']."'







WHERE username = '".$_SESSION['username']."' ");



$_SESSION['accountf'] = "Address Saved!";



 





header('Location: ../confirm.php');

?>