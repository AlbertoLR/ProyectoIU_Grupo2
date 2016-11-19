<?php

require_once(__DIR__."/../core/PDOConnection.php");

class PermissionMapper {

    private $db;
  
    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){
        $sql = $this->db->prepare("SELECT * FROM permission");
        $sql->execute();
        $permissions_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $permissions = array();

        foreach ($permissions_db as $permission) {
            array_push($permissions, new Permission($permission["id"], $permission["controller"], $permission["action"]));
        }

        return $permissions;
    }

    public function fetch($permissionID){
        $sql = $this->db->prepare("SELECT * FROM permission WHERE id=?");
        $sql->execute(array($permissionID));
        $permission = $sql->fetch(PDO::FETCH_ASSOC);
        
        if ($permission != NULL) {
            return new Permission($permission["id"], $permission["controller"], $permission["action"]);
        } else {
            return NULL;
        }
    }
      
    public function insert(Permission $permission) {
        $sql = $this->db->prepare("INSERT INTO permission(controller, action) values (?, ?)");
        $sql->execute(array($permission->getController(), $permission->getAction()));
    }
    
    public function delete(Permission $permission) {
        $sql = $this->db->prepare("DELETE FROM permission where id=?");
        $sql->execute(array($permission->getID()));
    }

    public function nameExists($controller, $action) {
        $sql = $this->db->prepare("SELECT count(controller) FROM permission where controller=? and action=?");
        $sql->execute(array($controller, $action));
    
        if ($sql->fetchColumn() > 0) {
            return true;
        } 
    }
}