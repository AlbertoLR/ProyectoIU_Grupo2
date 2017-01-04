<?php

require_once(__DIR__."/../core/PDOConnection.php");

class USER_Model {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all($activo = 1){
        $sql = $this->db->prepare("SELECT * FROM user WHERE activo=? ORDER BY username");
        $sql->execute(array($activo));
        $users_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $users = array();

        foreach ($users_db as $user) {
            array_push($users, new User($user["id"], $user["profile"], $user["dni"], $user["username"], $user["name"],
                                        $user["surname"],$user["fecha_nac"],$user["direccion"],$user["comentario"],
                                        $user["num_cuenta"],$user["tipo_contrato"], $user["email"],$user["foto"],$user["activo"],NULL ));
        }

        return $users;
    }

    public function fetch($userID){
        $sql = $this->db->prepare("SELECT * FROM user WHERE id=?");
        $sql->execute(array($userID));
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if($user != NULL) {
            return new User($user["id"], $user["profile"], $user["dni"], $user["username"], $user["name"],
                            $user["surname"],$user["fecha_nac"],$user["direccion"],$user["comentario"],
                            $user["num_cuenta"],$user["tipo_contrato"], $user["email"],$user["foto"],$user["activo"],NULL);
        } else {
            return NULL;
        }
    }

