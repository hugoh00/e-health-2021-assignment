
<style type="text/css">
.piechart {
  width: 50%; 
  min-height: 450px;
}
.chart {
  width: 100%; 
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
	  google.charts.load('current', {'packages':['bar']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawSmsynPiechart);
	  google.charts.setOnLoadCallback(drawEmailynPiechart);

	  google.charts.setOnLoadCallback(barchartAgeRange);
	  google.charts.setOnLoadCallback(barchartAlcoholQuestions);

	  google.charts.setOnLoadCallback(drawScatterAgebyExercise);

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


		// Set chart options
		var options = {'title':'Contacted by Email (Yes/No)', colors: ['#8e4585', '#C8A2C8']};

		// Instantiate and draw our chart, passing in some options.
		var chart = new google.visualization.PieChart(document.getElementById('piechart_emailyn'));
		chart.draw(data, options);
		}
		function barchartAgeRange() {
			<?php 
				$ageRange1830 = 0;
				$ageRange3150 = 0;
				$ageRange5170 = 0;
				$ageRange70plus = 0;
				foreach ($dob->result() as $row) 
				{
					$date = $row->dob;
					//calculating age
					$_age = floor((time() - strtotime($date)) / 31556926);	
					
					//putting them into the age range
					if ($_age >=18 && $_age <= 30) 
					{
						$ageRange1830 =  $ageRange1830 + 1;
					} else if ($_age >=31 && $_age <= 50) {
						$ageRange3150 =  $ageRange3150 + 1;
					} else if ($_age >=51 && $_age <= 70) {
						$ageRange5170 =  $ageRange5170 + 1;
					} else if ($_age > 70) {
						$ageRange70plus = $ageRange70plus + 1;
					}
				}
				echo <<<_END
			var data = google.visualization.arrayToDataTable([
				["Age Range", "Total Users", { role: "style" } ],
				["18-30", $ageRange1830, "#c8a2c8"],
				["31-50", $ageRange3150, "#b5a2c8"],
				["51-70", $ageRange5170, "#c8a2b5"],
				["70+", $ageRange70plus, "#a2c8b5"]
			]);
_END;
			?>
			var view = new google.visualization.DataView(data);
			view.setColumns([0, 1,
							{ calc: "stringify",
								sourceColumn: 1,
								type: "string",
								role: "annotation" },
							2]);

			var options = {
				title: "Age Groups of Users",
				bar: {groupWidth: "95%"},
				legend: { position: "none" },
			};
			var chart = new google.visualization.BarChart(document.getElementById("barchart_agerange"));
			chart.draw(view, options);
  		}

	// Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    	function drawScatterAgebyExercise() {
			var data = google.visualization.arrayToDataTable([
          ['Exercise Session Average Duration (minutes)', 'Age']
			<?php 
		$length = count($ageExercise);
		$x = 1;
		foreach ($ageExercise->result() as $row)
		{
			$date = $row->dob;
			//calculating age
			$_age = floor((time() - strtotime($date)) / 31556926);
			if($x == 1) {
				echo <<<_END
				,[$row->exercise_minutes, $_age]
_END;
			} else {
				echo <<<_END
				[$row->exercise_minutes, $_age]
_END;
			}
		}
		?>
        ]);

        var options = {
          title: 'Exercise Session Average Duration (minutes) vs. Age comparison',
          vAxis: {title: 'Age', minValue: 18, maxValue: 80},
          hAxis: {title: 'Exercise Session Average Duration (minutes)', minValue: 0, maxValue: 120},
          legend: 'none'
        };

        var chart = new google.visualization.ScatterChart(document.getElementById('scatterAgeExercise'));
		chart.draw(data, options);

		}

		function barchartAlcoholQuestions() {
			
				// ['Question 1', $response[0][0], $response[0][1], $response[0][2], $response[0][3], $response[0][4]]
			var data = google.visualization.arrayToDataTable([
          ['Question Number', 'Response 1', 'Response 2', 'Response 3','Response 4','Response 5'],
          ['Question 1',<?php echo $responses[0][0]?>, <?php echo $responses[0][1]?>, <?php echo $responses[0][2]?>, <?php echo $responses[0][3]?>, <?php echo $responses[0][4]?>],
		  ['Question 2',<?php echo $responses[1][0]?>, <?php echo $responses[1][1]?>, <?php echo $responses[1][2]?>, <?php echo $responses[1][3]?>, <?php echo $responses[1][4]?>],
		  ['Question 3',<?php echo $responses[2][0]?>, <?php echo $responses[2][1]?>, <?php echo $responses[2][2]?>, <?php echo $responses[2][3]?>, <?php echo $responses[2][4]?>],
		  ['Question 4',<?php echo $responses[3][0]?>, <?php echo $responses[3][1]?>, <?php echo $responses[3][2]?>, <?php echo $responses[3][3]?>, <?php echo $responses[3][4]?>],
		  ['Question 5',<?php echo $responses[4][0]?>, <?php echo $responses[4][1]?>, <?php echo $responses[4][2]?>, <?php echo $responses[4][3]?>, <?php echo $responses[4][4]?>],
		  ['Question 6',<?php echo $responses[5][0]?>, <?php echo $responses[5][1]?>, <?php echo $responses[5][2]?>, <?php echo $responses[5][3]?>, <?php echo $responses[5][4]?>],
		  ['Question 7',<?php echo $responses[6][0]?>, <?php echo $responses[6][1]?>, <?php echo $responses[6][2]?>, <?php echo $responses[6][3]?>, <?php echo $responses[6][4]?>],
		  ['Question 8',<?php echo $responses[7][0]?>, <?php echo $responses[7][1]?>, <?php echo $responses[7][2]?>, <?php echo $responses[7][3]?>, <?php echo $responses[7][4]?>],
		  ['Question 9',<?php echo $responses[8][0]?>, <?php echo $responses[8][1]?>, <?php echo $responses[8][2]?>, <?php echo $responses[8][3]?>, <?php echo $responses[8][4]?>],
		  ['Question 10',<?php echo $responses[9][0]?>,<?php echo $responses[8][1]?>, <?php echo $responses[9][2]?>, <?php echo $responses[8][3]?>, <?php echo $responses[9][4]?>]
        ]);
        var options = {
          chart: {
            title: 'Alcohol Question Responses'
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };
		
		var chart = new google.charts.Bar(document.getElementById('barchart_alcoholquestion'));

		chart.draw(data, google.charts.Bar.convertOptions(options));

  		}


		//makes sure graphs resize when user changes screen size
		$(window).resize(function(){
        	drawSmsynPiechart();
			drawEmailynPiechart();
			barchartAgeRange();
			barchartAlcoholQuestions();
			drawScatterAgebyExercise();
        });
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
				<div class="card text-black mb-3" style="max-width: 95%; background-color: #f5f5dc; border-color: black;"> 
					<div class="card-header"><h4>Pending Questionnaires</h4></div>
					<div class="card-body">
						<h3 id="activeN" class="card-title"><?php echo $pendingQuestionnaires ?></h3>
					</div>
				</div>
			</div>
			<div id="right-col" class="col-md-4">
				<div class="card text-black mb-3" style="max-width: 95%; background-color: #008080; border-color: black;"> 
					<div class="card-header"><h4>Accepted Questionnaires</h4></div>
					<div class="card-body">
						<h3 id="activeN" class="card-title"><?php echo $confirmedQuestionnaires ?></h3>
					</div>
				</div>
			</div>
					
		</div>
		<!--Div that will hold the pie chart-->
		<h2><small class="text-muted">Contact Preferences</small></h2>
		<div class="row">
			<div id="piechart_smsyn" class="piechart"></div>
			<div id="piechart_emailyn" class="piechart"></div>
		</div>
		<h2><small class="text-muted">Questionnaire</small></h2>
		<div class="row">
			<div id="barchart_agerange" class="chart"></div>
		</div>
		<div class="row">
			<div id="scatterAgeExercise" class="chart"></div>
		</div>
		<div class="row">
			<div id="barchart_alcoholquestion" class="chart"></div>
		</div>
		
	</div>
   

	

	</body>


</html>