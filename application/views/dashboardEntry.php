<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
	<link rel='stylesheet' href="<?php echo base_url('public\css\bootstrap.css') ?>"/>
	<title><?php echo $appName;?></title>
</head>

<?php

echo <<<_END

	<body style="background-color: #333">
	

	<div id="container">

		<h1 style="color:white; text-align:center;">$username's Dashboard</h1>
		
		

		<!-- entry form  -->
		<form id="dashboardentry" action="dashboard" method="post">
		<input type="hidden" name="dshUser" id="dshUser" value=$username>
		<div class="text-center">
		<button class="btn btn-success" type="submit" name="entry" value="entry">Enter</button>
		</div>
		</form>
_END;
?>
	</div>

	</body>


</html>