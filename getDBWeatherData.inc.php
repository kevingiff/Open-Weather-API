<?php
session_start();
//Create connection
	include_once 'openWeatherDBConnect.inc.php';
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


//initiate a return arrays
    $returnArray=[];
    $recordsArr=[];

//select from db
    $select = "SELECT city,temperature,timezone,time_stamp FROM records LIMIT 300";
    $results = $conn->query($select);

    while($row = $results->fetch_assoc()){
        $deatsarray=[];
        $ka []= $row;
        $keyarray=array_keys($ka[0]);
        for ($j=0; $j < count($keyarray); $j++) {
            $deatsarray += [
                $keyarray[$j] => $row[$keyarray[$j]]
            ];
        }

        array_push($recordsArr,$deatsarray);
    }

    $returnArray+= ['records' => $recordsArr];
    
//return data
    echo json_encode($returnArray);

?>