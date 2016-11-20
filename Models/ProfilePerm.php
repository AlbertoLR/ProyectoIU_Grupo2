<?php

require_once(__DIR__."/../core/ValidationException.php");

class ProfilePerm {

    private $id;
    private $profile;
    private $permission;
    private $profilename;
    private $controller;
    private $action;
  
    public function __construct($id=NULL, $profile=NULL, $permission=NULL, $profilename=NULL, $controller=NULL, $action=NULL) {
        $this->id = $id;
        $this->profile = $profile;
        $this->permission = $permission;
        $this->profilename = $profilename;
        $this->controller = $controller;
        $this->action = $action;
    }

    public function getID() {
        return $this->id;
    }
    
    public function setID($id) {
        $this->id = $id;
    }
  
    public function getProfile() {
        return $this->profile;
    }
    
    public function setProfile($profile) {
        $this->profile = $profile;
    }

    public function getPermission() {
        return $this->permission;
    }
    
    public function setPermission($permission) {
        $this->permission = $permission;
    }

    public function getProfileName() {
        return $this->profilename;
    }
    
    public function setProfileName($profilename) {
        $this->profilename = $profilename;
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