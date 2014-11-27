<!-- Admin PHP -->
<?php
session_start();

if(!isset($_SESSION['userid']))
{
//	header("refresh:10;url=form.php");
header('Location: form.php');	
}

?>


<!DOCTYPE html>
<html>
<head>

<title> Admin Dashboard </title>

</head>

<body>
	
<?php 
  
		include 'navbar_admin.php';
		include 'carousel.php';

?>

</body>

</html>
