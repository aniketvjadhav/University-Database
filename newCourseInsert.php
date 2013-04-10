<?php
@session_start();


if(	
	$_POST['dept'] == '0'	||
	$_POST['cNumber'] == ''	||
	$_POST['cName'] == ''	||
	$_POST['credits'] == ''	
)
{
	$result = array(
					'success' 	=>		'0',
					'message' 	=>   	"<div class='error'>Fill all the details.</div>"
				);
				
	echo json_encode($result);
	exit;	

}

if(!is_numeric(substr($_POST['cNumber'],-4)))
{
	$result = array(
					'success' 	=>		'0',
					'message' 	=>   	"<div class='error'>Invalid course number</div>"
				);
				
	echo json_encode($result);
	exit;
}

if(!is_numeric($_POST['credits']))
{
	$result = array(
					'success' 	=>		'0',
					'message' 	=>   	"<div class='error'>Invalid credit number</div>"
				);
				
	echo json_encode($result);
	exit;
}


	require_once('classMain.php');
	$profileObject	= new MyProfile();
	
	$courseData = array(
							"cNumber"	=>	$profileObject->sanitizeString($_POST['cNumber']),
							"cName"		=>	$profileObject->sanitizeString($_POST['cName']),
							"credits"	=>	$profileObject->sanitizeString($_POST['credits']),
							"dept"		=>	$profileObject->sanitizeString($_POST['dept'])
						);
						
	$result = $profileObject->insertCourse($courseData);
	
if	($result != '0')
{
	$reply = array(
				'success' 	=>		'0',
				'message' 	=>   	"<div class='error'>$result</div>"
			);
			
	echo json_encode($reply);
	exit;
	
}
else
{
	$reply = array(
					'success' 	=>		'1',
					'message' 	=>   	"<div class='success'>1 Course Added</div>"
				);
				
	echo json_encode($reply);
	exit;
}
?>