<?php

require_once(__DIR__."/../core/ValidationException.php");

class Discount {

    private $id;
	
    private $descripcion;
	
    private $cantidad;
	
    private $categoria_id;
	
    public function __construct($id=NULL, $descripcion=NULL, $cantidad=NULL, $categoria_id=NULL ) {
	
        $this->id = $id;
		
        $this->descripcion = $descripcion;
		
        $this->cantidad = $cantidad;
		
        $this->categoria_id = $categoria_id;

    }
	
    public function getID() {
	
        return $this->id;
		
    }
	
    public function setID($id) {
	
        $this->id = $id;
		
    }
	
    public function getDiscountDescription() {
	
        return $this->descripcion;
		
    }
	
    public function setDiscountDescription($descripcion) {
	
        $this->descripcion = $descripcion;
		
    }
	
    public function getQuantity() {
	
        return $this->cantidad;
		
    }
	
    public function setQuantity($cantidad) {
	
        $this->cantidad= $cantidad;
		
    }
	
    
    public function getCategoryid() {
	
        return $this->categoria_id;
		
    }
	
    public function setCategoryid($categoria_id) {
	
        $this->categoria_id = $categoria_id;
		
    }
	
	
    public function checkIsValidForCreate() {
	
        $errors = array();
		
        if (strlen($this->descripcion) < 2) {
		
            $errors["discountdescription"] = "nombre must be at least 5 characters length";
			
        }
		
        if (sizeof($errors)>0){
		
            throw new ValidationException($errors, "discount is not valid");
			
        }
		
    }
	
}