<?php
@session_start();

if(!isset($_SESSION['loginStatus']) && $_SESSION['loginStatus'] != 'success')
{
	$url = 'login.php';
	header("Location: $url");
	exit;
}
require_once('classMain.php');
$profileObject	= new MyProfile();


$studentId	=	$profileObject->sanitizeString($_POST['studentId']);
$semester	=	$profileObject->sanitizeString($_POST['semester']);
$year		=	$profileObject->sanitizeString($_POST['year']);
$courseId	=	$profileObject->sanitizeString($_POST['courseId']);
$section	=	$profileObject->sanitizeString($_POST['section']);

if	(
		$studentId	==	""	||
		$semester	==	"0"	||
		$year		==	"0"	||
		$courseId	==	""	||
		$section	==	""
	)
{
	$reply = array(
					'success' 	=>		'2',
					'message' 	=>   	"<div class='error'>Please enter all details</div>"
				);
			
	echo json_encode($reply);
	exit;
}

if ( !is_numeric($studentId) )
{
	$reply = array(
					'success' 	=>		'2',
					'message' 	=>   	"<div class='error'>Student Id should be numeric</div>"
				);
			
	echo json_encode($reply);
	exit;
	
}

$courseRegInfo	=	array(
							'studentId'		=>	$studentId,
							'semester'		=>	$semester,
							'year'			=>	$year,
							'courseId'		=>	$courseId,
							'section'		=>	$section
						);

$result			=	$profileObject->registerStudentCourse($courseRegInfo);

if	($result	!= "0")
{
	$reply = array(
					'success' 	=>		'2',
					'message' 	=>   	"<div class='error'>$result</div>"
				);
			
	echo json_encode($reply);
	exit;
	
}

	$reply = array(
					'success' 	=>		'1',
					'message' 	=>   	"<div class='success'>Registration Successful!!!</div>"
				);
			
	echo json_encode($reply);
	exit;



?>