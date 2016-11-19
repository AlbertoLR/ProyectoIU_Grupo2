<?php

require_once(__DIR__."/../core/PDOConnection.php");

class PERMISSION_Model {

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

    public function check($userid, $profile, $controllername, $actionname) {
        return ($this->checkUserPerms($userid, $controllername, $actionname) || $this->checkProfilePerms($profile, $controllername, $actionname));
    }

    private function checkUserPerms($userid, $controllername, $actionname) {
        $join = "SELECT count(p.id) from permission as p, user_perms as u WHERE p.id=u.permission AND u.user=? AND p.controller=? AND p.action=?";
        $sql = $this->db->prepare($join);
        $sql->execute(array($userid, $controllername, $actionname));
    
        if ($sql->fetchColumn() > 0) {
            return true;
        }

        return false;
        
    }
    
    private function checkProfilePerms($profile, $controllername, $actionname) {
        $join = "SELECT count(p.id) from permission as p, profile_perms as pp, profile as pr WHERE p.id=pp.permission AND pp.profile=pr.id AND pr.profilename=? AND p.controller=? AND p.action=?";
        $sql = $this->db->prepare($join);
        $sql->execute(array($profile, $controllername, $actionname));
    
        if ($sql->fetchColumn() > 0) {
            return true;
        }

        return false;
    }
}