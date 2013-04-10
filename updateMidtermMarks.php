<?php

@session_start();

$studentId	=	$_POST['studentId'];
$examId		=	$_POST['examId'];
$grade		=	$_POST['grade'];
$date		=	$_POST['date'];



if(	$examId 	== 	''	||
	$date		==	'--'
	)
{	
	$reply = array(
						'success' 	=>		'0',
						'message' 	=>   	"<td colspan='3'><br><div class='error'>Fill Midterm Date</div></td>"
					);
					
	echo json_encode($reply);
	exit;
}





$midtermData	=	array(
							"ExamId"		=>	$examId,
							"ExamMarks"		=>	$grade,
							"ExamDate"		=>	$date,
						);
						
require_once('classMain.php');
$profileObject	= new MyProfile();


$result		=	$profileObject->updateGrades($midtermData);



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
						'message' 	=>   	"<td colspan='3'><br><div class='success'>Midterm Successfully Updated</div></td>"
					);
					
	echo json_encode($reply);
	exit;





?>