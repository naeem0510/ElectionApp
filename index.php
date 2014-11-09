<!DOCTYPE html>
<html>
<body>

<?php

$con = mysqli_connect("localhost","root","","mysql");
if(mysqli_connect_errno())
{
	echo "Failed to connect : ".mysqli_connect_error();
}
else
{
	echo "Connection successful" "<br>"; 
}

// Create Database
$sql = "CREATE DATABASE Students";
if(mysqli_query($con,$sql))
{
	echo "Database Created Successfully";
}
else
{
	echo "Failed to Create Database : ".mysqli_error($con);
}

?>

</body>
</html>