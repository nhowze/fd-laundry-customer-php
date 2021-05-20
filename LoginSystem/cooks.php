<?php 

include_once '../includes/db_connect.php';

$sqlct = "SELECT * FROM Contact WHERE ID = 5 ";
$contactinf = mysqli_query($mysqli, $sqlct);
$contactinf = mysqli_fetch_assoc($contactinf);


ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1);
//ini_set('session.save_path', $_SERVER["DOCUMENT_ROOT"].'/Users/LoginSystem/cook');
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 100000000);





session_start();


$cookie_name = "delivrmatuser";
$cookie_value = $_SESSION['username'];



setcookie($cookie_name, $cookie_value, time() + 31556952, $_SERVER["DOCUMENT_ROOT"].'/Users/LoginSystem/cook', $_SERVER["SERVER_NAME"]."/Users/", TRUE, TRUE); // 86400 = 1 day



if(isset($_SESSION['username']) && $_SESSION['username'] != ""){
	
	$_COOKIE["delivrmatuser"] = $_SESSION['username'];
	$_SESSION['login'] == true;
	
	$mysqli->query("UPDATE users SET Last_Active = NOW() WHERE username = '".$_SESSION['username']."' ");
	
	
}




?>