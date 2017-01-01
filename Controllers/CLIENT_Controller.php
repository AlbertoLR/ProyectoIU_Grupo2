<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Client.php");
require_once(__DIR__."/../Models/CLIENT_Model.php");
require_once(__DIR__."/../Models/Profile.php");
require_once(__DIR__."/../Models/PROFILE_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class CLIENT_Controller extends BaseController {

    private $clientMapper;

    public function __construct() {
        parent::__construct();
        $this->clientMapper = new CLIENT_Model();
        $this->view->setLayout("default");
    }

    public function show(){
        $this->checkPerms("client", "show", $this->currentUserId);

        $clients = $this->clientMapper->fetch_all();
        $clients_json = json_encode($this->clients_to_json($clients));
        $this->view->setVariable("clients", $clients);
        $this->view->setVariable("clients_json", $clients_json);
        $this->view->render("client", "CLIENT_SHOW_Vista");
    }

    //Esta accion valida os mesmos permisos que show, parece loxico
    public function showdeleted(){
        $this->checkPerms("client", "show", $this->currentUserId);

        $clients = $this->clientMapper->fetch_all(0);
        $this->view->setVariable("clients", $clients);
        $this->view->render("client", "CLIENT_SHOWDELETED_Vista");
    }

    public function showone(){
        $this->checkPerms("client", "showone", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A client id is mandatory"));
        }

        $clientid = $_REQUEST["id"];
        $client = $this->clientMapper->fetch($clientid);
        $injuries = $this->clientMapper->fetch_injuries();

        if ($client == NULL) {
            throw new Exception(i18n("No such client with id: ").$clientid);
        }

        $this->view->setVariable("injuries", $injuries);
        $this->view->setVariable("client", $client);
        $this->view->render("client", "CLIENT_SHOWONE_Vista");
    }

    public function add(){
        $this->checkPerms("client", "add", $this->currentUserId);

        $client = new Client();
        $injuries = $this->clientMapper->fetch_injuries();

        if (isset($_POST["submit"])) {

		      $image_name = $_FILES["photo"]["name"];
          $image_type = $_FILES["photo"]["type"];
          $image_size = $_FILES["photo"]["size"];
          $folder = __DIR__ . '/../pictures/';

          if($image_size < 100000000 ){ /*100MB*/
            if($image_type == ("image/jpeg" || $image_type == "image/jpg" || $image_type == "image/png" || $image_type == "image/gif")){
            move_uploaded_file($_FILES["photo"]["tmp_name"], $folder.$image_name);
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

          $client->setDni($_POST["dni"]);
          $client->setName($_POST["name"]);
          $client->setSurname($_POST["surname"]);
          $client->setBirthday($_POST["birthdate"]);
          $client->setProfession($_POST["profession"]);
          $client->setPhone($_POST["phone"]);
          $client->setAddress($_POST["address"]);
          $client->setComment($_POST["comment"]);
          $client->setEmail($_POST["email"]);
          $client->setAccount($_POST["account"]);
          $client->setInjury($_POST["injury"]);
          $client->setPhoto($_FILES["photo"]["name"]);
          if($_POST["alert"] == "Yes"){
            $client->setAlert(TRUE);
          }
          else{
            $client->setAlert(FALSE);
          }
          if($_POST["unemployed"] == "Yes"){
            $client->setUnemPloyed(TRUE);
          }
          else{
            $client->setUnemPloyed(FALSE);
          }
          if($_POST["student"] == "Yes"){
            $client->setStudent(TRUE);
          }
          else{
            $client->setStudent(FALSE);
          }
          if($_POST["family"] == "Yes"){
            $client->setFamily(TRUE);
          }
          else{
            $client->setFamily(FALSE);
          }
          if($_POST["active"] == "Yes"){
            $client->setActive(TRUE);
          }
          else{
            $client->setActive(FALSE);
          }

            try {
                if(!$this->clientMapper->dniExists($_POST["dni"]) && !empty($_POST["dni"])){
                    $client->checkIsValidForCreate();
                    $this->clientMapper->insert($client, $this->currentUserId);
                    $this->view->setFlash(sprintf(i18n("Client \"%s\" successfully added."),$client->getName()));
                    $this->view->redirect("client", "show");

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

        $this->view->setVariable("injuries", $injuries);
        $this->view->setVariable("client", $client);
        $this->view->render("client", "CLIENT_ADD_Vista");
    }

    public function edit() {
        $this->checkPerms("client", "edit", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A client id is mandatory"));
        }

        $clientid = $_REQUEST["id"];

        $client = $this->clientMapper->fetch($clientid);
        $injuries = $this->clientMapper->fetch_injuries();

        if ($client == NULL) {
            throw new Exception(i18n("No such client with id: ").$clientid);
        }

        if (isset($_POST["submit"])) {
		      $image_name = $_FILES["photo"]["name"];
          $image_type = $_FILES["photo"]["type"];
          $image_size = $_FILES["photo"]["size"];
          $folder = __DIR__ . '/../pictures/';
          if($image_size < 100000000 ){ /*100MB*/
            if($image_type == ("image/jpeg" || $image_type == "image/jpg" || $image_type == "image/png" || $image_type == "image/gif")){
            move_uploaded_file($_FILES["photo"]["tmp_name"], $folder.$image_name);
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

        $client->setDni($_POST["dni"]);
        $client->setName($_POST["name"]);
        $client->setSurname($_POST["surname"]);
        $client->setBirthday($_POST["birthdate"]);
        $client->setProfession($_POST["profession"]);
        $client->setPhone($_POST["phone"]);
        $client->setAddress($_POST["address"]);
        $client->setComment($_POST["comment"]);
        $client->setEmail($_POST["email"]);
        $client->setInjury($_POST["injury"]);
        $client->setAccount($_POST["account"]);
        if($_FILES["photo"]["name"]){
          $client->setPhoto($_FILES["photo"]["name"]);
        }else{
            $client->setPhoto($client->getPhoto());
        }

        if($_POST["alert"] == "Yes"){
          $client->setAlert(TRUE);
        }
        else{
          $client->setAlert(FALSE);
        }
        if($_POST["unemployed"] == "Yes"){
          $client->setUnemPloyed(TRUE);
        }
        else{
          $client->setUnemPloyed(FALSE);
        }
        if($_POST["student"] == "Yes"){
          $client->setStudent(TRUE);
        }
        else{
          $client->setStudent(FALSE);
        }
        if($_POST["family"] == "Yes"){
          $client->setFamily(TRUE);
        }
        else{
          $client->setFamily(FALSE);
        }
        if($_POST["active"] == "Yes"){
          $client->setActive(TRUE);
        }
        else{
          $client->setActive(FALSE);
        }
        try {

            if($client->getDni()==$_POST["dni"]){
                $client->checkIsValidForCreate();
                $this->clientMapper->update($client, $this->currentUserId);
                $this->view->setFlash(sprintf(i18n("Client \"%s\" successfully updated."),$client->getName()));
                $this->view->redirect("client", "show");

            } else{
              if(!$this->clientMapper->dniExists($_POST["dni"])){
                $client->checkIsValidForCreate();
                $this->clientMapper->update($client, $this->currentUserId);
                $this->view->setFlash(sprintf(i18n("Client \"%s\" successfully updated."),$client->getName()));
                $this->view->redirect("client", "show");
              }
              else {
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

        $this->view->setVariable("injuries", $injuries);
        $this->view->setVariable("client", $client);
        $this->view->render("client", "CLIENT_EDIT_Vista");
    }

    public function delete() {
        $this->checkPerms("client", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $clientid = $_REQUEST["id"];
        $client = $this->clientMapper->fetch($clientid);
        $injuries = $this->clientMapper->fetch_injuries();

        if ($client == NULL) {
            throw new Exception(i18n("No such client with id: ").$clientid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->clientMapper->delete($client);
                $this->view->setFlash(sprintf(i18n("Client \"%s\" successfully deleted."),$client->getName()));
            }
            $this->view->redirect("client", "show");
        }

        $this->view->setVariable("injuries", $injuries);
        $this->view->setVariable("client", $client);
        $this->view->render("client", "CLIENT_DELETE_Vista");
    }

    //Para recuperar un usuario dado de baixa previamente
    //checkeanse mesmos permisos que delete
    public function recovery() {
        $this->checkPerms("client", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $clientid = $_REQUEST["id"];
        $client = $this->clientMapper->fetch($clientid);

        if ($client == NULL) {
            throw new Exception(i18n("No such client with id: ").$clientid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){

            }

        }

        $this->clientMapper->recovery($client);
        $this->view->setFlash(sprintf(i18n("Client \"%s\" successfully restored."),$client->getName()));
        $this->view->redirect("client", "show");
    }

    private function clients_to_json($clients){
        $clients_json = array();

        foreach ($clients as $client){
            $aux = array();
            $aux['id'] = $client->getID();
            $aux['nombre_c'] = $client->getName();
            $aux['dni_c'] = $client->getDNI();
            $aux['apellidos_c'] = $client-> getSurname();
            $clients_json[] = $aux;
        }

        return $clients_json;
    }

    private function client_controllers($clientid){
        return $this->checkPerms->client_controllers($clientid);
    }

    public function inscriptions() {
        $this->checkPerms("client", "show", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $clientid = $_REQUEST["id"];
        $inscriptions= $this->clientMapper->fetch_inscriptions($clientid);
        $client = $this->clientMapper->fetch($clientid);

        $this->view->setVariable("client", $client);
        $this->view->setVariable("inscriptions", $inscriptions);
        $this->view->render("client", "CLIENT_INSCRIPTION_Vista");
    }

    public function injuries() {
      $array_date=getDate();
      $date=$array_date['year']."-".$array_date['mon']."-".$array_date['mday'];
      $time=$array_date['hours'].":".$array_date['minutes'].":".$array_date['seconds'];
      $go=false;
      if (!isset($_REQUEST["id"])) {
          throw new Exception(i18n("Id is mandatory"));
      }
      $clientid = $_REQUEST["id"];
      $injuries = $this->clientMapper->fetch_client_injuries($clientid);
        foreach($injuries as $injury => $value){
          if($value["user_id"]==$this->currentUserId ){
            $go=true;
          }
        }

        if($go){
          $data ="ID usuario:".$this->currentUserId."-----ID cliente:".$clientid."-----Fecha:".$date."-----Hora:".$time."-----GRANTED ACCESS" .PHP_EOL ;
          $fp = fopen(__DIR__ . '/../documents/injury_logs.txt', "a");
          fwrite($fp,$data);
          fclose($fp);
          $this->view->setVariable("injuries", $injuries);
          $this->view->render("client", "CLIENT_INJURIES_Vista");
        } else{
            $data ="ID usuario:".$this->currentUserId."-----ID cliente:".$clientid."-----Fecha:".$date."-----Hora:".$time."-----DENIED ACCESS" .PHP_EOL ;
            $fp = fopen(__DIR__ . '/../documents/injury_logs.txt', "a");
            fwrite($fp,$data);
            fclose($fp);
            $this->view->setFlash(sprintf(i18n("You don`t have permissions here")));
            $this->view->redirect("client", "show");
        }

  }
}
