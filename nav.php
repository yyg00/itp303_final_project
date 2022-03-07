
	<nav class="navbar navbar-expand-lg navbar-light fixed-position nav-background">
		<a class="navbar-brand text-white" href="index.php">MyTrip</a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
  			<ul class="navbar-nav ml-auto">
       <?php if(!isset($_SESSION["logged_in"]) || !($_SESSION["logged_in"])):?>
      			<li class="nav-item" id="nav_login">
        		<a class="nav-link text-white" href="login.php">Login</a>
      			</li>
     			<li class="nav-item" id="nav_register">
            <a class="nav-link text-white" href="register.php">Register</a>	
      			</li>
            <?php else: ?>
              <li class="nav-item"  id="nav_homepage">
              <a class="nav-link text-white" href="homepage.php">Hello <?php echo $_SESSION["username"];?>!</a>
            </li>
      			<li class="nav-item">
      			<a onclick="return confirm('Are you sure you want to log out?');" class="nav-link text-white" href="logout.php">Logout</a>
      			</li>
          <?php endif;?>
  			</ul>
		</div>
	</nav>
  <div class="jumbotron jumbotron-fluid" id="header">
      <div class="display-4" id="display">
        <?php if(isset($row['country_name']) && !empty($row['country_name'])):?>
        <?php echo $row['country_name'];?>
        <?php else: ?>
        <?php echo "Record Your Trip";?>
      <?php endif;?>
      </div>
  </div>