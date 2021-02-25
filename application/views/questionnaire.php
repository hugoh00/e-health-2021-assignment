</head>
<body style="background-color: #b3ffe0">
<!-- <fieldset disabled> </fieldset> -->
<?php
	if($staff == true || $questionnaireStatus == true) {
		$fieldsetBegin = "<fieldset disabled>";
		$fieldsetEnd = "</fieldset>";
	}
?>
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
						echo "<a class='$active' href='#'>Current Questionnaire</a>";
						echo "<a class='$class' href='$questionnaire'>Questionnaires</a>";
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
	<div class="container-fluid" style="background-color:#b3ffe0">
		<h1>Questionnaire</h1>
		<!-- Basic Information Form -->
		<div class="container-fluid" style="background-color:aliceblue; padding-top:5px; padding-bottom:5px;">  
		<?php echo "$fieldsetBegin"; ?>
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
					<input type="text" class="form-control" name="forename" id="forename" value="<?php echo $forename ?>" placeholder="Enter Forename" required>
				</div>
			</div>
			<!-- surname -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="surname">Surname:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="surname" id="surname" value="<?php echo $surname ?>" placeholder="Enter Surname" required>
				</div>
			</div>
			<!-- date of birth -->
			<div class="form-group row ">
				<label class="col-sm-3 col-form-label" for="birthday">Birthday:</label>
				<div class="col-sm-9">
					<input type="date" id="birthday" name="birthday" value="<?php echo $birthday ?>" required>
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
						<input type="radio" id="maritalStatus" name="maritalStatus" 
						<?php echo $marriedChecked ?> class="form-check-input" value="Married">Married
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
						<input type="radio" id="maritalStatus" name="maritalStatus" 
						<?php echo $singleChecked ?> class="form-check-input" value="Single">Single
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
						<input type="radio" id="maritalStatus" name="maritalStatus" 
						<?php echo $maritalOtherChecked ?> class="form-check-input" value="Other">Other
						</label>
					</div>
				</div>
			</div>
			<!-- height -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="height">Height in cm:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="height" id="height" value="<?php echo $height ?>" placeholder="Enter Height (cm)" required>
				</div>
			</div>
			<!-- weight -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="weight">Weight in lb:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="weight" id="weight" value="<?php echo $weight ?>" placeholder="Enter Weight (lb)" required>
				</div>
			</div>
			<!-- occupation -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="occupation">Occupation:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="occupation" id="occupation" value="<?php echo $occupation ?>" placeholder="Enter Occupation">
				</div>
			</div>

			<button class="btn" style="background-color: #f5f5dc;" type="submit" name="basicInfoSave" id="basicInfoSave" value="basicInfoSave">Save</button>
			</form>
			<?php echo "$fieldsetEnd"; ?>
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
		<?php echo "$fieldsetBegin"; ?>
				
			<form id="contactDetails" name="contactDetails" action="<?php echo base_url("index.php/contactInfo/" . base64_encode($id)); ?>" method="post">
			<h4 class="form-title">Contact Information</h4>
			<!-- address -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="address">Address:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="address" id="address" value="<?php echo $address ?>" placeholder="Enter Address"  required>
				</div>
			</div>
			<!-- postcode -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="postcode">Postcode:</label>
				<div class="col-sm-9">
					<input type="text" pattern="[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}"
					 class="form-control" name="postcode" id="postcode" value="<?php echo $postcode ?>" placeholder="Enter Postcode"  required>
				</div>
			</div>
			<h6>Phone Numbers:</h6>
			<!-- mobile number -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="mobileNumber">Mobile:</label>
				<div class="col-sm-9">
					<input type="text" 
					 class="form-control" name="mobileNumber" id="mobileNumber" value="<?php echo $mobileNumber ?>" placeholder="Enter Mobile Number"  required>
				</div>
			</div>
			<!-- home number -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="homeNumber">Home:</label>
				<div class="col-sm-9">
					<input type="text" 
					class="form-control" name="homeNumber" id="homeNumber" value="<?php echo $homeNumber ?>" placeholder="Enter Home Telephone Number" required>
				</div>
			</div>

			<!-- sms yn -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label">Receive SMS:</label>
				<div class="col-sm-9">
					<div class="form-check form-check-inline">
						<label class="form-check-label">
						<input type="radio" id="SMSyn" name="SMSyn" 
						<?php echo $smsYesChecked ?> class="form-check-input" value="Y">Yes
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
						<input type="radio" id="SMSyn" name="SMSyn" 
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
						<input type="radio" id="emailyn" name="emailyn" 
						<?php echo $emailYesChecked ?> class="form-check-input" value="Y">Yes
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
						<input type="radio" id="emailyn" name="emailyn" 
						<?php echo $emailNoChecked ?> class="form-check-input" value="N">No
						</label>
					</div>
				</div>
			</div>

			<button class="btn" style="background-color: #f5f5dc;" type="submit" name="contactDetailsSave" id="contactDetailsSave" value="contactDetailsSave">Save</button>
			</form>
		<?php echo "$fieldsetEnd"; ?>
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
				
		<?php echo "$fieldsetBegin"; ?>
			<form id="kinInfo" name="kinInfo" action="<?php echo base_url("index.php/emergencyContactInfo/" . base64_encode($id)); ?>" method="post">
			<h4 class="form-title">Emergency Contact Information</h4>
			<!-- kin name -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="kinName">Full Name:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="kinName" id="kinName" value="<?php echo $kinName ?>" placeholder="Enter Full Name" required>
				</div>
			</div>
			<!-- kin relationship -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="kinRelationship">Relationship:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="kinRelationship" id="kinRelationship" value="<?php echo $kinRelationship ?>" placeholder="Enter Relationship to Kin" required>
				</div>
			</div> 
			<!-- kin name -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="kinNumber">Phone Number:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="kinNumber" id="kinNumber" value="<?php echo $kinNumber ?>" placeholder="Enter Kin Telephone" required>
				</div>
			</div>
			<button class="btn" style="background-color: #f5f5dc;" type="submit" name="kinInfoSave" id="kinInfoSave" value="kinInfoSave">Save</button>
			</form>
		<?php echo "$fieldsetEnd"; ?>
		</div>

		<br>

		<!-- questionnaire form -->
		<div class="container-fluid" style="background-color:aliceblue; padding-top:5px; padding-bottom:5px;">  
				
		<?php echo "$fieldsetBegin"; ?>
			<form id="questions" name="questions" action="<?php echo base_url("index.php/questionnaire/" . base64_encode($id)); ?>" method="post">
			<h4 class="form-title">Questionnaire</h4>
			<!-- medication -->
			<?php
			//set all contact info with a loop round data passed in from a query
		foreach ($medication->result() as $row) {
			// set variables to populate fields
			// $medicationyn, 
			$medicationyn = $row->Medication_YN;

			$firstmedicationName = $row->Medication_1;
			$secondmedicationName = $row->Medication_2;
			$thirdmedicationName = $row->Medication_3;

			$firstmedicationDosage = $row->medication_dosage_1;
			$secondmedicationDosage = $row->medication_dosage_2;
			$thirdmedicationDosage = $row->medication_dosage_3;

			$firstmedicationTaken = $row->medication_frequency_1;
			$secondmedicationTaken = $row->medication_frequency_2;
			$thirdmedicationTaken = $row->medication_frequency_3;

			//medication check
			if ($medicationyn == "Y") {
				$medYesSelected = "selected";
			} else if ($medicationyn == "N") {
				$medNoSelected = "selected";
			} 
		}
		?>
			<h6 class="form-title">Medication:</h6>
			<!-- medication yn -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="medicationyn">Do you take Medication:</label>
				<div class="col-sm-9">
					<select class="form-control" style="width:25%" id="medicationyn" name="medicationyn">
						<option <?php echo $medYesSelected ?> value="Y">Yes</option>
						<option <?php echo $medNoSelected ?> value="N">No</option>
					</select>
				</div>
			</div>
			<!-- medication name, dosage, and how often you take it -->
			<div class="form-group" id="medicationInfo">
				<div class="form-row">
					<div class="col">
						<label>Medication Name</label>
					</div>
					<div class="col">
						<label>Medication Dosage</label>
					</div>
					<div class="col">
						<label>How often taken</label>
					</div>
				</div>
				<div class="form-row">
					<div class="col">
						<input type="text" class="form-control" name="firstmedicationName" id="firstmedicationName" 
						value="<?php echo $firstmedicationName ?>" placeholder="Enter Medication Name">
					</div>
					<div class="col">
						<input type="text" class="form-control" name="firstmedicationDosage" id="firstmedicationDosage" 
						value="<?php echo $firstmedicationDosage ?>" placeholder="Enter Medication Dosage">
					</div>
					<div class="col">
						<input type="text" class="form-control" name="firstmedicationTaken" id="firstmedicationTaken" 
						value="<?php echo $firstmedicationTaken ?>" placeholder="How often do you take the medication">
					</div>
				</div>
				<div class="form-row">
					<div class="col">
						<input type="text" class="form-control" name="secondmedicationName" id="secondmedicationName" 
						value="<?php echo $secondmedicationName ?>" placeholder="Enter Medication Name">
					</div>
					<div class="col">
						<input type="text" class="form-control" name="secondmedicationDosage" id="secondmedicationDosage" 
						value="<?php echo $secondmedicationDosage ?>" placeholder="Enter Medication Dosage">
					</div>
					<div class="col">
						<input type="text" class="form-control" name="secondmedicationTaken" id="secondmedicationTaken" 
						value="<?php echo $secondmedicationTaken ?>" placeholder="How often do you take the medication">
					</div>
				</div>
				<div class="form-row">
					<div class="col">
						<input type="text" class="form-control" name="thirdmedicationName" id="thirdmedicationName" 
						value="<?php echo $thirdmedicationName ?>" placeholder="Enter Medication Name">
					</div>
					<div class="col">
						<input type="text" class="form-control" name="thirdmedicationDosage" id="thirdmedicationDosage" 
						value="<?php echo $thirdmedicationDosage ?>" placeholder="Enter Medication Dosage">
					</div>
					<div class="col">
						<input type="text" class="form-control" name="thirdmedicationTaken" id="thirdmedicationTaken" 
						value="<?php echo $thirdmedicationTaken ?>" placeholder="How often do you take the medication">
					</div>
				</div>
			</div>
			<!-- smoking -->
			<h6 class="form-title" style="padding-top:5px;">Smoking:</h6>
			<?php
			foreach ($smoke->result() as $row) {
				$smokeryn = $row->smoke_status;
				$smokeType = $row->smoke_type;
				$smokingAge = $row->start_smoking;
				$smokeHelp = $row->quit_smoking;

				//smoker check
				if ($smokeryn == "Y") {
					$smokerYesSelected = "selected";
				} else if ($smokeryn == "N") {
					$smokerNoSelected = "selected";
				} else if ($smokeryn == "X") {
					$smokerExSelected = "selected";
				}

				//type check
				if ($smokeType == "cigarette") {
					$cigarette = "selected";
				} else if ($smokeType == "cigar") {
					$cigar = "selected";
				} else if ($smokeType == "e-cigarette") {
					$ecigarette = "selected";
				} else if ($smokeType == "pipe") {
					$pipe = "selected";
				}

				//smoker help
				if ($smokeHelp == "Y") {
					$smokerHelpYesSelected = "selected";
				} else if ($smokeHelp == "N") {
					$smokerHelpNoSelected = "selected";
				}
			}
			?>
			<!-- smoker yn -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="smokeryn">Do you Smoke:</label>
				<div class="col-sm-9">
					<select class="form-control" style="width:25%" id="smokeryn" name="smokeryn">
						<option <?php echo $smokerYesSelected ?> value="Y">Yes</option>
						<option <?php echo $smokerNoSelected ?> value="N">No</option>
						<option <?php echo $smokerExSelected ?> value="X">Ex-Smoker</option>
					</select>
				</div>
			</div>
			<!-- smoker info -->
			<div class="form-group" id="smokerInfo">
				<div class="form-group row">
					<label class="col-sm-3 col-form-label" for="smokeType">What do you use to Smoke:</label>
					<div class="col-sm-9">
						<select class="form-control" style="width:50%" id="smokeType" name="smokeType">
							<option <?php echo $cigarette ?> value="cigarette">Cigarette</option>
							<option <?php echo $cigar ?> value="cigar">Cigars</option>
							<option <?php echo $ecigarette ?> value="e-cigarette">E-cigarettes</option>
							<option <?php echo $pipe ?> value="pipe">Pipe</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 col-form-label" for="smokingAge">How old were you when you started smoking?:</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="smokingAge" id="smokingAge" 
						value="<?php echo $smokingAge ?>" placeholder="Enter Age you Started Smoking">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 col-form-label" for="smokeHelp">Do you want Help to quit Smoking:</label>
					<div class="col-sm-9">
						<select class="form-control" style="width:25%" id="smokeHelp" name="smokeHelp">
							<option <?php echo $smokerHelpYesSelected ?> value="Y">Yes</option>
							<option <?php echo $smokerHelpNoSelected ?> value="N">No</option>
						</select>
					</div>
				</div>
			</div>
			<!-- alcohol questions -->
			<?php
			$existingResponse = array();
			foreach($alcoholResponses->result() as $row) {
				$existingResponse[$row->questionid] = $row->response;
			}
			?>
			<table class="table table-hover">
				<thead class="thead-dark">
					<tr class="table-info">
						<th scope="col">#</th>
						<th scope="col">Question</th>
						<th scope="col"></th>
						<th scope="col"></th>
						<th scope="col">Scoring System</th>
						<th scope="col"></th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<!-- loop through the query result passed in to add questions etc -->
					<?php
						
						foreach ($alcoholQuestions->result() as $row) {
							//9 and 10 have 1 and 3 missing
							$checked = $existingResponse[$row->GUID];
							// now to see which was checked previously
							if ($checked == "response0") {
								$response0Checked = "checked";
							} else if ($checked == "response1") {

								$response1Checked = "checked";

							} else if ($checked == "response2") {

								$response2Checked = "checked";

							} else if ($checked == "response3") {

								$response3Checked = "checked";

							} else if ($checked == "response4") {

								$response4Checked = "checked";

							}
							echo "<tr>";
							echo "<th scope='row'>$row->GUID</th>";
							echo "<td>$row->Question</td>";
							echo "<td><input class='form-check-input' type='radio' name='question$row->GUID' id='question$row->GUID' value='response0' $response0Checked required>";
							echo "$row->response0</td>";
							if($row->GUID == 9 || $row->GUID == 10) {
								echo "<td>$row->response1</td>";
								echo "<td><input class='form-check-input' type='radio' name='question$row->GUID' id='question$row->GUID' value='response2' $response2Checked required>";
								echo "$row->response2</td>";
								echo "<td>$row->response3</td>";
							} else {
								echo "<td><input class='form-check-input' type='radio' name='question$row->GUID' id='question$row->GUID' value='response1' $response1Checked required>";
								echo "$row->response1</td>";
								echo "<td><input class='form-check-input' type='radio' name='question$row->GUID' id='question$row->GUID' value='response2' $response2Checked required>";
								echo "$row->response2</td>";
								echo "<td><input class='form-check-input' type='radio' name='question$row->GUID' id='question$row->GUID' value='response3' $response3Checked required>";
								echo "$row->response3</td>";
							}
							echo "<td><input class='form-check-input' type='radio' name='question$row->GUID' id='question$row->GUID' value='response4' $response4Checked required>";
							echo "$row->response4</td>";
							echo "</tr>";
						}
					?>
				</tbody>
			</table>
			<!-- family medical history -->
			<h6 class="form-title" style="padding-top:5px;">Family Medical History:</h6>
			<?php
			foreach ($medicalHistory->result() as $row) {
				$cancerMember = $row->has_cancer;
				$heartMember = $row->has_heart_disease;
				$strokeMember = $row->has_stroke;
				$otherMember = $row->has_other;

				if (strlen($cancerMember) == 0) {
					$cancerNo = "selected";
				} else {
					$cancerYes = "selected";
				}
				if (strlen($heartMember) == 0) {
					$heartNo = "selected";
				} else {
					$heartYes = "selected";
				}
				if (strlen($strokeMember) == 0) {
					$strokeNo = "selected";
				} else {
					$strokeYes = "selected";
				}
				if (strlen($otherMember) == 0) {
					$otherHistoryNo = "selected";
				} else {
					$otherHistoryYes = "selected";
				}
			}
			?>
			<table class="table table-hover">
				<thead class="thead-dark">
					<tr class="table-info">
						<th scope="col">Condition</th>
						<th scope="col">Affected</th>
						<th scope="col">Family Member</th>
					</tr>
				</thead>
				<tbody>
						<!-- cancer -->
						<tr>
							<th scope='row'>Cancer</th>
							<td><select class="form-control" id="canceryn" name="canceryn">
							<option <?php echo $cancerYes ?> value="Y">Yes</option>
							<option <?php echo $cancerNo ?> value="N">No</option>
							</select></td>
							<td>
							<div id="cancerMemberInfo">
							<input type="text" class="form-control" name="cancerMember" id="cancerMember" value="<?php echo $cancerMember ?>" placeholder="Enter Family Member">
							</div>
							</td>
						</tr>
						<!-- heart disease -->
						<tr>
							<th scope='row'>Heart Disease</th>
							<td><select class="form-control" id="heartyn" name="heartyn">
							<option <?php echo $heartYes ?> value="Y">Yes</option>
							<option <?php echo $heartNo ?> value="N">No</option>
							</select></td>
							<td>
							<div id="heartMemberInfo">
							<input type="text" class="form-control" name="heartMember" id="heartMember" value="<?php echo $heartMember ?>" placeholder="Enter Family Member">
							</div>
							</td>
						</tr>
						<!-- stroke -->
						<tr>
							<th scope='row'>Stroke</th>
							<td><select class="form-control" id="strokeyn" name="strokeyn">
							<option <?php echo $strokeYes ?> value="Y">Yes</option>
							<option <?php echo $strokeNo ?> value="N">No</option>
							</select></td>
							<td>
							<div id="strokeMemberInfo">
							<input type="text" class="form-control" name="strokeMember" id="strokeMember" value="<?php echo $strokeMember ?>" placeholder="Enter Family Member">
							</div>
							</td>
						</tr>
						<!-- other -->
						<tr>
							<th scope='row'>Other</th>
							<td><select class="form-control" id="otherHistoryYN" name="otherHistoryYN">
							<option <?php echo $otherHistoryYes ?> value="Y">Yes</option>
							<option <?php echo $otherHistoryNo ?> value="N">No</option>
							</select></td>
							<td>
							<div id="otherMemberInfo">
							<input type="text" class="form-control" name="otherMember" id="otherMember" value="<?php echo $otherMember ?>" placeholder="Enter Family Member">
							</div>
							</td>
						</tr>
				</tbody>
			</table>
			<!-- allergies -->
			<?php

			foreach ($allergy->result() as $row) {
				$allergy = $row->allergy_details;
				if (strlen($allergy) == 0) {
					$allergyNoSelected = "selected";
				} else {
					$allergyYesSelected = "selected";
				}
			}
			?>
			<h6 class="form-title" style="padding-top:5px;">Allergies:</h6>
			<!-- allergy yn -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="allergyYN">Do you have any Allergies:</label>
				<div class="col-sm-9">
					<select class="form-control" style="width:25%" id="allergyYN" name="allergyYN">
						<option <?php echo $allergyYesSelected ?> value="Y">Yes</option>
						<option <?php echo $allergyNoSelected ?> value="N">No</option>
					</select>
				</div>
			</div>
			<!-- allergy info -->
			<div class="form-group" id="allergyInfo">
				<div class="form-group">
				<input type="text" class="form-control" name="allergy" id="allergy" value="<?php echo $allergy ?>" placeholder="Enter Allergy/ies">
				</div>
			</div>

			<!-- lifestyle -->
			<?php

			foreach ($lifestyle->result() as $row) {
				$regExerciseYN = $row->exercise;
				$exerciseLength = $row->exercise_minutes;
				$exerciseDays = $row->exercise_days;
				$diet = $row->diet;

				if ($diet == "Good") {
					$GoodSelected = "selected";
				} else if ($diet == "Average") {
					$AverageSelected = "selected";
				} else if ($diet == "Poor") {
					$PoorSelected = "selected";
				} else if ($diet == "Vegetarian") {
					$VegetarianSelected = "selected";
				} else if ($diet == "Vegan") {
					$VeganSelected = "selected";
				} else if ($diet == "Low Fat") {
					$lowFatSelected = "selected";
				} else if ($diet == "Low Salt") {
					$lowSaltSelected = "selected";
				} 
				
			}
			?>
			<h6 class="form-title" style="padding-top:5px;">Lifestyle:</h6>
			<!-- regular exercise -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="regExerciseYN">Do you Regularly Exercise:</label>
				<div class="col-sm-9">
					<select class="form-control" style="width:25%" id="regExerciseYN" name="regExerciseYN">
						<option <?php echo $regExerciseYes ?> value="Y">Yes</option>
						<option <?php echo $regExerciseNo ?> value="N">No</option>
					</select>
				</div>
			</div>
			<!-- usual length -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="exerciseLength">How long is usual session:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="exerciseLength" id="exerciseLength" value="<?php echo $exerciseLength ?>" placeholder="Enter in Minutes">
				</div>
			</div>
			<!-- exercise days a week -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="exerciseDays">Enter many days a week you exercise:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="exerciseDays" id="exerciseDays" value="<?php echo $exerciseDays ?>" placeholder="Enter many days a week you exercise">
				</div>
			</div>
			<!-- rate diet -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="diet">How would you rate your Diet:</label>
				<div class="col-sm-9">
					<select class="form-control" style="width:50%" id="diet" name="diet">
						<option <?php echo $GoodSelected ?>>Good</option>
						<option <?php echo $AverageSelected ?>>Average</option>
						<option <?php echo $PoorSelected ?>>Poor</option>
						<option <?php echo $VegetarianSelected ?>>Vegetarian</option>
						<option <?php echo $VeganSelected ?>>Vegan</option>
						<option <?php echo $lowFatSelected ?>>Low Fat</option>
						<option <?php echo $lowSaltSelected ?>>Low Salt</option>
					</select>
				</div>
			</div>
			
			<button class="btn" style="background-color: #f5f5dc;" type="submit" name="questionnaireSave" id="questionnaireSave" value="questionnaireSave">Save</button>
			</form>
		<?php echo "$fieldsetEnd"; ?>
		</div>

		<br>

		<?php
			if($completed == true) {
				$endFormStart = "<fieldset disabled>";
				$endFormEnd = "</fieldset>";
			}
		?>

		<!-- submittion form -->
		<div class="container-fluid" style="background-color:aliceblue; padding-top:5px; padding-bottom:5px;">  
		<?php echo "$endFormStart"; ?>
		<form id="submissionform" name="submissionform" action="<?php echo base_url("index.php/submitQuestionnaire/" . base64_encode($id)); ?>" method="post">
			<?php 
			if ($staff == true) {
				$buttonInfo = "Sign Questionnaire Off";
				$buttonClass = "btn btn-lg btn-block";
				$style = "background-color: #008080;";
			} else {
				$buttonInfo = "Complete Questionnaire";
				$buttonClass = "btn btn-lg btn-block";
				$style = "background-color: #f5f5dc;";
			}
			if (isset($user)) {
				echo "<input type='hidden' name='questID' id='questID' value='$user'>";
			}
			
			?>
			<div class="text-center">
			<button class="<?php echo $buttonClass; ?>" style="<?php echo $style; ?>"type="submit" name="submission" id="submission" value="submission"><?php echo $buttonInfo; ?></button>
			</div>
			</form>
			<?php 
			if ($staff == true) {
				$buttonInfo = "Reject Questionnaire";
				$buttonClass = "btn btn-lg btn-block";
				$style = "background-color: #f5f5dc;";
			}
			if (isset($user)) {
				echo "<input type='hidden' name='questID' id='questID' value='$user'>";
			}
			if ($staff == true) {
				$url = base_url("index.php/rejectQuestionnaire/" . base64_encode($id));
			echo <<<_END
			<form id="rejectForm" name="rejectForm" action="$url" method="post">
			<div class="text-center">
			<button class="$buttonClass" style="$style" type="submit" name="reject" id="reject" value="reject">$buttonInfo</button>
			</div>
			</form>

_END;
			}
			?>
		<?php echo "$endFormEnd"; ?>
		</div>

		<br>
	</div>

	</body>


