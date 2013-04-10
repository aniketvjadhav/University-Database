<?php
@session_start();
Header("content-type: application/x-javascript");

echo <<<EOT

$(document).ready(function(){
  
	$('#studWorkArea').load("studWorkArea.php #viewTranscriptsForm", function(){	
	
		$('#viewTranscripts').addClass("selectedBar");
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
			$('#studWorkArea').load("empWorkArea.php #searchCourseForm", function(){
				$('#leftbarloading').remove();
				$('*').removeClass("selectedBar");
				$('#searchCourse').addClass("selectedBar");
			
			});
		},500);
		
	});
	
	$('#viewTranscripts').live('click', function(){
		
		$('#viewTranscripts').after("<span class='loading' id = 'leftbarloading'> </span>");
		
		
		setTimeout(function(){
			$('#studWorkArea').load("studWorkArea.php #viewTranscriptsForm", function(){
				$('#leftbarloading').remove();
				$('*').removeClass("selectedBar");
				$('#viewTranscripts').addClass("selectedBar");
			
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
			
			
			$.ajax({
				url: "courseSearch.php",
				
				type: "post",
				dataType: "json",
				data: courseSearchData,
				async: false,
				cache: false,
				success: function(data,status){
					$('#leftbarloading').remove();
					$('#result').html(data.query + "<br>" + data.message);
					
				}// end of success 
				
			}); // end of ajax
		},500);
	});
	
	
/*********************************** Transcripts ***************************************************/	
	
	$('#VT_semester').live('change', function(){
		$('#VT_semester').after("<span class='loading' id = 'leftbarloading'> </span>");
		
		
		pointer = $('#VT_semester').val().indexOf(' ');
		sem  = $('#VT_semester').val().substring(0, pointer);
		year = $('#VT_semester').val().substring(pointer+1);
		
		transcriptData = "studentId=" + $('#studentId').val() + "&sem=" + sem + "&year=" + year;
		
		//alert(transcriptData);
		
		
		
		setTimeout(function(){
			$.ajax({
				url: "getTranscripts.php",
				
				type: "post",
				dataType: "json",
				data: transcriptData,
				async: false,
				cache: false,
				success: function(data,status){
					
					$('#leftbarloading').remove();
					$('#VT_results').html(data.message);
					
				}// end of success 
				
			}); // end of ajax
		},500);
		
		
		
		
		
	});
	
	
});
	
EOT;

?>
