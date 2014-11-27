<?php
session_start();
$user = $_SESSION['userid'];
$eid = $_REQUEST['id'];
?>

<html>
<head>

<script type="text/javascript" src="Assets/js/highcharts.js"></script>
<script type="text/javascript" src="Assets/js/jquery.js"></script>
<script type="text/javascript" src="Assets/js/bootstrap.min.js"></script>
</head>
</html>

<?php

include 'db_connect.php'; 

try
	{

		 $query = $dbh->prepare("SELECT CandidateID,votes FROM result WHERE ElectionID = $eid");
		 $query->execute();
		 $data = array();
		 $result1 = $query->fetchAll();

		// $data = $value1['CandidateID']; // convert from Unix timestamp to JavaScript time

		 foreach ($result1 as $value1) 
		 {
		    $data1 = $value1['CandidateID']; // convert from Unix timestamp to JavaScript time
		    $data2 = $value1['votes']; // convert from Unix timestamp to JavaScript time
		    $data = [$data1,$data2];
		 } 
	}

	catch(Exception $e)
	{
		echo $e;
	}
?>

<script type="text/javascript">

var chart = new Highcharts.Chart
(
	{
	      chart:
	       {
	         renderTo: 'container'
	       },
	      series: [
	      {
	         data: [<?php echo join($data, ','); ?>]
	         pointStart: 0},
	         pointInterval
	      }
	      ]
	}
);

</script>
