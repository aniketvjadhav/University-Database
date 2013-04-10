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

<div id="searchCourseForm">
<fieldset id="workArea">
<legend>
<p class="myText1"><b>Course Search</b></p>
</legend>

<p class="myText">Enter any of the following</p>
<hr /><br />

    <table width="550" border="0" cellspacing="0" cellpadding="0" class="header">
      <tr>
       <td width="160" align="right"><label for="courseName">Course Name</label></td>
       <td width="10">:</td>
       <td width="370">
            <input id="courseName" class="text-input"/>      
       </td>
      </tr>
  
      <tr>
       <td width="160" align="right"><label for="courseNumber">Course Number</label></td>
       <td width="10">:</td>
       <td width="370">
       	<div class="ui-widget">
            <input name="courseNumber" id="courseNumber" class="text-input" />
        </div>
       </td>
      </tr>
      
      <tr>
       <td width="160" align="right"><label for="instructor">Instructor</label></td>
       <td width="10">:</td>
       <td width="370">
       	<div class="ui-widget">
            <input id="instructor" class="text-input" />
        </div>
       </td>
      </tr>
      
      <tr>
       <td width="160" align="right">Starts After</td>
       <td width="10">:</td>
       <td width="370">
       	<select class='select-input' rel='time' name='shr' id='shr'>
    <option selected='selected' value='0'>Hour</option>
   	<?php
		for ($i = 1; $i < 24; $i++)
		{
			if ($i < 10)
			$i = "0".$i;
			echo	"<option value='$i'>$i</option>";
		}
	?>
    </select>
    
    <select class='select-input' rel='time' name='smm' id='smm'>
    <option selected='selected' value='-1'>Mins</option>
   	<?php
		for ($i = 0; $i <= 59; $i++)
		{
			if ($i < 10)
			$i = "0".$i;
			echo	"<option value='$i'>$i</option>";
		}
	?>
    </select>
       </td>
      </tr>
      
      <tr>
       <td width="160" align="right">Ends Before</td>
       <td width="10">:</td>
       <td width="370">
       	<select class='select-input' rel='time' name='ehr' id='ehr'>
    <option selected='selected' value='0'>Hour</option>
   	<?php
		for ($i = 1; $i < 24; $i++)
		{
			if ($i < 10)
			$i = "0".$i;
			echo	"<option value='$i'>$i</option>";
		}
	?>
    </select>
    
    <select class='select-input' rel='time' name='emm' id='emm'>
    <option selected='selected' value='-1'>Mins</option>
   	<?php
		for ($i = 0; $i <= 59; $i++)
		{
			if ($i < 10)
			$i = "0".$i;
			echo	"<option value='$i'>$i</option>";
		}
	?>
    </select>
       </td>
      </tr>
      
      
      <tr height="20px">
      	<td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td align="right"></td>
        <td></td>
        <td><input class="login" type="submit" value="Search" name="courseSearch" id="courseSearch" /></td>
      </tr>
      <tr height="20px">
      	<td></td>
        <td></td>
        <td></td> 
      </tr>
      <tr>
      
      <td id="result" colspan="3"></td>
      </tr>
    </table>


</fieldset>
</div>

<!--******************************ASSIGNMENTS************************************-->

<div id="AssignmentArea">
<fieldset id="workArea">
<legend>
<p class="myText1"><b>Assignments</b></p>
</legend>


    <table width="550" border="0" cellspacing="0" cellpadding="0" class="header">
    <tr>
    <td width="160" align="right"><label for="AA_semester">Semester</label></td>
    <td width="10">:</td>
    <td width="370">
    <select class="select-input" rel='time' name="AA_semester" id="AA_semester">
    <option value='0'>Semester</option>
    <option value='1'>Fall</option>
    <option value='2'>Spring</option>
    <option value='3'>Summer</option>
    </select>
    
    <select class="select-input" rel='time' name="AA_semYear" id="AA_semYear">
    <option value='0'>Year</option>
	<?php
	require_once('classMain.php');
	$profileObject	= new MyProfile();

	$query = "	SELECT	MIN(SemYear) SemYear
				FROM	Sections
				WHERE	InstructorId = $_SESSION[userId]
			";
	
	$result		=	mysql_query($query);
	$rows		=	mysql_fetch_assoc($result);
	$SemYear	=	$rows['SemYear'];
	
		$current = date("Y");
		for( $i = $SemYear; $i<=$current; $i++)
		{
			echo "<option value='$i'>$i</option>";
		}
    
    ?>
    </select>
    
   	</td>
   </tr>
   <tr height="20">
   
   </tr>
   <tr id="AA_MyCourses">
   
   </tr>
   
   <tr id="AA_StudentLists">
   
   </tr>
   
   
   
   
</table>


</fieldset>
</div>



<!--*****************************************MidTerms**********************************************-->


