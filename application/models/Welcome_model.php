<?php
class Welcome_model extends CI_Model {
    public function __construct()
	{
		parent::__construct();
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
        $this->db->where('password' , $psword);
        //from the users table
        $query = $this->db->get('users');
        return $query->result();
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
        return $query->result();
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
        return $query->result();
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
        $valid = false;
        //calling function to access the database
        $credentials = sizeof($this->getMatchingUsernamePassword($user, $psword));
        if ($credentials == 1) {

            $valid = true;
        }
        return $valid;
    }
    public function checkRegistrationDetails($email, $username, $password) {
        //boolean to return
        $valid = false;
        //calling function to access the database
        $emailCheck = sizeof($this->getMatchingEmail($email));
        $usernameCheck = sizeof($this->getMatchingUsername($username));

        //if no records exist we can now attempt to insert into the db
        if($emailCheck == 0 && $usernameCheck == 0) {
            if ($this->insertNewUser($email, $username, $password)) {
                $valid = true;
            }
        }
        return $valid;
    }
}
