<?php
session_start();

if(isset($_SESSION['userid']))
{
    $eid = $_REQUEST['id'];
    $sid = $_SESSION['userid'];
    $_SESSION['eid'] = $eid;

    include 'db_connect.php';

    try
    {
      $stmt3 = $dbh->prepare("SELECT otpsent from users WHERE StudentID = '$sid'");
      $stmt3->execute();
      $sent = $stmt3->fetchColumn();

      $stmt5 = $dbh->prepare("SELECT voted1,voted2,voted3,voted4 from users WHERE StudentID = '$sid'");
      $stmt5->execute();
      $request = $stmt3->fetchAll();

      if(sizeof($request != 0))
      {
        foreach ($request as $value) 
        {
       
          $voted1 = $value['voted1'];
          $voted2 = $value['voted2'];
          $voted3 = $value['voted3'];
          $voted4 = $value['voted4'];
        }
      }

      if(!$sent)
      {
          // Function to Generate a Random Password
          function generate_password( $length = 8 ) 
          {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@$&";
            $password = substr( str_shuffle( $chars ), 0, $length );
            return $password;
          }

          $otp = generate_password();
      //    $otp_hash = password_hash($otp,PASSWORD_DEFAULT);

          $query = $dbh->prepare("UPDATE users SET OTP = '$otp' WHERE StudentID = '$sid'");
          $query->execute();

          $query1 = $dbh->prepare("SELECT email from users WHERE StudentID = '$sid'");
          $query1->execute();
          $email = $query1->fetchColumn();

          //Sending mail
          $from = 'armaankhan0510@gmail.com';
          $to = $email;
          $subject = 'One Time Password for Voting';

          $message = 'Your One Time Password : '.$otp;
          $headers = 'From: '.$from. "\r\n" .
          'Reply-To: '.$from. "\r\n";

          if(mail($to, $subject, $message, $headers))
          {
        
            $stmt4 = $dbh->prepare("UPDATE users SET otpsent = '1' WHERE StudentID = '$sid'");
            $stmt4->execute();
            echo 'Success';
          }

          else
          {
            echo 'Failed';
          }
      }

      
      $stmt1 = $dbh->prepare("SELECT c.CandidateID,c.ElectionID,u.FirstName,u.LastName FROM candidates c join users u on (c.CandidateID = u.StudentID) WHERE ElectionID = '$eid' AND Approve = '1'" );
      $stmt1->execute();
      $result1 = $stmt1->fetchAll();
    }

    catch(Exception $e)
        {
          echo $e;
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
      
                    if(sizeof($result1 != 0))  
                    {
                        foreach ($result1 as $row)            //'<img src="Assets/profile/2.jpg" class="img-circle">'
                          {
                              echo '<tr>';
                              echo '<td>'.'<img src="Assets/profile/'.$row['CandidateID'].'.jpg" class="img-circle" style = "width:60px;height:60px;">'.'</td>';
                              echo '<td>'. $row['FirstName'] . '</td>';
                              echo '<td>'. $row['LastName'] . '</td>';
                              echo '<td>'. $row['CandidateID'] . '</td>';                       
                              
                              echo '<td width=250>';
                              echo '<a class="btn btn-info" href="profile.php?">View Profile</a>';
                              echo ' ';    
                           
                              echo '<a class="btn btn-primary" href="otp.php?id='.$row['CandidateID'].'">Vote</a>';     
                           }
                      }

                    else
                     {          
                        echo '<p> Sorry No Candiate Appeared for this Election </p>';
                      }          
                  
?>

                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
</body>
</html>

