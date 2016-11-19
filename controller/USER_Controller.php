<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/USER_Model.php");
require_once(__DIR__."/../model/Profile.php");
require_once(__DIR__."/../model/PROFILE_Model.php");
require_once(__DIR__."/../controller/BaseController.php");

class USER_Controller extends BaseController {

    private $userMapper;

    public function __construct() {
        parent::__construct();
        $this->userMapper = new USER_Model();
        $this->view->setLayout("default");
    }

    public function login() {
        if (isset($_POST["username"])){
            if ($this->userMapper->isValidUser($_POST["username"], $_POST["passwd"])) {
                $user = $this->userMapper->fetch_by_username($_POST["username"]);
                $_SESSION["currentuser"] = $user->getUsername();
                $_SESSION["currentuserid"] = $user->getID();
                $_SESSION["currentuserprofile"] = $user->getProfile();
                $this->view->redirect("user", "login");
            }else{
                $errors = array();
                $errors["general"] = "Username is not valid";
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->render("user", "USER_LOGIN_Vista");
    }

    public function show(){
        if (!$this->checkPerms->check($this->currentUserId, $this->currentUserProfile, "user", "show")) {
            $this->view->setFlash(sprintf(i18n("You don't have permissions here.")));
            $this->view->redirect("user", "login");
        }
        
        $users = $this->userMapper->fetch_all();
        $this->view->setVariable("users", $users);
        $this->view->render("user", "USER_SHOW_Vista");
    }

    public function showone(){
        if (!$this->checkPerms->check($this->currentUserId, $this->currentUserProfile, "user", "showone")) {
            $this->view->setFlash(sprintf(i18n("You don't have permissions here.")));
            $this->view->redirect("user", "login");
        }
        
        if (!isset($_REQUEST["id"])) {
            throw new Exception("An user id is mandatory");
        }

        $userid = $_REQUEST["id"];
        $user = $this->userMapper->fetch($userid);

        if ($user == NULL) {
            throw new Exception("no such user with id: ".$userid);
        }

        $this->view->setVariable("user", $user);
        $this->view->render("user", "USER_SHOWONE_Vista");
    }

    public function add(){
        if (!$this->checkPerms->check($this->currentUserId, $this->currentUserProfile, "user", "add")) {
            $this->view->setFlash(sprintf(i18n("You don't have permissions here.")));
            $this->view->redirect("user", "login");
        }

        $user = new User();

        if (isset($_POST["submit"])) {

		  $image_name = $_FILES["foto"]["name"];
          $image_type = $_FILES["foto"]["type"];
          $image_size = $_FILES["foto"]["size"];
          $folder = $_SERVER['DOCUMENT_ROOT'] . '/IUA/pictures/';

          if($image_size < 100000000 ){ /*100MB*/
            if($image_type == "image/jpeg" || $image_type == "image/jpg" || $image_type == "image/png" || $image_type == "image/gif"){
            move_uploaded_file($_FILES["foto"]["tmp_name"], $folder.$image_name);
            }else{
              $errors = array();
              $errors["general"] = "Only formats: jpg/jpeg/png/gif";
              $this->view->setVariable("errors", $errors);
            }
          } else {
          $errors = array();
          $errors["general"] = "Image too large";
          $this->view->setVariable("errors", $errors);
        }

          $user->setUsername($_POST["username"]);
          $user->setProfile($_POST["profile"]);
          $user->setDni($_POST["dni"]);
          $user->setUsername($_POST["username"]);
          $user->setName($_POST["name"]);
          $user->setSurname($_POST["surname"]);
          $user->setFechaNac($_POST["fecha_nac"]);
          $user->setDireccion($_POST["direccion"]);
          $user->setComentario($_POST["comentario"]);
          $user->setNumCuenta($_POST["num_cuenta"]);
          $user->setTipoContrato($_POST["tipo_contrato"]);
          $user->setEmail($_POST["email"]);
          $user->setFoto($_FILES["foto"]["name"]);
          if($_POST["activo"] == Yes){
            $user->setActivo(TRUE);
          }
          else{
            $user->setActivo(FALSE);
          }
          $user->setPasswd($_POST["passwd"]);

            try {
              if(!$this->userMapper->dniExists($_POST["dni"])){
                if (!$this->userMapper->usernameExists($_POST["username"])){
                    $user->checkIsValidForCreate();
                    $this->userMapper->insert($user);
                    $this->view->setFlash(sprintf(i18n("User \"%s\" successfully added."),$user->getUsername()));
                    $this->view->redirect("user", "show");
                } else {
                    $errors = array();
	                  $errors["general"] = "Username already exists";
	                  $this->view->setVariable("errors", $errors);
                }
              } else {
                $errors = array();
                $errors["general"] = "DNI already exists";
                $this->view->setVariable("errors", $errors);
              }
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $profileMapper = new PROFILE_Model();
        $profiles = $profileMapper->fetch_all();
        $this->view->setVariable("user", $user);
        $this->view->setVariable("profiles", $profiles);
        $this->view->render("user", "USER_ADD_Vista");
    }


    public function update() {
        if (!$this->checkPerms->check($this->currentUserId, $this->currentUserProfile, "user", "update")) {
            $this->view->setFlash(sprintf(i18n("You don't have permissions here.")));
            $this->view->redirect("user", "login");
        }
        
        if (!isset($_REQUEST["id"])) {
            throw new Exception("An user id is mandatory");
        }

        $userid = $_REQUEST["id"];
        $user = $this->userMapper->fetch($userid);

        if ($user == NULL) {
            throw new Exception("no such user with id: ".$userid);
        }

        if (isset($_POST["submit"])) {

		  $image_name = $_FILES["foto"]["name"];
          $image_type = $_FILES["foto"]["type"];
          $image_size = $_FILES["foto"]["size"];
          $folder = $_SERVER['DOCUMENT_ROOT'] . '/IUA/pictures/';

          if($image_size < 100000000 ){ /*100MB*/
            if($image_type == "image/jpeg" || $image_type == "image/jpg" || $image_type == "image/png" || $image_type == "image/gif"){
            move_uploaded_file($_FILES["foto"]["tmp_name"], $folder.$image_name);
            }else{
              $errors = array();
              $errors["general"] = "Only formats: jpg/jpeg/png/gif";
              $this->view->setVariable("errors", $errors);
            }
          } else {
          $errors = array();
          $errors["general"] = "Image too large";
          $this->view->setVariable("errors", $errors);
        }

          $user->setProfile($_POST["profile"]);
          $user->setDni($_POST["dni"]);
          $user->setUsername($_POST["username"]);
          $user->setName($_POST["name"]);
          $user->setSurname($_POST["surname"]);
          $user->setFechaNac($_POST["fecha_nac"]);
          $user->setDireccion($_POST["direccion"]);
          $user->setComentario($_POST["comentario"]);
          $user->setNumCuenta($_POST["num_cuenta"]);
          $user->setTipoContrato($_POST["tipo_contrato"]);
          $user->setEmail($_POST["email"]);
          $user->setFoto($_FILES["foto"]["name"]);
          if($_POST["activo"] == Yes){
            $user->setActivo(TRUE);
          }
          else{
            $user->setActivo(FALSE);
          }
          $user->setPasswd($_POST["passwd"]);

            try {
                if ($user->getUsername() == $_POST["username"]){
                    $user->checkIsValidForCreate();
                    $this->userMapper->update($user);
                    $this->view->setFlash(sprintf(i18n("User \"%s\" successfully updated."),$user->getUsername()));
                    $this->view->redirect("user", "show");
                } else {
                  if(!$this->userMapper->dniExists($_POST["dni"])){
                     if (!$this->userMapper->usernameExists($_POST["username"])){
                      $user->setUsername($_POST["username"]);
                      $user->checkIsValidForCreate();
                      $this->userMapper->update($user);
                      $this->view->setFlash(sprintf(i18n("User \"%s\" successfully updated."),$user->getUsername()));
                      $this->view->redirect("user", "show");
                     } else {
                        $errors = array();
      	                $errors["general"] = "Username already exists";
      	                $this->view->setVariable("errors", $errors);
                    }
                  } else{
                    $errors = array();
                    $errors["general"] = "DNI already exists";
                    $this->view->setVariable("errors", $errors);
                  }
              }
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $profileMapper = new PROFILE_Model();
        $profiles = $profileMapper->fetch_all();
        $this->view->setVariable("user", $user);
        $this->view->setVariable("profiles", $profiles);
        $this->view->render("user", "USER_UPDATE_Vista");
    }

    public function delete() {
        if (!$this->checkPerms->check($this->currentUserId, $this->currentUserProfile, "user", "delete")) {
            $this->view->setFlash(sprintf(i18n("You don't have permissions here.")));
            $this->view->redirect("user", "login");
        }
        
        if (!isset($_REQUEST["id"])) {
            throw new Exception("id is mandatory");
        }

        //CheckPermissionNeed

        $userid = $_REQUEST["id"];
        $user = $this->userMapper->fetch($userid);

        if ($user == NULL) {
            throw new Exception("no such user with id: ".$userid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->userMapper->delete($user);
                $this->view->setFlash(sprintf(i18n("User \"%s\" successfully deleted."),$user->getUsername()));
            }
            $this->view->redirect("user", "show");
        }
        $this->view->setVariable("user", $user);
        $this->view->render("user", "USER_DELETE_Vista");
    }

    public function logout() {
        session_destroy();
        $this->view->redirect("user", "login");
    }

}
