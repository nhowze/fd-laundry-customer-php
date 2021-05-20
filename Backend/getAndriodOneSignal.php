<?php 
include_once("LoginSystem-CodeCanyon/cooks.php");
//session_start();
include_once('LoginSystem-CodeCanyon/db.php');
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';


$_POST['User'] = str_replace('"',"",$_POST['User']);




$sql = "SELECT * FROM users WHERE username = '".$_POST['User']."' ";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_assoc($result);




$mysqli->query("UPDATE users SET OneSignal = '".$_POST['ID']."' WHERE username = '".$_POST['User']."' ");






?>