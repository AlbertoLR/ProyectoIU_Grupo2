<?php

require_once(__DIR__."/../core/PDOConnection.php");

class EVENT_Model {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){
        $sql = $this->db->prepare("SELECT * FROM evento");
        $sql->execute();
        $eventos_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $eventos = array();

        foreach ($eventos_db as $evento) {
            array_push($eventos, new Event($evento["id"], $evento["nombre"], $evento["precio"]));
        }

        return $eventos;
	}

    public function fetch($eventoID){
        $sql = $this->db->prepare("SELECT * FROM evento WHERE id=?");
        $sql->execute(array($eventoID));
        $evento = $sql->fetch(PDO::FETCH_ASSOC);

        if ($evento != NULL) {
            return new Event($evento["id"], $evento["nombre"], $evento["precio"]);
        } else {
            return NULL;
        }
    }

	public function fetch_inscriptions($eventoid){
        $sql = $this->db->prepare("SELECT inscripcion.id,evento.nombre as evento,inscripcion.fecha,espacio.nombre,cliente.nombre_c,cliente.dni_c FROM cliente,inscripcion,evento,espacio
                                  WHERE evento.id=? AND cliente.dni_c=inscripcion.cliente_dni_c AND evento.id=inscripcion.evento_id GROUP BY inscripcion.id");
        $sql->execute(array($eventoid));
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if($list_db != NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }

    public function insert(Event $evento) {
        $sql = $this->db->prepare("INSERT INTO evento(nombre, precio) values (?,?)");
        $sql->execute(array($evento->getNombre(), $evento->getPrecio()));
    }

    public function update(Event $evento){
        $sql = $this->db->prepare("UPDATE evento SET nombre=?, precio=? where id=?");
        $sql->execute(array($evento->getNombre(), $evento->getPrecio(),$evento->getID()));
    }

    public function delete(Event $evento){
        $sql = $this->db->prepare("DELETE FROM evento where id=?");
        $sql->execute(array($evento->getID()));
    }

    public function nameExists($name) {
        $sql = $this->db->prepare("SELECT count(nombre) FROM evento where nombre=?");
        $sql->execute(array($name));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }

	public function search($query) {
        $search_query = "SELECT * FROM evento WHERE ". $query;
        $sql = $this->db->prepare($search_query);
        $sql->execute();
        $eventos_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $eventos = array();

        foreach ($eventos_db as $evento) {
            array_push($eventos, new Event($evento["id"], $evento["nombre"]));
        }

        return $eventos;
    }

    public function nameExistsUpdate($eventName,$eventid) {
        $sql = $this->db->prepare("SELECT count(nombre) FROM evento where nombre=? AND id<>$eventid ");
        $sql->execute(array($eventName));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }


}
