<?php


$total = $_POST['totalbox'];

if($total < 7 )
{
	$x = "<tr><td></td><td></td><td colspan = '2'><select class='select-input' rel='time' name='lectDay".$total."' id='lectDay".$total."'>";
	$x .= "<option value='0'>Days</option>";
	$days = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
				
	for( $i = 0; $i<=6; $i++)
	{
		$j = $i+1;
		$x .=  "<option value='$j'>$days[$i]</option>";
	}
	
	$x .= "</select></td></tr>";
	
	
	$reply = array(
					"total"		=>	++$total,
					"message"	=>	$x
					);
					
	echo json_encode($reply);
	exit();
}


?>