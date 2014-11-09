<?php
session_start();    // ADMIN SIDE
?>
    

<!DOCTYPE html>
<html>
<head>
<title>Election App</title>
<style> 

table,td {
    text-align: center;
}
</style>
<link rel="stylesheet" type="text/css" href="Assets/CSS/bootstrap.min.css"></link>
</head>
<body>

		
<?php
 /*** connect to database ***/
   

    try
    {
       include 'db_connect.php';
       include 'navbar_admin.php';

         /*** prepare the select statement ***/
        $stmt = $dbh->prepare("SELECT c.CandidateID,c.ElectionID,u.FirstName,u.LastName FROM candidates c join users u on (c.CandidateID = u.StudentID)");
        
        /*** execute the prepared statement ***/
        $stmt->execute();
    
        /*** check for a result ***/
        $result = $stmt->fetchAll();

        $temp = 2014;
     }
      
    catch(Exception $e)
      {
        /*** if we are here, something has gone wrong with the database ***/

        $message = 'We are unable to process your request. Please try again later"';
     }

        
	?>
<div class="container">
            <div class="row">
                <h3>Nomination List</h3>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                   <th>Election ID</th>  
                    <th>Candidate ID</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Year</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php
           
                   foreach ($result as $row)
                    {
                            echo '<tr>';
                            echo '<td>'. $row['ElectionID'] . '</td>';
                            echo '<td>'. $row['CandidateID'] . '</td>';
                            echo '<td>'. $row['FirstName'] . '</td>';
                            echo '<td>'. $row['LastName'] . '</td>';
                            echo '<td>'. $temp . '</td>';

                            echo '<td width=250>';
                            echo '<a class="btn btn-success" href="approve_candidate.php?id='.$row['CandidateID'].'">Approve</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="delete_candidate.php?id='.$row['CandidateID'].'">Reject</a>';

                     }

?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
</body>
</html>