<?php
session_start();

$name = $_SESSION['userid'];    // THIS PAGE WILL NOMINATE USER
$id =$_REQUEST['id'];

    try

    {
       include 'db_connect.php';
        include 'navbar_home.php';

  /*** prepare the select statement ***/
        $stmt = $dbh->prepare("INSERT INTO candidates VALUES('$name','$id','1','0')");      // SET NOMINATE FIELD HIGH
		    $stmt->execute();

      }

  	catch(Exception $e)
  	{
  		$message = 'error!!!';
  	}

?>

<!DOCTYPE html>
<html>
<head>
	<title> Successful Nomination </title>
  <link rel="stylesheet" type="text/css" href="Assets/CSS/bootstrap.min.css">
</head>
<body>

<p> Congratulation! <?php echo $_SESSION['userfn']." ".$_SESSION['userln'];?><p> 
<p>You have successfully Nominated yourself for the election <?php echo "$id"." "?></p>
<p> We will contact you soon.</p>


</body>
</html>