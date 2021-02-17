
<body style="background-color: #2aa8e2">
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
						$questionnaire = base_url("index.php/questionnaireLoad/" . $indicator);
						$data = base_url("index.php/dataLoad/" . $indicator);
						echo "<a class='$active' href='$questionnaire'>Questionnaires</a>";
						echo "<a class='$class' href='$data'>Data</a>";
					} else {
						$questionnaire = base_url("index.php/questionnaireLoad/" . $indicator);
						echo "<a class='$active' href='$questionnaire'>Questionnaires</a>";
						
					}
				?>
				<!-- send to a view which confirms logout atm just sends back to login-->
				<a class="nav-item nav-link" href="<?php echo base_url(''); ?>">Logout</a>
			</div>
		</div>
	</nav>
	<div class="container-fluid">
		<h1>Questionnaire</h2>


		<div class="container-fluid" style="background-color:aliceblue; padding-top:5px; padding-bottom:5px;">  
				
			<form id="questionnaire" name="questionnaire" action="" method="post">
			<h4>Basic Information</h4>
			<!-- Title -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="title">Title:</label>
				<div class="col-sm-9">
					<select class="form-control" style="width:25%" id="title">
						<option>Mr</option>
						<option>Mrs</option>
						<option>Ms</option>
						<option>Other</option>
					</select>
				</div>
			</div>
			<!-- forename -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="forename">Forename:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="forename" id="forename" placeholder="Enter Forename">
				</div>
			</div>
			<!-- surname -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="surname">Surname:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="surname" id="surname" placeholder="Enter Surname">
				</div>
			</div>
			<!-- date of birth -->
			<div class="form-group row ">
				<label class="col-sm-3 col-form-label" for="birthday">Birthday:</label>
				<div class="col-sm-9">
					<input type="date" id="birthday" name="birthday">
				</div>
			</div>
			<!-- Gender -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="gender">Gender:</label>
				<div class="col-sm-9">
					<select class="form-control" style="width:25%"id="gender">
						<option>Male</option>
						<option>Female</option>
						<option>Other</option>
					</select>
				</div>
			</div>
			<!-- marital status -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label">Marital Status:</label>
				<div class="col-sm-9">
					<div class="form-check form-check-inline">
						<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="2">Married
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="1">Single
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="0">Other
						</label>
					</div>
				</div>
			</div>

			<button class="btn bg-warning" type="submit" name="basicInfoSave" id="basicInfoSave" value="basicInfoSave">Save</button>
			</form>
		</div>
	</div>

	</body>


</html>