<?php
require_once(__DIR__."/../core/ValidationException.php");

class Payment {

    private $id;

    private $metodo_pago;

    private $fecha;

    private $periodicidad;

    private $cantidad;

    private $reserva_id;

    private $inscripcion_id;

	private $realizado;

    public function __construct($id=NULL, $metodo_pago=NULL, $fecha=NULL, $periodicidad=NULL, $cantidad=NULL, $reserva_id=NULL, $inscripcion_id=NULL, $realizado=NULL ) {
        $this->id = $id;

        $this->metodo_pago = $metodo_pago;

        $this->fecha = $fecha;

        $this->periodicidad = $periodicidad;

        $this->cantidad = $cantidad;

        $this->reserva_id = $reserva_id;

        $this->inscripcion_id = $inscripcion_id;

		$this->realizado = $realizado;

    }

    public function getID() {

        return $this->id;

    }

    public function setID($id) {

        $this->id = $id;

    }

    public function getPaymentMetod() {

        return $this->metodo_pago;

    }

    public function setPaymentMetod($metodo_pago) {

        $this->metodo_pago = $metodo_pago;

    }

    public function getDate() {

        return $this->fecha;

    }

    public function setDate($fecha) {

        $this->fecha = $fecha;

    }

    public function getPeriodicity() {

        return $this->periodicidad;

    }

    public function setPeriodicity($periodicidad) {

        $this->periodicidad = $periodicidad;

    }

    public function getQuantity() {

        return $this->cantidad;

    }

    public function setQuantity($cantidad) {

        $this->cantidad = $cantidad;

    }

    public function getReserveid() {

        return $this->reserva_id;

    }

    public function setReserveid($reserva_id) {

        $this->reserva_id = $reserva_id;

    }

    public function getInscriptionid() {

        return $this->inscripcion_id;

    }

    public function setInscriptionid($inscripcion_id) {

        $this->inscripcion_id = $inscripcion_id;

    }

	public function getRealiced() {

        return $this->realizado;

    }

    public function setRealiced($realizado) {

        $this->realizado = $realizado;

    }
	


}
