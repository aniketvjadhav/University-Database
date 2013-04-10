// JavaScript Document

function checkdate()
{
  year1 = document.getElementById('year');
	month1 = document.getElementById('month');
	day1 = document.getElementById('day');
		
	if(year1.value != "")
	{
		if(year1.value%4 == 0)
		{		
			if(month1.value == '2')
			{
				currlen = day1.length;
				if (currlen > 30)
				{
					for(i=0; i < currlen-30; i++)
					{
						day1.remove(day1.length - 1);
						day1.value = '29';
					}
				}
				else
				{
					if(currlen < 30)
					addelement('29', '29');
				}
			}
		
		}
		else
		{
			if(month1.value == '2')
			{
				currlen = day1.length;
				if (currlen > 29)
				{
					for(i=0; i < currlen-29; i++)
					{
						day1.remove(day1.length - 1);
						day1.value = '28';
					}
				}
			}		
		}
	}
	if( month1.value == '1' || month1.value == '3' || month1.value == '5' || month1.value == '7' || month1.value == '8' || month1.value == '10' || month1.value == '12')
	{
		currlen = day1.length;		
		j=currlen-1;
		for(i = 0; i< 32-currlen; i++)
		{
			
			j++;
			addelement(j, ''+j);				
		}		
	}
	if( month1.value == '4' || month1.value == '6' || month1.value == '9' || month1.value == '11' )
	{
		currlen = day1.length;
		if (currlen > 31)
		{
			for(i=0; i < currlen-31; i++)
			{
				day1.remove(day1.length - 1);
				day1.value = '30';
			}
			
		}		
		if (currlen < 31)
		{
			j=currlen-1;
			for(i = 0; i< 31-currlen; i++)
			{
				j++;
				addelement(j, ''+j);					
			}
		}		
	}	
}
function addelement(text1, value1)
{
	newopt = document.createElement('option');
	newopt.text = text1;
	newopt.value = value1;
	newopt.select = "select";
	try
	{
		day1.add(newopt, null); 
		// standards compliant; doesn't work in IE
	}
	catch(ex) 
	{
		day1.add(newopt); // IE only
	}	
}
