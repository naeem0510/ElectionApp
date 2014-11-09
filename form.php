<!DOCTYPE html>

<html>
<head>
<title>Election App</title>

<style type="text/css">
	body {

			background-image: url("Assets/images/blur3.jpg");
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

		<h2 class="form-signin-heading text-muted" align="centre">Sign Up</h2>
		<input type="text" class="form-control" placeholder="Student ID" name = "studentid" required="true" autofocus=""><br/>
		<input type="password" class="form-control" placeholder="Password" name = "password2" required="true"><br/>
		<button class="btn btn-primary" type="submit">Register		
		</button>
	</form>

</body>
</html>