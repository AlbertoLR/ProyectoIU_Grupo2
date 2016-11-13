<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../controller/BaseController.php");

class USER_Controller extends BaseController {
    
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
                $this->view->redirect("user", "login");
            }else{
                $errors = array();
                $errors["general"] = "Username is not valid";
                $this->view->setVariable("errors", $errors);
            }
        }
        
        $this->view->render("user", "login");
    }

    public function show(){
        $users = $this->userMapper->fetch_all();
        $this->view->setVariable("users", $users);
        $this->view->render("user", "show");
    }

    public function insert(){
        //checkPermissionsNeed
    
        $user = new User();
    
        if (isset($_POST["submit"])) { 
            $user->setUsername($_POST["username"]);
            $user->setPasswd($_POST["passwd"]);
            $user->setProfile($_POST["profile"]);
			 
            try {
                $user->checkIsValidForCreate();
                $this->userMapper->insert($user);
	
                $this->view->setFlash(sprintf(i18n("User \"%s\" successfully added."),$user->getUsername()));
	
                $this->view->redirect("user", "show");
	
            }catch(ValidationException $ex) {      
                $errors = $ex->getErrors();	
                $this->view->setVariable("errors", $errors);
            }
        }
    
        $this->view->setVariable("user", $user);
        $this->view->render("user", "insert");
    }


    public function update() {
        if (!isset($_REQUEST["id"])) {
            throw new Exception("A user id is mandatory");
        }

        //CheckPermissionsNeed
        $userid = $_REQUEST["id"];
        $user = $this->userMapper->fetch($userid);
    
        if ($user == NULL) {
            throw new Exception("no such user with id: ".$userid);
        }
    
        if (isset($_POST["submit"])) {
            $user->setUsername($_POST["username"]);
            $user->setPasswd($_POST["passwd"]);
            $user->setProfile($_POST["profile"]);
      
            try {
                $user->checkIsValidForCreate();
                $this->userMapper->update($user);
                
                $this->view->setFlash(sprintf(i18n("User \"%s\" successfully updated."),$user->getUsername()));
	
                $this->view->redirect("user", "show");	
	
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
    
        $this->view->setVariable("user", $user);
        $this->view->render("user", "update");    
    }

    public function delete() {
        if (!isset($_REQUEST["id"])) {
            throw new Exception("id is mandatory");
        }
        
        //CheckPermissionNeed
    
        $userid = $_REQUEST["id"];
        $user = $this->userMapper->fetch($userid);
    
        if ($user == NULL) {
            throw new Exception("no such user with id: ".$userid);
        }
    
        $this->userMapper->delete($user);
    
        $this->view->setFlash(sprintf(i18n("User \"%s\" successfully deleted."),$user->getUsername()));
        $this->view->redirect("user", "show");
    }

    public function logout() {
        session_destroy();
        $this->view->redirect("user", "login");
    }
  
}