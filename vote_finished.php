<?php
                                                    // FINAL VOTING PAGE
session_start();
$userid = $_SESSION['userid'];
$cid = $_REQUEST['id'];
$eid = $_SESSION['eid'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Vote Casted</title>

    <link rel="stylesheet" type="text/css" href="Assets/CSS/bootstrap.min.css">

</head>
<body>

<?php

    include 'db_connect.php';

    $vote_count = 0;			// Initialise Vote counter
    if($_SESSION['eid'] == 'UCD1')
    {
	    $sql = $dbh->prepare("UPDATE users SET voted1 = '1' WHERE StudentID = '$userid'");
	    $sql->execute();

	//    $query1 = $dbh->prepare("UPDATE result SET votes = '$vote_count++', WHERE CandidateID = '$cid'");
	//    $query1->execute();
	}

	 if($_SESSION['eid'] == 'UCD2')
    {
	    $sql = $dbh->prepare("UPDATE users SET voted2 = '1' WHERE StudentID = '$userid'");
	    $sql->execute();
	}

	 if($_SESSION['eid'] == 'UCD3')
    {
	    $sql = $dbh->prepare("UPDATE users SET voted3 = '1' WHERE StudentID = '$userid'");
	    $sql->execute();
	}

	 if($_SESSION['eid'] == 'UCD4')
    {
	    $sql = $dbh->prepare("UPDATE users SET voted4 = '1' WHERE StudentID = '$userid'");
	    $sql->execute();
	}
?>

<p> Thanks for Voting.<p>
<p> Your vote has been casted to the following Candidate. <p>

<p><i> Results will be available by 10 PM. Kindly stay updated. </i></p>

<?php 

header('refresh:4;url=election.php');

?>

</body>
</html>
