<?php

require_once(__DIR__."/../core/PDOConnection.php");

class SERVICE_Model {

    private $db;

    //constructor del modelo servicio
    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    //devuelve todos los servicios
    public function fetch_all(){
        $sql = $this->db->prepare("SELECT * FROM servicio ORDER BY fecha");
        $sql->execute();
        $services_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $services = array();

        foreach ($services_db as $service) {
            array_push($services, new Service($service["id"], $service["fecha"], $service["coste"], $service["descripcion"], $service["pago_id"], $service["cliente_externo_id"]));
        }

        return $services;
    }

    //devuelve todos los clientes externos
    public function fetch_Cliente_Externo(){
        $sql = $this->db->prepare("SELECT * FROM cliente_externo");
        $sql->execute();
        $clienteEx = $sql->fetchAll(PDO::FETCH_ASSOC);

        if($clienteEx != NULL) {
            return $clienteEx;
        } else {
            return NULL;
        }

    }

    //devuelve todos los pagos
    public function fetch_Pago(){
        $sql = $this->db->prepare("SELECT * FROM pago");
        $sql->execute();
        $pago = $sql->fetchAll(PDO::FETCH_ASSOC);

        if($pago != NULL) {
            return $pago;
        } else {
            return NULL;
        }

    }

    //devuelve un servicio por su numero id
    public function fetch($IDServicio){
        $sql = $this->db->prepare("SELECT * FROM servicio WHERE id=?");
        $sql->execute(array($IDServicio));
        $service = $sql->fetch(PDO::FETCH_ASSOC);

        if($service != NULL) {
            return new Service($service["id"], $service["fecha"], $service["coste"], $service["descripcion"], $service["pago_id"], $service["cliente_externo_id"]);
        } else {
            return NULL;
        }

    }

    //inserto un servicio, y su pago asociado
    public function insert(Service $service, $metodo, $frecuencia, $recibido) {

        $sql1 = $this->db->prepare("INSERT INTO pago(metodo_pago,fecha,periodicidad,cantidad,realizado) values (?,?,?,?,?)");
        $sql1->execute(array($metodo,$service->getFecha(),$frecuencia,$service->getCoste(),$recibido));

        $sql2 = $this->db->prepare("SELECT MAX(id) as id FROM pago");
        $sql2->execute();
        $maxs = $sql2->fetchAll(PDO::FETCH_ASSOC);

        foreach ($maxs as $max) {
           $id = $max["id"];
        }

        $sq3 = $this->db->prepare("INSERT INTO servicio(fecha,coste,descripcion,pago_id,cliente_externo_id) values (?,?,?,?,?)");
        $sq3->execute(array($service->getFecha(),$service->getCoste(),$service->getDescripcion(),$id,$service->getIDCliente()));
    }

    //actualizo un servicio, y su pago asociado
    public function update(Service $service, $metodo, $frecuencia, $recibido){

        $sql = $this->db->prepare("UPDATE pago SET metodo_pago=?, fecha=?, periodicidad=?, cantidad=?, realizado=?  where id=?");
        $sql->execute(array($metodo,$service->getFecha(),$frecuencia,$service->getCoste(),$recibido,$service->getID_Pago()));


        $sql2 = $this->db->prepare("UPDATE servicio SET fecha=?, coste=?, descripcion=?, pago_id=?, cliente_externo_id=?  where id=?");
        $sql2->execute(array($service->getFecha(),$service->getCoste(),$service->getDescripcion(),$service->getID_Pago(),$service->getIDCliente(),$service->getIDServicio()));
    }

    //borro un servicio, y su pago asociado
    public function delete(Service $service){
        $sql = $this->db->prepare("DELETE FROM pago where id=?");
        $sql->execute(array($service->getID_Pago()));

        $sql = $this->db->prepare("DELETE FROM servicio where id=?");
        $sql->execute(array($service->getIDServicio()));
    }

}