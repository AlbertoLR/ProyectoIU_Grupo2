<?php

require_once(__DIR__."/../core/PDOConnection.php");

class PHYSIOTHERAPISTHOUR_Model {

    private $db;

    public function __construct() {
		//Se establece una conexión base con la BD
        $this->db = PDOConnection::getInstance();
    }
	//Se recuperan de la BD todas las ocurrencias de la tabla posible_fisio con todos sus atributos, y se envian al controlador en forma de array
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
	//Se recupera una ocurrencia concreta de la BD de las tablas posible_fisio con los atributos que son necesarios. Se devuelve una instancia de physiotherapisthour
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
	//Se inserta una nueva tupla en la tabla posible_fisio de la BD.
    public function insert(Physiotherapisthour $physiotherapisthour) {		
		$sql3 = $this->db->prepare("INSERT INTO posible_fisio(dia,hora_i,hora_f) values (?,?,?)");
        $sql3->execute(array($physiotherapisthour->getDay(),$physiotherapisthour->getStarttime(), $physiotherapisthour->getEndtime()));
    }
	//Se actualiza un tupla de la tabla posible_fisio de la BD
    public function update(Physiotherapisthour $physiotherapisthour){
		$sql=$this->db->prepare("UPDATE posible_fisio SET dia=?, hora_i=?, hora_f=? WHERE id=?");
		$sql->execute(array($physiotherapisthour->getDay(),$physiotherapisthour->getStarttime(),$physiotherapisthour->getEndtime(),$physiotherapisthour->getID()));
		}
	//Se elimina una tupla de la tabla posible_fisio en base al id
    public function delete(Physiotherapisthour $physiotherapisthour){
        $sql = $this->db->prepare("DELETE FROM posible_fisio where id=?");
        $sql->execute(array($physiotherapisthour->getID()));
    }


    public function rightDayTime($physiotherapisthourday,$physiotherapisthourstime,$physiotherapisthouretime) {
		//Se recupera el dia de la semana, guardado en formato numerico y se convierte a texto.
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
		//Con ese dia, se recupera el rango de apertura de ese dia de la semana de la tabla rango_horario
		$sql->execute(array($fecha));
		$ha_db = $sql->fetchAll(PDO::FETCH_ASSOC);
		$ha=$ha_db[0]['ha'];
		if(!isset($ha)){
			return 5;
		}
		//Se conprueba si la hora de comienzo es anterior a la hora de apertura.
		if(strtotime($physiotherapisthourstime)<strtotime($ha)){
			return 1;
		}
		//Se recupera la hora de cierre del mismo rango horario
		$sql1 = $this->db->prepare("SELECT max(hora_cierre) as hc FROM rango_horario where dia_s=? AND hora_apertura=? ");
		$sql1->execute(array($fecha,$ha));
		$hc_db = $sql1->fetchAll(PDO::FETCH_ASSOC);
		$hc=$hc_db[0]['hc'];
		if (!isset($hc)){								
					return 5;
				}
				//Se comprueba si la hora de fin es posterior a la hora de cierre.
		if(strtotime($physiotherapisthouretime)>strtotime($hc)){
			return 2;
		}
		//Se comprueba si la hora de inicio es posterior a la hora de fin.
		if(strtotime($physiotherapisthourstime)>strtotime($physiotherapisthouretime)){
			return 3;
		}
		return 4;        
	}//Esta función permite un control sobre las hora que se programan, manteniendolas dentro de un rango de apertura, y evitendo que el principio sea posterior al final.
	public function search($query) {
		//Buscador; Se recuperan los atributos que nos interesan de la BD en base a las condiciones impuestas desde el buscador con $query.
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
