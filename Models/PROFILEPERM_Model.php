<?php

require_once(__DIR__."/../core/PDOConnection.php");

class PROFILEPERM_Model {

    private $db;
  
    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){
        $join = "SELECT profile_perms.id as id, profile.profilename as profilename, permission.controller as controller, permission.action as action FROM profile_perms, profile, permission WHERE profile_perms.profile = profile.id AND profile_perms.permission = permission.id ORDER BY profilename";
        $sql = $this->db->prepare($join);
        $sql->execute();
        $profileperms_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $profileperms = array();

        foreach ($profileperms_db as $profileperm) {
            array_push($profileperms, new ProfilePerm($profileperm["id"], NULL, NULL, $profileperm["profilename"], $profileperm["controller"], $profileperm["action"]));
        }

        return $profileperms;
    }

    public function fetch($profilepermID){
        $sql = $this->db->prepare("SELECT * FROM profile_perms WHERE id=?");
        $sql->execute(array($profilepermID));
        $profileperm = $sql->fetch(PDO::FETCH_ASSOC);
        
        if ($profileperm != NULL) {
            return new ProfilePerm($profileperm["id"], $profileperm["profile"], $profileperm["permission"]);
        } else {
            return NULL;
        }
    }

    public function insert(ProfilePerm $profileperm){
        $sql = $this->db->prepare("INSERT INTO profile_perms(profile, permission) values(?,?)");
        $sql->execute(array($profileperm->getProfile(), $profileperm->getPermission()));
    }

    public function delete(ProfilePerm $profileperm){
        $sql = $this->db->prepare("DELETE FROM profile_perms where id=?");
        $sql->execute(array($profileperm->getID()));
    }

    public function nameExists($profileid, $permission) {
        $sql = $this->db->prepare("SELECT count(profile) FROM profile_perms where profile=? and permission=?");
        $sql->execute(array($profileid, $permission));
    
        if ($sql->fetchColumn() > 0) {
            return true;
        } 
    }
    
}