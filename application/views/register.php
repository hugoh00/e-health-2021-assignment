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
	<title><?php echo $appName . " Registration";?> </title>
</head>

<nav class="navbar navbar-expand-md bg-dark navbar-dark navbar-static-top">
	<a class="navbar-brand" href="#">E-Health Navigation</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
   		<span class="navbar-toggler-icon"></span>
	</button>	
		<div class = "collapse navbar-collapse" id="collapsibleNavbar">
			<div class="navbar-nav">
				<a class="nav-item nav-link" href="<?php echo base_url(''); ?>">Login</a>
				<a class="nav-item nav-link active" href="<?php echo base_url("./index.php/registerLoad"); ?>">Register</a>
			</div>
		</div>
</nav>


<?php

echo <<<_END

	<body style="background-color: #b3ffe0">
	
	<h1>$appName Registration Portal</h1>

	<div class="container" style="background-color:aliceblue; padding-top:5px; padding-bottom:10px;">

		
		
		

		<!-- register form  -->
		<form id="register" action="registerAttempt" method="post">
		<div class="form-group">
		<label for="regEmail">Email:</label>
		<input type="email" name="regEmail" id="regEmail" placeholder="Enter Email" required>
		</div>
		<div class="form-group">
		<label for="regUsername">Username:</label>
		<input type="text" name="regUsername" id="regUsername" placeholder="Enter Username" required>
		</div>
		<div class="form-group">
		<label for="regPassword">Password:</label>
		<input type="text" name="regPassword" id="regPassword" placeholder="Enter Password" required>
		</div>
		<p><button class="btn bg-success" type="submit" name="register" value="register" onclick="formValidation();">Register</button>
		</form>
_END;
?>

		<?php
		if(isset($errorMessage)) {
			echo "<p id='error'>$errorMessage</p>";
		}
		?>
	</div>

	</body>


</html>