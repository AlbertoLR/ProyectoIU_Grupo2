<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Profile.php");
require_once(__DIR__."/../Models/PROFILE_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class PROFILE_Controller extends BaseController {

    private $profileMapper;

    public function __construct() {
        parent::__construct();
        $this->profileMapper = new PROFILE_Model();
        $this->view->setLayout("default");
    }

    public function show(){
        $this->checkPerms("profile", "show", $this->currentUserId);

        $profiles = $this->profileMapper->fetch_all();
        $this->view->setVariable("profiles", $profiles);
        $this->view->render("profile", "PROFILE_SHOW_Vista");
    }

    public function showone(){
        $this->checkPerms("profile", "showone", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A profile id is mandatory"));
        }

        $profileid = $_REQUEST["id"];
        $profile = $this->profileMapper->fetch($profileid);

        if ($profile == NULL) {
            throw new Exception(i18n("No such profile with id: ").$profileid);
        }

        $this->view->setVariable("profile", $profile);
        $this->view->render("profile", "PROFILE_SHOWONE_Vista");
    }

    public function add(){
        $this->checkPerms("profile", "add", $this->currentUserId);

        $profile = new Profile();

        if (isset($_POST["submit"])) {
            $profile->setProfileName($_POST["profilename"]);

            try {
                if (!$this->profileMapper->nameExists($_POST["profilename"])){
                    $profile->checkIsValidForCreate();
                    $this->profileMapper->insert($profile);

                    $this->view->setFlash(sprintf(i18n("Profile \"%s\" successfully added."), $profile->getProfileName()));

                    $this->view->redirect("profile", "show");
                } else {
                    $errors = array();
	                $errors["general"] = i18n("Profile already exists");
	                $this->view->setVariable("errors", $errors);
                }
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->setVariable("profile", $profile);
        $this->view->render("profile", "PROFILE_ADD_Vista");
    }

    public function edit() {
        $this->checkPerms("profile", "edit", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A profile id is mandatory"));
        }

        $profileid = $_REQUEST["id"];
        $profile = $this->profileMapper->fetch($profileid);

        if ($profile == NULL) {
            throw new Exception(i18n("No such profile with id: ").$actionid);
        }

        if (isset($_POST["submit"])) {
            $profile->setProfileName($_POST["profilename"]);

            try {
                if (!$this->profileMapper->nameExists($_POST["profilename"])){
                $profile->checkIsValidForCreate();
                $this->profileMapper->update($profile);
                $this->view->setFlash(sprintf(i18n("Profile \"%s\" successfully updated."), $profile->getProfileName()));
                $this->view->redirect("profile", "show");
                } else {
                    $errors = array();
	                $errors["general"] = i18n("Profile already exists");
	                $this->view->setVariable("errors", $errors);
                }
            } catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->setVariable("profile", $profile);
        $this->view->render("profile", "PROFILE_EDIT_Vista");
    }

    public function delete() {
        $this->checkPerms("profile", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $profileid = $_REQUEST["id"];
        $profile = $this->profileMapper->fetch($profileid);

        if ($profile == NULL) {
            throw new Exception(i18n("No such profile with id: ").$profileid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->profileMapper->delete($profile);
                $this->view->setFlash(sprintf(i18n("Profile \"%s\" successfully deleted."), $profile->getProfileName()));
            }
            $this->view->redirect("profile", "show");
        }
        $this->view->setVariable("profile", $profile);
        $this->view->render("profile", "PROFILE_DELETE_Vista");
    }
}
