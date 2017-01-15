<?php

require_once(__DIR__."/../core/PDOConnection.php");

class NOTIFICATION_Model {

    private $db;
  
    public function __construct() {
		//Se establece una conexión base con la BD
        $this->db = PDOConnection::getInstance();
    }

	
    public function fetch_all($orderby = "activity"){
		//Se recuperan de la BD todas las ocurrencias de la tabla cliente con todos sus atributos, y se envian al controlador en forma de array
        $sql = $this->db->prepare("SELECT cliente.nombre_c as name, cliente.apellidos_c as surname, actividad.nombre as activity, cliente.email as email FROM cliente, actividad, inscripcion WHERE cliente.dni_c = inscripcion.cliente_dni_c AND inscripcion.id_actividad = actividad.id ORDER BY ".htmlspecialchars($orderby));
        $sql->execute();
        $notification_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $notifications = array();

        foreach ($notification_db as $notification) {
            array_push($notifications, new Notification($notification["name"],$notification["surname"],$notification["activity"], $notification["email"], NULL, NULL));
        }

        return $notifications;
    }
	public function search($query) {
		//Buscador; Se recuperan los atributos que nos interesan de la BD en base a las condiciones impuestas desde el buscador con $query.
        $search_query = "SELECT cliente.nombre_c as name, cliente.apellidos_c as surname, actividad.nombre as activity, cliente.email as email FROM cliente, actividad, inscripcion WHERE cliente.dni_c = inscripcion.cliente_dni_c AND inscripcion.id_actividad = actividad.id AND ". $query;
        $sql = $this->db->prepare($search_query);
        $sql->execute();
        $notification_db = $sql->fetchAll(PDO::FETCH_ASSOC);
        $notifications = array();
        foreach ($notification_db as $notification) {
            array_push($notifications, new Notification($notification["name"], $notification["surname"],$notification["activity"], $notification["email"]));
        }
        return $notifications;
    }

     
}
?>