<?php
@session_start();
$_SESSION['loginStatus'] = 'scrutinize';
if(!isset($_SESSION['loginStatus']) && $_SESSION['loginStatus'] != 'scrutinize')
{
	$url = 'login.php';
	header("Location: $url");
	exit;
}

require_once('classMain.php');
$profileObject	= new MyProfile();


$user	= $profileObject->sanitizeString($_POST['user']);
$pass	= sha1(md5($profileObject->sanitizeString($_POST['pass'])).$profileObject->salt);


$result	= $profileObject->checkPassword($user, $pass);

$rows	= mysql_fetch_assoc($result);

if ($rows['Result'] == 1)
{
	$profileObject->setSession($user, $rows['UserType']);
	
	if($rows['UserType'] == 3)
	{
		$url = 'studPage.php';
		header("Location: $url");
		exit;
	}
	else
	{
		if($rows['UserType'] == 1)
		{
			$url = 'admin.php';
			header("Location: $url");
			exit;
			
		}
		if($rows['UserType'] == 2)
		{
			$url = 'empPage.php';
			header("Location: $url");
			exit;
			
		}
	}
}
else
{
	$_SESSION['wrongPassword'] = 1;
	$url = 'login.php';
	header("Location: $url");
	exit;
}




?>