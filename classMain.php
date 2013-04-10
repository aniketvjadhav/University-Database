<?php
@session_start();


class MyProfile
{
	
	public $salt	= '&7&4.$a#^H^&3_5';
	
	public function __construct()
	{
		require_once 'logininfo.php';
		$db_server = mysql_connect($db_hostname, $db_username, $db_password);
		if (!$db_server) die($error = 1);
		
		mysql_select_db($db_database) or die($error = 1);
		
	}
	
	public function sanitizeString($var)
	{
		$var = addslashes($var);
		$var = htmlentities($var);
		$var = strip_tags($var);
		
		return $var;
	}
	
	
	public function checkPassword($user, $password)
	{
		$query	= "	SELECT		COUNT(*) Result, UserType
					FROM		Users
					WHERE		NetId		= '$user'
					AND			Password	= '$password'
					GROUP BY	UserType
				  ";
				  
		$result	= mysql_query($query);

		if (!$result)
			die (mysql_error());
			
		return $result;
	}
	
	public function setSession($user, $userType)
	{
		if ($userType == 1 || $userType == 2)
		{
			$query =	"	SELECT		e.FirstName, e.LastName, e.EmployeeId
							FROM		(
											SELECT		EmployeeId, NetId, FirstName, LastName
											FROM		Employees
											WHERE		NetId = '$user'
										)e
									JOIN
										Users u
									ON
										(e.NetId = u.NetId)
						";
			
			$result = mysql_query($query);
			
			if (!$result)
				die (mysql_error());
				
			$rows = mysql_fetch_assoc($result);
			
			$_SESSION['firstName']		=	$rows['FirstName'];
			$_SESSION['lastName']		=	$rows['LastName'];
			$_SESSION['userId']			=	$rows['EmployeeId'];
			$_SESSION['loginStatus'] 	=	'success';
			$_SESSION['netId']			=	$user;
			$_SESSION['userType']		=	$userType;			
		}
		
		if($userType == 3)
		{
			$query =	"	SELECT		e.FirstName, e.LastName, e.StudentId
							FROM		(
											SELECT		StudentId, NetId, FirstName, LastName
											FROM		Students
											WHERE		NetId = '$user'
										)e
									JOIN
										Users u
									ON
										(e.NetId = u.NetId)
						";
			
			$result = mysql_query($query);
			
			if (!$result)
				die (mysql_error());
				
			$rows = mysql_fetch_assoc($result);
			
			$_SESSION['firstName']		=	$rows['FirstName'];
			$_SESSION['lastName']		=	$rows['LastName'];
			$_SESSION['userId']			=	$rows['StudentId'];
			$_SESSION['loginStatus'] 	=	'success';
			$_SESSION['netId']			=	$user;
			$_SESSION['userType']		=	$userType;	
		}
					
	}
	
	public function insertTEmployee($empData)
	{
		$query	=	"call proc_addTEmployees('$empData[netId]', '$empData[pass]', $empData[ssn], '$empData[firstName]', '$empData[lastName]', '$empData[email]', $empData[salary], $empData[empTypeName])";
		
		//$query = "call proc_addTEmployees('rxu123899', 'abcd', 1233333222, 'Rajas', 'Upadhye', 'rajas@gmail.com', 90000, 2)";
		
		
		if(!mysql_query($query))
			return '1';
		else
			return '0';
		
	}
	
	
	public function insertNTEmployee($empData)
	{
		$query	=	"call proc_addNTEmployees('$empData[netId]', '$empData[pass]', $empData[ssn], '$empData[firstName]', '$empData[lastName]', '$empData[email]', $empData[salary], $empData[empTypeName])";
		
		//$query = "call proc_addTEmployees('rxu123899', 'abcd', 1233333222, 'Rajas', 'Upadhye', 'rajas@gmail.com', 90000, 2)";
		
		
		if(!mysql_query($query))
			return '1';
		else
			return '0';
		
	}
	
	public function insertGStudents($stdData)
	{
		$query	=	"call proc_addGStudents('$stdData[netId]','$stdData[pass]', '$stdData[firstName]', '$stdData[lastName]', '$stdData[email]', $stdData[dept], $stdData[major])";
		
		//$query = "call  proc_addGStudents('axj122312','asdf', 'sdfsa', 'asfdasdf', 'asdfasd', 1, 3)";
		
		if(!mysql_query($query))
			return mysql_error();
		else
			return '0';
		
	}
	
	public function insertUGStudents($stdData)
	{
		$query	=	"call proc_addUGStudents('$stdData[netId]','$stdData[pass]', '$stdData[firstName]', '$stdData[lastName]', '$stdData[email]', $stdData[dept], $stdData[major])";
		
		if(!mysql_query($query))
			return mysql_error();
		else
			return '0';
		
	}
	
	public function insertCourse($courseData)
	{
		$query	=	"call proc_addCourses('$courseData[cNumber]','$courseData[cName]', $courseData[credits], $courseData[dept])";
		
		if(!mysql_query($query))
		{
			
			
			return mysql_error();
		}
		else
			return '0';
		
	}
	
	public function insertSection($data)
	{
		$query 	=	"call proc_addSections('$data[cNumber]', '$data[sNumber]', '$data[startTime]', '$data[endTime]', '$data[classroom]', $data[profId], '$data[days]',$data[semester], '$data[semYear]', $data[totalSeats])";
		
		if(!mysql_query($query))
			return mysql_error();
		else
			return '0';	
		
	}
	
	public function registerStudentCourse($data)
	{
		$query	=	"call proc_regStudentCourse($data[studentId], $data[semester], '$data[year]', '$data[courseId]', '$data[section]')";
	
			if(!mysql_query($query))
					return mysql_error();
				else
					return '0';	
	}
	
	
	public function dropStudentCourse($data)
	{
		$query	=	"call proc_dropStudentCourse($data[studentId], $data[semester], '$data[year]', '$data[courseId]', '$data[section]')";
	
			if(!mysql_query($query))
					return mysql_error();
				else
					return '0';	
	}
	
	public function insertGrades($data)
	{
		$query	=	"call proc_insertGrades($data[StudentId], $data[SectionId], $data[ExamType], '$data[ExamMarks]', '$data[ExamDate]')";
		
		if(!mysql_query($query))
					return mysql_error();
				else
					return '0';	
		
		
	}
	
	public function updateGrades($data)
	{
		$query	=	"call proc_updateGrades($data[ExamId], '$data[ExamMarks]', '$data[ExamDate]')";
		
		if(!mysql_query($query))
					return mysql_error();
				else
					return '0';	
		
		
	}
	
}

?>