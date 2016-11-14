<?php

require_once(__DIR__."/../core/PDOConnection.php");

class UserMapper {

    private $db;
  
    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){
        $sql = $this->db->prepare("SELECT * FROM users");
        $sql->execute();
        $users_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $users = array();

        foreach ($users_db as $user) {
            array_push($users, new User($user["id"], $user["username"], NULL, $user["profile"]));
        }
        
        return $users;
    }

    public function fetch($userID){
        $sql = $this->db->prepare("SELECT * FROM users WHERE id=?");
        $sql->execute(array($userID));
        $user = $sql->fetch(PDO::FETCH_ASSOC);
    
        if($user != NULL) {
            return new User($user["id"], $user["username"], NULL, $user["profile"]);
        } else {
            return NULL;
        }
    }
      
    public function insert(User $user) {
        $sql = $this->db->prepare("INSERT INTO users(username, passwd, profile) values (?,?,?)");
        $sql->execute(array($user->getUsername(), $user->getPasswd(), $user->getProfile()));
    }

    public function update(User $user){
        if (!empty($user->getPasswd())) {
            $sql = $this->db->prepare("UPDATE users SET username=?, passwd=?, profile=? where id=?");
            $sql->execute(array($user->getUsername(), $user->getPasswd(), $user->getProfile(), $user->getID()));
        }
        else {
            $sql = $this->db->prepare("UPDATE users SET username=?, profile=? where id=?");
            $sql->execute(array($user->getUsername(), $user->getProfile(), $user->getID()));
        }
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