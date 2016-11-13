<?php

require_once(__DIR__."/../core/PDOConnection.php");

class UserMapper {

    private $db;
  
    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){
        $sql = $this->db->prepare("SELECT * FROM users");
        return $sql->execute();
    }

    public function fetch(User $user){
        $sql = $this->db-prepare("SELECT * FROM users WHERE id=?");
        return $sql->execute(array($user->getID()));
    }
      
    public function insert(User $user) {
        $sql = $this->db->prepare("INSERT INTO users(username, passwd, profile) values (?,?,?)");
        $sql->execute(array($user->getUsername(), $user->getPasswd(), $user->getProfile()));
    }

    public function update(User $user){
        $sql = $this->db-prepare("UPDATE users SET username=?, passwd=?, profile=? where id=?");
        $sql->execute(array($user->getUsername(), $user->getPasswd(), $user->getProfile(), $user->getID()));
    }
    
    public function delete(User $user){
        $sql = $this->db->prepare("DELETE FROM users where id=?");
        $sql->execute(array($user->getID()));
    }

    public function usernameExists($username) {
        $sql = $this->db->prepare("SELECT count(username) FROM users where username=?");
        $sql->execute(array($username));
    
        if ($sql->fetchColumn() > 0) {   
            return true;
        } 
    }

    public function isValidUser($username, $passwd) {
        $sql = $this->db->prepare("SELECT count(username) FROM users where username=? and passwd=?");
        $sql->execute(array($username, $passwd));
    
        if ($sql->fetchColumn() > 0) {
            return true;        
        }
    }

    public function assignController(User $user, Controller $controller){
        $sql = $this->db->prepare("INSERT INTO users_controller values(?,?)");
        $sql->execute(array($user->getID(), $controller->getID()));
    }

    public function unAssignController(User $user, Controller $controller){
        $sql = $this->db->prepare("DELETE FROM users_controller where id=?");
        $sql->execute(array($user->getID().$controller->getID()));
    }
}