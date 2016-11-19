<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/Controller.php");
require_once(__DIR__."/../model/CONTROLLER_Model.php");
require_once(__DIR__."/../controller/BaseController.php");

class CONTROLLER_Controller extends BaseController {
    
    private $controllerMapper;
  
    public function __construct() {
        parent::__construct();
        $this->controllerMapper = new CONTROLLER_Model();
        $this->view->setLayout("default");
    }

    public function show(){
        $controllers = $this->controllerMapper->fetch_all();
        $this->view->setVariable("controllers", $controllers);
        $this->view->render("controller", "CONTROLLER_SHOW_Vista");
    }

    public function showone(){
        if (!isset($_REQUEST["id"])) {
            throw new Exception("A controller id is mandatory");
        }

        $controllerid = $_REQUEST["id"];
        $controller = $this->controllerMapper->fetch($controllerid);
        
        if ($controller == NULL) {
            throw new Exception("no such controller with id: ".$controllerid);
        }

        $this->view->setVariable("controller", $controller);
        $this->view->render("controller", "CONTROLLER_SHOWONE_Vista");
    }

    public function add(){
        //checkPermissionsNeed
    
        $controller = new Controller();
    
        if (isset($_POST["submit"])) { 
            $controller->setControllerName($_POST["controllername"]);
            try {
                if (!$this->controllerMapper->nameExists($_POST["controllername"], $_POST["action"])){
                    $controller->checkIsValidForCreate();
                    $this->controllerMapper->insert($controller);
	
                    $this->view->setFlash(sprintf(i18n("Controller \"%s\" successfully added."), $controller->getControllerName()));
	
                    $this->view->redirect("controller", "CONTROLLER_SHOW_Vista");
                } else {
                    $errors = array();
	                $errors["general"] = "Controller already exists";
	                $this->view->setVariable("errors", $errors);
                }
            }catch(ValidationException $ex) {      
                $errors = $ex->getErrors();	
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->setVariable("controller", $controller);
        $this->view->render("controller", "CONTROLLER_ADD_Vista");
    }

    public function update() {
        if (!isset($_REQUEST["id"])) {
            throw new Exception("A Controller id is mandatory");
        }

        //CheckPermissionsNeed
        $controllerid = $_REQUEST["id"];
        $controller = $this->controllerMapper->fetch($controllerid);
    
        if ($controller == NULL) {
            throw new Exception("no such controller with id: ".$controllerid);
        }
    
        if (isset($_POST["submit"])) {
            $controller->setControllerName($_POST["controllername"]);
      
            try {
                if (!$this->controllerMapper->nameExists($_POST["controllername"])){
                    $controller->checkIsValidForCreate();
                    $this->controllerMapper->update($controller);                
                    $this->view->setFlash(sprintf(i18n("Controller \"%s\" successfully updated."), $controller->getControllerName()));
                    $this->view->redirect("controller", "CONTROLLER_SHOW_Vista");
                } else {
                    $errors = array();
	                $errors["general"] = "Controller already exists";
	                $this->view->setVariable("errors", $errors);
                }
            } catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->setVariable("controller", $controller);
        $this->view->render("controller", "CONTROLLER_UPDATE_Vista");    
    }

    public function delete() {
        if (!isset($_REQUEST["id"])) {
            throw new Exception("id is mandatory");
        }
        
        //CheckPermissionNeed
    
        $controllerid = $_REQUEST["id"];
        $controller = $this->controllerMapper->fetch($controllerid);
    
        if ($controller == NULL) {
            throw new Exception("no such controller with id: ".$controllerid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->controllerMapper->delete($controller);
                $this->view->setFlash(sprintf(i18n("Controller \"%s\" successfully deleted."), $controller->getControllerName()));
            }
            $this->view->redirect("controller", "CONTROLLER_SHOW_Vista");
        }
        $this->view->setVariable("controller", $controller);
        $this->view->render("controller", "CONTROLLER_DELETE_Vista");
    }
  
}