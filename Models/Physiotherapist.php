<?php

require_once(__DIR__."/../core/ValidationException.php");

class Physiotherapist {
	
	private $id;
	private $id_reserva;
	private $dia_f;
	private $asistencia;
	private $precio_fisio;
	private $id_cliente;
	private $dni_c;
	private $id_hora;
	
	
	public function __construct($id=null,$id_reserva=null,$dia_f=null,$asistencia=0,$precio_fisio=null,$id_cliente=null,$dni_c=null,$id_hora=null){
		$this->id=$id;
		$this->id_reserva=$id_reserva;
		$this->dia_f=$dia_f;
		$this->asistencia=$asistencia;
		$this->precio_fisio=$precio_fisio;
		$this->id_cliente=$id_cliente;
		$this->dni_c=$dni_c;
		$this->id_hora=$id_hora;
		
		
	}
	public function getID() {
        return $this->id;
    }
    public function setID($id) {
        $this->id = $id;
    }
	public function getReservationid() {
        return $this->id_reserva;
    }
    public function setReservationid($id_reserva) {
        $this->id_reserva = $id_reserva;
    }
	public function getDay() {
        return $this->dia_f;
    }
    public function setDay($dia_f) {
        $this->dia_f = $dia_f;
    }
	public function getAttendance() {
        return $this->asistencia;
    }
    public function setAttendance($asistencia) {
        $this->asistencia = $asistencia;
    }
	public function getPrice() {
        return $this->precio_fisio;
    }
    public function setPrice($precio_fisio) {
        $this->precio_fisio = $precio_fisio;
    }
	public function getIDCliente() {
        return $this->id_cliente;
    }
    public function setIDCliente($id_cliente) {
        $this->id_cliente = $id_cliente;
    }
	public function getDni() {
        return $this->dni_c;
    }
    public function setDni($dni_c) {
        $this->dni_c = $dni_c;
    }
	public function getIDHour(){
		return $this->id_hora;
	}
	public function setIDHour($id_hora){
		$this->id_hora=$id_hora;
	}
	
}