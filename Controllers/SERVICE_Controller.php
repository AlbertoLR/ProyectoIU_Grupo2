<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Service.php");
require_once(__DIR__."/../Models/SERVICE_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class SERVICE_Controller extends BaseController {

    private $serviceMapper;

    public function __construct() {
        parent::__construct();
        $this->serviceMapper = new SERVICE_Model();
        $this->view->setLayout("default");
    }

    public function show(){
        $this->checkPerms("service", "show", $this->currentUserId);

        $services = $this->serviceMapper->fetch_all();
        $pagos = $this->serviceMapper->fetch_Pago();

        $this->view->setVariable("pagos", $pagos);
        $this->view->setVariable("services", $services);
        $this->view->render("service", "SERVICE_SHOW_Vista");
    }

    public function showone(){
        $this->checkPerms("service", "showone", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A service id is mandatory"));
        }

        $IDService = $_REQUEST["id"];
        $service = $this->serviceMapper->fetch($IDService);
        $clienteEx = $this->serviceMapper->fetch_Cliente_Externo();
        $pagos = $this->serviceMapper->fetch_Pago();

        if ($service == NULL) {
            throw new Exception(i18n("No such service with id: ").$IDService);
        }

        $this->view->setVariable("clienteEx", $clienteEx);
        $this->view->setVariable("service", $service);
        $this->view->setVariable("pagos", $pagos);
        $this->view->render("service", "SERVICE_SHOWONE_Vista");
    }


    public function add(){
        $this->checkPerms("service", "add", $this->currentUserId);

        $service = new Service();
        $clienteEx = $this->serviceMapper->fetch_Cliente_Externo();


        if (isset($_POST["submit"])) {
            $service->setDescripcion($_POST["descripcion"]);
            $service->setFecha($_POST["fecha"]);
            $service->setCoste($_POST["coste"]);
            $service->setIDCliente($_POST["external"]);

            $metodo = $_POST["metodo"];
            $frecuencia = $_POST["frecuencia"] ;

            if($_POST["recibido"] == "Yes"){
                $recibido = TRUE;
            }else{
                $recibido = FALSE;
            }


            try {

                    $this->serviceMapper->insert($service,$metodo,$frecuencia,$recibido);
                    $this->view->setFlash(sprintf(i18n("Service successfully added.")));
                    $this->view->redirect("service", "show");


            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->setVariable("clienteEx", $clienteEx);
        $this->view->setVariable("service", $service);
        $this->view->render("service", "SERVICE_ADD_Vista");
    }


    public function edit() {
        $this->checkPerms("service", "edit", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A service id is mandatory"));
        }

        $IDService = $_REQUEST["id"];
        $service = $this->serviceMapper->fetch($IDService);
        $clienteEx = $this->serviceMapper->fetch_Cliente_Externo();
        $pagos = $this->serviceMapper->fetch_Pago();

        if ($service == NULL) {
            throw new Exception(i18n("No such service with id: ").$IDService);
        }

        if (isset($_POST["submit"])) {
            $service->setDescripcion($_POST["descripcion"]);
            $service->setFecha($_POST["fecha"]);
            $service->setCoste($_POST["coste"]);
            $service->setIDCliente($_POST["external"]);

            $metodo = $_POST["metodo"];
            $frecuencia = $_POST["frecuencia"] ;

            if($_POST["recibido"] == "Yes"){
                $recibido = TRUE;
            }else{
                $recibido = FALSE;
            }

            try {
                    $this->serviceMapper->update($service, $metodo, $frecuencia, $recibido);
                    $this->view->setFlash(sprintf(i18n("Service successfully updated.")));
                    $this->view->redirect("service", "show");

            } catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->setVariable("clienteEx", $clienteEx);
        $this->view->setVariable("service", $service);
        $this->view->setVariable("pagos", $pagos);
        $this->view->render("service", "SERVICE_EDIT_Vista");
    }

    public function delete() {
        $this->checkPerms("service", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $IDService = $_REQUEST["id"];
        $service = $this->serviceMapper->fetch($IDService);
        $clienteEx = $this->serviceMapper->fetch_Cliente_Externo();
        $pagos = $this->serviceMapper->fetch_Pago();

        if ($service == NULL) {
            throw new Exception(i18n("No such service with id: ").$IDService);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->serviceMapper->delete($service);
                $this->view->setFlash(sprintf(i18n("Service successfully deleted.")));
            }
            $this->view->redirect("service", "show");
        }

        $this->view->setVariable("clienteEx", $clienteEx);
        $this->view->setVariable("service", $service);
        $this->view->setVariable("pagos", $pagos);
        $this->view->render("service", "SERVICE_DELETE_Vista");
    }

}