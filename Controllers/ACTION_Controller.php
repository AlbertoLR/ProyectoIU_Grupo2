<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Action.php");
require_once(__DIR__."/../Models/ACTION_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class ACTION_Controller extends BaseController {
    
    private $actionMapper;
  
    public function __construct() {
        parent::__construct();
        $this->actionMapper = new ACTION_Model();
        $this->view->setLayout("default");
    }

    public function show(){
        if (!$this->checkPerms->check($this->currentUserId, $this->currentUserProfile, "action", "show")) {
            $this->view->setFlash(sprintf(i18n("You don't have permissions here.")));
            $this->view->redirect("user", "login");
        }
        
        $actions = $this->actionMapper->fetch_all();
        $this->view->setVariable("actions", $actions);
        $this->view->render("action", "ACTION_SHOW_Vista");
    }

    public function showone(){
        if (!$this->checkPerms->check($this->currentUserId, $this->currentUserProfile, "action", "showone")) {
            $this->view->setFlash(sprintf(i18n("You don't have permissions here.")));
            $this->view->redirect("user", "login");
        }
        
        if (!isset($_REQUEST["id"])) {
            throw new Exception("An action id is mandatory");
        }

        $actionid = $_REQUEST["id"];
        $action = $this->actionMapper->fetch($actionid);
        
        if ($action == NULL) {
            throw new Exception("no such action with id: ".$actionid);
        }
        
        $this->view->setVariable("action", $action);
        $this->view->render("action", "ACTION_SHOWONE_Vista");
    }

    public function add(){
        if (!$this->checkPerms->check($this->currentUserId, $this->currentUserProfile, "action", "add")) {
            $this->view->setFlash(sprintf(i18n("You don't have permissions here.")));
            $this->view->redirect("user", "login");
        }
    
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
        $this->view->render("action", "ACTION_ADD_Vista");
    }


    public function edit() {
        if (!$this->checkPerms->check($this->currentUserId, $this->currentUserProfile, "action", "edit")) {
            $this->view->setFlash(sprintf(i18n("You don't have permissions here.")));
            $this->view->redirect("user", "login");
        }
        
        if (!isset($_REQUEST["id"])) {
            throw new Exception("An action id is mandatory");
        }

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
        $this->view->render("action", "ACTION_EDIT_Vista");
    }

    public function delete() {
        if (!$this->checkPerms->check($this->currentUserId, $this->currentUserProfile, "action", "delete")) {
            $this->view->setFlash(sprintf(i18n("You don't have permissions here.")));
            $this->view->redirect("user", "login");
        }
        
        if (!isset($_REQUEST["id"])) {
            throw new Exception("id is mandatory");
        }
            
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
        $this->view->render("action", "ACTION_DELETE_Vista");
    }
  
}