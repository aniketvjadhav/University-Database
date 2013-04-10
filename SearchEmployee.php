
<?php

@session_start();
require_once('classMain.php');
$profileObject	= new MyProfile();

$employeeId 	= $profileObject->sanitizeString($_POST["employeeId"]);
$netId			= $profileObject->sanitizeString($_POST["netId"]);
$name			= $profileObject->sanitizeString($_POST["name"]);

if ( $employeeId == "" && $netId == "" && $name=="" )
{
	$reply = array(
					'success' 	=>		'0',
					'message' 	=>   	"<div class='error'>Fill atleast one detail</div>"
				);
				
	echo json_encode($reply);
	exit;
	
}


$query	=	"	SELECT		EmployeeId, NetId, FirstName, LastName, Email, OfficePhone
				FROM		Employees e
				WHERE		LOWER(NetId) 	LIKE LOWER('%".$netId."%')
				AND		(
							LOWER(FirstName)	LIKE LOWER('%".$name."%')
				OR			LOWER(LastName)		LIKE LOWER('%".$name."%')
				OR			LOWER(CONCAT(FirstName, ' ', LastName)) LIKE LOWER('%".$name."%')
				OR			LOWER(CONCAT(LastName, ' ', FirstName)) LIKE LOWER('%".$name."%')
						)
				AND			EmployeeId	LIKE ('%".$employeeId."%')
				
				
				";
				

if($employeeId != "")
{
	$query	.=	"	UNION		DISTINCT
					SELECT		EmployeeId, NetId, FirstName, LastName, Email, OfficePhone
					FROM		Employees e
					WHERE		EmployeeId	LIKE ('%".$employeeId."%')
				";

}

if($netId != "")
{
	$query	.=	"	UNION		DISTINCT
					SELECT		EmployeeId, NetId, FirstName, LastName, Email, OfficePhone
					FROM		Employees e
					WHERE		LOWER(NetId) 	LIKE LOWER('%".$netId."%')
				";

}


if($name != "")
{
	$query	.=	"	UNION		DISTINCT
					SELECT		EmployeeId, NetId, FirstName, LastName, Email, OfficePhone
					FROM		Employees e
					WHERE		LOWER(FirstName)	LIKE LOWER('%".$name."%')
					OR			LOWER(LastName)		LIKE LOWER('%".$name."%')
					OR			LOWER(CONCAT(FirstName, ' ', LastName)) LIKE LOWER('%".$name."%')
					OR			LOWER(CONCAT(LastName, ' ', FirstName)) LIKE LOWER('%".$name."%')
				";

}


	
	$result = mysql_query($query);
	
	if(!$result)
	{
		$reply = array(
						'success' 	=>		'0',
						'message' 	=>   	"<div class='error'>".mysql_error()."</div>"
					);
					
		echo json_encode($reply);
		exit;
		
	}
	
$numrows = mysql_num_rows($result);
$i = 1;

if ($numrows > 0)
{
	$info	=	"<p class='myText2'>Search Result</p><hr><br><div class='courseResultBox'><table width='100%' border='0' cellpadding='' cellspacing='5'>";
	
	while($rows = mysql_fetch_assoc($result))
	{
		$info .= "
				
		
				<tr>
				
					<td width='20' valign='top'>
						<b>$i.</b>
					</td>
					<td width='70' valign='top' align='left'>
						<b>Id: </b> $rows[EmployeeId]
					</td>
					
					<td valign='top' align='left' width='200'>
						<b>Name:</b><br>$rows[FirstName] $rows[LastName]
					</td>
					<td>
						<b>Office Phone:</b> <br> $rows[OfficePhone]
					</td>
					
				</tr>
				
				<tr>
				
					<td width='20' valign='top'>
						
					</td>
					<td width='70' valign='top'>
						<b>Net Id:</b> <br>$rows[NetId]
					</td>
					
					<td valign='top'>
						
					</td>
					<td>
					<b>E-mail</b><br>
					$rows[Email]
					</td>
					
					
				</tr>
				<tr height='10'>
				<td colspan='4'><hr>
				</tr>
				
				";
				
		$i++;
		
	}
	
	$info .= "</table></div>";
	
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
						'message' 	=>   	"<hr><br><p class='myText2'>No Student Found !!!</p><hr>",
						'query'		=>		""
						
					);
					
		echo json_encode($reply);
		exit;	



?>