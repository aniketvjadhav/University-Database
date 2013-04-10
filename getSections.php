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

$courseId	=	$profileObject->sanitizeString($_POST['courseId']);
$semester	=	$profileObject->sanitizeString($_POST['semester']);
$year		=	$profileObject->sanitizeString($_POST['year']);

if($courseId == '0' || $semester == '0' || $year=='0')
{
	$reply = array(
					'success' 	=>		'2',
					'message' 	=>   	"<div class='error'>Please enter all details</div>"
				);
				
		echo json_encode($reply);
		exit;
}

$query	=	"	SELECT	Section
				FROM	Sections
				WHERE	CourseId	=	'$courseId'
				AND		Semester	=	'$semester'
				AND		SemYear		=	'$year'
			";
			
$result	=	mysql_query($query);

if (!$result)
{
	$reply = array(
					'success' 	=>		'0',
					'message' 	=>   	"<div class='error'>$query</div>"
				);
				
		echo json_encode($reply);
		exit;
	
}

$numrows = mysql_num_rows($result);

	if ($numrows > 0)
	{
		$x = "<td align='right'>Select Section</td><td>:</td><td><select class='select-input' name='VSF_sectionsList' id='VSF_sectionsList'>";
		$x = $x."<option selected='selected' value='0'>Select Section</option>";
		
		while ($rows = mysql_fetch_assoc($result))
		{
			$x = $x."<option value='$rows[Section]'>$rows[Section]</option>";
		}
		$x = $x."</select></td>";
		
		$reply = array(
					'success' 	=>		'1',
					'message' 	=>   	$x
				);
				
		echo json_encode($reply);
		exit;
	}
	
	$reply = array(
					'success' 	=>		'2',
					'message' 	=>   	"No Sections Defined !!!"
				);
				
		echo json_encode($reply);
		exit;




?>