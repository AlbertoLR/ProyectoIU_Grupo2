<?php

require_once(__DIR__."/../core/ValidationException.php");

class Service {

private $IDServicio;
private $fecha;
private $coste;
private $descripcion;
private $ID_Pago;
private $ID_Cliente;

public function __construct($IDServicio=NULL, $fecha=NULL, $coste=NULL, $descripcion=NULL, $ID_Pago=NULL, $idCliente=NULL) {
    $this->IDServicio = $IDServicio;
    $this->fecha = $fecha;
    $this->coste = $coste;
    $this->descripcion = $descripcion;
    $this->ID_Pago = $ID_Pago;
    $this->ID_Cliente = $idCliente;
}

public function getIDServicio() {
    return $this->IDServicio;
}

public function setIDServicio($IDServicio) {
    $this->IDServicio = $IDServicio;
}

public function getFecha() {
    return $this->fecha;
}

public function setFecha($fecha) {
    $this->fecha = $fecha;
}

public function getCoste() {
    return $this->coste;
}

public function setCoste($coste) {
    $this->coste = $coste;
}

public function getDescripcion() {
    return $this->descripcion;
}

public function setDescripcion($descripcion) {
    $this->descripcion = $descripcion;
}

public function getID_Pago() {
    return $this->ID_Pago;
}

public function setID_Pago($ID_Pago) {
    $this->ID_Pago = $ID_Pago;
}

public function getIDCliente() {
    return $this->ID_Cliente;
}

public function setIDCliente($idCliente) {
    $this->ID_Cliente = $idCliente;
}

/*public function checkIsValidForCreate() {
    $errors = array();
    if (strlen($this->descripcion) < 2) {
        $errors["descripcion"] = "descripcion must be at least 2 characters length";

    }
    if (sizeof($errors)>0){
        throw new ValidationException($errors, "Service is not valid");
    }
}*/
}