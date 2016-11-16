<?php

require_once(__DIR__."/../core/ValidationException.php");

class Permission {

    private $id;
    private $controller;
    private $action;
  
    public function __construct($id=NULL, $controller=NULL, $action=NULL) {
        $this->id = $id;
        $this->controller = $controller;
        $this->action = $action;
    }

    public function getID() {
        return $this->id;
    }
    
    public function setID($id) {
        $this->id = $id;
    }
  
    public function getController() {
        return $this->controller;
    }
    
    public function setController($controller) {
        $this->controller = $controller;
    }

    public function getAction() {
        return $this->action;
    }
    
    public function setAction($action) {
        $this->action = $action;
    }
    
    public function checkIsValidForCreate() {
        $errors = array();
        if (strlen($this->controller) < 3) {
            $errors["controller"] = "controller must be at least 3 characters length";
	
        }
        if (strlen($this->action) < 3) {
            $errors["action"] = "action must be at least 3 characters length";
	
        }
        if (sizeof($errors)>0){
            throw new ValidationException($errors, "permission is not valid");
        }
    } 
}