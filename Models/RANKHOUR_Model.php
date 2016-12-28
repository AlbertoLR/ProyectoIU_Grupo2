<?php

require_once(__DIR__."/../core/PDOConnection.php");

class RANKHOUR_Model {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){
        $sql = $this->db->prepare("SELECT * FROM rango_horario");
        $sql->execute();
        $rankhours_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $rankhours = array();

        foreach ($rankhours_db as $rankhour) {
            array_push($rankhours, new Rankhour($rankhour["id"], $rankhour["dia_s"],$rankhour["hora_apertura"],$rankhour["hora_cierre"],$rankhour["horario_temporada_id"]));
        }

        return $rankhours;
    }

    public function fetch($rankhourID){
        $sql = $this->db->prepare("SELECT * FROM rango_horario WHERE id=?");
        $sql->execute(array($rankhourID));
        $rankhour = $sql->fetch(PDO::FETCH_ASSOC);

        if ($rankhour != NULL) {
            return new Rankhour($rankhour["id"], $rankhour["dia_s"],$rankhour["hora_apertura"],$rankhour["hora_cierre"],$rankhour["horario_temporada_id"]);
        } else {
            return NULL;
        }
    }

    public function fetch_seasons(){
        $sql = $this->db->prepare("SELECT * FROM horario_temporada");
        $sql->execute();
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if ($list_db!= NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }

    public function insert(Rankhour $rankhour) {
        $sql = $this->db->prepare("INSERT INTO rango_horario(dia_s,hora_apertura,hora_cierre,horario_temporada_id) values (?,?,?,?)");
        $sql->execute(array($rankhour->getDay(),$rankhour->getOpening(),$rankhour->getClosing(),$rankhour->getSeasonID()));
    }


    public function delete(Rankhour $rankhour){
        $sql = $this->db->prepare("DELETE FROM rango_horario where id=?");
        $sql->execute(array($rankhour->getID()));
    }

}
