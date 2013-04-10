<?php
session_start();

if(isset($_SESSION['userType']) && $_SESSION['userType'] == 1)
{
	$url = 'admin.php';
	header("Location: $url");
	exit;
}

if(isset($_SESSION['userType']) && $_SESSION['userType'] == 2)
{
	$url = 'empPage.php';
	header("Location: $url");
	exit;
}
if(isset($_SESSION['userType']) && $_SESSION['userType'] == 3)
{
	$url = 'studPage.php';
	header("Location: $url");
	exit;
}


?>