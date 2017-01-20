<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Assistance.php");
require_once(__DIR__."/../Models/ASSISTANCE_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");
require_once(__DIR__."/../Models/User.php");
require_once(__DIR__."/../Models/USER_Model.php");

class ASSISTANCE_Controller extends BaseController {

    private $assistanceMapper;

    public function __construct() {
        parent::__construct();
        $this->assistanceMapper = new ASSISTANCE_Model();
        $this->userMapper = new USER_Model();
        $this->view->setLayout("default");
    }

    public function show(){
        $this->checkPerms("assistance", "show", $this->currentUserId);
        if($_REQUEST["sesion"] && $_REQUEST["user"] ){
        $user = $this->userMapper->fetch($this->currentUserId);
        if($_GET["user"]==$this->currentUserId || $user->getProfile()=="admin"){

          $activity = $this->assistanceMapper->fetch_activity($_GET["sesion"]);
          $inscriptions = $this->assistanceMapper->fetch($activity);
          $date = $this->assistanceMapper->fetch_date($_GET["sesion"]);
          $sesion = $this->assistanceMapper->fetch_sesion($_GET["sesion"]);

          $this->view->setVariable("sesion", $sesion);
          $this->view->setVariable("inscriptions", $inscriptions);
          $this->view->setVariable("date", $date);
          $this->view->render("assistance", "ASSISTANCE_SHOW_Vista");
        }else{

          $this->view->setFlash(sprintf(i18n("You don´t have permissions here")));
          $this->view->redirect("user", "login");
        }
      }else{
        throw new Exception(i18n("A sesion or user id is mandatory"));
      }

    }


    public function add(){
        $this->checkPerms("assistance", "add", $this->currentUserId);

        $assistance = new Assistance();

        if (isset($_POST["submit"])) {
            try {
              $clie = array();
              $clien = array();
              $diff = array();
              $sesion = $this->assistanceMapper->fetch_sesion($_POST["id"]);
              $activity = $this->assistanceMapper->fetch_a($_POST["actividad_id"]);
              foreach ($activity as $key) {
                array_push($clie,$key["id"]);
              }
              foreach ($_POST["check"] as $value) {
                array_push($clien,$value);
              }

              $diff = array_diff($clie,$clien);

              print_r($diff);

              if(!empty($_POST["check"])){
                foreach ($activity as $values) {
                  foreach ($_POST["check"] as $value) {
                    if($values["id"]==$value){
                      $assistance->setSessionID($_POST["id"]);
                      $assistance->setClientID($value);
                      $assistance->setAssistance(TRUE);
                      $this->assistanceMapper->insert($assistance);
                    }
                }
              }
              foreach ($diff as $value) {
                  $assistance->setSessionID($_POST["id"]);
                  $assistance->setClientID($value);
                  $assistance->setAssistance(FALSE);
                  $this->assistanceMapper->insert($assistance);
                }
                }else{
                  foreach ($activity as $value) {
                    $assistance->setSessionID($_POST["id"]);
                    $assistance->setClientID($value["id"]);
                    $assistance->setAssistance(FALSE);
                    $this->assistanceMapper->insert($assistance);
                }
                }
              $this->view->setFlash(sprintf(i18n("Assistance successfully added")));
              $this->view->redirect("user", "login");
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

    }


}
