<?php 
// Set the JSON header
include 'db_connect.php';

header("Content-type: text/json");

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

			$name = $fname.$lname;
        }


// Create a PHP array and echo it as JSON
$ret = array($name,$vote);
echo json_encode($ret);
?>