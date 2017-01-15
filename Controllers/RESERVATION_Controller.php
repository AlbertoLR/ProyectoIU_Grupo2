<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Reservation.php");
require_once(__DIR__."/../Models/RESERVATION_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class RESERVATION_Controller extends BaseController {

    private $reservationMapper;

    public function __construct() {
        parent::__construct();
        $this->reservationMapper = new RESERVATION_Model();
        $this->view->setLayout("default");
    }

//consulta//

    public function show(){
        $this->checkPerms("reservation", "show", $this->currentUserId);

        $reservations = $this->reservationMapper->fetch_all();
		
		
        $this->view->setVariable("reservations", $reservations);
        $this->view->render("reservation", "RESERVATION_SHOW_Vista");
    }

//ver detalle//

    public function showone(){
        $this->checkPerms("reservation", "showone", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An reservation id is mandatory"));
        }

        $reservationid = $_REQUEST["id"];
        $reservation = $this->reservationMapper->fetch($reservationid);
	    $session = $this->reservationMapper->fetchSession();
        $space = $this->reservationMapper->fetchSpace();
	    $client = $this->reservationMapper->fetchClient();

        if ($reservation == NULL) {
            throw new Exception(i18n("No such reservation with id: ").$reservationid);
        }
        $this->view->setVariable("reservation", $reservation);
		$this->view->setVariable("id", $reservationid);
	    $this->view->setVariable("client", $client);
	    $this->view->setVariable("session", $session);
        $this->view->setVariable("space", $space);
        $this->view->render("reservation", "RESERVATION_SHOWONE_Vista");
    }

//alta//

    public function add(){
        $this->checkPerms("reservation", "add", $this->currentUserId);

        $reservation = new Reservation();
        $spaces = $this->reservationMapper->fetchSpace();
	    $sessions = $this->reservationMapper->fetchSession();
	    $clients = $this->reservationMapper->fetchClient();

        if (isset($_POST["submit"])) {

	
            $reservation->setSessionId($_POST["id_sesion"]);
            $reservation->setClientId($_POST["dni_c"]);
            $reservation->setSpaceid($_POST["id_espacio"]);
			$reservation->setDay($_POST["day"]);
            $reservation->setSpacePrice($_POST["precio_espacio"]);
            $reservation->setPhysioPrice($_POST["precio_fisio"]);
//Comprobamos que se incluya un cliente//			
			try{
				if ($_POST["dni_c"]== NULL){
					$errors = array();
	                $errors["general"] = i18n("Reservation needs a client");
	                $this->view->setVariable("errors", $errors);
					printf($errors["general"]);
				}else{
			
//Comprobamos que no haya una reserva de un espacio el mismo día//		
            try {
                if (!$this->reservationMapper->reservationExists($_POST["id_espacio"],$_POST["day"])){
                   $reservation->checkIsValidForCreate();
                   $this->reservationMapper->insert($reservation);
			
				$this->view->setFlash(sprintf(i18n("Reservation \"%s\" successfully added."), $reservation->getClientId()));
				$this->view->redirect("reservation", "show");
                } else {
                    $errors = array();
	                $errors["general"] = i18n("Reservation already exists");
	                $this->view->setVariable("errors", $errors);
					printf($errors["general"]);
                }

            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
			}}catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        $this->view->setVariable("clients", $clients);
        $this->view->setVariable("spaces", $spaces);
	    $this->view->setVariable("sessions", $sessions);
        $this->view->render("reservation", "RESERVATION_ADD_Vista");
		
    }

//modificacion//

    public function edit() {
        $this->checkPerms("reservation", "edit", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An reservation id is mandatory"));
        }

        $reservationid = $_REQUEST["id"];
        $reservation = $this->reservationMapper->fetch($reservationid);
		$clients = $this->reservationMapper->fetchClient();
	    $sessions = $this->reservationMapper->fetchSession();
        $spaces = $this->reservationMapper->fetchSpace();
	    
        


        if ($reservation == NULL) {
            throw new Exception(i18n("No such reservation with id: ").$reservationid);
        }

        if (isset($_POST["submit"])) {
			
			$reservation->setID($_POST["id"]);
			$reservation->setClientId($_POST["dni_c"]);
            $reservation->setSessionId($_POST["id_sesion"]);
            $reservation->setSpaceid($_POST["id_espacio"]);
			$reservation->setDay($_POST["day"]);
            $reservation->setSpacePrice($_POST["precio_espacio"]);
            $reservation->setPhysioPrice($_POST["precio_fisio"]);

//Comprobamos que se incluya un cliente//			
			try{
				if ($_POST["dni_c"]== NULL){
					$errors = array();
	                $errors["general"] = i18n("Reservation needs a client");
	                $this->view->setVariable("errors", $errors);
				}else{
//Comprobamos que no haya una reserva de un espacio el mismo día//		
            try {
                if (!$this->reservationMapper->reservationExistsUpdate($_POST["id_espacio"],$_POST["day"],$_POST["id"])){
                   $reservation->checkIsValidForCreate();
                   $this->reservationMapper->update($reservation);
			
					$this->view->setFlash(sprintf(i18n("Reservation \"%s\" successfully updated."), $reservation->getID()));
					$this->view->redirect("reservation", "show");
                } else {
                    $errors = array();
	                $errors["general"] = i18n("Reservation already exists");
	                $this->view->setVariable("errors", $errors);
					
                }

            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
			}}catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
		
		
		$this->view->setVariable("reservation", $reservation);
		$this->view->setVariable("id", $reservationid);
        $this->view->setVariable("clients", $clients);
        $this->view->setVariable("spaces", $spaces);
	    $this->view->setVariable("sessions", $sessions);
        $this->view->render("reservation", "RESERVATION_EDIT_Vista");
    }

//Baja//

    public function delete() {
        $this->checkPerms("reservation", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $reservationid = $_REQUEST["id"];
        $reservation = $this->reservationMapper->fetch($reservationid);
        $clients = $this->reservationMapper->fetchClient();
		$sessions = $this->reservationMapper->fetchSession();
        $spaces = $this->reservationMapper->fetchSpace();
	    
        


        if ($reservation == NULL) {
            throw new Exception(i18n("No such reservation with id: ").$reservationid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->reservationMapper->delete($reservation);
                $this->view->setFlash(sprintf(i18n("Reservation \"%s\" successfully deleted."), $reservation->getID()));
            }
            $this->view->redirect("reservation", "show");
        }
		$this->view->setVariable("reservation", $reservation);
        $this->view->setVariable("clients", $clients);
        $this->view->setVariable("spaces", $spaces);
	    $this->view->setVariable("sessions", $sessions);
        $this->view->render("reservation", "RESERVATION_DELETE_Vista");
    }

}
