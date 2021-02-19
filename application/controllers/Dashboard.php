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
		$data['appName'] = $this->Dashboard_model->getName();
		$data['username'] = $this->input->post("dshUser");
		$data['id'] = $this->Dashboard_model->getID($data['username']);
		$data['staff'] = $this->Dashboard_model->checkAccountType($data['username']);
		
        $this->load->view('header', $data);
		$this->load->view('dashboard', $data);
	}
	public function dashboardLoad($userID)
	{
		$data['appName'] = $this->Dashboard_model->getName();
		$data['id'] = base64_decode($userID);
		$data['username'] = $this->Dashboard_model->getUsername($data['id']);
		$data['staff'] = $this->Dashboard_model->checkAccountType($data['username']);
		
        $this->load->view('header', $data);
		$this->load->view('dashboard', $data);
	}
	public function questionnaireLoad($userID)
	{
		$data['appName'] = $this->Dashboard_model->getName();
		$data['id'] = base64_decode($userID);
		$data['username'] = $this->Dashboard_model->getUsername($data['id']);
		$data['staff'] = $this->Dashboard_model->checkAccountType($data['username']);

		$data['existingBasicInfo'] = $this->Dashboard_model->existingBasicInfo($data['id']);
		$data['existingContactInfo'] = $this->Dashboard_model->existingContactInfo($data['id']);
		$data['existingKinInfo'] = $this->Dashboard_model->existingKinInfo($data['id']);
		$data['alcoholQuestions'] = $this->Dashboard_model->alcoholQuestions();
		
		
		$this->load->view('header', $data);
		if($data['staff'] == true) {
			$this->load->view('completedQuestionnaires', $data);
		} else {
			$this->load->view('questionnaire', $data);
		}
		
	}
	public function dataLoad($userID) 
	{
		$data['appName'] = $this->Dashboard_model->getName();
		$data['id'] = base64_decode($userID);
		$data['username'] = $this->Dashboard_model->getUsername($data['id']);
		$data['staff'] = $this->Dashboard_model->checkAccountType($data['username']);
		
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
		//medication
		// $medicationYN
		// $firstMedicationName, $firstMedicationDosage, $firstMedicationDuration
		// $secondMedicationName, $secondMedicationDosage, $secondMedicationDuration
		// $thirdMedicationName, $thirdMedicationDosage, $thirdMedicationDuration
		$medicationYN = $this->input->post("medicationyn");
		if ($medicationYN == "N") {
			// save medication info now
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
		}
		

		//smoking
		// $smokingYN, $smokerType, $smokerAge, $smokerHelp
		$smokerYN = $this->input->post("smokeryn");
		if ($smokerYN == "N" || $smokerYN == "X") {
			// save smoker info now
		} else {

			$smokerType = $this->input->post("smokeType");
			$smokerAge = $this->input->post("smokingAge");
			$smokerHelp = $this->input->post("smokeHelp");
			// save smoking info

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

		//function checks whether they have a record if no -> insert if yes -> update

		//family medical history
		// $heartDiseaseYN, $heartDiseaseMember, $cancerYN, $cancerMember
		// $strokeYN, $strokeMember, $otherYN, $otherMember

		//update/insert family history

		//allergies
		// $allergies
		
		//lifestyle
		// $regExerciseYN, $exerciseLength, $exerciseDays, $diet

		$this->questionnaireLoad($userID);
	}
}