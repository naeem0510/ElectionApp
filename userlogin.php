
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
 elseif (strlen( $_POST['studentid']) > 20 || strlen($_POST['studentid']) < 5)
 {
     $message = 'Incorrect Length for studentid';

 }
/*** check the password is the correct length ***/
 elseif (strlen( $_POST['password2']) > 8 || strlen($_POST['password2']) < 6)         // Password should be of characters
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

    $query = $dbh->prepare("SELECT StudentID,password,admin,FirstName,LastName,registered FROM users WHERE StudentID = :studentid");

    $query->bindparam(':studentid',$studentid, PDO::PARAM_STR);
    $query->bindColumn(2,$hash); 
    $query->bindColumn(3,$admin); 
    $query->bindColumn(4,$fname);
     $query->bindColumn(5,$lname);
     $query->bindColumn(6,$registered);
    
    $query->execute(); 
    $studentid = $query->fetchColumn(); 

   $_SESSION['admin'] = $admin;
  $_SESSION['userid'] = $studentid;
 
    if((sha1($password) == $hash) || $admin)

    /* Check Whether Passwords are same or not  */
        {
          try
            {       

               if($studentid == false)
                {
                        $message = 'Sorry ! You are not a valid User';
                       	header('Location:login.php');

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
                                header('Location:login.php');
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

//        else {
     //           header('Location: login.php');
      //       }        
}
?>