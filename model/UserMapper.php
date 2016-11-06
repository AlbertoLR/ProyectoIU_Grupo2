<?php

require_once(__DIR__."/../core/PDOConnection.php");

class UserMapper {

    private $db;
  
    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }
      
    public function save($user) {
        $stmt = $this->db->prepare("INSERT INTO users values (?,?)");
        $stmt->execute(array($user->getUsername(), $user->getPasswd()));
    }
  
    public function usernameExists($username) {
        $stmt = $this->db->prepare("SELECT count(username) FROM users where username=?");
        $stmt->execute(array($username));
    
        if ($stmt->fetchColumn() > 0) {   
            return true;
        } 
    }

    public function isValidUser($username, $passwd) {
        $stmt = $this->db->prepare("SELECT count(username) FROM users where username=? and passwd=?");
        $stmt->execute(array($username, $passwd));
    
        if ($stmt->fetchColumn() > 0) {
            return true;        
        }
    }
}