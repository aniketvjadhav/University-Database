<?php
@session_start();


if(	$_POST['stdType'] == 'undefined' ||
	$_POST['dept'] == '0'	||
	$_POST['netId'] == ''	||
	$_POST['pass'] == ''	||
	$_POST['cpass'] == ''	||
	$_POST['firstName'] == ''	||
	$_POST['lastName'] == ''	||
	$_POST['email'] == '' ||
	(
		$_POST['majorFlag'] == '1' && $_POST['major'] == '0'
	)
	)

{
	$result = array(
					'success' 	=>		'0',
					'message' 	=>   	"<div class='error'>Fill all the details.</div>"
				);
				
	echo json_encode($result);
	exit;
}

if($_POST['pass'] != $_POST['cpass'])
{
	$result = array(
					'success' 	=>		'0',
					'message' 	=>   	"<div class='error'>Password Mismatch</div>"
				);
				
	echo json_encode($result);
	exit;	
}

if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $_POST['email']))
{
	$result = array(
					'success' 	=>		'0',
					'message' 	=>   	"<div class='error'>Invalid Email</div>"
				);
				
	echo json_encode($result);
	exit;
}


require_once('classMain.php');
$profileObject	= new MyProfile();

$stdData		=	array(
							"netId"			=>	$profileObject->sanitizeString($_POST['netId']),
							"pass"			=>	sha1(md5($profileObject->sanitizeString($_POST['pass'])).$profileObject->salt),
							"firstName"		=>	$profileObject->sanitizeString($_POST['firstName']),
							"lastName"		=>	$profileObject->sanitizeString($_POST['lastName']),
							"dept"			=>	$_POST['dept'],
							"email"			=>	$profileObject->sanitizeString($_POST['email'])
						);
						
if ( $_POST['majorFlag'] == '1')
	$stdData["major"] = $_POST['major'];
else
	$stdData["major"] = '-1';
						
if($_POST['stdType'] == '1')
	$result = $profileObject->insertGStudents($stdData);
if($_POST['stdType'] == '2')
	$result = $profileObject->insertUGStudents($stdData);


if	($result != '0')
{
	$reply = array(
				'success' 	=>		'0',
				'message' 	=>   	"<div class='error'>$result</div>"
			);
			
	echo json_encode($reply);
	exit;
	
}
else
{
	$reply = array(
				'success' 	=>		'1',
				'message' 	=>   	"<div class='success' id='empInsert'>1 New Student Inserted</div>"
			);
			
	echo json_encode($reply);
	exit;
	
}
	




?>