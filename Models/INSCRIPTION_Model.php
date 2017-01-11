<?php
require_once(__DIR__."/../core/PDOConnection.php");

class INSCRIPTION_Model {

    private $db;

    //constructor del modelo inscripción
    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    //devuelve todas las inscripciones
    public function fetch_all(){
        $sql = $this->db->prepare("SELECT * FROM inscripcion ORDER BY fecha");
        $sql->execute();
        $inscriptions_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $inscriptions = array();

        foreach ($inscriptions_db as $inscription) {
            array_push($inscriptions, new Inscription($inscription["id"], $inscription["fecha"], $inscription["particular_externo_id"], $inscription["evento_id"], $inscription["reserva_id"], $inscription["cliente_dni_c"], $inscription["id_actividad"]));
        }

        return $inscriptions;
    }

    //devuelve una inscripción por su número id
    public function fetch($IDInscripcion){
        $sql = $this->db->prepare("SELECT * FROM inscripcion WHERE id=?");
        $sql->execute(array($IDInscripcion));
        $inscription = $sql->fetch(PDO::FETCH_ASSOC);

        if($inscription != NULL) {
            return new Inscription($inscription["id"], $inscription["fecha"], $inscription["particular_externo_id"], $inscription["evento_id"], $inscription["reserva_id"], $inscription["cliente_dni_c"], $inscription["id_actividad"]);
        } else {
            return NULL;
        }

    }

    //devuelve todos los clientes particulares externos
    public function fetch_particular(){
        $sql = $this->db->prepare("SELECT * FROM particular_externo");
        $sql->execute();
        $particular = $sql->fetchAll(PDO::FETCH_ASSOC);

        if($particular != NULL) {
            return $particular;
        } else {
            return NULL;
        }

    }

    //devuelve todos los eventos
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

    //devuelve todas las reservas
    public function fetch_reserve(){
        $sql = $this->db->prepare("SELECT * FROM reserva");
        $sql->execute();
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if ($list_db!= NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }

    //devuelve todos los clientes
    public function fetch_clients(){
        $sql = $this->db->prepare("SELECT * FROM cliente");
        $sql->execute();
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if ($list_db!= NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }

    //devuelve todas las actividades
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

    //inserta un inscripción
    public function insert(Inscription $inscription) {

        $sql = $this->db->prepare("INSERT INTO inscripcion(fecha,particular_externo_id,evento_id,reserva_id,cliente_dni_c,id_actividad) values (?,?,?,?,?,?)");
        $sql->execute(array($inscription->getFecha(),$inscription->getID_Particular_Externo(),$inscription->getID_Evento(),$inscription->getID_Reserva(),$inscription->getDNI_Cliente(), $inscription->getID_Actividad()));
    }

    //actualiza un inscripción
    public function update(Inscription $inscription){
        $sql = $this->db->prepare("UPDATE inscripcion SET fecha=?, particular_externo_id=?, evento_id=?, reserva_id=?, cliente_dni_c=?, id_actividad=?  where id=?");
        $sql->execute(array($inscription->getFecha(),$inscription->getID_Particular_Externo(),$inscription->getID_Evento(),$inscription->getID_Reserva(),$inscription->getDNI_Cliente(),$inscription->getID_Actividad(), $inscription->getIDInscripcion()));
    }

    //borra un inscripción
    public function delete(Inscription $inscription){
        $sql = $this->db->prepare("DELETE FROM inscripcion where id=?");
        $sql->execute(array($inscription->getIDInscripcion()));
    }

}
