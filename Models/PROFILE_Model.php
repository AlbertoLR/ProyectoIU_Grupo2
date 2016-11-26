<?php

require_once(__DIR__."/../core/PDOConnection.php");

class PROFILE_Model {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){
        $sql = $this->db->prepare("SELECT * FROM profile");
        $sql->execute();
        $profiles_db = $sql->fetchAll(PDO::FETCH_ASSOC);

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

        if ($profile != NULL) {
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
        $sql = $this->db->prepare("UPDATE profile SET profilename=? where id=?");
        $sql->execute(array($profile->getProfileName(), $profile->getID()));
    }

    public function delete(Profile $profile){
        $sql = $this->db->prepare("DELETE FROM profile where id=?");
        $sql->execute(array($profile->getID()));
    }

    public function nameExists($name) {
        $sql = $this->db->prepare("SELECT count(profilename) FROM profile where profilename=?");
        $sql->execute(array($name));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }
}
