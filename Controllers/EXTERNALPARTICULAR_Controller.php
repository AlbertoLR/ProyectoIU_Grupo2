<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/ExternalParticular.php");
require_once(__DIR__."/../Models/EXTERNALPARTICULAR_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class EXTERNALPARTICULAR_Controller extends BaseController {

    private $externalpartticularMapper;

    public function __construct() {
        parent::__construct();
        $this->externalparticularMapper = new EXTERNALPARTICULAR_Model();
        $this->view->setLayout("default");
    }

    public function show(){//mostramos particulares
        $this->checkPerms("externalparticular", "show", $this->currentUserId);

        $externalparticulars = $this->externalparticularMapper->fetch_all();
        $this->view->setVariable("externalparticulars", $externalparticulars);
        $this->view->render("externalparticular", "EXTERNALPARTICULAR_SHOW_Vista");
    }

    public function showone(){//mostrames detalle
        $this->checkPerms("externalparticular", "showone", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An external particular id is mandatory"));
        }

        $externalparticularid = $_REQUEST["id"];
        $externalparticular = $this->externalparticularMapper->fetch($externalparticularid);

        if ($externalparticular == NULL) {
            throw new Exception(i18n("No such external particular with id: ").$externalparticularid);
        }

        $this->view->setVariable("externalparticular", $externalparticular);
        $this->view->render("externalparticular", "EXTERNALPARTICULAR_SHOWONE_Vista");
    }

    public function add(){//añadimos particular
        $this->checkPerms("externalparticular", "add", $this->currentUserId);

        $externalparticular = new ExternalParticular();

        if (isset($_POST["submit"])) {
          $externalparticular->setNombre($_POST["name"]);
          $externalparticular->setApellidos($_POST["surname"]);
		  $externalparticular->setTelefono($_POST["telephone"]);


          $this->externalparticularMapper->insert($externalparticular);
          $this->view->setFlash(sprintf(i18n("External particular \"%s\" successfully added."),$externalparticular->getNombre()));
          $this->view->redirect("externalparticular", "show");
               
        }

        $this->view->setVariable("externalparticular", $externalparticular);
        $this->view->render("externalparticular", "EXTERNALPARTICULAR_ADD_Vista");
    }

    public function edit() {//modificamos particular
        $this->checkPerms("externalparticular", "edit", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An external particular id is mandatory"));
        }

        $externalparticularid = $_REQUEST["id"];

        $externalparticular = $this->externalparticularMapper->fetch($externalparticularid);

        if ($externalparticular == NULL) {
            throw new Exception(i18n("No such external particular  with id: ").$externalparticularid);
        }

        if (isset($_POST["submit"])) {
          $externalparticular->setNombre($_POST["name"]);
          $externalparticular->setApellidos($_POST["surname"]);
		  $externalparticular->setTelefono($_POST["telephone"]);

          $this->externalparticularMapper->update($externalparticular);
          $this->view->setFlash(sprintf(i18n("External particular \"%s\" successfully updated."),$externalparticular->getNombre()));
          $this->view->redirect("externalparticular", "show");
        }
        $this->view->setVariable("externalparticular", $externalparticular);
        $this->view->render("externalparticular", "EXTERNALPARTICULAR_EDIT_Vista");
    }

    public function delete() {//eliminamos particular
        $this->checkPerms("externalparticular", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $externalparticularid = $_REQUEST["id"];
        $externalparticular = $this->externalparticularMapper->fetch($externalparticularid);

        if ($externalparticular == NULL) {
            throw new Exception(i18n("No such external particular with id: ").$externalparticularid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->externalparticularMapper->delete($externalparticular);
                $this->view->setFlash(sprintf(i18n("External particular \"%s\" successfully deleted."),$externalparticular->getNombre()));
            }
            $this->view->redirect("externalparticular", "show");
        }
        $this->view->setVariable("externalparticular", $externalparticular);
        $this->view->render("externalparticular", "EXTERNALPARTICULAR_DELETE_Vista");
    }
}