<?php
require 'config/config.php';
$isDeleted = false;
if(!isset($_SESSION["username"]) || empty($_SESSION["username"])){
	$error = "Please sign in to delete records.";
}
else if(!isset($_GET['review_id']) || empty($_GET["review_id"])){
		$error = "Invalid review id.";
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
		$error = "You are not allowed to delete this record.";
	}
	else{
	$sql = "DELETE FROM reviews 
	WHERE review_id = " . $_GET["review_id"] . ";";
	$results = $mysqli->query($sql);
	if(!$results) {
		echo $mysqli->error;
		exit();
	}
	if($mysqli->affected_rows == 1) {
		$isDeleted = true;
	}
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
<div class="row mt-4">
			<div class="col-12">

				<?php if ( isset($error) && !empty($error) ) : ?>
						<?php echo $error; ?>
					</div>
				<?php endif; ?>

				<?php if ( $isDeleted ) :?>
					<?php header("Location: homepage.php");?>
				<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->

	<!-- bs js -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>