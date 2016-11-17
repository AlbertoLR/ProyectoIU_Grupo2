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
            array_push($users, new User($user["id"], $user["profile"], $user["dni"], $user["username"], $user["name"],
                                        $user["surname"],$user["fecha_nac"],$user["direccion"],$user["comentario"],
                                        $user["num_cuenta"],$user["tipo_contrato"], $user["email"],$user["foto"],$user["activo"],NULL ));
        }

        return $users;
    }

    public function fetch($userID){
        $sql = $this->db->prepare("SELECT * FROM user WHERE id=?");
        $sql->execute(array($userID));
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if($user != NULL) {
            return new User($user["id"], $user["profile"], $user["dni"], $user["username"], $user["name"],
                            $user["surname"],$user["fecha_nac"],$user["direccion"],$user["comentario"],
                            $user["num_cuenta"],$user["tipo_contrato"], $user["email"],$user["foto"],$user["activo"],NULL );
        } else {
            return NULL;
        }
    }

    public function insert(User $user) {
        $sql = $this->db->prepare("INSERT INTO user(profile,dni,username,name,surname,fecha_nac,direccion,comentario,num_cuenta,tipo_contrato,email,foto,activo,passwd) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $sql->execute(array($user->getProfile(), $user->getDni(), $user->getUsername(), $user->getName(),
                            $user->getSurname(), $user->getFechaNac(), $user->getDireccion(), $user->getComentario(), $user->getNumCuenta(),
                            $user->getTipoContrato(), $user->getEmail(), $user->getFoto(), $user->getActivo(),$user->getPasswd()));
    }

    public function update(User $user){
        if ($user->getPasswd()) {
            $sql = $this->db->prepare("UPDATE user SET profile=?, dni=?, username=?, name=?, surname=?, fecha_nac=?,
                                                       direccion=?, comentario=?, num_cuenta=?, tipo_contrato=?, email=?, foto=?,
                                                       activo=?, passwd=? where id=?");
            $sql->execute(array($user->getProfile(), $user->getDni(), $user->getUsername(), $user->getName(),
                                $user->getSurname(), $user->getFechaNac(), $user->getDireccion(), $user->getComentario(), $user->getNumCuenta(),
                                $user->getTipoContrato(), $user->getEmail(), $user->getFoto(), $user->getActivo(),$user->getPasswd(), $user->getID()));
        }
        else {
            $sql = $this->db->prepare("UPDATE user SET profile=?, dni=?, username=?, name=?, surname=?, fecha_nac=?,
                                                       direccion=?, comentario=?, num_cuenta=?, tipo_contrato=?, email=?, foto=?,
                                                       activo=? where id=?");
            $sql->execute(array($user->getProfile(), $user->getDni(), $user->getUsername(), $user->getName(),
                                $user->getSurname(), $user->getFechaNac(), $user->getDireccion(), $user->getComentario(), $user->getNumCuenta(),
                                $user->getTipoContrato(), $user->getEmail(), $user->getFoto(), $user->getActivo(), $user->getID()));
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

    public function dniExists($dni) {
        $sql = $this->db->prepare("SELECT count(dni) FROM user where dni=?");
        $sql->execute(array($dni));

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
