<?php
require "config/config.php";
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}
$mysqli->set_charset('utf8');
$sql = "SELECT * FROM countries;";
$results = $mysqli->query($sql);
	if ( !$results ) {
		echo $mysqli->error;
		exit();
	}
	$results_array = [];
	while($row = $results->fetch_assoc()) {
		array_push($results_array, $row);
	}
	echo json_encode($results_array);
	$mysqli->close();
?>