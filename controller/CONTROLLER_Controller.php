<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/Controller.php");
require_once(__DIR__."/../model/ControllerMapper.php");
require_once(__DIR__."/../model/Action.php");
require_once(__DIR__."/../model/ActionMapper.php");
require_once(__DIR__."/../controller/BaseController.php");

class CONTROLLER_Controller extends BaseController {
    
    private $controllerMapper;
  
    public function __construct() {
        parent::__construct();
        $this->controllerMapper = new ControllerMapper();
        $this->view->setLayout("default");
    }

    public function show(){
        $controllers = $this->controllerMapper->fetch_all();
        $this->view->setVariable("controllers", $controllers);
        $this->view->render("controller", "show");
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
        $this->view->render("controller", "showone");
    }

    public function insert(){
        //checkPermissionsNeed
    
        $controller = new Controller();
    
        if (isset($_POST["submit"])) { 
            $controller->setControllerName($_POST["controllername"]);
            $controller->setAction($_POST["action"]);
            try {
                if (!$this->controllerMapper->nameExists($_POST["controllername"], $_POST["action"])){
                    $controller->checkIsValidForCreate();
                    $this->controllerMapper->insert($controller);
	
                    $this->view->setFlash(sprintf(i18n("Controller \"%s\" successfully added."), $controller->getControllerName()));
	
                    $this->view->redirect("controller", "show");
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

        $actionMapper = new ActionMapper();
        $actions = $actionMapper->fetch_all();
        $this->view->setVariable("actions", $actions);
        $this->view->setVariable("controller", $controller);
        $this->view->render("controller", "insert");
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
            $controller->setAction($_POST["action"]);
      
            try {
                if (!$this->controllerMapper->nameExists($_POST["controllername"], $_POST["action"])){
                    $controller->checkIsValidForCreate();
                    $this->controllerMapper->update($controller);                
                    $this->view->setFlash(sprintf(i18n("Controller \"%s\" successfully updated."), $controller->getControllerName()));
                    $this->view->redirect("controller", "show");
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

        $actionMapper = new ActionMapper();
        $actions = $actionMapper->fetch_all();
        $this->view->setVariable("actions", $actions);
        $this->view->setVariable("controller", $controller);
        $this->view->render("controller", "update");    
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
            $this->view->redirect("controller", "show");
        }
        $this->view->setVariable("controller", $controller);
        $this->view->render("controller", "delete");
    }
  
}