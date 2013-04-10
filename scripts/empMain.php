<?php
@session_start();
Header("content-type: application/x-javascript");


echo <<<EOT


$(document).ready(function(){

  $('#empWorkArea').load("adminWorkArea.php #beginning", function(){	
	
		
	});
	
	$('#searchCourse').live('click', function(){
		
		$('#searchCourse').after("<span class='loading' id = 'leftbarloading'> </span>");
		$(document).unbind('keydown');
		$(document).bind("keydown", function(e){
			if(e.which == '13')
			{
				$('#courseSearch').trigger('click');	
				
			}
		});
		
		setTimeout(function(){
			$('#empWorkArea').load("empWorkArea.php #searchCourseForm", function(){
				$('#leftbarloading').remove();
				$('*').removeClass("selectedBar");
				$('#searchCourse').addClass("selectedBar");
			
			});
		},500);
		
	});
	
	$('#studentList').live('click', function(){
		
		$('#studentList').after("<span class='loading' id = 'leftbarloading'> </span>");
		
	
		/*$(document).bind("keydown", function(e){
			if(e.which == '13')
			{
				$('#courseSearch').trigger('click');	
				
			}
		});*/
		
		
		setTimeout(function(){
			$('#empWorkArea').load("empWorkArea.php #studentList", function(){
				$('#leftbarloading').remove();
				$('*').removeClass("selectedBar");
				$('#studentList').addClass("selectedBar");
			
			});
		},500);
		
	});
	
	$('#viewSchedule').live('click', function(){
		
		$('#viewSchedule').after("<span class='loading' id = 'leftbarloading'> </span>");
		
	
		/*$(document).bind("keydown", function(e){
			if(e.which == '13')
			{
				$('#courseSearch').trigger('click');	
				
			}
		});*/
		
		
		setTimeout(function(){
			$('#empWorkArea').load("empWorkArea.php #viewScheduleArea", function(){
				$('#leftbarloading').remove();
				$('*').removeClass("selectedBar");
				$('#viewSchedule').addClass("selectedBar");
			
			});
		},500);
		
	});
	
	$('#Assignment').live('click', function(){
		
		$('#Assignment').after("<span class='loading' id = 'leftbarloading'> </span>");
		$(document).unbind('keydown');
		$(document).bind("keydown", function(e){
			if(e.which == '13')
			{
				$('#courseSearch').trigger('click');	
				
			}
		});
		
		setTimeout(function(){
			$('#empWorkArea').load("empWorkArea.php #AssignmentArea", function(){
				$('#leftbarloading').remove();
				$('*').removeClass("selectedBar");
				$('#Assignment').addClass("selectedBar");
			
			});
		},500);
		
	});
	
	$('#Midterms').live('click', function(){
		
		$('#Midterms').after("<span class='loading' id = 'leftbarloading'> </span>");
		
		setTimeout(function(){
			$('#empWorkArea').load("empWorkArea.php #MidtermsArea", function(){
				$('#leftbarloading').remove();
				$('*').removeClass("selectedBar");
				$('#Midterms').addClass("selectedBar");
			
			});
		},500);
		
	});
	
	$('#Project').live('click', function(){
		
		$('#Project').after("<span class='loading' id = 'leftbarloading'> </span>");
		
		setTimeout(function(){
			$('#empWorkArea').load("empWorkArea.php #ProjectArea", function(){
				$('#leftbarloading').remove();
				$('*').removeClass("selectedBar");
				$('#Project').addClass("selectedBar");
			
			});
		},500);
		
	});
	
	
	$('#Quiz').live('click', function(){
		
		$('#Quiz').after("<span class='loading' id = 'leftbarloading'> </span>");
		
		setTimeout(function(){
			$('#empWorkArea').load("empWorkArea.php #QuizArea", function(){
				$('#leftbarloading').remove();
				$('*').removeClass("selectedBar");
				$('#Quiz').addClass("selectedBar");
			
			});
		},500);
		
	});
	
	
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
	
	
	/******************** ASSIGNMENTS *******************************/
	
	$('#AA_semYear').live('change', function(){
		if($('#AA_semester').val() != '0')
		{
			$('#AA_semYear').after("<span class='loading' id = 'leftbarloading'> </span>");
					
			getProfData = "semester=" + $('#AA_semester').val() + "&year=" + $('#AA_semYear').val();
			
			//alert(getProfData);
			
			setTimeout(function(){
				$.ajax({
					url: "getAssignmentData.php",
					
					type: "post",
					dataType: "json",
					data: getProfData,
					async: false,
					cache: false,
					success: function(data,status){	
						$('#leftbarloading').remove();
						$('#AA_StudentLists').html("");
						$('#AA_MyCourses').html(data.message);
					
					}//end success
					
				});//end ajax
				
			},500) // setTimeOUt
		}
	
	});
	
	$('#AA_semester').live('change', function(){
		if($('#AA_semYear').val() != '0')
		{
			$('#AA_semester').after("<span class='loading' id = 'leftbarloading'> </span>");
					
			getProfData = "semester=" + $('#AA_semester').val() + "&year=" + $('#AA_semYear').val();
			
			//alert(getProfData);
			
			setTimeout(function(){
				$.ajax({
					url: "getAssignmentData.php",
					
					type: "post",
					dataType: "json",
					data: getProfData,
					async: false,
					cache: false,
					success: function(data,status){	
						$('#leftbarloading').remove();
						
						$('#AA_StudentLists').html("");
						$('#AA_MyCourses').html(data.message);
					
					}//end success
					
				});//end ajax
				
			},500) // setTimeOUt
		}
	
	});
	
	totalStudents=0;
	$('#addNewAssignment').live('click', function(){
		$(this).after("<span class='loading' id = 'leftbarloading'> </span>");
		
		
		
		addAssignmentData = "sectionId=" + $(this).attr('rel');
		
		//alert(addAssignmentData);
		
		setTimeout(function(){
				$.ajax({
					url: "feedAssignmentMarks.php",
					type: "post",
					dataType: "json",
					data: addAssignmentData,
					async: false,
					cache: false,
					success: function(data,status){	
						$('#leftbarloading').remove();
						$('#AA_StudentLists').html(data.message);
						totalStudents = data.total;
					}//end success
					
				});//end ajax
				
			},500) // setTimeOut
		
		
	});
	
	$('#GradeAssignmentSubmit').live('click', function(){
		
		//alert(totalStudents);
		$(this).after("<span class='loading' id = 'leftbarloading'> </span>");
		message="";
		setTimeout(function(){
			for(i=1; i<=totalStudents; i++)
			{
				gradeData = "studentId=" + $('#gradeTextBox'+i).attr('rel') + "&sectionId=" +  $('#gradeTextBox'+i).attr('name') +  "&grade=" + $('#gradeTextBox'+i).val() + "&date=" + $('#year').val() + "-" + $('#month').val() + "-" + $('#day').val();
				
				$.ajax({
					url: "insertAssignmentMarks.php",
					type: "post",
					dataType: "json",
					data: gradeData,
					async: false,
					cache: false,
					success: function(data,status){	
						message = data.message;
						if(data.success == '0')
						{
							i = totalStudents;
						}
						
					}//end success
					
				});//end ajax
				
			}	
			
			
			
			$('#AA_semester').trigger('change');
			
			$('#leftbarloading').remove();
			setTimeout(function(){
			$('#AA_StudentLists').html(message);
			},500)
		},500) // setTimeOut		
		
	})
	
	$('#assignmentsExist').live('click', function(){
			$(this).after("<span class='loading' id = 'leftbarloading'> </span>");
			completeData = $(this).attr('rel');
			myPoint = completeData.indexOf('*');
			StudentAssignmentData = "date=" + completeData.substring(0,myPoint) + "&sectionId=" + completeData.substring(myPoint+1);
			
			setTimeout(function(){
				$.ajax({
					url: "getAssignmentMarks.php",
					type: "post",
					dataType: "json",
					data: StudentAssignmentData,
					async: false,
					cache: false,
					success: function(data,status){
							
						$('#leftbarloading').remove();
						totalStudents = data.total;
						
						$('#AA_StudentLists').html(data.message);
						
					}//end success
					
				});//end ajax
				
			},500) // setTimeOut
		});	
		
		
	
	
	$('#GradeAssignmentUpdateSubmit').live('click',function(){
		
		
		$(this).after("<span class='loading' id = 'leftbarloading'> </span>");
		message="";
		setTimeout(function(){
			for(i=1; i<=totalStudents; i++)
			{
				gradeData = "studentId=" + $('#gradeTextBox'+i).attr('rel') + "&examId=" +  $('#gradeTextBox'+i).attr('name') +  "&grade=" + $('#gradeTextBox'+i).val() + "&date=" + $('#year').val() + "-" + $('#month').val() + "-" + $('#day').val();
				
				
				
				$.ajax({
					url: "updateAssignmentMarks.php",
					type: "post",
					dataType: "json",
					data: gradeData,
					async: false,
					cache: false,
					success: function(data,status){	
						message = data.message;
						if(data.success == '0')
						{
							i = totalStudents;
						}
						
					}//end success
					
				});//end ajax
			}	
			$('#AA_semester').trigger('change');
			
			$('#leftbarloading').remove();
			setTimeout(function(){
			$('#AA_StudentLists').html(message);
			},500)
		},500) // setTimeOut		
	});
	
	
	
	/******************** Midterms *******************************/
	
	$('#MA_semYear').live('change', function(){
		if($('#MA_semester').val() != '0')
		{
			$('#MA_semYear').after("<span class='loading' id = 'leftbarloading'> </span>");
					
			getProfData = "semester=" + $('#MA_semester').val() + "&year=" + $('#MA_semYear').val();
			
			//alert(getProfData);
			
			setTimeout(function(){
				$.ajax({
					url: "getMidtermData.php",
					
					type: "post",
					dataType: "json",
					data: getProfData,
					async: false,
					cache: false,
					success: function(data,status){	
						$('#leftbarloading').remove();
						$('#MA_StudentLists').html("");
						$('#MA_MyCourses').html(data.message);
					
					}//end success
					
				});//end ajax
				
			},500) // setTimeOUt
		}
	
	});
	
	$('#MA_semester').live('change', function(){
		if($('#MA_semYear').val() != '0')
		{
			$('#MA_semester').after("<span class='loading' id = 'leftbarloading'> </span>");
					
			getProfData = "semester=" + $('#MA_semester').val() + "&year=" + $('#MA_semYear').val();
			
			//alert(getProfData);
			
			setTimeout(function(){
				$.ajax({
					url: "getMidtermData.php",
					
					type: "post",
					dataType: "json",
					data: getProfData,
					async: false,
					cache: false,
					success: function(data,status){	
						$('#leftbarloading').remove();
						
						$('#MA_StudentLists').html("");
						$('#MA_MyCourses').html(data.message);
					
					}//end success
					
				});//end ajax
				
			},500) // setTimeOUt
		}
	
	});
	
	
EOT;

echo	<<<EOT

	totalStudents=0;
	$('#addNewMidterm').live('click', function(){
		$(this).after("<span class='loading' id = 'leftbarloading'> </span>");
		
		addMidtermData = "sectionId=" + $(this).attr('rel');
		
		setTimeout(function(){
				$.ajax({
					url: "feedMidtermMarks.php",
					type: "post",
					dataType: "json",
					data: addMidtermData,
					async: false,
					cache: false,
					success: function(data,status){	
						$('#leftbarloading').remove();
						$('#MA_StudentLists').html(data.message);
						totalStudents = data.total;
					}//end success
					
				});//end ajax
				
			},500) // setTimeOut
		
		
	});
	
	$('#GradeMidtermSubmit').live('click', function(){
		
		//alert(totalStudents);
		$(this).after("<span class='loading' id = 'leftbarloading'> </span>");
		message="";
		setTimeout(function(){
			for(i=1; i<=totalStudents; i++)
			{
				gradeData = "studentId=" + $('#gradeTextBox'+i).attr('rel') + "&sectionId=" +  $('#gradeTextBox'+i).attr('name') +  "&grade=" + $('#gradeTextBox'+i).val() + "&date=" + $('#year').val() + "-" + $('#month').val() + "-" + $('#day').val();
				
				$.ajax({
					url: "insertMidtermMarks.php",
					type: "post",
					dataType: "json",
					data: gradeData,
					async: false,
					cache: false,
					success: function(data,status){	
						message = data.message;
						if(data.success == '0')
						{
							i = totalStudents;
						}
						
					}//end success
					
				});//end ajax
				
			}	
			$('#MA_semester').trigger('change');
			
			$('#leftbarloading').remove();
			setTimeout(function(){
			$('#MA_StudentLists').html(message);
			},500)
		},500) // setTimeOut		
		
	})

	$('#MidtermsExist').live('click', function(){
			$(this).after("<span class='loading' id = 'leftbarloading'> </span>");
			completeData = $(this).attr('rel');
			myPoint = completeData.indexOf('*');
			StudentMidtermsData = "date=" + completeData.substring(0,myPoint) + "&sectionId=" + completeData.substring(myPoint+1);
			
			setTimeout(function(){
				$.ajax({
					url: "getMidtermMarks.php",
					type: "post",
					dataType: "json",
					data: StudentMidtermsData,
					async: false,
					cache: false,
					success: function(data,status){
							
						$('#leftbarloading').remove();
						totalStudents = data.total;
						
						$('#MA_StudentLists').html(data.message);
						
					}//end success
					
				});//end ajax
				
			},500) // setTimeOut
		});
		
		
		
		$('#GradeMidtermUpdateSubmit').live('click',function(){
		
		$(this).after("<span class='loading' id = 'leftbarloading'> </span>");
		message="";
		setTimeout(function(){
			for(i=1; i<=totalStudents; i++)
			{
				gradeData = "studentId=" + $('#gradeTextBox'+i).attr('rel') + "&examId=" +  $('#gradeTextBox'+i).attr('name') +  "&grade=" + $('#gradeTextBox'+i).val() + "&date=" + $('#year').val() + "-" + $('#month').val() + "-" + $('#day').val();
				
				
				
				$.ajax({
					url: "updateMidtermMarks.php",
					type: "post",
					dataType: "json",
					data: gradeData,
					async: false,
					cache: false,
					success: function(data,status){	
						message = data.message;
						if(data.success == '0')
						{
							i = totalStudents;
						}
						
					}//end success
					
				});//end ajax
			}	
			$('#MA_semester').trigger('change');
			
			$('#leftbarloading').remove();
			setTimeout(function(){
			$('#MA_StudentLists').html(message);
			},500)
		},500) // setTimeOut		
	});
		


		/******************** Project *******************************/
	
	$('#PA_semYear').live('change', function(){
		if($('#PA_semester').val() != '0')
		{
			$('#PA_semYear').after("<span class='loading' id = 'leftbarloading'> </span>");
					
			getProfData = "semester=" + $('#PA_semester').val() + "&year=" + $('#PA_semYear').val();
			
			
			
			setTimeout(function(){
				$.ajax({
					url: "getProjectData.php",
					
					type: "post",
					dataType: "json",
					data: getProfData,
					async: false,
					cache: false,
					success: function(data,status){	
						$('#leftbarloading').remove();
						$('#PA_StudentLists').html("");
						$('#PA_MyCourses').html(data.message);
					
					}//end success
					
				});//end ajax
				
			},500) // setTimeOUt
		}
	
	});
	
	$('#PA_semester').live('change', function(){
		if($('#PA_semYear').val() != '0')
		{
			$('#PA_semester').after("<span class='loading' id = 'leftbarloading'> </span>");
					
			getProfData = "semester=" + $('#PA_semester').val() + "&year=" + $('#PA_semYear').val();
			
			//alert(getProfData);
			
			setTimeout(function(){
				$.ajax({
					url: "getProjectData.php",
					
					type: "post",
					dataType: "json",
					data: getProfData,
					async: false,
					cache: false,
					success: function(data,status){	
						$('#leftbarloading').remove();
						
						$('#PA_StudentLists').html("");
						$('#PA_MyCourses').html(data.message);
					
					}//end success
					
				});//end ajax
				
			},500) // setTimeOUt
		}
	
	});
	
	
	totalStudents=0;
	$('#addNewProject').live('click', function(){
		$(this).after("<span class='loading' id = 'leftbarloading'> </span>");
		
		
		
		addProjectData = "sectionId=" + $(this).attr('rel');
		
		//alert(addProjectData);
		
		setTimeout(function(){
				$.ajax({
					url: "feedProjectMarks.php",
					type: "post",
					dataType: "json",
					data: addProjectData,
					async: false,
					cache: false,
					success: function(data,status){	
						$('#leftbarloading').remove();
						$('#PA_StudentLists').html(data.message);
						totalStudents = data.total;
					}//end success
					
				});//end ajax
				
			},500) // setTimeOut
		
		
	});
	
	
	$('#GradeProjectSubmit').live('click', function(){
		
		//alert(totalStudents);
		$(this).after("<span class='loading' id = 'leftbarloading'> </span>");
		message="";
		setTimeout(function(){
			for(i=1; i<=totalStudents; i++)
			{
				gradeData = "studentId=" + $('#gradeTextBox'+i).attr('rel') + "&sectionId=" +  $('#gradeTextBox'+i).attr('name') +  "&grade=" + $('#gradeTextBox'+i).val() + "&date=" + $('#year').val() + "-" + $('#month').val() + "-" + $('#day').val();
				
				$.ajax({
					url: "insertProjectMarks.php",
					type: "post",
					dataType: "json",
					data: gradeData,
					async: false,
					cache: false,
					success: function(data,status){	
						message = data.message;
						if(data.success == '0')
						{
							i = totalStudents;
						}
						
					}//end success
					
				});//end ajax
				
			}	
			
			
			
			$('#PA_semester').trigger('change');
			
			$('#leftbarloading').remove();
			setTimeout(function(){
			$('#PA_StudentLists').html(message);
			},500)
		},500) // setTimeOut		
		
	})
	
	
	$('#ProjectsExist').live('click', function(){
			$(this).after("<span class='loading' id = 'leftbarloading'> </span>");
			completeData = $(this).attr('rel');
			myPoint = completeData.indexOf('*');
			StudentProjectsData = "date=" + completeData.substring(0,myPoint) + "&sectionId=" + completeData.substring(myPoint+1);
			
			setTimeout(function(){
				$.ajax({
					url: "getProjectMarks.php",
					type: "post",
					dataType: "json",
					data: StudentProjectsData,
					async: false,
					cache: false,
					success: function(data,status){
							
						$('#leftbarloading').remove();
						totalStudents = data.total;
						
						$('#PA_StudentLists').html(data.message);
						
					}//end success
					
				});//end ajax
				
			},500) // setTimeOut
		});	



	$('#GradeProjectUpdateSubmit').live('click',function(){
		
		$(this).after("<span class='loading' id = 'leftbarloading'> </span>");
		message="";
		setTimeout(function(){
			for(i=1; i<=totalStudents; i++)
			{
				gradeData = "studentId=" + $('#gradeTextBox'+i).attr('rel') + "&examId=" +  $('#gradeTextBox'+i).attr('name') +  "&grade=" + $('#gradeTextBox'+i).val() + "&date=" + $('#year').val() + "-" + $('#month').val() + "-" + $('#day').val();
				
				$.ajax({
					url: "updateProjectMarks.php",
					type: "post",
					dataType: "json",
					data: gradeData,
					async: false,
					cache: false,
					success: function(data,status){	
						message = data.message;
						if(data.success == '0')
						{
							i = totalStudents;
						}
						
					}//end success
					
				});//end ajax
			}	
			$('#PA_semester').trigger('change');
			
			$('#leftbarloading').remove();
			setTimeout(function(){
			$('#PA_StudentLists').html(message);
			},500)
		},500) // setTimeOut		
	});
	
		/******************** QUIZ *******************************/
	
	$('#QA_semYear').live('change', function(){
		if($('#QA_semester').val() != '0')
		{
			$('#QA_semYear').after("<span class='loading' id = 'leftbarloading'> </span>");
					
			getProfData = "semester=" + $('#QA_semester').val() + "&year=" + $('#QA_semYear').val();
			
			
			
			setTimeout(function(){
				$.ajax({
					url: "getQuizData.php",
					
					type: "post",
					dataType: "json",
					data: getProfData,
					async: false,
					cache: false,
					success: function(data,status){	
						$('#leftbarloading').remove();
						$('#QA_StudentLists').html("");
						$('#QA_MyCourses').html(data.message);
					
					}//end success
					
				});//end ajax
				
			},500) // setTimeOUt
		}
	
	});
	
	$('#QA_semester').live('change', function(){
		if($('#QA_semYear').val() != '0')
		{
			$('#QA_semester').after("<span class='loading' id = 'leftbarloading'> </span>");
					
			getProfData = "semester=" + $('#QA_semester').val() + "&year=" + $('#QA_semYear').val();
			
			//alert(getProfData);
			
			setTimeout(function(){
				$.ajax({
					url: "getQuizData.php",
					
					type: "post",
					dataType: "json",
					data: getProfData,
					async: false,
					cache: false,
					success: function(data,status){	
						$('#leftbarloading').remove();
						
						$('#QA_StudentLists').html("");
						$('#QA_MyCourses').html(data.message);
					
					}//end success
					
				});//end ajax
				
			},500) // setTimeOUt
		}
	
	});
	
	
	totalStudents=0;
	$('#addNewQuiz').live('click', function(){
		$(this).after("<span class='loading' id = 'leftbarloading'> </span>");
		
		addQuizData = "sectionId=" + $(this).attr('rel');
		
		//alert(addQuizData);
		
		setTimeout(function(){
				$.ajax({
					url: "feedQuizMarks.php",
					type: "post",
					dataType: "json",
					data: addQuizData,
					async: false,
					cache: false,
					success: function(data,status){	
						$('#leftbarloading').remove();
						$('#QA_StudentLists').html(data.message);
						totalStudents = data.total;
					}//end success
					
				});//end ajax
				
			},500) // setTimeOut
		
		
	});

	$('#GradeQuizSubmit').live('click', function(){
		
		//alert(totalStudents);
		$(this).after("<span class='loading' id = 'leftbarloading'> </span>");
		message="";
		setTimeout(function(){
			for(i=1; i<=totalStudents; i++)
			{
				gradeData = "studentId=" + $('#gradeTextBox'+i).attr('rel') + "&sectionId=" +  $('#gradeTextBox'+i).attr('name') +  "&grade=" + $('#gradeTextBox'+i).val() + "&date=" + $('#year').val() + "-" + $('#month').val() + "-" + $('#day').val();
				
				$.ajax({
					url: "insertQuizMarks.php",
					type: "post",
					dataType: "json",
					data: gradeData,
					async: false,
					cache: false,
					success: function(data,status){	
						message = data.message;
						if(data.success == '0')
						{
							i = totalStudents;
						}
						
					}//end success
					
				});//end ajax
				
			}	
			
			
			
			$('#QA_semester').trigger('change');
			
			$('#leftbarloading').remove();
			setTimeout(function(){
			$('#QA_StudentLists').html(message);
			},500)
		},500) // setTimeOut		
		
	})
	
	$('#QuizExist').live('click', function(){
			$(this).after("<span class='loading' id = 'leftbarloading'> </span>");
			completeData = $(this).attr('rel');
			myPoint = completeData.indexOf('*');
			StudentQuizData = "date=" + completeData.substring(0,myPoint) + "&sectionId=" + completeData.substring(myPoint+1);
			
			setTimeout(function(){
				$.ajax({
					url: "getQuizMarks.php",
					type: "post",
					dataType: "json",
					data: StudentQuizData,
					async: false,
					cache: false,
					success: function(data,status){
							
						$('#leftbarloading').remove();
						totalStudents = data.total;
						
						$('#QA_StudentLists').html(data.message);
						
					}//end success
					
				});//end ajax
				
			},500) // setTimeOut
		});
		
		
	$('#GradeQuizUpdateSubmit').live('click',function(){
		
		$(this).after("<span class='loading' id = 'leftbarloading'> </span>");
		message="";
		setTimeout(function(){
			for(i=1; i<=totalStudents; i++)
			{
				gradeData = "studentId=" + $('#gradeTextBox'+i).attr('rel') + "&examId=" +  $('#gradeTextBox'+i).attr('name') +  "&grade=" + $('#gradeTextBox'+i).val() + "&date=" + $('#year').val() + "-" + $('#month').val() + "-" + $('#day').val();
				
				
				
				$.ajax({
					url: "updateQuizMarks.php",
					type: "post",
					dataType: "json",
					data: gradeData,
					async: false,
					cache: false,
					success: function(data,status){	
						message = data.message;
						if(data.success == '0')
						{
							i = totalStudents;
						}
						
					}//end success
					
				});//end ajax
			}	
			$('#QA_semester').trigger('change');
			
			$('#leftbarloading').remove();
			setTimeout(function(){
			$('#QA_StudentLists').html(message);
			},500)
		},500) // setTimeOut		
	});


EOT;

echo <<<EOT
	
	$('#VS_semYear').live('change', function(){
		if($('#VS_semester').val() != '0')
		{
			$('#VS_semYear').after("<span class='loading' id = 'leftbarloading'> </span>");
					
			getProfData = "semester=" + $('#VS_semester').val() + "&year=" + $('#VS_semYear').val();
			
			
			
			setTimeout(function(){
				$.ajax({
					url: "getSchedule.php",
					type: "post",
					dataType: "json",
					data: getProfData,
					async: false,
					cache: false,
					success: function(data,status){	
						$('#leftbarloading').remove();
						$('#VS_StudentLists').html("");
						$('#VS_MyCourses').html(data.message);
					}//end success
				});//end ajax
			},500) // setTimeOUt
		}
	});
	
	$('#VS_semester').live('change', function(){
		if($('#VS_semYear').val() != '0')
		{
			$('#VS_semester').after("<span class='loading' id = 'leftbarloading'> </span>");
					
			getProfData = "semester=" + $('#VS_semester').val() + "&year=" + $('#VS_semYear').val();
			
			//alert(getProfData);
			
			setTimeout(function(){
				$.ajax({
					url: "getSchedule.php",
					type: "post",
					dataType: "json",
					data: getProfData,
					async: false,
					cache: false,
					success: function(data,status){	
						$('#leftbarloading').remove();
						$('#VS_StudentLists').html("");
						$('#VS_MyCourses').html(data.message);
					}//end success
				});//end ajax
			},500) // setTimeOUt
		}
	});
	
	

});
EOT;

?>
