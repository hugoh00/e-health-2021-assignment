<?php
class Welcome_model extends CI_Model {
    public function __construct()
	{
		parent::__construct();
        //loading the database up
		$this->load->database;
	}
    public function getName()
    {
        //returning application name
        $appName = "E-Health";
        return $appName;
    }
    private function getMatchingUsernamePassword($user, $psword) 
    {
        //sql statement for username password
        $this->db->select('username, password');
        //where username = $user AND password = $password
        $this->db->where('username' , $user);
        //from the users table
        $query = $this->db->get('users');

        foreach($query->result() as $row) {
            if ($row->username === $user && $row->password === $psword) 
            {
                return true;
            }
        }
        return false;
    }
    // seperate wheres as you could have a unique email but matching username
    private function getMatchingEmail($email)
    {
        //sql statement for username password
        $this->db->select('email');
        //where email = $email
        $this->db->where('email' , $email);
        //from the users table
        $query = $this->db->get('users');
        //returns query result
        foreach($query->result() as $row) {
            if ($row->email === $email) 
            {
                return true;
            }
        }
        return false;
    }
    private function getMatchingUsername($username) 
    {
        //sql statement for username 
        $this->db->select('username');
        //where username = $user 
        $this->db->where('username' , $username);
        //from the users table
        $query = $this->db->get('users');
        //returns query result
        foreach($query->result() as $row) {
            if ($row->username === $username) 
            {
                return true;
            }
        }
        return false;
    }
    private function insertNewUser($email, $username, $password) 
    {
        $this->db->set('username', $username);
        $this->db->set('password', $password);
        $this->db->set('email', $email);
        $this->db->insert('users');

        //check whether insert statement has been executed
        if ($this->db->affected_rows() != 0) {
            return true;
        } else {
            return false;
        }
    }
    public function checkLoginDetails($user, $psword) 
    {
        //boolean to return
        //calling function to access the database
        return $this->getMatchingUsernamePassword($user, $psword);
        
    }
    public function checkRegistrationDetails($email, $username, $password) {
        //boolean to return
        $valid = false;
        //calling function to access the database
        $emailCheck = $this->getMatchingEmail($email);
        $usernameCheck = $this->getMatchingUsername($username);

        //if no records exist we can now attempt to insert into the db
        if($emailCheck == false && $usernameCheck == false) {
            if ($this->insertNewUser($email, $username, $password)) {
                $valid = true;
            }
        }
        return $valid;
    }
}
