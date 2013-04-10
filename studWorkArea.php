<?php
session_start();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="css/main.css" type="text/css"/>
<link rel="stylesheet" href="css/main2.css" type="text/css"/>
<link rel="stylesheet" href="css/leftbar.css" type="text/css"/>



</head>

<body>
<div id="beginning">
<fieldset id="workArea">

</fieldset>
</div>


<div id="viewTranscriptsForm">
<fieldset id="workArea">
<legend>
<p class="myText1"><b>Your Transcripts</b></p>
</legend>



 <table width="550" border="0" cellspacing="0" cellpadding="0" class="header">
    <tr>
    <td width="160" align="right"><label for="VT_semester">Semester</label></td>
    <td width="10">:</td>
    <td width="370">
    <input id="studentId" type="hidden" value='<?php echo $_SESSION['userId']; ?>' />
    <select class="select-input" name="VT_semester" id="VT_semester">
   	<option value="0">Select Semester</option>
	<?php
	require_once('classMain.php');
	$profileObject	= new MyProfile();
	
	$query = "	SELECT	Semester, SemYear
				FROM	CourseRegistration c
					JOIN
						Sections s
					ON
						(c.SectionId = s.SectionId)
				WHERE	c.StudentId = $_SESSION[userId]
				GROUP BY	Semester, SemYear
			";
	
	$result		=	mysql_query($query);
	
	if(!$result)
	echo mysql_error();
	
	while($rows	= mysql_fetch_assoc($result))
	{
		$x = "";
		switch($rows["Semester"])
		{
			case "1": 	$x = "Fall";
						break;
			
			case "2": 	$x = "Spring";
						break;
			
			case "3":	$x = "Summer";
						break;
		}
		$semester	=	$x." ".$rows['SemYear'];
		echo "<option value='$semester'>$semester</option>";
		
	}
	
	
	   	
    ?>
      </select>
   	</td>
   </tr>
   <tr height="20">
   
   </tr>
   <tr id="VT_results">
   
   </tr>
  
</table>


</fieldset>
</div>







</body>
</html>