<div id="MidtermsArea">
<fieldset id="workArea">
<legend>
<p class="myText1"><b>Midterms</b></p>
</legend>


    <table width="550" border="0" cellspacing="0" cellpadding="0" class="header">
    <tr>
    <td width="160" align="right"><label for="MA_semester">Semester</label></td>
    <td width="10">:</td>
    <td width="370">
    <select class="select-input" rel='time' name="MA_semester" id="MA_semester">
    <option value='0'>Semester</option>
    <option value='1'>Fall</option>
    <option value='2'>Spring</option>
    <option value='3'>Summer</option>
    </select>
    
    <select class="select-input" rel='time' name="MA_semYear" id="MA_semYear">
    <option value='0'>Year</option>
	<?php
	

	$query = "	SELECT	MIN(SemYear) SemYear
				FROM	Sections
				WHERE	InstructorId = $_SESSION[userId]
			";
	
	$result		=	mysql_query($query);
	$rows		=	mysql_fetch_assoc($result);
	$SemYear	=	$rows['SemYear'];
	
		$current = date("Y");
		for( $i = $SemYear; $i<=$current; $i++)
		{
			echo "<option value='$i'>$i</option>";
		}
    
    ?>
    </select>
    
   	</td>
   </tr>
   <tr height="20">
   
   </tr>
   <tr id="MA_MyCourses">
   
   </tr>
   
   <tr id="MA_StudentLists">
   
   </tr>
   
   
   
   
</table>


</fieldset>
</div>


<!--*****************************************Project**********************************************-->


<div id="ProjectArea">
<fieldset id="workArea">
<legend>
<p class="myText1"><b>Projects</b></p>
</legend>


    <table width="550" border="0" cellspacing="0" cellpadding="0" class="header">
    <tr>
    <td width="160" align="right"><label for="PA_semester">Semester</label></td>
    <td width="10">:</td>
    <td width="370">
    <select class="select-input" rel='time' name="PA_semester" id="PA_semester">
    <option value='0'>Semester</option>
    <option value='1'>Fall</option>
    <option value='2'>Spring</option>
    <option value='3'>Summer</option>
    </select>
    
    <select class="select-input" rel='time' name="PA_semYear" id="PA_semYear">
    <option value='0'>Year</option>
	<?php
	

	$query = "	SELECT	MIN(SemYear) SemYear
				FROM	Sections
				WHERE	InstructorId = $_SESSION[userId]
			";
	
	$result		=	mysql_query($query);
	$rows		=	mysql_fetch_assoc($result);
	$SemYear	=	$rows['SemYear'];
	
		$current = date("Y");
		for( $i = $SemYear; $i<=$current; $i++)
		{
			echo "<option value='$i'>$i</option>";
		}
    
    ?>
    </select>
    
   	</td>
   </tr>
   <tr height="20">
   
   </tr>
   <tr id="PA_MyCourses">
   
   </tr>
   
   <tr id="PA_StudentLists">
   
   </tr>
   
   
   
   
</table>


</fieldset>
</div>



<!--*****************************************Quiz**********************************************-->


<div id="QuizArea">
<fieldset id="workArea">
<legend>
<p class="myText1"><b>Quizes</b></p>
</legend>


    <table width="550" border="0" cellspacing="0" cellpadding="0" class="header">
    <tr>
    <td width="160" align="right"><label for="QA_semester">Quizes</label></td>
    <td width="10">:</td>
    <td width="370">
    <select class="select-input" rel='time' name="QA_semester" id="QA_semester">
    <option value='0'>Semester</option>
    <option value='1'>Fall</option>
    <option value='2'>Spring</option>
    <option value='3'>Summer</option>
    </select>
    
    <select class="select-input" rel='time' name="QA_semYear" id="QA_semYear">
    <option value='0'>Year</option>
	<?php
	

	$query = "	SELECT	MIN(SemYear) SemYear
				FROM	Sections
				WHERE	InstructorId = $_SESSION[userId]
			";
	
	$result		=	mysql_query($query);
	$rows		=	mysql_fetch_assoc($result);
	$SemYear	=	$rows['SemYear'];
	
		$current = date("Y");
		for( $i = $SemYear; $i<=$current; $i++)
		{
			echo "<option value='$i'>$i</option>";
		}
    
    ?>
    </select>
    
   	</td>
   </tr>
   <tr height="20">
   
   </tr>
   <tr id="QA_MyCourses">
   
   </tr>
   
   <tr id="QA_StudentLists">
   
   </tr>
   
   
   
   
</table>


</fieldset>
</div>


<!--*****************************************Quiz**********************************************-->


<div id="viewScheduleArea">
<fieldset id="workArea">
<legend>
<p class="myText1"><b>Your Schedule</b></p>
</legend>


    <table width="550" border="0" cellspacing="0" cellpadding="0" class="header">
    <tr>
    <td width="160" align="right"><label for="VS_semester">Select Semester</label></td>
    <td width="10">:</td>
    <td width="370">
    <select class="select-input" rel='time' name="VS_semester" id="VS_semester">
    <option value='0'>Semester</option>
    <option value='1'>Fall</option>
    <option value='2'>Spring</option>
    <option value='3'>Summer</option>
    </select>
    
    <select class="select-input" rel='time' name="VS_semYear" id="VS_semYear">
    <option value='0'>Year</option>
	<?php
	

	$query = "	SELECT	MIN(SemYear) SemYear
				FROM	Sections
				WHERE	InstructorId = $_SESSION[userId]
			";
	
	$result		=	mysql_query($query);
	$rows		=	mysql_fetch_assoc($result);
	$SemYear	=	$rows['SemYear'];
	
		$current = date("Y");
		for( $i = $SemYear; $i<=$current; $i++)
		{
			echo "<option value='$i'>$i</option>";
		}
    
    ?>
    </select>
    
   	</td>
   </tr>
   <tr height="20">
   
   </tr>
   <tr id="VS_MyCourses">
   
   </tr>
   
   <tr id="VS_StudentLists">
   
   </tr>
   
   
   
   
</table>


</fieldset>
</div>



</body>
</html>