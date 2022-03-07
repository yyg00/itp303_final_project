<?php 

require("detail_cred.php");
require 'config/config.php';
if(!isset($_GET['country_id']) || empty($_GET['country_id']) || $_GET['country_id'] > 12) {
	$error = "Invalid country id.";
}
else {
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($mysqli->connect_errno){
		echo $mysqli->connect_error;
		exit();
	}
	$mysqli->set_charset('utf8');
	$sql = "SELECT country_name,  continent_name, capital_city, currency_name, description
			FROM countries
			LEFT JOIN continents
			ON continents.continent_id = countries.continent_id
			LEFT JOIN currencies
			ON currencies.currency_id = countries.currency_id
			WHERE countries.country_id = " . $_GET['country_id'] . ";";
	$results = $mysqli->query($sql);
	if ( !$results ) {
		echo $mysqli->error;
		exit();
	}
	$row = $results->fetch_assoc();
	$sql_language = "SELECT language_name 
					FROM countries
					LEFT JOIN countries_has_languages
					ON countries_country_id = countries.country_id
					LEFT JOIN languages
					ON languages.language_id = countries_has_languages.languages_language_id
					WHERE countries.country_id = " . $_GET['country_id'] . ";";
	$results_language = $mysqli->query($sql_language);
	if ( !$results_language ) {
		echo $mysqli->error;
		exit();
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
	<link href="https://fonts.googleapis.com/css2?family=Cardo&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="index.css" type="text/css" />
	<link rel="shortcut icon" href="#" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	
	<link href="lightbox/dist/css/lightbox.css" rel="stylesheet" />

	<style>
		a {
			
			color: #71807b;
		}
		a:hover {
			text-decoration: none;
			color: #1d1e2c;
		}
		.slider {
			position: relative;
		}
		.prev, .next {
			box-sizing: border-box;
			cursor: pointer;
			position: absolute;
			top: 40%;
			width: auto;
			color: white;
			transition: 0.5s ease;
			user-select: none;
			font-size: 25px;
			background-color: rgba(255,255,255,0.5);
			border-radius: 0 3px 3px 0;

		}
		.next {
			right: 0;
			border-radius: 3px 0 0 3px;
		}
		.prev:hover, .next:hover {
  			background-color: rgba(0,0,0,0.3);
  			color: white !important;
		}

		.wrapper {
			overflow: hidden;
			display: none;
			height: 350px;
		}
		.wrapper img{
			width: 100%;
			height: auto;
		}
		#all_info {
			padding-top: 20px;
		}

		#record h5{
			color: #59656f;
		}
		textarea {
			min-width: 100%;
		}
		@media(min-width: 768px){
			#all_info {
				padding-top: 0;
			}
			.prev, .next {
				top: 30%;
			}
			.wrapper {
			height: 380px;

		}
		}
		@media(min-width: 992px){
			
			.prev, .next {
				top: 45%;
			}
		}
	</style>
</head>
<body>

	<?php include 'nav.php';?>
		

	<div class="container" id="container">
		<?php if(isset($error) && !empty($error)) :?>
