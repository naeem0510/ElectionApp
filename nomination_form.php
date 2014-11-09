<?php
session_start();
//$admin = $_SESSION['admin'];
$user = $_SESSION['userid'];
$admin = $_SESSION['admin'];
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


  /*** prepare the select statement ***/
       
          $stmt = $dbh->prepare("SELECT * FROM elections");
          $stmt1 = $dbh->prepare("SELECT Nominate FROM candidates WHERE CandidateID = '$user'");
             
      
          $stmt->execute();
          $stmt1->execute();
          $result = $stmt->fetchAll();
          $nominated = $stmt1->fetchAll();

          $date=date_create("2014-11-06");
          date_add($date,date_interval_create_from_date_string("9 days"));
    	}

	catch(Exception $e)
	{
		$message = 'error!!!';
	}

//  echo date("d-m-Y");
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
          text-align: center;
        }

</style>


</head>
<body>

<div style = "float:right">
<?php  echo date("d-m-Y"). "<br>";
        echo date("h:i:sa")."<br>";
        echo date("l")."<br>";
 ?>
</div>

<div class="container">
            <div class="row">
            <h3> Election List </h3>    
            </div>
            <div class="row">
                <table class="table table-striped table-bordered">        
                  <thead>
                    <tr>
                      <th>Election ID</th>
                      <th>Election Type</th>
                      <th>Date</th>
                      <th>Nominate</th>
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

                      if(!$nominated)
                      {
                        echo '<a class="btn btn-success" href="nomination_update.php?id='.$row['ElectionID'].'">Nominate</a>';
                      }
                      else
                      {
                        echo '<a class="btn btn-default" href="#" btn-lg disabled" role="button" onClick = "myFunction()">Nominate</a>';
                      }

          }
?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->

<script>
function myFunction() {
    alert("Oops ! You have already nominated yourself for one of the Elections");
}
</script>

<marquee behavior="alternate"> Nominations will close on 15th of November at 5 PM  </marquee>
</body>
</html>