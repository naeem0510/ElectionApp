<?php
session_start();

if(isset($_SESSION['userid']))
{
  $user = $_SESSION['userid'];
  $admin = $_SESSION['admin'];

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
          $stmt->execute();
          $result = $stmt->fetchAll();          

          $stmt1 = $dbh->prepare("SELECT Nominate FROM candidates WHERE CandidateID = '$user'");
          $stmt1->execute();   
          $nominated = $stmt1->fetchColumn();

          $date=date_create("2014-11-10");
          date_add($date,date_interval_create_from_date_string("9 days"));
    	}

  	catch(Exception $e)
  	{
  		$message = 'Error! Something Wrong happened';
      echo $message;
      header('refresh:2;url=userhome.php');
  	}
}
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
                        echo 'Already Nominated';
                      }

          }
?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->


<marquee behavior="alternate"><mark> Nominations will close on 15th of November at 11:59 PM </mark></marquee>
</body>
</html>