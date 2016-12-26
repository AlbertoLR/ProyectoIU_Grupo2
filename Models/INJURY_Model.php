<?php

require_once(__DIR__."/../core/PDOConnection.php");

class INJURY_Model {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){
        $sql = $this->db->prepare("SELECT * FROM lesion");
        $sql->execute();
        $injurys_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $injurys = array();

        foreach ($injurys_db as $injury) {
            array_push($injurys, new Injury($injury["id"], $injury["descripcion"]));
        }

        return $injurys;
    }

    public function fetch($injuryID){
        $sql = $this->db->prepare("SELECT * FROM lesion WHERE id=?");
        $sql->execute(array($injuryID));
        $injury = $sql->fetch(PDO::FETCH_ASSOC);

        if ($injury != NULL) {
            return new Injury($injury["id"], $injury["descripcion"]);
        } else {
            return NULL;
        }
    }

    public function fetch_by_injurydescription($injurydescription){
        $sql = $this->db->prepare("SELECT * FROM lesion WHERE injurydescription=?");
        $sql->execute(array($injurydescription));
        $injury = $sql->fetch(PDO::FETCH_ASSOC);

        if ($injury != NULL) {
            return new Injury($injury["id"], $injury["injurydescription"]);
        } else {
            return NULL;
        }
    }

    public function insert(Injury $injury) {
        $sql = $this->db->prepare("INSERT INTO lesion(descripcion) values (?)");
        $sql->execute(array($injury->getInjuryDescription()));
    }

    public function update(Injury $injury){
        $sql = $this->db->prepare("UPDATE lesion SET descripcion=? where id=?");
        $sql->execute(array($injury->getInjuryDescription(), $injury->getID()));
    }

    public function delete(Injury $injury){
        $sql = $this->db->prepare("DELETE FROM lesion where id=?");
        $sql->execute(array($injury->getID()));
    }

    public function nameExists($description) {
        $sql = $this->db->prepare("SELECT count(descripcion) FROM lesion where descripcion=?");
        $sql->execute(array($description));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }
}
