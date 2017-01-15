<?php

require_once(__DIR__."/../core/ValidationException.php");

class Reservation {

    private $id;
    private $dni_c;
    private $id_sesion;
    private $id_espacio;
	private $day;
    private $precio_espacio;
    private $precio_fisio;
	

    public function __construct($id=NULL, $dni_c=NULL, $id_sesion=NULL, $id_espacio=NULL, $day=NULL, $precio_espacio=NULL, $precio_fisio=NULL) {
        $this->id = $id;
        $this->dni_c = $dni_c;
        $this->id_sesion = $id_sesion;
        $this->id_espacio = $id_espacio;
		$this->day = $day;
        $this->precio_espacio = $precio_espacio;
        $this->precio_fisio = $precio_fisio;
    }

    public function getID() {
        return $this->id;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function getClientId() {
        return $this->dni_c;
    }

    public function setClientId($dni_c) {
        $this->dni_c = $dni_c;
    }

    public function getSessionId() {
        return $this->id_sesion;
    }

    public function setSessionId($id_sesion) {
        $this->id_sesion = $id_sesion;
    }

    public function getSpacePrice() {
        return $this->precio_espacio;
    }

    public function setSpacePrice($precio_espacio) {
        $this->precio_espacio = $precio_espacio;
    }

    public function getPhysioPrice() {
        return $this->precio_fisio;
    }

    public function setPhysioPrice($precio_fisio) {
        $this->precio_fisio = $precio_fisio;
    }

    public function getSpaceid() {
        return $this->id_espacio;
    }

    public function setSpaceid($id_espacio) {
        $this->id_espacio = $id_espacio;
    }

	public function getDay() {
        return $this->day;
    }

    public function setDay($day) {
        $this->day = $day;
    }

	public function checkIsValidForCreate() {
        $errors = array();
        if (sizeof($errors)>0){
			throw new ValidationException($errors, "reservation is not valid");
		}
	}
}

