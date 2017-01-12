<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Space.php");
require_once(__DIR__."/../Models/SPACE_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class SPACE_Controller extends BaseController {

    private $spaceMapper;

    public function __construct() {
        parent::__construct();
        $this->spaceMapper = new SPACE_Model();
        $this->view->setLayout("default");
    }

    public function show(){
        $this->checkPerms("space", "show", $this->currentUserId);

        $spaces = $this->spaceMapper->fetch_all();
        $this->view->setVariable("spaces", $spaces);
        $this->view->render("space", "SPACE_SHOW_Vista");
    }

    public function showone(){
        $this->checkPerms("space", "showone", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A space id is mandatory"));
        }

        $spaceid = $_REQUEST["id"];
        $space = $this->spaceMapper->fetch($spaceid);

        if ($space == NULL) {
            throw new Exception(i18n("No such space with id: ").$spaceid);
        }

        $this->view->setVariable("space", $space);
        $this->view->render("space", "SPACE_SHOWONE_Vista");
    }

    public function add(){
        $this->checkPerms("space", "add", $this->currentUserId);

        $space = new Space();

        if (isset($_POST["submit"])) {
            $space->setNombre($_POST["nombre"]);

            try {
                if (!$this->spaceMapper->nameExists($_POST["nombre"])){
                    $space->checkIsValidForCreate();
                    $this->spaceMapper->insert($space);

                    $this->view->setFlash(sprintf(i18n("Space \"%s\" successfully added."), $space->getNombre()));

                    $this->view->redirect("space", "show");
                } else {
                    $errors = array();
	                $errors["general"] = i18n("Space already exists");
	                $this->view->setVariable("errors", $errors);
                }
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->setVariable("space", $space);
        $this->view->render("space", "SPACE_ADD_Vista");
    }

    public function edit() {
        $this->checkPerms("space", "edit", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A space id is mandatory"));
        }

        $spaceid = $_REQUEST["id"];
        $space = $this->spaceMapper->fetch($spaceid);

        if ($space == NULL) {
            throw new Exception(i18n("No such space with id: ").$spaceid);
        }

        if (isset($_POST["submit"])) {
            $space->setNombre($_POST["nombre"]);

            try {
                if (!$this->spaceMapper->nameExists($_POST["nombre"])){
                $space->checkIsValidForCreate();
                $this->spaceMapper->update($space);
                $this->view->setFlash(sprintf(i18n("Space \"%s\" successfully updated."), $space->getNombre()));
                $this->view->redirect("space", "show");
                } else {
                    $errors = array();
	                $errors["general"] = i18n("Space already exists");
	                $this->view->setVariable("errors", $errors);
                }
            } catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->setVariable("space", $space);
        $this->view->render("space", "SPACE_EDIT_Vista");
    }

    public function delete() {
        $this->checkPerms("space", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $spaceid = $_REQUEST["id"];
        $space = $this->spaceMapper->fetch($spaceid);

        if ($space == NULL) {
            throw new Exception(i18n("No such space with id: ").$spaceid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->spaceMapper->delete($space);
                $this->view->setFlash(sprintf(i18n("Space \"%s\" successfully deleted."), $space->getNombre()));
            }
            $this->view->redirect("space", "show");
        }
        $this->view->setVariable("space", $space);
        $this->view->render("space", "SPACE_DELETE_Vista");
    }

    public function search()
    {
        $this->checkPerms("space", "show", $this->currentUserId);

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

            if (empty($query)) {
                $spaces = $this->spaceMapper->fetch_all();
            } else {
                $spaces = $this->spaceMapper->search($query);
            }
            $this->view->setVariable("spaces", $spaces);
            $this->view->render("space", "SPACE_SHOW_Vista");
        }
        else {

            $spaces = $this->spaceMapper->fetch_all();
            $this->view->setVariable("spaces", $spaces);
            $this->view->render("space", "SPACE_SEARCH_Vista");
        }

      }
	public function filter(){

        $this->checkPerms("space", "show", $this->currentUserId);

        if (isset($_POST["submit"])) {
            $query = "";
            $flag = 0;

            if ($_POST["dia"]){
                $query .= "dia= '". $_POST["dia"] . " ' ";
                $flag = 1;
            }

			if ($_POST["hora_inicio"]){
				if ($flag){
                    $query .= " AND ";
                }
                $query .= "hora_inicio= '". $_POST["hora_inicio"] . " ' ";
                $flag = 1;
            }

			if ($_POST["hora_fin"]){
				if ($flag){
                    $query .= " AND ";
                }
                $query .= "hora_fin= '". $_POST["hora_fin"] . " ' ";
                $flag = 1;
            }

            if (empty($query)) {
                $spaces = '';
            } else {
                $spaces = $this->spaceMapper->filter($query);
            }
            $this->view->setVariable("spaces", $spaces);
            $this->view->render("space", "SPACE_SHOW_Vista");
        }
        else {

            $this->view->render("space", "SPACE_FILTER_Vista");
        }
    }

}
