
<?php

$target_Folder = "Assets/profile/";

$target_Path = $target_Folder.basename( $_FILES['uploadimage']['name'] );

$savepath = $target_Path.basename( $_FILES['uploadimage']['name'] );

    $file_name = $_FILES['uploadimage']['name'];

    if(file_exists('Assets/profile/'.$file_name))
    {
        echo "That File Already Exist";
    }

    else
    {

     include 'db_connect.php';

        $sql = $dbh->prepare("INSERT INTO images (id,image,name) VALUES ('','$target_Folder$file_name','$file_name')");

        $sql->execute();
       
        echo "1 record added successfully in the database";
        echo '<br />';
       
        // Move the file into UPLOAD folder

        move_uploaded_file( $_FILES['uploadimage']['tmp_name'], $target_Path );

        echo "File Uploaded Successfully <br />";

        header('Location:userhome.php');
    }

?>