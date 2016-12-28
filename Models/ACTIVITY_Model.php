<?php

require_once(__DIR__."/../core/PDOConnection.php");

class ACTIVITY_Model {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){
        $sql = $this->db->prepare("SELECT * FROM actividad ORDER BY nombre");
        $sql->execute();
        $activitys_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $activitys = array();

        foreach ($activitys_db as $activity) {
            array_push($activitys, new Activity($activity["id"], $activity["nombre"],$activity["capacidad"],$activity["precio"],$activity["espacio_id"],$activity["categoria_id"]));
        }

        return $activitys;
    }

    public function fetch($activityID){
      $sql = $this->db->prepare("SELECT actividad.id,actividad.nombre,actividad.capacidad,actividad.precio,aplica.descuento_id,actividad.espacio_id,actividad.categoria_id,aplica.extra FROM actividad,aplica,descuento
                                 WHERE actividad.id=? AND actividad.id = aplica.actividad_id AND aplica.descuento_id = descuento.id ORDER BY nombre");
        $sql->execute(array($activityID));
        $activity = $sql->fetch(PDO::FETCH_ASSOC);

        if($activity != NULL) {
            return new Activity($activity["id"], $activity["nombre"],$activity["capacidad"],$activity["precio"],$activity["descuento_id"],$activity["espacio_id"],$activity["categoria_id"],$activity["extra"]);
        } else {
          $sql1 = $this->db->prepare("SELECT * FROM actividad WHERE actividad.id=? ORDER BY nombre");
            $sql1->execute(array($activityID));
            $activity = $sql1->fetch(PDO::FETCH_ASSOC);
            if($activity != NULL) {
              return new Activity($activity["id"], $activity["nombre"],$activity["capacidad"],$activity["precio"],null,$activity["espacio_id"],$activity["categoria_id"]);
            }else{
              return NULL;
          }
        }

    }

    public function fetchDiscounts(){
        $sql = $this->db->query("SELECT id,descripcion,cantidad,categoria_id FROM descuento");
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if($list_db != NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }

    public function fetchSpaces(){
        $sql = $this->db->query("SELECT id,nombre FROM espacio");
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if($list_db != NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }

    public function fetchCategories(){
        $sql = $this->db->query("SELECT id,tipo FROM categoria ");
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        if($list_db != NULL) {
            return $list_db;
        } else {
            return NULL;
        }
    }

    public function insert(Activity $activity) {
      if($activity->getDiscountid()[0]!=NULL){
        list($discount,$category) = split('[/.-]',$activity->getDiscountid()[0]);
      }else{
        $category = $activity->getCategoryid();
      }
        $sql = $this->db->prepare("INSERT INTO actividad(nombre,capacidad,precio,espacio_id,categoria_id) values (?,?,?,?,?)");
        $sql->execute(array($activity->getActivityName(), $activity->getCapacity(),$activity->getPrice(), $activity->getSpaceid(), $category));

        $name = $activity->getActivityName();
        $sql1 = $this->db->query("SELECT id FROM actividad where nombre='$name'");
        foreach ($sql1 as $key ) {
          $id = $key[0];
        }
        if($activity->getDiscountid()[0]!=NULL){
        $sql2 = $this->db->prepare("INSERT INTO aplica(descuento_id,actividad_id,extra) values (?,?,?)");
        $sql2->execute(array($discount,$id,$activity->getExtraDiscount()));
      }
    }

    public function update(Activity $activity){

      if($activity->getDiscountid()[0]!=NULL){
        list($discount,$category) = split('[/.-]',$activity->getDiscountid()[0]);
        $id = $activity->getID();
        $sql1 = $this->db->query("SELECT actividad_id FROM aplica where actividad_id='$id'");
        $array =  $sql1->fetchAll(PDO::FETCH_ASSOC);

        if($array==NULL){
          $sql2 = $this->db->prepare("INSERT INTO aplica(descuento_id,actividad_id,extra) values (?,?,?)");
          $sql2->execute(array($discount,$id,$activity->getExtraDiscount()));
        }else{
                echo $activity->getExtraDiscount();
          $sql2 = $this->db->prepare("UPDATE aplica SET descuento_id=?,extra=? where actividad_id=?");
          $sql2->execute(array($discount,$activity->getExtraDiscount(),$id));
        }

      }else{
        $id = $activity->getID();
        $category = $activity->getCategoryid();
        $sql1 = $this->db->query("SELECT actividad_id FROM aplica where actividad_id='$id'");
        $array =  $sql1->fetchAll(PDO::FETCH_ASSOC);
        if($array!=NULL){
          $sql2 = $this->db->query("DELETE FROM aplica where actividad_id='$id'");
          $sql2->execute(array($id));
        }
      }

        $sql = $this->db->prepare("UPDATE actividad SET nombre=?,capacidad=?,precio=?,espacio_id=?,categoria_id=? where id=?");
        $sql->execute(array($activity->getActivityName(), $activity->getCapacity(),$activity->getPrice(), $activity->getSpaceid(), $category, $activity->getID()));

    }

    public function delete(Activity $activity){
        $sql = $this->db->prepare("DELETE FROM actividad where id=?");
        $sql->execute(array($activity->getID()));
    }


    public function nameExists($activityName) {
        $sql = $this->db->prepare("SELECT count(nombre) FROM actividad where nombre=?");
        $sql->execute(array($activityName));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
   }
    public function nameExistsUpdate($activityName,$activityid) {
        $sql = $this->db->prepare("SELECT count(nombre) FROM actividad where nombre=? AND id<>$activityid ");
        $sql->execute(array($activityName));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }
}
