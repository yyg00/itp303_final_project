<?php 
require 'config/config.php';
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
	header("Location: index.php");
}
else{
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ( $mysqli->connect_errno ) {
	echo $mysqli->connect_error;
	exit();
}

$mysqli->set_charset('utf8');

$sql_country = "SELECT country_id, country_name from countries;";
$results_country = $mysqli->query($sql_country);
if(!$results_country){
	echo $mysqli->error;
	exit();
}
$sql = "SELECT review_id, review_content, country_name FROM reviews 
LEFT JOIN users
ON users.user_id = reviews.user_id
LEFT JOIN countries
ON countries.country_id = reviews.country_id
WHERE users.username = '" . $_SESSION['username'] . "';";
$results = $mysqli->query($sql);
if(!$results){
	echo $mysqli->error;
	exit();
}
$mysqli->close();
}
function custom_echo($x, $length)
{
  if(strlen($x)<=$length)
  {
    echo $x;
  }
  else
  {
    $y=substr($x,0,$length) . '...';
    echo $y;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>User Homepage</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="index.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="#" />
	<link href="https://fonts.googleapis.com/css2?family=Cardo&display=swap" rel="stylesheet">
	<!-- bs css -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		.inactive{
			display: none;
		}
		.each_detail {
			max-width: 100%;
		}
		#search_records {
			width: 80%;
		}
		#records {
			width: 70%;
			margin: 0 auto;
		}
		#records a {
			text-decoration: none;
			color: #40484f;
			font-size: 20px;
		}
		#records a:hover {
			color: #8495a3;
		}
		.delete_button{
			margin-bottom: 0;
			height: 35px;
			font-size: 15px !important;
			margin-left: 5%;
		}
		.edit_button {
			right: 5%;
		}
		select {
			text-align-last: center;
		}
		@media(min-width: 768px){
			#search_records {
			width: 60%;
		}
		}
		@media(min-width: 768px){
			#search_records {
			width: 40%;
		}
		}
	</style>
</head>
<body>
	<?php include 'nav.php';?>
	<div class="container" id="container">
		<h3>My Records</h3>
		<form id="search_records" class="mt-3 form-block mx-auto" action="" method="GET">
				<label for="search_country" class="text-sm-right">Search records by country: </label>
				<select id="search_country" class="form-control">
					<option value="">---All---</option>
					<?php while ($row_country = $results_country->fetch_assoc()):?>
						<option value="<?php echo $row_country['country_id'];?>"><?php echo $row_country['country_name'];?></option>
					<?php endwhile;?>
				</select>
				<div class="row d-flex justify-content-center">
			<button type="submit" class="btn critical mt-3">Search</button>
		</div>
		</form>
		<?php if($results->num_rows>0):?>
		<h5 class="mt-3">Click to review/edit details:</h5>
		<?php else: ?>
			<h5 class="mt-3">You don't have any records yet.</h5>
		<?php endif;?>
		<div class="row mt-3" id="search_results">
		
				<div id="records">
					
					<?php while($row = $results->fetch_assoc()):?>
						<div class="each_detail mb-3">
							<div class="row">
								<span>Country: <?php echo $row['country_name']?></span>
							</div>
					<div class="row mb-3 record_overview" >
					<span>Record: <a class="col-12 records_detail" href="#"><?php echo custom_echo($row['review_content'],50);?></a> </span>
				</div>
							<div class="row edit_form inactive mb-3">
							<form class="col-12" class="edit_detail_form" action="edit_confirmation.php?review_id=<?php echo $row['review_id']?>" method="POST">
								<label>Record Detail: </label>
								<textarea required class="container-fluid form-control limitInput" name="review_content"><?php echo $row['review_content'];?></textarea>
								<div class="row position-relative width-auto">
									<a href="delete.php?review_id=<?php echo $row['review_id'];?>" role="button" class="btn critical delete_button mt-3 ">Delete</a>
								<button type="submit" class="btn critical mt-3 position-absolute edit_button">Edit</button>
								
								</div>
							</form>
						</div>
					</div>

				<?php endwhile?>
		

		</div>
