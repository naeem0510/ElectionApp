
<?php
session_start();

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
 elseif (strlen( $_POST['password2']) > 8 || strlen($_POST['password2']) < 4)
{
    $message = 'Incorrect Length for Password';
 }
 //** check the username has only alpha numeric characters **
 elseif (ctype_alnum($_POST['studentid']) != true)
{
     /*** if there is no match ***/
     $message = "studentid must be alpha numeric";
 }


 /*** check the password has only alpha numeric characters ***/
//  elseif (ctype_alnum($_POST['phpro_password']) != true)
//  {
// //         /*** if there is no match ***/
//          $message = "Password must be alpha numeric";
//  }
else
{
    /*** if we are here the data is valid and we can insert it into database ***/
    $studentid = filter_var($_POST['studentid'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password2'], FILTER_SANITIZE_STRING);

  try
    {
    	include 'db_connect.php';
       
        $stmt = $dbh->prepare("SELECT StudentID,password,FirstName,LastName,admin,registered,voted FROM users 
                   				 WHERE StudentID = :studentid AND password = :password2");

        /*** bind the parameters ***/
         $stmt->bindparam(':studentid',$studentid, PDO::PARAM_STR);
         $stmt->bindparam(':password2', $password, PDO::PARAM_STR, 40);   

         $stmt->bindColumn(3,$fname);
         $stmt->bindColumn(4,$lname);
         $stmt->bindColumn(5,$admin);     
         $stmt->bindColumn(6,$registered);
       
        /*** execute the prepared statement ***/
     	 $stmt->execute();

     	 $studentid = $stmt->fetchColumn();
     	 $_SESSION['userid'] = $studentid;
     	 $_SESSION['password'] = $password;


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
            	
            	if($registered)
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

?>


<!DOCTYPE html>
<html>
<head>
<title>Election App</title>
<style type="text/css">
	body {

			background-image: url("Assets/images/blur1.jpg");
			background-size: cover;     
	   		background-attachment: fixed;
		}


</style>

<link rel="stylesheet" type="text/css" href="Assets/CSS/login.css">	
<link rel="stylesheet" type="text/css" href="Assets/CSS/bootstrap.min.css">
</head>

<body>

<div style = "color:#2F2F2F; text-align:right; margin-right:30px;font-size:30px;">
 <?php echo "Hi ! " . $fname . " ". $lname; ?> 
 </div>
	<form class="form-signin" action = "<?php echo 'pass_success.php'; ?>" method = "post">
		
		<h2 class="form-signin-heading text-muted" align="centre">New Password</h2>

		<input type="password" class="form-control" placeholder="Password" name = "password1" id = "password1" required="true" autofocus=""><br/>
		<input type="password" class="form-control" placeholder="Confirm Password" name = "password2" id = "password2" required="true"><br/>
		<button class="btn btn-primary" type="submit">Change Password
		</button>
	</form>

	<script type="text/javascript">

				window.onload = function () 
				{
					document.getElementById("password1").onchange = validatePassword;
					document.getElementById("password2").onchange = validatePassword;
				}
					function validatePassword()
					{
						var pass2=document.getElementById("password2").value;
						var pass1=document.getElementById("password1").value;

						if(pass1!=pass2)
						document.getElementById("password2").setCustomValidity("Passwords Don't Match");
						else
						document.getElementById("password2").setCustomValidity(''); 
					//empty string means no validation error
					}
</script>


	</body>
</html>