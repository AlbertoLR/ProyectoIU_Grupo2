<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Hour.php");
require_once(__DIR__."/../Models/HOUR_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class HOUR_Controller extends BaseController {

    private $hourMapper;

    public function __construct() {
        parent::__construct();
        $this->hourMapper = new HOUR_Model();
        $this->view->setLayout("default");
    }

    public function show(){
        $this->checkPerms("hour", "show", $this->currentUserId);

        $hours = $this->hourMapper->fetch_all();
        $ranks = $this->hourMapper->fetch_ranks();
        $seasons = $this->hourMapper->fetch_seasons();

        $this->view->setVariable("seasons", $seasons);
        $this->view->setVariable("ranks", $ranks);
        $this->view->setVariable("hours", $hours);
        $this->view->render("hour", "HOUR_SHOW_Vista");
    }

    public function showused(){
        $this->checkPerms("hour", "show", $this->currentUserId);

        $hours = $this->hourMapper->fetch_all();
        $ranks = $this->hourMapper->fetch_ranks();
        $seasons = $this->hourMapper->fetch_seasons();

        $this->view->setVariable("seasons", $seasons);
        $this->view->setVariable("ranks", $ranks);
        $this->view->setVariable("hours", $hours);
        $this->view->render("hour", "HOUR_SHOWUSED_Vista");
    }

    public function add(){
        $this->checkPerms("hour", "add", $this->currentUserId);

        $hour = new Hour();

        if (isset($_POST["submit"])) {
          //Comprobacción de entrada de fechas. Se comprueba qe la inicial sea menor que la final.
          $fecha_ini = strtotime(date($_POST["from"],time()));
          $fecha_fin = strtotime($_POST["to"]);
          if($fecha_ini > $fecha_fin){

            $this->view->setFlash(sprintf(i18n("Dates not valid.")));
            $this->view->redirect("hour", "add");
          }

          //Comprobacción de entrada de horas. Se comprueba qe la inicial sea menor que la final.
          $fecha_ini = strtotime(date($_POST["start"],time()));
          $fecha_fin = strtotime($_POST["end"]);
          if($fecha_ini > $fecha_fin){

            $this->view->setFlash(sprintf(i18n("Hours not valid.")));
            $this->view->redirect("hour", "add");
          }

            try {

              $fechaInicio=strtotime($_POST["from"]);
              $fechaFin=strtotime($_POST["to"]);
              for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
                  $fecha = date("Y-m-d", $i);
                  $day_week= date('l', strtotime( $fecha));

                  foreach ($_POST["rankid"] as $rank => $value ){
                    $rnks = $this->hourMapper->fetch_ranks();
                    foreach ($rnks as $rnk => $vle) {
                      if($vle["id"]==$value)
                      $dw = $vle["dia_s"];
                    }

                    if($dw == $day_week){
                      $hour->setDay($fecha);
                      $hour->setOpening($_POST["start"]);
                      $hour->setClosing($_POST["end"]);
                      $hour->setRankID($value);
                      $hour->setActive();

                      $this->hourMapper->insert($hour);
                  }
                }
                }

                $this->view->setFlash(sprintf(i18n("Hours successfully added."), $hour->getID()));
                $this->view->redirect("hour", "show");
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        $seasons = $this->hourMapper->fetch_seasons();
        $ranks = $this->hourMapper->fetch_ranks();

        $this->view->setVariable("ranks", $ranks);
        $this->view->setVariable("seasons", $seasons);
        $this->view->setVariable("hour", $hour);
        $this->view->render("hour", "HOUR_ADD_Vista");
    }

    public function delete() {
        $this->checkPerms("hour", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $hourid = $_REQUEST["id"];
        $hour = $this->hourMapper->fetch($hourid);

        if ($hour == NULL) {
            throw new Exception(i18n("No such hour with id: ").$hourid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->hourMapper->delete($hour);
                $this->view->setFlash(sprintf(i18n("Hours successfully deleted."), $hour->getID()));
            }
            $this->view->redirect("hour", "show");
        }
        $this->view->setVariable("hour", $hour);
        $this->view->render("hour", "HOUR_DELETE_Vista");
    }
}
