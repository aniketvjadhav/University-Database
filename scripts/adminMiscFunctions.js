// JavaScript Document

/*function addNewEmpType()
{
  empTypeRow1 = document.getElementById('empTypeRow');
	checkbox1 = document.getElementById('empTypeAbsent');
	newEmpTypeArea1 = document.getElementById('newEmpTypeArea');
	
	if (checkbox1.checked)
	{
		newEmpTypeArea1.innerHTML = '<input value="" class="text-input" type="text" name="newEmpType" id="newEmpType"/>';
		newEmpTypeLabel.innerHTML = '<label for="newEmpType">New Type</label>';
		empTypeRow1.style.display = '';	
		document.getElementById('empType').disabled = 'disabled';
		document.getElementById('empType').value = '0';
	}
	else
	{ 
		newEmpTypeArea1.innerHTML = '';
		empTypeRow1.style.display = 'none';
		document.getElementById('empType').disabled = '';
	}
}*/

function isNumberKey(evt)
{
	 var charCode = (evt.which) ? evt.which : event.keyCode
	 if ((charCode > 31 && charCode < 46) || charCode == 47 || charCode > 57 )
		return false;
	
	 return true;
}	
	
