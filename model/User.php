<?php

require_once(__DIR__."/../core/ValidationException.php");

class User {

    private $id;
    private $username;
    private $passwd;
    private $profile;
  
    public function __construct($id=NULL, $username=NULL, $passwd=NULL, $profile=NULL) {
        $this->id = $id;
        $this->username = $username;
        $this->passwd = $passwd;
        $this->profile = $profile;
    }

    public function getID() {
        return $this->id;
    }
    
    public function setID($id) {
        $this->id = $id;
    }
    
    public function getUsername() {
        return $this->username;
    }
    
    public function setUsername($username) {
        $this->username = $username;
    }
  
    public function getPasswd() {
        return $this->passwd;
    }
      
    public function setPassword($passwd) {
        $this->passwd = $passwd;
    }

    public function getProfile($profile){
        return $this->profile;
    }
    
    public function setProfile($profile){
        $this->profile = $profile;
    }
    
    public function checkIsValidForRegister() {
        $errors = array();
        if (strlen($this->username) < 5) {
            $errors["username"] = "Username must be at least 5 characters length";
	
        }
        if (strlen($this->passwd) < 5) {
            $errors["passwd"] = "Password must be at least 5 characters length";	
        }
        if (sizeof($errors)>0){
            throw new ValidationException($errors, "user is not valid");
        }
    } 
}