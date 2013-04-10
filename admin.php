<?php
session_start();

if(!isset($_SESSION['loginStatus']) || $_SESSION['loginStatus'] != 'success')
{
	$url = 'login.php';
	header("Location: $url");
	exit;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome
<?php 
echo "$_SESSION[firstName] $_SESSION[lastName]";
?>
</title>
<link rel="stylesheet" href="css/main.css" type="text/css"/>
<link rel="stylesheet" href="css/main2.css" type="text/css"/>
<link rel="stylesheet" href="css/leftbar.css" type="text/css"/>


<script type="text/javascript" src="scripts/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="scripts/jquery.form.js"></script>
<script src="scripts/adminMain.php"></script>
<script src="scripts/adminMiscFunctions.js"></script>


</head>

<body>
<?php
echo <<<EOT
<p class="heading"> Welcome to Mumbai University<p>
<hr />
<br />
<table width="1000" border="0" cellspacing="0" cellpadding="0" class="header">
  <tr>
    <td style="width: 300px;"><p class="myText1"><b>Welcome $_SESSION[firstName] $_SESSION[lastName]</b></p></td>
	<td style="width: 530px;"></td>
    <td style="width: 45px;" align='right'><a href="">Home</a> |</td>
	<td style="width: 80px;" align='right'><a href="">My Account</a> |</td>
    <td style="width: 45px;" align='right'><a href="logout.php">Logout</a></td>
  </tr>
</table>
<br />

<table width="1000" border="0" cellspacing="0" cellpadding="0" class="header">
  <tr>
    <td style="width: 200px;" valign="top">
		<div id="leftbar">
			<fieldset id="leatherboard">
				<legend>
					<p class="myText1"><b>Leatherboard</b></p>
				</legend>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td>
							<p class="leathermenu" id="addEmployee">Add Employee</p>
						</td>
					</tr>
					<tr>
						<td>
							<p class="leathermenu" id="addStudent">Add Student</p>
						</td>
					</tr>
					<tr>
						<td>
							<p class="leathermenu" id="addCourses">Add Courses</p>
						</td>
					</tr>
					<tr>
						<td>
							<p class="leathermenu" id="addSections">Add Sections</p>
						</td>
					</tr>
					<tr>
						<td>
							<p class="leathermenu" id="registerStudents">Register Students</p>
						</td>
					</tr>
					<tr>
						<td>
							<p class="leathermenu" id="dropStudents">Drop Students</p>
						</td>
					</tr>
				</table>
			</fieldset>
		</div>
		
	</td>
    <td valign="top" rowspan='2'>
		<div id="adminWorkArea">
		
		</div>
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="width: 200px;" valign="top">
		<div id="leftbar">
			<fieldset id="leatherboard">
				<legend>
					<p class="myText1"><b>Info Center</b></p>
				</legend>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				
					<tr>
						<td>
							<p class="leathermenu" id="searchCourse">Search Course</p>
						</td>
					</tr>
					<tr>
				
					<tr>
						<td>
							<p class="leathermenu" id="viewStudents">Student Lists</p>
						</td>
					</tr>
					
					<tr>
						<td>
							<p class="leathermenu" id="studInfo">Student Info</p>
						</td>
					</tr>
					<tr>
						<td>
							<p class="leathermenu" id="empInfo">Employee Info</p>
						</td>
					</tr>
					
				</table>
			</fieldset>
		</div>
		
	</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<br />

<hr/>
<table width="1000" border="0" cellspacing="0" cellpadding="0" class="header">
  <tr height="10"></tr>
  <tr>
  	<td>Copyright - Aniket Jadhav
	</td>
	<td>
	</td>
	<td>
	</td>
	<td>
	</td>

</table>

<br />
<br />

EOT;
?>
</body>
</html>