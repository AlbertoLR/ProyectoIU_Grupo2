<?php

require_once(__DIR__."/../core/PDOConnection.php");

class UserMapper {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){
        $sql = $this->db->prepare("SELECT * FROM user");
        $sql->execute();
        $users_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $users = array();

        foreach ($users_db as $user) {
            array_push($users, new User($user["id"], $user["username"], NULL, $user["profile"]));
        }

        return $users;
    }

    public function fetch($userID){
        $sql = $this->db->prepare("SELECT * FROM user WHERE id=?");
        $sql->execute(array($userID));
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if($user != NULL) {
            return new User($user["id"], $user["username"], NULL, $user["profile"]);
        } else {
            return NULL;
        }
    }

    public function insert(User $user) {
        $sql = $this->db->prepare("INSERT INTO user(username, passwd, profile) values (?,?,?)");
        $sql->execute(array($user->getUsername(), $user->getPasswd(), $user->getProfile()));
    }

    public function update(User $user){
        if ($user->getPasswd()) {
            $sql = $this->db->prepare("UPDATE user SET username=?, passwd=?, profile=? where id=?");
            $sql->execute(array($user->getUsername(), $user->getPasswd(), $user->getProfile(), $user->getID()));
        }
        else {
            $sql = $this->db->prepare("UPDATE user SET username=?, profile=? where id=?");
            $sql->execute(array($user->getUsername(), $user->getProfile(), $user->getID()));
        }
    }

    public function delete(User $user){
        $sql = $this->db->prepare("DELETE FROM user where id=?");
        $sql->execute(array($user->getID()));
    }

    public function usernameExists($username) {
        $sql = $this->db->prepare("SELECT count(username) FROM user where username=?");
        $sql->execute(array($username));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }

    public function isValidUser($username, $passwd) {

        if (empty($passwd)){
            return false;
        }

        $sql = $this->db->prepare("SELECT count(username) FROM user where username=? and passwd=?");
        $sql->execute(array($username, $passwd));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }
}
