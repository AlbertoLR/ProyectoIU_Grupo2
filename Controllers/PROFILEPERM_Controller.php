<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Profile.php");
require_once(__DIR__."/../Models/PROFILE_Model.php");
require_once(__DIR__."/../Models/Permission.php");
require_once(__DIR__."/../Models/PERMISSION_Model.php");
require_once(__DIR__."/../Models/ProfilePerm.php");
require_once(__DIR__."/../Models/PROFILEPERM_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");


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
        $this->checkPerms("profileperm", "show", $this->currentUserId);

        $profiles = $this->profileMapper->fetch_all();
        $permissions = $this->permissionMapper->fetch_all();
        if (isset($_GET["orderby"])) {
            $profileperms = $this->profilePermMapper->fetch_all($_GET["orderby"]);
        } else {
            $profileperms = $this->profilePermMapper->fetch_all();
        }
        $this->view->setVariable("profiles", $profiles);
        $this->view->setVariable("permissions", $permissions);
        $this->view->setVariable("profileperms", $profileperms);
        $this->view->render("profileperm", "PROFILEPERM_SHOW_Vista");
    }

    public function add(){
        $this->checkPerms("profileperm", "add", $this->currentUserId);

        $profileperm = new ProfilePerm();

        if (isset($_POST["submit"])) {
            $profileperm->setProfile($_POST["profile"]);
            //$profileperm->setPermission($_POST["permission"]);

            if (empty($_POST["profile"]) || empty($_POST["permission"])) {
                $this->view->redirect("profileperm", "show");
            }

            try {
                foreach($_POST["permission"] as $permission) {
                    if (!$this->profilePermMapper->nameExists($_POST["profile"], $permission)){
                        $profileperm->setPermission($permission);
                        $this->profilePermMapper->insert($profileperm);
                    } else {
                        $errors = array();
                        $errors["general"] = i18n("Profile permissions already exists");
                        $this->view->setVariable("errors", $errors);
                    }
                }
                $this->view->setFlash(sprintf(i18n("Profile permission successfully added.")));
                $this->view->redirect("profileperm", "show");
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->show();
    }

    public function delete() {
        $this->checkPerms("profileperm", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $profilepermid = $_REQUEST["id"];
        $profileperm = $this->profilePermMapper->fetch($profilepermid);

        if ($profileperm == NULL) {
            throw new Exception(i18n("No such profile permission with id: ").$profilepermid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->profilePermMapper->delete($profileperm);
                $this->view->setFlash(sprintf(i18n("Profile permissions successfully deleted.")));
            }
            $this->view->redirect("profileperm", "show");
        }
        $this->view->setVariable("profileperm", $profileperm);
        $this->view->render("profileperm", "PROFILEPERM_DELETE_Vista");
    }
}
