<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Controller.php");
require_once(__DIR__."/../Models/CONTROLLER_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class CONTROLLER_Controller extends BaseController {
    
    private $controllerMapper;
  
    public function __construct() {
        parent::__construct();
        $this->controllerMapper = new CONTROLLER_Model();
        $this->view->setLayout("default");
    }

    public function show(){
        $this->checkPerms("controller", "show", $this->currentUserId);
        
        $controllers = $this->controllerMapper->fetch_all();
        $this->view->setVariable("controllers", $controllers);
        $this->view->render("controller", "CONTROLLER_SHOW_Vista");
    }

    public function showone(){
        $this->checkPerms("controller", "showone", $this->currentUserId);
        
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
        $this->checkPerms("controller", "add", $this->currentUserId);
    
        $controller = new Controller();
    
        if (isset($_POST["submit"])) { 
            $controller->setControllerName($_POST["controllername"]);
            try {
                if (!$this->controllerMapper->nameExists($_POST["controllername"])){
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

        $this->view->setVariable("controller", $controller);
        $this->view->render("controller", "CONTROLLER_ADD_Vista");
    }

    public function edit() {
        $this->checkPerms("controller", "edit", $this->currentUserId);
        
        if (!isset($_REQUEST["id"])) {
            throw new Exception("A Controller id is mandatory");
        }

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

        $this->view->setVariable("controller", $controller);
        $this->view->render("controller", "CONTROLLER_EDIT_Vista");    
    }

    public function delete() {
        $this->checkPerms("controller", "delete", $this->currentUserId);
        
        if (!isset($_REQUEST["id"])) {
            throw new Exception("id is mandatory");
        }
    
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
        $this->view->render("controller", "CONTROLLER_DELETE_Vista");
    }
  
}