<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/PERMISSION_Model.php");

class BaseController {

    protected $view;  
    protected $currentUser;
    protected $currentUserId;
    protected $currentUserProfile;
    protected $checkPerms;
  
    public function __construct() {
        $this->view = ViewManager::getInstance();
        $this->checkPerms = new PERMISSION_Model();
   
        if (session_status() == PHP_SESSION_NONE) {      
            session_start();
        }
    
        if(isset($_SESSION["currentuser"])) {  
            $this->currentUser = new User();
            $this->currentUser->setUsername($_SESSION["currentuser"]);
            $this->view->setVariable("currentusername", $this->currentUser->getUsername());
        }

        if(isset($_SESSION["currentuserid"])) {
            $this->currentUserId = $_SESSION["currentuserid"];
        }

        if(isset($_SESSION["currentuserprofile"])) {
            $this->currentUserProfile = $_SESSION["currentuserprofile"];
        }
    }
}