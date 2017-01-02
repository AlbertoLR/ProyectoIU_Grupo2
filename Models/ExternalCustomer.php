<?php

require_once(__DIR__."/../core/ValidationException.php");

class ExternalCustomer {

    private $id;
    private $dni_nif;
    private $nombre;
    private $apellido;
    private $telefono;
	private $email;

    public function __construct($id=NULL, $dni_nif=NULL, $nombre=NULL, $apellido=NULL, $telefono=NULL, $email=NULL) {
     $this->id = $id;
     $this->dni_nif = $dni_nif;
     $this->nombre = $nombre;
     $this->apellido = $apellido;
     $this->telefono = $telefono;
	 $this->email = $email;
    }

    public function getID() {
        return $this->id;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function getDni_nif(){
        return $this->dni_nif;
    }

    public function setDni_nif($dni_nif){
        $this->dni_nif= $dni_nif;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function setApellido($apellido){
        $this->apellido = $apellido;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function checkIsValidForCreate() {
        $errors = array();
        if (strlen($this->dni_nif) < 9) {
            $errors["dni_nif"] = "Dni must be at least 9 characters length";

        }
        if (sizeof($errors)>0){
            throw new ValidationException($errors, "external customer is not valid");
        }
    }
}