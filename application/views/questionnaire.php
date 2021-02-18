
<body style="background-color: #00cc00">
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
	<?php
	//set all basic info with a loop round data passed in from a query
	foreach ($existingBasicInfo->result() as $row) {
		// set variables to populate fields
		// $title, $forename, $surname, $birthday, 
		// $gender, $maritalStatus, $height, $weight, $occupation
		$title = $row->title;
		$forename = $row->firstname;
		$surname = $row->surname;
		$surname = $row->surname;
		$birthday = $row->dob;
		$gender = $row->gender;
		$maritalStatus = $row->marital_status;
		$height = $row->height;
		$weight = $row->weight;
		$occupation = $row->occupation;

		//title check
		if ($title == "Mr") {
			$mrSelected ="selected";
		} else if ($title == "Mrs") {
			$mrsSelected ="selected";
		} else if ($title == "Ms") {
			$msSelected ="selected";
		} else {
			$titleotherSelected ="selected";
		}
		//gender check
		if ($gender == "Male") {
			$maleSelected = "selected";
		} else if ($gender == "Female") {
			$femaleSelected = "selected";
		} else {
			$genderotherSelected = "selected";
		}
		//marital status check
		if ($maritalStatus == "Married") {
			$marriedChecked = "checked";
		} else if ($maritalStatus == "Single") {
			$singleChecked = "checked";
		} else {
			$maritalOtherChecked = "checked";
		}
	}
	?>
	<div class="container-fluid">
		<h1>Questionnaire</h2>

		<!-- Basic Information Form -->
		<div class="container-fluid" style="background-color:aliceblue; padding-top:5px; padding-bottom:5px;">  
				
			<form id="basicInfo" name="basicInfo" action="<?php echo base_url("index.php/basicInfo/" . base64_encode($id)); ?>" method="post">
			<h4>Basic Information</h4>
			<!-- Title -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="title">Title:</label>
				<div class="col-sm-9">
					<select class="form-control" style="width:25%" id="title" name="title">
						<option <?php echo $mrSelected ?>>Mr</option>
						<option <?php echo $mrsSelected ?>>Mrs</option>
						<option <?php echo $msSelected ?>>Ms</option>
						<option <?php echo $titleotherSelected ?>>Other</option>
					</select>
				</div>
			</div>
			<!-- forename -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="forename">Forename:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="forename" id="forename" value="<?php echo $forename ?>" placeholder="Enter Forename">
				</div>
			</div>
			<!-- surname -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="surname">Surname:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="surname" id="surname" value="<?php echo $surname ?>" placeholder="Enter Surname">
				</div>
			</div>
			<!-- date of birth -->
			<div class="form-group row ">
				<label class="col-sm-3 col-form-label" for="birthday">Birthday:</label>
				<div class="col-sm-9">
					<input type="date" id="birthday" name="birthday" value="<?php echo $birthday ?>">
				</div>
			</div>
			<!-- Gender -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="gender">Gender:</label>
				<div class="col-sm-9">
					<select class="form-control" style="width:25%" id="gender" name="gender">
						<option <?php echo $maleSelected ?> value="Male">Male</option>
						<option <?php echo $femaleSelected ?> value="Female">Female</option>
						<option <?php echo $genderotherSelected ?> value="Other">Other</option>
					</select>
				</div>
			</div>
			<!-- marital status -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label">Marital Status:</label>
				<div class="col-sm-9">
					<div class="form-check form-check-inline">
						<label class="form-check-label">
						<input type="checkbox" id="maritalStatus" name="maritalStatus" 
						<?php echo $marriedChecked ?> class="form-check-input" value="Married">Married
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
						<input type="checkbox" id="maritalStatus" name="maritalStatus" 
						<?php echo $singleChecked ?> class="form-check-input" value="Single">Single
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
						<input type="checkbox" id="maritalStatus" name="maritalStatus" 
						<?php echo $maritalOtherChecked ?> class="form-check-input" value="Other">Other
						</label>
					</div>
				</div>
			</div>
			<!-- height -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="height">Height in cm:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="height" id="height" value="<?php echo $height ?>" placeholder="Enter Height (cm)">
				</div>
			</div>
			<!-- weight -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="weight">Weight in lb:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="weight" id="weight" value="<?php echo $weight ?>" placeholder="Enter Weight (lb)">
				</div>
			</div>
			<!-- occupation -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="occupation">Occupation:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="occupation" id="occupation" value="<?php echo $occupation ?>" placeholder="Enter Occupation">
				</div>
			</div>

			<button class="btn bg-warning" type="submit" name="basicInfoSave" id="basicInfoSave" value="basicInfoSave">Save</button>
			</form>
		</div>

		<br>

		<?php
		//set all contact info with a loop round data passed in from a query
		foreach ($existingContactInfo->result() as $row) {
			// set variables to populate fields
			// $address, $postcode, $mobileNumber, $homeNumber, $SMSyn, $emailyn
			$address = $row->address;
			$postcode = $row->postcode;
			$mobileNumber = $row->mobile;
			$homeNumber = $row->home_telephone;
			$SMSyn = $row->SMS_YN;
			$emailyn = $row->email_yn;

			//sms check
			if ($SMSyn == "Y") {
				$smsYesChecked = "checked";
			} else if ($SMSyn == "N") {
				$smsNoChecked = "checked";
			} 
			//email check
			if ($emailyn == "Y") {
				$emailYesChecked = "checked";
			} else if ($emailyn == "N") {
				$emailNoChecked = "checked";
			} 
		}
	?>
		<!-- Location and Number Contact Details form -->
		<div class="container-fluid" style="background-color:aliceblue; padding-top:5px; padding-bottom:5px;">  
				
			<form id="contactDetails" name="contactDetails" action="<?php echo base_url("index.php/contactInfo/" . base64_encode($id)); ?>" method="post">
			<h4>Contact Information</h4>
			<!-- address -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="address">Address:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="address" id="address" value="<?php echo $address ?>" placeholder="Enter Address">
				</div>
			</div>
			<!-- postcode -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="postcode">Postcode:</label>
				<div class="col-sm-9">
					<input type="text" pattern="[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}"
					 class="form-control" name="postcode" id="postcode" value="<?php echo $postcode ?>" placeholder="Enter Postcode">
				</div>
			</div>
			<h6>Phone Numbers:</h6>
			<!-- mobile number -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="mobileNumber">Mobile:</label>
				<div class="col-sm-9">
					<input type="text" 
					 class="form-control" name="mobileNumber" id="mobileNumber" value="<?php echo $mobileNumber ?>" placeholder="Enter Mobile Number">
				</div>
			</div>
			<!-- home number -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="homeNumber">Home:</label>
				<div class="col-sm-9">
					<input type="text" 
					class="form-control" name="homeNumber" id="homeNumber" value="<?php echo $homeNumber ?>" placeholder="Enter Home Telephone Number">
				</div>
			</div>

			<!-- sms yn -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label">Receive SMS:</label>
				<div class="col-sm-9">
					<div class="form-check form-check-inline">
						<label class="form-check-label">
						<input type="checkbox" id="SMSyn" name="SMSyn" 
						<?php echo $smsYesChecked ?> class="form-check-input" value="Y">Yes
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
						<input type="checkbox" id="SMSyn" name="SMSyn" 
						<?php echo $smsNoChecked ?> class="form-check-input" value="N">No
						</label>
					</div>
				</div>
			</div>
			<!-- email yn -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label">Receive Emails:</label>
				<div class="col-sm-9">
					<div class="form-check form-check-inline">
						<label class="form-check-label">
						<input type="checkbox" id="emailyn" name="emailyn" 
						<?php echo $emailYesChecked ?> class="form-check-input" value="Y">Yes
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
						<input type="checkbox" id="emailyn" name="emailyn" 
						<?php echo $emailNoChecked ?> class="form-check-input" value="N">No
						</label>
					</div>
				</div>
			</div>

			<button class="btn bg-warning" type="submit" name="contactDetailsSave" id="contactDetailsSave" value="contactDetailsSave">Save</button>
			</form>
		</div>

		<br>
		<?php
		//set all kin contact info with a loop round data passed in from a query
		foreach ($existingKinInfo->result() as $row) {
			// set variables to populate fields
			// $kin_name, $kin_relationship, $kin_telephone
			$kinName = $row->kin_name;
			$kinRelationship = $row->kin_relationship;
			$kinNumber = $row->kin_telephone;
		}
	?>

		<!-- Kin Relationship Contact Details form -->
		<div class="container-fluid" style="background-color:aliceblue; padding-top:5px; padding-bottom:5px;">  
				
			<form id="kinInfo" name="kinInfo" action="<?php echo base_url("index.php/emergencyContactInfo/" . base64_encode($id)); ?>" method="post">
			<h4>Emergency Contact Information</h4>
			<!-- kin name -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="kinName">Full Name:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="kinName" id="kinName" value="<?php echo $kinName ?>" placeholder="Enter Full Name">
				</div>
			</div>
			<!-- kin relationship -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="kinRelationship">Relationship:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="kinRelationship" id="kinRelationship" value="<?php echo $kinRelationship ?>" placeholder="Enter Relationship to Kin">
				</div>
			</div> 
			<!-- kin name -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="kinNumber">Phone Number:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="kinNumber" id="kinNumber" value="<?php echo $kinNumber ?>" placeholder="Enter Kin Telephone">
				</div>
			</div>
			<button class="btn bg-warning" type="submit" name="kinInfoSave" id="kinInfoSave" value="kinInfoSave">Save</button>
			</form>
		</div>

		<br>
	</div>

	</body>


</html>