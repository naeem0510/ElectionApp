<?php
session_start();
$eid = $_REQUEST['id'];
$sid = $_SESSION['userid'];
$_SESSION['eid'] = $eid;


include 'db_connect.php';

$stmt = $dbh->prepare("SELECT Approve FROM candidates WHERE CandidateID = '$sid'");
$stmt->execute();
$approve = $stmt->fetchColumn();

if($approve)
{
  $stmt1 = $dbh->prepare("SELECT c.CandidateID,c.ElectionID,u.FirstName,u.LastName FROM candidates c join users u on (c.CandidateID = u.StudentID) WHERE ElectionID = '$eid'" );
  $stmt1->execute();
  $result = $stmt1->fetchAll();
}

$stmt2 = $dbh->prepare("SELECT voted FROM users WHERE StudentID = '$sid'");
$stmt2->execute();
$voted = $stmt2->fetchAll();


$stmt3 = $dbh->prepare("SELECT image FROM images WHERE id = '1'");
$stmt3->execute();
$img = $stmt3->fetchAll();

?>

<html>
<head>
    
<link rel="stylesheet" type="text/css" href="Assets/CSS/bootstrap.min.css">
<script src="Assets/js/jquery.js"></script>
<script src="Assets/js/bootstrap.min.js"></script>

<style> 

table, td, th 
    {
         text-align: center;
    }
</style>

</head>
<body>
    
<?php

include 'navbar_home.php';

?>

<div class="container">
            <div class="row">
             <h3>Voting List for <?php echo $eid;?></h3>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                    <th>Profile Photo</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Candidate ID</th>                      
                    <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php
           
                    if($approve)
                    {
                     foreach ($result as $row)            //'<img src="Assets/profile/2.jpg" class="img-circle">'
                      {
                              echo '<tr>';
                              echo '<td>'.'<img src="Assets/profile/2.jpg" class="img-circle" style = "width:60px;height:60px;">'.'</td>';
                              echo '<td>'. $row['FirstName'] . '</td>';
                              echo '<td>'. $row['LastName'] . '</td>';
                              echo '<td>'. $row['CandidateID'] . '</td>';                         
                              
                              echo '<td width=250>';
                              echo '<a class="btn btn-info" href="profile.php?">View Profile</a>';
                              echo ' ';
                           
                              echo '<a class="btn btn-primary" href="vote_finished.php?id='.$row['CandidateID'].'">Vote</a>';       
                 
                       }
                   }

?>

                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
</body>
</html>

