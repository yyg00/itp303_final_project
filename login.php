<?php
require "config/config.php";
if(!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) {
	if ( isset($_POST['username']) && isset($_POST['password']) ) {
		if (empty($_POST['username'])) {
			$error = "Please enter your username.";
		}
		else if( empty($_POST['password'])) {
			$error = "Please enter your password.";
		}
		else {
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			if($mysqli->connect_errno) {
				echo $mysqli->connect_error;
				exit();
			}
			$password = hash("sha256", $_POST["password"]);
			$sql = "SELECT * FROM users 
			WHERE username = '" . $_POST['username'] . "' AND password = '" . $password . "';";
			$results = $mysqli->query($sql);
			if(!$results) {
				echo $mysqli->error;
				exit();
			}
			if($results->num_rows > 0) {
				$_SESSION["username"] = $_POST["username"];
				$_SESSION["logged_in"] = true;
				header("Location: index.php");

			}
			else {
				$error = "Invalid username or password.";
			}
		} 
	}
}
else {
	header("Location: index.php");
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
		#register {
			background-image: url('img/login.jpg');
			background-position: 70% 90%;
		}
		
	</style>
</head>
<body>
<?php include 'nav.php';?>
		
<div class="container mt-5" id="register">
		<div class="row p-3 text-center d-block ml-auto mr-auto text-dark">Login</div>
		
		<?php if(isset($error) && !empty($error)): ?>
		<div class="text-danger row d-block text-center mx-auto pt-1 pb-1">
			<?php echo $error;?>
		</div>
	<?php endif?>
	<form id="register_form" action="login.php" method="POST">


		<div class="form-group row p-2 align-items-center">
			<label class="sr-only" for="username_id">
				<!-- Username -->
			</label>

			<div class="input-group">
        		<div class="input-group-prepend">
          		<div class="input-group-text">
          		<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
</svg>			</div>
        </div>
        <input required type="text" class="form-control" id="username_id" name="username" placeholder="Username">
      	</div>
      </div>

		<div class="form-group row p-2 align-items-center">
		<label class="sr_only" for="password_id">
		</label>
		<div class="input-group">
			<div class="input-group-prepend">
          	<div class="input-group-text">
			<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  			<path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
  			<path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299l.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
  			<path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709z"/>
  			<path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
			</svg>
			<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye hidden" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  			<path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
  			<path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
			</svg>
		</div>
	</div>
			<input required type="password" class="form-control" id="password_id" name="password" placeholder="Password">		
		</div>
		<div class="col-auto ml-auto mt-1">
			<div class="form-check">
		<input type="checkbox" class="form-check-input d-flex justify-content-center" id="show_password">
		<label class="form-check-label text-color" for="show_password">Show Password </label>
	</div>
	</div>
</div>


		<div class="form-group row d-flex justify-content-between">
			<button type="submit" class="btn critical">Login</button>
			<a href="index.php" role="button" class="btn non-critical">Cancel</a>
		</div>
	</form>
</div>








	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
	<script src="show_password.js"></script>
	<script>
		let navs = document.querySelectorAll("nav-item");
		for(let i=0;i<navs.length;i++){
			if(navs[i].classList.contains("currentPage")){
				navs[i].classList.remove("currentPage");
			}
		}
		document.querySelector("#nav_login").classList.add("currentPage");
		document.querySelector('form').onsubmit = function(){
			var pattern = new RegExp(/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/);
			if ( pattern.test(document.querySelector('#username_id').value) ){
				alert("No special characters allowed in username.");
				document.querySelector('#username_id').classList.add('is-invalid');
			} 
			else if ( document.querySelector('#username_id').value.trim().length == 0 ) {
				document.querySelector('#username_id').classList.add('is-invalid');
				document.querySelector('#username_id').value = "";
				document.querySelector('#username_id').placeholder = "Please enter your username.";
			}
			else {
				document.querySelector('#username_id').classList.remove('is-invalid');
			}
			if ( document.querySelector('#password_id').value.trim().length == 0 ) {
				document.querySelector('#password_id').classList.add('is-invalid');
				document.querySelector('#password_id').value = "";
				document.querySelector('#password_id').placeholder = "Please enter your password.";
			} else {
				document.querySelector('#password_id').classList.remove('is-invalid');
			}
			
			return ( !document.querySelectorAll('.is-invalid').length > 0 );
		}
	</script>
</body>
</html>