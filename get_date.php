<<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php
echo date("d/m/Y"). "<br>";
echo date("h:i:sa"). "<br>";
echo date("l"). "<br>";
?>

<script type="text/javascript">
var auto_refresh = setInterval(function(){
    $('#holder').load('get_date.php').fadeIn("slow");
}, 10000); // refresh every 10000 milliseconds
</script>

</body>
</html>
