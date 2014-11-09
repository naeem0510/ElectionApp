<?php

session_start();

?>


<html>
<head><title>File Insert</title></head>
<body>
<h3>Please Choose a File and click Submit</h3>

<form enctype="multipart/form-data" action="image_upload_suc.php" method="post">

<label>Choose File to Upload:</label><br />

<input type="hidden" name="id" />

<input type="file" name="uploadimage" /><br />

<input type="submit" value="upload" />
</form>

</body>
</html>