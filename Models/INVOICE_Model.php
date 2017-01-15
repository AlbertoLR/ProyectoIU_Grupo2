<?php

require_once(__DIR__."/../core/PDOConnection.php");

class INVOICE_Model {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){
        $sql = $this->db->prepare("SELECT * FROM factura ORDER BY id");
        $sql->execute();
        $invoices_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $invoices = array();

        foreach ($invoices_db as $invoice) {
            array_push($invoices, new Invoice($invoice["id"], $invoice["fecha"],$invoice["pago_id"],$invoice["precio_total"]));
        }

        return $invoices;
    }

    public function fetch($invoiceid){
      $sql = $this->db->query("SELECT * FROM factura WHERE factura.id=? ORDER BY id");
        $sql->execute(array($invoiceid));
        $invoice = $sql->fetch(PDO::FETCH_ASSOC);

        if($invoice != NULL) {
            return new Invoice($invoice["id"], $invoice["fecha"],$invoice["pago_id"],$invoice["precio_total"]);
        } else {
              return NULL;
          }
        }

    public function fetchPayment(){
        $sql = $this->db->query("SELECT * FROM pago ORDER BY id DESC");
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if($list_db != NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }


    public function insert(Invoice $invoice) {
		  
        $sql = $this->db->prepare("INSERT INTO factura(id,fecha,pago_id,precio_total) values (?,?,?,?)");
        $sql->execute(array($invoice->getID(), $invoice->getDay(), $invoice->getPaymentId(), $invoice->getTotalPrice()));
        }

    public function update(Invoice $invoice){
		
        $id = $invoice->getID();
        $sql = $this->db->prepare("UPDATE factura SET fecha=?,pago_id=?,precio_total=? where id=?");
        $sql->execute(array($invoice->getDay(), $invoice->getPaymentId(), $invoice->getTotalPrice(), $id));

    }

    public function delete(Invoice $invoiceid){
        $sql = $this->db->prepare("DELETE FROM factura where id=?");
        $sql->execute(array($invoiceid->getID()));
    }
	

}
