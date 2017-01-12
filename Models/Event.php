<?php

//id, nombre, precio

require_once(__DIR__."/../core/ValidationException.php");

class Event {

    private $id;
    private $nombre;
    private $precio;


    public function __construct($id=NULL, $nombre=NULL, $precio=NULL) {
     $this->id = $id;
     $this->nombre = $nombre;
     $this->precio = $precio;
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

    public function getPrecio() {
        return $this->precio;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
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
