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
						'message' 	=>   	"<td colspan='3'><br><div class='error'>Fill Quiz Date</div></td>"
					);
					
	echo json_encode($reply);
	exit;
}

$quizData	=	array(
							"StudentId"		=>	$studentId,
							"SectionId"		=>	$sectionId,
							"ExamType"		=>	'2',
							"ExamMarks"		=>	$grade,
							"ExamDate"		=>	$date,
						);
						
require_once('classMain.php');
$profileObject	= new MyProfile();

$result		=	$profileObject->insertGrades($quizData);

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
						'message' 	=>   	"<td colspan='3'><br><div class='success'>Quiz Successfully Created</div></td>"
					);
					
	echo json_encode($reply);
	exit;


/*
*/



?>