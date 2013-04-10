-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2012 at 05:04 AM
-- Server version: 5.5.27-log
-- PHP Version: 5.4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `university`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_last_custom_error`()
    DETERMINISTIC
    SQL SECURITY INVOKER
BEGIN
  SELECT @error_code, @error_message;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_addCourses`(
    IN      P_CourseNumber     	CHAR(10),
    IN      P_CourseName      	VARCHAR(200),
	IN		P_Credits			INT(2),
	IN		P_Dept				INT(10)
)
BEGIN
	SET autocommit = 0;
	
	INSERT INTO university.Courses
		(CourseId, CourseName, TotalCredits, DepartmentId)
	VALUES
		(P_CourseNumber, P_CourseName, P_Credits, P_Dept);

	COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_addGStudents`(
    IN      P_NetId	        	CHAR(10),
    IN      P_Password      	VARCHAR(40),
	IN		P_FirstName			VARCHAR(100),
	IN		P_LastName			VARCHAR(100),
	IN		P_Email				VARCHAR(100),
	IN		P_Dept				INT(10),
	IN		P_Major				INT(5)
)
BEGIN

	DECLARE P_LastStudID   INT(10);
	
	SET autocommit = 0;

	INSERT	INTO	university.Users
		(NetId, Password, CreatedDate, UserType)
	VALUES
		(P_NetId, P_Password, NOW(), 3);

	IF	P_Major = -1	THEN
		INSERT	INTO	university.Students
			(NetId, FirstName, LastName, Department, Email)
		VALUE
			(P_NetId, P_FirstName, P_LastName, P_Dept, P_Email);
	ELSE
		INSERT	INTO	university.Students
			(NetId, FirstName, LastName, Department, Major, Email)
		VALUE
			(P_NetId, P_FirstName, P_LastName, P_Dept, P_Major, P_Email);
	END IF;
	
	SET P_LastStudID	= LAST_INSERT_ID();
	
	INSERT	INTO university.GradStudents
		(StudentsId)
	VALUES
		(P_LastStudID);

	COMMIT;	

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_addNTEmployees`(
    IN      P_NetId	        	CHAR(10),
    IN      P_Password      	VARCHAR(40),
	IN		P_SSN				INT(10),
	IN		P_FirstName			VARCHAR(100),
	IN		P_LastName			VARCHAR(100),
	IN		P_Email				VARCHAR(100),
	IN		P_Salary			VARCHAR(100),
	IN		P_NTPostId	INT(2)
)
BEGIN
	
	DECLARE P_LastEmpID   INT(10);
	
	SET autocommit = 0;
	
	INSERT	INTO	university.Users
		(NetId, Password, CreatedDate, UserType)
	VALUES
		(P_NetId, P_Password, NOW(), 2);

	INSERT	INTO	university.Employees
		(SSN, NetId, FirstName, LastName, Email, DOJ, Salary)
	VALUES
		(P_SSN, P_NetId, P_FirstName, P_LastName, P_Email, NOW(), P_Salary);

	SET P_LastEmpId	= LAST_INSERT_ID();

	INSERT	INTO	university.NonTeachingStaff
		(EmployeeId, NonTeachingPost)
	VALUE
		(P_LastEmpId, P_NTPostId);

	COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_addSections`(
    IN      P_CourseNumber     	CHAR(10),
    IN      P_Section      		VARCHAR(200),
	IN		P_StartTime			TIME,
	IN		P_EndTime			TIME,
	IN		P_Classroom			CHAR(10),
	IN		P_ProfId			INT(10),
	IN		P_Days				VARCHAR(13),
	IN		P_Semester			INT(1),
	IN		P_Year				CHAR(4),
	IN		P_TotalSeats		INT(3)
)
BEGIN

	SET autocommit = 0;

	INSERT	INTO	university.Sections
		(CourseId, Section, LectureStartTime, LectureEndTime, Classroom, InstructorId, LectureDay, Semester, SemYear, TotalSeats)
	VALUES
		(P_CourseNumber, P_Section, P_StartTime, P_EndTime, P_Classroom, P_ProfId, P_Days, P_Semester, P_Year, P_TotalSeats);

	COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_addUGStudents`(
    IN      P_NetId	        	CHAR(10),
    IN      P_Password      	VARCHAR(40),
	IN		P_FirstName			VARCHAR(100),
	IN		P_LastName			VARCHAR(100),
	IN		P_Email				VARCHAR(100),
	IN		P_Dept				INT(10),
	IN		P_Major				INT(5)
)
BEGIN

	DECLARE P_LastStudID   INT(10);
	
	SET autocommit = 0;

	INSERT	INTO	university.Users
		(NetId, Password, CreatedDate, UserType)
	VALUES
		(P_NetId, P_Password, NOW(), 3);

	IF	P_Major = -1	THEN
		INSERT	INTO	university.Students
			(NetId, FirstName, LastName, Department, Email)
		VALUE
			(P_NetId, P_FirstName, P_LastName, P_Dept, P_Email);
	ELSE
		INSERT	INTO	university.Students
			(NetId, FirstName, LastName, Department, Major, Email)
		VALUE
			(P_NetId, P_FirstName, P_LastName, P_Dept, P_Major, P_Email);
	END IF;
	
	SET P_LastStudID	= LAST_INSERT_ID();
	
	INSERT	INTO university.UnderGradStudent
		(StudentId)
	VALUES
		(P_LastStudID);

	COMMIT;	

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_dropStudentCourse`(
    IN      P_StudentId     	INT(10),
    IN      P_Semester      	INT(1),
	IN		P_Year				CHAR(4),
	IN		P_CourseId			CHAR(10),
	IN		P_Section			CHAR(5)
)
    READS SQL DATA
BEGIN
	DECLARE P_SectionId   		INT(10);
	SET autocommit = 0;
	
	SELECT	SectionId
	INTO	P_SectionId
	FROM	Sections
	WHERE	LOWER(CourseId)	=	LOWER(P_CourseId)
	AND		LOWER(Section)	=	LOWER(P_Section)
	AND		Semester		=	P_Semester
	AND		SemYear			=	P_Year;


	DELETE 	FROM	CourseRegistration
	WHERE	SectionId	=	P_SectionId
	AND		StudentId	=	P_StudentId;
	
	COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_insertGrades`(
    IN      P_StudentId	        INT(10),
    IN      P_SectionId      	INT(40),
	IN		P_ExamType			INT(2),
	IN		P_ExamMarks			CHAR(5),
	IN		P_ExamDate			DATETIME
)
BEGIN
	
	SET autocommit = 0;
	
	INSERT	INTO	university.Exams
		(ExamType, SectionId, StudentId, ExamMarks, ExamDate)
	VALUES
		(P_ExamType, P_SectionId, P_StudentId, P_ExamMarks, P_ExamDate);

	
	COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_regStudentCourse`(
    IN      P_StudentId     	INT(10),
    IN      P_Semester      	INT(1),
	IN		P_Year				CHAR(4),
	IN		P_CourseId			CHAR(10),
	IN		P_Section			CHAR(5)
)
    READS SQL DATA
BEGIN
	DECLARE P_SectionId   		INT(10);
	SET autocommit = 0;
	
	SELECT	SectionId
	INTO	P_SectionId
	FROM	Sections
	WHERE	LOWER(CourseId)	=	LOWER(P_CourseId)
	AND		LOWER(Section)	=	LOWER(P_Section)
	AND		Semester		=	P_Semester
	AND		SemYear			=	P_Year;


	INSERT	INTO	CourseRegistration
		(StudentId, SectionId, RegistrationDate)
	VALUES
		(P_StudentId, P_SectionId, NOW());
	
	COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_updateGrades`(
    IN      P_ExamId	        BIGINT(20),
	IN		P_ExamMarks			CHAR(5),
	IN		P_ExamDate			DATETIME
)
BEGIN
	
	SET autocommit = 0;
	
	UPDATE	university.Exams
	SET		ExamMarks	=	P_ExamMarks,
			ExamDate	=	P_ExamDate
	WHERE	ExamId		=	P_ExamId;

	
	COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `raise_application_error`(IN CODE INTEGER, IN MESSAGE VARCHAR(255))
    DETERMINISTIC
    SQL SECURITY INVOKER
