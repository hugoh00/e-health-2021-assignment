<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		//loading url helper
		$this->load->helper('url');
		//loading the model
		$this->load->model('Welcome_model');
	}
	public function index()
	{
		//setting data to pass into the view
		$data['appName'] = $this->Welcome_model->getName();

		$this->load->view('welcome', $data);
	}
	public function signIn()
	{
		//collect values from the post
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		
		if ($this->Welcome_model->checkLoginDetails($username, $password)) {
			//if its true redirected to the dashboard controller/view	
			$data['appName'] = $this->Welcome_model->getName();
			$data['username'] = $username;
			$this->load->view('dashboardEntry', $data);
			
		} else {
			//send back into welcome with a error indicator 
			$data['appName'] = $this->Welcome_model->getName();
			$data['errorMessage'] = "Invalid Login. Please try again";

			$this->load->view('welcome', $data);
		}
	
	}
	public function registerAttempt()
	{
		//collect values from the post
		$regEmail = $this->input->post("regEmail");
		$regUsername = $this->input->post("regUsername");
		$regPassword = $this->input->post("regPassword");

		//call the model function to check the db
		//see whether the username and email are unique
		if ($this->Welcome_model->checkRegistrationDetails($regEmail, $regUsername, $regPassword)) {
			$this->index();
		} else {
			//send back into welcome with a error indicator 
			$data['appName'] = $this->Welcome_model->getName();
			$data['errorMessage'] = "Invalid Login. Please try again";

			$this->load->view('register', $data);
		}

	}
	public function registerLoad() 
	{
		// //setting data to pass into the view
		$data['appName'] = $this->Welcome_model->getName();
		//load up the register view
		$this->load->view('register', $data);
	}
}
