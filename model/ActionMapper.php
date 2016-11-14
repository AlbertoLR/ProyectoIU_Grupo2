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
        $action_db = $sql->fetchAll(PDO::FETCH:ASSOC);

        $actions = array();

        foreach ($action_db as $action){
            array_push($actions, new Action($action["id"], $action["actionname"]));
        }

        return $actions;
    }

    public function fetch(Action $action){
        $sql = $this->db-prepare("SELECT * FROM action WHERE id=?");
        $sql->execute(array($action->getActionName(), $action->getID()));
        $action = $sql->fetch(PDO::FETCH_ASSOC);

        if($action != NULL) {
            return new Action($action["id"], $action["actionname"]);
        } else {
            return NULL;
        }
        
    }
      
    public function insert(Action $action) {
        $sql = $this->db->prepare("INSERT INTO action(actionname) values (?)");
        $sql->execute(array($action->actionName()));
    }

    public function update(Action $action){
        $sql = $this->db-prepare("UPDATE action SET actionname=? where id=?");
        $sql->execute(array($action->getControllerName(), $action->getID()));
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