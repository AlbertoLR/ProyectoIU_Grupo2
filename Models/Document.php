<?php

require_once(__DIR__."/../core/ValidationException.php");

class Document {

    private $id;
    private $dni;
    private $dni_c;
    private $type;
    private $document;
  
    public function __construct($id=NULL, $dni=NULL, $dni_c=NULL, $type=NULL, $document=NULL) {
        $this->id = $id;
        $this->dni = $dni;
        $this->dni_c = $dni_c;
        $this->type = $type;
        $this->document = $document;
    }

    public function getID() {
        return $this->id;
    }
    
    public function setID($id) {
        $this->id = $id;
    }

    public function getDNI() {
        return $this->dni;
    }
    
    public function setDNI($dni) {
        $this->dni = $dni;
    }

    public function getDNIC() {
        return $this->dni_c;
    }
    
    public function setDNIC($dni_c) {
        $this->dni_c = $dni_c;
    }

    public function getType() {
        return $this->type;
    }
    
    public function setType($type) {
        $this->type = $type;
    }

    public function getDocument() {
        return $this->document;
    }
    
    public function setDocument($document) {
        $this->document = $document;
    }
}