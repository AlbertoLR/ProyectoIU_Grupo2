<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Physiotherapist.php");
require_once(__DIR__."/../Models/PHYSIOTHERAPIST_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class PHYSIOTHERAPIST_Controller extends BaseController {

    private $physiotherapistMapper;

    public function __construct() {
        parent::__construct();
        $this->physiotherapistMapper = new PHYSIOTHERAPIST_Model();
        $this->view->setLayout("default");
    }

    public function show(){
        $this->checkPerms("physiotherapist", "show", $this->currentUserId);

        $physiotherapists = $this->physiotherapistMapper->fetch_all();
        $hours = $this->physiotherapistMapper->fetchHours();
        $this->view->setVariable("hours", $hours);
        $this->view->setVariable("physiotherapists", $physiotherapists);
        $this->view->render("physiotherapist", "PHYSIOTHERAPIST_SHOW_Vista");
    }

    public function showone(){
        $this->checkPerms("physiotherapist", "showone", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An physiotherapist session id is mandatory"));
        }

        $physiotherapistid = $_REQUEST["id"];
        $physiotherapist = $this->physiotherapistMapper->fetch($physiotherapistid);
        $clients = $this->physiotherapistMapper->fetchClients();
        $hours = $this->physiotherapistMapper->fetchHours();

        if ($physiotherapist == NULL) {
            throw new Exception(i18n("No such physiotherapist session with id: ").$physiotherapistid);
        }
        $this->view->setVariable("clients", $clients);
        $this->view->setVariable("hours", $hours);
        $this->view->setVariable("physiotherapist", $physiotherapist);
        $this->view->render("physiotherapist", "PHYSIOTHERAPIST_SHOWONE_Vista");
    }

    public function add(){
        $this->checkPerms("physiotherapist", "add", $this->currentUserId);

        $physiotherapist = new Physiotherapist();
        $clients = $this->physiotherapistMapper->fetchClients();
		$hours = $this->physiotherapistMapper->fetchHours();

        if (isset($_POST["submit"])) {
			if(isset($_POST["time"])&&$_POST["time"]<>"not_valid"){
					$toret=$this->physiotherapistMapper->rightDayTimeAdd($_POST["day"],$_POST["time"]);
					switch($toret){
						case 1:
							$errors = array();
							$errors["general"] = i18n("Day before today");
							$this->view->setFlash(sprintf(i18n("Invalid selected date.")));
							$this->view->setVariable("errors", $errors);
							break;
						case 2:
							$errors = array();
							$errors["general"] = i18n("Start time before now");
							$this->view->setFlash(sprintf(i18n("Invalid selected time.")));
							$this->view->setVariable("errors", $errors);
							break;
						case 3:
							$physiotherapist->setDay($_POST["day"]);
							$physiotherapist->setIDHour($_POST["time"]);
							$physiotherapist->setPrice($_POST["price"]);
							$physiotherapist->setIDCliente($_POST["client"]);
							if(isset($_REQUEST["attendance"])){
							 $physiotherapist->setAttendance(1);
							}
							else $physiotherapist->setAttendance(0);
							$this->physiotherapistMapper->insert($physiotherapist);
							$this->view->setFlash(sprintf(i18n("Physiotherapist Session successfully added.")));
							$this->view->redirect("physiotherapist", "show");
							break;
					}
			}else{
			$this->view->setFlash(sprintf(i18n("Invalid selected time.")));
			}
		}
        $this->view->setVariable("clients", $clients);
		$this->view->setVariable("hours", $hours);
        $this->view->setVariable("physiotherapist", $physiotherapist);
        $this->view->render("physiotherapist", "PHYSIOTHERAPIST_ADD_Vista");
    }


    public function edit() {
        $this->checkPerms("physiotherapist", "edit", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An physiotherapist session id is mandatory"));
        }

        $physiotherapistid = $_REQUEST["id"];
        $physiotherapist = $this->physiotherapistMapper->fetch($physiotherapistid);
        $clients = $this->physiotherapistMapper->fetchClients();
        $hours = $this->physiotherapistMapper->fetchHours();

        if ($physiotherapist == NULL) {
            throw new Exception(i18n("No such physiotherapist session with id: ").$physiotherapistid);
        }

        if (isset($_POST["submit"])) {
			if(isset($_POST["time"])&&$_POST["time"]<>"not_valid"){
					$toret=$this->physiotherapistMapper->rightDayTime($_POST["day"],$_POST["time"],$physiotherapistid);
					switch($toret){
						case 1:
							$errors = array();
							$errors["general"] = i18n("Day before today");
							$this->view->setFlash(sprintf(i18n("Invalid selected date.")));
							$this->view->setVariable("errors", $errors);
							break;
						case 2:
							$errors = array();
							$errors["general"] = i18n("Start time before now");
							$this->view->setFlash(sprintf(i18n("Invalid selected time.")));
							$this->view->setVariable("errors", $errors);
							break;
						case 3:
							$physiotherapist->setDay($_POST["day"]);
							$physiotherapist->setIDHour($_POST["time"]);
							$physiotherapist->setPrice($_POST["price"]);
							$physiotherapist->setIDCliente($_POST["client"]);
							if(isset($_REQUEST["attendance"])){
							 $physiotherapist->setAttendance(1);
							}
							else $physiotherapist->setAttendance(0);
							$this->physiotherapistMapper->update($physiotherapist);
							$this->view->setFlash(sprintf(i18n("Physiotherapist Session successfully updated.")));
							$this->view->redirect("physiotherapist", "show");
							break;
					}
			}else{
			$this->view->setFlash(sprintf(i18n("Invalid selected time.")));
			}
		}
        
        $this->view->setVariable("clients", $clients);
        $this->view->setVariable("hours", $hours);
        $this->view->setVariable("physiotherapist", $physiotherapist);
        $this->view->render("physiotherapist", "PHYSIOTHERAPIST_EDIT_Vista");
    }

    public function delete() {
        $this->checkPerms("physiotherapist", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $physiotherapistid = $_REQUEST["id"];
        $physiotherapist = $this->physiotherapistMapper->fetch($physiotherapistid);
        $clients = $this->physiotherapistMapper->fetchClients();
        $hours = $this->physiotherapistMapper->fetchHours();

        if ($physiotherapist == NULL) {
            throw new Exception(i18n("No such physiotherapist session with id: ").$physiotherapistid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->physiotherapistMapper->delete($physiotherapist);
                $this->view->setFlash(sprintf(i18n("Physiotherapist session successfully deleted.")));
            }
            $this->view->redirect("physiotherapist", "show");
        }
        $this->view->setVariable("clients", $clients);
        $this->view->setVariable("hours", $hours);
        $this->view->setVariable("physiotherapist", $physiotherapist);
        $this->view->render("physiotherapist", "PHYSIOTHERAPIST_DELETE_Vista");
    }
	public function search() {
        $this->checkPerms("physiotherapist", "show", $this->currentUserId);
        if (isset($_POST["submit"])) {
            $query = "";
            $flag = 0;
            if ($_POST["day1"]){                
                $query .= "dia_f='". $_POST["day1"] ."'";
                $flag = 1;
            }
            if ($_POST["time"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "id_hora='". $_POST["time"] ."'";
                $flag = 1;
            }
            if (isset($_POST["attendance"])&&$_POST["attendance"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "asistencia='1'";
                $flag = 1;
            }else{
				if ($flag){
                    $query .= " AND ";
                }
                $query .= "asistencia='0'";
                $flag = 1;
			}
            if ($_POST["price"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "precio_fisio='". $_POST["price"] ."'";
                $flag = 1;
            }
            if ($_POST["client"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "dni_c='". $_POST["client"] ."'";
            }
            if (empty($query)) {
                $physiotherapists = $this->physiotherapistMapper->fetch_all();
            } else {
                $physiotherapists = $this->physiotherapistMapper->search($query);
            }
			$hours = $this->physiotherapistMapper->fetchHours();
			$clients = $this->physiotherapistMapper->fetchClients();
			$this->view->setVariable("clients", $clients);
			$this->view->setVariable("hours", $hours);
            $this->view->setVariable("physiotherapists", $physiotherapists);
            $this->view->render("physiotherapist", "PHYSIOTHERAPIST_SHOW_Vista");
        }
        else {
			$physiotherapists = $this->physiotherapistMapper->fetch_all();
			$hours = $this->physiotherapistMapper->fetchHours();
			$clients = $this->physiotherapistMapper->fetchClients();
			$this->view->setVariable("clients", $clients);
			$this->view->setVariable("hours", $hours);
			$this->view->setVariable("physiotherapists", $physiotherapists);
			$this->view->render("physiotherapist", "PHYSIOTHERAPIST_SEARCH_Vista");
        }
    }

}
