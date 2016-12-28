<?php

require_once(__DIR__."/../core/ValidationException.php");

class Season {

    private $id;
    private $dateStart;
    private $dateEnd;
    private $description;

    public function __construct($id=NULL, $dateStart=NULL,$dateEnd=NULL,$description=NULL) {
        $this->id = $id;
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
        $this->description=$description;
    }

    public function getID() {
        return $this->id;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function getdateStart() {
        return $this->dateStart;
    }

    public function setdateStart($dateStart) {
        $this->dateStart = $dateStart;
    }

    public function getdateEnd() {
        return $this->dateEnd;
    }

    public function setdateEnd($dateEnd) {
        $this->dateEnd = $dateEnd;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description= $description;
    }
    public function checkIsValidForCreate() {
        $errors = array();
        if (strlen($this->description) < 3) {
            $errors["description"] = "Description must be at least 3 characters length";

        }
        if (sizeof($errors)>0){
            throw new ValidationException($errors, "schedule is not valid");
        }
    }
}
