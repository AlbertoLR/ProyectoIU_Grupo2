<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/User.php");
require_once(__DIR__."/../Models/USER_Model.php");
require_once(__DIR__."/../Models/Profile.php");
require_once(__DIR__."/../Models/PROFILE_Model.php");
require_once(__DIR__."/../Models/Session.php");
require_once(__DIR__."/../Models/SESSION_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class USER_Controller extends BaseController {

    private $userMapper;

    public function __construct() {
        parent::__construct();
        $this->sessionMapper = new SESSION_Model();
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
        $sessions = $this->sessionMapper->fetch_all();
        $hours = $this->sessionMapper->fetch_hours();
        $activities = $this->sessionMapper->fetch_activities();
        $events = $this->sessionMapper->fetch_events();
        $users = $this->sessionMapper->fetch_users();
        $spaces = $this->sessionMapper->fetch_spaces();

        if (isset($_POST["wk"])){
            $week=$_POST["wk"];
        }else{
          $array_date = getDate();
          $date=$array_date['year']."-".$array_date['mon']."-".$array_date['mday'];
          $week = date('W', strtotime($date));
        }

        $days1 = $this->userMapper->get_day($sessions,$hours,$activities,$events,$users,$spaces,"Monday", $week);
        $days2 = $this->userMapper->get_day($sessions,$hours,$activities,$events,$users,$spaces,"Tuesday", $week);
        $days3 = $this->userMapper->get_day($sessions,$hours,$activities,$events,$users,$spaces,"Wednesday",$week);
        $days4 = $this->userMapper->get_day($sessions,$hours,$activities,$events,$users,$spaces,"Thursday", $week);
        $days5 = $this->userMapper->get_day($sessions,$hours,$activities,$events,$users,$spaces,"Friday", $week);

        $this->view->setVariable("days1", $days1);
        $this->view->setVariable("days2", $days2);
        $this->view->setVariable("days3", $days3);
        $this->view->setVariable("days4", $days4);
        $this->view->setVariable("days5", $days5);
        $this->view->setVariable("week", $week);

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
          $folder = __DIR__ . '/../pictures/';

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
          $user->setInjury($_POST["injury"]);
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
        $injuries = $this->userMapper->fetch_injuries();

        $this->view->setVariable("injuries", $injuries);
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
            $folder = __DIR__ . '/../pictures/';
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
          $user->setName($_POST["name"]);
          $user->setSurname($_POST["surname"]);
          $user->setFechaNac($_POST["fecha_nac"]);
          $user->setDireccion($_POST["direccion"]);
          $user->setComentario($_POST["comentario"]);
          $user->setNumCuenta($_POST["num_cuenta"]);
          $user->setTipoContrato($_POST["tipo_contrato"]);
          $user->setEmail($_POST["email"]);
          $user->setInjury($_POST["injury"]);
          if($_FILES["foto"]["name"]){
            $user->setFoto($_FILES["foto"]["name"]);
          }else{
              $user->setFoto($user->getFoto());
          }
          if($_POST["activo"] == "Yes") {
            $user->setActivo(TRUE);
          } else {
            $user->setActivo(FALSE);
          }

          $user->setPasswd($_POST["passwd"]);

            try {
                if ($user->getUsername() == $_POST["username"] && $user->getDni() == $_POST["dni"]) {
                    $user->checkIsValidForCreate();
                    $this->userMapper->update($user);
                    $this->view->setFlash(sprintf(i18n("User \"%s\" successfully updated."),$user->getUsername()));
                    $this->view->redirect("user", "show");
                } else if ($user->getUsername() == $_POST["username"] && $user->getDni() != $_POST["dni"]) {
                    if(!$this->userMapper->dniExists($_POST["dni"]) && !empty($_POST["dni"])) {
                        $user->setDni($_POST["dni"]);
                        $user->checkIsValidForCreate();
                        $this->userMapper->update($user);
                        $this->view->setFlash(sprintf(i18n("User \"%s\" successfully updated."),$user->getUsername()));
                        $this->view->redirect("user", "show");
                    } else {
                        $errors = array();
                        $errors["general"] = i18n("DNI already exists or NULL");
                        $this->view->setVariable("errors", $errors);
                    }
                } else if ($user->getUsername() != $_POST["username"] && $user->getDni() == $_POST["dni"]) {
                    if(!$this->userMapper->usernameExists($_POST["username"]) && !empty($_POST["username"])) {
                        $user->setUsername($_POST["username"]);
                        $user->checkIsValidForCreate();
                        $this->userMapper->update($user);
                        $this->view->setFlash(sprintf(i18n("User \"%s\" successfully updated."),$user->getUsername()));
                        $this->view->redirect("user", "show");
                    } else {
                        $errors = array();
                        $errors["general"] = i18n("Username already exists or NULL");
                        $this->view->setVariable("errors", $errors);
                    }
                } else if(!$this->userMapper->dniExists($_POST["dni"]) && !empty($_POST["dni"])) {
                    if (!$this->userMapper->usernameExists($_POST["username"] && !empty($_POST["username"]))){
                        $user->setDni($_POST["dni"]);
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
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        $profileMapper = new PROFILE_Model();
        $profiles = $profileMapper->fetch_all();
        $injuries = $this->userMapper->fetch_injuries();

        $this->view->setVariable("injuries", $injuries);
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
        $this->view->setFlash(sprintf(i18n("User \"%s\" successfully restored."),$user->getUsername()));
        $this->view->redirect("user", "show");
    }

    public function logout() {
        session_destroy();
        $this->view->redirect("user", "login");
    }

    public function search() {
        $this->checkPerms("user", "show", $this->currentUserId);

        if (isset($_POST["submit"])) {
            $query = "";
            $flag = 0;

            if ($_POST["dni"]){
                $query .= "dni='". $_POST["dni"]."'";
                $flag = 1;
            }

            if ($_POST["username"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "username LIKE '%". $_POST["username"] ."%'";
                $flag = 1;
            }

            if ($_POST["profile"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "profile='". $_POST["profile"]."'";
                $flag = 1;
            }

            if ($_POST["name"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "name LIKE '%". $_POST["name"] ."%'";
                $flag = 1;
            }

            if ($_POST["surname"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "surname LIKE '%". $_POST["surname"] ."%'";
                $flag = 1;
            }

            if ($_POST["tipo_contrato"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "tipo_contrato='". $_POST["tipo_contrato"] ."'";
                $flag = 1;
            }

            if ($_POST["email"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "email LIKE '%". $_POST["email"] ."%'";
            }
            if (empty($query)) {
                $users = $this->userMapper->fetch_all();
            } else {
                $users = $this->userMapper->search($query);
            }
            $this->view->setVariable("users", $users);
            $this->view->render("user", "USER_SHOW_Vista");
        }
        else {
            $profileMapper = new PROFILE_Model();
            $profiles = $profileMapper->fetch_all();
            $this->view->setVariable("profiles", $profiles);
            $this->view->render("user", "USER_SEARCH_Vista");
        }
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

    public function injuries() {
      $array_date=getDate();
      $date=$array_date['year']."-".$array_date['mon']."-".$array_date['mday'];
      $time=$array_date['hours'].":".$array_date['minutes'].":".$array_date['seconds'];
      $go=false;
      if (!isset($_REQUEST["id"])) {
          throw new Exception(i18n("Id is mandatory"));
      }
      $userid = $_REQUEST["id"];
      $user = $this->userMapper->fetch($this->currentUserId);
      $injuries = $this->userMapper->fetch_user_injuries($userid);


      foreach ($injuries as $key => $value) {
        if($value["user_id"]==$this->currentUserId || $user->getProfile()=="admin" ){
          $go=true;

          }
      }


        if($go){
          $data ="(INJURY MONITOR ACCESS) ID user:".$this->currentUserId."-----Date:".$date."-----Time:".$time."-----GRANTED ACCESS" .PHP_EOL ;
          $fp = fopen(__DIR__ . '/../documents/injury_logs.txt', "a");
          fwrite($fp,$data);
          fclose($fp);
          $this->view->setVariable("injuries", $injuries);
          $this->view->render("user", "USER_INJURIES_Vista");
        } else{
            $data ="(INJURY MONITOR ACCESS) ID user:".$this->currentUserId."-----Date:".$date."-----Time:".$time."-----DENIED ACCESS" .PHP_EOL ;
            $fp = fopen(__DIR__ . '/../documents/injury_logs.txt', "a");
            fwrite($fp,$data);
            fclose($fp);
            $this->view->setFlash(sprintf(i18n("You don`t have permissions here")));
            $this->view->redirect("user", "show");
        }

  }
      public function discharge() {

        if (isset($_POST["submit"])) {
          $user = $this->userMapper->apply_discharge($_POST["lesion_id"],$_POST["user_id"],$_POST["fecha"]);
          $this->view->redirect("user", "injuries","id=".$_POST["user_id"]);
        }
      }


}
