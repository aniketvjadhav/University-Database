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
<div class='bgImage'></div>
</fieldset>
</div>

<div id="employeeForm">
<fieldset id="workArea">
<legend>
<p class="myText1"><b>Employee details</b></p>
</legend>

<p class="myText">All the details are manditory</p>
<hr /><br />

    <table width="550" border="0" cellspacing="0" cellpadding="0" class="header">
      <tr id="empSubType">
       <td></td>
       <td></td>
       <td>
       	<label for='tstaff'>
        	<input type='radio' class='radio-input'  name='empSTName' id='tstaff' value='1'>Teaching Staff 
        </label>
        <label for='ntstaff'>
        	<input type='radio' class='radio-input' name='empSTName' id='ntstaff' value='2'>Non Teaching Staff
            </label>
       </td>
      </tr>
      <tr id="teachingPosts" style="display:none;">
       <td></td>
       <td></td>
       <td>
		<?php
        
        require_once('classMain.php');
        $profileObject	= new MyProfile();
        $query = "	SELECT	TeachingPostId, TeachingPostName
					FROM	TeachingPosts
			";
			
		$result = mysql_query($query);
		if(!$result)
				mysql_error();
				
		echo "<select class='select-input' name='selectTPosts' id='selectTPosts'>";
			echo "<option selected='selected' value='0'>Select Teaching Posts</option>";
			while( $row = mysql_fetch_assoc($result))
			{
				echo "<option value='$row[TeachingPostId]'>$row[TeachingPostName]</option>";
			}
			
			echo "</select>";		
		
		
       ?>
       </td>
      </tr>
      <tr id="NonTeachingPosts" style="display:none;">      
       <td></td>
       <td></td>
       <td>
		<?php
        
        require_once('classMain.php');
        
        $query = "	SELECT	NTPostId, NTPostName
					FROM	NonTeachingPost
			";
			
		$result = mysql_query($query);
		if(!$result)
				mysql_error();
				
		echo "<select class='select-input' name='selectNTPosts' id='selectNTPosts'>";
			echo "<option selected='selected' value='0'>Select Non Teaching Staff Posts</option>";
			while( $row = mysql_fetch_assoc($result))
			{
				echo "<option value='$row[NTPostId]'>$row[NTPostName]</option>";
			}
			
			echo "</select>";		
		
		
       ?>
      </td>
      </tr>
      <tr>
        <td width="160" align="right"><label for="netId">Net Id</label></td>
        <td width="10">:</td>
        <td width="370"><input class="text-input" type="text" name="netId" id="netId" /></td>
      </tr>
      <tr>
        <td align="right"><label for="ssn">SSN</label></td>
        <td>:</td>
        <td><input class="text-input" onkeydown="return isNumberKey(event)" type="text" name="ssn" id="ssn" maxlength="10" /></td>
      </tr>
      <tr>
        <td align="right"><label for="pass">Password</label></td>
        <td>:</td>
        <td><input class="text-input" type="password" name="pass" id="pass" /></td>
      </tr>
      <tr>
        <td align="right"><label for="cpass">Confirm Password</label></td>
        <td>:</td>
        <td><input class="text-input" type="password" name="cpass" id="cpass" /></td>
      </tr>
      
      <tr>
        <td align="right"><label for="fname">First Name</label></td>
        <td>:</td>
        <td><input class="text-input" type="text" name="fname" id="fname" /></td>
      </tr>
      <tr>
        <td align="right"><label for="lname">Last Name</label></td>
        <td>:</td>
        <td><input class="text-input" type="text" name="lname" id="lname" /></td>
      </tr>
      <tr>
        <td align="right"><label for="salary">Salary</label></td>
        <td>:</td>
        <td><input class="text-input" maxlength="10" onkeypress="return isNumberKey(event)" type="text" name="salary" id="salary" /></td>
      </tr>
      <tr>
        <td align="right"><label for="email">E-mail</label></td>
        <td>:</td>
        <td><input class="text-input" type="text" name="email" id="email" /></td>
      </tr>
      <tr height="20px">
      	<td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
      <td></td>	
      <td></td>
      <td id="result"></td>
      </tr>
      <tr>
        <td align="right"></td>
        <td></td>
        <td><input class="login" type="submit" value="Create" name="createEmployee" id="createEmployee" /></td>
      </tr>
    </table>


