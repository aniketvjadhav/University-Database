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

$query	=	"	SELECT		c.CourseId, c.CourseName,s.Section, LectureStartTime, LectureEndTime, LectureDay
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
$days	=	array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");

$message = "<td colspan='3'><br><hr><p class='myText2'>Search Result</p><hr><table width='100%' border = '0'>";
$message .= "";



while(	$rows	=	mysql_fetch_assoc($result) )
{

	$daysArray	=	explode(", ",$rows['LectureDay']);
	$daysName	=	"";
	for($j = 0; $j < count($daysArray); $j++)
	{
		$daysName	.= $days[$daysArray[$j]-1]." ";
	}
	
	$message .= "
				<tr>
					<td align='right'>
						<b>Course Number: </b>
					</td>
					<td align='center'>
						$rows[CourseId]
					</td>
					<td align='right'>
						<b>Lecture Timings: </b>
					</td>
					<td align='center'>
						$rows[LectureStartTime] - $rows[LectureEndTime]
					</td>
				</tr>
	
	
				<tr>
					<td align='right'>
						<b>Course Name: </b>
					</td>
					<td align='center'>
						$rows[CourseName]
					</td>
					<td align='right'>
						<b>Days: </b>
					</td>
					<td align='center'>
						$daysName
					</td>
				</tr>
				<tr height='2'>
				</tr>
				<tr>
				<td colspan='4'><hr></td>
				</tr>
				</tr>
				<tr height='5'>
				</tr>
			";

}

$message.= "</table></td>";


$reply = array(
				'success' 	=>		'0',
				'message' 	=>   	$message
			);
			
	echo json_encode($reply);
	exit;







?>