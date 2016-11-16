<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/Controller.php");
require_once(__DIR__."/../model/ControllerMapper.php");
require_once(__DIR__."/../model/Action.php");
require_once(__DIR__."/../model/ActionMapper.php");
require_once(__DIR__."/../model/Permission.php");
require_once(__DIR__."/../model/PermissionMapper.php");
require_once(__DIR__."/../controller/BaseController.php");

class PERMISSION_Controller extends BaseController {
    
    private $controllerMapper;
    private $actionMapper;
    private $permissionMapper;
  
    public function __construct() {
        parent::__construct();
        $this->controllerMapper = new ControllerMapper();
        $this->actionMapper = new ActionMapper();
        $this->permissionMapper = new PermissionMapper();
        $this->view->setLayout("default");
    }

    public function show(){
        $permissions = $this->permissionMapper->fetch_all();
        $controllers = $this->controllerMapper->fetch_all();
        $actions = $this->actionMapper->fetch_all();
        $this->view->setVariable("permissions", $permissions);
        $this->view->setVariable("controllers", $controllers);
        $this->view->setVariable("actions", $actions);
        $this->view->render("permission", "show");
    }

    public function insert(){
        //checkPermissionsNeed
    
        $permission = new Permission();
    
        if (isset($_POST["submit"])) {
            $permission->setController($_POST["controller"]);
            $permission->setAction($_POST["action"]);
            try {
                if (!$this->permissionMapper->nameExists($_POST["controller"], $_POST["action"])){
                    $permission->checkIsValidForCreate();
                    $this->permissionMapper->insert($permission);
	
                    $this->view->setFlash(sprintf(i18n("Permission \"%s\" \"%s\" successfully added."), $permission->getController(), $permission->getAction()));
	
                    $this->view->redirect("permission", "show");
                } else {
                    $errors = array();
	                $errors["general"] = "Permission already exists";
	                $this->view->setVariable("errors", $errors);
                }
            }catch(ValidationException $ex) {      
                $errors = $ex->getErrors();	
                $this->view->setVariable("errors", $errors);
            }
        }

        //$this->view->redirect("permission", "show");
        $this->show();
    }

    public function delete() {
        if (!isset($_REQUEST["id"])) {
            throw new Exception("id is mandatory");
        }
        
        //CheckPermissionNeed
    
        $permissionid = $_REQUEST["id"];
        $permission = $this->permissionMapper->fetch($permissionid);
    
        if ($permission == NULL) {
            throw new Exception("no such permission with id: ".$permissionid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->permissionMapper->delete($permission);
                $this->view->setFlash(sprintf(i18n("Permission \"%s\" \"%s\" successfully deleted."), $permission->getController(), $permission->getAction()));
            }
            $this->view->redirect("permission", "show");
        }
        $this->view->setVariable("permission", $permission);
        $this->view->render("permission", "delete");
    }
  
}