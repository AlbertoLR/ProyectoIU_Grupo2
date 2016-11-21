<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/User.php");
require_once(__DIR__."/../Models/PERMISSION_Model.php");

class BaseController {

    protected $view;
    protected $checkPerms;
    protected $currentUser;
    protected $currentUserId;
  
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
        
    }

    protected function checkPerms($controller, $action, $userid){
        if (!$this->checkPerms->check($controller, $action, $userid)) {
            $this->view->setFlash(sprintf(i18n("You don't have permissions here.")));
            $this->view->redirect("user", "login");
        }
    }
}