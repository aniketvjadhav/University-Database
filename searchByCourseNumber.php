<?php

$term = trim(strip_tags($_GET['term']));

$query = "
			SELECT	CourseName as value, c.CourseId as id
			FROM	Courses c
				JOIN
					Sections s
				ON
					(c.CourseId = s.CourseId)
			WHERE	CourseName LIKE '%".$term."%'";
		
$result = mysql_query($query);
$i = 0;
while ( $rows = mysql_fetch_array($result) )
{
		$i++ ;
		$row['value']=htmlentities(stripslashes($rows['value']));
		$row['id'] = $i;
		$row_set[] = $row;//build an array
}
echo json_encode($row_set);


/*$row_set = '[{"value":"Some Name","id":1},{"value":"Some Othername","id":2}]';



echo $row_set;
*/
?>