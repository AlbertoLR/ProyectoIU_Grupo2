<?php

require_once(__DIR__."/../core/PDOConnection.php");

class EXTERNALCUSTOMER_Model {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){//seleccionamos todos los clientes externos
        $sql = $this->db->prepare("SELECT * FROM cliente_externo ORDER BY nombre");
        $sql->execute();
        $clientesexternos_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $clientesexternos = array();

        foreach ($clientesexternos_db as $clienteexterno) {
            array_push($clientesexternos, new ExternalCustomer($clienteexterno["id"], $clienteexterno["dni_nif"], $clienteexterno["nombre"],$clienteexterno["apellido"], $clienteexterno["telefono"],$clienteexterno["email"]));
        }

        return $clientesexternos;
    }

    public function fetch($clienteexternoID){//seleccionamos un cliente externo
        $sql = $this->db->prepare("SELECT * FROM cliente_externo WHERE id=?");
        $sql->execute(array($clienteexternoID));
        $clienteexterno = $sql->fetch(PDO::FETCH_ASSOC);

        if($clienteexterno != NULL) {
            return new ExternalCustomer($clienteexterno["id"], $clienteexterno["dni_nif"], $clienteexterno["nombre"],
                                        $clienteexterno["apellido"], $clienteexterno["telefono"],$clienteexterno["email"]);
        } else {
            return NULL;
        }
    }

    public function insert(ExternalCustomer $clienteexterno) {//insertamos cliente externo
        $sql = $this->db->prepare("INSERT INTO cliente_externo(dni_nif,nombre,apellido,telefono,email) values (?,?,?,?,?)");
        $sql->execute(array($clienteexterno->getDni_nif(), $clienteexterno->getNombre(), $clienteexterno->getApellido(), $clienteexterno->getTelefono(), $clienteexterno->getEmail()));
		print_r($sql);
    }

    public function update(ExternalCustomer $clienteexterno){//actualizamos cliente externo
        $sql = $this->db->prepare("UPDATE cliente_externo SET dni_nif=?, nombre=?, apellido=?, telefono=?, email=? WHERE id=?");
        $sql->execute(array($clienteexterno->getDni_nif(), $clienteexterno->getNombre(), $clienteexterno->getApellido(), $clienteexterno->getTelefono(), $clienteexterno->getEmail(), $clienteexterno->getID()));
    }

    public function delete(ExternalCustomer $clienteexterno){//eliminamos cliente externo
		$sql = $this->db->prepare("DELETE FROM cliente_externo where id=?");
        $sql->execute(array($clienteexterno->getID()));
    }

    public function dniExists($dni_nif) {//buscamos cliente externo por dni
        $sql = $this->db->prepare("SELECT count(dni_nif) FROM cliente_externo where dni_nif=?");
        $sql->execute(array($dni_nif));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }
}
