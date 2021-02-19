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
    public function alcoholQuestions() 
    {
        return $this->getAlcoholQuestions();
    }
    private function getAlcoholQuestions()
    {
        // sql statement in full
//         SELECT alcohol_questions.GUID, alcohol_questions.Question, 
//         alcohol_options.response0, alcohol_options.response1, 
//         alcohol_options.response2, alcohol_options.response3, 
//         alcohol_options.response4
//         FROM alcohol_questions
//         JOIN alcohol_options ON alcohol_options.GUID = alcohol_questions.optionsid
           $this->db->select("alcohol_questions.GUID, alcohol_questions.Question, 
           alcohol_options.response0, alcohol_options.response1, 
           alcohol_options.response2, alcohol_options.response3, 
           alcohol_options.response4"); 
           $this->db->from('alcohol_questions');
           $this->db->join('alcohol_options', 'alcohol_options.GUID = alcohol_questions.optionsid');

           $query = $this->db->get();
           return $query;
    }

    
    public function existingBasicInfo($id)
    {
        //function to get all existing basic info from the users table
        //return the result for later use
        return $this->getExistingBasicInfo($id);
    }
    private function getExistingBasicInfo($id) 
    {
        //sql statement to get all existing basic info from user
        $this->db->select('title, firstname, surname, dob, gender, marital_status, height, weight, occupation');
        //where $id = GUID 
        $this->db->where('GUID', $id);
        //from the users table
        $query = $this->db->get('users');
        return $query;
        
    }
    public function existingContactInfo($id) 
    {
        //function to get all existing contact info from the users table
        //return the result for later use
        return $this->getExistingContactInfo($id);
    }
    private function getExistingContactInfo($id) 
    {
        //sql statement to get all existing contact info from user
        $this->db->select('address, postcode, mobile, home_telephone, SMS_YN, email_yn');
        //where $id = GUID 
        $this->db->where('GUID', $id);
        //from the users table
        $query = $this->db->get('users');
        return $query;
    }
    public function existingKinInfo($id) 
    {
        //function to get all existing kin info from the users table
        //return the result for later use
        return $this->getExistingKinInfo($id);
    }
    private function getExistingKinInfo($id) 
    {
        //sql statement to get all existing kin info from user
        $this->db->select('kin_name, kin_relationship, kin_telephone');
        //where $id = GUID 
        $this->db->where('GUID', $id);
        //from the users table
        $query = $this->db->get('users');
        return $query;
        
    }
    public function getBasicInfo($id, $title, $forename, $surname, $birthday, 
    $gender, $maritalStatus, $height, $weight, $occupation) 
    {
        $check = $this->setBasicInfo($id, $title, $forename, $surname, $birthday, 
        $gender, $maritalStatus, $height, $weight, $occupation);

        return $check;
    }
    public function getContactInfo($id, $address, $postcode, $mobileNumber, $homeNumber, $SMSyn, $emailyn) 
    {
        $check = $this->setContactInfo($id, $address, $postcode, $mobileNumber, $homeNumber, $SMSyn, $emailyn);

        return $check; 
    }
    public function getKinInfo($id, $name, $relationship, $telephone) 
    {
        $check = $this->setKinInfo($id, $name, $relationship, $telephone);

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
    private function setContactInfo ($id, $address, $postcode, $mobileNumber, $homeNumber, $SMSyn, $emailyn)
    {
        $this->db->set('address', $address);
        $this->db->set('postcode', $postcode);
        $this->db->set('mobile', $mobileNumber);
        $this->db->set('home_telephone', $homeNumber);
        $this->db->set('SMS_YN', $SMSyn);
        $this->db->set('email_yn', $emailyn);

        $this->db->where('GUID', $id);
        $this->db->update('users');

        //check whether update statement has been executed
        if ($this->db->affected_rows() != 0) {
            return true;
        } else {
            return false;
        }
    }
    private function setKinInfo($id, $name, $relationship, $telephone)
    {
        $this->db->set('kin_name', $name);
        $this->db->set('kin_relationship', $relationship);
        $this->db->set('kin_telephone', $telephone);

        $this->db->where('GUID', $id);
        $this->db->update('users');

        //check whether update statement has been executed
        if ($this->db->affected_rows() != 0) {
            return true;
        } else {
            return false;
        }
    }


    //questionnaire

    public function saveMedication($id, $medicationYN, $firstMedicationName, $firstMedicationDosage, $firstMedicationDuration,
    $secondMedicationName, $secondMedicationDosage, $secondMedicationDuration,
    $thirdMedicationName, $thirdMedicationDosage, $thirdMedicationDuration) 
    {

        $check = sizeof($this->checkMedicationExists($id));
        if ($check == 0) {
            //call insert query
            $this->insertMedication($id, $medicationYN, $firstMedicationName, $firstMedicationDosage, $firstMedicationDuration,
            $secondMedicationName, $secondMedicationDosage, $secondMedicationDuration,
            $thirdMedicationName, $thirdMedicationDosage, $thirdMedicationDuration);
        } else {
            //call update query
            $this->updateMedication($id, $medicationYN, $firstMedicationName, $firstMedicationDosage, $firstMedicationDuration,
            $secondMedicationName, $secondMedicationDosage, $secondMedicationDuration,
            $thirdMedicationName, $thirdMedicationDosage, $thirdMedicationDuration);
        }
    }
    private function checkMedicationExists($id)
    {
        //sql statement for username password
        $this->db->select('userid');
        //where email = $email
        $this->db->where('userid' , $id);
        //from the users table
        $query = $this->db->get('medication');
        //returns query result
        return $query->result();

    }
    private function insertMedication($id, $medicationYN, $firstMedicationName, $firstMedicationDosage, $firstMedicationDuration,
    $secondMedicationName, $secondMedicationDosage, $secondMedicationDuration,
    $thirdMedicationName, $thirdMedicationDosage, $thirdMedicationDuration)
    {
        $this->db->set('userid', $id);
        $this->db->set('Medication_YN', $medicationYN);

        $this->db->set('Medication_1', $firstMedicationName);
        $this->db->set('medication_dosage_1', $firstMedicationDosage);
        $this->db->set('medication_frequency_1', $firstMedicationDuration);

        $this->db->set('Medication_2', $secondMedicationName);
        $this->db->set('medication_dosage_2', $secondMedicationDosage);
        $this->db->set('medication_frequency_2', $secondMedicationDuration);

        $this->db->set('Medication_3', $thirdMedicationName);
        $this->db->set('medication_dosage_3', $thirdMedicationDosage);
        $this->db->set('medication_frequency_3', $thirdMedicationDuration);

        $this->db->insert('medication');
        

        //check whether insert statement has been executed
        if ($this->db->affected_rows() != 0) {
            return true;
        } else {
            return false;
        }

    }
    private function updateMedication($id, $medicationYN, $firstMedicationName, $firstMedicationDosage, $firstMedicationDuration,
    $secondMedicationName, $secondMedicationDosage, $secondMedicationDuration,
    $thirdMedicationName, $thirdMedicationDosage, $thirdMedicationDuration) 
    {
        $this->db->set('Medication_YN', $medicationYN);

        $this->db->set('Medication_YN', $firstMedicationName);
        $this->db->set('Medication_YN', $firstMedicationDosage);
        $this->db->set('Medication_YN', $firstMedicationDuration);

        $this->db->set('Medication_YN', $secondMedicationName);
        $this->db->set('Medication_YN', $secondMedicationDosage);
        $this->db->set('Medication_YN', $secondMedicationDuration);

        $this->db->set('Medication_YN', $thirdMedicationName);
        $this->db->set('Medication_YN', $thirdMedicationDosage);
        $this->db->set('Medication_YN', $thirdMedicationDuration);

        $this->db->where('userid', $id);
        $this->db->update('medication');
        

        //check whether insert statement has been executed
        if ($this->db->affected_rows() != 0) {
            return true;
        } else {
            return false;
        }

    }
}