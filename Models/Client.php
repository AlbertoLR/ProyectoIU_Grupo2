<?php

//dni, nome, apelidos, data nacemento, enderezo, mail, conta bancaria, tipo de contrato, comentarios, documentos

require_once(__DIR__."/../core/ValidationException.php");

class Client {

    private $id;
    private $dni;
    private $name;
    private $surname;
    private $birthday;
    private $profession;
    private $phone;
    private $address;
    private $comment;
    private $email;
    private $alert;
    private $unemployed;
    private $student;
    private $family;
    private $account;
    private $active;
    private $photo;
    private $injury;

    public function __construct($id=NULL,$dni=NULL,$name=NULL, $surname=NULL,
                                $birthday=NULL, $profession=NULL, $phone=NULL, $address=NULL,$comment=NULL,
                                $email=NULL,$alert=NULL,$unemployed=NULL,$student=NULL,$family=NULL,$account=NULL,
                                $active=NULL,$photo=NULL,$injury=NULL) {
     $this->id = $id;
     $this->dni = $dni;
     $this->name = $name;
     $this->surname = $surname;
     $this->birthday = $birthday;
     $this->profession = $profession;
     $this->phone = $phone;
     $this->address = $address;
     $this->comment = $comment;
     $this->email = $email;
     $this->alert = $alert;
     $this->unemployed= $unemployed;
     $this->student = $student;
     $this->family = $family;
     $this->account = $account;
     $this->active = $active;
     $this->photo = $photo;
     $this->injury = $injury;
    }

    public function getID() {
        return $this->id;
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

    public function getBirthday(){
        return $this->birthday;
    }

    public function setBirthday($birthday){
        $this->birthday = $birthday;
    }

    public function getProfession(){
        return $this->profession;
    }

    public function setProfession($profession){
        $this->profession = $profession;
    }

    public function getPhone(){
        return $this->phone;
    }

    public function setPhone($phone){
        $this->phone= $phone;
    }

    public function getAddress(){
        return $this->address;
    }

    public function setAddress($address){
        $this->address = $address;
    }

    public function getComment(){
        return $this->comment;
    }

    public function setComment($comment){
        $this->comment = $comment;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getAlert() {
        return $this->alert;
    }

    public function setAlert($alert) {
        $this->alert = $alert;
    }

    public function getUnemPloyed() {
        return $this->unemployed;
    }

    public function setUnemPloyed($unemployed) {
        $this->unemployed = $unemployed;
    }
    public function getStudent() {
        return $this->student;
    }

    public function setStudent($student) {
        $this->student = $student;
    }

    public function getFamily() {
        return $this->family;
    }

    public function setFamily($family) {
        $this->family = $family;
    }

    public function getAccount() {
        return $this->account;
    }

    public function setAccount($account) {
        $this->account = $account;
    }

    public function getActive() {
        return $this->active;
    }

    public function setActive($active) {
        $this->active = $active;
    }
    public function getPhoto() {
        return $this->photo;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
    }
    public function getInjury() {
        return $this->injury;
    }

    public function setInjury($injury) {
        $this->injury = $injury;
    }
    public function checkIsValidForCreate() {
        $errors = array();
        if (sizeof($errors)>0){
            throw new ValidationException($errors, "client is not valid");
        }
    }
}
