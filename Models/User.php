<?php

//dni, nome, apelidos, data nacemento, enderezo, mail, conta bancaria, tipo de contrato, comentarios, documentos

require_once(__DIR__."/../core/ValidationException.php");

class User {

    private $id;
    private $profile;
    private $dni;
    private $username;
    private $name;
    private $surname;
    private $fecha_nac;
    private $direccion;
    private $comentario;
    private $num_cuenta;
    private $tipo_contrato;
    private $email;
    private $foto;
    private $activo;
    private $passwd;
    private $injury;



    public function __construct($id=NULL, $profile=NULL, $dni=NULL, $username=NULL, $name=NULL, $surname=NULL,
                                $fecha_nac=NULL, $direccion=NULL, $comentario=NULL, $num_cuenta=NULL, $tipo_contrato=NULL,
                                $email=NULL, $foto=NULL, $activo=NULL, $passwd=NULL,$injury=NULL) {
     $this->id = $id;
     $this->profile = $profile;
     $this->dni = $dni;
     $this->username = $username;
     $this->name = $name;
     $this->surname = $surname;
     $this->fecha_nac = $fecha_nac;
     $this->direccion = $direccion;
     $this->comentario = $comentario;
     $this->num_cuenta = $num_cuenta;
     $this->tipo_contrato = $tipo_contrato;
     $this->email = $email;
     $this->foto = $foto;
     $this->activo = $activo;
     $this->passwd = $passwd;
     $this->injury = $injury;
    }

    public function getID() {
        return $this->id;
    }

    public function getProfile(){
        return $this->profile;
    }

    public function setProfile($profile){
        $this->profile = $profile;
    }
    public function setID($id) {
        $this->id = $id;
    }

    public function getDni(){
        return $this->dni;
    }

    public function setDni($dni){
        $this->dni= $dni;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getSurname(){
        return $this->surname;
    }

    public function setSurname($surname){
        $this->surname = $surname;
    }

    public function getFechaNac(){
        return $this->fecha_nac;
    }

    public function setFechaNac($fecha_nac){
        $this->fecha_nac = $fecha_nac;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }

    public function getComentario(){
        return $this->comentario;
    }

    public function setComentario($comentario){
        $this->comentario= $comentario;
    }

    public function getNumCuenta(){
        return $this->num_cuenta;
    }

    public function setNumCuenta($num_cuenta){
        $this->num_cuenta = $num_cuenta;
    }

    public function getTipoContrato(){
        return $this->tipo_contrato;
    }

    public function setTipoContrato($tipo_contrato){
        $this->tipo_contrato = $tipo_contrato;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function getActivo() {
        return $this->activo;
    }

    public function setActivo($activo) {
        $this->activo = $activo;
    }
    public function getPasswd() {
        return $this->passwd;
    }

    public function setPasswd($passwd) {
        $this->passwd = $passwd;
    }

    public function getInjury() {
        return $this->injury;
    }

    public function setInjury($injury) {
        $this->injury = $injury;
    }

    public function checkIsValidForCreate() {
        $errors = array();
        if (strlen($this->username) < 4) {
            $errors["username"] = "Username must be at least 5 characters length";

        }
        if (sizeof($errors)>0){
            throw new ValidationException($errors, "user is not valid");
        }
    }
}
