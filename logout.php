<?php
session_start();

session_unset();
$url = 'login.php';
	header("Location: $url");
	exit;


?>
