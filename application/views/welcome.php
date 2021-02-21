<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">	
	<link rel='stylesheet' href="<?php echo base_url('public\css\bootstrap.css') ?>"/>
	<!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<!-- Latest compiled JavaScript -->
    <script src="<?php echo base_url('public\javascript\bootstrap.js') ?>"></script>
	<!-- Google Charts libraries -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	
	<script type='text/javascript' src="<?php echo base_url('public/javascript/welcomeRegistration.js') ?>"></script>
	<title><?php echo $appName;?></title>
</head>

<nav class="navbar navbar-expand-md bg-dark navbar-dark navbar-static-top">
	<a class="navbar-brand" href="#">E-Health Navigation</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
   		<span class="navbar-toggler-icon"></span>
	</button>	
		<div class = "collapse navbar-collapse" id="collapsibleNavbar">
			<div class="navbar-nav">
				<a class="nav-item nav-link active" href="<?php echo base_url(''); ?>">Login</a>
				<a class="nav-item nav-link" href="<?php echo base_url("./index.php/registerLoad"); ?>">Register</a>
			</div>
		</div>
</nav>


	<body  style="background-color: #b3ffe0">

	<div class="container" style="background-color:aliceblue; padding-top:5px; padding-bottom:10px;">
	<?php

	echo "<h1>Welcome to the $appName Portal</h1>";

	$url = "./index.php/signIn";
	if(isset($errorMessage)) {
		echo "<p style='color:red' id='error'>$errorMessage</p>";
		$url = "." . $url;
	}
	

echo <<<_END
		
		<!-- login form  -->
		<form id="welcome" name="welcome" action="$url" method="post">
		<div class="form-group">
		<label for="username">Username:</label>
		<input type="text" class="form-control" name="username" id="username" placeholder="Enter Username">
		</div>
		<div class="form-group">
		<label for="password">Password:</label>
		<input type="text" class="form-control" name="password" id="password" placeholder="Enter Password">
		</div>
		<button class="btn btn-outline-success btn-lg btn-block" type="submit" name="login" value="login">Log In </button>
		</form>
_END;

?>
		
		</div>

	</body>

</html>