</fieldset>
</div>

<!--**********************************************END OF EMPLOYEE***********************************-->

<div id="studentForm">

<fieldset id="workArea">
<legend>
<p class="myText1"><b>Student details</b></p>
</legend>

<p class="myText">All the details are manditory</p>
<hr /><br />

<table width="550" border="0" cellspacing="0" cellpadding="0" class="header">
  <tr>
    <td width="160" align="right"><label for="netId">Net Id</label></td>
    <td width="10">:</td>
    <td width="370"><input class="text-input" type="text" name="netId" id="netId" /></td>
  </tr>
  <tr>
    <td align="right"><label for="pass">Password</label></td>
    <td>:</td>
    <td><input class="text-input" type="password" name="pass" id="pass" /></td>
  </tr>
  <tr>
    <td align="right"><label for="cpass">Confirm Password</label></td>
    <td>:</td>
    <td><input class="text-input" type="password" name="cpass" id="cpass" /></td>
  </tr>
  
  <tr>
    <td align="right"><label for="fname">First Name</label></td>
    <td>:</td>
    <td><input class="text-input" type="text" name="fname" id="fname" /></td>
  </tr>
  <tr>
    <td align="right"><label for="lname">Last Name</label></td>
    <td>:</td>
    <td><input class="text-input" type="text" name="lname" id="lname" /></td>
  </tr>
  <tr>
    <td align="right"><label for="department">Department</label></td>
    <td>:</td>
    <td>
    <?php
	require_once('classMain.php');
       
        $query = "	SELECT	DepartmentId, DepartmentName
					FROM	Departments
					ORDER BY	DepartmentName
			";
			
		$result = mysql_query($query);
		if(!$result)
				mysql_error();
				
		echo "<select class='select-input' name='department' id='department'>";
			echo "<option selected='selected' value='0'>Select One</option>";
			while( $row = mysql_fetch_assoc($result))
			{
				echo "<option value='$row[DepartmentId]'>$row[DepartmentName]</option>";
			}
			
			echo "</select>";		
		
		
       ?>
    
    </td>
  </tr>
  <tr>
    <td align="right"></td>
    <td></td>
    <td id="majorResult"></td>
  </tr>
  
  <tr>
    <td align="right"><label for="email">E-mail</label></td>
    <td>:</td>
    <td><input class="text-input" type="text" name="email" id="email" /></td>
  </tr>
  
  <tr>
  <td>
  </td>
  <td>
  </td>
  <td>
  	<label for='grad'>
        	<input type='radio' class='radio-input'  name='stdType' id='grad' value='1'>Graduate
        </label>
        <label for='ugrad'>
        	<input type='radio' class='radio-input' name='stdType' id='ugrad' value='2'>Under Graduate
	</label>
  </td>
  </tr>
  
  <tr height="10"> 
    
  </tr>
  <tr>
      <td></td>	
      <td></td>
      <td id="result"></td>
  </tr>
  <tr>  
   <tr>
    <td align="right"></td>
    <td></td>
    <td><input class="login" type="submit" value="Create" name="createStudent" id="createStudent" /></td>
  </tr>
  
     
</table>
</fieldset>
</div>

<!--**********************************************END OF Students***********************************-->


<div id="courseForm">

<fieldset id="workArea">
<legend>
<p class="myText1"><b>Course details</b></p>
</legend>

<p class="myText">All the details are manditory</p>
<hr /><br />