<?php echo $error;?>
<?php else:?>
		<div class="row">
			<a href="https://pixabay.com/" class="col-12 col-md-6 text-center">Photos provided by Pixabay</a>
		</div>
	<div class="row">

		<div class="col-12 col-md-6">
			
			<div class="slider" id="pics">
				
				
			<a class="prev">
				&#10094;
				</a>
				<a class="next">
				&#10095;
				</a>
		</div><!-- .slider -->
		</div><!-- .col -->


		<div class="col-12 col-md-6" id="all_info">
				<div class="row">
				<div class="info col-12 mb-3">Continent: <?php echo $row['continent_name']; ?></div>
				<div class="info col-12 mb-3">Capital City: <?php echo $row['capital_city']; ?></div>
				<div class="info col-12 mb-3">Currency: <?php echo $row['currency_name']; ?></div>
				<div class="info col-12 mb-3">Language(s): 
				 <?php while($row_languages = $results_language->fetch_assoc()): ?>
				 	<?php echo $row_languages['language_name'] . ";";?>
				 	<?php endwhile; ?> 
				 </div>
				 <div class="info col-12">Description: <?php echo "<br>" . $row['description']; ?></div>
				 
			</div><!-- row -->
		</div><!-- col -->
	
	</div>
	<div class="row mt-4 pl-4 pr-4" id="record_container">
		<?php if(!isset($_SESSION["logged_in"]) || !($_SESSION["logged_in"])):?>
		<h5 class="col-12 text-center font-italic"><a href="login.php" class="font-weight-bold">Login</a> or <a href="register.php" class="font-weight-bold">Register</a> to record your experience.</h5>
			<?php else: ?>
				<div id="record_form" class="container-fluid">
		<form action="add_confirmation.php" method="POST">
			<div class="form-group row p-2 align-items-center">
				<input type="hidden" name="country_id" value="<?php echo $_GET['country_id'];?>">
				<label for="record"></label>
			<textarea required class="form-control" id="record" name="record" rows="5" placeholder="Record your experience (1000 characters limit)"></textarea>
		</div>
			<div class="form-group row d-flex justify-content-end">
			<button type="submit" class="btn critical mr-2" id="submit_button">Submit</button>
			<button type="reset" class="btn non-critical">Reset</button>
		</div>
		</form>
	</div>
	<?php endif;?>
	</div>

	
<?php endif;?>
</div>

<!-- bootstrap js -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="lightbox/dist/js/lightbox.js"></script>


<script type="text/javascript">	

$(document).ready(function(){
	let country = <?php echo json_encode($row['country_name']);?>;
	//console.log(country);
	function displayPhotos(country){
	$.ajax({
	method: "GET",
	url:"detail_backend.php",
	data: {
		q: country + " scenery",
	},
	})
.done(function(results){
	//console.log(results);
	results = JSON.parse(results);
	// console.log(results);
	let picwrapper = document.querySelector("#pics");
	let alldots = document.querySelector("#dots");
	for(i=0;i<results.length;i++){
	let wrapper = document.createElement("div");
	wrapper.classList.add("wrapper");

	let atag = document.createElement("a");
	atag.setAttribute("href", results[i]);
	atag.setAttribute("data-lightbox", "pictures");
	
	let img = document.createElement("img");
	img.src = results[i];
	img.classList.add("rounded", "d-block", "mx-auto");
	atag.appendChild(img);

	wrapper.appendChild(atag);
	picwrapper.appendChild(wrapper);
	}

let slideIndex = 1;
showSlides(slideIndex);

document.querySelector(".prev").onclick = function(){
	slideIndex = slideIndex + 1;
	showSlides(slideIndex);
};
document.querySelector(".next").onclick = function(){
	slideIndex = slideIndex - 1;
	showSlides(slideIndex);
};
	function showSlides(i) {
  let slides = document.querySelectorAll(".wrapper");
  if (i > slides.length) {slideIndex = 1}
  if (i < 1) {slideIndex = slides.length}
  for (let j = 0; j < slides.length; j++) {
      slides[j].style.display = "none";
  }
  slides[slideIndex-1].style.display = "block";
 
}


	});
};	
displayPhotos(country);

});

let textInput = document.querySelector("#record");
if(!!textInput){
textInput.oninput = function(){
	if(this.value.trim().length == 0){
		this.classList.add("is-invalid");
		
	}
	else {
		this.classList.remove("is-invalid");
	}
	if(this.value.trim().length > 1000) {
		alert("Only 1000 characters allowed.");
		this.value = this.value.substring(0,1001);
	}
}

document.querySelector('form').onsubmit = function(){
	if(textInput.value.trim().length == 0){
		alert("Input cannot be blank.");
	}
	return ( !document.querySelectorAll('.is-invalid').length > 0 );
}
}
</script>
</body>
</html>
