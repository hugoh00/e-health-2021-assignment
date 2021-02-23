<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public $user;

	public function __construct()
	{
		parent::__construct();
		//loading url helper
		$this->load->helper('url');
		//loading the model
		$this->load->model('Dashboard_model');
	}
	public function index() {
		//loading the homepage of dashboard with data it needs to know
		$data['appName'] = $this->Dashboard_model->getName();
		$data['username'] = $this->input->post("dshUser");
		$data['id'] = $this->Dashboard_model->getID($data['username']);
		$data['staff'] = $this->Dashboard_model->checkAccountType($data['username']);
		
        $this->load->view('header', $data);
		$this->load->view('dashboard', $data);
	}
	public function dashboardLoad($userID)
	{
		//if the user wants to go back into dashboard from another page we cannot use the 
		//index as it uses a post from a certain pathway
		$data['appName'] = $this->Dashboard_model->getName();
		$data['id'] = base64_decode($userID);
		$data['username'] = $this->Dashboard_model->getUsername($data['id']);
		$data['staff'] = $this->Dashboard_model->checkAccountType($data['username']);
		
        $this->load->view('header', $data);
		$this->load->view('dashboard', $data);
	}
	public function questionnaireLoad($userID)
	{
		// load in the basics of the questionnaire
		// page title, user id, username, staff boolean, questionnairestatus boolean, completed boolean
		// questionnairestatus is whether they are pending approval or confirmed
		// completed is just whether they are confirmed
		$data['appName'] = $this->Dashboard_model->getName();
		$data['id'] = base64_decode($userID);
		$data['username'] = $this->Dashboard_model->getUsername($data['id']);
		$data['staff'] = $this->Dashboard_model->checkAccountType($data['username']);
		$data['questionnaireStatus'] = $this->Dashboard_model->checkStatus($data['id']);
		$data['completed'] = $this->Dashboard_model->completed($data['id']);

		// data for populating the questionnaire with values that already exist in the db for the user
		$data['existingBasicInfo'] = $this->Dashboard_model->existingBasicInfo($data['id']);
		$data['existingContactInfo'] = $this->Dashboard_model->existingContactInfo($data['id']);
		$data['existingKinInfo'] = $this->Dashboard_model->existingKinInfo($data['id']);

		//alcohol questions loaded into the webpage
		$data['alcoholQuestions'] = $this->Dashboard_model->alcoholQuestions();

		// more data to populate the questionnaire to populate inputs
		$data['medication'] = $this->Dashboard_model->medication($data['id']);
		$data['smoke'] = $this->Dashboard_model->smoke($data['id']);
		$data['alcoholResponses'] = $this->Dashboard_model->alcoholResponses($data['id']);
		$data['medicalHistory'] = $this->Dashboard_model->medicalHistory($data['id']);
		$data['allergy'] = $this->Dashboard_model->allergy($data['id']);
		$data['lifestyle'] = $this->Dashboard_model->lifestyle($data['id']);
		
		
		$this->load->view('header', $data);
		$this->load->view('questionnaire', $data);
			
	}
	public function questionnaireAuditLoad($staffID)
	{
		// Almost identical to questionnaireLoad around line 50

		$data['appName'] = $this->Dashboard_model->getName();
		$data['id'] = base64_decode($staffID);
		$data['username'] = $this->Dashboard_model->getUsername($data['id']);
		$data['staff'] = $this->Dashboard_model->checkAccountType($data['username']);

		//we now use the post from the table of questionnaires as our point for getting all 
		// questionnaire data relating to that particular user
		$data['user'] = $this->input->post("questID");

		$data['existingBasicInfo'] = $this->Dashboard_model->existingBasicInfo($data['user']);
		$data['existingContactInfo'] = $this->Dashboard_model->existingContactInfo($data['user']);
		$data['existingKinInfo'] = $this->Dashboard_model->existingKinInfo($data['user']);
		$data['alcoholQuestions'] = $this->Dashboard_model->alcoholQuestions();

		$data['medication'] = $this->Dashboard_model->medication($data['user']);
		$data['smoke'] = $this->Dashboard_model->smoke($data['user']);
		$data['alcoholResponses'] = $this->Dashboard_model->alcoholResponses($data['user']);
		$data['medicalHistory'] = $this->Dashboard_model->medicalHistory($data['user']);
		$data['allergy'] = $this->Dashboard_model->allergy($data['user']);
		$data['lifestyle'] = $this->Dashboard_model->lifestyle($data['user']);
		
		
		$this->load->view('header', $data);
		$this->load->view('questionnaire', $data);
	}
	public function completedQuestionnaireLoad($userID)
	{
		// loading basics of the webpage
		$data['appName'] = $this->Dashboard_model->getName();
		$data['id'] = base64_decode($userID);
		$data['username'] = $this->Dashboard_model->getUsername($data['id']);
		$data['staff'] = $this->Dashboard_model->checkAccountType($data['username']);

		//retrieving all questionnaires that are completed or pending approval of the admin
		$data['questionnaire'] = $this->Dashboard_model->retrieveQuestionnaires();

		$this->load->view('header', $data);
		$this->load->view('completedQuestionnaires', $data);
	}
	public function dataLoad($userID) 
	{
		$data['appName'] = $this->Dashboard_model->getName();
		$data['id'] = base64_decode($userID);
		$data['username'] = $this->Dashboard_model->getUsername($data['id']);
		$data['staff'] = $this->Dashboard_model->checkAccountType($data['username']);

		$data['totalUsers'] = $this->Dashboard_model->totalUsers();
		$data['pendingQuestionnaires'] = $this->Dashboard_model->totalPending();
		$data['confirmedQuestionnaires'] = $this->Dashboard_model->totalCompleted();
		
		$data['smsyn'] = $this->Dashboard_model->smsyn();
		$data['emailyn'] = $this->Dashboard_model->emailyn();
		$data['dob'] = $this->Dashboard_model->DOB();
		$data['ageExercise'] = $this->Dashboard_model->ageExercise();

		$data['responses'] = $this->Dashboard_model->responseScores();
		
        $this->load->view('header', $data);
		$this->load->view('data', $data);
	}

	public function basicInfoSave($userID) 
	{
		// $title, $forename, $surname, $birthday, 
		// $gender, $maritalStatus, $height, $weight, $occupation
		$title = $this->input->post("title");
		$forename = $this->input->post("forename");
		$surname = $this->input->post("surname");
		$birthday = $this->input->post("birthday");
		$gender = $this->input->post("gender");
		$maritalStatus = $this->input->post("maritalStatus");
		$height = $this->input->post("height");
		$weight = $this->input->post("weight");
		$occupation = $this->input->post("occupation");

		$this->Dashboard_model->getBasicInfo(base64_decode($userID),$title, $forename, $surname, $birthday, 
		$gender, $maritalStatus, $height, $weight, $occupation);

		$this->questionnaireLoad($userID);
	}
	public function contactInfoSave($userID) 
	{
		// $address, $postcode, $mobileNumber, $homeNumber, $SMSyn, $emailyn
		$address = $this->input->post("address");
		$postcode = $this->input->post("postcode");
		$mobileNumber = $this->input->post("mobileNumber");
		$homeNumber = $this->input->post("homeNumber");
		$SMSyn = $this->input->post("SMSyn");
		$emailyn = $this->input->post("emailyn");

		$this->Dashboard_model->getContactInfo(base64_decode($userID), $address, $postcode, $mobileNumber, $homeNumber, $SMSyn, $emailyn);

		$this->questionnaireLoad($userID);
	}
	public function emergencyContactInfoSave($userID) 
	{
		// $name, $relationship, $telephone
		$name = $this->input->post("kinName");
		$relationship = $this->input->post("kinRelationship");
		$telephone = $this->input->post("kinNumber");

		$this->Dashboard_model->getKinInfo(base64_decode($userID),$name, $relationship, $telephone);

		$this->questionnaireLoad($userID);
	}
	public function questionnaire($userID) 
	{
		//saving the main body of the questionnaire
		//could do this in smaller private functions but not got round to it
		// would tidy up this huge block of code into smaller easy to read blocks

		//medication
		// $medicationYN
		// $firstMedicationName, $firstMedicationDosage, $firstMedicationDuration
		// $secondMedicationName, $secondMedicationDosage, $secondMedicationDuration
		// $thirdMedicationName, $thirdMedicationDosage, $thirdMedicationDuration
		$medicationYN = $this->input->post("medicationyn");
		if ($medicationYN == "N") {
			// save medication info now
			// we save it empty as even when hidden the inputs could have some empty information
			$this->Dashboard_model->saveMedication(base64_decode($userID), $medicationYN, 
			"", "", "",
			"", "", "",
			"", "", "");
		} else {
			$firstMedicationName = $this->input->post("firstmedicationName");
			$firstMedicationDosage = $this->input->post("firstmedicationDosage");
			$firstMedicationDuration = $this->input->post("firstmedicationTaken");

			$secondMedicationName = $this->input->post("secondmedicationName");
			$secondMedicationDosage = $this->input->post("secondmedicationDosage");
			$secondMedicationDuration = $this->input->post("secondmedicationTaken");

			$thirdMedicationName = $this->input->post("thirdmedicationName");
			$thirdMedicationDosage = $this->input->post("thirdmedicationDosage");
			$thirdMedicationDuration = $this->input->post("thirdmedicationTaken");
			// save medication info
			$this->Dashboard_model->saveMedication(base64_decode($userID), $medicationYN, 
			$firstMedicationName, $firstMedicationDosage, $firstMedicationDuration,
			$secondMedicationName, $secondMedicationDosage, $secondMedicationDuration,
			$thirdMedicationName, $thirdMedicationDosage, $thirdMedicationDuration);
		}
		

		//smoking
		// $smokingYN, $smokerType, $smokerAge, $smokerHelp
		$smokerYN = $this->input->post("smokeryn");
		if ($smokerYN == "N" || $smokerYN == "X") {
			// save smoker info now
			$this->Dashboard_model->setSmoke(base64_decode($userID)
			,$smokerYN,"","","");
		} else {

			$smokerType = $this->input->post("smokeType");
			$smokerAge = $this->input->post("smokingAge");
			$smokerHelp = $this->input->post("smokeHelp");
			// save smoking info
			$this->Dashboard_model->setSmoke(base64_decode($userID)
			,$smokerYN, $smokerType, $smokerAge, $smokerHelp);

		}
		

		//alcohol use
		// variable is $QUESTIONnumber_Score
		// $oneScore, $twoScore, $threeScore, $fourScore, $fiveScore
		// $sixScore, $sevenScore, $eightScore, $nineScore, $tenScore

		$oneScore = $this->input->post("question1");
		$twoScore = $this->input->post("question2");
		$threeScore = $this->input->post("question3");
		$fourScore = $this->input->post("question4");
		$fiveScore = $this->input->post("question5");
		$sixScore = $this->input->post("question6");
		$sevenScore = $this->input->post("question7");
		$eightScore = $this->input->post("question8");
		$nineScore = $this->input->post("question9");
		$tenScore = $this->input->post("question10");
		$this->Dashboard_model->setAlcoholResponses(base64_decode($userID), $oneScore, $twoScore, $threeScore, $fourScore, $fiveScore,
    $sixScore, $sevenScore, $eightScore, $nineScore, $tenScore);

		//function checks whether they have a record if no -> insert if yes -> update

		//family medical history
		// $heartDiseaseYN, $heartDiseaseMember, $cancerYN, $cancerMember
		// $strokeYN, $strokeMember, $otherYN, $otherMember
		$cancerYN = $this->input->post("canceryn");
		$cancerMember = $this->input->post("cancerMember");

		$heartDiseaseYN = $this->input->post("heartyn");
		$heartDiseaseMember = $this->input->post("heartMember");

		$strokeYN = $this->input->post("strokeyn");
		$strokeMember = $this->input->post("strokeMember");

		$otherYN = $this->input->post("otheryn");
		$otherMember = $this->input->post("otherMember");

		if($cancerYN == "N") {
			$cancerMember = "";
		}
		if($heartDiseaseYN == "N") {
			$heartDiseaseMember = "";
		}
		if($strokeYN == "N") {
			$strokeMember = "";
		}
		if($otherYN == "N") {
			$otherMember = "";
		}
		//update/insert family history
		$this->Dashboard_model->setMedicalHistory(base64_decode($userID)
		, $cancerMember, $heartDiseaseMember, $strokeMember, $otherMember);

		//allergies
		// $allergies
		$allergyYN = $this->input->post("allergyYN");
		$allergies = $this->input->post("allergy");
		if ($allergyYN == "N") {
			$allergies = "";
		}
		$this->Dashboard_model->setAllergy(base64_decode($userID), $allergies);
		
		//lifestyle
		// $regExerciseYN, $exerciseLength, $exerciseDays, $diet

		$regExerciseYN = $this->input->post("regExerciseYN");
		$exerciseLength = $this->input->post("exerciseLength");
		$exerciseDays = $this->input->post("exerciseDays");
		$diet = $this->input->post("diet");

		$this->Dashboard_model->setLifestyle(base64_decode($userID), $regExerciseYN, $exerciseLength, $exerciseDays, $diet);


		$this->questionnaireLoad($userID);
	}
	// put a second variable into url status 
	// if staff true completed passed through
	// if false pending
	public function submitQuestionnaire($userID) 
	{
		$user =  $this->Dashboard_model->getUsername(base64_decode($userID));
		$privilege = $this->Dashboard_model->checkAccountType($user);
		$confirmed = "confirmed";
		$pending = "pending";

		if ($privilege == true) {
			$id = $this->input->post("questID");
			$check = $this->Dashboard_model->submitQuestionnaire($id, $confirmed);
		} else {
			$check = $this->Dashboard_model->submitQuestionnaire(base64_decode($userID), $pending);
		}

		if($check == true) {
			$this->dashboardLoad($userID);
		} else {
			echo $check;
		}

		

	}
}