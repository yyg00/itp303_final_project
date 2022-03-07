<?php
require 'config/config.php';
if ( !isset($_POST['email']) || empty($_POST['email'])
	|| !isset($_POST['username']) || empty($_POST['username'])
	|| !isset($_POST['password']) || empty($_POST['password']) ) {
	$error = "Please fill out all the required fields.";
}
else {
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}
	$sql_registered = "SELECT * FROM users 
	WHERE username = '" . $_POST["username"] . 
	"' OR email = '" . $_POST["email"] . "';";
	$results_registered = $mysqli->query($sql_registered);
	if(!$results_registered) {
		echo $mysqli->error;
		exit();
	} 

	if($results_registered->num_rows > 0) {
		$error = "Your username or email has been used. Please try again or login.";
	}
	else {
		$password = hash("sha256", $_POST["password"]);
		$sql = "INSERT INTO users(username, email, password)
		VALUES('". $_POST["username"] . "','" . $_POST["email"] . "','" . $password . "');";
		$results = $mysqli->query($sql);
		if(!$results) {
		echo $mysqli->error;
		exit();
		}
		$_SESSION["username"] = $_POST["username"];
		$_SESSION["logged_in"] = true;
		header("Location: index.php");
		}
		$mysqli->close();
	}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="index.css" rel="stylesheet" type="text/css" />
	<link href="register.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="#" />
	<link href="https://fonts.googleapis.com/css2?family=Cardo&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		
	</style>
</head>
<body>
<?php include 'nav.php';?>
<div class="container-fluid mt-5">
	<?php if(isset($error) && !empty($error)): ?>
	<h4 class="text-danger text-center"><?php echo $error;?></h4>
	<!-- 
	<h2 class="text-dark text-center"><?php //echo "<em>". $_POST['username'] . "<em> has been successfully registered.";?></h2> -->
	<?php endif;?>
	<div class="d-flex justify-content-center mt-5">
	<a href="login.php" role="button" class="btn critical mr-2">Login</a>
	<a href="register.php" role="button" class="btn btn-light mr-2">Back to Register</a>
	<a href="index.php" role="button" class="btn non-critical">Cancel</a>
</div>
</div>


	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>