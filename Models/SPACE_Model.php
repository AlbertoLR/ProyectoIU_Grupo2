<?php

require_once(__DIR__."/../core/PDOConnection.php");

class SPACE_Model {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){
        $sql = $this->db->prepare("SELECT * FROM espacio");
        $sql->execute();
        $espacios_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $espacios = array();

        foreach ($espacios_db as $espacio) {
            array_push($espacios, new Space($espacio["id"], $espacio["nombre"]));
        }

        return $espacios;
	}

    public function fetch($espacioID){
        $sql = $this->db->prepare("SELECT * FROM espacio WHERE id=?");
        $sql->execute(array($espacioID));
        $espacio = $sql->fetch(PDO::FETCH_ASSOC);

        if ($espacio != NULL) {
            return new Space($espacio["id"], $espacio["nombre"]);
        } else {
            return NULL;
        }
    }

    public function insert(Space $espacio) {
        $sql = $this->db->prepare("INSERT INTO espacio(nombre) values (?)");
        $sql->execute(array($espacio->getNombre()));
    }

    public function update(Space $espacio){
        $sql = $this->db->prepare("UPDATE espacio SET nombre=? where id=?");
        $sql->execute(array($espacio->getNombre(), $espacio->getID()));
    }

    public function delete(Space $espacio){
        $sql = $this->db->prepare("DELETE FROM espacio where id=?");
        $sql->execute(array($espacio->getID()));
    }

    public function nameExists($name) {
        $sql = $this->db->prepare("SELECT count(nombre) FROM espacio where nombre=?");
        $sql->execute(array($name));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }

	public function search($query) {
        $search_query = "SELECT * FROM espacio WHERE ". $query;
        $sql = $this->db->prepare($search_query);
        $sql->execute();
        $espacios_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $espacios = array();

        foreach ($espacios_db as $espacio) {
            array_push($espacios, new Space($espacio["id"], $espacio["nombre"]));
        }

        return $espacios;
    }

	public function filter($query) {

		$espacios = array();

		$filter_query = "SELECT id,nombre FROM espacio";
		$sql = $this->db->prepare($filter_query);
    $sql->execute();
    $espacios_db = $sql->fetchAll(PDO::FETCH_ASSOC);
		foreach ($espacios_db as $espacio) {
            array_push($espacios, $espacio["id"]);
        }
		$espaciosOcupados = array();
		$filter_query = "SELECT espacio_id FROM sesion s, horas_posibles h WHERE s.horas_posibles_id=h.id AND ". $query;
        $sql = $this->db->prepare($filter_query);
        $sql->execute();
        $espaciosOcupados_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($espaciosOcupados_db)){
		        foreach ($espaciosOcupados_db as $espacio) {
            array_push($espaciosOcupados, $espacio["espacio_id"]);
        }
      }

		$espacioslibres = array();

		$espacioslibres = array_diff($espacios, $espaciosOcupados);

    $toret = array();
    foreach ($espacioslibres as $key) {
      $query = "SELECT id,nombre FROM espacio WHERE id=$key";
      $sql = $this->db->prepare($query);
      $sql->execute();
      $espacios_db = $sql->fetchAll(PDO::FETCH_ASSOC);
      foreach ($espacios_db as $espacio) {
              array_push($toret, new Space ($espacio["id"],$espacio["nombre"]));
          }
    }

    return $toret;
    }

    public function nameExistsUpdate($spaceName,$spaceid) {
        $sql = $this->db->prepare("SELECT count(nombre) FROM espacio where nombre=? AND id<>$spaceid ");
        $sql->execute(array($spaceName));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }
}
