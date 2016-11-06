<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../controller/BaseController.php");

class Users_Controller extends BaseController {
    
    private $userMapper;    
  
    public function __construct() {
        parent::__construct();
        $this->userMapper = new UserMapper();
        $this->view->setLayout("default");
    }
 
    public function login() {
        if (isset($_POST["username"])){
            if ($this->userMapper->isValidUser($_POST["username"], $_POST["passwd"])) {
                $_SESSION["currentuser"] = $_POST["username"];
                $this->view->redirect("calendar", "index");
            }else{
                $errors = array();
                $errors["general"] = "Username is not valid";
                $this->view->setVariable("errors", $errors);
            }
        }
        
        $this->view->render("users", "login");    
    }

    public function logout() {
        session_destroy();
        $this->view->redirect("users", "login");
    }
  
}