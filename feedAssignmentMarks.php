<?php
@session_start();
require_once('classMain.php');
$profileObject	= new MyProfile();


$sectionId	=	$_POST['sectionId'];


$query	=	"	SELECT		s.StudentId, FirstName, LastName
				FROM		Students s
						JOIN
							CourseRegistration c
						ON
							(c.StudentId = s.StudentId)
						
				WHERE		SectionId	=	$sectionId
				ORDER BY	FirstName, LastName, StudentId
				
			";
			
$result	=	mysql_query($query);

if(!$result)
{
	$reply = array(
					'success' 	=>		'0',
					'message' 	=>   	"<div class='error'>".mysql_error()."</div>"
				);
				
	echo json_encode($reply);
	exit;
}
$totalStudents	=	mysql_num_rows($result);

if($totalStudents == 0)
{
	$reply = array(
					'success' 	=>		'0',
					'message' 	=>   	"<td></td><td></td><td><div class='error'>No Students Registered</div></td>",
					'total'		=>		$totalStudents
				);
				
	echo json_encode($reply);
	exit;
	
}
		
$message	=	"<td colspan='3'><hr><br>";



$message	.=	"Assignment Date: <select name='day' id='day' class='select-input' onChange='checkdate()' >
				<option value='' selected='selected'>Day:</option>";				
for ($i = 1; $i<=31; $i++)
{
	$message	.= "<option value = '$i'>$i</option>";
}
$message	.=	"</select>";

$message	.=	"<select name='month' id='month' class='select-input' onChange='checkdate()' >
      <option value='' selected='selected'>Month:</option>
      <option value='1'>Jan</option>
      <option value='2'>Feb</option>
      <option value='3'>Mar</option>
      <option value='4'>Apr</option>
      <option value='5'>May</option>
      <option value='6'>Jun</option>
      <option value='7'>Jul</option>
      <option value='8'>Aug</option>
      <option value='9'>Sep</option>
      <option value='10'>Oct</option>
      <option value='11'>Nov</option>
      <option value='12'>Dec</option>
    </select>
    
    <select name='year' id='year' class='select-input' onChange='checkdate()' ><option value='' selected='selected'>Year:</option>";
	
for ($i = date('Y'); $i<=date('Y')+1; $i++)
{
	$message	.=	 "<option value = '$i'>$i</option>";
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
							<input type='text' id='gradeTextBox".$j."' rel='$rows[StudentId]' name='$sectionId' class='gradeText' maxlength='5' />
						</td>
					</tr>";
	$i=($i+1)%2;
	$j++;
}
$message	.=	"<tr height='20'></tr><tr><td></td><td></td><td></td><td><input class='login' type='submit' value='Submit' name='GradeAssignmentSubmit' id='GradeAssignmentSubmit' /></td>";
$message	.=	"</table></td>";


	$reply = array(
					'success' 	=>		'1',
					'message' 	=>   	$message,
					'total'		=>		$totalStudents
				);
				
	echo json_encode($reply);
	exit;



?>