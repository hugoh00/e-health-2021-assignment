<?php
class Dashboard_model extends CI_Model {
    public function __construct()
	{
		parent::__construct();
		$this->load->database;
	}
    public function getName()
    {
        //returning application name
        $appName = "'s E-Health Dashboard";
        return $appName;
    }

    public function getID($username) 
    {
        //calling private function to protect the sql statements
        return $this->idGet($username);
    }

    private function idGet($username) 
    {
        //sql statement to get accounts username
        $this->db->select('GUID');
        //where $username = username 
        $this->db->where('username', $username);
        //from the users table
        $query = $this->db->get('users');

        foreach ($query->result() as $row) 
        {
            $id = $row->GUID;
        }
        return $id;
    }
    public function getUsername($id) 
    {
        //calling private function to protect the sql statements
        return $this->usernameGet($id);
    }
    private function usernameGet($id)
    {
        //sql statement to get username from the ID
        $this->db->select('username');
        //where $id = GUID
        $this->db->where('GUID', $id);
        //from the users table
        $query = $this->db->get('users');

        foreach ($query->result() as $row) 
        {
            $username = $row->username;
        }
        return $username;
    }
    public function checkAccountType($username)
    {
        $valid = false;
        $check = sizeof($this->checkAccount($username));
        
        if($check == 1) {
            $valid = true;
        }
        return $valid;
    }
    private function checkAccount($username)
    {
        //sql statement to check accounts email
        $this->db->select('username');
        //where $username = username AND email is LIKE '%@ehealth.com'
        $this->db->where('username', $username);
        $this->db->like('email', 'ehealth.com');
        //from the users table
        $query = $this->db->get('users');
        return $query->result();
    }

    public function getBasicInfo($id, $title, $forename, $surname, $birthday, 
    $gender, $maritalStatus, $height, $weight, $occupation) 
    {
        $check = $this->setBasicInfo($id, $title, $forename, $surname, $birthday, 
        $gender, $maritalStatus, $height, $weight, $occupation);

        return $check;
    }
    private function setBasicInfo($id, $title, $forename, $surname, $birthday, 
    $gender, $maritalStatus, $height, $weight, $occupation)
    {
        $this->db->set('title', $title);
        $this->db->set('firstname', $forename);
        $this->db->set('surname', $surname);
        $this->db->set('dob', $birthday);
        $this->db->set('gender', $gender);
        $this->db->set('marital_status', $maritalStatus);
        $this->db->set('height', $height);
        $this->db->set('weight', $weight);
        $this->db->set('occupation', $occupation);

        $this->db->where('GUID', $id);
        $this->db->update('users');

        //check whether update statement has been executed
        if ($this->db->affected_rows() != 0) {
            return true;
        } else {
            return false;
        }
    }
}