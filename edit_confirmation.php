<?php
require 'config/config.php';
// echo "<hr><hr><hr>";
// var_dump($_GET);
// var_dump($_POST);
$isUpdated = false;
if(!isset($_SESSION["username"]) || empty($_SESSION["username"])) {
	$error = "Please sign in to edit records.";
}
else if(!isset($_GET['review_id']) || empty($_GET["review_id"])) { 
	$error = "Invalid review id";
}
else if(!isset($_POST['review_content']) || empty($_POST['review_content'])) {
	$error = "The content cannot be blank.";
}
else {
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}
	$sql_confirm = "SELECT username 
	FROM reviews 
	JOIN users
	ON reviews.user_id = users.user_id
	WHERE review_id = " . $_GET["review_id"] . ";";
	$results_confirm = $mysqli->query($sql_confirm);
	if(!$results_confirm) {
		echo $mysqli->error;
		exit();
	}
	$row = $results_confirm->fetch_assoc();
	if($_SESSION['username'] != $row['username']) {
		$error = "You are not allowed to edit this record.";
	}
	else{
		$stmt = $mysqli->prepare("UPDATE reviews SET review_content = ? WHERE review_id = ?");
		$stmt->bind_param("si", $_POST["review_content"], $_GET["review_id"]);
		$executed = $stmt->execute();
		 if(!$executed) {
		 	echo $mysqli->error;
		 }
		 if($stmt->affected_rows == 1) {
		 	$isUpdated = True;
		 }
		 $stmt->close();
}
	$mysqli->close();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>MyTrip</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="index.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="#" />
	<link href="https://fonts.googleapis.com/css2?family=Cardo&display=swap" rel="stylesheet">
	<!-- bs css -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<?php include 'nav.php';?>
		
	<div class="container" id="container">

				<?php if ( isset($error) && !empty($error) ) : ?>
						<?php echo $error; ?>
					</div>

				<?php else: ?>
					<?php header("Location: homepage.php");?>
				<?php endif; ?>
	<!-- bs js -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


</body>
</html>