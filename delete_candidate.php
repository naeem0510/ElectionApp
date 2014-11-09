<?php
session_start();

$name = $_REQUEST['id'];



include 'db_connect.php';
include 'navbar_admin.php';

    try
    {
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        /*** $message = a message saying we have connected ***/

        /*** set the error mode to excptions ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  /*** prepare the select statement ***/
        $stmt = $dbh->prepare("DELETE FROM candidates WHERE CandidateID = '$name'");
        $stmt->execute();
       
       }
	catch(Exception $e)
	{
		$message = 'error!!!';
	}

	

	echo "Candidate Rejected from Appearing in the current Election";
//
?>



