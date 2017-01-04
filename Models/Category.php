<?php

require_once(__DIR__."/../core/ValidationException.php");

class Category {

    private $type;
    private $id;
  
    public function __construct($id=NULL, $type=NULL) {
        $this->id = $id;
        $this->type = $type;
    }

    public function getID() {
        return $this->id;
    }

    public function setID($id) {
        $this->id = $id;
    }
    
    public function getType() {
        return $this->type;
    }
    
    public function setType($type) {
        $this->type = $type;
    }
    
    public function checkIsValidForCreate() {
        $errors = array();
        if (strlen($this->type) < 2) {
            $errors["type"] = "Type must be at least 2 characters length";
	
        }
        if (sizeof($errors)>0){
            throw new ValidationException($errors, "category is not valid");
        }
    } 
}