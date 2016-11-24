<?php

require_once(__DIR__."/../core/PDOConnection.php");

class PERMISSION_Model {

    private $db;
  
    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all($orderby = "controller"){
        $sql = $this->db->prepare("SELECT * FROM permission ORDER BY ".htmlspecialchars($orderby));
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

    /**
     * Checkea se o usuario ou o perfil asociado teñen permisos para realizar un accion dun determinado controlador
     */
    public function check($controllername, $actionname, $userid) {
        return ($this->checkUserPerms($userid, $controllername, $actionname) || $this->checkProfilePerms($controllername, $actionname, $userid));
    }

    private function checkUserPerms($controllername, $actionname, $userid) {
        $join = "SELECT count(p.id) from permission as p, user_perms as u WHERE p.id=u.permission AND u.user=? AND p.controller=? AND p.action=?";
        $sql = $this->db->prepare($join);
        $sql->execute(array($userid, $controllername, $actionname));
    
        if ($sql->fetchColumn() > 0) {
            return true;
        }

        return false;
        
    }
    
    private function checkProfilePerms($controllername, $actionname, $userid) {
        $join = "SELECT count(p.id) from user, profile, profile_perms as pp, permission as p WHERE profile.profilename=user.profile AND profile.id=pp.profile AND pp.permission=p.id AND user.id=? AND p.controller=? AND p.action=?";
        $sql = $this->db->prepare($join);
        $sql->execute(array($userid, $controllername, $actionname));
    
        if ($sql->fetchColumn() > 0) {
            return true;
        }

        return false;
    }

    public function user_controllers($userid){
        $join_user = "SELECT p.controller as controller from user_perms as u, permission as p WHERE u.permission=p.id AND u.user=?";
        $join_profile = "SELECT p.controller as controller from profile_perms as pp, permission as p, profile, user WHERE pp.permission=p.id and pp.profile=profile.id AND profile.profilename=user.profile AND user.id=?";

        $sql_user = $this->db-> prepare($join_user);
        $sql_user->execute(array($userid));
        $user_controllers = $sql_user->fetchAll(PDO::FETCH_ASSOC);

        $sql_profile = $this->db->prepare($join_profile);
        $sql_profile->execute(array($userid));
        $profile_controllers = $sql_profile->fetchAll(PDO::FETCH_ASSOC);

        $controllers = array();

        foreach ($user_controllers as $controller) {
            if (!in_array($controller['controller'], $controllers)) {
                array_push($controllers, $controller['controller']);
            }
        }

        foreach ($profile_controllers as $controller) {
            if (!in_array($controller['controller'], $controllers)) {
                array_push($controllers, $controller['controller']);
            }
        }

        return $controllers;
        
    }
}