<?php

require_once(__DIR__."/../core/ValidationException.php");

class Rankhour {

    private $id;
    private $day;
    private $opening;
    private $closing;
    private $seasonid;

    public function __construct($id=NULL, $day=NULL,$opening=NULL,$closing=NULL,$seasonid=NULL) {
        $this->id = $id;
        $this->day = $day;
        $this->opening = $opening;
        $this->closing=$closing;
        $this->seasonid=$seasonid;
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

    public function getSeasonID() {
        return $this->seasonid;
    }

    public function setSeasonID($seasonid) {
        $this->seasonid= $seasonid;
    }

}
