<?php
/*echo '<link href="index.css" rel="stylesheet" type="text/css" />';*/
session_start();



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
	<style>
	.wrapper {
		margin-left: 5px;
		height: 35vh;
		overflow: hidden;
		display: inline-block;
		position: relative;
	}
	.wrapper img {
		width: auto;
		height: 100%;
	}
	.overlay {
		position: absolute;
		top:0;
		width: 100%;
		height: 100%;
		background-color: rgba(0,0,0,0.5);
		opacity: 0;
		border-radius: 5px;
	}
	.overlay p {
		text-align: center;
		color: white;
		line-height: 40vh;
		/*font-size: 2vw;*/
	}
	.wrapper:hover .overlay {
		opacity: 1;
	}
	.img-thumbnail {
		border-color: #cfd8d7 !important;
	}
	</style>
</head>
<body>
	<?php include 'nav.php';?>
		
	<div class="container" id="container">
		<div class="row mx-auto" id="overview">


			<!-- <div class="col col-12 col-md-4">
				<div class="wrapper">
					<a href="detail.php?country_id=1">
					<img class="img-thumbnail" src="img/us-1.jpg" alt="us img 1">
					<div class="overlay">
						<p>United States</p>
					</div>
					</a>
				</div>
			</div> -->

		</div><!-- row -->
</div>
	<!-- bs js -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


	<script>
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

		function display() {
			ajaxGet("overview.php", function(results){
				results = JSON.parse(results);
				//console.log(results);
				let resultsRow = document.querySelector("#overview");
				for(let i = 0; i<results.length; i++) {
					let id = i+1;
					let main_div = document.createElement("div");
					main_div.classList.add("col", "col-12", "col-md-6", "col-lg-4", "mb-2", "text-center");
					let wrapper = document.createElement("div");
					wrapper.classList.add("wrapper");
					let atag = document.createElement("a");
					atag.setAttribute('href', 'detail.php?country_id=' + id);
					let img = document.createElement("img");
					img.classList.add("img-thumbnail");
					img.src = results[i].cover;
					let overlay = document.createElement("div");
					overlay.classList.add("overlay");
					let name = document.createElement("p");
					name.innerHTML = results[i].country_name;
					overlay.appendChild(name);
					atag.appendChild(overlay);
					atag.appendChild(img);
					wrapper.appendChild(atag);
					main_div.appendChild(wrapper);
					resultsRow.appendChild(main_div);
				}
			});
		}
		display();
	</script>
</body>
</html>