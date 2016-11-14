<?php

require_once(__DIR__."/../core/ValidationException.php");

class Controller {

    private $id;
    private $controllerName;
    private $action;
  
    public function __construct($id=NULL, $controllerName=NULL, $action=NULL) {
        $this->id = $id;
        $this->controllerName = $controllerName;
        $this->action = $action;
    }

    public function getID() {
        return $this->id;
    }
    
    public function setID($id) {
        $this->id = $id;
    }
  
    public function getControllerName() {
        return $this->controllerName;
    }
    
    public function setControllerName($controllerName) {
        $this->controllerName = $controllerName;
    }

    public function getAction() {
        return $this->action;
    }
    
    public function setAction($action) {
        $this->action = $action;
    }
    
    public function checkIsValidForCreate() {
        $errors = array();
        if (strlen($this->controllerName) < 3) {
            $errors["controllername"] = "controllerName must be at least 5 characters length";
	
        }
        if (sizeof($errors)>0){
            throw new ValidationException($errors, "controller is not valid");
        }
    } 
}