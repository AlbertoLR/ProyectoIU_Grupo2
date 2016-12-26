<?php

require_once(__DIR__."/../core/ValidationException.php");

class Injury {

    private $id;
    private $injuryDescription;

    public function __construct($id=NULL, $injuryDescription=NULL) {
        $this->id = $id;
        $this->injuryDescription = $injuryDescription;
    }

    public function getID() {
        return $this->id;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function getInjuryDescription() {
        return $this->injuryDescription;
    }

    public function setInjuryDescription($injuryDescription) {
        $this->injuryDescription = $injuryDescription;
    }

    public function checkIsValidForCreate() {
        $errors = array();
        if (strlen($this->injuryDescription) < 3) {
            $errors["injurydescription"] = "injuryDescription must be at least 5 characters length";

        }
        if (sizeof($errors)>0){
            throw new ValidationException($errors, "injury is not valid");
        }
    }
}
