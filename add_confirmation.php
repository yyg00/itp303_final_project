<?php
require 'config/config.php';
$isAdded = false;
if(!isset($_SESSION["username"]) || empty($_SESSION["username"])){
	$error = "Please sign in to add records.";
}
else if(!isset($_POST['country_id']) || empty($_POST['country_id']) ){
	$error = "Invalid country id.";
}
else if(!isset($_POST['record']) || empty($_POST['record'])){
	$error = "The record cannot be blank.";
}
else {
	
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}
	$sql_userid = "SELECT user_id FROM users WHERE username = '" . $_SESSION['username'] . "';";
 	$results_userid = $mysqli->query($sql_userid);
 	if(!$results_userid) {
	echo $mysqli->error;
	exit();
	}
	$row = $results_userid->fetch_assoc();
	$id = $row['user_id'];
	$stmt = $mysqli->prepare("INSERT INTO reviews(user_id, review_content, country_id) VALUES(?,?,?)");
	$stmt->bind_param("isi", $id, $_POST['record'], $_POST['country_id']);
	$executed = $stmt->execute();
		 if(!$executed) {
		 	echo $mysqli->error;
		 }
		if($stmt->affected_rows == 1) {
		 	$isAdded = True;
		 }
		 $stmt->close();
		 $mysqli->close();
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Success</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="index.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="#" />
	<link href="https://fonts.googleapis.com/css2?family=Cardo&display=swap" rel="stylesheet">
	<!-- bs css -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		a{
			color: #59656f;
		}
		a:hover {
			color: #b5c9c3;
			text-decoration: none;
		}
	</style>
</head>
<body>
	<?php include 'nav.php';?>
		
	<div class="container" id="container">
		<h5>
			<?php if(isset($error) && !empty($error)):?>
			<?php echo $error;?>
		<?php endif;?>
			<?php if($isAdded):?>
			Success. <a href="homepage.php">Review your records</a> or <a href="index.php">go back to home page</a>.
		<?php endif;?>
		</h5>

</div>
	<!-- bs js -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


</body>
</html>