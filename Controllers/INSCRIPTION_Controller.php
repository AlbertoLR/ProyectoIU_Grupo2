<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Inscription.php");
require_once(__DIR__."/../Models/INSCRIPTION_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class INSCRIPTION_Controller extends BaseController {

    private $inscriptionMapper;

    public function __construct() {
        parent::__construct();
        $this->inscriptionMapper = new INSCRIPTION_Model();
        $this->view->setLayout("default");
    }

    public function show(){
        $this->checkPerms("inscription", "show", $this->currentUserId);

        $inscriptions = $this->inscriptionMapper->fetch_all();

        $events = $this->inscriptionMapper->fetch_events();
        $reserves = $this->inscriptionMapper->fetch_reserve();
        $activities = $this->inscriptionMapper->fetch_activities();

        $this->view->setVariable("inscriptions", $inscriptions);
        $this->view->setVariable("reserves",$reserves);
        $this->view->setVariable("events", $events);
        $this->view->setVariable("activities",$activities);

        $this->view->render("inscription", "INSCRIPTION_SHOW_Vista");
    }


    public function showone(){
        $this->checkPerms("inscription", "showone", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An inscription id is mandatory"));
        }

        $IDinscription = $_REQUEST["id"];
        $inscription = $this->inscriptionMapper->fetch($IDinscription);
        $particular = $this->inscriptionMapper->fetch_particular();
        $events = $this->inscriptionMapper->fetch_events();
        $reserves = $this->inscriptionMapper->fetch_reserve();
        $clients = $this->inscriptionMapper->fetch_clients();
        $activities = $this->inscriptionMapper->fetch_activities();

        if ($inscription == NULL) {
            throw new Exception(i18n("No such inscription with id: ").$IDinscription);
        }

        $this->view->setVariable("events", $events);
        $this->view->setVariable("inscription", $inscription);
        $this->view->setVariable("reserves",$reserves);
        $this->view->setVariable("clients",$clients);
        $this->view->setVariable("particular",$particular);
        $this->view->setVariable("activities",$activities);

        $this->view->render("inscription", "INSCRIPTION_SHOWONE_Vista");
    }

    public function add(){
        $this->checkPerms("inscription", "add", $this->currentUserId);

        $inscription = new Inscription();
        $particular = $this->inscriptionMapper->fetch_particular();
        $events = $this->inscriptionMapper->fetch_events();
        $reserves = $this->inscriptionMapper->fetch_reserve();
        $clients = $this->inscriptionMapper->fetch_clients();
        $activities = $this->inscriptionMapper->fetch_activities();


        if (isset($_POST["submit"])) {

            $inscription->setFecha($_POST["fecha"]);
            $inscription->setID_Particular_Externo($_POST["id_particular_externo"]);
            $inscription->setID_Evento($_POST["id_evento"]);
            $inscription->setID_Reserva($_POST["id_reserva"]);
            $inscription->setDNI_Cliente($_POST["dni_cliente"]);
            $inscription->setID_Actividad($_POST["id_actividad"]);

            print_r($inscription);
                        try {

                                $this->inscriptionMapper->insert($inscription);
                                $this->view->setFlash(sprintf(i18n("Inscription \"%s\" successfully added."), $inscription->getIDInscripcion()));
                                $this->view->redirect("inscription", "show");


                        }catch(ValidationException $ex) {
                            $errors = $ex->getErrors();
                            $this->view->setVariable("errors", $errors);
                        }
                    }


            $this->view->setVariable("activities", $activities);
            $this->view->setVariable("clients", $clients);
            $this->view->setVariable("reserves", $reserves);
            $this->view->setVariable("events", $events);
            $this->view->setVariable("particular", $particular);
            $this->view->setVariable("inscription", $inscription);
            $this->view->render("inscription", "INSCRIPTION_ADD_Vista");
        }


    public function edit() {
        $this->checkPerms("inscription", "edit", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An inscription id is mandatory"));
        }

        $IDinscription = $_REQUEST["id"];
        $inscription = $this->inscriptionMapper->fetch($IDinscription);
        $particular = $this->inscriptionMapper->fetch_particular();
        $events = $this->inscriptionMapper->fetch_events();
        $reserves = $this->inscriptionMapper->fetch_reserve();
        $clients = $this->inscriptionMapper->fetch_clients();
        $activities = $this->inscriptionMapper->fetch_activities();

        if ($inscription == NULL) {
            throw new Exception(i18n("No such inscription with id: ").$inscription);
        }

        if (isset($_POST["submit"])) {

            $inscription->setFecha($_POST["fecha"]);
            $inscription->setID_Particular_Externo($_POST["id_particular_externo"]);
            $inscription->setID_Evento($_POST["id_evento"]);
            $inscription->setID_Reserva($_POST["id_reserva"]);
            $inscription->setDNI_Cliente($_POST["dni_cliente"]);
            $inscription->setID_Actividad($_POST["id_actividad"]);


            try {
                    $this->inscriptionMapper->update($inscription);
                    $this->view->setFlash(sprintf(i18n("Inscription \"%s\" successfully updated."), $inscription->getIDInscripcion()));
                    $this->view->redirect("inscription", "show");

            } catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->setVariable("activities", $activities);
        $this->view->setVariable("clients", $clients);
        $this->view->setVariable("reserves", $reserves);
        $this->view->setVariable("events", $events);
        $this->view->setVariable("particular", $particular);
        $this->view->setVariable("inscription", $inscription);
        $this->view->render("inscription", "INSCRIPTION_EDIT_Vista");
    }

    public function delete() {
        $this->checkPerms("inscription", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $IDinscription = $_REQUEST["id"];
        $inscription = $this->inscriptionMapper->fetch($IDinscription);
        $particular = $this->inscriptionMapper->fetch_particular();
        $events = $this->inscriptionMapper->fetch_events();
        $reserves = $this->inscriptionMapper->fetch_reserve();
        $clients = $this->inscriptionMapper->fetch_clients();
        $activities = $this->inscriptionMapper->fetch_activities();

        if ($inscription == NULL) {
            throw new Exception(i18n("No such inscription with id: ").$IDinscription);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->inscriptionMapper->delete($inscription);
                $this->view->setFlash(sprintf(i18n("Inscription \"%s\" successfully deleted."), $inscription->getIDInscripcion()));
            }
            $this->view->redirect("inscription", "show");
        }
        $this->view->setVariable("activities", $activities);
        $this->view->setVariable("clients", $clients);
        $this->view->setVariable("reserves", $reserves);
        $this->view->setVariable("events", $events);
        $this->view->setVariable("particular", $particular);
        $this->view->setVariable("inscription", $inscription);
        $this->view->render("inscription", "INSCRIPTION_DELETE_Vista");
    }

}
