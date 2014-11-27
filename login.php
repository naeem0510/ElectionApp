<?php

session_start();
if(isset($_SESSION['message']))
{
	echo $_SESSION['message'];
}

?>
<!DOCTYPE html>

<html>
<head>
<title>Election App</title>

<style type="text/css">
	body {
		
		background-image: url("Assets/images/vote1.jpg");
		background-size: cover;     
	   	background-attachment: fixed;
		}
	
</style>

<link rel="stylesheet" type="text/css" href="Assets/CSS/login.css">	
<link rel="stylesheet" type="text/css" href="Assets/CSS/bootstrap.min.css">
</head>

<body>

<?php include 'sign_in.php';?>
		
		
		<form class="form-signin" action="newpass_setup.php" method = "post" autocomplete="off">

		<h2 class="form-signin-heading" align="centre">New Users</span></h2>
		<input type="text" class="form-control" placeholder="Student ID" name = "studentid" required="true" autofocus=""><br/>

		<input type="password" class="form-control" placeholder="Password" name = "password2" required="true"><br/>

		<input type="text" class="form-control" placeholder="Email" name = "email" required="true" autofocus=""><br/>

		<button class="btn btn-primary" type="submit">Register		
		</button>
	</form>
	
</body>
</html>