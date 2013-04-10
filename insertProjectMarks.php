<?php
@session_start();



$studentId	=	$_POST['studentId'];
$sectionId	=	$_POST['sectionId'];
$grade		=	$_POST['grade'];
$date		=	$_POST['date'];


if(	$studentId 	== 	''	||
	$sectionId	==	''	||
	$date		==	'--'
	)
{	
	$reply = array(
						'success' 	=>		'0',
						'message' 	=>   	"<td colspan='3'><br><div class='error'>Fill Project Date</div></td>"
					);
					
	echo json_encode($reply);
	exit;
}

$projectData	=	array(
							"StudentId"		=>	$studentId,
							"SectionId"		=>	$sectionId,
							"ExamType"		=>	'4',
							"ExamMarks"		=>	$grade,
							"ExamDate"		=>	$date,
						);
						
require_once('classMain.php');
$profileObject	= new MyProfile();

$result		=	$profileObject->insertGrades($projectData);

if($result != '0')
{
	$reply = array(
						'success' 	=>		'0',
						'message' 	=>   	"<td colspan='3'><br><div class='error'>$result</div></td>"
					);
					
	echo json_encode($reply);
	exit;
}

	$reply = array(
						'success' 	=>		'1',
						'message' 	=>   	"<td colspan='3'><br><div class='success'>Project Successfully Created</div></td>"
					);
					
	echo json_encode($reply);
	exit;


/*
*/



?>