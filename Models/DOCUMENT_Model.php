<?php

require_once(__DIR__."/../core/PDOConnection.php");

class DOCUMENT_Model {

    private $db;
  
    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){
        $sql = $this->db->prepare("SELECT * FROM documento");
        $sql->execute();
        $documents_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $documents = array();

        foreach ($documents_db as $document) {
            array_push($documents, new Document($document["id"], $document["dni"], $document["dni_c"], $document["tipo"], $document["documento"]));
        }

        return $documents;
    }

    public function fetch($documentID){
        $sql = $this->db->prepare("SELECT * FROM documento WHERE id=?");
        $sql->execute(array($documentID));
        $document = $sql->fetch(PDO::FETCH_ASSOC);
        
        if ($document != NULL) {
            return new Document($document["id"], $document["dni"], $document["dni_c"], $document["tipo"], $document["documento"]);
        } else {
            return NULL;
        }
    }

    public function insert(Document $document){
        $sql = $this->db->prepare("INSERT INTO documento(dni, dni_c, tipo, documento) values(?,?,?,?)");
        $sql->execute(array($document->getDNI(), $document->getDNIC(), $document->getType(), $document->getDocument()));
    }

    public function update(Document $document){
        $sql = $this->db->prepare("UPDATE documento SET dni=?, dni_c=?, tipo=?, documento=? where id=?");
        $sql->execute(array($document->getDNI(), $document->getDNIC(), $document->getType(), $document->getDocument()));
    }

    public function delete(Document $document){
        $sql = $this->db->prepare("DELETE FROM documento where id=?");
        $sql->execute(array($document->getID()));
    }

    public function search($query) {
        $search_query = "SELECT * FROM documento WHERE ". $query;
        $sql = $this->db->prepare($search_query);
        $sql->execute();
        $documents_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $documents = array();

        foreach ($documents_db as $document) {
            array_push($documents, new Document($document["id"], $document["dni"], $document["dni_c"], $document["tipo"], $document["documento"]));
        }

        return $documents;
    }

    public function nameExists($dni, $dni_c, $type, $document) {
        $sql = $this->db->prepare("SELECT count(id) FROM documento where dni=? AND dni_c=? AND tipo=? AND documento=?");
        $sql->execute(array($dni, $dni_c, $type, $document));
    
        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }
}