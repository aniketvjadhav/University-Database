<?php
@session_start();

require_once('classMain.php');
$profileObject	= new MyProfile();

$studentId 	= $profileObject->sanitizeString($_POST['studentId']);
$sem		= $profileObject->sanitizeString($_POST['sem']);
$year		= $profileObject->sanitizeString($_POST['year']);



if ( $studentId == "" || $sem == "" || $year == "0" )
{
	$reply = array(
			'success' 	=>		'0',
			'message' 	=>   	"<td></td><td></td><td><div class='error'>Please select the semester</div></td>"
		);
		
	echo json_encode($reply);
	exit;
	
}


switch($sem)
{
	case "Fall": $sem = '1';
				break;
	case "Spring": $sem = '2';
				break;
	case "Summer": $sem = '3';
				break;
}


$query = "	SELECT (t.Total-p.Partial) AS Difference
			FROM	(
						SELECT		COUNT(*) Total
						FROM		Exams e
								JOIN
									Sections s
								ON
									(e.SectionId = s.SectionId)
						WHERE		e.StudentId = $studentId
						AND			Semester	= $sem
						AND			SemYear		= '$year'
					) t
				JOIN
					(
						SELECT		COUNT(*) Partial
						FROM		Exams e
								JOIN
									Sections s
								ON
									(e.SectionId = s.SectionId)
						WHERE		e.StudentId = $studentId
						AND			Semester	= $sem
						AND			SemYear		= '$year'
						AND			ExamMarks	<> ''
					
					) p
				ON (1=1)
				
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


$rows = mysql_fetch_assoc($result);

if($rows['Difference'] > 0)
{
	$reply = array(
			'success' 	=>		'0',
			'message' 	=>   	"<td></td><td></td><td><div class='error'>Transcripts not ready yet</div></td>"
		);
		
	echo json_encode($reply);
	exit;


}


$query1	=	"	SELECT		s.SectionId, c.CourseId, c.CourseName, s.Section, et.ExamName, AVG(ExamMarks) AverageMarks
				FROM		Exams e
						JOIN
							Sections s
						ON
							(e.SectionId = s.SectionId)
						JOIN
							Courses	c
						ON
							(c.CourseId = s.CourseId)
						JOIN
							ExamTypes et
						ON
							(e.ExamType = et.ExamTypeId)
				WHERE		e.StudentId = $studentId
				AND			Semester	= $sem
				AND			SemYear		= '$year'
				GROUP BY	e.SectionId, e.ExamType
				ORDER BY	s.SectionId, e.ExamType
			";



$query2	= 	"	SELECT		s.SectionId, c.CourseId, c.CourseName, Section, ExamMarks
				FROM		Exams e
						JOIN
							Sections s
						ON
							(e.SectionId = s.SectionId)
						JOIN
							Courses	c
						ON
							(c.CourseId = s.CourseId)
				WHERE		e.StudentId = $studentId
				AND			Semester	= $sem
				AND			SemYear		= '$year'
				AND			ExamType	=	1
				ORDER BY	s.SectionId, ExamDate
			";
		
$query3	= 	"	SELECT		s.SectionId, c.CourseId, c.CourseName, Section, ExamMarks
				FROM		Exams e
						JOIN
							Sections s
						ON
							(e.SectionId = s.SectionId)
						JOIN
							Courses	c
						ON
							(c.CourseId = s.CourseId)
				WHERE		e.StudentId = $studentId
				AND			Semester	= $sem
				AND			SemYear		= '$year'
				AND			ExamType	=	2
				ORDER BY	s.SectionId, ExamDate
			";
			
$query4	= 	"	SELECT		s.SectionId, c.CourseId, c.CourseName, Section, ExamMarks
				FROM		Exams e
						JOIN
							Sections s
						ON
							(e.SectionId = s.SectionId)
						JOIN
							Courses	c
						ON
							(c.CourseId = s.CourseId)
				WHERE		e.StudentId = $studentId
				AND			Semester	= $sem
				AND			SemYear		= '$year'
				AND			ExamType	=	3
				ORDER BY	s.SectionId, ExamDate
			";
			
