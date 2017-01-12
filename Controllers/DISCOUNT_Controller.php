<?php
require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../Models/Discount.php");

require_once(__DIR__."/../Models/DISCOUNT_Model.php");

require_once(__DIR__."/../Controllers/BaseController.php");

class DISCOUNT_Controller extends BaseController {

    private $discountMapper;
	
	
    public function __construct() {
	
        parent::__construct();
		
        $this->discountMapper = new DISCOUNT_Model();
		
        $this->view->setLayout("default");
		
    }
    public function show(){
	
        $this->checkPerms("discount", "show", $this->currentUserId);
		
        $discounts = $this->discountMapper->fetch_all();
		
        $this->view->setVariable("discount", $discounts);
		
        $this->view->render("discount", "DISCOUNT_SHOW_Vista");
    }
	
    public function showone(){
	
        $this->checkPerms("discount", "showone", $this->currentUserId);
        if (!isset($_REQUEST["id"])) {
		
            throw new Exception(i18n("A discount id is mandatory"));
			
        }
		
        $discountid = $_REQUEST["id"];
		
        $discount = $this->discountMapper->fetch($discountid);
		
        $categories = $this->discountMapper->fetchCategories();
		
        if ($discount == NULL) {
		
            throw new Exception(i18n("No such discount with id: ").$discountid);
			
        }
		
        $this->view->setVariable("categories", $categories);
		
        $this->view->setVariable("discount", $discount);
		
        $this->view->render("discount", "DISCOUNT_SHOWONE_Vista");
		
    }
	
    public function add(){
	
        $this->checkPerms("discount", "add", $this->currentUserId);
		
        $discount = new Discount();
		
        $categories = $this->discountMapper->fetchCategories();
		
        if (isset($_POST["submit"])) {
		
            $discount->setDiscountDescription($_POST["description"]);

            $discount->setQuantity($_POST["quantity"]);
			
            $discount->setCategoryid($_POST["categories"]);
			
            try {
			
                if (!$this->discountMapper->descriptionExists($_POST["description"])){
				
                    $discount->checkIsValidForCreate();
					
                    $this->discountMapper->insert($discount);
					
                    $this->view->setFlash(sprintf(i18n("Discount \"%s\" successfully added."), $discount->getDiscountDescription()));
					
                    $this->view->redirect("discount", "show");
					
                } else {
				
                    $errors = array();
					
	                $errors["general"] = i18n("Discount already exists");
					
	                $this->view->setVariable("errors", $errors);
					
                }
				
            }catch(ValidationException $ex) {
			
                $errors = $ex->getErrors();
				
                $this->view->setVariable("errors", $errors);
				
            }
        }
        $this->view->setVariable("categories", $categories);
  
        $this->view->render("discount", "DISCOUNT_ADD_Vista");
    }
	
    public function edit() {
	
        $this->checkPerms("discount", "edit", $this->currentUserId);
		
        if (!isset($_REQUEST["id"])) {
		
            throw new Exception(i18n("A discount id is mandatory"));
			
        }
		
        $discountid = $_REQUEST["id"];
		
        $discount = $this->discountMapper->fetch($discountid);
		
        $categories = $this->discountMapper->fetchCategories();
		
        if ($discount == NULL) {
		
            throw new Exception(i18n("No such discount with id: ").$discountid);
			
        }
		
        if (isset($_POST["submit"])) {
		
          $discount->setDiscountDescription($_POST["description"]);
		  
          $discount->setQuantity ($_POST["quantity"]);
		  
          $discount->setCategoryid($_POST["categories"]);
		  
            try {
                if (!$this->discountMapper->descriptionExistsUpdate($_POST["description"],$discountid)){
				
                    $discount->checkIsValidForCreate();
					
                    $this->discountMapper->update($discount);
					
                    $this->view->setFlash(sprintf(i18n("Discount \"%s\" successfully updated."), $discount->getDiscountDescription()));
					
                    $this->view->redirect("discount", "show");
					
                } else {
				
                    $errors = array();
					
	                $errors["general"] = i18n("Discount already exists");
					
	                $this->view->setVariable("errors", $errors);
                }
				
            } catch(ValidationException $ex) {
			
                $errors = $ex->getErrors();
				
                $this->view->setVariable("errors", $errors);
				
            }
        }
		
        $this->view->setVariable("categories", $categories);
		
        $this->view->setVariable("discount", $discount);
		
        $this->view->render("discount", "DISCOUNT_EDIT_VISTA");
		
    }
    public function delete() {
	
        $this->checkPerms("discount", "delete", $this->currentUserId);
		
        if (!isset($_REQUEST["id"])) {
		
            throw new Exception(i18n("Id is mandatory"));
			
        }
		
        $discountid = $_REQUEST["id"];
		
        $discount = $this->discountMapper->fetch($discountid);
		
        $categories = $this->discountMapper->fetchCategories();
		
        if ($discount == NULL) {
		
            throw new Exception(i18n("No such discount with id: ").$discountid);
			
        }
		
        if (isset($_POST["submit"])) {
		
            if ($_POST["submit"] == "yes"){
			
                $this->discountMapper->delete($discount);
				
                $this->view->setFlash(sprintf(i18n("Discount \"%s\" successfully deleted."), $discount->getDiscountDescription()));
            }
			
            $this->view->redirect("discount", "show");
			
        }
		
        $this->view->setVariable("categories", $categories);
		
        $this->view->setVariable("discount", $discount);
		
        $this->view->render("discount", "DISCOUNT_DELETE_VISTA");
		
    }
    public function inscriptions() {
	
        $this->checkPerms("discount", "show", $this->currentUserId);
		
        if (!isset($_REQUEST["id"])) {
		
            throw new Exception(i18n("Id is mandatory"));
			
        }
		
        $discountid = $_REQUEST["id"];
		
        $discount = $this->discountMapper->fetch($discountid);
		
        $inscriptions= $this->discountMapper->fetch_inscriptions($discountid);
		
        $this->view->setVariable("discount", $discount);
		
        $this->view->setVariable("inscriptions", $inscriptions);
		
        $this->view->render("discount", "Discount_INSCRIPTION_Vista");
		
    }
	
}