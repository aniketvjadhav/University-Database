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

$deptId	=	$_POST['deptNo'];

$query = "	SELECT		MajorId, MajorName
			FROM		Majors
			WHERE		DepartmentId = $deptId
			ORDER BY	MajorName
		";
		
$result	=	mysql_query($query);

$numrows = mysql_num_rows($result);

if ($numrows > 0)
{
	$x = "<select class='select-input' name='major' id='major'>";
	$x = $x."<option selected='selected' value='0'>Select Major</option>";
	
	while ($rows = mysql_fetch_assoc($result))
	{
		$x = $x."<option value='$rows[MajorId]'>$rows[MajorName]</option>";
	}
	$x = $x."</select>";
	
	$reply = array(
				'success' 	=>		'1',
				'message' 	=>   	$x
			);
			
	echo json_encode($reply);
	exit;
}

	$reply = array(
				'success' 	=>		'0',
				'message' 	=>   	'empty'
			);
			
	echo json_encode($reply);
	exit;



?>