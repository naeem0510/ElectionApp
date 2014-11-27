<?php

session_start();
$eid = $_REQUEST['id'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>Results</title>

<link rel="stylesheet" type="text/css" href="Assets/CSS/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="Assets/CSS/bootstrap-responsive.css">
 <script src="Assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="Assets/js/bootstrap.min.js"></script>

</head>
<body>

 <!-- Run Queries to Select Election and fetch Results -->  

<?php 
include 'navbar_home.php';

include 'db_connect.php';

    $stmt = $dbh->prepare("SELECT * FROM result WHERE ElectionID = '$eid'");
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach ($result as $value) 
    {
        $ElectionID = $value['ElectionID'];
        $CandidateID = $value['CandidateID'];
        $vote = $vote['votes'];
    }

    // FETCH COMPLETE USER DETAILS //

    $stmt1 = $dbh->prepare("SELECT r.CandidateID,r.ElectionID,u.FirstName,u.LastName FROM result r join users u on (r.CandidateID = u.StudentID)");
    $stmt1->execute();
    $result1 = $stmt1->fetchAll();

    foreach ($result1 as $value) 
    {
        $CandidateID = $value['CandidateID'];
        $ElectionID = $value['ElectionID'];
        $fname = $value['FirstName'];
        $lname = $value['LastName'];

    }

?>         

    <div class="container">

        <div class="row" style = "margin-top:50px;">

            <div class="col-sm-4">

                <a class="thumbnail">

                    <img src="Assets/images/blur.jpg" alt="125x125">
                    <div class="caption">
                    <h3>Thumbnail label</h3>
        <p>...</p>
                    </div>
        
                </a>

            </div>

            <div class="col-sm-4">

                <a class="thumbnail">

                    <img src="Assets/images/blur3.jpg" alt="125x125">
                    <div class="caption">
                    <h3>Thumbnail label</h3>
        <p>...</p>
                    </div>
      

                </a>

            </div>

            <div class="col-sm-4">

                <a class="thumbnail">

                    <img src="Assets/images/blur3.jpg" alt="125x125">
                    <div class="caption">
                    <h3>Thumbnail label</h3>
        <p>...</p>
                    </div>
       

                </a>

            </div>

            </div>

        </div>

    </div>





</body>
</html>