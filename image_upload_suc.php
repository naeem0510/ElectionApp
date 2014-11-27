
<?php
session_start();

$sid = $_SESSION['userid'];

$target_Folder = "Assets/profile/";

$target_Path = $target_Folder.basename( $_FILES['uploadimage']['name'] );

$savepath = $target_Path.basename( $_FILES['uploadimage']['name'] );

$file_name = $_FILES['uploadimage']['name'];

   if(file_exists('Assets/profile/'.$file_name))
    {
        echo "That File Already Exist";
        header('Location:image_upload.php');
    }

    

     include 'db_connect.php';

     /*
    these two images are almost the same so the hammered distance will be less than 10
    try it with images like this:
        1. the example images
        2. two complatly different image
        3. the same image (returned number should be 0)
        4. the same image but with different size, even different aspect ratio (returned number should be 0)
    you will see how the returned number will represent the similarity of the images.
*/ 

$sql = $dbh->prepare("UPDATE users SET image ='$target_Folder$file_name',name = '$file_name' WHERE Studentid = '$sid'");
$sql->execute();

// $query = $dbh->prepare("SELECT image,name FROM users WHERE StudentID = '$sid'");
// $query->execute();
// $result = $query->fetchAll();

// foreach ($result as $value) {
//     $image = $value['image'];
//     $name = $value['name'];
// }

echo "Assets/profile/".$sid.".jpg";

// //include 'image_compare.php';

// class compareImages
// {
//     private function mimeType($i)
//     {
//         /*returns array with mime type and if its jpg or png. Returns false if it isn't jpg or png*/
//         $mime = getimagesize($i);
//         $return = array($mime[0],$mime[1]);
      
//         switch ($mime['mime'])
//         {
//             case 'image/jpeg':
//                 $return[] = 'jpg';
//                 return $return;
//             case 'image/png':
//                 $return[] = 'png';
//                 return $return;
//             default:
//                 return false;
//         }
//     }  
    
//     private function createImage($i)
//     {
//         /*retuns image resource or false if its not jpg or png*/
//         $mime = $this->mimeType($i);
      
//         if($mime[2] == 'jpg')
//         {
//             return imagecreatefromjpeg ($i);
//         } 
//         else if ($mime[2] == 'png') 
//         {
//             return imagecreatefrompng ($i);
//         } 
//         else 
//         {
//             return false; 
//         } 
//     }
    
//     private function resizeImage($i,$source)
//     {
//         /*resizes the image to a 8x8 squere and returns as image resource*/
//         $mime = $this->mimeType($source);
      
//         $t = imagecreatetruecolor(8, 8);
        
//         $source = $this->createImage($source);
        
//         imagecopyresized($t, $source, 0, 0, 0, 0, 8, 8, $mime[0], $mime[1]);
        
//         return $t;
//     }
    
//     private function colorMeanValue($i)
//     {
//         /*returns the mean value of the colors and the list of all pixel's colors*/
//         $colorList = array();
//         $colorSum = 0;
//         for($a = 0;$a<8;$a++)
//         {
        
//             for($b = 0;$b<8;$b++)
//             {
            
//                 $rgb = imagecolorat($i, $a, $b);
//                 $colorList[] = $rgb & 0xFF;
//                 $colorSum += $rgb & 0xFF;
                
//             }
            
//         }
        
//         return array($colorSum/64,$colorList);
//     }
    
//     private function bits($colorMean)
//     {
//         /*returns an array with 1 and zeros. If a color is bigger than the mean value of colors it is 1*/
//         $bits = array();
         
//         foreach($colorMean[1] as $color){$bits[]= ($color>=$colorMean[0])?1:0;}

//         return $bits;

//     }
    
//     public function compare($a,$b)
//     {
//         /*main function. returns the hammering distance of two images' bit value*/
//         $i1 = $this->createImage($a);
//         $i2 = $this->createImage($b);
        
//         if(!$i1 || !$i2){return false;}
        
//         $i1 = $this->resizeImage($i1,$a);
//         $i2 = $this->resizeImage($i2,$b);
        
//         imagefilter($i1, IMG_FILTER_GRAYSCALE);
//         imagefilter($i2, IMG_FILTER_GRAYSCALE);
        
//         $colorMean1 = $this->colorMeanValue($i1);
//         $colorMean2 = $this->colorMeanValue($i2);
        
//         $bits1 = $this->bits($colorMean1);
//         $bits2 = $this->bits($colorMean2);
        
//         $hammeringDistance = 0;
        
//         for($a = 0;$a<64;$a++)
//         {
        
//             if($bits1[$a] != $bits2[$a])
//             {
//                 $hammeringDistance++;
//             }
            
//         }
//           // if ($hammeringDistance < "30")
//           // {
//           //   echo "the image is matched";
//           // }
//           // else{
//           //   echo "the image is not matched";
//           // }
//             }
// }


// $class = new compareImages;
// echo $class->compare("Assets/profile/".$sid.".jpg","Assets/profile/".$file_name."jpg");

//   //      $sql = $dbh->prepare("INSERT INTO users (Studentid,image,name) VALUES ('$sid','$target_Folder$file_name','$file_name')");

//     //    $sql->execute();
       
        echo "1 record added successfully in the database";
        echo '<br />';
       
        // Move the file into UPLOAD folder

        move_uploaded_file($_FILES['uploadimage']['tmp_name'], $target_Path );

        echo "File Uploaded Successfully <br />";

         // if ($hammeringDistance < "30")
         //  {
         //    echo "the image is matched";
         //  }
         //  else{
         //    echo "the image is not matched";
         //  }

  //      header('Location:userhome.php');

       header('Location:userhome.php');
 
?>