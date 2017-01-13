<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Injury.php");
require_once(__DIR__."/../Models/INJURY_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class INJURY_Controller extends BaseController {

    private $injuryMapper;

    public function __construct() {
        parent::__construct();
        $this->injuryMapper = new INJURY_Model();
        $this->view->setLayout("default");
    }

    public function show(){
        $this->checkPerms("injury", "show", $this->currentUserId);

        $injuries = $this->injuryMapper->fetch_all();
        $this->view->setVariable("injuries", $injuries);
        $this->view->render("injury", "INJURY_SHOW_Vista");
    }

    public function showone(){
        $this->checkPerms("injury", "showone", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A injury id is mandatory"));
        }

        $injuryid = $_REQUEST["id"];
        $injury = $this->injuryMapper->fetch($injuryid);

        if ($injury == NULL) {
            throw new Exception(i18n("No such injury with id: ").$injuryid);
        }

        $this->view->setVariable("injury", $injury);
        $this->view->render("injury", "INJURY_SHOWONE_Vista");
    }

    public function add(){
        $this->checkPerms("injury", "add", $this->currentUserId);

        $injury = new Injury();

        if (isset($_POST["submit"])) {
            $injury->setInjuryDescription($_POST["injurydescription"]);

            try {
                if (!$this->injuryMapper->nameExists($_POST["injurydescription"])){
                    $injury->checkIsValidForCreate();
                    $this->injuryMapper->insert($injury);

                    $this->view->setFlash(sprintf(i18n("Injury \"%s\" successfully added."), $injury->getInjuryDescription()));

                    $this->view->redirect("injury", "show");
                } else {
                    $errors = array();
	                $errors["general"] = i18n("Injury already exists");
	                $this->view->setVariable("errors", $errors);
                }
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->setVariable("injury", $injury);
        $this->view->render("injury", "INJURY_ADD_Vista");
    }

    public function edit() {
        $this->checkPerms("injury", "edit", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A injury id is mandatory"));
        }

        $injuryid = $_REQUEST["id"];
        $injury = $this->injuryMapper->fetch($injuryid);

        if ($injury == NULL) {
            throw new Exception(i18n("No such injury with id: ").$actionid);
        }

        if (isset($_POST["submit"])) {
            $injury->setInjuryDescription($_POST["injurydescription"]);

            try {
                if (!$this->injuryMapper->nameExists($_POST["injurydescription"])){
                $injury->checkIsValidForCreate();
                $this->injuryMapper->update($injury);
                $this->view->setFlash(sprintf(i18n("Injury \"%s\" successfully updated."), $injury->getInjuryDescription()));
                $this->view->redirect("injury", "show");
                } else {
                    $errors = array();
	                $errors["general"] = i18n("Injury already exists");
	                $this->view->setVariable("errors", $errors);
                }
            } catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->setVariable("injury", $injury);
        $this->view->render("injury", "INJURY_EDIT_Vista");
    }
    public function search()
    {
        $this->checkPerms("injury", "show", $this->currentUserId);

        if (isset($_POST["submit"])) {
            $query = "";
            $flag = 0;

            if ($_POST["description"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "descripcion LIKE '%". $_POST["description"] ."%'";
                $flag = 1;
            }


            if (empty($query)) {
                $injuries = $this->injuryMapper->fetch_all();
            } else {
                $injuries = $this->injuryMapper->search($query);
            }
            $this->view->setVariable("injuries", $injuries);
            $this->view->render("injury", "INJURY_SHOW_Vista");
        }
        else {

            $injuries= $this->injuryMapper->fetch_all();
            $this->view->setVariable("injuries", $injuries);
            $this->view->render("injury", "INJURY_SEARCH_Vista");
        }

      }

    public function delete() {
        $this->checkPerms("injury", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $injuryid = $_REQUEST["id"];
        $injury = $this->injuryMapper->fetch($injuryid);

        if ($injury == NULL) {
            throw new Exception(i18n("No such injury with id: ").$injuryid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->injuryMapper->delete($injury);
                $this->view->setFlash(sprintf(i18n("Injury \"%s\" successfully deleted."), $injury->getInjuryDescription()));
            }
            $this->view->redirect("injury", "show");
        }
        $this->view->setVariable("injury", $injury);
        $this->view->render("injury", "INJURY_DELETE_Vista");
    }

    public function export() {
        $this->checkPerms("injury", "export", $this->currentUserId);
        $this->view->render("injury", "INJURY_EXPORT_Vista");
    }
}
