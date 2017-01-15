<?php

require_once(__DIR__."/../core/PDOConnection.php");

class RESERVATION_Model {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){
        $sql = $this->db->prepare("SELECT * FROM reserva ORDER BY id");
        $sql->execute();
        $reservations_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $reservations = array();

        foreach ($reservations_db as $reservation) {
            array_push($reservations, new Reservation($reservation["id"], $reservation["dni_c"],$reservation["id_sesion"],$reservation["id_espacio"],$reservation["day"],$reservation["precio_espacio"],$reservation["precio_fisio"]));
        }

        return $reservations;
    }

    public function fetch($reservationid){
      $sql = $this->db->query("SELECT * FROM reserva WHERE reserva.id=? ORDER BY id");
        $sql->execute(array($reservationid));
        $reservation = $sql->fetch(PDO::FETCH_ASSOC);

        if($reservation != NULL) {
            return new Reservation($reservation["id"], $reservation["dni_c"],$reservation["id_sesion"],$reservation["id_espacio"],$reservation["day"],$reservation["precio_espacio"],$reservation["precio_fisio"]);
        } else {
              return NULL;
          }
        }
//Recapitulación de la tabla sesion//
    public function fetchSession(){
        $sql = $this->db->query("SELECT * FROM sesion ORDER BY id DESC");
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if($list_db != NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }
//Recapitulación de la tabla espacio//
    public function fetchSpace(){
        $sql = $this->db->query("SELECT * FROM espacio");
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if($list_db != NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }
//Recapitulación de la tabla cliente//
    public function fetchClient(){
        $sql = $this->db->query("SELECT * FROM cliente ");
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if($list_db != NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }

    public function insert(Reservation $reservation) {
		if($reservation->getSessionId() == ""){
        $id_sesion=NULL;
      }
      else{
        $id_sesion = $reservation->getSessionId();
      }	
	  
		if($reservation->getSpaceid() == ""){
        $id_espacio=NULL;
      }
      else{
        $id_espacio = $reservation->getSpaceid();
      }
		
		if($reservation->getDay() == ""){
        $day=NULL;
      }
      else{
        $day = $reservation->getDay();
      }
		if($reservation->getSpacePrice() == ""){
        $precio_espacio=NULL;
      }
      else{
        $precio_espacio = $reservation->getSpacePrice();
	  }
	  
		if($reservation->getPhysioPrice() == ""){
        $precio_fisio=NULL;
      }
      else{
        $precio_fisio = $reservation->getPhysioPrice();
      }
	  
        $sql = $this->db->prepare("INSERT INTO reserva(id,dni_c,id_sesion,id_espacio,day,precio_espacio,precio_fisio) values (?,?,?,?,?,?,?)");
        $sql->execute(array($reservation->getID(), $reservation->getClientId(), $id_sesion, $id_espacio, $reservation->getDay(), $precio_espacio, $precio_fisio));
        }

    public function update(Reservation $reservation){
		if($reservation->getSessionId() == ""){
        $id_sesion=NULL;
      }
      else{
        $id_sesion = $reservation->getSessionId();
      }	
	  
		if($reservation->getSpaceid() == ""){
        $id_espacio=NULL;
      }
      else{
        $id_espacio = $reservation->getSpaceid();
      }
	  
		if($reservation->getDay() == ""){
        $day=NULL;
      }
      else{
        $day = $reservation->getDay();
      }
	  
		if($reservation->getSpacePrice() == ""){
        $precio_espacio=NULL;
		}
      else{
        $precio_espacio = $reservation->getSpacePrice();
	  }
	  
		if($reservation->getPhysioPrice() == ""){
        $precio_fisio=NULL;
      }
      else{
        $precio_fisio = $reservation->getPhysioPrice();
      }
        $id = $reservation->getID();
        $sql = $this->db->prepare("UPDATE reserva SET dni_c=?,id_sesion=?,id_espacio=?,day=?,precio_espacio=?,precio_fisio=? WHERE id=?");
        $sql->execute(array($reservation->getClientId(), $id_sesion, $id_espacio, $day, $precio_espacio, $precio_fisio, $id));

    }

    public function delete(Reservation $reservationid){
        $sql = $this->db->prepare("DELETE FROM reserva WHERE id=?");
        $sql->execute(array($reservationid->getID()));
    }
	
//Comprobamos que no haya una reserva de un espacio el mismo día//		
	
	public function reservationExists($espacio, $day) {
        $sql = $this->db->prepare("SELECT COUNT(id_espacio) FROM reserva WHERE id_espacio=? AND day=?");
        $sql->execute(array($espacio, $day));
    
        if ($sql->fetchColumn() > 0) {   
            return true;
        } 
    }
	
//Comprobamos que no haya una reserva de un espacio el mismo día//		
	
	public function reservationExistsUpdate($espacio,$day,$reservationid) {
        $sql = $this->db->prepare("SELECT COUNT(id_espacio) FROM reserva WHERE id_espacio=? AND day=? AND id<>? ");
        $sql->execute(array($espacio,$day,$reservationid));

        if ($sql->fetchColumn() > 0) {
            return true;
		}
	}
}
