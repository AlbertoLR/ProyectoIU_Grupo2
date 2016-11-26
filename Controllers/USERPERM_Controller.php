<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/User.php");
require_once(__DIR__."/../Models/USER_Model.php");
require_once(__DIR__."/../Models/Permission.php");
require_once(__DIR__."/../Models/PERMISSION_Model.php");
require_once(__DIR__."/../Models/UserPerm.php");
require_once(__DIR__."/../Models/USERPERM_Model.php");
require_once(__DIR__."/../Models/Profile.php");
require_once(__DIR__."/../Models/PROFILE_Model.php");
require_once(__DIR__."/../Models/ProfilePerm.php");
require_once(__DIR__."/../Models/PROFILEPERM_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");


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
        $this->profilePermMapper = new PROFILEPERM_Model();
        $this->profileMapper = new PROFILE_Model();
        $this->view->setLayout("default");
    }

    public function show(){
        $this->checkPerms("userperm", "show", $this->currentUserId);

        $users = $this->userMapper->fetch_all();
        $permissions = $this->permissionMapper->fetch_all();

        if (isset($_GET["orderby"])) {
            $userperms = $this->userPermMapper->fetch_all($_GET["orderby"]);
        } else {
            $userperms = $this->userPermMapper->fetch_all();
        }
        $this->view->setVariable("users", $users);
        $this->view->setVariable("permissions", $permissions);
        $this->view->setVariable("userperms", $userperms);
        $this->view->render("userperm", "USERPERM_SHOW_Vista");
    }

    public function add(){
        $this->checkPerms("userperm", "add", $this->currentUserId);

        $userperm = new UserPerm();

        if (isset($_POST["submit"])) {
            $userperm->setUser($_POST["user"]);
            $user = $this->userMapper->fetch($_POST["user"]);
            $profile = $this->profileMapper->fetch_by_profilename($user->getProfile());
            $added = 1;
            
            if (empty($_POST["user"]) || empty($_POST["permission"])) {
                $this->view->redirect("userperm", "show");
            }

            try {
                foreach ($_POST["permission"] as $permission) {
                    if (!$this->userPermMapper->nameExists($_POST["user"], $permission)){
                        if (!$this->profilePermMapper->nameExists($profile->getID(), $permission)) {
                            $userperm->setPermission($permission);
                            $this->userPermMapper->insert($userperm);
                        } else {
                            $added = 0;
                        }
                    } else {
                        $added = 0;
                    }
                }

                if ($added) {
                    $this->view->setFlash(sprintf(i18n("User permission successfully added.")));
                } else {
                    $this->view->setFlash(sprintf(i18n("1 or more permission already exists for this user or profile: \"%s\""),$profile->getProfileName()));
                }
                $this->view->redirect("userperm", "show");
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->show();
    }

    public function delete() {
        $this->checkPerms("userperm", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception("id is mandatory");
        }

        $userpermid = $_REQUEST["id"];
        $userperm = $this->userPermMapper->fetch($userpermid);

        if ($userperm == NULL) {
            throw new Exception("no such user perm with id: ".$userpermid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->userPermMapper->delete($userperm);
                $this->view->setFlash(sprintf(i18n("User permission successfully deleted.")));
            }
            $this->view->redirect("userperm", "show");
        }
        $this->view->setVariable("userperm", $userperm);
        $this->view->render("userperm", "USERPERM_DELETE_Vista");
    }
}
