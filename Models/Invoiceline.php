<?php

require_once(__DIR__."/../core/ValidationException.php");

class Invoiceline {

    private $id;
    private $id_factura;
    private $producto;
    private $cantidad;
    private $precio;
    private $iva;

    public function __construct($id=NULL, $id_factura=NULL, $producto=NULL, $cantidad=NULL, $precio=NULL, $iva=NULL) {
        $this->id = $id;
        $this->id_factura = $id_factura;
        $this->producto = $producto;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
        $this->iva = $iva;
    }

    public function getID() {
        return $this->id;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function getInvoiceId() {
        return $this->id_factura;
    }

    public function setInvoiceId($id_factura) {
        $this->id_factura = $id_factura;
    }

    public function getProduct() {
        return $this->producto;
    }

    public function setProduct($producto) {
        $this->producto = $producto;
    }

    public function getPrice() {
        return $this->precio;
    }

    public function setPrice($precio) {
        $this->precio = $precio;
    }

    public function getTax() {
        return $this->iva;
    }

    public function setTax($iva) {
        $this->iva = $iva;
    }

    public function getQuantity() {
        return $this->cantidad;
    }

    public function setQuantity($cantidad) {
        $this->cantidad = $cantidad;
    }

}

