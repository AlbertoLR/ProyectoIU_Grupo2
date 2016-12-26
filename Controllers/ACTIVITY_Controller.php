<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Activity.php");
require_once(__DIR__."/../Models/ACTIVITY_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class ACTIVITY_Controller extends BaseController {

    private $activityMapper;

    public function __construct() {
        parent::__construct();
        $this->activityMapper = new ACTIVITY_Model();
        $this->view->setLayout("default");
    }

    public function show(){
        $this->checkPerms("activity", "show", $this->currentUserId);

        $activitys = $this->activityMapper->fetch_all();
        $this->view->setVariable("activitys", $activitys);
        $this->view->render("activity", "ACTIVITY_SHOW_Vista");
    }

    public function showone(){
        $this->checkPerms("activity", "showone", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An activity id is mandatory"));
        }

        $activityid = $_REQUEST["id"];
        $activity = $this->activityMapper->fetch($activityid);
        $spaces = $this->activityMapper->fetchSpaces();
        $discounts = $this->activityMapper->fetchDiscounts();
        $categories = $this->activityMapper->fetchCategories();

        if ($activity == NULL) {
            throw new Exception(i18n("No such activity with id: ").$activityid);
        }
        $this->view->setVariable("categories", $categories);
        $this->view->setVariable("spaces", $spaces);
        $this->view->setVariable("discounts", $discounts);
        $this->view->setVariable("activity", $activity);
        $this->view->render("activity", "ACTIVITY_SHOWONE_Vista");
    }

    public function add(){
        $this->checkPerms("activity", "add", $this->currentUserId);

        $activity = new Activity();
        $spaces = $this->activityMapper->fetchSpaces();
        $discounts = $this->activityMapper->fetchDiscounts();
        $categories = $this->activityMapper->fetchCategories();

        if (isset($_POST["submit"])) {

            $activity->setActivityName($_POST["name"]);
            $activity->setCapacity($_POST["capacity"]);
            $activity->setPrice($_POST["price"]);
            $activity->setDiscountid($_POST["discounts"]);
            $activity->setSpaceid($_POST["spaces"]);
            $activity->setCategoryid($_POST["categories"]);
            $activity->setExtraDiscount($_POST["extra"]);

            try {
                if (!$this->activityMapper->nameExists($_POST["name"])){
                    $activity->checkIsValidForCreate();
                    $this->activityMapper->insert($activity);

                    $this->view->setFlash(sprintf(i18n("Activity \"%s\" successfully added."), $activity->getActivityName()));
                    $this->view->redirect("activity", "show");
                } else {
                    $errors = array();
	                $errors["general"] = i18n("Activity already exists");
	                $this->view->setVariable("errors", $errors);
                }

            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        $this->view->setVariable("categories", $categories);
        $this->view->setVariable("spaces", $spaces);
        $this->view->setVariable("discounts", $discounts);
        $this->view->setVariable("activity", $activity);
        $this->view->render("activity", "ACTIVITY_ADD_Vista");
    }


    public function edit() {
        $this->checkPerms("activity", "edit", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An activity id is mandatory"));
        }

        $activityid = $_REQUEST["id"];
        $activity = $this->activityMapper->fetch($activityid);
        $spaces = $this->activityMapper->fetchSpaces();
        $discounts = $this->activityMapper->fetchDiscounts();
        $categories = $this->activityMapper->fetchCategories();

        if ($activity == NULL) {
            throw new Exception(i18n("No such activity with id: ").$activityid);
        }

        if (isset($_POST["submit"])) {
          $activity->setActivityName($_POST["name"]);
          $activity->setCapacity($_POST["capacity"]);
          $activity->setPrice($_POST["price"]);
          $activity->setDiscountid($_POST["discounts"]);
          $activity->setSpaceid($_POST["spaces"]);
          $activity->setCategoryid($_POST["categories"]);
          $activity->setExtraDiscount($_POST["extra"]);

            try {
                if (!$this->activityMapper->nameExistsUpdate($_POST["name"],$activityid)){
                    $activity->checkIsValidForCreate();
                    $this->activityMapper->update($activity);
                    $this->view->setFlash(sprintf(i18n("Activity \"%s\" successfully updated."), $activity->getActivityName()));
                    $this->view->redirect("activity", "show");
                } else {
                    $errors = array();
	                $errors["general"] = i18n("Activity already exists");
	                $this->view->setVariable("errors", $errors);
                }
            } catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        $this->view->setVariable("categories", $categories);
        $this->view->setVariable("spaces", $spaces);
        $this->view->setVariable("discounts", $discounts);
        $this->view->setVariable("activity", $activity);
        $this->view->render("activity", "ACTIVITY_EDIT_Vista");
    }

    public function delete() {
        $this->checkPerms("activity", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $activityid = $_REQUEST["id"];
        $activity = $this->activityMapper->fetch($activityid);
        $spaces = $this->activityMapper->fetchSpaces();
        $discounts = $this->activityMapper->fetchDiscounts();
        $categories = $this->activityMapper->fetchCategories();

        if ($activity == NULL) {
            throw new Exception(i18n("No such activity with id: ").$activityid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->activityMapper->delete($activity);
                $this->view->setFlash(sprintf(i18n("Activity \"%s\" successfully deleted."), $activity->getActivityName()));
            }
            $this->view->redirect("activity", "show");
        }
        $this->view->setVariable("categories", $categories);
        $this->view->setVariable("spaces", $spaces);
        $this->view->setVariable("discounts", $discounts);
        $this->view->setVariable("activity", $activity);
        $this->view->render("activity", "ACTIVITY_DELETE_Vista");
    }

}
