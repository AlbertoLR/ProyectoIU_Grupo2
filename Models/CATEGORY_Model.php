<?php

require_once(__DIR__."/../core/PDOConnection.php");

class CATEGORY_Model {

    private $db;
  
    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){
        $sql = $this->db->prepare("SELECT * FROM categoria ORDER BY tipo");
        $sql->execute();
        $categories_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $categories = array();

        foreach ($categories_db as $category) {
            array_push($categories, new Category($category["id"], $category["tipo"]));
        }

        return $categories;
    }

    public function fetch($categoryID){
        $sql = $this->db->prepare("SELECT * FROM categoria WHERE id=?");
        $sql->execute(array($categoryID));
        $category = $sql->fetch(PDO::FETCH_ASSOC);

        if($category != NULL) {
            return new Category($category["id"], $category["tipo"]);
        } else {
            return NULL;
        }
        
    }
      
    public function insert(Category $category) {
        $sql = $this->db->prepare("INSERT INTO categoria(tipo) values (?)");
        $sql->execute(array($category->getType()));
    }

    public function update(Category $category){
        $sql = $this->db->prepare("UPDATE categoria SET tipo=? where id=?");
        $sql->execute(array($category->getType(), $category->getID()));
    }
    
    public function delete(Category $category){
        $sql = $this->db->prepare("DELETE FROM categoria where id=?");
        $sql->execute(array($category->getID()));
    }

    public function nameExists($type) {
        $sql = $this->db->prepare("SELECT count(tipo) FROM categoria where tipo=?");
        $sql->execute(array($type));
    
        if ($sql->fetchColumn() > 0) {   
            return true;
        } 
    }
}