<table width="550" border="0" cellspacing="0" cellpadding="0" class="header">
  <tr>
    <td width="160" align="right"><label for="courseId">Course Number</label></td>
    <td width="10">:</td>
    <td width="370"><input class="text-input" type="text" name="courseId" id="courseId" /></td>
  </tr>
  
  <tr>
    <td width="160" align="right"><label for="courseName">Course Name</label></td>
    <td width="10">:</td>
    <td width="370"><input class="text-input" type="text" name="courseName" id="courseName" /></td>
  </tr>
  
  <tr>
    <td width="160" align="right"><label for="totalCredits">Total Credits</label></td>
    <td width="10">:</td>
    <td width="370"><input class="text-input" maxlength="2" type="text" name="totalCredits" id="totalCredits" /></td>
  </tr>
  
    <tr>
    <td align="right"><label for="courseDept">Department</label></td>
    <td>:</td>
    <td>
    <?php
	require_once('classMain.php');
       
        $query = "	SELECT	DepartmentId, DepartmentName
					FROM	Departments
					ORDER BY	DepartmentName
			";
			
		$result = mysql_query($query);
		if(!$result)
				mysql_error();
				
		echo "<select class='select-input' name='courseDept' id='courseDept'>";
			echo "<option selected='selected' value='0'>Select One</option>";
			while( $row = mysql_fetch_assoc($result))
			{
				echo "<option value='$row[DepartmentId]'>$row[DepartmentName]</option>";
			}
			
			echo "</select>";		
		
		
       ?>
    
    </td>
  </tr>
  <tr height="10"> 
    
  </tr>
  <tr>
      <td></td>	
      <td></td>
      <td id="result"></td>
  </tr>
  <tr>  
   <tr>
    <td align="right"></td>
    <td></td>
    <td><input class="login" type="submit" value="Create" name="createCourse" id="createCourse" /></td>
  </tr>
 </table>


</fieldset>
</div>

<!--**********************************************END OF COURSES***********************************-->


<div id="sectionForm">

<fieldset id="workArea">
<legend>
<p class="myText1"><b>Section details</b></p>
</legend>

<p class="myText">All the details are manditory</p>
<hr /><br />

<table width="550" border="0" cellspacing="0" cellpadding="0" class="header">
  <tr>
    <td width="160" align="right"><label for="courseId">Course Number</label></td>
    <td width="10">:</td>
    <td width="370" colspan="2">
     <?php
	require_once('classMain.php');
       
        $query = "	SELECT	CourseId, CourseName
					FROM	Courses
					ORDER BY	CourseId, CourseName
			";
			
		$result = mysql_query($query);
		if(!$result)
				mysql_error();
				
		echo "<select class='select-input' name='sectionCourse' id='sectionCourse'>";
			echo "<option selected='selected' value='0'>Select Course</option>";
			while( $row = mysql_fetch_assoc($result))
			{
				echo "<option value='$row[CourseId]'>$row[CourseId] : $row[CourseName]</option>";
			}
			
			echo "</select>";		
		
		
       ?>
    
    
    </td>
  </tr>
  <tr>
    <td width="160" align="right"><label for="section">Section</label></td>
    <td width="10">:</td>
    <td width="370" colspan="2"><input class="text-input" type="text" name="section" id="section" /></td>
  </tr>
  
  <tr>
    <td width="160" align="right">Start Time</td>
    <td width="10">:</td>
    <td width="370" colspan="2"><select class='select-input' rel='time' name='shr' id='shr'>
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
    <td width="160" align="right">End Time</td>
    <td width="10">:</td>
    <td width="370" colspan="2"><select class='select-input' rel='time' name='ehr' id='ehr'>
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
  <tr>
    <td width="160" align="right"><label for="classroom">Classroom</label></td>
    <td width="10">:</td>
    <td width="370" colspan="2"><input class="text-input" type="text" name="classroom" id="classroom" /></td>
  </tr>
  
  <tr>
    <td width="160" align="right"><label for="profId">Instructor Id</label></td>
    <td width="10">:</td>
    <td width="370" colspan="2">
    <?php
	require_once('classMain.php');
       
        $query = "	SELECT	FirstName, LastName, e.EmployeeId
					FROM	Employees e
						JOIN
							TeachingStaff t
						ON
							(e.EmployeeId = t.EmployeeId)
					ORDER BY	FirstName, LastName
			";
			
		$result = mysql_query($query);
		if(!$result)
				mysql_error();
				
		echo "<select class='select-input' name='profId' id='profId'>";
			echo "<option selected='selected' value='0'>Select Instructor</option>";
			while( $row = mysql_fetch_assoc($result))
			{
				echo "<option value='$row[EmployeeId]'>$row[FirstName] $row[LastName]</option>";
			}
			
			echo "</select>";		
		
		
       ?>
    </td>
  </tr> 

