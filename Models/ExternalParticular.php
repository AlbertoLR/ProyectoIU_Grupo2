<?php

require_once(__DIR__."/../core/ValidationException.php");

class ExternalParticular {

    private $id;
    private $nombre;
    private $apellidos;
    private $telefono;

    public function __construct($id=NULL, $nombre=NULL, $apellidos=NULL, $telefono=NULL) {
     $this->id = $id;
     $this->nombre = $nombre;
     $this->apellidos = $apellidos;
     $this->telefono = $telefono;
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

    public function getApellidos(){
        return $this->apellidos;
    }

    public function setApellidos($apellidos){
        $this->apellidos = $apellidos;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    /*public function checkIsValidForCreate() {
        $errors = array();
        if (strlen($this->dni_nif) < 9) {
            $errors["dni_nif"] = "Dni must be at least 9 characters length";

        }
        if (sizeof($errors)>0){
            throw new ValidationException($errors, "external particular is not valid");
        }
    }*/
}