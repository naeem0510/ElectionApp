<?php

session_start();

if(isset($_SESSION['userid']))
{
    $elecid = $_REQUEST['id'];
    $admin = $_SESSION['admin'];
}

?>

    <!DOCTYPE html>
    <html>
    <head>

    	<title>Results</title>

    <link rel="stylesheet" type="text/css" href="Assets/CSS/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Assets/CSS/bootstrap-responsive.css">

    <script src="Assets/js/jquery.js"></script>
    <script src="Assets/js/bootstrap.min.js"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>

    </head>
    <body>
    
     <!-- Run Queries to Select Election and fetch Results -->  

 <?php 

    include 'db_connect.php';

    if(!$admin)
    {
        include 'navbar_home.php';
    }

    else
    {
        include 'navbar_admin.php';
    }


        $stmt = $dbh->prepare("SELECT CandidateID,votes FROM result WHERE ElectionID = $elecid");
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        if(sizeof($result)!=0)
        {
            foreach ($result as $value) 
            {
                $CandidateID = $value['CandidateID'];
                $vote = $value['votes'];
            }  
            
            if($CandidateID)
        {

            $stmt1 = $dbh->prepare("SELECT FirstName,LastName FROM users WHERE StudentID = '$CandidateID'");
            $stmt1->execute();
            $result1 = $stmt1->fetchAll();

            foreach ($result1 as $value) 
            {
                $fname = $value['FirstName'];
                $lname = $value['LastName'];
            }
        }
        }

        // FETCH COMPLETE USER DETAILS //
        
       else
       {
            $fname = 'No Result';
            $lname = 'Available';
            $vote = 0;
       }

?>         

<script type="text/javascript">
    var chart;

/**
 * Request data from the server, add it to the graph and set a timeout 
 * to request again
 */
function requestData()
 {
    $.ajax({
        url: 'live_data.php',
        success: function(point) {
            var series = chart.series[0],
                shift = series.data.length > 20; // shift if the series is 
                                                 // longer than 20

            // add the point
            chart.series[0].addPoint(point, true, shift);
            
            // call it again after one second
            setTimeout(requestData, 1000);    
        },
        cache: false
    });
}

$(document).ready(function() {
    chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            defaultSeriesType: 'column',
            events: {
                load: requestData
            }
        },
        title: {
            text: 'Live random data'
        },
        xAxis: {
            type: 'Name',
            tickPixelInterval: 150,
            maxZoom: 20 * 1000
        },
        yAxis: {
            minPadding: 0.2,
            maxPadding: 0.2,
            title: {
                text: 'Votes',
                margin: 80
            }
        },
        series: [{
            name: 'Election Result',
            data: []
        }]
    });        
});

</script>


</body>
</html>