<?php
@session_start();

if(	
	$_POST['courseNumber'] == '0'	||
	$_POST['section'] == ''	||
	$_POST['shr'] == '0'	||
	$_POST['smm'] == '-1'	||
	$_POST['ehr'] == '0'	||
	$_POST['emm'] == '-1'	||
	$_POST['classroom'] == ''	||
	$_POST['profId'] == '0'	||
	$_POST['days'] == '0'	||
	$_POST['semester'] == '0'	||
	$_POST['semYear'] == '0'	||
	$_POST['totalSeats'] == ''
)
{
	$result = array(
					'success' 	=>		'0',
					'message' 	=>   	"<div class='error'>Fill all the details.</div>"
				);
				
	echo json_encode($result);
	exit;	

}
		

if(!is_numeric($_POST['totalSeats']))
{
	$result = array(
					'success' 	=>		'0',
					'message' 	=>   	"<div class='error'>Invalid total seat number</div>"
				);
				
	echo json_encode($result);
	exit;
}

	require_once('classMain.php');
	$profileObject	= new MyProfile();
	
	$startTime = $profileObject->sanitizeString($_POST['shr']).":".$profileObject->sanitizeString($_POST['smm']).":00";
	$endTime   = $profileObject->sanitizeString($_POST['ehr']).":".$profileObject->sanitizeString($_POST['emm']).":00";
	
	$sectionData = array(
							"cNumber"		=>	$profileObject->sanitizeString($_POST['courseNumber']),
							"sNumber"		=>	$profileObject->sanitizeString($_POST['section']),
							"startTime"		=>	$startTime,
							"endTime"		=>	$endTime,
							"classroom"		=>	$profileObject->sanitizeString($_POST['classroom']),
							"profId"		=>	$profileObject->sanitizeString($_POST['profId']),
							"days"			=>	$profileObject->sanitizeString($_POST['days']),
							"semester"		=>	$profileObject->sanitizeString($_POST['semester']),
							"semYear"		=>	$profileObject->sanitizeString($_POST['semYear']),
							"totalSeats"	=>	$profileObject->sanitizeString($_POST['totalSeats'])
						);

	$result = $profileObject->insertSection($sectionData);
	
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
						'message' 	=>   	"<div class='success'>1 Section Created</div>"
					);
					
		echo json_encode($reply);
		exit;
	}


?>