<?php
@session_start();

require_once('classMain.php');
$profileObject	= new MyProfile();


$empId		=	$_SESSION['userId'];
$year		=	$_POST['year'];
$semester	=	$_POST['semester'];


if (	$empId 	== 	""	||
		$year	==	"0"	||
		$semester	==	"0"
	)
{
	$reply = array(
					'success' 	=>		'0',
					'message' 	=>   	"<div class='error'>Fill all the details.</div>"
				);
				
	echo json_encode($reply);
	exit;
	
}

$query	=	"	SELECT		s.SectionId, c.CourseId, c.CourseName,s.Section, LectureStartTime, LectureEndTime
				FROM		Sections s
						JOIN
							Courses c
						ON
							(c.CourseId = s.CourseId)
				WHERE		InstructorId	=	$empId
				AND			SemYear			=	'$year'
				AND			Semester		=	$semester
			";
			
			
$result	=	mysql_query($query);

if(!$result)
{
	$reply = array(
				'success' 	=>		'0',
				'message' 	=>   	"<td></td><td></td><td><div class='error'>$query</div></td>"
			);
			
echo json_encode($reply);
exit;
}

if(mysql_num_rows($result) < 1)
{
	$reply = array(
				'success' 	=>		'0',
				'message' 	=>   	"<td></td><td></td><td><div class='error'>You have no class in this semester</div></td>"
			);
			
	echo json_encode($reply);
	exit;
}


$message	=	"<td colspan='3'>";
while(	$rows	=	mysql_fetch_assoc($result) )
{
	$message	.=	"<div class='examHead'><a id='$rows[SectionId]'>$rows[CourseId]"."."."$rows[Section] : $rows[CourseName] $rows[LectureStartTime] - $rows[LectureEndTime]</a></div>";
	
	$query1		=	"	SELECT		ExamDate
						FROM		Exams
						WHERE		ExamType	=	4
						AND			SectionId	=	$rows[SectionId]
						GROUP BY	ExamDate
						ORDER BY	ExamDate
					";
					
	$result1	=	mysql_query($query1);
	
	if(!$result1)
	{
		$reply = array(
				'success' 	=>		'0',
				'message' 	=>   	"<div id='error'>Project Error Occurred..</div>"
			);
			
		echo json_encode($reply);
		exit;
	}
	
	$PNo = 1;
	
	if(mysql_num_rows($result1) > 0 )
	{
		
		while(	$rows1 = mysql_fetch_array($result1) )
		{
			$message	.=	"<div class='divExamList'><a class='examList' rel='$rows1[ExamDate]"."*"."$rows[SectionId]' id='ProjectsExist'>Project $PNo</a></div>";
			$PNo++;
		}
		
		
	}
	
	$message	.=	"<div class='divExamList'><a class='examList' rel='$rows[SectionId]' id='addNewProject'>Add Project</a></div>";
	
}

$message	.=	"</td>";
			

$reply = array(
				'success' 	=>		'1',
				'message' 	=>   	$message
			);
			
echo json_encode($reply);
exit;



?>