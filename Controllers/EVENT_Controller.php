<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Event.php");
require_once(__DIR__."/../Models/EVENT_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class EVENT_Controller extends BaseController {

    private $eventMapper;

    public function __construct() {
        parent::__construct();
        $this->eventMapper = new EVENT_Model();
        $this->view->setLayout("default");
    }

    public function show(){
        $this->checkPerms("event", "show", $this->currentUserId);

        $events = $this->eventMapper->fetch_all();
        $this->view->setVariable("events", $events);
        $this->view->render("event", "EVENT_SHOW_Vista");
    }

    public function showone(){
        $this->checkPerms("event", "showone", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A event id is mandatory"));
        }

        $eventid = $_REQUEST["id"];
        $event = $this->eventMapper->fetch($eventid);

        if ($event == NULL) {
            throw new Exception(i18n("No such event with id: ").$eventid);
        }

        $this->view->setVariable("event", $event);
        $this->view->render("event", "EVENT_SHOWONE_Vista");
    }

    public function add(){
        $this->checkPerms("event", "add", $this->currentUserId);

        $event = new Event();

        if (isset($_POST["submit"])) {
            $event->setNombre($_POST["nombre"]);
			      $event->setPrecio($_POST["precio"]);

            try {
                if (!$this->eventMapper->nameExists($_POST["nombre"])){
                    $event->checkIsValidForCreate();
                    $this->eventMapper->insert($event);

                    $this->view->setFlash(sprintf(i18n("Event \"%s\" successfully added."), $event->getNombre()));

                    $this->view->redirect("event", "show");
                } else {
                    $errors = array();
	                $errors["general"] = i18n("Event already exists");
	                $this->view->setVariable("errors", $errors);
                }
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->setVariable("event", $event);
        $this->view->render("event", "EVENT_ADD_Vista");
    }

    public function edit() {
        $this->checkPerms("event", "edit", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A event id is mandatory"));
        }

        $eventid = $_REQUEST["id"];
        $event = $this->eventMapper->fetch($eventid);

        if ($event == NULL) {
            throw new Exception(i18n("No such event with id: ").$eventid);
        }

        if (isset($_POST["submit"])) {
            $event->setNombre($_POST["nombre"]);
			$event->setPrecio($_POST["precio"]);

            try {
                if (!$this->eventMapper->nameExistsUpdate($_POST["nombre"],$eventid)){
                $event->checkIsValidForCreate();
                $this->eventMapper->update($event);
                $this->view->setFlash(sprintf(i18n("Event \"%s\" successfully updated."), $event->getNombre()));
                $this->view->redirect("event", "show");
                } else {
                    $errors = array();
	                $errors["general"] = i18n("Event already exists");
	                $this->view->setVariable("errors", $errors);
                }
            } catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->setVariable("event", $event);
        $this->view->render("event", "EVENT_EDIT_Vista");
    }

    public function delete() {
        $this->checkPerms("event", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $eventid = $_REQUEST["id"];
        $event = $this->eventMapper->fetch($eventid);

        if ($event == NULL) {
            throw new Exception(i18n("No such event with id: ").$eventid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->eventMapper->delete($event);
                $this->view->setFlash(sprintf(i18n("Event \"%s\" successfully deleted."), $event->getNombre()));
            }
            $this->view->redirect("event", "show");
        }
        $this->view->setVariable("event", $event);
        $this->view->render("event", "EVENT_DELETE_Vista");
    }

    public function search()
    {
        $this->checkPerms("event", "show", $this->currentUserId);

        if (isset($_POST["submit"])) {
            $query = "";
            $flag = 0;

            if ($_POST["nombre"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "nombre LIKE '%". $_POST["nombre"] ."%'";
                $flag = 1;
            }

            if ($_POST["precio"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "precio LIKE '%". $_POST["precio"] ."%'";
                $flag = 1;
            }

            if (empty($query)) {
                $events = $this->eventMapper->fetch_all();
            } else {
                $events = $this->eventMapper->search($query);
            }
            $this->view->setVariable("events", $events);
            $this->view->render("event", "EVENT_SHOW_Vista");
        }
        else {

            $events = $this->eventMapper->fetch_all();
            $this->view->setVariable("events", $events);
            $this->view->render("event", "EVENT_SEARCH_Vista");
        }

      }

	public function inscription() {
        $this->checkPerms("event", "show", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $eventid = $_REQUEST["id"];
        $event = $this->eventMapper->fetch($eventid);
        $inscriptions= $this->eventMapper->fetch_inscriptions($eventid);

        $this->view->setVariable("event", $event);
        $this->view->setVariable("inscriptions", $inscriptions);
        $this->view->render("event", "EVENT_INSCRIPTION_Vista");
    }
}
