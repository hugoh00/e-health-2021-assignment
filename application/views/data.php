
<style type="text/css">
.chart {
  width: 50%; 
  min-height: 450px;
}
.row {
  margin:0 !important;
}
</style>
<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawSmsynPiechart);
	  google.charts.setOnLoadCallback(drawEmailynPiechart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawSmsynPiechart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'SMS');
        data.addColumn('number', 'Yes/NO');
       
		<?php $smsno = $totalUsers - $smsyn; ?>
		<?php echo "data.addRows([ ['Yes', $smsyn]]);" ?>
		<?php echo "data.addRows([ ['No', $smsno]]);" ?>

		//loop
		//

        // Set chart options
        var options = {'title':'Contacted by SMS (Yes/No)', colors: ['#8e4585', '#C8A2C8']};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('piechart_smsyn'));
        chart.draw(data, options);
      }
	  // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawEmailynPiechart() {

		// Create the data table.
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Email');
		data.addColumn('number', 'Yes/No');

		<?php $emailno = $totalUsers - $emailyn; ?>
		<?php echo "data.addRows([ ['Yes', $emailyn]]);" ?>
		<?php echo "data.addRows([ ['No', $emailno]]);" ?>

		//loop
		//

		// Set chart options
		var options = {'title':'Contacted by Email (Yes/No)', colors: ['#8e4585', '#C8A2C8']};

		// Instantiate and draw our chart, passing in some options.
		var chart = new google.visualization.PieChart(document.getElementById('piechart_emailyn'));
		chart.draw(data, options);
		}
    </script>


</head>
<body style="background-color: #b3ffe0">
<nav class="navbar navbar-expand-md bg-dark navbar-dark navbar-static-top">
	<a class="navbar-brand" href="#">E-Health Navigation</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
   		<span class="navbar-toggler-icon"></span>
	</button>	
		<div class = "collapse navbar-collapse" id="collapsibleNavbar">
			<div class="navbar-nav">
			
				<a class="nav-item nav-link" href="<?php echo base_url("index.php/dashboardLoad/" . base64_encode($id)); ?>">Dashboard</a>
					
				<?php
					$indicator = base64_encode($id);
					$class = "nav-item nav-link";
					$active = $class . " active";
					if($staff == true) {
						$questionnaire = base_url("index.php/completedQuestionnaireLoad/" . $indicator);
						$data = base_url("index.php/dataLoad/" . $indicator);
						echo "<a class='$class' href='$questionnaire'>Questionnaires</a>";
						echo "<a class='$active' href='$data'>Data</a>";
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
	<h1 class="display-1">E-Health <small class="text-muted">Data Centre</small></h1>
	<!-- row to hold the user status cards -->
	<div class="container" style="background-color:aliceblue; padding-top:5px; padding-bottom:10px;">
		<div class="row">    
			<div id="left-col" class="col-md-4">
				<div class="card text-black mb-3" style="max-width: 95%; background-color: #ffb6c1; border-color: black;"> 
					<div class="card-header"><h4>Total Users</h4></div>
					<div class="card-body">
						<h3 id="activeN" class="card-title"><?php echo $totalUsers ?></h3>
					</div>
				</div>
			</div>
			<div id="mid-col" class="col-md-4">
				<div class="card text-black mb-3" style="max-width: 95%; background-color: #ffb6c1; border-color: black;"> 
					<div class="card-header"><h4>Pending Questionnaires</h4></div>
					<div class="card-body">
						<h3 id="activeN" class="card-title"><?php echo $pendingQuestionnaires ?></h3>
					</div>
				</div>
			</div>
			<div id="right-col" class="col-md-4">
				<div class="card text-black mb-3" style="max-width: 95%; background-color: #ffb6c1; border-color: black;"> 
					<div class="card-header"><h4>Accepted Questionnaires</h4></div>
					<div class="card-body">
						<h3 id="activeN" class="card-title"><?php echo $confirmedQuestionnaires ?></h3>
					</div>
				</div>
			</div>
					
		</div>
		<!--Div that will hold the pie chart-->
		
		<div class="row">
			<div id="piechart_smsyn" class="chart"></div>
			<div id="piechart_emailyn" class="chart"></div>
		</div>
	</div>
   

	

	</body>


</html>