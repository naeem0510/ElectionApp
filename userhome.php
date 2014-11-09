<?php

/*** begin our session ***/
session_start();
$user = $_SESSION['userid'];

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


</head>


<body>
<?php
if(isset($_SESSION['userid']))
{
    $message = 'User is already logged in';
    include 'navbar_users.php';
    include 'db_connect.php';  
}

else {
	echo 'Oops! Please Login First';
}
?>


<div style = "text-align:right;margin-right:20px;font-size:18px;">

<?php echo "Hi ! " . $_SESSION['userfn']; ?>
</div>

<?php include 'carousel.php';?>
</body>
</html>

