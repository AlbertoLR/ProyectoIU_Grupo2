<?php

require_once(__DIR__."/../core/ValidationException.php");

class Notification {

    private $name;
    private $surname;
	private $activity;
	private $email;
	private $subject;
	private $text;
  
    public function __construct($name=NULL, $surname=NULL, $activity=NULL,$email=NULL, $subject=NULL, $text=NULL) {
        $this->name = $name;
        $this->surname = $surname;
		$this->activity = $activity;
		$this->email = $email;
		$this->subject = $subject;
		$this->text = $text;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
    
    public function getSurname() {
        return $this->surname;
    }
    
    public function setSurname($surname) {
        $this->surname = $surname;
    }
	
    public function getActivity() {
        return $this->activity;
    }

    public function setActivity($activity) {
        $this->activity = $activity;
    }
	
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
	
    public function getSubject() {
        return $this->subject;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
    }
	
    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
    }
    
}