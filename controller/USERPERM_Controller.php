<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../model/Permission.php");
require_once(__DIR__."/../model/PermissionMapper.php");
require_once(__DIR__."/../model/UserPerm.php");
require_once(__DIR__."/../model/UserPermMapper.php");
require_once(__DIR__."/../controller/BaseController.php");

class USERPERM_Controller extends BaseController {
    
    private $userMapper;
    private $permissionMapper;
    private $userPermMapper;
  
    public function __construct() {
        parent::__construct();
        $this->userMapper = new UserMapper();
        $this->permissionMapper = new PermissionMapper();
        $this->userPermMapper = new UserPermMapper();
        $this->view->setLayout("default");
    }

    public function show(){
        $users = $this->userMapper->fetch_all();
        $permissions = $this->permissionMapper->fetch_all();
        $userperms = $this->userPermMapper->fetch_all();
        $this->view->setVariable("users", $users);
        $this->view->setVariable("permissions", $permissions);
        $this->view->setVariable("userperms", $userperms);
        $this->view->render("userperm", "show");
    }

    public function insert(){
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
        $this->view->render("userperm", "delete");
    }
}