<?php

require_once(__DIR__."/../core/ValidationException.php");

class Assistance {

    private $session_id;
    private $client_id;
    private $assistance;

    public function __construct($client_id=NULL,$assistance=NULL,$session_id=NULL) {
        $this->session_id = $session_id;
        $this->client_id = $client_id;
        $this->assistance = $assistance;
    }

    public function getSessionID() {
        return $this->session_id;
    }

    public function setSessionID($id) {
        $this->session_id = $id;
    }

    public function getClientID() {
        return $this->client_id;
    }

    public function setClientID($id) {
        $this->client_id = $id;
    }

    public function getAssistance() {
        return $this->assistance;
    }

    public function setAssistance($assistance) {
        $this->assistance = $assistance;
    }

}
