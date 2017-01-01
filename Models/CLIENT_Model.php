<?php

require_once(__DIR__."/../core/PDOConnection.php");

class CLIENT_Model {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all($activo = 1){
        $sql = $this->db->prepare("SELECT * FROM cliente WHERE activo=? ORDER BY nombre_c");
        $sql->execute(array($activo));
        $clients_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $clients = array();

        foreach ($clients_db as $client) {
            array_push($clients, new Client($client["id"], $client["dni_c"], $client["nombre_c"], $client["apellidos_c"],
                                        $client["fecha_nac"],$client["profesion"],$client["telefono"],$client["direccion"],
                                        $client["comentario"],$client["email"], $client["alerta_falta"],$client["desempleado"],
                                        $client["estudiante"],$client["familiar"],$client["num_cuenta"],$client["activo"],$client["foto"]));
        }

        return $clients;
    }

    public function fetch($clientID){
           $sql = $this->db->prepare("SELECT cliente.*,lesion.id as lesion_id FROM cliente,lesion_cliente,lesion
                                      WHERE cliente.id=? AND lesion_cliente.id_lesion=lesion.id AND cliente.id=lesion_cliente.cliente_id");
           $sql->execute(array($clientID));
           $client = $sql->fetch(PDO::FETCH_ASSOC);

           if($client != NULL) {
               return new Client($client["id"], $client["dni_c"], $client["nombre_c"], $client["apellidos_c"],
                                           $client["fecha_nac"],$client["profesion"],$client["telefono"],$client["direccion"],
                                           $client["comentario"],$client["email"], $client["alerta_falta"],$client["desempleado"],
                                           $client["estudiante"],$client["familiar"],$client["num_cuenta"],$client["activo"],$client["foto"],$client["lesion_id"]);
           } else {
             $sql = $this->db->prepare("SELECT * FROM cliente WHERE id=?");
             $sql->execute(array($clientID));
             $client = $sql->fetch(PDO::FETCH_ASSOC);
             if($client != NULL) {
               return new Client($client["id"], $client["dni_c"], $client["nombre_c"], $client["apellidos_c"],
                                           $client["fecha_nac"],$client["profesion"],$client["telefono"],$client["direccion"],
                                           $client["comentario"],$client["email"], $client["alerta_falta"],$client["desempleado"],
                                           $client["estudiante"],$client["familiar"],$client["num_cuenta"],$client["activo"],$client["foto"],null);
             }else{
               return NULL;
           }
       }
     }

    public function fetch_by_clientname($clientname){
        $sql = $this->db->prepare("SELECT * FROM cliente WHERE nombre=?");
        $sql->execute(array($clientname));
        $client = $sql->fetch(PDO::FETCH_ASSOC);

        if($client != NULL) {
            return new Client($client["id"], $client["dni_c"], $client["nombre_c"], $client["apellidos_c"],
                                        $client["fecha_nac"],$client["profesion"],$client["telefono"],$client["direccion"],
                                        $client["comentario"],$client["email"], $client["alerta_falta"],$client["desempleado"],
                                        $client["estudiante"],$client["familiar"],$client["num_cuenta"],$client["activo"],$client["foto"]);
        } else {
            return NULL;
        }
    }

    public function fetch_injuries(){
        $sql = $this->db->prepare("SELECT * FROM lesion");
        $sql->execute();
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if($list_db != NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }

    public function fetch_client_injuries($clientID){
        $sql = $this->db->prepare("SELECT cliente.dni_c,cliente.nombre_c,cliente.apellidos_c,lesion.descripcion, empleado_mira.user_id,user.profile,user.username,empleado_mira.fecha, empleado_mira.hora
                                   FROM empleado_mira,cliente,user,lesion
                                   WHERE lesion_cliente_cliente_id=? AND cliente.id=empleado_mira.lesion_cliente_cliente_id
                                                                    AND lesion.id=empleado_mira.lesion_cliente_id_lesion
                                                                    AND user.id=empleado_mira.user_id");
        $sql->execute(array($clientID));
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);
          if($list_db != NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }

    public function fetch_inscriptions($clientID){
        $sql = $this->db->prepare("SELECT inscripcion.id,actividad.nombre as actividad,inscripcion.fecha,espacio.nombre FROM cliente,inscripcion,actividad,espacio
                                  WHERE cliente.id=? AND cliente.dni_c=inscripcion.cliente_dni_c AND actividad.id=inscripcion.id_actividad AND actividad.espacio_id=espacio.id");
        $sql->execute(array($clientID));
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if($list_db != NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }


    public function insert(Client $client,$currentUserId) {

        $array_date=getDate();
        $date=$array_date['year']."-".$array_date['mon']."-".$array_date['mday'];
        $time=$array_date['hours'].":".$array_date['minutes'].":".$array_date['seconds'];

        $sql = $this->db->prepare("INSERT INTO cliente(dni_c,nombre_c,apellidos_c,fecha_nac,profesion,telefono,direccion,comentario,
                                                email,alerta_falta,desempleado,estudiante,familiar,num_cuenta,activo,foto)
                                  values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $sql->execute(array($client->getDni(), $client->getName(), $client->getSurname(),
                            $client->getBirthday(), $client->getProfession(), $client->getPhone(), $client->getAddress(), $client->getComment(),
                            $client->getEmail(), $client->getAlert(), $client->getUnemployed(), $client->getStudent(),$client->getFamily(),$client->getAccount(),$client->getActive(),$client->getPhoto()));

        if($client->getInjury()!=NULL){
          $id_lesion=$client->getInjury();
          $dni = $client->getDni();
          $sql1 = $this->db->query("SELECT id FROM cliente where dni_c='$dni'");
          foreach ($sql1 as $key ) {
            $id_cliente = $key[0];
          }
          $sql2 = $this->db->prepare("INSERT INTO lesion_cliente(id_lesion,cliente_id) values (?,?)");
          $sql2->execute(array($id_lesion,$id_cliente));
          $sql3 = $this->db->prepare("INSERT INTO empleado_mira(lesion_cliente_id_lesion,lesion_cliente_cliente_id,user_id,fecha,hora) values (?,?,?,?,?)");
          $sql3->execute(array($id_lesion,$id_cliente,$currentUserId,$date,$time));
        }

    }

    public function update(Client $client,$currentUserId){

            $array_date=getDate();
            $date=$array_date['year']."-".$array_date['mon']."-".$array_date['mday'];
            $time=$array_date['hours'].":".$array_date['minutes'].":".$array_date['seconds'];

            $sql = $this->db->prepare("UPDATE cliente SET dni_c=?,nombre_c=?,apellidos_c=?,fecha_nac=?,profesion=?,telefono=?,direccion=?,comentario=?,
                                                        email=?,alerta_falta=?,desempleado=?,estudiante=?,familiar=?,num_cuenta=?,activo=?,foto=? where id=?");
            $sql->execute(array($client->getDni(), $client->getName(), $client->getSurname(),
                                $client->getBirthday(), $client->getProfession(), $client->getPhone(), $client->getAddress(), $client->getComment(),
                                $client->getEmail(), $client->getAlert(), $client->getUnemPloyed(), $client->getStudent(),$client->getFamily(),
                                $client->getAccount(),$client->getActive(),$client->getPhoto(), $client->getID()));


        if($client->getInjury()){
          $id_cliente = $client->getID();
          $id_lesion = $client->getInjury();
          $sql1 = $this->db->query("SELECT cliente_id FROM lesion_cliente where cliente_id='$id_cliente'");
          $array =  $sql1->fetchAll(PDO::FETCH_ASSOC);

          if($array==NULL){
            $sql2 = $this->db->prepare("INSERT INTO lesion_cliente(id_lesion,cliente_id) values (?,?)");
            $sql2->execute(array($id_lesion,$id_cliente));
            $sql3 = $this->db->prepare("INSERT INTO empleado_mira(lesion_cliente_id_lesion,lesion_cliente_cliente_id,user_id,fecha,hora) values (?,?,?,?,?)");
            $sql3->execute(array($id_lesion,$id_cliente,$currentUserId,$date,$time));
          }else{
            $sql2 = $this->db->prepare("UPDATE lesion_cliente SET id_lesion=? where cliente_id=?");
            $sql2->execute(array($id_lesion,$id_cliente,));
            $sql3 = $this->db->prepare("INSERT INTO empleado_mira(lesion_cliente_id_lesion,lesion_cliente_cliente_id,user_id,fecha,hora) values (?,?,?,?,?)");
            $sql3->execute(array($id_lesion,$id_cliente,$currentUserId,$date,$time));
          }
        }

    }

    //Realizarase borrado loxico
    public function delete(Client $client){
        $client->setActive(FALSE);
        $this->update($client);
    }

    public function recovery(Client $client) {
        $client->setActive(TRUE);
        $this->update($client);
    }

    public function dniExists($dni) {
        $sql = $this->db->prepare("SELECT count(dni_c) FROM cliente where dni_c=?");
        $sql->execute(array($dni));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }

}