</table>



<table width="550" border="0" cellspacing="0" cellpadding="0" class="header" id="lectDayTable">
    <tr>
    <td width="160" align="right"><label for="lectDay">Lecture Days</label></td>
    <td width="10">:</td>
    <td width="185">
    	<select class="select-input" rel='time' name="lectDay" id="lectDay">
    
            <option value='0'>Days</option>
            <?php
            $days = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
            
            for( $i = 0; $i<=6; $i++)
            {
                $j = $i+1;
                echo "<option value='$j'>$days[$i]</option>";
            }
        
            ?>
	    </select>
    
    </td>
    <td width="185">
    	<p class="handle" id="addDays">Add Days</p>
    </td>
  </tr>
</table>

<table width="550" border="0" cellspacing="0" cellpadding="0" class="header">
  <tr>
    <td width="160" align="right"><label for="semester">Semester</label></td>
    <td width="10">:</td>
    <td width="370">
    <select class="select-input" rel='time' name="semester" id="semester">
    <option value='0'>Semester</option>
    <option value='1'>Fall</option>
    <option value='2'>Spring</option>
    <option value='3'>Summer</option>
    </select>
    
    <select class="select-input" rel='time' name="semYear" id="semYear">
    <option value='0'>Year</option>
	<?php
		$current = date("Y");
		for( $i = $current; $i<=$current+3; $i++)
		{
			echo "<option value='$i'>$i</option>";
		}
    
    ?>
    </select>
    
   	</td>
   </tr>
   <tr>
    <td width="160" align="right"><label for="totalSeats">Total Seats</label></td>
    <td width="10">:</td>
    <td width="370">
    	<input type="text" name="totalSeats" id="totalSeats" class="text-input" maxlength="3" />
    </td>
   </tr>
   <tr height="10"> 
    
  </tr>
  <tr>
      <td></td>	
      <td></td>
      <td id="result"></td>
  </tr>
  <tr>  
   <tr>
    <td align="right"></td>
    <td></td>
    <td><input class="login" type="submit" value="Create" name="createSection" id="createSection" /></td>
  </tr>
   
   
</table>


</fieldset>
</div>

<!--**********************************************END OF SECTION***********************************-->




<div id="viewStudentsForm">

<fieldset id="workArea">
<legend>
<p class="myText1"><b>Enter Information</b></p>
</legend>

<p class="myText">All the details are manditory</p>
<hr /><br />

<table width="550" border="0" cellspacing="0" cellpadding="0" class="header">
  <tr>
    <td width="160" align="right"><label for="VSF_courseId">Select Semester</label></td>
    <td width="10">:</td>
    <td width="370"><select class="select-input" rel='time' name="VSF_semester" id="VSF_semester">
    <option value='0'>Semester</option>
    <option value='1'>Fall</option>
    <option value='2'>Spring</option>
    <option value='3'>Summer</option>
    </select>
    
    <select class="select-input" rel='time' name="VSF_semYear" id="VSF_semYear">
    <option value='0'>Year</option>
	<?php
		$current = date("Y");
		for( $i = $current; $i<=$current+3; $i++)
		{
			echo "<option value='$i'>$i</option>";
		}
    
    ?>
    </select></td>
  </tr>
	
  <tr>
    <td width="160" align="right"><label for="VSF_courseId">Select Course</label></td>
    <td width="10">:</td>
    <td width="370"><?php
	require_once('classMain.php');
       
        $query = "	SELECT		c.CourseId, c.CourseName
					FROM		Courses c
							JOIN
								Sections s
							ON
								(c.CourseId = s.CourseId)
					GROUP BY	c.CourseId
					ORDER BY	c.CourseId, c.CourseName
			";
			
		$result = mysql_query($query);
		if(!$result)
				mysql_error();
				
		echo "<select class='select-input' name='VSF_courseId' id='VSF_courseId'>";
			echo "<option selected='selected' value='0'>Select Course</option>";
			while( $row = mysql_fetch_assoc($result))
			{
				echo "<option value='$row[CourseId]'>$row[CourseId] : $row[CourseName]</option>";
			}
			
			echo "</select>";		
		
		
       ?></td>
  </tr>
  
  <tr id="VSF_sections">
    
  </tr>
  <tr height="10"> 
    
  </tr>
  <tr>
      <td></td>	
      <td></td>
      <td id="VSF_result"></td>
  </tr>

  
  <tr>
      
      <td id="VSF_studentsList" colspan="3"></td>
  </tr>
 </table>



