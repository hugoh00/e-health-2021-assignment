<?php
class Welcome_model extends CI_Model {
    public function __construct()
	{
		parent::__construct();
		$this->load->database;
	}

    public function getBasicInfo($id, $title, $forename, $surname, $birthday, 
    $gender, $maritalStatus, $height, $weight, $occupation) 
    {
        $this->db->set('title', $title);
        $this->db->set('forename', $forename);
        $this->db->set('surname', $surname);
        $this->db->set('dob', $birthday);
        $this->db->set('gender', $gender);
        $this->db->set('marital_status', $maritalStatus);
        $this->db->set('height', $height);
        $this->db->set('weight', $weight);
        $this->db->set('occupation', $occupation);

        $this->db->where('GUID', $id);
        $this->db->update('users');
    }
}