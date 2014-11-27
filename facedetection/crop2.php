<?php
  $x1 = $_POST['x1']; //this one gives me the point where start to crop
  $x2 = $_POST['x2']; //the end of X axis
  $y1 = $_POST['y1']; //same for Y1 and Y2
  $y2 = $_POST['y2'];
  $w  = ( $x2 - $x1 ); //getting the width for the new image
  $h  = ( $y2 - $y1 ); //getting the height for the new image

  $src  = "path_to_file";
  $info = getimagesize( $src );
$size = getimagesize($filename);
$fp = fopen($filename, "rb");
if ($size && $fp) {
    header("Content-type: {$size['mime']}");
    fpassthru($fp);
    exit;
} else {
    // error
}
  switch( $info[2] ) {
    case IMAGETYPE_JPEG:
      $copy = imagecreatefromjpeg( $src );
      $new  = imagecreatetruecolor( $w, $h );
      imagecopyresampled( $new, $copy, 0, 0, $x1, $y1, $info[0], $info[1], $w, $h );
      header( 'Content-type: image/jpeg' );
      imagejpeg( $new );
    break;
    default:
    break;
  }
?>