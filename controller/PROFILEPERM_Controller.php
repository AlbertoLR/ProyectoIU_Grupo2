<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/Profile.php");
require_once(__DIR__."/../model/ProfileMapper.php");
require_once(__DIR__."/../model/Permission.php");
require_once(__DIR__."/../model/PermissionMapper.php");
require_once(__DIR__."/../model/ProfilePerm.php");
require_once(__DIR__."/../model/ProfilePermMapper.php");
require_once(__DIR__."/../controller/BaseController.php");

class PROFILEPERM_Controller extends BaseController {
    
    private $profileMapper;
    private $permissionMapper;
    private $profilePermMapper;
  
    public function __construct() {
        parent::__construct();
        $this->profileMapper = new ProfileMapper();
        $this->permissionMapper = new PermissionMapper();
        $this->profilePermMapper = new ProfilePermMapper();
        $this->view->setLayout("default");
    }

    public function show(){
        $profiles = $this->profileMapper->fetch_all();
        $permissions = $this->permissionMapper->fetch_all();
        $profileperms = $this->profilePermMapper->fetch_all();
        $this->view->setVariable("profiles", $profiles);
        $this->view->setVariable("permissions", $permissions);
        $this->view->setVariable("profileperms", $profileperms);
        $this->view->render("profileperm", "show");
    }

    public function insert(){
        //checkPermissionsNeed
    
        $profileperm = new ProfilePerm();
    
        if (isset($_POST["submit"])) {
            $profileperm->setProfile($_POST["profile"]);
            $profileperm->setPermission($_POST["permission"]);
            try {
                if (!$this->profilePermMapper->nameExists($_POST["profile"], $_POST["permission"])){
                    $this->profilePermMapper->insert($profileperm);
                    
                    $this->view->setFlash(sprintf(i18n("Profile Permission \"%s\" \"%s\" successfully added."), $profileperm->getProfile(), $profileperm->getPermission()));
	
                    $this->view->redirect("profileperm", "show");
                } else {
                    $errors = array();
	                $errors["general"] = "ProfilePerm already exists";
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
    
        $profilepermid = $_REQUEST["id"];
        $profileperm = $this->profilePermMapper->fetch($profilepermid);
    
        if ($profileperm == NULL) {
            throw new Exception("no such profile perm with id: ".$profilepermid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->profilePermMapper->delete($profileperm);
                $this->view->setFlash(sprintf(i18n("profilePerm \"%s\" \"%s\" successfully deleted."), $profileperm->getProfile(), $profileperm->getPermission()));
            }
            $this->view->redirect("profileperm", "show");
        }
        $this->view->setVariable("profileperm", $profileperm);
        $this->view->render("profileperm", "delete");
    }
}