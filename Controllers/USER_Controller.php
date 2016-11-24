<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/User.php");
require_once(__DIR__."/../Models/USER_Model.php");
require_once(__DIR__."/../Models/Profile.php");
require_once(__DIR__."/../Models/PROFILE_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

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
                $this->view->redirect("user", "login");
            }else{
                $errors = array();
                $errors["general"] = i18n("Username is not valid");
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->setVariable("user_controllers", $this->user_controllers($this->currentUserId));
        $this->view->render("user", "USER_LOGIN_Vista");
    }

    public function show(){
        $this->checkPerms("user", "show", $this->currentUserId);

        $users = $this->userMapper->fetch_all();
        $users_json = json_encode($this->users_to_json($users));
        $this->view->setVariable("users", $users);
        $this->view->setVariable("users_json", $users_json);
        $this->view->render("user", "USER_SHOW_Vista");
    }

    //Esta accion valida os mesmos permisos que show, parece loxico
    public function showdeleted(){
        $this->checkPerms("user", "show", $this->currentUserId);

        $users = $this->userMapper->fetch_all(0);
        $this->view->setVariable("users", $users);
        $this->view->render("user", "USER_SHOWDELETED_Vista");
    }

    public function showone(){
        $this->checkPerms("user", "showone", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An user id is mandatory"));
        }

        $userid = $_REQUEST["id"];
        $user = $this->userMapper->fetch($userid);

        if ($user == NULL) {
            throw new Exception(i18n("No such user with id: ").$userid);
        }

        $this->view->setVariable("user", $user);
        $this->view->render("user", "USER_SHOWONE_Vista");
    }

    public function add(){
        $this->checkPerms("user", "add", $this->currentUserId);

        $user = new User();

        if (isset($_POST["submit"])) {

		  $image_name = $_FILES["foto"]["name"];
          $image_type = $_FILES["foto"]["type"];
          $image_size = $_FILES["foto"]["size"];
          $folder = $_SERVER['DOCUMENT_ROOT'] . '/pictures/';

          if($image_size < 100000000 ){ /*100MB*/
            if($image_type == ("image/jpeg" || $image_type == "image/jpg" || $image_type == "image/png" || $image_type == "image/gif")){
            move_uploaded_file($_FILES["foto"]["tmp_name"], $folder.$image_name);
            }else{
              $errors = array();
              $errors["general"] = i18n("Only formats: jpg/jpeg/png/gif");
              $this->view->setVariable("errors", $errors);
            }
          } else {
          $errors = array();
          $errors["general"] = i18n("Image too large");
          $this->view->setVariable("errors", $errors);
        }

          $user->setUsername($_POST["username"]);
          if (empty($_POST["profile"])) {
              $user->setProfile(NULL);
          } else {
              $user->setProfile($_POST["profile"]);
          }
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
          if($_POST["activo"] == "Yes"){
            $user->setActivo(TRUE);
          }
          else{
            $user->setActivo(FALSE);
          }
          $user->setPasswd($_POST["passwd"]);

            try {
                if(!$this->userMapper->dniExists($_POST["dni"]) && !empty($_POST["dni"])){
                    if (!$this->userMapper->usernameExists($_POST["username"])){
                        $user->checkIsValidForCreate();
                        $this->userMapper->insert($user);
                        $this->view->setFlash(sprintf(i18n("User \"%s\" successfully added."),$user->getUsername()));
                        $this->view->redirect("user", "show");
                    } else {
                        $errors = array();
                        $errors["general"] = i18n("Username already exists");
                        $this->view->setVariable("errors", $errors);
                    }
                } else {
                    $errors = array();
                    $errors["general"] = i18n("DNI already exists or NULL");
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

    public function edit() {
        $this->checkPerms("user", "edit", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An user id is mandatory"));
        }
        $userid = $_REQUEST["id"];
        $user = $this->userMapper->fetch($userid);
        if ($user == NULL) {
            throw new Exception(i18n("No such user with id: ").$userid);
        }
        if (isset($_POST["submit"])) {
		  $image_name = $_FILES["foto"]["name"];
          $image_type = $_FILES["foto"]["type"];
          $image_size = $_FILES["foto"]["size"];
          $folder = $_SERVER['DOCUMENT_ROOT'] . '/pictures/';
          if($image_size < 100000000 ){ /*100MB*/
            if($image_type == ("image/jpeg" || $image_type == "image/jpg" || $image_type == "image/png" || $image_type == "image/gif")){
            move_uploaded_file($_FILES["foto"]["tmp_name"], $folder.$image_name);
            }else{
              $errors = array();
              $errors["general"] = i18n("Only formats: jpg/jpeg/png/gif");
              $this->view->setVariable("errors", $errors);
            }
          } else {
          $errors = array();
          $errors["general"] =i18n("Image too large");
          $this->view->setVariable("errors", $errors);
        }
          if (empty($_POST["profile"])) {
              $user->setProfile(NULL);
          } else {
              $user->setProfile($_POST["profile"]);
          }
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
          if($_POST["activo"] == "Yes"){
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
                    if(!$this->userMapper->dniExists($_POST["dni"]) && !empty($_POST["dni"])){
                        if (!$this->userMapper->usernameExists($_POST["username"])){
                            $user->setUsername($_POST["username"]);
                            $user->checkIsValidForCreate();
                            $this->userMapper->update($user);
                            $this->view->setFlash(sprintf(i18n("User \"%s\" successfully updated."),$user->getUsername()));
                            $this->view->redirect("user", "show");
                        } else {
                            $errors = array();
                            $errors["general"] = i18n("Username already exists");
                            $this->view->setVariable("errors", $errors);
                        }
                    } else{
                        $errors = array();
                        $errors["general"] = i18n("DNI already exists or NULL");
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
        $this->view->render("user", "USER_EDIT_Vista");
    }

    public function delete() {
        $this->checkPerms("user", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $userid = $_REQUEST["id"];
        $user = $this->userMapper->fetch($userid);

        if ($user == NULL) {
            throw new Exception(i18n("No such user with id: ").$userid);
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

    //Para recuperar un usuario dado de baixa previamente
    //checkeanse mesmos permisos que delete
    public function recovery() {
        $this->checkPerms("user", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $userid = $_REQUEST["id"];
        $user = $this->userMapper->fetch($userid);

        if ($user == NULL) {
            throw new Exception(i18n("No such user with id: ").$userid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){

            }

        }

        $this->userMapper->recovery($user);
        $this->view->setFlash(sprintf(i18n("User \"%s\" successfully deleted."),$user->getUsername()));
        $this->view->redirect("user", "show");
    }

    public function logout() {
        session_destroy();
        $this->view->redirect("user", "login");
    }

    private function users_to_json($users){
        $users_json = array();

        foreach ($users as $user){
            $aux = array();
            $aux['id'] = $user->getID();
            $aux['username'] = $user->getUsername();
            $aux['dni'] = $user->getDNI();
            $aux['profile'] = $user-> getProfile();
            $users_json[] = $aux;
        }

        return $users_json;
    }

    private function user_controllers($userid){
        return $this->checkPerms->user_controllers($userid);
    }

}
