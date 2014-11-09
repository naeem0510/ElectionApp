
<?php
session_start();

/* USER IS ALREADY REGISTERED AND HAS ALREADY CHANGED HIS PASSWORD */

if(isset($_SESSION['userid']))
{
    $message = 'User is already logged in';
   
}


/*** check that both the username, password have been submitted ***/
if(!isset( $_POST['studentid'], $_POST['password2']))
{
    $message = 'Please enter a valid studentid and password';
}

 /*** check the username is the correct length ***/
 elseif (strlen( $_POST['studentid']) > 20 || strlen($_POST['studentid']) < 4)
 {
     $message = 'Incorrect Length for studentid';

 }
/*** check the password is the correct length ***/
 elseif (strlen( $_POST['password2']) > 8 || strlen($_POST['password2']) < 4)         // Password should be of characters
{
    $message = 'Incorrect Length for Password';
 }
 //** check the username has only alpha numeric characters **
 elseif (ctype_alnum($_POST['studentid']) != true)
{
     /*** if there is no match ***/
     $message = "studentid must be alpha numeric";
}

 
else
{
    /*** if we are here the data is valid and we can insert it into database ***/
    $studentid = filter_var($_POST['studentid'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password2'], FILTER_SANITIZE_STRING);

    include 'db_connect.php';
    $query = $dbh->prepare("SELECT password FROM users WHERE StudentID = '$studentid'");
    $query->execute();
    $hash = $query->fetchColumn();
  
    if($hash == password_hash($password,PASSWORD_DEFAULT))

    /* Check Whether Passwords are same or not  */
{
          try
            {       
                $stmt = $dbh->prepare("SELECT StudentID,FirstName,LastName,admin,registered,voted FROM users 
                           				 WHERE StudentID = :studentid");

                /*** bind the parameters ***/
                $stmt->bindparam(':studentid',$studentid, PDO::PARAM_STR);
            //    $stmt->bindparam(':password2', $password, PDO::PARAM_STR, 40);

                 $stmt->bindColumn(2,$fname);
                 $stmt->bindColumn(3,$lname);
                 $stmt->bindColumn(4,$admin);
                 $stmt->bindColumn(5,$registered);
                 $stmt->bindColumn(6,$voted);

                /*** execute the prepared statement ***/
             	 $stmt->execute();

             	 $studentid = $stmt->fetchColumn();

             	 $_SESSION['admin'] = $admin;
             	 $_SESSION['voted'] = $voted;
             	 $_SESSION['userid'] = $studentid;
                 
        	    /*** now we can encrypt the password ***/

        	   // $password = sha1( $password );
              
                /*** if we have no result then fail both ***/

               if($studentid == false)
                {
                        $message = 'Sorry ! You are not a valid User';
                       	header('Location:form.php');

                }
                /*** if we do have a result, all is well ***/
                else
                {
                    if(!$admin)                      // If User
                         {
                            /*** set the session user_id variable ***/
                            include 'navbar_users.php';
            
                            if(!$registered)
                            {
                                header('Location:form.php');
                            }

                           else
                           {
                                $_SESSION['userid'] = $studentid;
                                $_SESSION['userfn'] = $fname;
                                $_SESSION['userln'] = $lname;  

                                /*** tell the user we are logged in ***/
                                $message = 'You are now logged in';
                                header('Location: userhome.php');
                                echo "Hi ! " . $fname . " ". $lname;
                            }
                        }

                        else                        // If Admin
                        {

                            $_SESSION['userid'] = $studentid;
                            $_SESSION['userfn'] = $fname;
                            $_SESSION['userln'] = $lname;   

        				    header('Location: admin.php');
                            echo "Hi ! " . $fname . " ". $lname;
                        }
                }

            }
            catch(Exception $e)
            {
                /*** if we are here, something has gone wrong with the database ***/

                $message = 'We are unable to process your request. Please try again later"';
                echo $e;
            }
        }

        
    
}
?>