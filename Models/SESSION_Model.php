<?php

require_once(__DIR__."/../core/PDOConnection.php");

class SESSION_Model {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){
        $sql = $this->db->prepare("SELECT sesion.* FROM sesion");
        $sql->execute();
        $sessions_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $sessions = array();

        foreach ($sessions_db as $session) {
            array_push($sessions, new Session($session["id"], $session["actividad_id"],$session["horas_posibles_id"],$session["evento_id"],$session["user_id"],$session["espacio_id"]));
        }

        return $sessions;
    }

    public function fetch($sessionID){
        $sql = $this->db->prepare("SELECT * FROM sesion WHERE id=?");
        $sql->execute(array($sessionID));
        $session = $sql->fetch(PDO::FETCH_ASSOC);

        if ($session != NULL) {
            return new Session($session["id"], $session["actividad_id"],$session["horas_posibles_id"],$session["evento_id"],$session["user_id"],$session["espacio_id"]);
        } else {
            return NULL;
        }
    }

    public function fetch_activities(){
        $sql = $this->db->prepare("SELECT * FROM actividad");
        $sql->execute();
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if ($list_db!= NULL) {
            return $list_db;
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

    public function fetch_hours(){
        $sql = $this->db->prepare("SELECT * FROM horas_posibles");
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

    public function fetch_events(){
        $sql = $this->db->prepare("SELECT * FROM evento");
        $sql->execute();
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if ($list_db!= NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }

    public function fetch_users(){
        $sql = $this->db->prepare("SELECT * FROM user");
        $sql->execute();
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if ($list_db!= NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }

    public function fetch_spaces(){
        $sql = $this->db->prepare("SELECT * FROM espacio");
        $sql->execute();
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if ($list_db!= NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }

    public function insert(Session $session) {

      if($session->getEventID() == ""){
        $event=NULL;
      }
      else{
        $event = $session->getEventID();
      }

      if($session->getActivityID() == ""){
        $activity=NULL;
      }
      else{
        $activity = $session->getActivityID();
      }

        $sql = $this->db->prepare("INSERT INTO sesion(actividad_id,horas_posibles_id,evento_id,user_id,espacio_id) values (?,?,?,?,?)");
        $sql->execute(array($activity,$session->getHoursID(),$event,$session->getUserID(),$session->getSpaceID()));

        $sql1 = $this->db->prepare("UPDATE horas_posibles SET active=true where id=?");
        $sql1->execute(array($session->getHoursID()));
    }

    public function update(Session $session){

      if($session->getEventID() == ""){
        $event=NULL;
      }
      else{
        $event = $session->getEventID();
      }

      if($session->getActivityID() == ""){
        $activity=NULL;
      }
      else{
        $activity = $session->getActivityID();
      }

      $sql = $this->db->prepare("UPDATE sesion SET actividad_id=?,horas_posibles_id=?,evento_id=?,user_id=?,espacio_id=? where id=?");
      $sql->execute(array($activity,$session->getHoursID(),$event,$session->getUserID(),$session->getSpaceID(),$session->getID()));

      $sql1 = $this->db->prepare("UPDATE horas_posibles SET active=true where id=?");
      $sql1->execute(array($session->getHoursID()));

    }


    public function delete(Session $session){
        $sql = $this->db->prepare("DELETE FROM sesion where id=?");
        $sql->execute(array($session->getID()));

        $sql1 = $this->db->prepare("UPDATE horas_posibles SET active=false where id=?");
        $sql1->execute(array($session->getHoursID()));
    }

}
