<?php

require_once(__DIR__."/../core/PDOConnection.php");

class HOUR_Model {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){
        $sql = $this->db->prepare("SELECT * FROM horas_posibles");
        $sql->execute();
        $hours_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $hours = array();

        foreach ($hours_db as $hour) {
            array_push($hours, new Hour($hour["id"], $hour["dia"],$hour["hora_inicio"],$hour["hora_fin"],$hour["rango_horario_id"],$hour["active"]));
        }

        return $hours;
    }

    public function fetch($hourID){
        $sql = $this->db->prepare("SELECT * FROM horas_posibles WHERE id=?");
        $sql->execute(array($hourID));
        $hour = $sql->fetch(PDO::FETCH_ASSOC);

        if ($hour != NULL) {
            return new Hour($hour["id"], $hour["dia"],$hour["hora_inicio"],$hour["hora_fin"],$hour["rango_horario_id"]);
        } else {
            return NULL;
        }
    }

    public function fetch_ranks(){
        $sql = $this->db->prepare("SELECT * FROM rango_horario");
        $sql->execute();
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if ($list_db!= NULL) {
            return $list_db;
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

    public function insert(Hour $hour) {
        $sql = $this->db->prepare("INSERT INTO horas_posibles(dia,hora_inicio,hora_fin,rango_horario_id,active) values (?,?,?,?,?)");
        $sql->execute(array($hour->getDay(),$hour->getOpening(),$hour->getClosing(),$hour->getRankID(),$hour->getActive()));
    }


    public function delete(Hour $hour){
        $sql = $this->db->prepare("DELETE FROM horas_posibles where id=?");
        $sql->execute(array($hour->getID()));
    }

}
