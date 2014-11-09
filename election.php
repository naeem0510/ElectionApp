<?php
session_start();
$sid = $_SESSION['userid'];

?>

<?php
    
    try
    {
        
      include 'db_connect.php';  
      include 'navbar_users.php';

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

          $date=date_create("2014-11-06");
          date_add($date,date_interval_create_from_date_string("15 days"));
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
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Election ID</th>
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
                            echo '<td>'. date_format($date,"d-m-Y") . '</td>';
                        
                        echo '<td>';  

                          // WHAT IS THE USE OF USING INDIVIDUAL ELECTION ID FOR EVERY LINK???????


                      if($row['ElectionID'] == 'UCD1')
                      {
                        if($vote1) 
                        {                          
                  //       echo '<a class="btn btn-default" href="#" btn-lg disabled" role="button" onClick = "myFunction()">Vote Now!</a>';
                        }

                        else
                        {
                          echo '<a class="btn btn-success" href="voting_page.php?id='.$row['ElectionID'].'">Vote Now !</a>';
                        }
                      }

                      if($row['ElectionID'] == 'UCD2')
                      {
                        if($vote2) 
                        {                          
                   //      echo '<a class="btn btn-default" href="#" btn-lg disabled" role="button" onClick = "myFunction()">Vote Now!</a>';
                        }
                        else
                        {
                          echo '<a class="btn btn-success" href="voting_page.php?id='.$row['ElectionID'].'">Vote Now !</a>';
                        }
                      }

                    if($row['ElectionID'] == 'UCD3')
                    {
                      if($vote3) 
                      {                          
                 //      echo '<a class="btn btn-default" href="#" btn-lg disabled" role="button" onClick = "myFunction()">Vote Now!</a>';
                      }

                      else
                        {
                          echo '<a class="btn btn-success" href="voting_page.php?id='.$row['ElectionID'].'">Vote Now !</a>';
                        }
                    }

                      if($row['ElectionID'] == 'UCD4')
                      {
                      if($vote4) 
                      {                          
                 //      echo '<a class="btn btn-default" href="#" btn-lg disabled" role="button" onClick = "myFunction()">Vote Now!</a>';
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
<marquee behavior="alternate"> Elections will go offline at 5 PM. Please Vote as soon as possible </marquee>
<script>
function myFunction() {
    alert("Oops ! You have already voted for this Election");
}
</script>
</body>
</html>