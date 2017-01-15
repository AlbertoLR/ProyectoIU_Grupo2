<?php

require_once(__DIR__."/../core/PDOConnection.php");

class PHYSIOTHERAPIST_Model {

    private $db;

    public function __construct() {
		//Se establece una conexión base con la BD
        $this->db = PDOConnection::getInstance();
    }
	
	//Se recuperan de la BD todas las ocurrencias de la tabla hora_fisio con todos sus atributos, y se envian al controlador en forma de array
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

	//Se recupera una ocurrencia concreta de la BD de las tablas hora_fisio y reserva con los atributos de cada una de ellas que son necesarios. Se devuelve una instancia de physiotherapist
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

	//Se recuperan todos los clientes activos de la BD para poder mostrar y usar sus datos.
    public function fetchClients(){
        $sql = $this->db->query("SELECT id,dni_c,nombre_c,apellidos_c,telefono FROM cliente WHERE activo=1 ORDER BY apellidos_c");
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if($list_db != NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }

	//Se recuperan las horas que han sido establecidas para que haya sesiones de fisio, para poder usarlas y mostrarlas
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
        //Se recupera el DNI del cliente que nos interesa segun su id
		$id_c=$physiotherapist->getIDCliente();
		$sql=$this->db->query("SELECT c.dni_c FROM cliente c WHERE c.id=$id_c");
		$id_c = $sql->fetch(PDO::FETCH_ASSOC);
		$dni=$id_c["dni_c"];
		$sql->closeCursor();
		//Se inserta el DNI y el precio creando una nueva tupla en la tabla reserva
		$sql1 = $this->db->prepare("INSERT INTO reserva(dni_c,precio_fisio) values (?,?)");
        $sql1->execute(array($dni,$physiotherapist->getPrice()));
		//Se recupera el id de la reserva que acabamos de crear
		$sql2=$this->db->query("SELECT id FROM reserva WHERE dni_c=? AND precio_fisio=?");
		$sql2->execute(array($dni,$physiotherapist->getPrice()));
		$id_r=$sql2->fetch(PDO::FETCH_ASSOC);
		$res=$id_r["id"];
		$sql2->closeCursor();
		//Se insertan todos los datos, incluyendo el id_reserva en la tabla hora_fisio
		$sql3 = $this->db->prepare("INSERT INTO hora_fisio(id_reserva,dia_f,id_hora) values (?,?,?)");
        $sql3->execute(array($res, $physiotherapist->getDay(),$physiotherapist->getIDHour()));
    }

    public function update(Physiotherapist $physiotherapist){
		//Se recupera el DNI del cliente que nos interesa en base a su id
		$reserid1=$physiotherapist->getReservationid();
		$id_c=$physiotherapist->getIDCliente();
		$sql1=$this->db->query("SELECT c.dni_c FROM cliente c WHERE c.id=$id_c");
		$id_c = $sql1->fetch(PDO::FETCH_ASSOC);
		//Se actualiza la reserva con el precio y dni
		$sql3=$this->db->prepare("UPDATE reserva SET dni_c=?, precio_fisio=? WHERE id=?");
		$sql3->execute(array($id_c["dni_c"],$physiotherapist->getPrice(),$reserid1));
		//Se actualizan el resto de atributos en la tabla hora_fisio
		$sql5=$this->db->prepare("UPDATE hora_fisio SET dia_f=?,id_hora=?,asistencia=? WHERE id=?");
		$sql5->execute(array($physiotherapist->getDay(),$physiotherapist->getIDHour(),$physiotherapist->getAttendance(),$physiotherapist->getID()));
    }

	//Se elimina una tupla de la tabla hora_fisio en base al id
    public function delete(Physiotherapist $physiotherapist){
        $sql = $this->db->prepare("DELETE FROM hora_fisio where id=?");
        $sql->execute(array($physiotherapist->getID()));
    }
	public function rightDayTime($physiotherapistday,$physiotherapistidtime,$physiotherapistid) {
		//Se recupera la fecha de la sesion
		$sql = $this->db->prepare("SELECT dia_f as ha FROM hora_fisio where id=? ");
		$sql->execute(array($physiotherapistid));
		$ha_db = $sql->fetchAll(PDO::FETCH_ASSOC);
		$ha=$ha_db[0]['ha'];
		//Se recupera hora de inicio de la sesion
		$sql2=$this->db->prepare("SELECT hora_i FROM posible_fisio WHERE id=?");
		$sql2->execute(array($physiotherapistidtime));
		$hi_db=$sql2->fetchAll(PDO::FETCH_ASSOC);
		$hi=$hi_db[0]["hora_i"];
		//Se recupera el id de la hora en la que es la sesion
		$sql1 = $this->db->prepare("SELECT id_hora as hc FROM hora_fisio where id=?");
		$sql1->execute(array($physiotherapistid));
		$hc_db = $sql1->fetchAll(PDO::FETCH_ASSOC);
		$hc=$hc_db[0]['hc'];
		//Se comprueba si la fecha se ha modificado
		if(strtotime($ha)==strtotime($physiotherapistday)){
			//Se comprueba si el horario se ha modificado
			if ($hc==$physiotherapistidtime){								
					return 3;
				}
			//Se comprueba si la fecha coincide con el dia de hoy y la hora es anterior a la hora actual.
			if(strtotime(date("Y"."-"."m"."-"."d"))==strtotime($physiotherapistday) && strtotime($hi)<strtotime(date("H".":"."i".":"."s"))){
				return 2;
			}
			return 3;
		}else{
			//Se comprueba si el dia es hoy o posterior
			if(strtotime($physiotherapistday)>=strtotime(date("Y"."-"."m"."-"."d"))){
				//Se comprueba si la fecha coincide con el dia de hoy y la hora es anterior a la hora actual.
				if(strtotime(date("Y"."-"."m"."-"."d"))==strtotime($physiotherapistday)&&strtotime($hi)<=strtotime(date("H".":"."i".":"."s"))){
					return 2;
				}
				return 3;
			}else return 1;
		}      
	}//Esta función permite controlar que no se modifican sesiones ubicandolas en momentos del pasado, pero al mismo tiempo permite que una sesión se modifique para establecer
	//la asistencia aun teniendo una fecha pasada, mientras la unica modificacion sea la asistencia.
	
	public function rightDayTimeAdd($physiotherapistday,$physiotherapistidtime) {
		//Se recupera la hora de inicio de la sesion
		$sql2=$this->db->prepare("SELECT hora_i FROM posible_fisio WHERE id=?");
		$sql2->execute(array($physiotherapistidtime));
		$hi_db=$sql2->fetchAll(PDO::FETCH_ASSOC);
		$hi=$hi_db[0]["hora_i"];
		//Se comprueba si la fecha es igual o posterior al dia de hoy
		if(strtotime($physiotherapistday)>=strtotime(date("Y"."-"."m"."-"."d"))){
			//Se comprueba si la fecha es igual a hoy, la hora es anterior a la hora actual.
			if(strtotime(date("Y"."-"."m"."-"."d"))==strtotime($physiotherapistday) && strtotime($hi)<=strtotime(date("H".":"."i".":"."s"))){
				return 2;
			}
			return 3;
		}else return 1;      
	}//Esta función evita la creacion de sesiones en momentos pasados.
	
	public function search($query) {
		//Buscador; Se recuperan los atributos que nos interesan de la BD en base a las condiciones impuestas desde el buscador con $query.
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
