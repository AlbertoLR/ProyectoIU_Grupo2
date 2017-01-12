<?php

require_once(__DIR__."/../core/PDOConnection.php");

class DISCOUNT_Model {

    private $db;
	
    public function __construct() {
	
        $this->db = PDOConnection::getInstance();
		
    }
	
    public function fetch_all(){
	
        $sql = $this->db->prepare("SELECT * FROM descuento ORDER BY descripcion");
		
        $sql->execute();
		
        $discounts_db = $sql->fetchAll(PDO::FETCH_ASSOC);
		
        $discounts = array();
		
        foreach ($discounts_db as $discount) {
		
            array_push($discounts, new Discount($discount["id"], $discount["descripcion"],$discount["cantidad"],$discount["categoria_id"]));
			
        }
		
        return $discounts;
		
    }
	
    public function fetch($discountID){
	
      $sql = $this->db->prepare("SELECT descuento.id,descuento.descripcion,descuento.cantidad,descuento.categoria_id FROM descuento");
								 
        $sql->execute(array($discountID));
		
        $discount = $sql->fetch(PDO::FETCH_ASSOC);
		
        if($discount != NULL) {
		
            return new Discount($discount["id"], $discount["descripcion"],$discount["cantidad"],$discount["categoria_id"]);
			
        } else {
		
          $sql1 = $this->db->prepare("SELECT * FROM descuento WHERE descuento.id=? ORDER BY descripcion");
		  
            $sql1->execute(array($discountID));
			
            $discount = $sql1->fetch(PDO::FETCH_ASSOC);
			
            if($discount != NULL) {
			
              return new Discount($discount["id"], $discount["descripcion"],$discount["cantidad"],$discount["categoria_id"]);
			  
            }else{
			
              return NULL;
			  
          }
		  
        }
		
    }
	
    
    public function fetchCategories(){
	
        $sql = $this->db->query("SELECT id,tipo FROM categoria ");
		
        $list_db = $sql->fetchAll(PDO::FETCH_ASSOC);
		
        if($list_db != NULL) {
		
            return $list_db;
			
        } else {
		
            return NULL;
			
        }
		
    }
	
	
    public function insert(Discount $discount) {
	
        $category = $discount->getCategoryid();
      
        $sql = $this->db->prepare("INSERT INTO descuento(descripcion,cantidad,categoria_id) values (?,?,?)");
		
        $sql->execute(array($discount->getDiscountDescription(), $discount->getQuantity(), $category));
		
        $description = $discount->getDiscountDescription();
		
        $sql1 = $this->db->query("SELECT id FROM descuento where descripcion='$description'");
		
        foreach ($sql1 as $key ) {
		
          $id = $key[0];
		  
        }

    }
	
    public function update(Discount $discount){
	
     
        $id = $discount->getID();
		
        $category = $discount->getCategoryid();
		
		 $sql1 = $this->db->query("SELECT descuento_id FROM aplica where descuento_id='$id'");
		
        $array =  $sql1->fetchAll(PDO::FETCH_ASSOC);
		
		$sql = $this->db->prepare("UPDATE descuento SET descripcion=?,cantidad=?,categoria_id=? where id=?");
		
        $sql->execute(array($discount->getDiscountDescription(), $discount->getQuantity(), $category, $discount->getID()));
    }
	
    public function delete(Discount $discount){
	
        $sql = $this->db->prepare("DELETE FROM descuento where id=?");
		
        $sql->execute(array($discount->getID()));
		
    }
	
    public function descriptionExists($discountDescription) {
	
        $sql = $this->db->prepare("SELECT count(descripcion) FROM descuento where descripcion=?");
		
        $sql->execute(array($discountDescription));
		
        if ($sql->fetchColumn() > 0) {
		
            return true;
			
        }
		
   }
   
    public function descriptionExistsUpdate($discountDescription,$discountid) {
	
        $sql = $this->db->prepare("SELECT count(descripcion) FROM descuento where descripcion=? AND id<>$discountid ");
		
        $sql->execute(array($discountDescription));
		
        if ($sql->fetchColumn() > 0) {
		
            return true;
			
			
        }
		
    }
	
}