<?php
include_once("../LoginSystem-CodeCanyon/cooks.php");
//session_start();

$mysqli->query("UPDATE users SET OneSignal = '' WHERE username = '".$_SESSION['username']."' ");


if (isset($_COOKIE['delivrmatuser'])){
unset($_COOKIE['delivrmatuser']);
}

if (isset($_SESSION['facebook_access_token'])) {
	
	
	unset($_SESSION['facebook_access_token']);
}

if(isset($_SESSION['fb_access_token'])){
	
	unset($_SESSION['fb_access_token']);
}


if (isset($_SESSION['login'])) {

unset($_SESSION['login']);

}

if (isset($_SESSION['admin'])) {

unset($_SESSION['admin']);

}


//clear twitter access tokens
if (isset($_SESSION['access_token'])) {

unset ($_SESSION['access_token']);

}

if (isset($_SESSION['access_token']['oauth_token_secret'])) {

unset ($_SESSION['access_token']['oauth_token_secret']);

}

if (isset($_SESSION['access_token']['oauth_token'])) {

unset ($_SESSION['access_token']['oauth_token']);

}


if ($_SESSION['token']) {

unset ($_SESSION['token']);

}

session_start();
session_destroy();


header('Location: ../login.php');

?>
