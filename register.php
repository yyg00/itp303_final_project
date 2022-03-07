<?php 
session_start();
if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]){
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
			background-image: url('img/register.jpg');
		}
		
	</style>
</head>
<body>
<?php include 'nav.php';?>
<div class="container mt-5" id="register">
		<div class="row p-3 pt-4 d-flex justify-content-center text-color">Register to share your experience</div>

	<form id="register_form" action="register_success.php" method="POST">


		<div class="form-group row p-2 align-items-center">
			<label class="sr-only" for="username_id">
				<!-- Username -->
			</label>

			<div class="input-group">
        		<div class="input-group-prepend">
          		<div class="input-group-text">
          		<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  				<path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7.5-3a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
				</svg>
			</div>
        </div>
        <input required type="text" class="form-control" id="username_id" name="username" placeholder="Username">
      	</div>
      </div>

		<div class="form-group row p-2 align-items-center">
			<label class="sr-only" for="email_id">
				<!-- Email -->
			</label>

			<div class="input-group">
        		<div class="input-group-prepend">
          		<div class="input-group-text">
          		<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-mailbox2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M12 3H4a4 4 0 0 0-4 4v6a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V7a4 4 0 0 0-4-4zM8 7a3.99 3.99 0 0 0-1.354-3H12a3 3 0 0 1 3 3v6H8V7zm1 1.5h2.793l.853.854A.5.5 0 0 0 13 9.5h1a.5.5 0 0 0 .5-.5V8a.5.5 0 0 0-.5-.5H9v1zM4.585 7.157C4.836 7.264 5 7.334 5 7a1 1 0 0 0-2 0c0 .334.164.264.415.157C3.58 7.087 3.782 7 4 7c.218 0 .42.086.585.157z"/>
</svg>
			</div>
        </div>
        <input required type="email" class="form-control" id="email_id" name="email" placeholder="Email">
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
			<button type="submit" class="btn critical">Register</button>
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
		document.querySelector("#nav_register").classList.add("currentPage");
		document.querySelector('form').onsubmit = function(){
			var pattern = new RegExp(/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/);
			if ( document.querySelector('#username_id').value.trim().length == 0 ) {
				document.querySelector('#username_id').classList.add('is-invalid');
				document.querySelector('#username_id').value = "";
				document.querySelector('#username_id').placeholder = "Please enter your username.";
			} 
			else if ( pattern.test(document.querySelector('#username_id').value) ) 
			{
				alert("No special characters allowed in username.");
				document.querySelector('#username_id').classList.add('is-invalid');
			}
			else
			{
				document.querySelector('#username_id').classList.remove('is-invalid');
			}
			
	
			if ( document.querySelector('#email_id').value.trim().length == 0 ) {
				document.querySelector('#email_id').classList.add('is-invalid');
			}
			else if ( pattern.test(document.querySelector('#email_id').value) ){
				alert("No special characters allowed in email.");
				document.querySelector('#email_id').classList.add('is-invalid');
			}
			else {
				document.querySelector('#email_id').classList.remove('is-invalid');
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