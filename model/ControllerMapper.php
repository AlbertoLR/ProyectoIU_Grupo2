<?php

require_once(__DIR__."/../core/PDOConnection.php");

class ControllerMapper {

    private $db;
  
    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){
        $sql = $this->db->prepare("SELECT * FROM controller");
        $sql->execute();
        $controllers_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $controllers = array();

        foreach ($controllers_db as $controller) {
            array_push($controllers, new Controller($controller["id"], $controller["controllername"], $controller["action"]));
        }

        return $controllers;
    }

    public function fetch($controllerID){
        $sql = $this->db->prepare("SELECT * FROM controller WHERE id=?");
        $sql->execute(array($controllerID));
        
        if ($action != NULL) {
            return new Controller($controller["id"], $controller["controllername"], $controller["action"]);
        } else {
            return NULL;
        }
    }
      
    public function insert(Controller $controller) {
        $sql = $this->db->prepare("INSERT INTO controller(controllername, action) values (?, ?)");
        $sql->execute(array($controller->getControllerName(), $controller->getAction()));
    }

    public function update(Controller $controller) {
        $sql = $this->db-prepare("UPDATE controller SET controllername=? action=? where id=?");
        $sql->execute(array($controller->getControllerName(), $controller->getAction(), $controller->getID()));
    }
    
    public function delete(Controller $controller) {
        $sql = $this->db->prepare("DELETE FROM controller where id=?");
        $sql->execute(array($controller->getID()));
    }

    public function nameExists($controllerName) {
        $sql = $this->db->prepare("SELECT count(controllername) FROM controller where controllername=?");
        $sql->execute(array($controllerName));
    
        if ($sql->fetchColumn() > 0) {
            return true;
        } 
    }
}