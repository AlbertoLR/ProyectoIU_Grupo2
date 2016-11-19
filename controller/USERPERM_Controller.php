<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/USER_Model.php");
require_once(__DIR__."/../model/Permission.php");
require_once(__DIR__."/../model/PERMISSION_Model.php");
require_once(__DIR__."/../model/UserPerm.php");
require_once(__DIR__."/../model/USERPERM_Model.php");
require_once(__DIR__."/../controller/BaseController.php");


/**
 * Esta clase relaciona as entidades User e Permission.
 * Esta relacion da lugar a unha entidade N:M que chamamos UserPerm.
 * Esta taboa relaciona un usuario con permisos.
 */
class USERPERM_Controller extends BaseController {
    
    private $userMapper;
    private $permissionMapper;
    private $userPermMapper;
  
    public function __construct() {
        parent::__construct();
        $this->userMapper = new USER_Model();
        $this->permissionMapper = new PERMISSION_Model();
        $this->userPermMapper = new USERPERM_Model();
        $this->view->setLayout("default");
    }

    public function show(){
        $users = $this->userMapper->fetch_all();
        $permissions = $this->permissionMapper->fetch_all();
        $userperms = $this->userPermMapper->fetch_all();
        $this->view->setVariable("users", $users);
        $this->view->setVariable("permissions", $permissions);
        $this->view->setVariable("userperms", $userperms);
        $this->view->render("userperm", "USERPERM_SHOW_Vista");
    }

    public function add(){
        //checkPermissionsNeed
    
        $userperm = new UserPerm();
    
        if (isset($_POST["submit"])) {
            $userperm->setUser($_POST["user"]);
            $userperm->setPermission($_POST["permission"]);
            try {
                if (!$this->userPermMapper->nameExists($_POST["user"], $_POST["permission"])){
                    
                    $this->userPermMapper->insert($userperm);
	
                    $this->view->setFlash(sprintf(i18n("User Permission \"%s\" \"%s\" successfully added."), $userperm->getUser(), $userperm->getPermission()));
	
                    $this->view->redirect("userperm", "show");
                } else {
                    $errors = array();
	                $errors["general"] = "UserPerm already exists";
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
        if (!isset($_REQUEST["id"])) {
            throw new Exception("id is mandatory");
        }
        
        //CheckPermissionNeed
    
        $userpermid = $_REQUEST["id"];
        $userperm = $this->userPermMapper->fetch($userpermid);
    
        if ($userperm == NULL) {
            throw new Exception("no such user perm with id: ".$userpermid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->userPermMapper->delete($userperm);
                $this->view->setFlash(sprintf(i18n("UserPerm \"%s\" \"%s\" successfully deleted."), $userperm->getUser(), $userperm->getPermission()));
            }
            $this->view->redirect("userperm", "show");
        }
        $this->view->setVariable("userperm", $userperm);
        $this->view->render("userperm", "USERPERM_SHOW_Vista");
    }
}