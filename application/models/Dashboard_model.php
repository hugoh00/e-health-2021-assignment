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
        //setting return variable to false
        $valid = false;
        $check = sizeof($this->checkAccount($username));
        
        // if the user is part of the ehealth staff will be returned in the query size
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
        $this->db->like('email', 'ehealth.com', 'before');
        //from the users table
        $query = $this->db->get('users');
        return $query->result();
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
        //calling private function to use an sql update query
        $check = $this->setBasicInfo($id, $title, $forename, $surname, $birthday, 
        $gender, $maritalStatus, $height, $weight, $occupation);

        return $check;
    }
    public function getContactInfo($id, $address, $postcode, $mobileNumber, $homeNumber, $SMSyn, $emailyn) 
    {
        //calling private function to use an sql update query
        $check = $this->setContactInfo($id, $address, $postcode, $mobileNumber, $homeNumber, $SMSyn, $emailyn);

        return $check; 
    }
    public function getKinInfo($id, $name, $relationship, $telephone) 
    {
        //calling private function to use an sql update query
        $check = $this->setKinInfo($id, $name, $relationship, $telephone);

        return $check; 
    }
    private function setBasicInfo($id, $title, $forename, $surname, $birthday, 
    $gender, $maritalStatus, $height, $weight, $occupation)
    {
        //setting all basic info variables in the db table to the variables entered in the questionnaire
        $this->db->set('title', $title);
        $this->db->set('firstname', $forename);
        $this->db->set('surname', $surname);
        $this->db->set('dob', $birthday);
        $this->db->set('gender', $gender);
        $this->db->set('marital_status', $maritalStatus);
        $this->db->set('height', $height);
        $this->db->set('weight', $weight);
        $this->db->set('occupation', $occupation);

        //where the user id is matching their own record
        $this->db->where('GUID', $id);
        //update users table
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

        //where the user id is matching their own record
        $this->db->where('GUID', $id);
        //update users table
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

        //where the user id is matching their own record
        $this->db->where('GUID', $id);
        //update users table
        $this->db->update('users');

        //check whether update statement has been executed
        if ($this->db->affected_rows() != 0) {
            return true;
        } else {
            return false;
        }
    }

    // 
    //questionnaire
    // 

    // 
    //medication
    // 
    public function medication($id) 
    {
        // calling private function for the sql
        return $this->getMedication($id);

    }

    private function getMedication($id) 
    {
        // selecting all variables needed for the medication part of the questionnaire to populate if record exists
        // we dont select * as any updates to the table would cause unneccessary data to be loaded such as the GUID
        $this->db->select('Medication_YN, 
        Medication_1, medication_dosage_1, medication_frequency_1, 
        Medication_2, medication_dosage_2, medication_frequency_2, 
        Medication_3, medication_dosage_3, medication_frequency_3');
        $this->db->where('userid', $id);
        $query = $this->db->get('medication');

        return $query;

    }

    public function saveMedication($id, $medicationYN, $firstMedicationName, $firstMedicationDosage, $firstMedicationDuration,
    $secondMedicationName, $secondMedicationDosage, $secondMedicationDuration,
    $thirdMedicationName, $thirdMedicationDosage, $thirdMedicationDuration) 
    {
        //call a private function to check whether the user has a record already existing in the table
        $check = sizeof($this->checkMedicationExists($id));
        // if not insert query called if they do update query is called
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

        $this->db->select('userid');
        //where userid = $id
        $this->db->where('userid' , $id);
        //from the medication table
        $query = $this->db->get('medication');
        //returns query result
        return $query->result();

    }
    private function insertMedication($id, $medicationYN, $firstMedicationName, $firstMedicationDosage, $firstMedicationDuration,
    $secondMedicationName, $secondMedicationDosage, $secondMedicationDuration,
    $thirdMedicationName, $thirdMedicationDosage, $thirdMedicationDuration)
    {
        // Medication_YN, Medication_1, medication_dosage_1, medication_frequency_1, 
        // setting all variables again to their db counterparts
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
        // setting all variables again to their db counterparts
        // seperated into first, second, and third as to make it less confusing (very similar names)
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

        $this->db->where('userid', $id);
        $this->db->update('medication');
        

        //check whether insert statement has been executed
        if ($this->db->affected_rows() != 0) {
            return true;
        } else {
            return false;
        }

    }

    // 
    // Smoking
    // 
    public function smoke($id)
    {
        // private function to get all prexisting data for smoking
        return $this->getSmoke($id);
    }
    private function getSmoke($id)
    {
         // selecting all variables needed for the smoking part of the questionnaire to populate if record exists
        // we dont select * as any updates to the table would cause unneccessary data to be loaded such as the GUID
        
        $this->db->select('smoke_status, smoke_type, start_smoking, quit_smoking');
        $this->db->where('userid', $id);
        $query = $this->db->get('smoking');

        return $query;
    }
    public function setSmoke($id, $smoke_status, $smoke_type, $start_smoking, $quit_smoking)
    {
        //call a private function to check whether the user has a record already existing in the table
        $check = sizeof($this->checkSmokeExist($id));
         // if not insert query called if they do update query is called

        if ($check == 0) {
            //insert query
            $this->insertSmoke($id, $smoke_status, $smoke_type, $start_smoking, $quit_smoking);
        } else {
            // update query
            $this->updateSmoke($id, $smoke_status, $smoke_type, $start_smoking, $quit_smoking);
        }

    }
    private function checkSmokeExist($id)
    {
        $this->db->select('userid');
        //where userid = $id
        $this->db->where('userid' , $id);
        //from the smoking table
        $query = $this->db->get('smoking');
        //returns query result
        return $query->result();
    }
    private function updateSmoke($id, $smoke_status, $smoke_type, $start_smoking, $quit_smoking) 
    {
         // setting all variables again to their db counterparts
        $this->db->set('smoke_status', $smoke_status);
        $this->db->set('smoke_type', $smoke_type);
        $this->db->set('start_smoking', $start_smoking);
        $this->db->set('quit_smoking', $quit_smoking);

        // getting matching record to user to update
        $this->db->where('userid', $id);
        $this->db->update('smoking');
        

        //check whether insert statement has been executed
        if ($this->db->affected_rows() != 0) {
            return true;
        } else {
            return false;
        }

    }
    private function insertSmoke($id, $smoke_status, $smoke_type, $start_smoking, $quit_smoking) 
    {
         // setting all variables again to their db counterparts
        $this->db->set('userid', $id);
        $this->db->set('smoke_status', $smoke_status);
        $this->db->set('smoke_type', $smoke_type);
        $this->db->set('start_smoking', $start_smoking);
        $this->db->set('quit_smoking', $quit_smoking);

        $this->db->insert('smoking');
        

        //check whether insert statement has been executed
        if ($this->db->affected_rows() != 0) {
            return true;
        } else {
            return false;
        }

    }
    
    // 
    // alcohol questions
    // 

    public function alcoholQuestions() 
    {
        // calling private function to access squl
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
           
           // selecting all variables needed for the alcohol_questions part of the questionnaire to populate if record exists
        // we dont select * as any updates to the table would cause unneccessary data to be loaded such as the GUID
       $this->db->select("alcohol_questions.GUID, alcohol_questions.Question, 
           alcohol_options.response0, alcohol_options.response1, 
           alcohol_options.response2, alcohol_options.response3, 
           alcohol_options.response4"); 
           $this->db->from('alcohol_questions');
           // we join the questions and options tables on the foreign key options id in alcohol_questions
           // into the GUID of alcohol_options
           $this->db->join('alcohol_options', 'alcohol_options.GUID = alcohol_questions.optionsid');

           $query = $this->db->get();
           return $query;
    }

    public function alcoholResponses($id)
    {

        return $this->getAlcoholResponses($id);
    }
    private function getAlcoholResponses($id) 
    {
        //calling all data as this will not change 
        $this->db->select('*');
        $this->db->where('userid', $id);
        $this->db->from('alcohol_responses');
        //ordering in ascending order so when we produce a table they will link correctly to the questions without extra checks
        $this->db->order_by('questionid ASC');

        $query = $this->db->get();
        return $query;
    }

    public function setAlcoholResponses($id, $oneScore, $twoScore, $threeScore, $fourScore, $fiveScore,
    $sixScore, $sevenScore, $eightScore, $nineScore, $tenScore)
    {
        // check whether a record of each individual record exists before updating or inserting
        // this is a precaution in case someone managed to submit with 9/10 answered this shouldnt happen
        // individual checks blocks out the chance of an sql mess up
        $this->checkAlcoholResponsesExists($id, 1, $oneScore);
        $this->checkAlcoholResponsesExists($id, 2, $twoScore);
        $this->checkAlcoholResponsesExists($id, 3, $threeScore);
        $this->checkAlcoholResponsesExists($id, 4, $fourScore);
        $this->checkAlcoholResponsesExists($id, 5, $fiveScore);

        $this->checkAlcoholResponsesExists($id, 6, $sixScore);
        $this->checkAlcoholResponsesExists($id, 7, $sevenScore);
        $this->checkAlcoholResponsesExists($id, 8, $eightScore);
        $this->checkAlcoholResponsesExists($id, 9, $nineScore);
        $this->checkAlcoholResponsesExists($id, 10, $tenScore);


    }
    private function checkAlcoholResponsesExists($id, $questionid, $response) 
    {
        $this->db->select('userid');
        //where userid = $id
        $this->db->where('userid' , $id);
        $this->db->where('questionid', $questionid);
        //from the alcohol_responses table
        $query = $this->db->get('alcohol_responses');
        //returns query result
        $check = sizeof($query->result());

        if ($check == 0) {
            $this->insertAlcoholResponses($id, $questionid, $response);
        } else {
            $this->updateAlcoholResponses($id, $questionid, $response);
        }

    }
    private function checkAllAlcoholResponsesExists($id) 
    {
        $this->db->select('userid');
        //where userid = $id
        $this->db->where('userid' , $id);
        //from the alcohol_responses table
        $query = $this->db->get('alcohol_responses');
        //returns query result
        return $query->result();

    }
    private function updateAlcoholResponses($id, $questionid, $response) 
    {
        // $rest = substr("abcdef", -1);    // returns "f"
         // $score = substr("responseX", -1);    // returns "X"
        
        $score = substr($response, -1);
        $this->db->set('response', $response);
        $this->db->set('response_score', $score);

        $this->db->where('userid', $id);
        $this->db->where('questionid', $questionid);
        $this->db->update('alcohol_responses');
        

        //check whether update statement has been executed
        if ($this->db->affected_rows() != 0) {
            return true;
        } else {
            return false;
        }

    }
    private function insertAlcoholResponses($id, $questionid, $response) 
    {
         $this->db->set('userid', $id);
         $this->db->set('questionid', $questionid);

         // $rest = substr("abcdef", -1);    // returns "f"
         // $score = substr("responseX", -1);    // returns "X"
         $score = substr($response, -1);

         $this->db->set('response', $response);
         $this->db->set('response_score', $score);

         $this->db->insert('alcohol_responses');
         
 
         //check whether insert statement has been executed
         if ($this->db->affected_rows() != 0) {
             return true;
         } else {
             return false;
         }

    }

    // 
    // medical history
    // 

    public function medicalHistory($id)
    {
        return $this->getMedicalHistory($id);
    }
    private function getMedicalHistory($id) 
    {
        //getting data to populate the medical history part of the questionnaire
        $this->db->select('has_cancer, has_heart_disease, has_stroke, has_other');
        $this->db->where('userid', $id);
        $query = $this->db->get('medical_history');

        return $query;
    }
    private function checkMedicalHistoryExist($id)
    {
        $this->db->select('userid');
        //where userid = $id
        $this->db->where('userid' , $id);
        //from the medical_history table
        $query = $this->db->get('medical_history');
        //returns query result
        return $query->result();
    }
    public function setMedicalHistory($id, $has_cancer, $has_heart_disease, 
    $has_stroke, $has_other)
    {
        // if they have a record existing 
        // update query
        // else
        // insert query
        $check = sizeof($this->checkMedicalHistoryExist($id));

        if ($check == 0) {
            $this->insertMedicalHistory($id, $has_cancer, $has_heart_disease, $has_stroke, $has_other);
        } else {
            $this->updateMedicalHistory($id, $has_cancer, $has_heart_disease, $has_stroke, $has_other);
        }
    }
    private function updateMedicalHistory($id, $has_cancer, $has_heart_disease, $has_stroke, $has_other)
    {
        // simple update query matching variables to db counterparts
        $this->db->set('has_cancer', $has_cancer);
        $this->db->set('has_heart_disease', $has_heart_disease);
        $this->db->set('has_stroke', $has_stroke);
        $this->db->set('has_other', $has_other);

        $this->db->where('userid', $id);
        $this->db->update('medical_history');
        

        //check whether insert statement has been executed
        if ($this->db->affected_rows() != 0) {
            return true;
        } else {
            return false;
        }

    }
    private function insertMedicalHistory($id, $has_cancer, $has_heart_disease, $has_stroke, $has_other)
    {
        //  insert query matching variables to db counterparts
        $this->db->set('userid', $id);
        $this->db->set('has_cancer', $has_cancer);
        $this->db->set('has_heart_disease', $has_heart_disease);
        $this->db->set('has_stroke', $has_stroke);
        $this->db->set('has_other', $has_other);

        $this->db->insert('medical_history');
        

        //check whether update statement has been executed
        if ($this->db->affected_rows() != 0) {
            return true;
        } else {
            return false;
        }
    }

    // 
    // allergy
    // 

    public function allergy($id) 
    {
        // allergy_details allergies
        return $this->getAllergy($id);
    }
    private function getAllergy($id) 
    {
        $this->db->select('allergy_details');
        $this->db->where('userid', $id);
        $query = $this->db->get('allergies');

        return $query;
    }
    private function checkAllergyExist($id)
    {
        
        $this->db->select('userid');
        //where userid = $id
        $this->db->where('userid' , $id);
        //from the allergies table
        $query = $this->db->get('allergies');
        //returns query result
        return $query->result();
    }

    public function setAllergy($id, $allergy_details) 
    {

        // if they have a record existing 
        // update query
        // else
        // insert query
        $check = sizeof($this->checkAllergyExist($id));

        if ($check == 0) {
            $this->insertAllergy($id, $allergy_details);
        } else {
            $this->updateAllergy($id, $allergy_details);
        }
    }
    private function insertAllergy($id, $allergy_details) 
    {
        $this->db->set('userid', $id);
        $this->db->set('allergy_details', $allergy_details);

        $this->db->insert('allergies');
        

        //check whether insert statement has been executed
        if ($this->db->affected_rows() != 0) {
            return true;
        } else {
            return false;
        }

    }
    private function updateAllergy($id, $allergy_details) 
    {
        $this->db->set('allergy_details', $allergy_details);

        $this->db->where('userid', $id);
        $this->db->update('allergies');
        

        //check whether insert statement has been executed
        if ($this->db->affected_rows() != 0) {
            return true;
        } else {
            return false;
        }
        
    }

    // 
    // lifestyle
    // 

    public function lifestyle($id) 
    {
        return $this->getLifestyle($id);
    }
    private function getLifestyle($id)
    {
        //populating lifestyle part of the questionnaire
        $this->db->select('exercise, exercise_minutes, exercise_days, diet');
        $this->db->where('userid', $id);
        $query = $this->db->get('lifestyle');

        return $query;
    }
    private function checkLifestyleExist($id) 
    {
        $this->db->select('userid');
        //where userid = $id
        $this->db->where('userid' , $id);
        //from the lifestyle table
        $query = $this->db->get('lifestyle');
        //returns query result
        return $query->result();
    }
    public function setLifestyle($id, $exercise, $exercise_minutes, 
    $exercise_days, $diet)
    {
        // if they have a record existing 
        // update query
        // else
        // insert query
        $check = sizeof($this->checkLifestyleExist($id));

        if ($check == 0) {
            $this->insertLifestyle($id, $exercise, $exercise_minutes, $exercise_days, $diet);
        } else {
            $this->updateLifestyle($id, $exercise, $exercise_minutes, $exercise_days, $diet);
        }
    }
    private function insertLifestyle($id, $exercise, 
    $exercise_minutes, $exercise_days, $diet) 
    {

        $this->db->set('userid', $id);
        $this->db->set('exercise', $exercise);
        $this->db->set('exercise_minutes', $exercise_minutes);
        $this->db->set('exercise_days', $exercise_days);
        $this->db->set('diet', $diet);

        $this->db->insert('lifestyle');
        

        //check whether insert statement has been executed
        if ($this->db->affected_rows() != 0) {
            return true;
        } else {
            return false;
        }

    }
    private function updateLifestyle($id, $exercise, $exercise_minutes, $exercise_days, $diet)
    {

        $this->db->set('exercise', $exercise);
        $this->db->set('exercise_minutes', $exercise_minutes);
        $this->db->set('exercise_days', $exercise_days);
        $this->db->set('diet', $diet);

        $this->db->where('userid', $id);
        $this->db->update('lifestyle');
        

        //check whether insert statement has been executed
        if ($this->db->affected_rows() != 0) {
            return true;
        } else {
            return false;
        }
    }

    // 
    // completed questionnaires
    // 

    public function submitQuestionnaire($id, $status)
    {
        return $this->updatingStatus($id, $status);
    }

    private function updatingStatus($id, $status) 
    {
        //default values which will be checked

        //currently error messages are in the code but unused as they wouldnt be able to get
        //this far without completing all the forms
        //the checks that they have records is just a precaution in reality they shouldnt even be able to submit
        $valid = true;
        $errorMessage = "";

        $medicationCheck = sizeof($this->checkMedicationExists($id));
        $smokeCheck = sizeof($this->checkSmokeExist($id));
        $alcoholResponsesCheck = sizeof($this->checkAllAlcoholResponsesExists($id));
        $medicalHistoryCheck = sizeof($this->checkMedicalHistoryExist($id));
        $allergyCheck = sizeof($this->checkAllergyExist($id));
        $lifestyleCheck = sizeof($this->checkLifestyleExist($id));

        if($medicationCheck == 0) {
            $valid = false;
            $errorMessage = $errorMessage . "You need to complete the Medication form. ";
        }
        if($smokeCheck == 0) {
            $valid = false;
            $errorMessage = $errorMessage . "You need to complete the Smoking form. ";
        }
        if($alcoholResponsesCheck == 0) {
            $valid = false;
            $errorMessage = $errorMessage . "You need to complete the Alcohol Responses Sheet. ";
        }
        if($medicalHistoryCheck == 0) {
            $valid = false;
            $errorMessage = $errorMessage . "You need to complete the Medical History form. ";
        }
        if($allergyCheck == 0) {
            $valid = false;
            $errorMessage = $errorMessage . "You need to complete the Allergy form. ";
        }
        if($lifestyleCheck == 0) {
            $valid = false;
            $errorMessage = $errorMessage . "You need to complete the Lifestyle form. ";
        }

        
        if ($valid == true) {
            $this->updateStatus($id, $status);
        } else {
            return $errorMessage;
        }
        
        

        return $valid;
    }

    public function retrieveQuestionnaires() 
    {
    
        return $this->questionnaireRetrieval();
        
    }
    private function questionnaireRetrieval() 
    {
        $this->db->select('GUID, firstname, surname, status');
        $pending = "pending";
        $confirmed = "confirmed";
        $this->db->like('status', $pending, 'none');
        $this->db->or_like('status', $confirmed, 'none');
        //from the users table
        $query = $this->db->get('users');
        return $query;
    }

    public function checkStatus($id) {
        return $this->getStatus($id);
    }
    private function getStatus($id) 
    {
        $this->db->select('GUID');
        $this->db->where('GUID', $id);
        $this->db->like('status', 'pending');
        $this->db->or_like('status', 'confirmed');
        //from the users table
        $query = $this->db->get('users');
        $check = sizeof($query->result());
        if ($check == 0) {
            return false;
        } else {
            return true;
        }

    }
    public function completed($id) {
        return $this->checkCompleted($id);
    }
    private function checkCompleted($id) 
    {
        $this->db->select('GUID');
        $this->db->where('GUID', $id);
        $this->db->like('status', 'confirmed');
        //from the users table
        $query = $this->db->get('users');
        $check = sizeof($query->result());
        if ($check == 0) {
            return false;
        } else {
            return true;
        }

    }
    private function updateStatus($id, $status)
    {
        $this->db->set('status', $status);

        $this->db->where('GUID', $id);
        $this->db->update('users');

        //check whether insert statement has been executed
        if ($this->db->affected_rows() != 0) {
            return true;
        } else {
            return false;
        }

    }
}