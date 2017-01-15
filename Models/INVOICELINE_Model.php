<?php

require_once(__DIR__."/../core/PDOConnection.php");

class INVOICELINE_Model {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all($id_factura){
        $sql = $this->db->prepare("SELECT * FROM linea_factura WHERE linea_factura.id_factura=? ORDER BY id");
        $sql->execute(array($id_factura));
        $invoicelines_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $invoicelines = array();

        foreach ($invoicelines_db as $invoiceline) {
            array_push($invoicelines, new Invoiceline($invoiceline["id"], $invoiceline["id_factura"],$invoiceline["producto"],$invoiceline["cantidad"],$invoiceline["precio"],$invoiceline["iva"]));
        }

        return $invoicelines;
    }

    public function fetch($invoicelineid){
      $sql = $this->db->query("SELECT * FROM linea_factura WHERE linea_factura.id=? ORDER BY id");
        $sql->execute(array($invoicelineid));
        $invoiceline = $sql->fetch(PDO::FETCH_ASSOC);

        if($invoiceline != NULL) {
            return new Invoiceline($invoiceline["id"], $invoiceline["id_factura"],$invoiceline["producto"],$invoiceline["cantidad"],$invoiceline["precio"],$invoiceline["iva"]);
        } else {
              return NULL;
          }
        }

    public function fetchInvoice(){
        $sql = $this->db->query("SELECT * FROM factura");
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if($list_db != NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }

    public function insert(Invoiceline $invoiceline) {
		
	  
        $sql = $this->db->prepare("INSERT INTO linea_factura(id,id_factura,producto,cantidad,precio,iva) values (?,?,?,?,?,?)");
        $sql->execute(array($invoiceline->getID(), $invoiceline->getInvoiceId(), $invoiceline->getProduct(), $invoiceline->getQuantity(), $invoiceline->getPrice(), $invoiceline->getTax()));
        }

    public function update(Invoiceline $invoiceline){
		
        $id = $invoiceline->getID();
        $sql = $this->db->prepare("UPDATE linea_factura SET id_factura=?,producto=?,cantidad=?,precio=?,iva=? where id=?");
        $sql->execute(array($invoiceline->getInvoiceId(), $invoiceline->getProduct(), $invoiceline->getQuantity(), $invoiceline->getPrice(), $invoiceline->getTax(), $id));

    }

    public function delete(Invoiceline $invoicelineid){
        $sql = $this->db->prepare("DELETE FROM linea_factura where id=?");
        $sql->execute(array($invoicelineid->getID()));
    }
	

/*
    public function nameExists($activityName) {
        $sql = $this->db->prepare("SELECT count(nombre) FROM actividad where nombre=?");
        $sql->execute(array($activityName));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
   }
    public function nameExistsUpdate($activityName,$activityid) {
        $sql = $this->db->prepare("SELECT count(nombre) FROM actividad where nombre=? AND id<>$activityid ");
        $sql->execute(array($activityName));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }
*/	
}
