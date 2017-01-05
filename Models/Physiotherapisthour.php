<?php

require_once(__DIR__."/../core/ValidationException.php");

class Physiotherapisthour {
	
	private $id;
	private $dia;
	private $hora_i;
	private $hora_f;
	
	public function __construct($id=null,$dia_f=null,$hora_i=null,$hora_f=null){
		$this->id=$id;
		$this->dia_f=$dia_f;
		$this->hora_i=$hora_i;
		$this->hora_f=$hora_f;		
	}
	public function getID() {
        return $this->id;
    }
    public function setID($id) {
        $this->id = $id;
    }	
	public function getDay() {
        return $this->dia_f;
    }
    public function setDay($dia_f) {
        $this->dia_f = $dia_f;
    }
	public function getStarttime() {
        return $this->hora_i;
    }
    public function setStarttime($hora_i) {
        $this->hora_i = $hora_i;
    }
	public function getEndtime() {
        return $this->hora_f;
    }
    public function setEndtime($hora_f) {
        $this->hora_f = $hora_f;
    }	
}