    public function fetch_by_username($username){
        $sql = $this->db->prepare("SELECT * FROM user WHERE username=?");
        $sql->execute(array($username));
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if($user != NULL) {
            return new User($user["id"], $user["profile"], $user["dni"], $user["username"], $user["name"],
                            $user["surname"],$user["fecha_nac"],$user["direccion"],$user["comentario"],
                            $user["num_cuenta"],$user["tipo_contrato"], $user["email"],$user["foto"],$user["activo"],NULL );
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

    public function fetch_user_injuries($userID){
        $sql = $this->db->prepare("SELECT lesion_empleado.user_id,lesion_empleado.fecha,lesion_empleado.hora,user.name,user.dni,user.surname,user.username,lesion.descripcion
                                   FROM user,lesion_empleado,lesion
                                   WHERE user.id=? AND lesion_empleado.lesion_id=lesion.id
                                                  AND user.id=lesion_empleado.user_id");

        $sql->execute(array($userID));
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);
          if($list_db != NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }

    public function insert(User $user) {
        $sql = $this->db->prepare("INSERT INTO user(profile,dni,username,name,surname,fecha_nac,direccion,comentario,num_cuenta,tipo_contrato,email,foto,activo,passwd) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $sql->execute(array($user->getProfile(), $user->getDni(), $user->getUsername(), $user->getName(),
                            $user->getSurname(), $user->getFechaNac(), $user->getDireccion(), $user->getComentario(), $user->getNumCuenta(),
                            $user->getTipoContrato(), $user->getEmail(), $user->getFoto(), $user->getActivo(),$user->getPasswd()));

        $array_date=getDate();
        $date=$array_date['year']."-".$array_date['mon']."-".$array_date['mday'];
        $time=$array_date['hours'].":".$array_date['minutes'].":".$array_date['seconds'];

        if($user->getInjury()!=NULL){
          $id_lesion=$user->getInjury();
          $dni = $user->getDni();
          $sql1 = $this->db->query("SELECT id FROM user where dni='$dni'");
          foreach ($sql1 as $key ) {
            $id_user = $key[0];
          }
          $sql2 = $this->db->prepare("INSERT INTO lesion_empleado(lesion_id,user_id,fecha,hora) values (?,?,?,?)");
          $sql2->execute(array($id_lesion,$id_user,$date,$time));
        }
    }

    public function update(User $user){
        if ($user->getPasswd()) {
            $sql = $this->db->prepare("UPDATE user SET profile=?, dni=?, username=?, name=?, surname=?, fecha_nac=?,
                                                       direccion=?, comentario=?, num_cuenta=?, tipo_contrato=?, email=?, foto=?,
                                                       activo=?, passwd=? where id=?");
            $sql->execute(array($user->getProfile(), $user->getDni(), $user->getUsername(), $user->getName(),
                                $user->getSurname(), $user->getFechaNac(), $user->getDireccion(), $user->getComentario(), $user->getNumCuenta(),
                                $user->getTipoContrato(), $user->getEmail(), $user->getFoto(), $user->getActivo(),$user->getPasswd(), $user->getID()));
        }
        else {
            $sql = $this->db->prepare("UPDATE user SET profile=?, dni=?, username=?, name=?, surname=?, fecha_nac=?,
                                                       direccion=?, comentario=?, num_cuenta=?, tipo_contrato=?, email=?, foto=?,
                                                       activo=? where id=?");
            $sql->execute(array($user->getProfile(), $user->getDni(), $user->getUsername(), $user->getName(),
                                $user->getSurname(), $user->getFechaNac(), $user->getDireccion(), $user->getComentario(), $user->getNumCuenta(),
                                $user->getTipoContrato(), $user->getEmail(), $user->getFoto(), $user->getActivo(), $user->getID()));
        }

        $array_date=getDate();
        $date=$array_date['year']."-".$array_date['mon']."-".$array_date['mday'];
        $time=$array_date['hours'].":".$array_date['minutes'].":".$array_date['seconds'];

        if($user->getInjury()){
            $sql2 = $this->db->prepare("INSERT INTO lesion_empleado(lesion_id,user_id,fecha,hora) values (?,?,?,?)");
            $sql2->execute(array($user->getInjury(),$user->getID(),$date,$time));
        }
    }

    //Realizarase borrado loxico
    public function delete(User $user){
        $user->setActivo(FALSE);
        $this->update($user);
    }

    public function recovery(User $user) {
        $user->setActivo(TRUE);
        $this->update($user);
    }

    public function usernameExists($username) {
        $sql = $this->db->prepare("SELECT count(username) FROM user where username=?");
        $sql->execute(array($username));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }

    public function dniExists($dni) {
        $sql = $this->db->prepare("SELECT count(dni) FROM user where dni=?");
        $sql->execute(array($dni));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }

    public function isValidUser($username, $passwd) {

        if (empty($passwd)){
            return false;
        }

        $sql = $this->db->prepare("SELECT count(username) FROM user where username=? and passwd=? and activo=TRUE");
        $sql->execute(array($username, $passwd));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }

    public function search($query) {
        $search_query = "SELECT * FROM user WHERE ". $query;
        $sql = $this->db->prepare($search_query);
        $sql->execute();
        $users_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $users = array();

        foreach ($users_db as $user) {
            array_push($users, new User($user["id"], $user["profile"], $user["dni"], $user["username"], $user["name"],
                                        $user["surname"],$user["fecha_nac"],$user["direccion"],$user["comentario"],
                                        $user["num_cuenta"],$user["tipo_contrato"], $user["email"],$user["foto"],$user["activo"],NULL ));
        }

        return $users;
    }

    public function get_day($sessions,$hours,$activities,$events,$users,$spaces,$wd,$week){
      $i = -1;
      $array =  array();
      foreach($hours as $hour => $values){
       foreach($sessions as $session){
          if($session->getHoursID()==$values["id"]) {
             if( date('l', strtotime($values["dia"]))==$wd && $week == date('W', strtotime($values["dia"])) ) {
               $i++;
           $array[$i]["hora_inicio"] = $values["hora_inicio"];
           $array[$i]["hora_fin"] = $values["hora_fin"];
           $array[$i]["fecha"] = $values["dia"];
          if($session->getActivityID()) {
            foreach($activities as $activity => $value){
            if($value["id"]==$session->getActivityID()) {
              $array[$i]["actividad"] = $value["nombre"] ;
              $array[$i]["actividad_id"] = $value["id"] ;
          } } } else {

            if($session->getEventID()) {
              foreach($events as $event => $value){
               if($value["id"]==$session->getEventID()) {
                 $array[$i]["actividad"] = NULL;
                 $array[$i]["evento"]=$value["nombre"];
                 $array[$i]["evento_id"]=$value["id"];
           }
          }
         }

          }
          foreach($users as $user=> $value){
           if($value["id"]==$session->getUserID()) {
             $array[$i]["user"]=$value["name"];
             $array[$i]["user_id"]=$value["id"];
            } }

         foreach($spaces as $space => $value){
            if($value["id"]==$session->getSpaceID()) {
             $array[$i]["space"]=$value["nombre"];
             $array[$i]["space_id"]=$value["id"];
          } }
       } } }
     }
       return $array;
   }
}
