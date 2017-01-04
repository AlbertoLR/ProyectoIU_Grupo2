<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Category.php");
require_once(__DIR__."/../Models/CATEGORY_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class CATEGORY_Controller extends BaseController {

    private $categoryMapper;

    public function __construct() {
        parent::__construct();
        $this->categoryMapper = new CATEGORY_Model();
        $this->view->setLayout("default");
    }

    public function show(){
        $this->checkPerms("category", "show", $this->currentUserId);

        $categories = $this->categoryMapper->fetch_all();
        $this->view->setVariable("categories", $categories);
        $this->view->render("category", "CATEGORY_SHOW_Vista");
    }

    public function showone(){
        $this->checkPerms("category", "showone", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A category id is mandatory"));
        }

        $categoryid = $_REQUEST["id"];
        $category = $this->categoryMapper->fetch($categoryid);

        if ($category == NULL) {
            throw new Exception(i18n("No such category with id: ").$categoryid);
        }

        $this->view->setVariable("category", $category);
        $this->view->render("category", "CATEGORY_SHOWONE_Vista");
    }

    public function add(){
        $this->checkPerms("category", "add", $this->currentUserId);

        $category = new Category();

        if (isset($_POST["submit"])) {
            $category->setType($_POST["type"]);

            try {
                if (!$this->categoryMapper->nameExists($_POST["type"])){
                    $category->checkIsValidForCreate();
                    $this->categoryMapper->insert($category);

                    $this->view->setFlash(sprintf(i18n("Category \"%s\" successfully added."), $category->getType()));
                    $this->view->redirect("category", "show");
                } else {
                    $errors = array();
	                $errors["general"] = i18n("Category already exists");
	                $this->view->setVariable("errors", $errors);
                }

            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->setVariable("category", $category);
        $this->view->render("category", "CATEGORY_ADD_Vista");
    }


    public function edit() {
        $this->checkPerms("category", "edit", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A category id is mandatory"));
        }

        $categoryid = $_REQUEST["id"];
        $category = $this->categoryMapper->fetch($categoryid);

        if ($category == NULL) {
            throw new Exception(i18n("No such category with id: ").$categoryid);
        }

        if (isset($_POST["submit"])) {
            $category->setType($_POST["type"]);

            try {
                if (!$this->categoryMapper->nameExists($_POST["type"])){
                    $category->checkIsValidForCreate();
                    $this->categoryMapper->update($category);
                    $this->view->setFlash(sprintf(i18n("Category \"%s\" successfully updated."), $category->getType()));
                    $this->view->redirect("category", "show");
                } else {
                    $errors = array();
	                $errors["general"] = i18n("Category already exists");
	                $this->view->setVariable("errors", $errors);
                }
            } catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->setVariable("category", $category);
        $this->view->render("category", "CATEGORY_EDIT_Vista");
    }

    public function delete() {
        $this->checkPerms("category", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $categoryid = $_REQUEST["id"];
        $category = $this->categoryMapper->fetch($categoryid);

        if ($category == NULL) {
            throw new Exception(i18n("No such category with id: ").$categoryid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->categoryMapper->delete($category);
                $this->view->setFlash(sprintf(i18n("Category \"%s\" successfully deleted."), $category->getType()));
            }
            $this->view->redirect("category", "show");
        }
        $this->view->setVariable("category", $category);
        $this->view->render("category", "CATEGORY_DELETE_Vista");
    }

}