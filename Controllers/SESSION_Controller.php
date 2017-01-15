<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Session.php");
require_once(__DIR__."/../Models/SESSION_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class SESSION_Controller extends BaseController {

    private $sessionMapper;

    public function __construct() {
        parent::__construct();
        $this->sessionMapper = new SESSION_Model();
        $this->view->setLayout("default");
    }

    public function show(){
        $this->checkPerms("session", "show", $this->currentUserId);

        $sessions = $this->sessionMapper->fetch_all();
        $hours = $this->sessionMapper->fetch_hours();
        $activities = $this->sessionMapper->fetch_activities();
        $events = $this->sessionMapper->fetch_events();
        $users = $this->sessionMapper->fetch_users();
        $spaces = $this->sessionMapper->fetch_spaces();

        $this->view->setVariable("hours", $hours);
        $this->view->setVariable("activities", $activities);
        $this->view->setVariable("events", $events);
        $this->view->setVariable("users", $users);
        $this->view->setVariable("spaces", $spaces);
        $this->view->setVariable("sessions", $sessions);
        $this->view->render("session", "SESSION_SHOW_Vista");
    }

    public function add(){
        $this->checkPerms("session", "add", $this->currentUserId);

        $session = new Session();

        if (isset($_POST["submit"])) {

            try {
                  foreach ($_POST["hoursid"] as $hour ){

                    $session->setHoursID($hour);
                    $session->setActivityID($_POST["activity"]);
                    $session->setEventID($_POST["event"]);
                    $session->setUserID($_POST["user"]);
                    $session->setSpaceID($_POST["spaces"]);

                    $this->sessionMapper->insert($session);

                }

                $this->view->setFlash(sprintf(i18n("Session \"%s\" successfully added.")));
                $this->view->redirect("session", "show");
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        $sessions = $this->sessionMapper->fetch_all();
        $hours = $this->sessionMapper->fetch_hours();
        $activities = $this->sessionMapper->fetch_activities();
        $events = $this->sessionMapper->fetch_events();
        $users = $this->sessionMapper->fetch_users();
        $spaces = $this->sessionMapper->fetch_spaces();

        $this->view->setVariable("hours", $hours);
        $this->view->setVariable("activities", $activities);
        $this->view->setVariable("events", $events);
        $this->view->setVariable("users", $users);
        $this->view->setVariable("spaces", $spaces);
        $this->view->setVariable("sessions", $sessions);
        $this->view->render("session", "SESSION_ADD_Vista");
    }


    public function edit(){
        $this->checkPerms("session", "edit", $this->currentUserId);


        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A session id is mandatory"));
        }

        $sessionid = $_REQUEST["id"];
        $session= $this->sessionMapper->fetch($sessionid);

        if ($session == NULL) {
            throw new Exception(i18n("No such session with id: ").$sessionid);
        }

        if (isset($_POST["submit"])) {

            try {
                $session->setHoursID($_POST["hoursid"]);
                $session->setActivityID($_POST["activity"]);
                $session->setEventID($_POST["event"]);
                $session->setUserID($_POST["user"]);
                $session->setSpaceID($_POST["spaces"]);

                $this->sessionMapper->update($session);

                $this->view->setFlash(sprintf(i18n("Session \"%s\" successfully updated.")));
                $this->view->redirect("session", "show");
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $hours = $this->sessionMapper->fetch_hours();
        $activities = $this->sessionMapper->fetch_activities();
        $events = $this->sessionMapper->fetch_events();
        $users = $this->sessionMapper->fetch_users();
        $spaces = $this->sessionMapper->fetch_spaces();

        $this->view->setVariable("hours", $hours);
        $this->view->setVariable("activities", $activities);
        $this->view->setVariable("events", $events);
        $this->view->setVariable("users", $users);
        $this->view->setVariable("spaces", $spaces);
        $this->view->setVariable("session", $session);
        $this->view->render("session", "SESSION_EDIT_Vista");
    }

    public function delete() {
        $this->checkPerms("session", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $sessionid = $_REQUEST["id"];
        $session = $this->sessionMapper->fetch($sessionid);

        if ($session == NULL) {
            throw new Exception(i18n("No such session with id: ").$sessionid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->sessionMapper->delete($session);
                $this->view->setFlash(sprintf(i18n("Session \"%s\" successfully deleted.")));
            }
            $this->view->redirect("session", "show");
        }
        $this->view->setVariable("session", $session);
        $this->view->render("session", "SESSION_DELETE_Vista");
    }

    public function search()
    {
        $this->checkPerms("session", "show", $this->currentUserId);

        if (isset($_POST["submit"])) {
            $query = "";
            $flag = 0;

            if ($_POST["actividad_id"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "actividad_id='". $_POST["actividad_id"] ."'";
                $flag = 1;
            }

            if ($_POST["evento_id"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "evento_id='". $_POST["evento_id"] ."'";
                $flag = 1;
            }

            if ($_POST["user_id"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "user_id='". $_POST["user_id"] ."'";
                $flag = 1;
            }

            if ($_POST["espacio_id"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "espacio_id='". $_POST["espacio_id"] ."'";
                $flag = 1;
            }

            if (empty($query)) {
                $sessions = $this->sessionMapper->fetch_all();
            } else {
                $sessions = $this->sessionMapper->search($query);
            }

            $hours = $this->sessionMapper->fetch_hours();
            $activities = $this->sessionMapper->fetch_activities();
            $events = $this->sessionMapper->fetch_events();
            $users = $this->sessionMapper->fetch_users();
            $spaces = $this->sessionMapper->fetch_spaces();

            $this->view->setVariable("hours", $hours);
            $this->view->setVariable("activities", $activities);
            $this->view->setVariable("events", $events);
            $this->view->setVariable("users", $users);
            $this->view->setVariable("spaces", $spaces);
            $this->view->setVariable("sessions", $sessions);
            $this->view->render("session", "SESSION_SHOW_Vista");
        }
        else {
          $hours = $this->sessionMapper->fetch_hours();
          $activities = $this->sessionMapper->fetch_activities();
          $events = $this->sessionMapper->fetch_events();
          $users = $this->sessionMapper->fetch_users();
          $spaces = $this->sessionMapper->fetch_spaces();

          $this->view->setVariable("hours", $hours);
          $this->view->setVariable("activities", $activities);
          $this->view->setVariable("events", $events);
          $this->view->setVariable("users", $users);
          $this->view->setVariable("spaces", $spaces);
          $this->view->render("session", "SESSION_SEARCH_Vista");
        }

      }
}
