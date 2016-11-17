<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/User.php");

class BaseController {

    protected $view;  
    protected $currentUser;
  
    public function __construct() {
        $this->view = ViewManager::getInstance();
   
        if (session_status() == PHP_SESSION_NONE) {      
            session_start();
        }
    
        if(isset($_SESSION["currentuser"])) {  
            $this->currentUser = new User();
            $this->currentUser->setUsername($_SESSION["currentuser"]);
            $this->view->setVariable("currentusername", 
                                     $this->currentUser->getUsername());
        }

        if(isset($_SESSION["permissions"])){
            $this->view->setVariable("permissions", $_SESSION["permissions"]);
        }
    }
}