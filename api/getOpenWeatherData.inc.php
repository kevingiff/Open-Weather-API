<?php
session_start();
//Create connection
	include_once 'openWeatherDBConnect.inc.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//if no city is recieved, default to Porto, Portugal
$city = 'Porto, PT';
if (isset($_GET['city'])) {
    $city = mysqli_real_escape_string($conn, $_GET['city']);
}
$apiKey = '';//[INSERT YOUR API KEY]
$jsonfile = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".$city."&appid=".$apiKey."&units=imperial");
$jsondata = json_decode($jsonfile);
$timezone = $jsondata->timezone;
$temp = $jsondata->main->temp;
$pressure = $jsondata->main->pressure;
$humidity = $jsondata->main->humidity;
$desc = $jsondata->weather[0]->description;
$maind = $jsondata->weather[0]->main;

//initiate a return array
$returnArray=[];

//insert into db
$insert = "INSERT INTO records (city,temperature,timezone) VALUES (?, ?, ?)";
$results = $conn->prepare($insert);
$results->bind_param("sdi", $city, $temp, $timezone);
if ($results->execute()) {
	//success
	//get current time
	$now = date('Y-m-d H:i:s');

	//send data to return array
	if (strlen($temp)>0) {
		$returnArray += [
				'city' => $city,
				'temperature' => $temp,
				'time_stamp' => $now,
				'timezone' => $timezone
			];

	    echo json_encode($returnArray);

	}else{
		echo "Error loading city weather data, try again.";
	}
}else{
	//error
	echo 'Error inserting new record in db';
}

?>
