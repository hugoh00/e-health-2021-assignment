
<body style="background-color: #2aa8e2">
<nav class="navbar navbar-expand-md bg-dark navbar-dark navbar-static-top">
	<a class="navbar-brand" href="#">E-Health Navigation</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
   		<span class="navbar-toggler-icon"></span>
	</button>	
		<div class = "collapse navbar-collapse" id="collapsibleNavbar">
			<div class="navbar-nav">
			
				<a class="nav-item nav-link active" href="<?php echo base_url("index.php/dashboardLoad/" . base64_encode($id)); ?>">Dashboard</a>
					
				<?php
					$indicator = base64_encode($id);
					$class = "nav-item nav-link";
					if($staff == true) {
						$questionnaire = base_url("index.php/questionnaireLoad/" . $indicator);
						$data = base_url("index.php/dataLoad/" . $indicator);
						echo "<a class='$class' href='$questionnaire'>Questionnaires</a>";
						echo "<a class='$class' href='$data'>Data</a>";
					} else {
						$questionnaire = base_url("index.php/questionnaireLoad/" . $indicator);
						echo "<a class='$class' href='$questionnaire'>Questionnaires</a>";
						
					}
				?>
				<!-- send to a view which confirms logout atm just sends back to login-->
				<a class="nav-item nav-link" href="<?php echo base_url(''); ?>">Logout</a>
			</div>
		</div>
	</nav>
	<div class="container-fluid">
	<h1>E-Health Dashboard</h2>
	<p>Welcome to E-Health <?php echo $username ?>.</p>
	<h3>What you can do:</h3>
	<ul class="list-group">
		<li class="list-group-item active" style="background-color:#333">Dashboard</li>
		<?php 
			if($staff == true) {
				echo "<li class='list-group-item list-group-item-info'>View Completed Questionnaires</li>";
				echo "<li class='list-group-item list-group-item-info'>Data</li>";
			} else {
				echo "<li class='list-group-item list-group-item-info'>Questionnaire</li>";
			}

		?>
		<li class="list-group-item bg-danger">Logout</li>
	</ul>

	<?php
echo $id;
$test = base64_encode($id);
echo "----"; 
echo $test;
echo "----"; 
echo base64_decode($test);
echo "----"; 
echo $username;
echo var_dump($staff);
?>
	</div>

	</body>


</html>