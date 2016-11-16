<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/Action.php");
require_once(__DIR__."/../model/ActionMapper.php");
require_once(__DIR__."/../controller/BaseController.php");

class ACTION_Controller extends BaseController {
    
    private $actionMapper;
  
    public function __construct() {
        parent::__construct();
        $this->actionMapper = new ActionMapper();
        $this->view->setLayout("default");
    }

    public function show(){
        $actions = $this->actionMapper->fetch_all();
        $this->view->setVariable("actions", $actions);
        $this->view->render("action", "show");
    }

    public function showone(){
        if (!isset($_REQUEST["id"])) {
            throw new Exception("An action id is mandatory");
        }

        $actionid = $_REQUEST["id"];
        $action = $this->actionMapper->fetch($actionid);
        
        if ($action == NULL) {
            throw new Exception("no such action with id: ".$actionid);
        }

        $this->view->setVariable("action", $action);
        $this->view->render("action", "showone");
    }

    public function insert(){
        //checkPermissionsNeed
    
        $action = new Action();
    
        if (isset($_POST["submit"])) { 
            $action->setActionName($_POST["actionname"]);
			 
            try {
                if (!$this->actionMapper->nameExists($_POST["actionname"])){
                    $action->checkIsValidForCreate();
                    $this->actionMapper->insert($action);
	
                    $this->view->setFlash(sprintf(i18n("Action \"%s\" successfully added."), $action->getActionName()));
                    $this->view->redirect("action", "show");
                } else {
                    $errors = array();
	                $errors["general"] = "Action already exists";
	                $this->view->setVariable("errors", $errors);
                }
	
            }catch(ValidationException $ex) {      
                $errors = $ex->getErrors();	
                $this->view->setVariable("errors", $errors);
            }
        }
    
        $this->view->setVariable("action", $action);
        $this->view->render("action", "insert");
    }


    public function update() {
        if (!isset($_REQUEST["id"])) {
            throw new Exception("An action id is mandatory");
        }

        //CheckPermissionsNeed
        $actionid = $_REQUEST["id"];
        $action = $this->actionMapper->fetch($actionid);
    
        if ($action == NULL) {
            throw new Exception("no such action with id: ".$actionid);
        }
    
        if (isset($_POST["submit"])) {
            $action->setActionName($_POST["actionname"]);
      
            try {
                if (!$this->actionMapper->nameExists($_POST["actionname"])){
                    $action->checkIsValidForCreate();
                    $this->actionMapper->update($action);                
                    $this->view->setFlash(sprintf(i18n("Action \"%s\" successfully updated."), $action->getActionName()));
                    $this->view->redirect("action", "show");
                } else {
                    $errors = array();
	                $errors["general"] = "Action already exists";
	                $this->view->setVariable("errors", $errors);
                }
            } catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
    
        $this->view->setVariable("action", $action);
        $this->view->render("action", "update");    
    }

    public function delete() {
        if (!isset($_REQUEST["id"])) {
            throw new Exception("id is mandatory");
        }
        
        //CheckPermissionNeed
    
        $actionid = $_REQUEST["id"];
        $action = $this->actionMapper->fetch($actionid);
    
        if ($action == NULL) {
            throw new Exception("no such action with id: ".$actionid);
        }
        
        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->actionMapper->delete($action);
                $this->view->setFlash(sprintf(i18n("Action \"%s\" successfully deleted."), $action->getActionName()));
            }
            $this->view->redirect("action", "show");
        }
        $this->view->setVariable("action", $action);
        $this->view->render("action", "delete");
    }
  
}