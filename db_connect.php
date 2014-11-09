<?php

/*** connect to database ***/


    $mysql_hostname = 'localhost';	 /*** mysql hostname ***/

    
    $mysql_username = 'naeem';		/*** mysql username ***/

    
    $mysql_password = 'admin';		/*** mysql password ***/

    
    $mysql_dbname = 'electionapp';	/*** database name ***/


	try
	{
		$dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);	/*** Connect database ***/

		/*** set the error mode to excptions ***/
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	}

	catch(Exception $e)
	{
		echo 'Error Connecting Database';
		echo $e;
	}
   

 ?>