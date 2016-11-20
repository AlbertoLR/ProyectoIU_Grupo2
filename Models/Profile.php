<?php

require_once(__DIR__."/../core/ValidationException.php");

class Profile {

    private $id;
    private $profileName;
  
    public function __construct($id=NULL, $profileName=NULL) {
        $this->id = $id;
        $this->profileName = $profileName;
    }

    public function getID() {
        return $this->id;
    }
    
    public function setID($id) {
        $this->id = $id;
    }
    
    public function getProfileName() {
        return $this->profileName;
    }
    
    public function setProfileName($profileName) {
        $this->profileName = $profileName;
    }  
    
    public function checkIsValidForCreate() {
        $errors = array();
        if (strlen($this->profileName) < 3) {
            $errors["profilename"] = "profileName must be at least 5 characters length";
	
        }
        if (sizeof($errors)>0){
            throw new ValidationException($errors, "profile is not valid");
        }
    } 
}