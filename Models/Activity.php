<?php

require_once(__DIR__."/../core/ValidationException.php");

class Activity {

    private $id;
    private $nombre;
    private $capacidad;
    private $precio;
    private $descuento_id;
    private $categoria_id;
    private $extra_discount;

    public function __construct($id=NULL, $nombre=NULL, $capacidad=NULL, $precio=NULL, $descuento_id=NULL, $categoria_id=NULL, $extra_discount=NULL ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->capacidad = $capacidad;
        $this->precio = $precio;
        $this->descuento_id = $descuento_id;
        $this->categoria_id = $categoria_id;
        $this->extra_discount = $extra_discount;
    }

    public function getID() {
        return $this->id;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function getActivityName() {
        return $this->nombre;
    }

    public function setActivityName($nombre) {
        $this->nombre = $nombre;
    }

    public function getCapacity() {
        return $this->capacidad;
    }

    public function setCapacity($capacidad) {
        $this->capacidad = $capacidad;
    }

    public function getPrice() {
        return $this->precio;
    }

    public function setPrice($precio) {
        $this->precio = $precio;
    }

    public function getDiscountid() {
        return $this->descuento_id;
    }

    public function setDiscountid($descuento_id) {
        $this->descuento_id = $descuento_id;
    }

    public function getCategoryid() {
        return $this->categoria_id;
    }

    public function setCategoryid($categoria_id) {
        $this->categoria_id = $categoria_id;
    }

    public function getExtraDiscount() {
        return $this->extra_discount;
    }

    public function setExtraDiscount($extra_discount) {
        $this->extra_discount = $extra_discount;
    }

    public function checkIsValidForCreate() {
        $errors = array();
        if (strlen($this->nombre) < 2) {
            $errors["activityname"] = "nombre must be at least 5 characters length";

        }
        if (sizeof($errors)>0){
            throw new ValidationException($errors, "activity is not valid");
        }
    }
}
