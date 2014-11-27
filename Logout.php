<?php #admin/restricted.php

session_start(); 
           
   ####  CODE FOR LOG OUT #### 
if(isset($_SESSION['userid']))
{
        //if the user logged out, delete any SESSION variables
 	 session_unset();
	session_destroy();
	
        //then redirect to login page
	header('Location:login.php');

}//end log out

?> 