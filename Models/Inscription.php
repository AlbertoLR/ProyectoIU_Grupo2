<?php

require_once(__DIR__."/../core/ValidationException.php");

class Inscription {

    private $IDInscripcion;
    private $fecha;
    private $ID_Particular_Externo;
    private $ID_Evento;
    private $ID_Reserva;
    private $DNI_Cliente;
    private $ID_Actividad;
    private $fecha_baja;

    //constructor de la clase Inscription
    public function __construct($IDInscripcion=NULL, $fecha=NULL, $ID_Particular_Externo=NULL, $ID_Evento=NULL, $ID_Reserva=NULL, $DNI_Cliente=NULL, $ID_Actividad=NULL, $fecha_baja=NULL) {
        $this->IDInscripcion = $IDInscripcion;
        $this->fecha = $fecha;
        $this->ID_Particular_Externo = $ID_Particular_Externo;
        $this->ID_Evento = $ID_Evento;
        $this->ID_Reserva = $ID_Reserva;
        $this->DNI_Cliente = $DNI_Cliente;
        $this->ID_Actividad = $ID_Actividad;
        $this->fecha_baja = $fecha_baja;
    }


    //los getters y setters de la clase Inscription

    public function getIDInscripcion() {
        return $this->IDInscripcion;
    }

    public function setIDInscripcion($IDInscripcion) {
        $this->IDInscripcion = $IDInscripcion;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha=NULL) {
        $this->fecha = $fecha;
    }

    public function getID_Particular_Externo() {
        return $this->ID_Particular_Externo;
    }

    public function setID_Particular_Externo($ID_Particular_Externo=NULL) {
        $this->ID_Particular_Externo = $ID_Particular_Externo;
    }

    public function getID_Evento() {
        return $this->ID_Evento;
    }

    public function setID_Evento($ID_Evento=NULL) {
        $this->ID_Evento = $ID_Evento;
    }

    public function getID_Reserva() {
        return $this->ID_Reserva;
    }

    public function setID_Reserva($ID_Reserva=NULL) {
        $this->ID_Reserva = $ID_Reserva;
    }

    public function getDNI_Cliente() {
        return $this->DNI_Cliente;
    }

    public function setDNI_Cliente($DNI_Cliente=NULL) {
        $this->DNI_Cliente = $DNI_Cliente;
    }

    public function getID_Actividad() {
        return $this->ID_Actividad;
    }

    public function setID_Actividad($ID_Actividad=NULL) {
        $this->ID_Actividad = $ID_Actividad;
    }

    public function getFechaBaja() {
        return $this->fecha_baja;
    }

    public function setFechaBaja($fecha=NULL) {
        $this->fecha_baja = $fecha;
    }


}
