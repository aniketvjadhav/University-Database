<?php
@session_start();

if(!isset($_SESSION['loginStatus']) && $_SESSION['loginStatus'] != 'success')
{
	$url = 'login.php';
	header("Location: $url");
	exit;
}

$courseId	=	$_POST['courseId'];
$section	=	$_POST['section'];
$semester	=	$_POST['semester'];
$year		=	$_POST['year'];

if(	$courseId == '0' || $semester == '0' || $year == '0' || $section == '0')
{
	$reply = array(
					'success' 	=>		'0',
					'message' 	=>   	"<div class='error'>Fill all details</div>"
				);
				
		echo json_encode($reply);
		exit;	
}


$query	=	"	SELECT	SectionId
				FROM	Sections
				WHERE	CourseId	=	'$courseId'
				AND		Section		=	'$section'
				AND		Semester	=	$semester
				AND		SemYear		=	'$year'
				
			";

require_once('classMain.php');
$profileObject	= new MyProfile();
			
$result	=	mysql_query($query);

$rows		=	mysql_fetch_assoc($result);
$SectionId	=	$rows['SectionId'];

$query1	=	"	SELECT	s.StudentId, FirstName, LastName, NetId
				FROM	Students s
					JOIN
						CourseRegistration cr
					ON
						(s.StudentId = cr.StudentId)
				WHERE	cr.SectionId = $SectionId
				ORDER BY	FirstName, LastName
			";
			
$result	=	mysql_query($query1);

$numrows = mysql_num_rows($result);

	if ($numrows > 0)
	{
		$i = 1;
		$info	=	"<p class='myText2'>Search Result</p><hr><br><div class='courseResultBox'><table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='text-align: center'>";
		$info	.=	"<tr><td><b>#</b></td><td><b>Student Id</b></td><td><b>Net Id</b></td><td><b>First Name</b></td><td><b>Last Name</b></td><td></tr><tr height='5'><td colspan='5'><hr></td></tr>";
		while( $rows = mysql_fetch_assoc($result) )
		{
			$info	.= 	"<tr height='10'><td colspan='5'></td></tr><tr><td>$i</td><td>$rows[StudentId]</td><td>$rows[NetId]</td><td>$rows[FirstName]</td><td>$rows[LastName]</td><td></tr>";
			
			$info	.=	"<tr height='5'><td colspan='5'><hr></td></tr>";
			
			$i++;
			
		}
		
		$info	.=	"</table></div>";
		
		$reply = array(
					'success' 	=>		'1',
					'message' 	=>   	$info
				);
				
		echo json_encode($reply);
		exit;
		
		
	}
		
$reply = array(
					'success' 	=>		'1',
					'message' 	=>   	"<p class='myText2'>Search Result</p><hr><br>No Students Registered!!!"
				);
				
		echo json_encode($reply);
		exit;






?>