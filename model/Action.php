<?php

require_once(__DIR__."/../core/ValidationException.php");

class Action {

    private $id;
    private $actionName;
  
    public function __construct($id=NULL, $actionName=NULL) {
        $this->id = $id;
        $this->actionName = $actionName;
    }

    public function getID() {
        return $this->id;
    }
    
    public function setID($id) {
        $this->id = $id;
    }
  
    public function getActionName() {
        return $this->actionName;
    }
    
    public function setActionName($actionName) {
        $this->actionName = $actionName;
    }
    
    public function checkIsValidForRegister() {
        $errors = array();
        if (strlen($this->actionName) < 5) {
            $errors["actionname"] = "actionName must be at least 5 characters length";
	
        }
        if (sizeof($errors)>0){
            throw new ValidationException($errors, "action is not valid");
        }
    } 
