<?php

//id, nombre

require_once(__DIR__."/../core/ValidationException.php");

class Space {

    private $id;
    private $nombre;
   

    public function __construct($id=NULL, $nombre=NULL) {
     $this->id = $id;
     $this->nombre = $nombre;
    }

    public function getID() {
        return $this->id;
    }
	
    public function setID($id) {
        $this->id = $id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function checkIsValidForCreate() {
        $errors = array();
        if (strlen($this->nombre) < 3) {
            $errors["nombre"] = "Nombre must be at least 3 characters length";

        }
        if (sizeof($errors)>0){
            throw new ValidationException($errors, "event is not valid");
        }
    }
}