</fieldset>
</div>


<!--**********************************************END OF Students List***********************************-->


<div id="courseRegForm">

<fieldset id="workArea">
<legend>
<p class="myText1"><b>Course Register details</b></p>
</legend>

<p class="myText">All the details are manditory</p>
<hr /><br />

<table width="550" border="0" cellspacing="0" cellpadding="0" class="header">

  <tr>
    <td width="160" align="right"><label for="CRF_studentId">Student Id</label></td>
    <td width="10">:</td>
    <td width="370"><input class="text-input" type="text" name="CRF_studentId" id="CRF_studentId" /></td>
  </tr>
  
   <tr>
    <td width="160" align="right"><label for="CRF_courseId">Select Semester</label></td>
    <td width="10">:</td>
    <td width="370"><select class="select-input" rel='time' name="CRF_semester" id="CRF_semester">
    <option value='0'>Semester</option>
    <option value='1'>Fall</option>
    <option value='2'>Spring</option>
    <option value='3'>Summer</option>
    </select>
    
    <select class="select-input" rel='time' name="CRF_semYear" id="CRF_semYear">
    <option value='0'>Year</option>
	<?php
		$current = date("Y");
		for( $i = $current; $i<=$current+3; $i++)
		{
			echo "<option value='$i'>$i</option>";
		}
    
    ?>
    </select></td>
  </tr>
  
  
  <tr>
    <td width="160" align="right"><label for="CRF_courseId">Course Number</label></td>
    <td width="10">:</td>
    <td width="370"><input class="text-input" type="text" name="CRF_courseId" id="CRF_courseId" /></td>
  </tr>
  
    <tr>
    <td align="right"><label for="CRF_section">Section</label></td>
    <td>:</td>
    <td>
   		<input class="text-input" type="text" name="CRF_section" id="CRF_section" />
    </td>
  </tr>
  <tr height="10"> 
    
  </tr>
  <tr>
      <td></td>	
      <td></td>
      <td id="CRF_result"></td>
  </tr>
  <tr>  
   <tr>
    <td align="right"></td>
    <td></td>
    <td id="CRF_confirmButtons"><input class="login" type="submit" value="Register" name="CRF_register" id="CRF_register" /></td>
  </tr>
 </table>

</fieldset>
</div>


<!--***************************************END OF Course Registration **********************************-->

<div id="courseDropForm">

<fieldset id="workArea">
<legend>
<p class="myText1"><b>Course Drop details</b></p>
</legend>

<p class="myText">All the details are manditory</p>
<hr /><br />

