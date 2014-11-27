<?php
session_start();

if(isset($_SESSIOM['userid']))
{

$name = $_REQUEST['id'];


    try
    {
        include 'db_connect.php';
       
  /*** prepare the update statement ***/

        $stmt = $dbh->prepare("UPDATE candidates SET Approve='1' WHERE CandidateID = '$name'");
        $stmt->execute();

        $stmt1 = $dbh->prepare("INSERT INTO result (ElectionID,CandidateID) SELECT ElectionID,CandidateID FROM candidates WHERE CandidateID = '$name'");
        $stmt1->execute();
    }   
	catch(Exception $e)
	{
		$message = 'error!!!';
	}
}

else
{
    header('Location:admin.php');
}
//
?>
<html>
<body>
	<p> Student (<?php echo $name."" ?>) Approved for Standing in Election </p>

</body>
</html>



