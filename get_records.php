<?php
require 'config/config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ( $mysqli->connect_errno ) {
	echo $mysqli->connect_error;
	exit();
}

$mysqli->set_charset('utf8');
$sql = "SELECT review_content, review_id FROM reviews 
LEFT JOIN users
ON users.user_id = reviews.user_id
WHERE users.username = '" . $_SESSION['username'] . "'";
if(isset($_GET['country_id']) && !empty($_GET['country_id'])) {
	$sql = $sql . " AND country_id = " . $_GET['country_id'];
}
$sql = $sql . ";";
$results = $mysqli->query($sql);
if(!$results){
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