</div>
</div>

	<!-- bs js -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
	<script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
	let navs = document.querySelectorAll("nav-item");
		for(let i=0;i<navs.length;i++){
			if(navs[i].classList.contains("currentPage")){
				navs[i].classList.remove("currentPage");
			}
		}
		document.querySelector("#nav_homepage").classList.add("currentPage");

	function ajaxGet(endpointUrl, returnFunction){
			var xhr = new XMLHttpRequest();
			xhr.open('GET', endpointUrl, true);
			xhr.onreadystatechange = function(){
				if (xhr.readyState == XMLHttpRequest.DONE) {
					if (xhr.status == 200) {
						returnFunction( xhr.responseText );
					} else {
						alert('AJAX Error.');
						console.log(xhr.status);
					}
				}
			}
			xhr.send();
		};
	document.querySelector("form").onsubmit = function(event){
		event.preventDefault();
		let searchCountry = document.querySelector("#search_country").value;
		ajaxGet("get_records.php?country_id=" + searchCountry, function(results){
			results = JSON.parse(results);
			//console.log(results);
			let rList = document.querySelector("#records");
			while(rList.hasChildNodes()){
				rList.removeChild(rList.lastChild);
			}
			for(let i =0; i<results.length; i++) {
			let div_ed = document.createElement("div");
			let content = results[i].review_content;
			if(content.length > 50){
				content = content.substring(0, 50) + "...";
			}
			let div_record = document.createElement("div");
			div_record.classList.add("row", "mb-3", "record_overview");
			let span = document.createElement("span");
			span.innerHTML = "Record: ";
			let r_id = results[i].review_id;
			let a = document.createElement("a");
			a.classList.add("col-12", "records_detail");
			a.setAttribute("href", "#");
			a.innerHTML = content;
			span.appendChild(a);
			div_record.appendChild(span);
			let e_form = document.createElement("div");
			e_form.classList.add("row", "edit_form", "mb-3", "inactive");
			let form = document.createElement("form");
			form.classList.add("col-12");
			form.setAttribute("method", "POST");
			form.setAttribute("action", "edit_confirmation.php?review_id=" + r_id);
			let label = document.createElement("label");
			label.innerHTML = "Record Detail: ";
			let textarea = document.createElement("textarea");
			textarea.setAttribute("name", "review_content");
			//textarea.setAttribute("maxlength", "1000");
			textarea.setAttribute("required", "");
			textarea.classList.add("container-fluid", "form-control", "limitInput");
			textarea.innerHTML = results[i].review_content;
			let buttons_div = document.createElement("div");
			buttons_div.classList.add("row", "position-relative", "width-auto");
			let d_button = document.createElement("a");
			d_button.setAttribute("href", "delete.php?review_id=" + r_id);
			d_button.setAttribute("role", "button");
			d_button.classList.add("btn", "critical", "delete_button", "mt-3");
			d_button.innerHTML = "Delete";
			buttons_div.appendChild(d_button);
			let e_button = document.createElement("button");
			e_button.setAttribute("type", "submit");
			e_button.classList.add("btn", "critical", "mt-3", "position-absolute", "edit_button");
			e_button.innerHTML = "Edit";
			buttons_div.appendChild(e_button);
			form.appendChild(label);
			form.appendChild(textarea);
			form.appendChild(buttons_div);
			e_form.appendChild(form);
			div_ed.appendChild(div_record);
			div_ed.appendChild(e_form);
			rList.appendChild(div_ed);
			
		}
		});
	}

		function confirmDelete() {
		return confirm("Are you sure you want to delete this record?");
	}
	$('body').on('click', '.delete_button', confirmDelete);
	
	$('body').on('click', '.record_overview', function(event){
		event.preventDefault();
		event.stopPropagation();
		$(this).next().slideToggle(200);
		//disable the edit button first
		//$(this).next().find(".edit_button").prop('disabled',true);
	});
	$('body').on('input', '.limitInput', function(){
		if($(this).val().trim().length == 0){
			alert("Input could not be empty.");
			$(this).addClass("is-invalid");
			$(this).siblings().find(".edit_button").prop('disabled', true);
		}
		else{
			$(this).siblings().find(".edit_button").prop('disabled', false);
			$(this).removeClass("is-invalid");
		}
		if($(this).val().trim().length > 1000) {
		alert("Only 1000 characters allowed.");
		$(this).val($(this).val().substring(0,1001));
	}
	});
	</script>

</body>
</html>