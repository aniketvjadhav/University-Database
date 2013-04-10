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




$query	=	"	SELECT	FirstName, LastName
				FROM	Students
				WHERE	StudentId	=	$studentId
			";
			
$result		=	mysql_query($query);

if (!$result)
{
	$reply = array(
					'success' 	=>		'2',
					'message' 	=>   	"<div class='error'>Some Error Occurred</div>"
				);
			
	echo json_encode($reply);
	exit;	
	
}


$numrows	=	mysql_num_rows($result);
if ($numrows == '0')
{
	$reply = array(
					'success' 	=>		'2',
					'message' 	=>   	"<div class='error'>No Such Student</div>"
				);
			
	echo json_encode($reply);
	exit;	
	
}

$rows			=	mysql_fetch_assoc($result);
$S_FirstName	=	$rows['FirstName'];
$S_LastName		=	$rows['LastName'];

$query1	=	"	SELECT	SectionId, CourseName, FirstName, LastName
				FROM	CourseSearch
				WHERE	LOWER(CourseId)	=	LOWER('".$courseId."')
				AND		LOWER(Section)	=	LOWER('".$section."')
				AND		Semester		=	$semester
				AND		SemYear			=	'$year'
			";
			
$result1	=	mysql_query($query1);

if (!$result1)
{
	$reply = array(
					'success' 	=>		'2',
					'message' 	=>   	"<div class='error'>Some Error Occurred</div>"
				);
			
	echo json_encode($reply);
	exit;	
	
}

$numrows	=	mysql_num_rows($result1);
if ($numrows == '0')
{
	$reply = array(
					'success' 	=>		'2',
					'message' 	=>   	"<div class='error'>No Such Course</div>"
				);
			
	echo json_encode($reply);
	exit;	
	
}


$rows1			=	mysql_fetch_assoc($result1);
$P_FirstName	=	$rows1['FirstName'];
$P_LastName		=	$rows1['LastName'];
$CourseName		=	$rows1['CourseName'];
$sectionId		=	$rows1['SectionId'];

$query2		=	"	SELECT	COUNT(*)	AS StudentExists
					FROM	CourseRegistration
					WHERE	StudentId	=	$studentId
					AND		SectionId	=	$sectionId
				";
				
$result2	=	mysql_query($query2);
if (!$result2)
{
	$reply = array(
					'success' 	=>		'2',
					'message' 	=>   	"<div class='error'>Some Error Occurred</div>"
				);
			
	echo json_encode($reply);
	exit;	
	
}


$rows2		=	mysql_fetch_assoc($result2);

if	( $rows2['StudentExists'] > 0 )
{
	
	$message	=	"<div class='error'><p class='myText1'><b>$S_FirstName $S_LastName</b> has already registered<br>for <b>$courseId"."."."$section : $CourseName</b> <br>under <b>$P_FirstName $P_LastName</b></p></div>";
	
	$reply = array(
					'success' 	=>		'2',
					'message' 	=>   	$message
				);
			
	echo json_encode($reply);
	exit;
	
}






	$confirmation	=	"<div class='warning'><p class='myText1'>Do you want to register <b>$S_FirstName $S_LastName</b> <br>for <b>$courseId"."."."$section : $CourseName</b> <br>under <b>$P_FirstName $P_LastName</b></p></div>";
	
	$confirmButton	=	"<input type='submit' class='login' name='CRF_RegConfirmYes' id='CRF_RegConfirmYes' value='YES' /> <input type='submit' style='margin-left:15px' name='CRF_RegConfirmNo' id='CRF_RegConfirmNo' class='login' value='No' />";
	

	$reply = array(
					'success' 	=>		'1',
					'message' 	=>   	$confirmation,
					'button'	=>		$confirmButton
				);
			
	echo json_encode($reply);
	exit;	




?>