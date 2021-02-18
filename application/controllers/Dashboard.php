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
		$this->load->model('Questionnaire_model');
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
		$title = $this->input->post("title");
		$forename = $this->input->post("forename");
		$surname = $this->input->post("surname");
		$birthday = $this->input->post("birthday");
		$gender = $this->input->post("gender");
		$maritalStatus = $this->input->post("maritalStatus");
		$height = $this->input->post("height");
		$weight = $this->input->post("weight");
		$occupation = $this->input->post("occupation");
		// $title, $forename, $surname, $birthday, 
		// $gender, $maritalStatus, $height, $weight, $occupation

		$this->Questionnaire_model->getBasicInfo(base64_decode($userID),$title, $forename, $surname, $birthday, 
		$gender, $maritalStatus, $height, $weight, $occupation);

		$this->dataLoad($userID);
	}
	public function contactInfoSave($userID) 
	{
		$data['appName'] = $this->Dashboard_model->getName();
		$data['id'] = base64_decode($userID);
		$data['username'] = $this->Dashboard_model->getUsername($data['id']);
		$data['staff'] = $this->Dashboard_model->checkAccountType($data['username']);

		$this->load->view('header', $data);
		$this->load->view('questionnaire', $data);
	}
	public function emergencyContactInfoSave($userID) 
	{
		$data['appName'] = $this->Dashboard_model->getName();
		$data['id'] = base64_decode($userID);
		$data['username'] = $this->Dashboard_model->getUsername($data['id']);
		$data['staff'] = $this->Dashboard_model->checkAccountType($data['username']);

		$this->load->view('header', $data);
		$this->load->view('questionnaire', $data);
	}
}