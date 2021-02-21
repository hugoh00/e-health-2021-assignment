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
						$questionnaireLink = base_url("index.php/completedQuestionnaireLoad/" . $indicator);
						$data = base_url("index.php/dataLoad/" . $indicator);
						echo "<a class='$active' href='$questionnaireLink'>Questionnaires</a>";
						echo "<a class='$class' href='$data'>Data</a>";
					} else {
						$questionnaireLink = base_url("index.php/questionnaireLoad/" . $indicator);
						echo "<a class='$active' href='$questionnaireLink'>Questionnaires</a>";
						
					}
				?>
				<!-- send to a view which confirms logout atm just sends back to login-->
				<a class="nav-item nav-link" href="<?php echo base_url(''); ?>">Logout</a>
			</div>
		</div>
	</nav>
	<div class="container" style="background-color:aliceblue; padding-top:5px; padding-bottom:5px;"> 

	<table class="table table-hover">
				<thead class="thead-dark">
					<tr class="table-info">
						<th scope="col">#</th>
						<th scope="col">Forename</th>
						<th scope="col">Surname</th>
						<th scope="col">Status</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<!-- loop through the query result passed in to add questions etc -->
					<?php
					// GUID firstname surname status
						
						foreach ($questionnaire->result() as $row) {
							if($row->status == "pending") {
								$buttonValue = "Review";
							} else {
								$buttonValue = "View";
							}
							
							$questionnaireLink = base_url("index.php/questionnaireAuditLoad/" . $indicator);
							echo "<form id='reviewView' action='$questionnaireLink' method='post'>";
							echo "<input type='hidden' name='questID' id='questID' value='$row->GUID'>";
							echo "<tr>";
							echo "<th scope='row' id='ID'>$row->GUID</th>";
							echo "<td id='forename'>$row->firstname</td>";
							echo "<td id='surname'>$row->surname</td>";
							echo "<td id='status'>$row->status</td>";
							echo "<td><button class='btn bg-warning' type='submit' name='viewReview' id='viewReview' value='viewReview'>$buttonValue</button><td>";
							echo "</tr>";
							echo "</form>";
						}
					?>
				</tbody>
			</table>
	</div>

	</body>


</html>


