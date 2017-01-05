<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Physiotherapisthour.php");
require_once(__DIR__."/../Models/PHYSIOTHERAPISTHOUR_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class PHYSIOTHERAPISTHOUR_Controller extends BaseController {

    private $physiotherapisthourMapper;

    public function __construct() {
        parent::__construct();
        $this->physiotherapisthourMapper = new PHYSIOTHERAPISTHOUR_Model();
        $this->view->setLayout("default");
    }

    public function show(){
        $this->checkPerms("physiotherapisthour", "show", $this->currentUserId);

        $physiotherapisthours = $this->physiotherapisthourMapper->fetch_all();
        $this->view->setVariable("physiotherapisthours", $physiotherapisthours);
        $this->view->render("physiotherapisthour", "PHYSIOTHERAPISTHOUR_SHOW_Vista");
    }

    public function showone(){
        $this->checkPerms("physiotherapisthour", "showone", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An physiotherapist hour id is mandatory"));
        }

        $physiotherapisthourid = $_REQUEST["id"];
        $physiotherapisthour = $this->physiotherapisthourMapper->fetch($physiotherapisthourid);


        if ($physiotherapisthour == NULL) {
            throw new Exception(i18n("No such physiotherapist hour with id: ").$physiotherapistid);
        }
        $this->view->setVariable("physiotherapisthour", $physiotherapisthour);
        $this->view->render("physiotherapisthour", "PHYSIOTHERAPISTHOUR_SHOWONE_Vista");
    }

    public function add(){
        $this->checkPerms("physiotherapisthour", "add", $this->currentUserId);

        $physiotherapisthour = new Physiotherapisthour();

        if (isset($_POST["submit"])) {

            $physiotherapisthour->setDay($_POST["day"]);
            $physiotherapisthour->setStarttime($_POST["stime"]);
            $physiotherapisthour->setEndtime($_POST["etime"]);


            try {
				$toret=$this->physiotherapisthourMapper->rightDayTime($_POST["day"],$_POST["stime"],$_POST["etime"]);
				switch($toret){
					case 1:
						$errors = array();
						$errors["general"] = i18n("Start Time before open's hour");
						$this->view->setVariable("errors", $errors);
						break;
					case 2:
						$errors = array();
						$errors["general"] = i18n("End Time after close hour");
						$this->view->setVariable("errors", $errors);
						break;
					case 3:
						$errors = array();
						$errors["general"] = i18n("End Time before Start Time");
						$this->view->setVariable("errors", $errors);
						break;
					case 4:
						$this->physiotherapisthourMapper->insert($physiotherapisthour);
						$this->view->setFlash(sprintf(i18n("Physiotherapist hour successfully added.")));
						$this->view->redirect("physiotherapisthour", "show");
						break;
					case 5:
						$errors = array();
						$errors["general"] = i18n("Not open's that day");
						$this->view->setVariable("errors", $errors);
						break;
				}

            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        $this->view->setVariable("physiotherapisthour", $physiotherapisthour);
        $this->view->render("physiotherapisthour", "PHYSIOTHERAPISTHOUR_ADD_Vista");
    }


    public function edit() {
        $this->checkPerms("physiotherapisthour", "edit", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An physiotherapist hour id is mandatory"));
        }

        $physiotherapisthourid = $_REQUEST["id"];
        $physiotherapisthour = $this->physiotherapisthourMapper->fetch($physiotherapisthourid);


        if ($physiotherapisthour == NULL) {
            throw new Exception(i18n("No such physiotherapist hour with id: ").$physiotherapisthourid);
        }

        if (isset($_POST["submit"])) {
          $physiotherapisthour->setDay($_POST["day"]);
          $physiotherapisthour->setStarttime($_POST["stime"]);
          $physiotherapisthour->setEndtime($_POST["etime"]);

            try {
				$toret=$this->physiotherapisthourMapper->rightDayTime($_POST["day"],$_POST["stime"],$_POST["etime"]);
				switch($toret){
					case 1:
						$errors = array();
						$errors["general"] = i18n("Start Time before open's hour");
						$this->view->setVariable("errors", $errors);
						break;
					case 2:
						$errors = array();
						$errors["general"] = i18n("End Time after close hour");
						$this->view->setVariable("errors", $errors);
						break;
					case 3:
						$errors = array();
						$errors["general"] = i18n("End Time before Start Time");
						$this->view->setVariable("errors", $errors);
						break;
					case 4:
						$this->physiotherapisthourMapper->update($physiotherapisthour);
						$this->view->setFlash(sprintf(i18n("Physiotherapist hour successfully updated.")));
						$this->view->redirect("physiotherapisthour", "show");
						break;
					case 5:
						$errors = array();
						$errors["general"] = i18n("Not open's that day");
						$this->view->setVariable("errors", $errors);
						break;
				}
            } catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        $this->view->setVariable("physiotherapisthour", $physiotherapisthour);
        $this->view->render("physiotherapisthour", "PHYSIOTHERAPISTHOUR_EDIT_Vista");
    }

    public function delete() {
        $this->checkPerms("physiotherapisthour", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $physiotherapisthourid = $_REQUEST["id"];
        $physiotherapisthour = $this->physiotherapisthourMapper->fetch($physiotherapisthourid);

        if ($physiotherapisthour == NULL) {
            throw new Exception(i18n("No such physiotherapist hour with id: ").$physiotherapisthourid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->physiotherapisthourMapper->delete($physiotherapisthour);
                $this->view->setFlash(sprintf(i18n("Physiotherapist hour successfully deleted.")));
            }
            $this->view->redirect("physiotherapisthour", "show");
        }
        $this->view->setVariable("physiotherapisthour", $physiotherapisthour);
        $this->view->render("physiotherapisthour", "PHYSIOTHERAPISTHOUR_DELETE_Vista");
    }
	public function search() {
        $this->checkPerms("physiotherapisthour", "show", $this->currentUserId);
        if (isset($_POST["submit"])) {
            $query = "";
            $flag = 0;
            if ($_POST["day"]){
                $query .= "dia='". $_POST["day"] ."'";
                $flag = 1;
            }
            if ($_POST["stime"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "hora_i='". $_POST["stime"] ."'";
                $flag = 1;
            }
            if ($_POST["etime"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "hora_f='". $_POST["etime"] ."'";
            }
            if (empty($query)) {
                $physiotherapisthours = $this->physiotherapisthourMapper->fetch_all();
            } else {
                $physiotherapisthours = $this->physiotherapisthourMapper->search($query);
            }
            $this->view->setVariable("physiotherapisthours", $physiotherapisthours);
            $this->view->render("physiotherapisthour", "PHYSIOTHERAPISTHOUR_SHOW_Vista");
        }
        else {
			$physiotherapisthours = $this->physiotherapisthourMapper->fetch_all();
			$this->view->setVariable("physiotherapisthours", $physiotherapisthours);
			$this->view->render("physiotherapisthour", "PHYSIOTHERAPISTHOUR_SEARCH_Vista");
        }
    }

}
