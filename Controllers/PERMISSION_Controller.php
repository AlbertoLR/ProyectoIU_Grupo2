<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Controller.php");
require_once(__DIR__."/../Models/CONTROLLER_Model.php");
require_once(__DIR__."/../Models/Action.php");
require_once(__DIR__."/../Models/ACTION_Model.php");
require_once(__DIR__."/../Models/Permission.php");
require_once(__DIR__."/../Models/PERMISSION_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");


/**
 * Esta clase relaciona as entidades Controller e Action.
 * Esta relacion da lugar a unha entidade N:M que chamamos Permissions.
 * Estes permisos sobre accions de controlador serán os que se asignaran
 * a usuarios e perfis de usuario.
 */
class PERMISSION_Controller extends BaseController {
    
    private $controllerMapper;
    private $actionMapper;
    private $permissionMapper;
  
    public function __construct() {
        parent::__construct();
        $this->controllerMapper = new CONTROLLER_Model();
        $this->actionMapper = new ACTION_Model();
        $this->permissionMapper = new PERMISSION_Model();
        $this->view->setLayout("default");
    }

    public function show(){
        if (!$this->checkPerms->check($this->currentUserId, $this->currentUserProfile, "permission", "show")) {
            $this->view->setFlash(sprintf(i18n("You don't have permissions here.")));
            $this->view->redirect("user", "login");
        }
        
        $permissions = $this->permissionMapper->fetch_all();
        $controllers = $this->controllerMapper->fetch_all();
        $actions = $this->actionMapper->fetch_all();
        $this->view->setVariable("permissions", $permissions);
        $this->view->setVariable("controllers", $controllers);
        $this->view->setVariable("actions", $actions);
        $this->view->render("permission", "PERMISSION_SHOW_Vista");
    }

    public function add(){
        if (!$this->checkPerms->check($this->currentUserId, $this->currentUserProfile, "permission", "add")) {
            $this->view->setFlash(sprintf(i18n("You don't have permissions here.")));
            $this->view->redirect("user", "login");
        }
    
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

        $this->show();
    }

    public function delete() {
        if (!$this->checkPerms->check($this->currentUserId, $this->currentUserProfile, "permission", "delete")) {
            $this->view->setFlash(sprintf(i18n("You don't have permissions here.")));
            $this->view->redirect("user", "login");
        }
        
        if (!isset($_REQUEST["id"])) {
            throw new Exception("id is mandatory");
        }
    
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
        $this->view->render("permission", "PERMISSION_DELETE_Vista");
    }
  
}