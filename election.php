<?php
session_start();
$sid = $_SESSION['userid'];
$admin = $_SESSION['admin'];
$date1 = date("Y-m-d");

?>

<?php
    
    try
    {
        
      include 'db_connect.php'; 

      if(!$admin)
      {
       include 'navbar_users.php';
      }

      else
      {
        include 'navbar_admin.php';
      }

      $stmt4 = $dbh->prepare("SELECT voted1,voted2,voted3,voted4 FROM users WHERE StudentID = '$sid'");
      $stmt4->execute();
      $vote = $stmt4->fetchAll();

      foreach ($vote as $value)
       {
          $vote1 = $value['voted1'];
          $vote2 = $value['voted2'];
          $vote3 = $value['voted3'];
          $vote4 = $value['voted4'];
        }

  /*** prepare the select statement ***/
       
          $stmt = $dbh->prepare("SELECT * FROM elections");           
          $stmt->execute();
          $result = $stmt->fetchAll();
    	}

	catch(Exception $e)
	{
		$message = 'error!!!';
	}
//
		?>

<!DOCTYPE html>
<html>
<head>
<title>Election App</title>

<link rel="stylesheet" type="text/css" href="Assets/CSS/bootstrap.min.css">
<script src="Assets/js/jquery.js"></script>
<script src="Assets/js/bootstrap.min.js"></script>


    <style> 

      table,td,th
        {
          text-align:center;
        }

    </style>

</head>
<body>

<div class="container">
            <div class="row">   
             <h3> Please Choose Election to Vote </h3> 
            </div>
            <div class="row">

             <p>
                  <?php if($admin) {echo '<a href="election_create.php" class="btn btn-info">Create</a>';}?>
                </p>

                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Election Name</th>
                      <th>Election Type</th>
                      <th>Date</th>
                      <th>Vote Now</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  
                   foreach ($result as $row)
                    {
                            echo '<tr>';
                            echo '<td>'. $row['ElectionID'] . '</td>';                         
                            echo '<td>'. $row['Type'] . '</td>';
                            echo '<td>'. $row['Date'] . '</td>';
                        
                        echo '<td>';  

                          // WHAT IS THE USE OF USING INDIVIDUAL ELECTION ID FOR EVERY LINK???????


                      if($row['ElectionID'] == 'UCD1')
                      {
                        if($vote1 || $admin) 
                        {     
                          echo 'Thanks for your Valuable Vote';                     
                  //       echo '<a class="btn btn-default" href="#" btn-lg disabled" role="button" onClick = "myFunction()">Vote Now!</a>';
                        }

                          elseif ($row['Date'] < $date1)
                        {
                          echo 'Election Over';
                        }

                         elseif ($row['Date'] > $date1)
                        {
                          echo 'Election Not Yet Active';
                        }
                       
                        else
                        {
                          echo '<a class="btn btn-success" href="voting_page.php?id='.$row['ElectionID'].'">Vote Now !</a>';
                        }
                      }

                      if($row['ElectionID'] == 'UCD2')
                      {
                        if($vote2 || $admin) 
                        {  
                           echo 'Thanks for your Valuable Vote';                        
                   //      echo '<a class="btn btn-default" href="#" btn-lg disabled" role="button" onClick = "myFunction()">Vote Now!</a>';
                        }
                         elseif ($row['Date'] < $date1)
                        {
                          echo 'Election Over';
                        }

                         elseif ($row['Date'] > $date1)
                        {
                          echo 'Election Not Yet Active';
                        }
                       
                        else
                        {
                          echo '<a class="btn btn-success" href="voting_page.php?id='.$row['ElectionID'].'">Vote Now !</a>';
                        }
                      }

                    if($row['ElectionID'] == 'UCD3')
                    {
                      if($vote3 || $admin) 
                      {             
                         echo 'Thanks for your Valuable Vote';             
                 //      echo '<a class="btn btn-default" href="#" btn-lg disabled" role="button" onClick = "myFunction()">Vote Now!</a>';
                      }

                         elseif ($row['Date'] < $date1)
                        {
                          echo 'Election Over';
                        }

                         elseif ($row['Date'] > $date1)
                        {
                          echo 'Election Not Yet Active';
                        }
                       
                      else
                        {
                          echo '<a class="btn btn-success" href="voting_page.php?id='.$row['ElectionID'].'">Vote Now !</a>';
                        }
                    }

                      if($row['ElectionID'] == 'UCD4')
                      {
                      if($vote4 || $admin) 
                      {  
                         echo 'Thanks for your Valuable Vote';                        
                 //      echo '<a class="btn btn-default" href="#" btn-lg disabled" role="button" onClick = "myFunction()">Vote Now!</a>';
                      }

                       elseif ($row['Date'] < $date1)
                        {
                          echo 'Election Over';
                        }

                         elseif ($row['Date'] > $date1)
                        {
                          echo 'Election Not Yet Active';
                        }
                       

                      else
                        {
                          echo '<a class="btn btn-success" href="voting_page.php?id='.$row['ElectionID'].'">Vote Now !</a>';
                        }
                    }

                      echo '</td>';

// echo '<a class="btn btn-success" href="voting_page.php?id='.$row['ElectionID'].'">Vote Now !</a>';
          }
?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->

<marquee behavior="alternate"><mark> Elections will go offline at 11:59 PM on resptected dates. Make Sure You Vote before Time </mark></marquee>
<script>
function myFunction() {
    alert("Oops ! You have already voted for this Election");
}
</script>
</body>
</html>