<table width="550" border="0" cellspacing="0" cellpadding="0" class="header">

  <tr>
    <td width="160" align="right"><label for="CDF_studentId">Student Id</label></td>
    <td width="10">:</td>
    <td width="370"><input class="text-input" type="text" name="CDF_studentId" id="CDF_studentId" /></td>
  </tr>
  
   <tr>
    <td width="160" align="right"><label for="CDF_courseId">Select Semester</label></td>
    <td width="10">:</td>
    <td width="370"><select class="select-input" rel='time' name="CDF_semester" id="CDF_semester">
    <option value='0'>Semester</option>
    <option value='1'>Fall</option>
    <option value='2'>Spring</option>
    <option value='3'>Summer</option>
    </select>
    
    <select class="select-input" rel='time' name="CDF_semYear" id="CDF_semYear">
    <option value='0'>Year</option>
	<?php
		$current = date("Y");
		for( $i = $current; $i<=$current+3; $i++)
		{
			echo "<option value='$i'>$i</option>";
		}
    
    ?>
    </select></td>
  </tr>
  
  
  <tr>
    <td width="160" align="right"><label for="CDF_courseId">Course Number</label></td>
    <td width="10">:</td>
    <td width="370"><input class="text-input" type="text" name="CDF_courseId" id="CDF_courseId" /></td>
  </tr>
  
    <tr>
    <td align="right"><label for="CDF_section">Section</label></td>
    <td>:</td>
    <td>
   		<input class="text-input" type="text" name="CDF_section" id="CDF_section" />
    </td>
  </tr>
  <tr height="10"> 
    
  </tr>
  <tr>
      <td></td>	
      <td></td>
      <td id="CDF_result"></td>
  </tr>
  <tr>  
   <tr>
    <td align="right"></td>
    <td></td>
    <td id="CDF_confirmButtons"><input class="login" type="submit" value="Drop" name="CDF_drop" id="CDF_drop" /></td>
  </tr>
 </table>

</fieldset>
</div>


<!--***************************************END OF Dropping Student **********************************-->

<!--***************************************Student Information**********************************-->

<div id="studInfoForm">

<fieldset id="workArea">
<legend>
<p class="myText1"><b>Student Information</b></p>
</legend>

<p class="myText">Enter any Information</p>
<hr /><br />

<table width="550" border="0" cellspacing="0" cellpadding="0" class="header">

  <tr>
    <td width="160" align="right"><label for="SI_studentId">Student Id</label></td>
    <td width="10">:</td>
    <td width="370"><input class="text-input" type="text" name="SI_studentId" id="SI_studentId" /></td>
  </tr>
  
   <tr>
    <td width="160" align="right"><label for="SI_netId">NetId</label></td>
    <td width="10">:</td>
    <td width="370">
    	<input class="text-input" type="text" name="SI_netId" id="SI_netId" />
    </td>
  </tr>
  
  
  <tr>
    <td width="160" align="right"><label for="SI_name">Name</label></td>
    <td width="10">:</td>
    <td width="370"><input class="text-input" type="text" name="SI_name" id="SI_name" /></td>
  </tr>
  
    
  <tr height="10"> 
    
  </tr>
  
  <tr height="20"> 
  
   
   <tr>
    <td align="right"></td>
    <td></td>
    <td id="SI_confirmButtons"><input class="login" type="submit" value="Search" name="SI_search" id="SI_search" /></td>
  </tr>
  
  <tr>
      <td colspan="3" id="SI_result"></td>
  </tr>
 </table>

</fieldset>
</div>


<!--***************************************Employee Information**********************************-->

<div id="empInfoForm">

<fieldset id="workArea">
<legend>
<p class="myText1"><b>Employee Information</b></p>
</legend>

<p class="myText">Enter any Information</p>
<hr /><br />

<table width="550" border="0" cellspacing="0" cellpadding="0" class="header">

  <tr>
    <td width="160" align="right"><label for="EI_EmployeeId">Employee Id</label></td>
    <td width="10">:</td>
    <td width="370"><input class="text-input" type="text" name="EI_EmployeeId" id="EI_EmployeeId" /></td>
  </tr>
  
   <tr>
    <td width="160" align="right"><label for="EI_netId">NetId</label></td>
    <td width="10">:</td>
    <td width="370">
    	<input class="text-input" type="text" name="EI_netId" id="EI_netId" />
    </td>
  </tr>
  
  
  <tr>
    <td width="160" align="right"><label for="EI_name">Name</label></td>
    <td width="10">:</td>
    <td width="370"><input class="text-input" type="text" name="EI_name" id="EI_name" /></td>
  </tr>
  
    
  <tr height="10"> 
    
  </tr>
  
  <tr height="20"> 
  
   
   <tr>
    <td align="right"></td>
    <td></td>
    <td id="EI_confirmButtons"><input class="login" type="submit" value="Search" name="EI_search" id="EI_search" /></td>
  </tr>
  
  <tr>
      <td colspan="3" id="EI_result"></td>
  </tr>
 </table>

</fieldset>
</div>

</body>
</html>