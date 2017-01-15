<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Invoiceline.php");
require_once(__DIR__."/../Models/INVOICELINE_Model.php");
require_once(__DIR__."/../Models/Invoice.php");
require_once(__DIR__."/../Models/INVOICE_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class INVOICELINE_Controller extends BaseController {

    public $invoicelineMapper;

    public function __construct() {
        parent::__construct();
        $this->invoicelineMapper = new INVOICELINE_Model();
        $this->view->setLayout("default");
    }

//consulta//

    public function show(){
        $this->checkPerms("invoiceline", "show", $this->currentUserId);
		$id_factura = $_REQUEST["id"];
        $invoicelines = $this->invoicelineMapper->fetch_all($id_factura);
		
		
        $this->view->setVariable("invoicelines", $invoicelines);
        $this->view->render("invoiceline", "INVOICE_SHOWONE_Vista");
    }

//ver detalle//

    public function showone(){
        $this->checkPerms("invoiceline", "showone", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An invoiceline id is mandatory"));
        }

        $invoicelineid = $_REQUEST["id"];
        $invoiceline = $this->invoicelineMapper->fetch($invoicelineid);
	    $invoice = $this->invoicelineMapper->fetchInvoice();
        

        if ($invoiceline == NULL) {
            throw new Exception(i18n("No such invoiceline with id: ").$invoicelineid);
        }
        $this->view->setVariable("invoiceline", $invoiceline);
		$this->view->setVariable("id", $invoicelineid);
	    $this->view->setVariable("invoice", $invoice);
        $this->view->render("invoiceline", "INVOICELINE_SHOWONE_Vista");
    }

//alta//

    public function add(){
        $this->checkPerms("invoiceline", "add", $this->currentUserId);

        $invoiceline = new Invoiceline();
	    $invoice = $this->invoicelineMapper->fetchInvoice();

        if (isset($_POST["submit"])) {

			$invoiceline->setID($_POST["id"]);
            $invoiceline->setInvoiceId($_POST["invoice"]);
            $invoiceline->setProduct($_POST["product"]);
            $invoiceline->setQuantity($_POST["quantity"]);
            $invoiceline->setPrice($_POST["price"]);
            $invoiceline->setTax($_POST["tax"]);
			$this->invoicelineMapper->insert($invoiceline);
			
			$this->view->setFlash(sprintf(i18n("Invoiceline \"%s\" successfully added."), $invoiceline->getInvoiceID()));
            $this->view->redirect("invoice", "showone","id=".($invoiceline->getInvoiceID()));
  
        }
		
	    $this->view->setVariable("invoice", $invoice);
        $this->view->render("invoiceline", "INVOICELINE_ADD_Vista");
		
    }

//modificacion//

    public function edit() {
        $this->checkPerms("invoiceline", "edit", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An invoiceline id is mandatory"));
        }

        $invoicelineid = $_REQUEST["id"];
        $invoiceline = $this->invoicelineMapper->fetch($invoicelineid);
	    $invoice = $this->invoicelineMapper->fetchInvoice();
		$invoiceoriginal = $invoiceline-> getInvoiceId();
        if ($invoiceline == NULL) {
            throw new Exception(i18n("No such invoiceline with id: ").$invoicelineid);
        }

        if (isset($_POST["submit"])) {
			
			$invoiceline->setID($_POST["id"]);
			$invoiceline->setProduct($_POST["product"]);
            $invoiceline->setInvoiceId($_POST["invoice"]);
            $invoiceline->setQuantity($_POST["quantity"]);
            $invoiceline->setPrice($_POST["price"]);
            $invoiceline->setTax($_POST["tax"]);

			$this->invoicelineMapper->update($invoiceline);
                    $this->view->setFlash(sprintf(i18n("Invoiceline \"%s\" successfully updated."), $invoiceline->getID()));
                    $this->view->redirect("invoice", "showone","id=".$invoiceoriginal);

      
        }
		
		
		$this->view->setVariable("invoiceline", $invoiceline);
		$this->view->setVariable("id", $invoicelineid);
	    $this->view->setVariable("invoice", $invoice);
        $this->view->render("invoiceline", "INVOICELINE_EDIT_Vista");
    }

//Baja//

    public function delete() {
        $this->checkPerms("invoiceline", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An invoiceline id is mandatory"));
        }

        $invoicelineid = $_REQUEST["id"];
        $invoiceline = $this->invoicelineMapper->fetch($invoicelineid);
		$invoice = $this->invoicelineMapper->fetchInvoice();
		$invoiceoriginal = $invoiceline-> getInvoiceId();

        if ($invoiceline == NULL) {
            throw new Exception(i18n("No such invoiceline with id: ").$invoicelineid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->invoicelineMapper->delete($invoiceline);
                $this->view->setFlash(sprintf(i18n("Invoiceline \"%s\" successfully deleted."), $invoiceline->getID()));
            }
            $this->view->redirect("invoice", "showone", "id=".$invoiceoriginal);
        }
		$this->view->setVariable("invoiceline", $invoiceline);
	    $this->view->setVariable("invoice", $invoice);
        $this->view->render("invoiceline", "INVOICELINE_DELETE_Vista");
    }

}
