<?php
@session_start();
$_SESSION['loginStatus'] = 'scrutinize';
if(!isset($_SESSION['loginStatus']) && $_SESSION['loginStatus'] != 'scrutinize')
{
	$url = 'login.php';
	header("Location: $url");
	exit;
}





?>

