<?php
session_start();

$name = $_REQUEST['id'];

$mysql_hostname = 'localhost';

    /*** mysql username ***/
    $mysql_username = 'naeem';

    /*** mysql password ***/
    $mysql_password = 'admin';

    /*** database name ***/
    $mysql_dbname = 'electionapp';

    try
    {
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        /*** $message = a message saying we have connected ***/

        /*** set the error mode to excptions ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
  /*** prepare the update statement ***/
        $stmt = $dbh->prepare("UPDATE candidates SET Approve='1' WHERE CandidateID = '$name'");
        $stmt->execute();
    }   
	catch(Exception $e)
	{
		$message = 'error!!!';
	}
//
?>
<html>
<body>
	<p> Student (<?php echo $name."" ?>) Approved for Standing in Election </p>

</body>
</html>



