<?php
require_once(__DIR__."/../core/PDOConnection.php");

class PAYMENT_Model {

    private $db;

    public function __construct() {

        $this->db = PDOConnection::getInstance();

    }

    public function fetch_all(){

        $sql = $this->db->prepare("SELECT * FROM pago ORDER BY fecha");

        $sql->execute();

        $payments_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $payments = array();

        foreach ($payments_db as $payment) {

            array_push($payments, new Payment($payment["id"], $payment["metodo_pago"],$payment["fecha"],$payment["periodicidad"],$payment["cantidad"],$payment["reserva_id"],$payment["inscripcion_id"],$payment["realizado"]));

        }

        return $payments;

    }

    public function fetch($paymentID){

      $sql = $this->db->prepare("SELECT pago.id,pago.metodo_pago,pago.fecha,pago.periodicidad,pago.cantidad,pago.reserva_id,pago.inscripcion_id,pago.realizado FROM pago WHERE pago.id=? ORDER BY fecha");

        $sql->execute(array($paymentID));

        $payment = $sql->fetch(PDO::FETCH_ASSOC);

        if($payment != NULL) {

            return new Payment($payment["id"], $payment["metodo_pago"],$payment["fecha"],$payment["periodicidad"],$payment["cantidad"],$payment["reserva_id"],$payment["inscripcion_id"],$payment["realizado"]);

        } else {

          $sql1 = $this->db->prepare("SELECT * FROM pago WHERE pago.id=? ORDER BY fecha");

            $sql1->execute(array($paymentID));

            $payment = $sql1->fetch(PDO::FETCH_ASSOC);

            if($payment != NULL) {

              return new Payment($payment["id"], $payment["metodo_pago"],$payment["fecha"],$payment["periodicidad"],$payment[cantidad],$payment["reserva_id"],$payment["inscripcion_id"],$payment["realizado"]);

            }else{

              return NULL;

          }

        }

    }

    //devuelve todas las reservas
    public function fetch_reserves(){
        $sql = $this->db->prepare("SELECT * FROM reserva");
        $sql->execute();
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if ($list_db!= NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }

    //devuelve todas las inscripciones
    public function fetch_inscriptions(){
        $sql = $this->db->prepare("SELECT * FROM inscripcion");
        $sql->execute();
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if ($list_db!= NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }


    public function insert(Payment $payment) {

      if($payment->getReserveid() == ""){
        $res =NULL;
      }else{
          $res =$payment->getReserveid();
      }

      if($payment->getInscriptionid() ==""){
        $ins =NULL;
      }else{
          $ins =$payment->getInscriptionid();
      }
        $sql = $this->db->prepare("INSERT INTO pago(metodo_pago,fecha,periodicidad,cantidad,reserva_id,inscripcion_id,realizado) values (?,?,?,?,?,?,?)");
        $sql->execute(array($payment->getPaymentMetod(), $payment->getDate(),$payment->getPeriodicity(), $payment->getQuantity(), $res, $ins, $payment->getRealiced()));
    }

    public function update(Payment $payment){

      if($payment->getReserveid() == ""){
        $res =NULL;
      }else{
          $res =$payment->getReserveid();
      }

      if($payment->getInscriptionid() ==""){
        $ins =NULL;
      }else{
          $ins =$payment->getInscriptionid();
      }

        $sql = $this->db->prepare("UPDATE pago SET metodo_pago=?,fecha=?,periodicidad=?,cantidad=?,reserva_id=?,inscripcion_id=?,realizado=? where id=?");
        $sql->execute(array($payment->getPaymentMetod(), $payment->getDate(),$payment->getPeriodicity(),$payment->getQuantity(),$res,$ins,$payment->getRealiced(), $payment->getID()));

    }

    public function delete(Payment $payment){

        $sql = $this->db->prepare("DELETE FROM pago where id=?");
        $sql->execute(array($payment->getID()));

    }

}
