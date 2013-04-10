<?php

if($_POST['shr'] != "0" && $_POST['smm']=='-1')
{
	$reply = array(
					'success' 	=>		'0',
					'message' 	=>   	"<div class='error'>Put correct Start Time</div>"
				);
				
	echo json_encode($reply);
	exit;
}

if($_POST['ehr'] != "0" && $_POST['emm']=='-1')
{
	$reply = array(
					'success' 	=>		'0',
					'message' 	=>   	"<div class='error'>Put correct end Time</div>"
				);
				
	echo json_encode($reply);
	exit;
}

require_once('classMain.php');
$profileObject	= new MyProfile();

$cName		= $profileObject->sanitizeString($_POST['cName']);
$cNumber	= $profileObject->sanitizeString($_POST['cNumber']);
$instructor	= $profileObject->sanitizeString($_POST['instructor']);
$stime 		= $profileObject->sanitizeString($_POST['shr']).":".$profileObject->sanitizeString($_POST['smm']).":00";
$etime 		= $profileObject->sanitizeString($_POST['ehr']).":".$profileObject->sanitizeString($_POST['emm']).":00";

if($stime == '0:-1:00')
	$estime	=	'1:00:00';
else
	$estime	=	$stime;
	
if($etime == '0:-1:00')
	$eetime		=	'23:59:00';
else
	$eetime		=	$etime;

$query = "	SELECT	*
			FROM	CourseSearch c
			WHERE	LOWER(CourseName) 	LIKE LOWER('%".$cName."%')
			AND		LOWER(CourseId)		LIKE LOWER('%".$cNumber."%')
			AND		(
						LOWER(FirstName)	LIKE LOWER('%".$instructor."%')
			OR			LOWER(LastName)		LIKE LOWER('%".$instructor."%')
			OR			LOWER(FLName)		LIKE LOWER('%".$instructor."%')
			OR			LOWER(LFName)		LIKE LOWER('%".$instructor."%')
					)
			AND		LectureStartTime >= '$estime'
			AND		LectureEndTime	<=	'$eetime'
			";

/*SELECT	* 
FROM	CourseSearch c 
WHERE	CourseName LIKE '%%' 
AND	 	CourseId	LIKE '%%' 
AND	 	( 
			FirstName	LIKE '%%' 
		OR 	LastName	LIKE '%%' 
		OR	FLName	 	LIKE '%%' 
		) 
AND 	LectureStartTime >= '0:-1:00' 
AND	 	LectureEndTime	<= '0:-1:00' 

UNION DISTINCT 

SELECT	* 
FROM	CourseSearch c 
WHERE	LectureStartTime >= 'stime' 
AND		LectureEndTime <= 'etime'	*/
			
if($cName != "")
{
	$query	.=	"	UNION	DISTINCT
					SELECT	*
					FROM	CourseSearch c
					WHERE	LOWER(CourseName) 	LIKE LOWER('%".$cName."%')
				";

}

if($cNumber != "")
{
	$query	.=	"	UNION	DISTINCT
					SELECT	*
					FROM	CourseSearch c
					WHERE	LOWER(CourseId)		LIKE LOWER('%".$cNumber."%')
				";

}

if($instructor != "")
{
	$query	.=	"	UNION	DISTINCT
					SELECT	*
					FROM	CourseSearch c
					WHERE	LOWER(FirstName)	LIKE LOWER('%".$instructor."%')
					OR		LOWER(LastName)		LIKE LOWER('%".$instructor."%')
					OR		LOWER(FLName)		LIKE LOWER('%".$instructor."%')
					OR		LOWER(LFName)		LIKE LOWER('%".$instructor."%')
				";
}

if($stime != '0:-1:00' && $etime != '0:-1:00')
{
	$query	.=	"	UNION DISTINCT
					SELECT	*
					FROM	CourseSearch c
					WHERE	LectureStartTime >= '$stime'
					AND	LectureEndTime <= '$etime'
				";
}

if($stime != '0:-1:00' && $etime == '0:-1:00')
{
	$query	.=	"	UNION DISTINCT
					SELECT	*
					FROM	CourseSearch c
					WHERE	LectureStartTime >= '$stime'
				";
}

if($stime == '0:-1:00' && $etime != '0:-1:00')
{
	$query	.=	"	UNION DISTINCT
					SELECT	*
					FROM	CourseSearch c
					WHERE	LectureEndTime <= '$etime'
				";
}


$result		=	mysql_query($query);

