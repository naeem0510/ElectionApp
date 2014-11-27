<?php
session_start();
$sid = $_SESSION['userid'];

require 'image_compare.php';
 
/*
	these two images are almost the same so the hammered distance will be less than 10
	try it with images like this:
		1. the example images
		2. two complatly different image
		3. the same image (returned number should be 0)
		4. the same image but with different size, even different aspect ratio (returned number should be 0)
	you will see how the returned number will represent the similarity of the images.
*/ 

include 'db_connect.php';

$query = $dbh->prepare("SELECT image,name FROM users WHERE StudentID = '$sid");
$query->execute();

$class = new compareImages;
echo $class->compare('Assets/profile/$sid.jpg','6.jpg');
  
?>