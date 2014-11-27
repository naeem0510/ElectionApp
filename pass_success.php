<?php

session_start();

	if(isset($_SESSION['userid']))
	{
		include 'db_connect.php';
		try
		{
			$studentid = $_SESSION['userid'];

			$stmt1 = $dbh->prepare("SELECT registered FROM users WHERE StudentID = '$studentid'");
			$stmt1->execute();
			$registered = $stmt1->fetchColumn();
			
			if(!$registered)			// If not registered then register user
			{
				$password = $_POST['password2'];			// Store new password
				$hash = sha1($password);
				
				$stmt = $dbh->prepare("UPDATE users SET registered = '1',password = '$hash' WHERE StudentID = '$studentid'");
				$stmt->execute();			
			}

			else
			{

			//	echo 'yaha fans gaya tu';
			//	header('Location:pass_success.php');
			}
		}

		catch(Exception $e)
		{
			echo $e;
		}
}

	else
	{
		header('Location:login.php');
	}

?>

<html>

<head>
	
<title>
	Change password </title>

</head>

<body>


<h3>Please Choose a File and click Submit</h3>

<form enctype="multipart/form-data" action="image_upload_suc.php" method="post">

<label>Choose File to Upload:</label><br />

<input type="hidden" name="id" />

<input type="file" name="uploadimage" /><br />

<input type="submit" value="upload" />
</form>

<p> Thanks for your time. You have successfully registered.</p>
<p> Please save this password, as it will be required during the time of Vote.</p>
<br>
<br>
<br>


</body>

</html>