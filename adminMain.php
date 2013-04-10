<?php
session_start();
Header("content-type:application/x-javascript");


echo <<<EOT

$(document).ready(function(){

  $('#adminWorkArea').load("adminWorkArea.php #beginning", function(){	
		
	});
	
	$('#addEmployee').live('click', function(){
		
		$('#addEmployee').after("<span class='loading' id = 'leftbarloading'> </span>");
		
		$(document).unbind('keydown');
		$(document).one("keydown", function(e){
			if(e.which == '13')
			{				
				$('#createEmployee').trigger('click');					
			}
		});
		
		setTimeout(function(){
			$('#adminWorkArea').load("adminWorkArea.php #employeeForm", function(){
				$('#leftbarloading').remove();
				$('*').removeClass("selectedBar");
				$('#addEmployee').addClass("selectedBar");
			
			});
		},500);
		
		
		
	});
	
	
	$('#addStudent').live('click', function(){
		
		$('#addStudent').after("<span class='loading' id = 'leftbarloading'> </span>");
		
		$(document).unbind('keydown');
		$(document).bind("keydown", function(e){
			if(e.which == '13')
			{
				$('#createStudent').trigger('click');	
				
			}
		});
		setTimeout(function(){
			$('#adminWorkArea').load("adminWorkArea.php #studentForm", function(){
				$('#leftbarloading').remove();
				$('*').removeClass("selectedBar");
				$('#addStudent').addClass("selectedBar");
			
			});
		},500);
		
		
		
	});
	
	$('#addCourses').live('click', function(){
		
		$('#addCourses').after("<span class='loading' id = 'leftbarloading'> </span>");
		
		$(document).unbind('keydown');
		$(document).bind("keydown", function(e){
			if(e.which == '13')
			{
				$('#createCourse').trigger('click');	
				
			}
		});
		
		setTimeout(function(){
			$('#adminWorkArea').load("adminWorkArea.php #courseForm", function(){
				$('#leftbarloading').remove();
				$('*').removeClass("selectedBar");
				$('#addCourses').addClass("selectedBar");
			
			});
		},500);
		
		
	});
	
	$('#addSections').live('click', function(){
		
		$('#addSections').after("<span class='loading' id = 'leftbarloading'> </span>");
		
		$(document).unbind('keydown');
		$(document).bind("keydown", function(e){
			if(e.which == '13')
			{
				$('#createSection').trigger('click');	
				
			}
		});
		setTimeout(function(){
			$('#adminWorkArea').load("adminWorkArea.php #sectionForm", function(){
				$('#leftbarloading').remove();
				$('*').removeClass("selectedBar");
				$('#addSections').addClass("selectedBar");
			
			});
		},500);
		
		
		
	});
	
	$('#viewStudents').live('click', function(){
		
		$('#viewStudents').after("<span class='loading' id = 'leftbarloading'> </span>");
		
		setTimeout(function(){
			$('#adminWorkArea').load("adminWorkArea.php #viewStudentsForm", function(){
				$('#leftbarloading').remove();
				$('*').removeClass("selectedBar");
				$('#viewStudents').addClass("selectedBar");
			
			});
		},500);
		
		
	});
	
	
	$('#registerStudents').live('click', function(){
		
		$('#registerStudents').after("<span class='loading' id = 'leftbarloading'> </span>");
		$(document).unbind('keydown');
		$(document).bind("keydown", function(e){
			if(e.which == '13')
			{
				$('#CRF_register').trigger('click');	
				
			}
		});
		setTimeout(function(){
			$('#adminWorkArea').load("adminWorkArea.php #courseRegForm", function(){
				$('#leftbarloading').remove();
				$('*').removeClass("selectedBar");
				$('#registerStudents').addClass("selectedBar");
			
			});
		},500);
		
		
		
	});
	
EOT;

echo <<<EOT
	
	$('#dropStudents').live('click', function(){
		$(document).unbind('keydown');
		$(document).bind("keydown", function(e){
			if(e.which == '13')
			{
				$('#CDF_drop').trigger('click');	
				
			}
		});
		$('#dropStudents').after("<span class='loading' id = 'leftbarloading'> </span>");
		
		setTimeout(function(){
			$('#adminWorkArea').load("adminWorkArea.php #courseDropForm", function(){
				$('#leftbarloading').remove();
				$('*').removeClass("selectedBar");
				$('#dropStudents').addClass("selectedBar");
			
			});
		},500);
		
		
		
	});
	
	$('#searchCourse').live('click', function(){
		$(document).unbind('keydown');
		$(document).bind("keydown", function(e){
			if(e.which == '13')
			{
				$('#courseSearch').trigger('click');	
				
			}
		});
		
		$('#searchCourse').after("<span class='loading' id = 'leftbarloading'> </span>");
		
		setTimeout(function(){
			$('#adminWorkArea').load("empWorkArea.php #searchCourseForm", function(){
				$('#leftbarloading').remove();
				$('*').removeClass("selectedBar");
				$('#searchCourse').addClass("selectedBar");
			
			
			});
		},500);
		
		
		
	});
	
	
	
	$('#studInfo').live('click', function(){
		$(document).unbind('keydown');
		$(document).bind("keydown", function(e){
			if(e.which == '13')
			{
				$('#SI_search').trigger('click');	
				
			}
		});
		$('#studInfo').after("<span class='loading' id = 'leftbarloading'> </span>");
		
		setTimeout(function(){
			$('#adminWorkArea').load("adminWorkArea.php #studInfoForm", function(){
				$('#leftbarloading').remove();
				$('*').removeClass("selectedBar");
				$('#studInfo').addClass("selectedBar");
			
			});
		},500);
		
		
		
	});
	
	$('#empInfo').live('click', function(){
		
		$('#empInfo').after("<span class='loading' id = 'leftbarloading'> </span>");
		$(document).unbind('keydown');
		$(document).bind("keydown", function(e){
			if(e.which == '13')
			{
				$('#EI_search').trigger('click');	
				
			}
		});
		setTimeout(function(){
			$('#adminWorkArea').load("adminWorkArea.php #empInfoForm", function(){
				$('#leftbarloading').remove();
				$('*').removeClass("selectedBar");
				$('#empInfo').addClass("selectedBar");
			
			});
		},500);
		
	});
	
	/**/
	
	
	$('#createEmployee').live('click', function(){
		
		newEmpData="empType=&empTypeName=&netId&ssn=&pass=&cpass=&firstName=&lastName=&salary=&email=";
			
		if(	$('input[name="empSTName"]:checked').val() == 1)
		{	
			newEmpData = "empType=" + $('input[name="empSTName"]:checked').val() + "&empTypeName="+ $('#selectTPosts').val() +"&netId=" + $('#netId').val() + "&ssn=" + $('#ssn').val() + "&pass=" + $('#pass').val() + "&cpass=" + $('#cpass').val() + "&firstName=" + $('#fname').val() +  "&lastName=" + $('#lname').val() +  "&salary=" + $('#salary').val() + "&email=" + $('#email').val();
		}
		if($('input[name="empSTName"]:checked').val() == 2)
		{
			newEmpData = "empType=" + $('input[name="empSTName"]:checked').val() + "&empTypeName="+ $('#selectNTPosts').val() + "&netId=" + $('#netId').val() + "&ssn=" + $('#ssn').val() + "&pass=" + $('#pass').val() + "&cpass=" + $('#cpass').val() + "&firstName=" + $('#fname').val() +  "&lastName=" + $('#lname').val() +  "&salary=" + $('#salary').val() + "&email=" + $('#email').val();
			
		}

			//alert(newEmpData);
			$.ajax({
				url: "newEmployeeInsert.php",
				
				type: "post",
				dataType: "json",
				data: newEmpData,
				async: false,
				cache: false,
				success: function(data,status){
					
					//alert(data.success);
					$('#result').html(data.message);
					
				}// end of success 
				
			}); // end of ajax
		
		});// end of live click addEmployee
		
		

	
	$('input[name="empSTName"]').live('change', function(){
		
		if($('input[name="empSTName"]:checked').val()==1)
		{
			$('#teachingPosts').css("display","");
			$('#NonTeachingPosts').css("display","none");
		}
		else
		{
			$('#NonTeachingPosts').css("display","");
			$('#teachingPosts').css("display","none");
		}			
	});
		
	$('input[id*="ssn"]').live('blur', function(){
		
		
		
		if ( $(this).val().length > 10)
		{
			var ssn	= $(this).val();
			ssn		= ssn.substr(0,10);
			
			$(this).val(ssn);
		}
		
	});
	
	
	/**********************************************************FOR STUDENTS ********************/
	
	var majorFlag = '0';
	
		$('#department').live('change', function(){
			
			$('#department').after("<span class='loading' id = 'leftbarloading'> </span>");
			
			checkMajorData = "deptNo=" + $('#department').val();
			
			
			setTimeout(function(){
				$.ajax({
					url: "checkMajor.php",
					
					type: "post",
					dataType: "json",
					data: checkMajorData,
					async: false,
					cache: false,
					success: function(data,status){
						$('#leftbarloading').remove();
						if(data.success == '1')
						{
							majorFlag = '1';
							$('#majorResult').html(data.message);
						}
						else
						{
							majorFlag = '0'
							$('#majorResult').html('');
						}
						
					}// end of success 
					
				}); // end of ajax
			},500); // end of settimeout
		});
	
	
	$('#createStudent').live('click', function(){
			
		newStudData = "netId=" + $('#netId').val() + "&pass=" + $('#pass').val() + "&cpass=" + $('#cpass').val() + "&firstName=" + $('#fname').val() + "&lastName=" + $('#lname').val() + "&dept=" + $('#department').val() + "&email=" + $('#email').val() + "&stdType=" + $('input[name="stdType"]:checked').val() + "&majorFlag=" + majorFlag;
		
		if(majorFlag == '1')
		{
			newStudData = newStudData + "&major=" + $('#major').val();
		}
		
		
		$.ajax({
			url: "newStudentInsert.php",
			
			type: "post",
			dataType: "json",
			data: newStudData,
			async: false,
			cache: false,
			success: function(data,status){
				
				$('#result').html(data.message);
				
			}// end of success 
			
		}); // end of ajax
		
	});// end of live click addStudent
	
	
	/********************************************************************************************/
	
	$('#createCourse').live('click', function(){
			
			
		newCourseData = "cNumber=" + $('#courseId').val() + '&cName=' + $('#courseName').val() + "&credits=" + $('#totalCredits').val() + '&dept=' + $('#courseDept').val();
		
		
		
		
		$.ajax({
			url: "newCourseInsert.php",
			
			type: "post",
			dataType: "json",
			data: newCourseData,
			async: false,
			cache: false,
			success: function(data,status){
				$('#result').html(data.message);
				
			}// end of success 
			
		}); // end of ajax
		
	});// end of live click add Course
	countDays = 1;
	$('#addDays').live('click', function(){
		daysSelectData = "totalbox=" + countDays;
		
		$.ajax({
			url: "createDaysSelectBox.php",
			
			type: "post",
			dataType: "json",
			data: daysSelectData,
			async: false,
			cache: false,
			success: function(data,status){
				
				$(data.message).appendTo("#lectDayTable");
				countDays = data.total;
				
			}// end of success 
			
		}); // end of ajax
		
		
		
	});
	
	$('#createSection').live('click', function(){

		days = "&days=" + $('#lectDay').val();
		
		if(countDays > 1)
		{
			for( i = 1; i < countDays; i++)
			{
				selector = "#lectDay" + i;
				if($(selector).val() != '0')
				days += ", " + $(selector).val();
			}
		}
		
		sectionData = "courseNumber=" + $('#sectionCourse').val() + "&section=" + $('#section').val() + "&shr=" + $('#shr').val() + "&smm=" + $('#smm').val() + "&ehr=" + $('#ehr').val() + "&emm=" + $('#emm').val() + "&classroom=" + $('#classroom').val() +"&profId=" + $('#profId').val() + days + "&semester=" + $('#semester').val() + "&semYear=" + $('#semYear').val() + "&totalSeats=" + $('#totalSeats').val();
		
		//alert(sectionData);
		
		
		$.ajax({
			url: "newSectionInsert.php",
			type: "post",
			dataType: "json",
			data: sectionData,
			async: false,
			cache: false,
			success: function(data){
				
				$('#result').html(data.message);
				
				
			}// end of success 
			
		}); // end of ajax
		
	});
	
	
	
/****************** Student List *******************/


		
		$('#VSF_semester').live('change', function(){
			
			if($('#VSF_courseId').val() != '0')
			{
				$('#VSF_courseId').after("<span class='loading' id = 'leftbarloading'> </span>");
				
				getSectionData = "courseId=" + $('#VSF_courseId').val() + "&semester=" + $('#VSF_semester').val() + "&year=" + $('#VSF_semYear').val();
				
				
				
				setTimeout(function(){
					$.ajax({
						url: "getSections.php",
						
						type: "post",
						dataType: "json",
						data: getSectionData,
						async: false,
						cache: false,
						success: function(data,status){
							
							$('#leftbarloading').remove();
							if(data.success == '1')
							{	
								$('#VSF_result').html("");	
								$('#VSF_sections').html(data.message);
								$('#VSF_studentsList').html("");
							}
							else
							if(data.success == '2')
							{
								
								$('#VSF_result').html(data.message);	
								$('#VSF_sections').html("");	
								$('#VSF_studentsList').html("");
							}
							
							else
							{
								$('#VSF_studentsList').html("");
								$('#VSF_sections').html('');
								$('#VSF_studentsList').html("");
							}
							
						}// end of success 
						
					}); // end of ajax
				},500); // end of settimeout
				
			}
		});
		
		$('#VSF_semYear').live('change', function(){
			
			if($('#VSF_courseId').val() != '0')
			{
				$('#VSF_courseId').after("<span class='loading' id = 'leftbarloading'> </span>");
				
				getSectionData = "courseId=" + $('#VSF_courseId').val() + "&semester=" + $('#VSF_semester').val() + "&year=" + $('#VSF_semYear').val();
				
			
				
				setTimeout(function(){
					$.ajax({
						url: "getSections.php",
						
						type: "post",
						dataType: "json",
						data: getSectionData,
						async: false,
						cache: false,
						success: function(data,status){
							
							$('#leftbarloading').remove();
							if(data.success == '1')
							{	
								$('#VSF_result').html("");	
								$('#VSF_sections').html(data.message);
								$('#VSF_studentsList').html("");
							}
							else
							if(data.success == '2')
							{
								
								$('#VSF_result').html(data.message);	
								$('#VSF_sections').html("");
								$('#VSF_studentsList').html("");
							}
							
							else
							{
								$('#VSF_studentsList').html("");
								$('#VSF_sections').html("");
								$('#VSF_studentsList').html("");
							}
							
						}// end of success 
						
					}); // end of ajax
				},500); // end of settimeout
				
			}
		});
		
		
		
		$('#VSF_courseId').live('change', function(){
			
			$('#VSF_courseId').after("<span class='loading' id = 'leftbarloading'> </span>");
			
			getSectionData = "courseId=" + $('#VSF_courseId').val() + "&semester=" + $('#VSF_semester').val() + "&year=" + $('#VSF_semYear').val();
			
			
			
			setTimeout(function(){
				$.ajax({
					url: "getSections.php",
					
					type: "post",
					dataType: "json",
					data: getSectionData,
					async: false,
					cache: false,
					success: function(data,status){
						
						$('#leftbarloading').remove();
						if(data.success == '1')
						{	
							$('#VSF_result').html("");	
							$('#VSF_sections').html(data.message);
							$('#VSF_studentsList').html("");
						}
						else
							if(data.success == '2')
							{
								
								$('#VSF_result').html(data.message);	
								$('#VSF_sections').html("");
								$('#VSF_studentsList').html("");
							}
						else
						{
							$('#VSF_studentsList').html("");
							$('#VSF_sections').html("");
							$('#VSF_studentsList').html("");
						}
						
					}// end of success 
					
				}); // end of ajax
			},500); // end of settimeout
		});
		
		
		
		$('#VSF_sectionsList').live('change', function(){
			
			$('#VSF_sectionsList').after("<span class='loading' id = 'leftbarloading'> </span>");
			
			getStudentsData = "courseId=" + $('#VSF_courseId').val() + "&semester=" + $('#VSF_semester').val() + "&year=" + $('#VSF_semYear').val() + "&section=" + $('#VSF_sectionsList').val();
			
			
			
			setTimeout(function(){
				$.ajax({
					url: "getStudents.php",
					
					type: "post",
					dataType: "json",
					data: getStudentsData,
					async: false,
					cache: false,
					success: function(data,status){
						$('#leftbarloading').remove();
						if(data.success == '1')
						{
							
							$('#VSF_studentsList').html(data.message);
						}
						else
						if(data.success == '2')
						{
							
							$('#VSF_result').html(data.message);	
								
						}
						else
						{
							
							$('#VSF_studentsList').html('');
						}
						
					}// end of success 
					
				}); // end of ajax
			},500); // end of settimeout
		});
		
		

		
		
EOT;

echo	<<<EOT


/*****************	Register Courses **********************************************/

		
		$('#CRF_register').live('click',function(){
			
			
			$('#CRF_register').after("<span class='loading' id = 'leftbarloading'> </span>");
			
			courseRegisterData	=	"studentId=" + $('#CRF_studentId').val() + "&semester=" + $('#CRF_semester').val() + "&year=" + $('#CRF_semYear').val() + "&courseId=" + $('#CRF_courseId').val() + "&section=" + $('#CRF_section').val();
			
			
			
			setTimeout(function(){
				$.ajax({
					url: "confirmRegister.php",
					
					type: "post",
					dataType: "json",
					data: courseRegisterData,
					async: false,
					cache: false,
					success: function(data,status){
						$('#leftbarloading').remove();
						
						
						if(data.success == '2')
						{
							$('#CRF_result').html(data.message)
						}
						else
						{
							
							$('#CRF_confirmButtons').html(data.button);
							$('#CRF_result').html(data.message);
							$('#CRF_studentId').attr('disabled', 'disabled');
							$('#CRF_courseId').attr('disabled', 'disabled');
							$('#CRF_semester').attr('disabled', 'disabled');
							$('#CRF_semYear').attr('disabled', 'disabled');
							$('#CRF_section').attr('disabled', 'disabled');
						}
						
					}// end of success 
					
				}); // end of ajax
			},500); // end of settimeout
		});
		
		$('#CRF_RegConfirmNo').live('click',function(){
			
			
			$('#CRF_RegConfirmNo').after("<span class='loading' id = 'leftbarloading'> </span>");
			button = '<input class="login" type="submit" value="Register" name="CRF_register" id="CRF_register" />';
			
			setTimeout(function(){
							
				$('#leftbarloading').remove();
				$('#CRF_studentId').removeAttr('disabled');
				$('#CRF_courseId').removeAttr('disabled');
				$('#CRF_semester').removeAttr('disabled');
				$('#CRF_semYear').removeAttr('disabled');
				$('#CRF_section').removeAttr('disabled');
				
				$('#CRF_result').html('');
				$('#CRF_confirmButtons').html(button);
						
						
					
			},500); // end of settimeout
		}); // end no
		
		
		
		$('#CRF_RegConfirmYes').live('click',function(){
		
			$('#CRF_RegConfirmNo').after("<span class='loading' id = 'leftbarloading'> </span>");
		
			courseRegisterData	=	"studentId=" + $('#CRF_studentId').val() + "&semester=" + $('#CRF_semester').val() + "&year=" + $('#CRF_semYear').val() + "&courseId=" + $('#CRF_courseId').val() + "&section=" + $('#CRF_section').val();
			button = '<input class="login" type="submit" value="Register" name="CRF_register" id="CRF_register" />';
			
			setTimeout(function(){
				$.ajax({
					url: "confirmedStudentCourse.php",
					
					type: "post",
					dataType: "json",
					data: courseRegisterData,
					async: false,
					cache: false,
					success: function(data,status){
						$('#leftbarloading').remove();
						
						$('#CRF_studentId').removeAttr('disabled');
						$('#CRF_courseId').removeAttr('disabled');
						$('#CRF_semester').removeAttr('disabled');
						$('#CRF_semYear').removeAttr('disabled');
						$('#CRF_section').removeAttr('disabled');
						$('#CRF_result').html(data.message);
						$('#CRF_confirmButtons').html(button);							
						
					}// end of success 
					
				}); // end of ajax
			
			},500); // end of settimeout
			
		});
		
		

/*****************	Student Drop Courses **********************************************/

		
		$('#CDF_drop').live('click',function(){
			
			
			$('#CDF_drop').after("<span class='loading' id = 'leftbarloading'> </span>");
			
			courseDropData	=	"studentId=" + $('#CDF_studentId').val() + "&semester=" + $('#CDF_semester').val() + "&year=" + $('#CDF_semYear').val() + "&courseId=" + $('#CDF_courseId').val() + "&section=" + $('#CDF_section').val();
			
			
			
			setTimeout(function(){
				$.ajax({
					url: "confirmDrop.php",
					
					type: "post",
					dataType: "json",
					data: courseDropData,
					async: false,
					cache: false,
					success: function(data,status){
						$('#leftbarloading').remove();
						
						
						if(data.success == '2')
						{
							$('#CDF_result').html(data.message)
						}
						else
						{
							
							$('#CDF_confirmButtons').html(data.button);
							$('#CDF_result').html(data.message);
							$('#CDF_studentId').attr('disabled', 'disabled');
							$('#CDF_courseId').attr('disabled', 'disabled');
							$('#CDF_semester').attr('disabled', 'disabled');
							$('#CDF_semYear').attr('disabled', 'disabled');
							$('#CDF_section').attr('disabled', 'disabled');
						}
						
					}// end of success 
					
				}); // end of ajax
			},500); // end of settimeout
		});
		
		$('#CDF_DropConfirmNo').live('click',function(){
			
			
			$('#CDF_DropConfirmNo').after("<span class='loading' id = 'leftbarloading'> </span>");
			button = '<input class="login" type="submit" value="Drop" name="CDF_drop" id="CDF_drop" />';
			
			setTimeout(function(){
							
				$('#leftbarloading').remove();
				$('#CDF_studentId').removeAttr('disabled');
				$('#CDF_courseId').removeAttr('disabled');
				$('#CDF_semester').removeAttr('disabled');
				$('#CDF_semYear').removeAttr('disabled');
				$('#CDF_section').removeAttr('disabled');
				
				$('#CDF_result').html('');
				$('#CDF_confirmButtons').html(button);
						
						
					
			},500); // end of settimeout
		}); // end no
		
		
		$('#CDF_DropConfirmYes').live('click',function(){
		
			$('#CDF_DropConfirmYes').after("<span class='loading' id = 'leftbarloading'> </span>");
		
			courseDropData	=	"studentId=" + $('#CDF_studentId').val() + "&semester=" + $('#CDF_semester').val() + "&year=" + $('#CDF_semYear').val() + "&courseId=" + $('#CDF_courseId').val() + "&section=" + $('#CDF_section').val();
			button = '<input class="login" type="submit" value="Drop" name="CDF_drop" id="CDF_drop" />';
			//alert(button);
			//alert(courseDropData);
			
			
			setTimeout(function(){
				$.ajax({
					url: "droppedStudentCourse.php",
					
					type: "post",
					dataType: "json",
					data: courseDropData,
					async: false,
					cache: false,
					success: function(data,status){
						
						$('#leftbarloading').remove();
						
						$('#CDF_studentId').removeAttr('disabled');
						$('#CDF_courseId').removeAttr('disabled');
						$('#CDF_semester').removeAttr('disabled');
						$('#CDF_semYear').removeAttr('disabled');
						$('#CDF_section').removeAttr('disabled');
						$('#CDF_result').html(data.message);
						$('#CDF_confirmButtons').html(button);							
						
					}// end of success 
					
				}); // end of ajax
			
			},500); // end of settimeout
			
		});
		
		
/***************************** Search Courses **********************************/

	
	$('#courseSearch').live('click', function(){
		
		//courseSearchData = 'dummy=1';
		courseSearchData = "cName=" + $('#courseName').val();
		courseSearchData += "&cNumber=" + $('#courseNumber').val();
		courseSearchData += "&instructor=" + $('#instructor').val();
		courseSearchData += "&shr=" + $('#shr').val() + "&smm=" + $('#smm').val();
		courseSearchData += "&ehr=" + $('#ehr').val() + "&emm=" + $('#emm').val();
		
		
		/*if ($('#courseName').val() != "")
		{
			courseSearchData += "&cName=" + $('#courseName').val();
		}
		
		if ($('#courseNumber').val() != "")
		{
			courseSearchData += "&cNumber=" + $('#courseNumber').val();
		}
			
		if ($('#instructor').val() != "")
		{
			courseSearchData += "&instructor=" + $('#instructor').val();
		}
		
		if ($('#shr').val() != "0" && $('#smm').val() != "-1")
		{
			courseSearchData += "&shr=" + $('#shr').val() + "&smm=" + $('#smm').val();
		}
		
		if ($('#ehr').val() != "0" && $('#emm').val() != "-1")
		{
			courseSearchData += "&ehr=" + $('#shr').val() + "&smm=" + $('#smm').val();
		}*/
		$('#courseSearch').after("<span class='loading' id = 'leftbarloading'> </span>");
		
		setTimeout(function(){
			
			$('#leftbarloading').remove();
			$.ajax({
				url: "courseSearch.php",
				
				type: "post",
				dataType: "json",
				data: courseSearchData,
				async: false,
				cache: false,
				success: function(data,status){
					
					$('#result').html(data.query + "<br>" + data.message);
					
				}// end of success 
				
			}); // end of ajax
		},500);
	});
	
	
/*************************** Search Student ***************************************/		
	
	$('#SI_search').live('click',function(){
			
			
			$('#SI_search').after("<span class='loading' id = 'leftbarloading'> </span>");
			
			
			StudentData = "studentId=" + $('#SI_studentId').val() + "&netId=" + $('#SI_netId').val() + "&name="  + $('#SI_name').val();
			
			//alert(StudentData);
			
			setTimeout(function(){
				$.ajax({
					url: "SearchStudent.php",
					
					type: "post",
					dataType: "json",
					data: StudentData,
					async: false,
					cache: false,
					success: function(data,status){
						
						$('#leftbarloading').remove();
						$('#SI_result').html(data.message);
												
						
					}// end of success 
					
				}); // end of ajax
			
			},500); // end of settimeout
		}); // end no
		
		
/****************************** Search Employee ************************************/


	$('#EI_search').live('click',function(){
			
			//alert('hello');
			$('#EI_search').after("<span class='loading' id = 'leftbarloading'> </span>");
			
			
			EmployeeData = "employeeId=" + $('#EI_EmployeeId').val() + "&netId=" + $('#EI_netId').val() + "&name="  + $('#EI_name').val();
			
			//alert(StudentData);
			
			setTimeout(function(){
				$.ajax({
					url: "SearchEmployee.php",
					
					type: "post",
					dataType: "json",
					data: EmployeeData,
					async: false,
					cache: false,
					success: function(data,status){
						
						$('#leftbarloading').remove();
						$('#EI_result').html(data.message);
												
						
					}// end of success 
					
				}); // end of ajax
			
			},500); // end of settimeout
		}); // end no

	
	
	


});



EOT;

?>
