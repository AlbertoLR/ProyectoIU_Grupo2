<?php

require_once(__DIR__."/../core/PDOConnection.php");

class PHYSIOTHERAPISTHOUR_Model {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){
        $sql = $this->db->prepare("SELECT * FROM posible_fisio ORDER BY dia,hora_i,hora_f");
        $sql->execute();
        $physiotherapisthours_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $physiotherapisthours = array();

        foreach ($physiotherapisthours_db as $physiotherapisthour) {
            array_push($physiotherapisthours, new Physiotherapisthour($physiotherapisthour["id"], $physiotherapisthour["dia"],$physiotherapisthour["hora_i"],$physiotherapisthour["hora_f"]));
        }

        return $physiotherapisthours;
    }

    public function fetch($physiotherapisthourID){
      $sql = $this->db->prepare("SELECT * FROM posible_fisio WHERE id=?");
        $sql->execute(array($physiotherapisthourID));
        $physiotherapisthour = $sql->fetch(PDO::FETCH_ASSOC);

        if($physiotherapisthour != NULL) {
            return new Physiotherapisthour($physiotherapisthour["id"], $physiotherapisthour["dia"],$physiotherapisthour["hora_i"],$physiotherapisthour["hora_f"]);
        } else {
          return NULL;
        }
    }

    public function insert(Physiotherapisthour $physiotherapisthour) {		
		$sql3 = $this->db->prepare("INSERT INTO posible_fisio(dia,hora_i,hora_f) values (?,?,?)");
        $sql3->execute(array($physiotherapisthour->getDay(),$physiotherapisthour->getStarttime(), $physiotherapisthour->getEndtime()));
    }

    public function update(Physiotherapisthour $physiotherapisthour){
		$sql=$this->db->prepare("UPDATE posible_fisio SET dia=?, hora_i=?, hora_f=? WHERE id=?");
		$sql->execute(array($physiotherapisthour->getDay(),$physiotherapisthour->getStarttime(),$physiotherapisthour->getEndtime(),$physiotherapisthour->getID()));
		}

    public function delete(Physiotherapisthour $physiotherapisthour){
        $sql = $this->db->prepare("DELETE FROM posible_fisio where id=?");
        $sql->execute(array($physiotherapisthour->getID()));
    }


    public function rightDayTime($physiotherapisthourday,$physiotherapisthourstime,$physiotherapisthouretime) {
		$sql = $this->db->prepare("SELECT min(hora_apertura) as ha FROM rango_horario where dia_s=? ");
		switch($physiotherapisthourday){
			case "1":
				$fecha= "monday";
				break;
			case "2":
				$fecha= "tuesday";
				break;
			case "3":
				$fecha= "wednesday";
				break;
			case "4":
				$fecha= "thursday";
				break;
			case "5":
				$fecha= "friday";
				break;
			case "6":
				$fecha= "saturday";
				break;
			case "7":
				$fecha= "sunday";
				break;
		}
		$sql->execute(array($fecha));
		$ha_db = $sql->fetchAll(PDO::FETCH_ASSOC);
		$ha=$ha_db[0]['ha'];
		if(!isset($ha)){
			return 5;
		}
		if(strtotime($physiotherapisthourstime)<strtotime($ha)){
			return 1;
		}
		
		$sql1 = $this->db->prepare("SELECT max(hora_cierre) as hc FROM rango_horario where dia_s=? AND hora_apertura=? ");
		$sql1->execute(array($fecha,$ha));
		$hc_db = $sql1->fetchAll(PDO::FETCH_ASSOC);
		$hc=$hc_db[0]['hc'];
		if (!isset($hc)){								
					return 5;
				}
		if(strtotime($physiotherapisthouretime)>strtotime($hc)){
			return 2;
		}
		if(strtotime($physiotherapisthourstime)>strtotime($physiotherapisthouretime)){
			return 3;
		}
		return 4;        
	}
	public function search($query) {
        $search_query = "SELECT * FROM posible_fisio WHERE ". $query;
        $sql = $this->db->prepare($search_query);
        $sql->execute();
        $physiotherapisthour_db = $sql->fetchAll(PDO::FETCH_ASSOC);
        $physiotherapisthours = array();
        foreach ($physiotherapisthour_db as $physiotherapisthour) {
            array_push($physiotherapisthours, new Physiotherapisthour($physiotherapisthour["id"],$physiotherapisthour["dia"],$physiotherapisthour["hora_i"], $physiotherapisthour["hora_f"]));
        }
        return $physiotherapisthours;
    }
}
