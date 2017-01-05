<?php

require_once(__DIR__."/../core/PDOConnection.php");

class PHYSIOTHERAPIST_Model {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){
        $sql = $this->db->prepare("SELECT * FROM hora_fisio ORDER BY dia_f");
        $sql->execute();
        $physiotherapists_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $physiotherapists = array();

        foreach ($physiotherapists_db as $physiotherapist) {
            array_push($physiotherapists, new Physiotherapist($physiotherapist["id"], $physiotherapist["id_reserva"],$physiotherapist["dia_f"],$physiotherapist["asistencia"],null,null,null,$physiotherapist["id_hora"]));
        }

        return $physiotherapists;
    }

    public function fetch($physiotherapistID){
      $sql = $this->db->prepare("SELECT h.id, h.dia_f,h.asistencia,h.id_reserva,r.dni_c,r.precio_fisio,h.id_hora FROM hora_fisio h, reserva r
								WHERE h.id=? AND h.id_reserva=r.id");
        $sql->execute(array($physiotherapistID));
        $physiotherapist = $sql->fetch(PDO::FETCH_ASSOC);

        if($physiotherapist != NULL) {
            return new Physiotherapist($physiotherapist["id"],$physiotherapist["id_reserva"], $physiotherapist["dia_f"],$physiotherapist["asistencia"],$physiotherapist["precio_fisio"],null,$physiotherapist["dni_c"],$physiotherapist["id_hora"]);
        } else {
          return NULL;
        }
    }

    public function fetchClients(){
        $sql = $this->db->query("SELECT id,dni_c,nombre_c,apellidos_c,telefono FROM cliente WHERE activo=1 ORDER BY apellidos_c");
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if($list_db != NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }

	public function fetchHours(){
        $sql = $this->db->query("SELECT * FROM posible_fisio ORDER BY dia, hora_i");
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if($list_db != NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }

    public function insert(Physiotherapist $physiotherapist) {
      print_r($physiotherapist);     
        $id_c=$physiotherapist->getIDCliente();
		$sql=$this->db->query("SELECT c.dni_c FROM cliente c WHERE c.id=$id_c");
		$id_c = $sql->fetch(PDO::FETCH_ASSOC);
		$dni=$id_c["dni_c"];
		$sql->closeCursor();
		$sql1 = $this->db->prepare("INSERT INTO reserva(dni_c,precio_fisio) values (?,?)");
        $sql1->execute(array($dni,$physiotherapist->getPrice()));

		$sql2=$this->db->query("SELECT id FROM reserva WHERE dni_c=? AND precio_fisio=?");
		$sql2->execute(array($dni,$physiotherapist->getPrice()));
		$id_r=$sql2->fetch(PDO::FETCH_ASSOC);
		$res=$id_r["id"];
		$sql2->closeCursor();

		$sql3 = $this->db->prepare("INSERT INTO hora_fisio(id_reserva,dia_f,id_hora) values (?,?,?)");
        $sql3->execute(array($res, $physiotherapist->getDay(),$physiotherapist->getIDHour()));
    }

    public function update(Physiotherapist $physiotherapist){
		$reserid1=$physiotherapist->getReservationid();
		$id_c=$physiotherapist->getIDCliente();
		$sql1=$this->db->query("SELECT c.dni_c FROM cliente c WHERE c.id=$id_c");
		$id_c = $sql1->fetch(PDO::FETCH_ASSOC);
		$sql3=$this->db->prepare("UPDATE reserva SET dni_c=?, precio_fisio=? WHERE id=?");
		$sql3->execute(array($id_c["dni_c"],$physiotherapist->getPrice(),$reserid1));
		$sql5=$this->db->prepare("UPDATE hora_fisio SET dia_f=?,id_hora=?,asistencia=? WHERE id=?");
		$sql5->execute(array($physiotherapist->getDay(),$physiotherapist->getIDHour(),$physiotherapist->getAttendance(),$physiotherapist->getID()));
    }

    public function delete(Physiotherapist $physiotherapist){
        $sql = $this->db->prepare("DELETE FROM hora_fisio where id=?");
        $sql->execute(array($physiotherapist->getID()));
    }
	public function rightDayTime($physiotherapistday,$physiotherapistidtime,$physiotherapistid) {
		$sql = $this->db->prepare("SELECT dia_f as ha FROM hora_fisio where id=? ");
		$sql->execute(array($physiotherapistid));
		$ha_db = $sql->fetchAll(PDO::FETCH_ASSOC);
		$ha=$ha_db[0]['ha'];
		$sql2=$this->db->prepare("SELECT hora_i FROM posible_fisio WHERE id=?");
		$sql2->execute(array($physiotherapistidtime));
		$hi_db=$sql2->fetchAll(PDO::FETCH_ASSOC);
		$hi=$hi_db[0]["hora_i"];
		$sql1 = $this->db->prepare("SELECT id_hora as hc FROM hora_fisio where id=?");
		$sql1->execute(array($physiotherapistid));
		$hc_db = $sql1->fetchAll(PDO::FETCH_ASSOC);
		$hc=$hc_db[0]['hc'];
		if(strtotime($ha)==strtotime($physiotherapistday)){
			if ($hc==$physiotherapistidtime){
					return 3;
				}
			if(strtotime(date("Y"."-"."m"."-"."d"))==strtotime($physiotherapistday) && strtotime($hi)<strtotime(date("H".":"."i".":"."s"))){
				return 2;
			}
			return 3;
		}else{
			if(strtotime($physiotherapistday)>=strtotime(date("Y"."-"."m"."-"."d"))){
				if(strtotime(date("Y"."-"."m"."-"."d"))==strtotime($physiotherapistday)&&strtotime($hi)<=strtotime(date("H".":"."i".":"."s"))){
					return 2;
				}
				return 3;
			}else return 1;
		}
	}
	public function rightDayTimeAdd($physiotherapistday,$physiotherapistidtime) {
		$sql2=$this->db->prepare("SELECT hora_i FROM posible_fisio WHERE id=?");
		$sql2->execute(array($physiotherapistidtime));
		$hi_db=$sql2->fetchAll(PDO::FETCH_ASSOC);
		$hi=$hi_db[0]["hora_i"];
		if(strtotime($physiotherapistday)>=strtotime(date("Y"."-"."m"."-"."d"))){
			if(strtotime(date("Y"."-"."m"."-"."d"))==strtotime($physiotherapistday) && strtotime($hi)<=strtotime(date("H".":"."i".":"."s"))){
				return 2;
			}
			return 3;
		}else return 1;
	}
	public function search($query) {
        $search_query = "SELECT h.id,h.dia_f,h.asistencia,h.id_hora,r.dni_c,r.precio_fisio FROM hora_fisio h,reserva r WHERE h.id_reserva=r.id AND ". $query;
        $sql = $this->db->prepare($search_query);
        $sql->execute();
        $physiotherapist_db = $sql->fetchAll(PDO::FETCH_ASSOC);
        $physiotherapists = array();
        foreach ($physiotherapist_db as $physiotherapist) {
            array_push($physiotherapists, new Physiotherapist($physiotherapist["id"],null, $physiotherapist["dia_f"],$physiotherapist["asistencia"], $physiotherapist["precio_fisio"],null, $physiotherapist["dni_c"], $physiotherapist["id_hora"]));
        }
        return $physiotherapists;
    }
}