</html>
<script>

$("#medicationyn").change(function() {
  if ($(this).val() == "Y") {
    $('#medicationInfo').show();
  } else {
    $('#medicationInfo').hide();
  }
});
$("#medicationyn").trigger("change");

$("#smokeryn").change(function() {
  if ($(this).val() == "Y") {
    $('#smokerInfo').show();
  } else {
    $('#smokerInfo').hide();
  }
});
$("#smokeryn").trigger("change");

$("#canceryn").change(function() {
  if ($(this).val() == "Y") {
    $('#cancerMemberInfo').show();
  } else {
    $('#cancerMemberInfo').hide();
  }
});
$("#canceryn").trigger("change");

$("#heartyn").change(function() {
  if ($(this).val() == "Y") {
    $('#heartMemberInfo').show();
  } else {
    $('#heartMemberInfo').hide();
  }
});
$("#heartyn").trigger("change");

$("#strokeyn").change(function() {
  if ($(this).val() == "Y") {
    $('#strokeMemberInfo').show();
  } else {
    $('#strokeMemberInfo').hide();
  }
});
$("#strokeyn").trigger("change");

$("#otherHistoryYN").change(function() {
  if ($(this).val() == "Y") {
    $('#otherMemberInfo').show();
  } else {
    $('#otherMemberInfo').hide();
  }
});
$("#otherHistoryYN").trigger("change");

$("#allergyYN").change(function() {
  if ($(this).val() == "Y") {
    $('#allergyInfo').show();
  } else {
    $('#allergyInfo').hide();
  }
});
$("#allergyYN").trigger("change");

$(document).ready(function(){
    $('.check').click(function() {
        $('.check').not(this).prop('checked', false);
    });
});


</script>