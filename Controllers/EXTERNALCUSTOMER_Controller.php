<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/ExternalCustomer.php");
require_once(__DIR__."/../Models/EXTERNALCUSTOMER_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class EXTERNALCUSTOMER_Controller extends BaseController {

    private $externalcustomerMapper;

    public function __construct() {
        parent::__construct();
        $this->externalcustomerMapper = new EXTERNALCUSTOMER_Model();
        $this->view->setLayout("default");
    }

    public function show(){//lista clientes externos
        $this->checkPerms("externalcustomer", "show", $this->currentUserId);

        $externalcustomers = $this->externalcustomerMapper->fetch_all();
        $this->view->setVariable("externalcustomers", $externalcustomers);
        $this->view->render("externalcustomer", "EXTERNALCUSTOMER_SHOW_Vista");
    }

    public function showone(){//muestra detalle
        $this->checkPerms("externalcustomer", "showone", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An external customer id is mandatory"));
        }

        $externalcustomerid = $_REQUEST["id"];
        $externalcustomer = $this->externalcustomerMapper->fetch($externalcustomerid);

        if ($externalcustomer == NULL) {
            throw new Exception(i18n("No such external customer with id: ").$externalcustomerid);
        }

        $this->view->setVariable("externalcustomer", $externalcustomer);
        $this->view->render("externalcustomer", "EXTERNALCUSTOMER_SHOWONE_Vista");
    }

    public function add(){//añade cliente externo
        $this->checkPerms("externalcustomer", "add", $this->currentUserId);

        $externalcustomer = new ExternalCustomer();

        if (isset($_POST["submit"])) {
          $externalcustomer->setDni_nif($_POST["dni"]);
          $externalcustomer->setNombre($_POST["name"]);
          $externalcustomer->setApellido($_POST["surname"]);
          $externalcustomer->setEmail($_POST["email"]);
		  $externalcustomer->setTelefono($_POST["telephone"]);

            try {//controlamos que no exista previamente
                if(!$this->externalcustomerMapper->dniExists($_POST["dni"]) && !empty($_POST["dni"])){
                        $externalcustomer->checkIsValidForCreate();
                        $this->externalcustomerMapper->insert($externalcustomer);
                        $this->view->setFlash(sprintf(i18n("External customer \"%s\" successfully added."),$externalcustomer->getNombre()));
                        $this->view->redirect("externalcustomer", "show");
                } else {
                    $errors = array();
                    $errors["general"] = i18n("DNI already exists or NULL");
                    $this->view->setVariable("errors", $errors);
                }
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->setVariable("externalcustomer", $externalcustomer);
        $this->view->render("externalcustomer", "EXTERNALCUSTOMER_ADD_Vista");
    }

    public function edit() {// modificamos cliente externo
        $this->checkPerms("externalcustomer", "edit", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An external customer id is mandatory"));
        }

        $externalcustomerid = $_REQUEST["id"];

        $externalcustomer = $this->externalcustomerMapper->fetch($externalcustomerid);

        if ($externalcustomer == NULL) {
            throw new Exception(i18n("No such external customer  with id: ").$externalcustomerid);
        }

        if (isset($_POST["submit"])) {
          $externalcustomer->setNombre($_POST["name"]);
          $externalcustomer->setApellido($_POST["surname"]);
          $externalcustomer->setEmail($_POST["email"]);
		  $externalcustomer->setTelefono($_POST["telephone"]);

            try {//controlamos datos repetidos
                if ($externalcustomer->getDni_nif() == $_POST["dni"]) {
                    $externalcustomer->checkIsValidForCreate();
                    $this->externalcustomerMapper->update($externalcustomer);
                    $this->view->setFlash(sprintf(i18n("External customer \"%s\" successfully updated."),$externalcustomer->getNombre()));
                    $this->view->redirect("externalcustomer", "show");
                } else if ($externalcustomer->getDni_nif() != $_POST["dni"]) {
                    if(!$this->externalcustomerMapper->dniExists($_POST["dni"]) && !empty($_POST["dni"])) {
                        $externalcustomer->setDni_nif($_POST["dni"]);
                        $externalcustomer->checkIsValidForCreate();
                        $this->externalcustomerMapper->update($externalcustomer);
                        $this->view->setFlash(sprintf(i18n("External customer \"%s\" successfully updated."),$externalcustomer->getNombre()));
                        $this->view->redirect("externalcustomer", "show");
                    } else {
                        $errors = array();
                        $errors["general"] = i18n("DNI already exists or NULL");
                        $this->view->setVariable("errors", $errors);
                    }
                } else if(!$this->externalcustomerMapper->dniExists($_POST["dni"]) && !empty($_POST["dni"])) {
                        $externalcustomer->setDni_nif($_POST["dni"]);
                        $externalcustomer->checkIsValidForCreate();
                        $externalcustomer->externalcustomerMapper->update($externalcustomer);
                        $externalcustomer->view->setFlash(sprintf(i18n("External customer \"%s\" successfully updated."),$externalcustomer->getNombre()));
                        $externalcustomer->view->redirect("externalcustomer", "show");
                } else{
                    $errors = array();
                    $errors["general"] = i18n("DNI already exists or NULL");
                    $this->view->setVariable("errors", $errors);
                }
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        $this->view->setVariable("externalcustomer", $externalcustomer);
        $this->view->render("externalcustomer", "EXTERNALCUSTOMER_EDIT_Vista");
    }

    public function delete() {//eliminamos cliente externo
        $this->checkPerms("externalcustomer", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $externalcustomerid = $_REQUEST["id"];
        $externalcustomer = $this->externalcustomerMapper->fetch($externalcustomerid);

        if ($externalcustomer == NULL) {
            throw new Exception(i18n("No such external customer with id: ").$externalcustomerid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->externalcustomerMapper->delete($externalcustomer);
                $this->view->setFlash(sprintf(i18n("External customer \"%s\" successfully deleted."),$externalcustomer->getNombre()));
            }
            $this->view->redirect("externalcustomer", "show");
        }
        $this->view->setVariable("externalcustomer", $externalcustomer);
        $this->view->render("externalcustomer", "EXTERNALCUSTOMER_DELETE_Vista");
    }
}