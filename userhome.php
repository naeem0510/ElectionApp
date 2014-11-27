<?php

/*** begin our session ***/
session_start();

/*** check if the users is already logged in ***/
?>


<html>
<head>
<title>Official Voting Page </title>
<link rel="stylesheet" type="text/css" href="Assets/CSS/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="Assets/CSS/bootstrap-responsive.css">
<script type="text/javascript" src="Assets/js/jquery.js"></script>
<script type="text/javascript" src="Assets/js/carousel.js"></script>

<script type="text/javascript" src="Assets/js/bootstrap.min.js"></script>

<style type="text/css">
	body {
		
		background-image: url("Assets/images/user1.jpg");
		background-size: cover;     
	   	background-attachment: fixed;
		}
	
</style>

</head>


<body>
<?php
if(isset($_SESSION['userid']))
{
	$user = $_SESSION['userid'];
    $message = 'User is already logged in';
    include 'navbar_users.php';
    include 'db_connect.php'; 

    $query = $dbh->prepare("SELECT name,changed FROM users WHERE StudentID = '$user'");
	$query->execute();
	$res = $query->fetchAll();

	foreach ($res as $value) {
		$iname = $value['name'];
		$change = $value['changed'];
	}

    if(!$change)
	    {	
	    	$query1 = $dbh->prepare("UPDATE users SET changed = '1' WHERE StudentID = '$user'");
			$query1->execute();
		    rename("Assets/profile/".$iname,"Assets/profile/".$user.".jpg");
		}
}

else
 {
	$message = 'Oops! Please Login First';
	$_SESSION['message'] = $message;
	header('Location:login.php');
	}
?>


<div style = "text-align:right;margin-right:20px;font-size:18px;">

<?php echo "Hi ! " . $_SESSION['userfn']; ?>
</div>

<?php include 'carousel.php';?>
<blockquote style="display:block"> "If Oppurtunity doesn't knock, build the door" </blockquote>

</body>
</html>

