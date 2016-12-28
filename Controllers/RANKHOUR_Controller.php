<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Rankhour.php");
require_once(__DIR__."/../Models/RANKHOUR_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class RANKHOUR_Controller extends BaseController {

    private $rankhourMapper;

    public function __construct() {
        parent::__construct();
        $this->rankhourMapper = new RANKHOUR_Model();
        $this->view->setLayout("default");
    }

    public function show(){
        $this->checkPerms("rankhour", "show", $this->currentUserId);

        $rankhours = $this->rankhourMapper->fetch_all();
        $seasons = $this->rankhourMapper->fetch_seasons();

        $this->view->setVariable("seasons", $seasons);
        $this->view->setVariable("rankhours", $rankhours);
        $this->view->render("rankhour", "RANKHOUR_SHOW_Vista");
    }

    public function add(){
        $this->checkPerms("rankhour", "add", $this->currentUserId);

        $rankhour = new Rankhour();

        if (isset($_POST["submit"])) {

          print_r($_POST["seasonid"]);
            try {
                  foreach ($_POST["days"] as $day ){

                    $rankhour->setDay($day);
                    $rankhour->setOpening($_POST["opening"]);
                    $rankhour->setClosing($_POST["closing"]);
                    $rankhour->setSeasonID($_POST["seasonid"]);

                    $this->rankhourMapper->insert($rankhour);

                }

                $this->view->setFlash(sprintf(i18n("Rankhour \"%s\" successfully added.")));
                $this->view->redirect("rankhour", "show");
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        $seasons = $this->rankhourMapper->fetch_seasons();

        $this->view->setVariable("seasons", $seasons);
        $this->view->setVariable("rankhour", $rankhour);
        $this->view->render("rankhour", "RANKHOUR_ADD_Vista");
    }

    public function delete() {
        $this->checkPerms("rankhour", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $rankhourid = $_REQUEST["id"];
        $rankhour = $this->rankhourMapper->fetch($rankhourid);

        if ($rankhour == NULL) {
            throw new Exception(i18n("No such rankhour with id: ").$rankhourid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->rankhourMapper->delete($rankhour);
                $this->view->setFlash(sprintf(i18n("Rankhour \"%s\" successfully deleted.")));
            }
            $this->view->redirect("rankhour", "show");
        }
        $this->view->setVariable("rankhour", $rankhour);
        $this->view->render("rankhour", "RANKHOUR_DELETE_Vista");
    }
}
