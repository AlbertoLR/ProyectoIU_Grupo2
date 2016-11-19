<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/Profile.php");
require_once(__DIR__."/../model/PROFILE_Model.php");
require_once(__DIR__."/../model/Permission.php");
require_once(__DIR__."/../model/PERMISSION_Model.php");
require_once(__DIR__."/../model/ProfilePerm.php");
require_once(__DIR__."/../model/PROFILEPERM_Model.php");
require_once(__DIR__."/../controller/BaseController.php");


/**
 * Esta clase relaciona as entidades Profile e Permission.
 * Esta relacion da lugar a unha entidade N:M que chamamos ProfilePerm.
 * Esta taboa relacion perfil con permisos.
 */
class PROFILEPERM_Controller extends BaseController {
    
    private $profileMapper;
    private $permissionMapper;
    private $profilePermMapper;
  
    public function __construct() {
        parent::__construct();
        $this->profileMapper = new PROFILE_Model();
        $this->permissionMapper = new PERMISSION_Model();
        $this->profilePermMapper = new PROFILEPERM_Model();
        $this->view->setLayout("default");
    }

    public function show(){
        if (!$this->checkPerms->check($this->currentUserId, $this->currentUserProfile, "profileperm", "show")) {
            $this->view->setFlash(sprintf(i18n("You don't have permissions here.")));
            $this->view->redirect("user", "login");
        }
        
        $profiles = $this->profileMapper->fetch_all();
        $permissions = $this->permissionMapper->fetch_all();
        $profileperms = $this->profilePermMapper->fetch_all();
        $this->view->setVariable("profiles", $profiles);
        $this->view->setVariable("permissions", $permissions);
        $this->view->setVariable("profileperms", $profileperms);
        $this->view->render("profileperm", "PROFILEPERM_SHOW_Vista");
    }

    public function add(){
        if (!$this->checkPerms->check($this->currentUserId, $this->currentUserProfile, "profileperm", "add")) {
            $this->view->setFlash(sprintf(i18n("You don't have permissions here.")));
            $this->view->redirect("user", "login");
        }
    
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
        if (!$this->checkPerms->check($this->currentUserId, $this->currentUserProfile, "profileperm", "delete")) {
            $this->view->setFlash(sprintf(i18n("You don't have permissions here.")));
            $this->view->redirect("user", "login");
        }
        
        if (!isset($_REQUEST["id"])) {
            throw new Exception("id is mandatory");
        }
    
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
        $this->view->render("profileperm", "PROFILEPERM_DELETE_Vista");
    }
}