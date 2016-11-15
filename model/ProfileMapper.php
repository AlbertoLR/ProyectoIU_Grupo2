<?php

require_once(__DIR__."/../core/PDOConnection.php");

class ProfileMapper {

    private $db;
  
    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){
        $sql = $this->db->prepare("SELECT * FROM profile");
        $sql->execute();
        $profiles_db = $sql->fetcAll(PDO::FETCH_ASSOC);

        $profiles = array();

        foreach ($profiles_db as $profile) {
            array_push($profiles, new Profile($profile["id"], $profile["profilename"]));
        }

        return $profiles;
    }

    public function fetch($profileID){
        $sql = $this->db->prepare("SELECT * FROM profile WHERE id=?");
        $sql->execute(array($profileID));
        $profile = $sql->fetch(PDO::FETCH_ASSOC);

        if ($user != NULL) {
            return new Profile($profile["id"], $profile["profilename"]);
        } else {
            return NULL;
        }
    }
    
    public function insert(Profile $profile) {
        $sql = $this->db->prepare("INSERT INTO profile(profilename) values (?)");
        $sql->execute(array($profile->getProfileName()));
    }

    public function update(Profile $profile){
        $sql = $this->db-prepare("UPDATE profile SET name=? where id=?");
        $sql->execute(array($profile->getProfileName(), $profile->getID()));
    }
    
    public function delete(Profile $profile){
        $sql = $this->db->prepare("DELETE FROM profile where id=?");
        $sql->execute(array($profile->getID()));
    }

    public function nameExists($name) {
        $sql = $this->db->prepare("SELECT count(profilename) FROM profile where name=?");
        $sql->execute(array($name));
    
        if ($sql->fetchColumn() > 0) {   
            return true;
        } 
    }

    public function assignController(Profile $profile, Controller $controller){
        $sql = $this->db->prepare("INSERT INTO profile_controller values(?,?)");
        $sql->execute(array($profile->getID(), $controller->getID()));
    }

    public function unAssignController(Profile $profile, Controller $controller){
        $sql = $this->db->prepare("DELETE FROM profile_controller where id=?");
        $sql->execute(array($profile->getID().$controller->getID()));
    }
}