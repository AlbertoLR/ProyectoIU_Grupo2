<?php

require_once(__DIR__."/../core/PDOConnection.php");

class USERRPERM_Model {

    private $db;
  
    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){
        $join = "SELECT user_perms.id as id, user.username as username, permission.controller as controller, permission.action as action FROM user_perms, user, permission WHERE user_perms.user = user.id AND user_perms.permission = permission.id";
        $sql = $this->db->prepare($join);
        $sql->execute();
        $userperms_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $userperms = array();

        foreach ($userperms_db as $userperm) {
            array_push($userperms, new UserPerm($userperm["id"], NULL, NULL, $userperm["username"], $userperm["controller"], $userperm["action"]));
        }

        return $userperms;
    }

    public function fetch($userpermID){
        $sql = $this->db->prepare("SELECT * FROM user_perms WHERE id=?");
        $sql->execute(array($userpermID));
        $userperm = $sql->fetch(PDO::FETCH_ASSOC);
        
        if ($userperm != NULL) {
            return new UserPerm($userperm["id"], $userperm["user"], $userperm["permission"]);
        } else {
            return NULL;
        }
    }

    public function insert(UserPerm $userperm){
        $sql = $this->db->prepare("INSERT INTO user_perms(user, permission) values(?,?)");
        $sql->execute(array($userperm->getUser(), $userperm->getPermission()));
    }

    public function delete(UserPerm $userperm){
        $sql = $this->db->prepare("DELETE FROM user_perms where id=?");
        $sql->execute(array($userperm->getID()));
    }

    public function nameExists($userid, $permission) {
        $sql = $this->db->prepare("SELECT count(user) FROM user_perms where user=? and permission=?");
        $sql->execute(array($userid, $permission));
    
        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }
}