<?php

require_once(__DIR__."/../core/PDOConnection.php");

class ActionMapper {

    private $db;
  
    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){
        $sql = $this->db->prepare("SELECT * FROM action");
        return $sql->execute();
    }

    public function fetch(Action $action){
        $sql = $this->db-prepare("SELECT * FROM action WHERE id=?");
        return $sql->execute(array($action->getID()));
    }
      
    public function insert(Action $action) {
        $sql = $this->db->prepare("INSERT INTO action(actionname) values (?)");
        $sql->execute(array($action->actionName()));
    }

    public function update(Action $action){
        $sql = $this->db-prepare("UPDATE action SET actionname=? where id=?");
        $sql->execute(array($controller->getControllerName(), $controller->getID()));
    }
    
    public function delete(Action $action){
        $sql = $this->db->prepare("DELETE FROM action where id=?");
        $sql->execute(array($action->getID()));
    }

    public function nameExists($actionName) {
        $sql = $this->db->prepare("SELECT count(actionname) FROM action where actionname=?");
        $sql->execute(array($actionName));
    
        if ($sql->fetchColumn() > 0) {   
            return true;
        } 
    }
}