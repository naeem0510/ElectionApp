<?php
                                                    // FINAL VOTING PAGE
session_start();

if(isset($_SESSION['userid']))
{
	$userid = $_SESSION['userid'];
	$cid = $_SESSION['cid'];
	$eid = $_SESSION['eid'];
}


if(!isset($_POST['password'],$_POST['otp']))
{
    $message = 'Please enter a valid studentid, password or email';
//    header('Location:voting_page.php');
}

 /*** check the username is the correct length ***/
 elseif (strlen( $_POST['otp']) > 8 || strlen($_POST['otp']) < 8)
 {
     $message = 'Incorrect Length for studentid';
//     header('Location:voting_page.php');
 }
/*** check the password is the correct length ***/
 elseif (strlen( $_POST['password']) > 10 || strlen($_POST['password']) < 6)
{
    $message = 'Incorrect Length for Password';
 //   header('Location:voting_page.php');
   
 }

 else
 {
     /*** if we are here the data is valid and we can insert it into database ***/
 
    $otp = filter_var($_POST['otp'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    include 'db_connect.php';

    $query = $dbh->prepare("SELECT password,OTP FROM users WHERE StudentID = '$userid'");
    $query->execute();
    $result = $query->fetchAll();

    foreach ($result as $value) 
    {
    	$otp1 = $value['OTP'];
    	$password1 = $value['password'];
    }

    if(($otp == $otp1) && (sha1($password) == $password1))			// If both password matches
    {

        $vote_count = 0;		// Initialise Vote counter

        if($_SESSION['eid'] == 'UCD1')
        {

            $stmt = $dbh->prepare("SELECT votes FROM result WHERE CandidateID = '$cid'");
            $stmt->execute();
            $vote_count = $stmt->fetchColumn();
            $vote_count = $vote_count + 1; 
             
            $sql1 = $dbh->prepare("SELECT voted1 FROM users WHERE StudentID = '$userid'");
            $sql1->execute();
            $voted = $sql1->fetchColumn();

           if(!$voted)
           {
        	   $query1 = $dbh->prepare("UPDATE result SET votes = '$vote_count' WHERE CandidateID = '$cid'");
        	   $query1->execute();
               echo 'Thanks for Voting.';

                $sql = $dbh->prepare("UPDATE users SET voted1 = '1' WHERE StudentID = '$userid'");
                $sql->execute();  

                $sql2 = $dbh->prepare("UPDATE users SET otpsent = '0' WHERE StudentID = '$userid'");
                $sql2->execute();

                $sql3 = $dbh->prepare("UPDATE users SET OTP = '0' WHERE StudentID = '$userid'");
                $sql3->execute();
            }

            else
            {
                 echo 'Sorry! You have already voted.';
            }
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

    }

        else
        {
        	  echo 'Sorry! You have already voted.';
        	   header('refresh:2;url=userhome.php');
        }
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Vote Casted</title>

    <link rel="stylesheet" type="text/css" href="Assets/CSS/bootstrap.min.css">

</head>
<body>


<?php 

//header('refresh:3;url=election.php');

?>

</body>
</html>
