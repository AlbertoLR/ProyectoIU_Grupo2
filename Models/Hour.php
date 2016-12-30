<?php

require_once(__DIR__."/../core/ValidationException.php");

class Hour {

    private $id;
    private $day;
    private $opening;
    private $closing;
    private $rankid;
    private $active;

    public function __construct($id=NULL, $day=NULL,$opening=NULL,$closing=NULL,$rankid=NULL,$active=NULL) {
        $this->id = $id;
        $this->day = $day;
        $this->opening = $opening;
        $this->closing=$closing;
        $this->rankid=$rankid;
        $this->active=$active;
    }

    public function getID() {
        return $this->id;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function getDay() {
        return $this->day;
    }

    public function setDay($day) {
        $this->day = $day;
    }

    public function getOpening() {
        return $this->opening;
    }

    public function setOpening($opening) {
        $this->opening = $opening;
    }

    public function getClosing() {
        return $this->closing;
    }

    public function setClosing($closing) {
        $this->closing= $closing;
    }

    public function getRankID() {
        return $this->rankid;
    }

    public function setRankID($rankid) {
        $this->rankid= $rankid;
    }
    public function getActive() {
        return $this->active;
    }

    public function setActive() {
        $this->active= false;
    }

}
