<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/Profile.php");
require_once(__DIR__."/../model/ProfileMapper.php");
require_once(__DIR__."/../controller/BaseController.php");

class PROFILE_Controller extends BaseController {
    
    private $profileMapper;
  
    public function __construct() {
        parent::__construct();
        $this->profileMapper = new ProfileMapper();
        $this->view->setLayout("default");
    }

    public function show(){
        $profiles = $this->profileMapper->fetch_all();
        $this->view->setVariable("profiles", $profiles);
        $this->view->render("profile", "show");
    }

    public function insert(){
        //checkPermissionsNeed
        
        $profile = new Profile();
    
        if (isset($_POST["submit"])) { 
            $action->setProfileName($_POST["profilename"]);
			 
            try {
                $action->checkIsValidForCreate();
                $this->profileMapper->insert($profile);
	
                $this->view->setFlash(sprintf(i18n("Profile \"%s\" successfully added."), $profile->getProfileName()));
	
                $this->view->redirect("profile", "show");
	
            }catch(ValidationException $ex) {     
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
    
        $this->view->setVariable("profile", $profile);
        $this->view->render("profile", "insert");
    }

    public function update() {
        if (!isset($_REQUEST["id"])) {
            throw new Exception("A profile id is mandatory");
        }

        //CheckPermissionsNeed
        $profileid = $_REQUEST["id"];
        $profile = $this->profileMapper->fetch($profileid);
    
        if ($profile == NULL) {
            throw new Exception("no such profile with id: ".$actionid);
        }
    
        if (isset($_POST["submit"])) {
            $profile->setProfileName($_POST["profilename"]);
      
            try {
                $profile->checkIsValidForCreate();
                $this->profileMapper->update($profile);                
                $this->view->setFlash(sprintf(i18n("Profile \"%s\" successfully updated."), $profile->getProfileName()));
                $this->view->redirect("profile", "show");	
            } catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
    
        $this->view->setVariable("profile", $profile);
        $this->view->render("profile", "update");    
    }

    public function delete() {
        if (!isset($_REQUEST["id"])) {
            throw new Exception("id is mandatory");
        }
        
        //CheckPermissionNeed
    
        $profileid = $_REQUEST["id"];
        $profile = $this->profileMapper->fetch($profileid);
    
        if ($profile == NULL) {
            throw new Exception("no such profile with id: ".$profileid);
        }
    
        $this->profileMapper->delete($profile);
        $this->view->setFlash(sprintf(i18n("Profile \"%s\" successfully deleted."), $profile->getProfileName()));
        $this->view->redirect("profile", "show");
    }
}