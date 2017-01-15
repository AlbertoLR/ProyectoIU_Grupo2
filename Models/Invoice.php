<?php

require_once(__DIR__."/../core/ValidationException.php");

class Invoice {

    private $id;
    private $day;
    private $id_payment;
    private $total_price;
    

    public function __construct($id=NULL, $day=NULL, $id_payment=NULL, $total_price=NULL) {
        $this->id = $id;
        $this->day = $day;
        $this->id_payment = $id_payment;
        $this->total_price = $total_price;
    }

    public function getID() {
        return $this->id;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function getDay() {
        return $this->day;
    }

    public function setDay($day) {
        $this->day = $day;
    }

    public function getPaymentId() {
        return $this->id_payment;
    }

    public function setPaymentId($id_payment) {
        $this->id_payment = $id_payment;
    }

    public function getTotalPrice() {
        return $this->total_price;
    }

    public function setTotalPrice($total_price) {
        $this->total_price = $total_price;
    }

   

}