$query5 =	"	SELECT		s.SectionId, c.CourseId, c.CourseName, Section, ExamMarks
				FROM		Exams e
						JOIN
							Sections s
						ON
							(e.SectionId = s.SectionId)
						JOIN
							Courses	c
						ON
							(c.CourseId = s.CourseId)
				WHERE		e.StudentId = $studentId
				AND			Semester	= $sem
				AND			SemYear		= '$year'
				AND			ExamType	=	4
				ORDER BY	s.SectionId, ExamDate
			";

$averageResult		=	mysql_query($query1);
$assignmentResult	=	mysql_query($query2);
$quizResult			=	mysql_query($query3);
$midtermResult		=	mysql_query($query4);
$projectResult		=	mysql_query($query5);

if(!$averageResult || !$assignmentResult || !$quizResult || !$midtermResult || !$projectResult)
{
	
$reply = array(
			'success' 	=>		'0',
			'message' 	=>   	"<td></td><td></td><td><div class='error'>".mysql_error()."</div></td>"
		);
		
	echo json_encode($reply);
	exit;

}



$info	=	"<td colspan='3'><hr><br><p class='myText2'>Your Transcripts</p><hr><table border='0' cellspacing='0' cellpadding='0' width='100%'>
			<tr>
				<td valign='top' width='300'> ";
					$i=1;unset($subjId);
					while($rows = mysql_fetch_assoc($assignmentResult))
					{
						if(!isset($subjId) || $rows['CourseId'] != $subjId)
						{
							
							$info .= "<br><b>Assignments - <br>$rows[CourseId] - $rows[CourseName].$rows[Section]</b><br>" ;						
							$i = 1;
						}
						
						$info .= "Assignment $i: $rows[ExamMarks]<br>";
						$i++;
						
						$subjId = $rows['CourseId'];
					}
$info .=	"	</td>
				
				<td valign='top' width='300'> ";
					$i=1;unset($subjId);
					while($rows = mysql_fetch_assoc($quizResult))
					{
						if(!isset($subjId) || $rows['CourseId'] != $subjId)
						{
							
							$info .= "<br><b>Quiz - <br>$rows[CourseId] - $rows[CourseName].$rows[Section]</b><br>" ;						
							$i = 1;
						}
						
						$info .= "Quiz $i: $rows[ExamMarks]<br>";
						$i++;
						
						$subjId = $rows['CourseId'];
					}
$info .=	"	</td>
				
			
				
			
			</tr>
			<tr height='10'>
			</tr>
			<tr>
				<td valign='top' width='300'> ";
					$i=1;unset($subjId);
					while($rows = mysql_fetch_assoc($midtermResult))
					{
						if(!isset($subjId) || $rows['CourseId'] != $subjId)
						{
							
							$info .= "<br><b>Midterms - <br>$rows[CourseId] - $rows[CourseName].$rows[Section]</b><br>" ;						
							$i = 1;
						}
						
						$info .= "Midterm $i: $rows[ExamMarks]<br>";
						$i++;
						
						$subjId = $rows['CourseId'];
					}
$info .=	"	</td>
				<td valign='top' width='300'> ";
					$i=1;unset($subjId);
					while($rows = mysql_fetch_assoc($projectResult))
					{
						if(!isset($subjId) || $rows['CourseId'] != $subjId)
						{
							
							$info .= "<br><b>Projects - <br>$rows[CourseId] - $rows[CourseName].$rows[Section]</b><br>" ;						
							$i = 1;
						}
						
						$info .= "Project $i: $rows[ExamMarks]<br>";
						$i++;
						
						$subjId = $rows['CourseId'];
					}
$info .=	"	</td>
				
			
			
			</tr>
			<tr height='10'>
			</tr>
			<tr>
			<td colspan='2'><br><b>Average Results</b>";
				unset($subjId);
				while($rows = mysql_fetch_assoc($averageResult))
				{
					if(!isset($subjId) || $rows['CourseId'] != $subjId)
						{
							
							$info .= "<br><b><br>$rows[CourseId] - $rows[CourseName].$rows[Section]</b><br>" ;						
						}
						
						$info .= "$rows[ExamName]: $rows[AverageMarks]<br>";
						$i++;
						
						$subjId = $rows['CourseId'];
				}
$info .=	"	</td>
			</tr>
			</table></td>";


$reply = array(
			'success' 	=>		'0',
			'message' 	=>   	$info
		);
		
	echo json_encode($reply);
	exit;

	

				
			
			
			
			
			
			
			
			
			
	
			
?>