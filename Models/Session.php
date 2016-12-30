<?php

require_once(__DIR__."/../core/ValidationException.php");

class Session {

    private $id;
    private $activity_id;
    private $hours_id;
    private $event_id;
    private $user_id;
    private $space_id;

    public function __construct($id=NULL, $activity_id=NULL,$hours_id=NULL,$event_id=NULL,$user_id=NULL,$space_id=NULL) {
        $this->id = $id;
        $this->activity_id = $activity_id;
        $this->hours_id = $hours_id;
        $this->event_id=$event_id;
        $this->user_id=$user_id;
        $this->space_id=$space_id;
    }

    public function getID() {
        return $this->id;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function getActivityID() {
        return $this->activity_id;
    }

    public function setActivityID($activity_id) {
        $this->activity_id = $activity_id;
    }

    public function getHoursID() {
        return $this->hours_id;
    }

    public function setHoursID($hours_id) {
        $this->hours_id = $hours_id;
    }

    public function getEventID() {
        return $this->event_id;
    }

    public function setEventID($event_id) {
        $this->event_id= $event_id;
    }

    public function getUserID() {
        return $this->user_id;
    }

    public function setUserID($user_id) {
        $this->user_id= $user_id;
    }

    public function getSpaceID() {
        return $this->space_id;
    }

    public function setSpaceID($space_id) {
        $this->space_id= $space_id;
    }

}