BEGIN
  CREATE TEMPORARY TABLE IF NOT EXISTS RAISE_ERROR(F1 INT NOT NULL);

  SELECT CODE, MESSAGE INTO @error_code, @error_message;
  INSERT INTO RAISE_ERROR VALUES(NULL);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `courseregistration`
--

CREATE TABLE IF NOT EXISTS `courseregistration` (
  `StudentId` int(10) NOT NULL,
  `SectionId` int(10) NOT NULL,
  `RegistrationDate` datetime NOT NULL,
  `Grade` char(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`StudentId`,`SectionId`),
  KEY `FK_CourseReg_Sections_Section` (`SectionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courseregistration`
--

INSERT INTO `courseregistration` (`StudentId`, `SectionId`, `RegistrationDate`, `Grade`) VALUES
(3, 1, '2012-12-04 04:34:55', NULL),
(3, 3, '2012-12-04 04:34:55', NULL),
(3, 5, '2012-12-05 07:22:44', NULL),
(3, 7, '2012-12-09 05:07:53', NULL),
(4, 3, '2012-12-04 04:35:19', NULL),
(4, 4, '2012-12-04 04:34:55', NULL),
(4, 7, '2012-12-09 05:07:56', NULL),
(5, 1, '2012-12-04 04:34:55', NULL),
(5, 3, '2012-12-04 04:34:55', NULL),
(5, 7, '2012-12-09 05:07:59', NULL),
(6, 3, '2012-12-04 04:34:55', NULL),
(6, 4, '2012-12-04 04:34:55', NULL),
(9, 2, '2012-12-06 19:00:50', NULL),
(10, 2, '2012-12-09 04:48:29', NULL),
(13, 2, '2012-12-09 04:48:16', NULL),
(14, 2, '2012-12-09 04:48:22', NULL),
(14, 5, '2012-12-09 20:28:32', NULL),
(15, 2, '2012-12-09 04:48:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `CourseId` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `CourseName` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `TotalCredits` int(2) NOT NULL,
  `DepartmentId` int(10) NOT NULL,
  PRIMARY KEY (`CourseId`),
  KEY `FK_Courses_Departments_DepartmentId` (`DepartmentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`CourseId`, `CourseName`, `TotalCredits`, `DepartmentId`) VALUES
('CE6302', 'Microprocessor Systems', 3, 2),
('CE6303', 'Testing and Testable Design', 3, 2),
('CE6304', 'Computer Architecture', 3, 2),
('CE6325', 'VLSI Design', 3, 2),
('CE6363', 'Design and Analysis of Computer Algorithms', 3, 2),
('CE6378', 'Advanced Operating Systems', 3, 2),
('CE6390', 'Advanced Computer Networks', 3, 2),
('CS6324', 'Information Security', 3, 1),
('CS6360', 'Database', 3, 1),
('CS6363', 'Design and Analysis of Computer Algorithms', 3, 1),
('CS6371', 'Advanced Programming Languages', 3, 1),
('CS6377', 'Introduction to Cryptography', 3, 1),
('CS6378', 'Advance Operating System', 3, 1),
('CS6390', 'Advanced Computer Networks', 3, 1),
('FIN6300', 'Personal Finance', 3, 13),
('FIN6301', 'Financial Management', 3, 13),
('FIN6306', 'Quantitative Methods in Finance', 3, 13),
('MSEN5333', 'Advanced Organic Chemistry II', 3, 11),
('MSEN5340', 'Advanced Polymer Science and Engineering', 3, 11),
('MSEN5341', 'Advanced Inorganic Chemistry', 3, 11),
('MSEN5360', 'Materials Characterization', 3, 11),
('MSEN5370', 'Ceramics and Metals', 3, 11),
('MSEN5371', 'Solid State Physics ', 3, 11);

-- --------------------------------------------------------

--
-- Stand-in structure for view `coursesearch`
--
CREATE TABLE IF NOT EXISTS `coursesearch` (
`SectionId` int(10)
,`CourseId` char(10)
,`Section` char(5)
,`CourseName` varchar(200)
,`FirstName` varchar(100)
,`LastName` varchar(100)
,`LectureStartTime` time
,`LectureEndTime` time
,`Classroom` char(10)
,`LectureDay` varchar(13)
,`TotalSeats` int(3)
,`Semester` int(1)
,`SemYear` char(4)
,`FLName` varchar(201)
,`LFName` varchar(201)
,`RemainingSeats` bigint(22)
);
-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `DepartmentId` int(10) NOT NULL AUTO_INCREMENT,
  `DepartmentName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `DepartmentHead` int(10) DEFAULT NULL,
  PRIMARY KEY (`DepartmentId`),
  UNIQUE KEY `DepartmentName_UNIQUE` (`DepartmentName`),
  KEY `FK_Departments_TStaff_DepartmentHead` (`DepartmentHead`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`DepartmentId`, `DepartmentName`, `DepartmentHead`) VALUES
(1, 'Computer Science', NULL),
(2, 'Computer Engineering', NULL),
(3, 'Mechanical Engineering', NULL),
(4, 'Production Engineering', NULL),
(5, 'Chemical Engineering', NULL),
(6, 'Electrical Engineering', NULL),
(7, 'Electronics and Telecommunication', NULL),
(8, 'Biomedical Engineering', NULL),
(9, 'Accounting', NULL),
(10, 'Business Administration', NULL),
(11, 'Materials Science and Engineering', NULL),
(12, 'Systems Engineering and Management * (ECS)', NULL),
(13, 'Finance', NULL),
(14, 'Global Business', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `EmployeeId` int(10) NOT NULL AUTO_INCREMENT,
  `SSN` bigint(10) unsigned NOT NULL,
  `NetId` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `FirstName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `MiddleName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `PrimaryPhone` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `OfficePhone` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `DOB` date DEFAULT NULL,
  `DOJ` datetime DEFAULT NULL,
  `Salary` decimal(10,2) NOT NULL,
  `Street1` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Street2` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `City` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `State` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ZipCode` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`EmployeeId`),
  KEY `FK_Employees_Users_NetId` (`NetId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`EmployeeId`, `SSN`, `NetId`, `FirstName`, `MiddleName`, `LastName`, `PrimaryPhone`, `OfficePhone`, `Email`, `DOB`, `DOJ`, `Salary`, `Street1`, `Street2`, `City`, `State`, `Country`, `ZipCode`) VALUES
(1, 1234567890, 'aniket', 'Aniket', 'Vilas', 'Jadhav', NULL, NULL, 'axj122430@utdallas.edu', NULL, '2012-11-30 11:30:54', '90000.00', '7815 McCallum Blvd', 'Apt #8105', 'Dallas', 'Texas', 'United States', '75252'),
(4, 9874953478, 'rajas', 'Rajas', NULL, 'Upadhye', NULL, NULL, 'rajas@gmail.com', NULL, '2012-11-30 11:41:42', '90000.00', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1892719824, 'vxs128971', 'Vaibhav', NULL, 'Shukla', NULL, NULL, 'vaibhav@gmail.com', NULL, '2012-11-30 11:42:45', '80000.00', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1346367452, 'rxv123129', 'Ramesh', NULL, 'Venu', NULL, NULL, 'ramesh@gmail.com', NULL, '2012-11-30 11:51:27', '24000.00', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 1234864245, '232dsdd', 'zfef', NULL, 'erwf', NULL, NULL, 'sff312@gmail.com', NULL, '2012-11-30 21:45:28', '1224434.00', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 1902873917, 'rbk', 'Raghavachari', NULL, 'Balaji', NULL, NULL, 'rbk@utdallas.edu', NULL, '2012-12-02 16:54:02', '150000.00', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 3463453453, 'sukhdev', 'Sukhdev', NULL, 'Darira', NULL, NULL, 'asksukhdev@gmail.com', NULL, '2012-12-02 16:54:53', '150000.00', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 5684545645, 'svelankar', 'Sameer', NULL, 'Velankar', NULL, NULL, 'velankar@gmail.com', NULL, '2012-12-02 16:55:26', '130000.00', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 4583246465, 'bharatA', 'Bharat', NULL, 'Acharya', NULL, NULL, 'bharat@gmail.com', NULL, '2012-12-02 16:56:12', '160000.00', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 3457345674, 'rodge', 'Pramod', NULL, 'Rodge', NULL, NULL, 'rodge@rediffmail.com', NULL, '2012-12-02 16:57:23', '120000.00', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 2485656787, 'hal', 'Ivan', NULL, 'Sudborough', NULL, NULL, 'hal@utdallas.edu', NULL, '2012-12-02 16:57:59', '145000.00', NULL, NULL, NULL, NULL, NULL, NULL),
(17, 7854645647, 'yuke', 'Yuke', NULL, 'Wang', NULL, NULL, 'yuke@utdallas.edu', NULL, '2012-12-02 16:58:23', '135000.00', NULL, NULL, NULL, NULL, NULL, NULL),
(18, 6574324576, 'gite', 'Yogesh', NULL, 'Gite', NULL, NULL, 'yogesh@gmail.com', NULL, '2012-12-02 16:59:18', '80000.00', NULL, NULL, NULL, NULL, NULL, NULL),
(19, 1657456736, 'aniket1', 'Aniket', NULL, 'Jadhav', NULL, NULL, 'aniket@hotmail.com', NULL, '2012-12-02 18:38:07', '87000.00', NULL, NULL, NULL, NULL, NULL, NULL),
(22, 8456355644, 'amar', 'Amar', NULL, 'Panchal', NULL, NULL, 'amarp@gmail.com', NULL, '2012-12-05 20:42:45', '130000.00', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE IF NOT EXISTS `exams` (
  `ExamId` bigint(20) NOT NULL AUTO_INCREMENT,
  `ExamType` int(2) NOT NULL,
  `SectionId` int(10) NOT NULL,
  `StudentId` int(10) NOT NULL,
  `ExamMarks` char(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ExamDate` datetime DEFAULT NULL,
  PRIMARY KEY (`ExamId`),
  KEY `FK_Exams_Sections_SectionId` (`SectionId`),
  KEY `FK_Exams_ExamTypes_ExamType` (`ExamType`),
  KEY `StudentId` (`StudentId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`ExamId`, `ExamType`, `SectionId`, `StudentId`, `ExamMarks`, `ExamDate`) VALUES
(23, 1, 2, 9, '34', '2012-12-10 00:00:00'),
(24, 1, 2, 14, '23', '2012-12-10 00:00:00'),
(25, 1, 2, 15, '', '2012-12-10 00:00:00'),
(26, 1, 2, 10, '56', '2012-12-10 00:00:00'),
(27, 1, 2, 13, '', '2012-12-10 00:00:00'),
(28, 1, 7, 4, '45', '2012-12-20 00:00:00'),
(29, 1, 7, 3, '42', '2012-12-20 00:00:00'),
(30, 1, 7, 5, '47', '2012-12-20 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `examtypes`
--

CREATE TABLE IF NOT EXISTS `examtypes` (
  `ExamTypeId` int(2) NOT NULL AUTO_INCREMENT,
  `ExamName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ExamTypeId`),
  UNIQUE KEY `ExamName_UNIQUE` (`ExamName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `examtypes`
--

INSERT INTO `examtypes` (`ExamTypeId`, `ExamName`) VALUES
(1, 'Assignment'),
(3, 'Midterms'),
(4, 'Project'),
(2, 'Quiz');

-- --------------------------------------------------------

--
-- Table structure for table `gradstudents`
--

CREATE TABLE IF NOT EXISTS `gradstudents` (
  `StudentsId` int(10) NOT NULL,
  `College` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Degree` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`StudentsId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gradstudents`
--

INSERT INTO `gradstudents` (`StudentsId`, `College`, `Degree`) VALUES
(3, NULL, NULL),
(4, NULL, NULL),
(7, NULL, NULL),
(8, NULL, NULL),
(9, NULL, NULL),
(12, NULL, NULL),
(13, NULL, NULL),
(14, NULL, NULL),
(15, NULL, NULL),
(17, NULL, NULL),
(18, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE IF NOT EXISTS `majors` (
  `MajorId` int(5) NOT NULL AUTO_INCREMENT,
  `MajorName` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `DepartmentId` int(10) NOT NULL,
  PRIMARY KEY (`MajorId`),
  KEY `FK_Majors_Departments_DepartmentId` (`DepartmentId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`MajorId`, `MajorName`, `DepartmentId`) VALUES
(1, 'Artificial Intelligence', 1),
(2, 'Traditional Track', 1),
(3, 'Intelligent Systems', 1),
(4, 'Networks and Telecommunications', 1),
(5, 'Systems', 1),
(6, 'Software Engineering (major)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nonteachingpost`
--

CREATE TABLE IF NOT EXISTS `nonteachingpost` (
  `NTPostId` int(3) NOT NULL AUTO_INCREMENT,
  `NTPostName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`NTPostId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `nonteachingpost`
--

INSERT INTO `nonteachingpost` (`NTPostId`, `NTPostName`) VALUES
(1, 'Admin'),
(2, 'Clerk'),
(3, 'Help Desk'),
(4, 'Technical Staff'),
(5, 'Graduate Advisor');

-- --------------------------------------------------------

--
-- Table structure for table `nonteachingstaff`
--

CREATE TABLE IF NOT EXISTS `nonteachingstaff` (
  `EmployeeId` int(10) NOT NULL,
  `NonTeachingPost` int(3) NOT NULL,
  `WorkLocation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`EmployeeId`),
  KEY `FK_NTStaff_NTPost_Id` (`NonTeachingPost`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nonteachingstaff`
--

INSERT INTO `nonteachingstaff` (`EmployeeId`, `NonTeachingPost`, `WorkLocation`) VALUES
(9, 2, '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `registeredstudents`
--
CREATE TABLE IF NOT EXISTS `registeredstudents` (
`SectionId` int(10)
,`RegisteredStudents` bigint(21)
);
-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
  `SectionId` int(10) NOT NULL AUTO_INCREMENT,
  `CourseId` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `Section` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `LectureStartTime` time DEFAULT NULL,
  `LectureEndTime` time DEFAULT NULL,
  `Classroom` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `InstructorId` int(10) NOT NULL,
  `LectureDay` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Semester` int(1) NOT NULL,
  `SemYear` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `SeatsRemaining` int(3) DEFAULT NULL,
  `TotalSeats` int(3) DEFAULT NULL,
  PRIMARY KEY (`SectionId`),
  UNIQUE KEY `UniqueCourseSection` (`CourseId`,`Section`,`Semester`,`SemYear`),
  KEY `Course` (`CourseId`),
  KEY `FK_Sections_TStaff_EmployeeId` (`InstructorId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`SectionId`, `CourseId`, `Section`, `LectureStartTime`, `LectureEndTime`, `Classroom`, `InstructorId`, `LectureDay`, `Semester`, `SemYear`, `SeatsRemaining`, `TotalSeats`) VALUES
(1, 'CE6304', '001', '11:30:00', '12:45:00', '2.311', 14, '2, 4', 1, '2012', NULL, 120),
(2, 'CS6360', '002', '19:00:00', '20:15:00', '2.221', 11, '2, 4', 1, '2012', NULL, 60),
(3, 'CE6378', '001', '16:00:00', '17:15:00', '2.210', 15, '5, 2', 1, '2012', NULL, 40),
(4, 'CS6360', '241', '12:00:00', '14:00:00', '3.221', 12, '2, 5', 1, '2012', NULL, 120),
(5, 'CE6390', '001', '14:00:00', '15:30:00', '2.233', 18, '4, 5', 1, '2012', NULL, 120),
(6, 'CS6360', '001', '09:30:00', '10:45:00', '3.223', 11, '2, 3', 1, '2011', NULL, 120),
(7, 'CS6360', '008', '11:00:00', '12:15:00', '1.231', 11, '1, 2', 1, '2012', NULL, 120);

-- --------------------------------------------------------

--
-- Table structure for table `studentassistants`
--

CREATE TABLE IF NOT EXISTS `studentassistants` (
  `StudentId` int(10) NOT NULL,
  `SSN` int(10) NOT NULL,
  `AssistantType` int(1) NOT NULL,
  `Salary` decimal(10,2) NOT NULL,
  `Section` int(10) NOT NULL,
  `DOJ` datetime NOT NULL,
  `DOT` datetime DEFAULT NULL,
  PRIMARY KEY (`StudentId`),
  UNIQUE KEY `SSN_UNIQUE` (`SSN`),
  KEY `FK_StudAssist_CourseReg_Section` (`Section`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `StudentId` int(10) NOT NULL AUTO_INCREMENT,
  `NetId` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `FirstName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `MiddleName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Department` int(10) NOT NULL,
  `Major` int(5) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `DOJ` datetime DEFAULT NULL,
  `StudentType` int(1) DEFAULT NULL,
  `Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `PrimaryPhone` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Street1` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Street2` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `City` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `State` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ZipCode` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`StudentId`),
  UNIQUE KEY `Email_UNIQUE` (`Email`),
  UNIQUE KEY `PrimaryPhone_UNIQUE` (`PrimaryPhone`),
  KEY `FK_Students_Users_NetId` (`NetId`),
  KEY `FK_Students_Majors_Major` (`Major`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentId`, `NetId`, `FirstName`, `MiddleName`, `LastName`, `Department`, `Major`, `DOB`, `DOJ`, `StudentType`, `Email`, `PrimaryPhone`, `Street1`, `Street2`, `City`, `State`, `Country`, `ZipCode`) VALUES
(3, 'txp234722', 'Tanya', NULL, 'Pradhan', 5, NULL, NULL, NULL, NULL, 'tanya@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'hxn234789', 'Ha', NULL, 'Nguyen', 7, NULL, NULL, NULL, NULL, 'ha@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'uxs', 'Uma', NULL, 'Shankar', 3, NULL, NULL, NULL, NULL, 'uma@rediffmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'amer', 'Amer', NULL, 'Khan', 1, 2, NULL, NULL, NULL, 'amerkhan1987@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'abhishek', 'Abhishek', NULL, 'Kharche', 1, 5, NULL, NULL, NULL, 'abhishek@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'chinmay', 'Chinmay', NULL, 'Pednekar', 1, 3, NULL, NULL, NULL, 'chinmay@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'aditya', 'Aditya', NULL, 'Gupte', 3, NULL, NULL, NULL, NULL, 'aditya@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'anuja', 'Anuja', NULL, 'Jadhav', 14, NULL, NULL, NULL, NULL, 'anuja@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'komal', 'Komal', NULL, 'Borle', 12, NULL, NULL, NULL, NULL, 'komal@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'shweta', 'Shweta', NULL, 'Mangle', 6, NULL, NULL, NULL, NULL, 'shweta@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'ketaki', 'Ketaki', NULL, 'Manjure', 2, NULL, NULL, NULL, NULL, 'ketaki@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'akankshaM', 'Akanksha', NULL, 'Mohabansi', 5, NULL, NULL, NULL, NULL, 'akanmoha@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'akankshaS', 'Akanksha', NULL, 'Shukla', 9, NULL, NULL, NULL, NULL, 'akanshukla@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'priyaT', 'Priya', NULL, 'Thakur', 9, NULL, NULL, NULL, NULL, 'priyat@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'kunalp', 'Kunal', NULL, 'Pawar', 11, NULL, NULL, NULL, NULL, 'kunal@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teachingposts`
--

CREATE TABLE IF NOT EXISTS `teachingposts` (
  `TeachingPostId` int(2) NOT NULL AUTO_INCREMENT,
  `TeachingPostName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`TeachingPostId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `teachingposts`
--

INSERT INTO `teachingposts` (`TeachingPostId`, `TeachingPostName`) VALUES
(1, 'Lecturer'),
(2, 'Senior Lecturer'),
(3, 'Assistant Professor'),
(4, 'Associate Professor'),
(5, 'Professor'),
(6, 'Head of Department');

-- --------------------------------------------------------

--
-- Table structure for table `teachingstaff`
--

CREATE TABLE IF NOT EXISTS `teachingstaff` (
  `EmployeeId` int(10) NOT NULL,
  `DepartmentId` int(10) DEFAULT NULL,
  `TeachingPost` int(2) NOT NULL,
  PRIMARY KEY (`EmployeeId`),
  KEY `FK_TStaff_TPosts_TPostId` (`TeachingPost`),
  KEY `FK_TStaff_Departments_DeptHead` (`DepartmentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='		';

--
-- Dumping data for table `teachingstaff`
--

INSERT INTO `teachingstaff` (`EmployeeId`, `DepartmentId`, `TeachingPost`) VALUES
(4, NULL, 3),
(5, NULL, 2),
(10, NULL, 5),
(11, NULL, 4),
(12, NULL, 3),
(13, NULL, 5),
(14, NULL, 5),
(15, NULL, 5),
(16, NULL, 5),
(17, NULL, 5),
(18, NULL, 1),
(19, NULL, 4),
(22, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `undergradstudent`
--

CREATE TABLE IF NOT EXISTS `undergradstudent` (
  `StudentId` int(10) NOT NULL,
  `Degree` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`StudentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `undergradstudent`
--

INSERT INTO `undergradstudent` (`StudentId`, `Degree`) VALUES
(5, NULL),
(6, NULL),
(10, NULL),
(11, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `NetId` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `LastPassword` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PasswordChanged` datetime DEFAULT NULL,
  `LastLogin` datetime DEFAULT NULL,
  `CreatedDate` datetime NOT NULL,
  `UserType` int(2) NOT NULL,
  `SecurityQuestion1` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SecurityAnswer1` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SecurityQuestion2` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SecurityAnswer2` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Gender` bit(1) DEFAULT NULL,
  PRIMARY KEY (`NetId`),
  KEY `FK_Users_UTypes_UserType` (`UserType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='		';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`NetId`, `Password`, `LastPassword`, `PasswordChanged`, `LastLogin`, `CreatedDate`, `UserType`, `SecurityQuestion1`, `SecurityAnswer1`, `SecurityQuestion2`, `SecurityAnswer2`, `Gender`) VALUES
('232dsdd', 'f892a15de623f3e65628f5e4a750bdd199f468a3', NULL, NULL, NULL, '2012-11-30 21:45:28', 2, NULL, NULL, NULL, NULL, NULL),
('abhishek', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-12-05 07:23:49', 3, NULL, NULL, NULL, NULL, NULL),
('aditya', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-12-05 07:24:44', 3, NULL, NULL, NULL, NULL, NULL),
('akankshaM', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-12-05 07:27:16', 3, NULL, NULL, NULL, NULL, NULL),
('akankshaS', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-12-05 07:27:40', 3, NULL, NULL, NULL, NULL, NULL),
('amar', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-12-05 20:42:45', 2, NULL, NULL, NULL, NULL, NULL),
('amer', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-12-01 06:11:42', 3, NULL, NULL, NULL, NULL, NULL),
('aniket', 'aeebfc518820c9904ff3d07e641697d8b951b653', NULL, NULL, NULL, '2012-11-26 00:00:00', 1, 'What is your name?', 'Aniket', 'What is your Mother', 'Savita', b'1'),
('aniket1', 'aeebfc518820c9904ff3d07e641697d8b951b653', NULL, NULL, NULL, '2012-12-02 18:38:07', 2, NULL, NULL, NULL, NULL, NULL),
('anuja', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-12-05 07:25:14', 3, NULL, NULL, NULL, NULL, NULL),
('bharatA', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-12-02 16:56:12', 2, NULL, NULL, NULL, NULL, NULL),
('chinmay', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-12-05 07:24:23', 3, NULL, NULL, NULL, NULL, NULL),
('gite', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-12-02 16:59:18', 2, NULL, NULL, NULL, NULL, NULL),
('hal', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-12-02 16:57:59', 2, NULL, NULL, NULL, NULL, NULL),
('hxn234789', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-12-01 06:09:57', 3, NULL, NULL, NULL, NULL, NULL),
('ketaki', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-12-05 07:26:44', 3, NULL, NULL, NULL, NULL, NULL),
('komal', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-12-05 07:25:42', 3, NULL, NULL, NULL, NULL, NULL),
('kunalp', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-12-05 07:28:57', 3, NULL, NULL, NULL, NULL, NULL),
('priyaT', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-12-05 07:28:15', 3, NULL, NULL, NULL, NULL, NULL),
('rajas', '05fcab6416d3f2ca409d50864abd37bae340e4e4', NULL, NULL, NULL, '2012-11-30 11:41:42', 2, NULL, NULL, NULL, NULL, NULL),
('rbk', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-12-02 16:54:02', 2, NULL, NULL, NULL, NULL, NULL),
('rodge', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-12-02 16:57:23', 2, NULL, NULL, NULL, NULL, NULL),
('rxv123129', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-11-30 11:51:27', 2, NULL, NULL, NULL, NULL, NULL),
('shweta', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-12-05 07:26:17', 3, NULL, NULL, NULL, NULL, NULL),
('sukhdev', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-12-02 16:54:53', 2, NULL, NULL, NULL, NULL, NULL),
('svelankar', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-12-02 16:55:26', 2, NULL, NULL, NULL, NULL, NULL),
('txp234722', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-12-01 06:08:35', 3, NULL, NULL, NULL, NULL, NULL),
('uxs', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-12-01 06:10:54', 3, NULL, NULL, NULL, NULL, NULL),
('vxs128971', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-11-30 11:42:45', 2, NULL, NULL, NULL, NULL, NULL),
('yuke', 'f6ba265d42470902addba18f3037b450f3d0c075', NULL, NULL, NULL, '2012-12-02 16:58:23', 2, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE IF NOT EXISTS `usertype` (
  `UserTypeId` int(2) NOT NULL,
  `UserTypeName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`UserTypeId`),
  UNIQUE KEY `UserTypeName_UNIQUE` (`UserTypeName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`UserTypeId`, `UserTypeName`) VALUES
(1, 'Admin'),
(2, 'Employee'),
(3, 'Student');

-- --------------------------------------------------------

--
-- Structure for view `coursesearch`
--
DROP TABLE IF EXISTS `coursesearch`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `coursesearch` AS select `s`.`SectionId` AS `SectionId`,`c`.`CourseId` AS `CourseId`,`s`.`Section` AS `Section`,`c`.`CourseName` AS `CourseName`,`e`.`FirstName` AS `FirstName`,`e`.`LastName` AS `LastName`,`s`.`LectureStartTime` AS `LectureStartTime`,`s`.`LectureEndTime` AS `LectureEndTime`,`s`.`Classroom` AS `Classroom`,`s`.`LectureDay` AS `LectureDay`,`s`.`TotalSeats` AS `TotalSeats`,`s`.`Semester` AS `Semester`,`s`.`SemYear` AS `SemYear`,concat(`e`.`FirstName`,' ',`e`.`LastName`) AS `FLName`,concat(`e`.`LastName`,' ',`e`.`FirstName`) AS `LFName`,(`s`.`TotalSeats` - ifnull(`rs`.`RegisteredStudents`,0)) AS `RemainingSeats` from (((`sections` `s` join `courses` `c` on((`s`.`CourseId` = `c`.`CourseId`))) join `employees` `e` on((`s`.`InstructorId` = `e`.`EmployeeId`))) left join `registeredstudents` `rs` on((`s`.`SectionId` = `rs`.`SectionId`)));

-- --------------------------------------------------------

--
-- Structure for view `registeredstudents`
--
DROP TABLE IF EXISTS `registeredstudents`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `registeredstudents` AS select `courseregistration`.`SectionId` AS `SectionId`,count(0) AS `RegisteredStudents` from `courseregistration` group by `courseregistration`.`SectionId`;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courseregistration`
--
ALTER TABLE `courseregistration`
  ADD CONSTRAINT `FK_CourseReg_Sections_Section` FOREIGN KEY (`SectionId`) REFERENCES `sections` (`SectionId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_CourseReg_Students_StudentId` FOREIGN KEY (`StudentId`) REFERENCES `students` (`StudentId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `FK_Courses_Departments_DepartmentId` FOREIGN KEY (`DepartmentId`) REFERENCES `departments` (`DepartmentId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `FK_Departments_TStaff_DepartmentHead` FOREIGN KEY (`DepartmentHead`) REFERENCES `teachingstaff` (`EmployeeId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `FK_Employees_Users_NetId` FOREIGN KEY (`NetId`) REFERENCES `users` (`NetId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_ibfk_1` FOREIGN KEY (`StudentId`) REFERENCES `courseregistration` (`StudentId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Exams_ExamTypes_ExamType` FOREIGN KEY (`ExamType`) REFERENCES `examtypes` (`ExamTypeId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Exams_Sections_SectionId` FOREIGN KEY (`SectionId`) REFERENCES `sections` (`SectionId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `gradstudents`
--
ALTER TABLE `gradstudents`
  ADD CONSTRAINT `FK_GStud_Stud_StudId` FOREIGN KEY (`StudentsId`) REFERENCES `students` (`StudentId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `majors`
--
ALTER TABLE `majors`
  ADD CONSTRAINT `FK_Majors_Departments_DepartmentId` FOREIGN KEY (`DepartmentId`) REFERENCES `departments` (`DepartmentId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `nonteachingstaff`
--
ALTER TABLE `nonteachingstaff`
  ADD CONSTRAINT `FK_NTStaff_Employees_EmployeeId` FOREIGN KEY (`EmployeeId`) REFERENCES `employees` (`EmployeeId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_NTStaff_NTPost_Id` FOREIGN KEY (`NonTeachingPost`) REFERENCES `nonteachingpost` (`NTPostId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `FK_Sections_Courses_CourseId` FOREIGN KEY (`CourseId`) REFERENCES `courses` (`CourseId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Sections_TStaff_EmployeeId` FOREIGN KEY (`InstructorId`) REFERENCES `teachingstaff` (`EmployeeId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `studentassistants`
--
ALTER TABLE `studentassistants`
  ADD CONSTRAINT `FK_StudAssist_CourseReg_Section` FOREIGN KEY (`Section`) REFERENCES `courseregistration` (`SectionId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_StudAssist_Stud_StudId` FOREIGN KEY (`StudentId`) REFERENCES `students` (`StudentId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `FK_Students_Majors_Major` FOREIGN KEY (`Major`) REFERENCES `majors` (`MajorId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Students_Users_NetId` FOREIGN KEY (`NetId`) REFERENCES `users` (`NetId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `teachingstaff`
--
ALTER TABLE `teachingstaff`
  ADD CONSTRAINT `FK_TStaff_Departments_DeptHead` FOREIGN KEY (`DepartmentId`) REFERENCES `departments` (`DepartmentId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_TStaff_Employees_EmployeeId` FOREIGN KEY (`EmployeeId`) REFERENCES `employees` (`EmployeeId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_TStaff_TPosts_TPostId` FOREIGN KEY (`TeachingPost`) REFERENCES `teachingposts` (`TeachingPostId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `undergradstudent`
--
ALTER TABLE `undergradstudent`
  ADD CONSTRAINT `FK_UGStud_Stud_StudentId` FOREIGN KEY (`StudentId`) REFERENCES `students` (`StudentId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_Users_UTypes_UserType` FOREIGN KEY (`UserType`) REFERENCES `usertype` (`UserTypeId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
