<?php
@session_start();

if(	$_POST['empType'] == 'undefined' ||
	$_POST['empTypeName'] == ''	||
	$_POST['netId'] == ''	||
	$_POST['ssn'] == ''	||
	$_POST['pass'] == ''	||
	$_POST['cpass'] == ''	||
	$_POST['firstName'] == ''	||
	$_POST['lastName'] == ''	||
	$_POST['salary'] == ''	||
	$_POST['email'] == ''
	)
{
	$reply = array(
					'success' 	=>		'0',
					'message' 	=>   	"<div class='error'>Fill all the details.</div>"
				);
				
	echo json_encode($reply);
	exit;
}

if($_POST['pass'] != $_POST['cpass'])
{
	$reply = array(
					'success' 	=>		'0',
					'message' 	=>   	"<div class='error'>Password Mismatch</div>"
				);
				
	echo json_encode($reply);
	exit;	
}

if(strlen($_POST['ssn'])<10)
{
	$reply = array(
					'success' 	=>		'0',
					'message' 	=>   	"<div class='error'>Invalid SSN</div>"
				);
				
	echo json_encode($reply);
	exit;
}

if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $_POST['email']))
{
	$reply = array(
					'success' 	=>		'0',
					'message' 	=>   	"<div class='error'>Invalid Email</div>"
				);
				
	echo json_encode($reply);
	exit;
}




require_once('classMain.php');
$profileObject	= new MyProfile();


						
						

$empData		=	array(
						"netId"			=>	$profileObject->sanitizeString($_POST['netId']),
						"ssn"			=>	$profileObject->sanitizeString($_POST['ssn']),
						"pass"			=>	sha1(md5($profileObject->sanitizeString($_POST['pass'])).$profileObject->salt),
						"firstName"		=>	$profileObject->sanitizeString($_POST['firstName']),
						"lastName"		=>	$profileObject->sanitizeString($_POST['lastName']),
						"salary"			=>	$profileObject->sanitizeString($_POST['salary']),
						"email"			=>	$profileObject->sanitizeString($_POST['email']),
						"empTypeName"	=>	$_POST['empTypeName']
					);
					
					

if($_POST['empType'] == '1')
	$result = $profileObject->insertTEmployee($empData);
if($_POST['empType'] == '2')
	$result = $profileObject->insertNTEmployee($empData);

if	($result == '1')
{
	$reply = array(
				'success' 	=>		'0',
				'message' 	=>   	"<div class='error'>Some error occured. Employee not inserted</div>"
			);
			
	echo json_encode($reply);
	exit;
	
}
else
{
	$reply = array(
				'success' 	=>		'1',
				'message' 	=>   	"<div class='success' id='empInsert'>1 Employee Added Successfully</div>"
			);
			
	echo json_encode($reply);
	exit;
	
}
	




?>