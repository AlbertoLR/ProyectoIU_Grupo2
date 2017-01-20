<?php

require_once(__DIR__."/../core/PDOConnection.php");

class ASSISTANCE_Model {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }


    public function fetch($activityID){
      $sql = $this->db->prepare("SELECT cliente.id as idclie,actividad.id as act,actividad.nombre as actividad,cliente.nombre_c,cliente.dni_c FROM cliente,inscripcion,actividad
                                WHERE actividad.id=? AND cliente.dni_c=inscripcion.cliente_dni_c AND actividad.id=inscripcion.id_actividad AND inscripcion.fecha_baja is NULL");
      $sql->execute(array((int)$activityID));
      $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);
      if($list_db != NULL) {
          return $list_db;
      } else {
          return NULL;
      }

    }

    public function fetch_a($activityID){
      $sql = $this->db->prepare("SELECT cliente.id FROM cliente,inscripcion,actividad
                                WHERE actividad.id=? AND cliente.dni_c=inscripcion.cliente_dni_c AND actividad.id=inscripcion.id_actividad ");
      $sql->execute(array((int)$activityID));
      $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);
      if($list_db != NULL) {
          return $list_db;
      } else {
          return NULL;
      }

    }

    public function fetch_activity($sesion){
        $sql = $this->db->prepare("SELECT actividad_id FROM sesion WHERE id=?");
        $sql->execute(array((int)$sesion));
        $list_db = $sql->fetchColumn();

        if($list_db != NULL) {
            return $list_db;
        } else {
            return NULL;
        }

    }

    public function fetch_date($sesion){
        $sql = $this->db->prepare("SELECT sesion.id as si,dia,hora_inicio,hora_fin FROM sesion,horas_posibles,cliente WHERE sesion.horas_posibles_id=horas_posibles.id AND sesion.id=?");
        $sql->execute(array((int)$sesion));
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if($list_db != NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }

    public function fetch_sesion($sesion){
        $sql = $this->db->prepare("SELECT id_cliente,asiste,sesion_id  FROM asistencia WHERE sesion_id=?");
        $sql->execute(array((int)$sesion));
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $assistances = array();
        foreach ($list_db as $assistance) {
            array_push($assistances, new Assistance($assistance["id_cliente"], $assistance["asiste"],$assistance["sesion_id"]));
        }
        return $assistances;
    }


    public function insert(Assistance $assistance) {


      $sql = $this->db->prepare("SELECT asistencia.asiste FROM  asistencia WHERE sesion_id=? AND id_cliente=? ");
      $sql->execute(array((int)$assistance->getSessionID(),(int)$assistance->getClientID()));
      $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

      if($list_db == NULL) {
        $sql = $this->db->prepare("INSERT INTO asistencia(id_cliente,asiste,sesion_id) values (?,?,?)");
        $sql->execute(array((int)$assistance->getClientID(),$assistance->getAssistance(),(int)$assistance->getSessionID()));
      }else{
        $sql = $this->db->prepare("UPDATE asistencia SET asiste=? where id_cliente=? AND sesion_id=?");
        $sql->execute(array($assistance->getAssistance(),$assistance->getClientID(),$assistance->getSessionID()));
      }
    }


}
