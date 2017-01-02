<?php

require_once(__DIR__."/../core/ValidationException.php");

class Cash {

    private $id;
    private $efectivoinicial;
    private $cantidad;
    private $efectivofinal;
	private $tipo;
	private $descripcion;
	private $pagoid;
	private $fecha;

    public function __construct($id=NULL, $efectivoinicial=NULL, $cantidad=NULL, $efectivofinal=NULL, $tipo=NULL, $descripcion=NULL,$pagoid=NULL, $fecha=NULL) {
     $this->id = $id;
     $this->efectivoinicial = $efectivoinicial;
     $this->cantidad = $cantidad;
     $this->efectivofinal = $efectivofinal;
	 $this->tipo = $tipo;
	 $this->descripcion = $descripcion;
     $this->pagoid = $pagoid;
	 $this->fecha = $fecha;
    }

    public function getID() {
        return $this->id;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function getEfectivoinicial(){
        return $this->efectivoinicial;
    }

    public function setEfectivoinicial($efectivoinicial){
        $this->efectivoinicial = $efectivoinicial;
    }

    public function getCantidad(){
        return $this->cantidad;
    }

    public function setCantidad($cantidad){
        $this->cantidad = $cantidad;
    }

    public function getEfectivofinal() {
        return $this->efectivofinal;
    }

    public function setEfectivofinal($efectivofinal) {
        $this->email = $efectivofinal;
    }
	
	public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }
	
	public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getPagoid() {
        return $this->pagoid;
    }

    public function setPagoid($pagoid) {
        $this->pagoid = $pagoid;
    }
	
	public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function checkIsValidForCreate() {
        $errors = array();
        if (strlen($this->pagoid) > 0) {
            $errors["pagoid"] = "Pago_id must be greater than 0";
        }

        if (sizeof($errors)>0){
            throw new ValidationException($errors, "Cash is not valid");
        }
    }
}