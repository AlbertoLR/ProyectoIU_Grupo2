<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../core/Upload.php");
require_once(__DIR__."/../Models/Document.php");
require_once(__DIR__."/../Models/DOCUMENT_Model.php");
require_once(__DIR__."/../Models/User.php");
require_once(__DIR__."/../Models/USER_Model.php");
require_once(__DIR__."/../Models/Client.php");
require_once(__DIR__."/../Models/CLIENT_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class DOCUMENT_Controller extends BaseController {

    private $documentMapper;

    public function __construct() {
        parent::__construct();
        $this->documentMapper = new DOCUMENT_Model();
        $this->view->setLayout("default");
    }

    public function show() {
        $this->checkPerms("document", "show", $this->currentUserId);

        $documents = $this->documentMapper->fetch_all();
        $this->view->setVariable("documents", $documents);
        $this->view->render("document", "DOCUMENT_SHOW_Vista");
    }

    /*
    public function showone(){
        $this->checkPerms("document", "showone", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A document id is mandatory"));
        }

        $documentid = $_REQUEST["id"];
        $document = $this->documentMapper->fetch($documentid);

        if ($document == NULL) {
            throw new Exception(i18n("No such document with id: ").$documentid);
        }

        $this->view->setVariable("document", $document);
        $this->view->render("document", "DOCUMENT_SHOWONE_Vista");
    }
    */

    public function add(){
        $this->checkPerms("document", "add", $this->currentUserId);

        $document = new Document();
        $upload = new Upload();
        
        if (isset($_POST["submit"])) {
            $dni = NULL;
            $dni_c = NULL;

            if ($_POST["dni"] && $_POST["dni_c"]) {
                $this->view->setFlash(sprintf(i18n("You just can choose dni from client or dni from user")));
                $this->view->redirect("document", "show");
            }
            
            if ($_POST["dni"]){
                $dni = $_POST["dni"];
                $document->setDNI($dni);
            }

            if ($_POST["dni_c"]){
                $dni_c = $_POST["dni_c"];
                $document->setDNIC($dni_c);
            }

            $type = $_POST["type"];
            $document->setType($type);
            
            if ($upload->checkFile()){
                $document_name = $_FILES["file"]["name"];
                $document->setDocument($document_name);
            } else {
                $errors = array();
                $errors["general"] = i18n("Error while upload file");
                $this->view->setVariable("errors", $errors);
            }

            try {
                if (!$this->documentMapper->nameExists($dni, $dni_c, $type, $document_location)){
                    $this->documentMapper->insert($document);

                    $this->view->setFlash(sprintf(i18n("Document \"%s\" successfully added."), $document->getDocument()));
                    $this->view->redirect("document", "show");
                } else {
                    $errors = array();
	                $errors["general"] = i18n("Document already exists");
	                $this->view->setVariable("errors", $errors);
                }

            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $user = new USER_Model();
        $client = new CLIENT_Model();
        $this->view->setVariable("users", $user->fetch_all());
        $this->view->setVariable("clients", $client->fetch_all());
        
        $this->view->setVariable("document", $document);
        $this->view->render("document", "DOCUMENT_ADD_Vista");
    }


    public function edit() {
        $this->checkPerms("document", "edit", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A document id is mandatory"));
        }

        $documentid = $_REQUEST["id"];
        $document = $this->documentMapper->fetch($documentid);

        if ($document == NULL) {
            throw new Exception(i18n("No such document with id: ").$documentid);
        }

        if (isset($_POST["submit"])) {

            if ($_POST["dni"] && $_POST["dni_c"]) {
                $this->view->setFlash(sprintf(i18n("You just can choose dni from client or dni from user")));
                    $this->view->redirect("document", "show");
            }
            
            if ($_POST["dni"]){
                $dni = $_POST["dni"];
            } else {
                $dni = $document->getDNI();
            }

            if ($_POST["dni_c"]){
                $dni_c = $_POST["dni_c"];
            } else {
                $dni_c = $document->getDNIC();
            }

            $type = $_POST["type"];

            if ($_POST["file"]){
                if ($upload->checkFile()){
                    $old_file = $document->getDocument();
                    $document_location = $_FILES["file"]["name"];                
                } else {
                    $errors = array();
                    $errors["general"] = i18n("Error while upload file");
                    $this->view->setVariable("errors", $errors);
                }
            } else {
                $document_name = $document->getDocument();
            }

            try {
                if (!$this->documentMapper->nameExists($dni, $dni_c, $type, $document_location)){
                    $document->setDNI($dni);
                    $document->setDNIC($dni_c);
                    $document->setType($type);
                    $document->setDocument($_FILES["file"]["name"]);

                    $this->documentMapper->insert($document);

                    if ($oldfile) {
                        unlink(__DIR__ . "/../files/" . $old_file);
                    }

                    $this->view->setFlash(sprintf(i18n("Document \"%s\" successfully updated."), $document->getDocument()));
                    $this->view->redirect("document", "show");
                } else {
                    $errors = array();
	                $errors["general"] = i18n("Document already exists");
	                $this->view->setVariable("errors", $errors);
                }

            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $user = new USER_Model();
        $client = new CLIENT_Model();
        $this->view->setVariable("users", $user->fetch_all());
        $this->view->setVariable("clients", $client->fetch_all());
        
        $this->view->setVariable("document", $document);
        $this->view->render("document", "DOCUMENT_EDIT_Vista");
    }

    public function delete() {
        $this->checkPerms("document", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $documentid = $_REQUEST["id"];
        $document = $this->documentMapper->fetch($documentid);

        if ($document == NULL) {
            throw new Exception(i18n("No such action with id: ").$documentid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $old_file = $document->getDocument();
                $this->documentMapper->delete($document);
                unlink(__DIR__ . "/../files/" . $old_file);
                
                $this->view->setFlash(sprintf(i18n("Document \"%s\" successfully deleted."), $document->getDocument()));
            }
            $this->view->redirect("document", "show");
        }
        $this->view->setVariable("document", $document);
        $this->view->render("document", "DOCUMENT_DELETE_Vista");
    }

    public function search() {
        
        if (isset($_POST["submit"])) {
            $query = "";
            $flag = 0;

            if ($_POST["dni"]){
                $query .= "dni='". $_POST["dni"]."'";
                $flag = 1;
            }

            if ($_POST["dni_c"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "dni_c LIKE '%". $_POST["dni_c"] ."%'";
                $flag = 1;
            }

            if ($_POST["type"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "tipo='". $_POST["type"]."'";
                $flag = 1;
            }

            if ($_POST["file"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "documento LIKE '%". $_POST["file"] ."%'";
            }

            if (empty($query)) {
                $documents = $this->documentMapper->fetch_all();
            } else {
                $documents = $this->documentMapper->search($query);
            }
            $this->view->setVariable("documents", $documents);
            $this->view->render("document", "DOCUMENT_SHOW_Vista");
        }
        else {

            $user = new USER_Model();
            $client = new CLIENT_Model();
            $this->view->setVariable("users", $user->fetch_all());
            $this->view->setVariable("clients", $client->fetch_all());        
            $this->view->render("document", "DOCUMENT_SEARCH_Vista");
        }
    }

}