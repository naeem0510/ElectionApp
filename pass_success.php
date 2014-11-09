<?php

	session_start();
	include 'db_connect.php';

	$studentid = $_SESSION['userid'];			// Store Username
	$password = $_POST['password2'];			// Store new password
	$hash = password_hash($password,PASSWORD_DEFAULT);

	$stmt = $dbh->prepare("UPDATE users SET registered = '1',password = '$hash' WHERE StudentID = '$studentid'");
	
	$stmt->execute();


?>

<html>

<head>
	
<title>
	Password Changed Successfully
</title>

</head>

<body>

<p> Thanks for your time. You have successfully registered.</p>
<p> Please save this password, as it will be required during the time of Vote.</p>
<br>
<br>
<br>

<p><i> Please Wait while you are being redirected the photo uploading page </i></p>

<?php

header("refresh:4;url=image_upload.php");

?>



</body>

</html>