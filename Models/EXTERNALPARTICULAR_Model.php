<?php

require_once(__DIR__."/../core/PDOConnection.php");

class EXTERNALPARTICULAR_Model {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){//seleccionamos todos los particulares
        $sql = $this->db->prepare("SELECT * FROM particular_externo ORDER BY nombre");
        $sql->execute();
        $particularesexternos_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $particularesexternos = array();

        foreach ($particularesexternos_db as $particularexterno) {
            array_push($particularesexternos, new ExternalParticular($particularexterno["id"], $particularexterno["nombre"],$particularexterno["apellidos"], $particularexterno["telefono"]));
        }

        return $particularesexternos;
    }

    public function fetch($particularexternoID){//seleccionamos un particular
        $sql = $this->db->prepare("SELECT * FROM particular_externo WHERE id=?");
        $sql->execute(array($particularexternoID));
        $particularexterno = $sql->fetch(PDO::FETCH_ASSOC);

        if($particularexterno != NULL) {
            return new ExternalParticular($particularexterno["id"], $particularexterno["nombre"],$particularexterno["apellidos"], $particularexterno["telefono"]);
        } else {
            return NULL;
        }
    }

    public function insert(ExternalParticular $particularexterno) {//insertamos particular
        $sql = $this->db->prepare("INSERT INTO particular_externo(nombre,apellidos,telefono) values (?,?,?)");
        $sql->execute(array($particularexterno->getNombre(), $particularexterno->getApellidos(), $particularexterno->getTelefono()));
		print_r($sql);
    }

    public function update(ExternalParticular $particularexterno){//actualizamos particular
        $sql = $this->db->prepare("UPDATE particular_externo SET nombre=?, apellidos=?, telefono=? WHERE id=?");
        $sql->execute(array($particularexterno->getNombre(), $particularexterno->getApellidos(), $particularexterno->getTelefono(), $particularexterno->getID()));
    }

    public function delete(ExternalParticular $particularexterno){//eliminamos particular
		$sql = $this->db->prepare("DELETE FROM particular_externo where id=?");
        $sql->execute(array($particularexterno->getID()));
    }
	
	public function search($query) {//buscamos movimiento con los parametros que deseamos
        $search_query = "SELECT * FROM particular_externo WHERE ". $query;
        $sql = $this->db->prepare($search_query);
        $sql->execute();
        $particularesexternos_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $particularesexternos = array();

        foreach ($particularesexternos_db as $particularexterno) {
            array_push($particularesexternos, new ExternalParticular($particularexterno["id"],$particularexterno["nombre"],
                                        $particularexterno["apellidos"], $particularexterno["telefono"] ));
        }
        return $particularesexternos;
    }
}