<?php
	
				// Script to Display Image


include 'db_connect.php';
$result = $dbh->prepare("SELECT * FROM image WHERE id = '1'" );


while($row = $result->fetchAll())
{
echo '<img src="' . $row['image'] . '" width="200" />';
echo'<br /><br />';  
}

?>