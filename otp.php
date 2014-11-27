<?php

session_start();

if(isset($_SESSION['userid']))
{

    $sid = $_SESSION['userid'];
	$cid = $_REQUEST['id'];
    $_SESSION['cid'] = $cid;

    try
    {
        include 'db_connect.php';

        $stmt = $dbh->prepare("SELECT otpsent FROM users WHERE StudentID = '$sid'");
        $stmt->execute();
        $sent = $stmt->fetchColumn();

        if(!$sent)
        {
            header('Location:userhome.php');
        }

    }

    catch(Exception $e)
    {
        echo 'Not Allowed';
    }
}

else
{
    header('Location:login.php');
}

?>

<html>
<head>

<link rel="stylesheet" type="text/css" href="Assets/CSS/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="Assets/CSS/authenticate.css">

<style type="text/css">
	body {

			background-image: url("Assets/images/blur1.jpg");
			background-size: cover;     
	   		background-attachment: fixed;
		}


</style>

</head>
<body>


<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4" style="margin-top:100px;">
             <div class="account-wall">
                <img class="profile-img" src="Assets/profile/<?php echo $sid;?>.jpg" alt="">
                <form class="form-signin" method="post" action="vote_finished.php">
                <input type="password" class="form-control" name="password" placeholder="Login Password" required autofocus>
                <input type="password" class="form-control" name="otp" placeholder="One Time Password" required>
                <button class="btn btn-lg btn-danger btn-block" type="submit">
                  Vote!</button>
                
                </form>
            </div>
        </div>
    </div>
</div>

</body>

</html>