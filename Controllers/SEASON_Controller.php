<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Season.php");
require_once(__DIR__."/../Models/SEASON_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class SEASON_Controller extends BaseController {

    private $seasonMapper;

    public function __construct() {
        parent::__construct();
        $this->seasonMapper = new SEASON_Model();
        $this->view->setLayout("default");
    }

    public function show(){
      //Se muestran las temporadas con todos sus atrbutos

        $this->checkPerms("season", "show", $this->currentUserId);

        $seasons = $this->seasonMapper->fetch_all();
        $this->view->setVariable("seasons", $seasons);
        $this->view->render("season", "SEASON_SHOW_Vista");
    }

    public function add(){
      //Se añade una temporada
        $this->checkPerms("season", "add", $this->currentUserId);

        $season = new Season();

        if (isset($_POST["submit"])) {

          //Comprobacción de entrada de fechas. Se comprueba qe la inicial sea menor que la final.
          $fecha_ini = strtotime(date($_POST["date_start"],time()));
          $fecha_fin = strtotime($_POST["date_end"]);
          if($fecha_ini > $fecha_fin){

            $this->view->setFlash(sprintf(i18n("Dates not valid.")));
            $this->view->redirect("season", "add");
          }

          $season->setdateStart($_POST["date_start"]);
          $season->setdateEnd($_POST["date_end"]);
          $season->setDescription($_POST["description"]);



            try {
              //Comprobación de que no existe el nombre e inserción
                if (!$this->seasonMapper->nameExists($_POST["description"])){
                    $season->checkIsValidForCreate();
                    $this->seasonMapper->insert($season);

                    $this->view->setFlash(sprintf(i18n("Season \"%s\" successfully added."), $season->getDescription()));

                    $this->view->redirect("season", "show");
                } else {
                    $errors = array();
	                $errors["general"] = i18n("Season already exists");
	                $this->view->setVariable("errors", $errors);
                }
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->setVariable("season", $season);
        $this->view->render("season", "SEASON_ADD_Vista");
    }

    public function edit() {
        $this->checkPerms("season", "edit", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A season id is mandatory"));
        }

        $seasonid = $_REQUEST["id"];
        $season = $this->seasonMapper->fetch($seasonid);

        if ($season == NULL) {
            throw new Exception(i18n("No such season with id: ").$actionid);
        }

        if (isset($_POST["submit"])) {

          $fecha_ini = strtotime(date($_POST["date_start"],time()));
          $fecha_fin = strtotime($_POST["date_end"]);
          if($fecha_ini > $fecha_fin){

            $this->view->setFlash(sprintf(i18n("Dates not valid.")));
            $this->view->redirect("season", "edit","id=".$_POST["id"]);
          }
            $season->setdateStart($_POST["date_start"]);
            $season->setdateEnd($_POST["date_end"]);
            $season->setDescription($_POST["description"]);

            try {
                if (!$this->seasonMapper->nameExistsUpdate($_POST["description"],$seasonid)){
                $season->checkIsValidForCreate();
                $this->seasonMapper->update($season);
                $this->view->setFlash(sprintf(i18n("Season \"%s\" successfully updated."), $season->getDescription()));
                $this->view->redirect("season", "show");
                } else {
                    $errors = array();
	                $errors["general"] = i18n("Season already exists");
	                $this->view->setVariable("errors", $errors);
                }
            } catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->setVariable("season", $season);
        $this->view->render("season", "SEASON_EDIT_Vista");
    }

    public function delete() {
        $this->checkPerms("season", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $seasonid = $_REQUEST["id"];
        $season = $this->seasonMapper->fetch($seasonid);

        if ($season == NULL) {
            throw new Exception(i18n("No such season with id: ").$seasonid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->seasonMapper->delete($season);
                $this->view->setFlash(sprintf(i18n("Season \"%s\" successfully deleted."), $season->getDescription()));
            }
            $this->view->redirect("season", "show");
        }
        $this->view->setVariable("season", $season);
        $this->view->render("season", "SEASON_DELETE_Vista");
    }
}