if(!$result)
{
	$reply = array(
					'success' 	=>		'0',
					'message' 	=>   	$query
				);
				
	echo json_encode($reply);
	exit;
	
}

$numrows = mysql_num_rows($result);

if ($numrows > 0)
{

	$info	=	"<p class='myText2'>Search Result</p><hr><br><div class='courseResultBox'><table width='100%' border='0' cellpadding='0' cellspacing='0'>";
	$i = 1;
	
	$days	=	array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
	
	while( $rows = mysql_fetch_assoc($result) )
	{
		$daysArray	=	explode(", ",$rows['LectureDay']);
		$daysName	=	"";
		for($j = 0; $j < count($daysArray); $j++)
		{
			$daysName	.= $days[$daysArray[$j]-1]." ";
		}
		
		$info .= "	
					<tr height='5'></tr>
					<tr>
						<td width='20' valign='top'><b>$i</b></td>
						<td width='180' valign='top'><b>Course Number:</b> <br>$rows[CourseId]</td>
						<td width='150' colspan='2' valign='top'><b>Course Name:</b> <br>$rows[CourseName]</td>
					</tr>
					<tr height='5'></tr>
					<tr>
						<td></td>
						<td valign='top'><b>By:</b><br>$rows[FirstName] $rows[LastName]</td>
						<td valign='top'><b>Time:</b><br>$rows[LectureStartTime] - $rows[LectureEndTime]</td>
						<td valign='top'><b>On:</b><br>$daysName</td>
					</tr>
					<tr height='5'></tr>
					<tr>
						<td></td>
						<td valign='top'><b>Classroom:</b><br>$rows[Classroom]</td>
						<td valign='top'><b>Total Seats:</b><br>$rows[TotalSeats]</td>
						<td valign='top'><b>Remaining Seats:</b><br>$rows[RemainingSeats]</td>
					<tr height='10'><td colspan='4'><hr></td></tr>
				";
		$i++;
		
	}
	
	$info	.=	"</table></div>";
	
	$reply = array(
						'success' 	=>		'1',
						'message' 	=>   	$info,
						'query'		=>		""
						
					);
					
		echo json_encode($reply);
		exit;
}

		$reply = array(
						'success' 	=>		'1',
						'message' 	=>   	"<hr><br><p class='myText2'>No Courses Found !!!</p><hr>",
						'query'		=>		""
						
					);
					
		echo json_encode($reply);
		exit;	
/*	

SELECT	*
FROM	CourseSearch c
WHERE	CourseName LIKE '%%'
AND	CourseId	LIKE '%%'
AND		(
                        FirstName	LIKE '%ri ba%'
OR			LastName	LIKE '%ri ba%'
OR			FLName		LIKE '%ri ba%'
                )
AND	LectureStartTime >= '16:00:00'
AND	LectureEndTime <= '17:15:00'

UNION DISTINCT

SELECT	*
FROM	CourseSearch c
WHERE	CourseId	LIKE '%%'

UNION DISTINCT

SELECT	*
FROM	CourseSearch c
WHERE	FirstName	LIKE '%ri ba%'
OR	LastName	LIKE '%ri ba%'
OR	FLName		LIKE '%ri ba%'

UNION DISTINCT

SELECT	*
FROM	CourseSearch c
WHERE	LectureStartTime >= '16:00:00'
AND	LectureEndTime <= '17:15:00'

SELECT	* 
FROM	CourseSearch c 
WHERE	CourseName LIKE '%database%' 
AND	 	CourseId	LIKE '%6363%' 
AND	 	( 
				FirstName LIKE '%raghav%' 
			OR	LastName	LIKE '%raghav%' 
			OR	FLName LIKE '%raghav%' 
		) 
AND	 	LectureStartTime >= '1:00:00' 
AND 	LectureEndTime	<=	'23:59:00' 

UNION	DISTINCT 

SELECT	* 
FROM	CourseSearch c 
WHERE	CourseName	LIKE '%database%'	

UNION	DISTINCT 

SELECT	* 
FROM CourseSearch c 
WHERE	CourseId	LIKE '%6363%'	

UNION DISTINCT 

SELECT	* 
FROM	CourseSearch c 
WHERE	FirstName LIKE '%raghav%' 
OR	 LastName	LIKE '%raghav%' 
OR	 FLName 	LIKE '%raghav%'	

UNION DISTINCT 

SELECT	* 
FROM CourseSearch c 
WHERE	LectureStartTime >= '03:02:00' 
AND 	LectureEndTime <= '17:15:00'

*/								
					
			


?>