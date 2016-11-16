<?php

require_once(__DIR__."/../core/ValidationException.php");

class UserPerm {

    private $id;
    private $user;
    private $permission;
    private $username;
    private $controller;
    private $action;
  
    public function __construct($id=NULL, $user=NULL, $permission=NULL, $username=NULL, $controller=NULL, $action=NULL) {
        $this->id = $id;
        $this->user = $user;
        $this->permission = $permission;
        $this->username = $username;
        $this->controller = $controller;
        $this->action = $action;
    }

    public function getID() {
        return $this->id;
    }
    
    public function setID($id) {
        $this->id = $id;
    }
  
    public function getUser() {
        return $this->user;
    }
    
    public function setUser($user) {
        $this->user = $user;
    }

    public function getPermission() {
        return $this->permission;
    }
    
    public function setPermission($permission) {
        $this->permission = $permission;
    }

    public function getUserName() {
        return $this->username;
    }
    
    public function setUserName($profilename) {
        $this->username = $username;
    }

    public function getController() {
        return $this->controller;
    }
    
    public function setController($controller) {
        $this->controler = $controller;
    }

    public function getAction() {
        return $this->action;
    }
    
    public function setAction($action) {
        $this->action = $action;
    }
    
}