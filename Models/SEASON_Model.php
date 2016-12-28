<?php

require_once(__DIR__."/../core/PDOConnection.php");

class SEASON_Model {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){
        $sql = $this->db->prepare("SELECT * FROM horario_temporada");
        $sql->execute();
        $seasons_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $seasons = array();

        foreach ($seasons_db as $season) {
            array_push($seasons, new Season($season["id"], $season["dia_inicio"],$season["dia_fin"],$season["nombre_temp"]));
        }

        return $seasons;
    }

    public function fetch($seasonID){
        $sql = $this->db->prepare("SELECT * FROM horario_temporada WHERE id=?");
        $sql->execute(array($seasonID));
        $season = $sql->fetch(PDO::FETCH_ASSOC);

        if ($season != NULL) {
            return new Season($season["id"], $season["dia_inicio"],$season["dia_fin"],$season["nombre_temp"]);
        } else {
            return NULL;
        }
    }

    public function insert(Season $season) {
        $sql = $this->db->prepare("INSERT INTO horario_temporada(dia_inicio,dia_fin,nombre_temp) values (?,?,?)");
        $sql->execute(array($season->getdateStart(),$season->getdateEnd(),$season->getDescription()));
    }

    public function update(Season $season){
        $sql = $this->db->prepare("UPDATE horario_temporada SET dia_inicio=?,dia_fin=?,nombre_temp=? where id=?");
        $sql->execute(array($season->getdateStart(),$season->getdateEnd(),$season->getDescription(),$season->getID()));
    }

    public function delete(Season $season){
        $sql = $this->db->prepare("DELETE FROM horario_temporada where id=?");
        $sql->execute(array($season->getID()));
    }

    public function nameExists($name) {
        $sql = $this->db->prepare("SELECT count(nombre_temp) FROM horario_temporada where nombre_temp=? ");
        $sql->execute(array($name));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }

    public function nameExistsUpdate($name,$id) {
        $sql = $this->db->prepare("SELECT count(nombre_temp) FROM horario_temporada where nombre_temp=? AND id<>'$id' ");
        $sql->execute(array($name,$id));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }
}
