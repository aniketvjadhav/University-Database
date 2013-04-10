<?php
@session_start();
require_once('classMain.php');
$profileObject	= new MyProfile();


$date		=	$_POST['date'];
$sectionId	=	$_POST['sectionId'];
$day		=	substr($_POST['date'],8,2);
$month		=	substr($_POST['date'],5,2);
$year		=	substr($_POST['date'],0,4);


$query		=	"	SELECT		s.StudentId, FirstName, LastName, ExamMarks, e.ExamId
					FROM		Exams e
							JOIN
								Students s
							ON
								(s.StudentId = e.StudentId)
					WHERE		ExamDate 	=	'$date'
					AND			Sectionid	=	$sectionId
					AND			ExamType	=	4
				";
				
$result		=	mysql_query($query);

if(!$result)
{
	$reply = array(
					'success' 	=>		'0',
					'message' 	=>   	"<td></td><td></td><td><div class='error'>".mysql_error()."</div></td>"
				);
				
	echo json_encode($reply);
	exit;
}
	
$totalStudents	=	mysql_num_rows($result);
$message	=	"<td colspan='3'><hr><br>";



$message	.=	"Project Date: <select name='day' id='day' class='select-input' onChange='checkdate()' >
				<option value='' selected='selected'>Day:</option>";				
for ($i = 1; $i<=31; $i++)
{
	$selected	=	"";
	
	if($i == $day)
		$selected = " selected='selected' ";
		
	$message	.= "<option value = '$i'".$selected.">$i</option>";
}
$message	.=	"</select>";

$message	.=	"<select name='month' id='month' class='select-input' onChange='checkdate()' >";
$message	.= "<option value='' selected='selected'>Month:</option>";
$monthsArray = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

for( $i = 0; $i<=11; $i++)
{
	$selected	=	"";
	$j = $i+1;
	if($j == $month)
		$selected = " selected='selected' ";
		
	
	$message	.= "<option value='$j'".$selected.">$monthsArray[$i]</option>";
}

      
      
$message	.= "</select>
    <select name='year' id='year' class='select-input' onChange='checkdate()' ><option value='' >Year:</option>";
	
for ($i = date('Y'); $i<=date('Y')+1; $i++)
{
	$selected	=	"";
	
	if($i == $year)
		$selected = " selected='selected' ";
	
	$message	.=	 "<option value = '$i'".$selected.">$i</option>";
}

$message	.=	 "</select>	";
    

$message	.=	"<table width='100%' border='0' cellpadding='0' cellspacing='0'><tr height='10'><td colspan='4'><hr></td></tr><tr height='10' class='gradeTop'><td colspan='4'></td></tr>";
$message	.=	"<tr style='text-align: center;' class='gradeTop'>
					<td width='90'>
						<b>SID</b>
					</td>
					<td colspan='2'>
						<b>Student Name</b>
					</td>
					<td>
						<b>Grade</b>
					</td>
				</tr>
				<tr class='gradeTop'>
					<td colspan='4'>
						<hr>
					</td>
				</tr>
				";

$i=1;
$j=1;



while($rows = mysql_fetch_assoc($result))
{
	$message	.=	"<tr class='grade".$i."'>
						<td style='text-align: center;'>
							<label for='gradeTextBox".$j."'>$rows[StudentId]</label>
						</td>
						<td width='90'>
						</td>
						<td width='190'>
							<label for='gradeTextBox".$j."'>$rows[FirstName] $rows[LastName]</label>
						</td>
						<td style='text-align: center;'>
							<input type='text' id='gradeTextBox".$j."' rel='$rows[StudentId]' name='$rows[ExamId]' class='gradeText' value='$rows[ExamMarks]' maxlength='5' />
						</td>
					</tr>";
	$i=($i+1)%2;
	$j++;
}
$message	.=	"<tr height='20'></tr><tr><td></td><td></td><td></td><td><input class='login' type='submit' value='Update' name='GradeProjectUpdateSubmit' id='GradeProjectUpdateSubmit' /></td>";
$message	.=	"</table></td>";


	$reply = array(
					'success' 	=>		'1',
					'message' 	=>   	$message,
					'total'		=>		$totalStudents
				);
				
	echo json_encode($reply);
	exit;








?>