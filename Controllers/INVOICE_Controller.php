<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Invoice.php");
require_once(__DIR__."/../Models/INVOICE_Model.php");
require_once(__DIR__."/../Models/Invoice.php");
require_once(__DIR__."/../Models/INVOICELINE_Model.php");
require_once(__DIR__."/../Controllers/INVOICELINE_Controller.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class INVOICE_Controller extends BaseController {

    private $invoiceMapper;

    public function __construct() {
        parent::__construct();
        $this->invoiceMapper = new INVOICE_Model();
		$this->invoicelineMapper = new INVOICELINE_Model();
        $this->view->setLayout("default");
    }

	
//consulta//

    public function show(){
        $this->checkPerms("invoice", "show", $this->currentUserId);

        $invoices = $this->invoiceMapper->fetch_all();
		
		
        $this->view->setVariable("invoices", $invoices);
        $this->view->render("invoice", "INVOICE_SHOW_Vista");
    }

//ver detalle//

    public function showone(){
        $this->checkPerms("invoice", "showone", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An invoice id is mandatory"));
        }

        $invoiceid = $_REQUEST["id"];
        $invoice = $this->invoiceMapper->fetch($invoiceid);
		$invoicelines = $this->invoicelineMapper->fetch_all($invoiceid);
	    $payment = $this->invoiceMapper->fetchPayment();
        

        if ($invoice == NULL) {
            throw new Exception(i18n("No such invoice with id: ").$invoiceid);
        }
        $this->view->setVariable("invoice", $invoice);
		$this->view->setVariable("invoicelines", $invoicelines);
		$this->view->setVariable("id", $invoiceid);
	    $this->view->setVariable("id_payment", $payment);
		$total = 0;
		$supuesto = ($invoice->getTotalPrice());
		foreach ($invoicelines as $invoiceline){
			$total = $total + (($invoiceline->getPrice())*($invoiceline->getQuantity()));
		}
		if ($total!=$supuesto){
			print(i18n("Invoice total price and invoice lines prices summation are not equals"));
		}
        $this->view->render("invoice", "INVOICE_SHOWONE_Vista");
    }

//alta//

    public function add(){
        $this->checkPerms("invoice", "add", $this->currentUserId);

        $invoice = new invoice();
        $payments = $this->invoiceMapper->fetchPayment();

        if (isset($_POST["submit"])) {

            $invoice->setDay($_POST["day"]);
            $invoice->setPaymentId($_POST["id_payment"]);
            $invoice->setTotalPrice($_POST["total_price"]);
 //Comprobamos que se introduzca un pago//           
		try{
				if ($_POST["id_payment"]== NULL){
					$errors = array();
	                $errors["general"] = i18n("Invoice needs a payment identification");
	                $this->view->setVariable("errors", $errors);
					printf($errors["general"]);
				}else{	
			$this->invoiceMapper->insert($invoice);	
				
			$this->view->setFlash(sprintf(i18n("Invoice \"%s\" successfully added."), $invoice->getID()));
            $this->view->redirect("invoice", "show");
				}}catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        $this->view->setVariable("payments", $payments);
        $this->view->render("invoice", "INVOICE_ADD_Vista");
		
    }

//modificacion//

    public function edit() {
        $this->checkPerms("invoice", "edit", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An invoice id is mandatory"));
        }

        $invoiceid = $_REQUEST["id"];
        $invoice = $this->invoiceMapper->fetch($invoiceid);
	    $payments = $this->invoiceMapper->fetchPayment();
	    

        if ($invoice == NULL) {
            throw new Exception(i18n("No such invoice with id: ").$invoiceid);
        }

        if (isset($_POST["submit"])) {
			
			$invoice->setID($_POST["id"]);
            $invoice->setDay($_POST["day"]);
            $invoice->setPaymentId($_POST["id_payment"]);
            $invoice->setTotalPrice($_POST["total_price"]);
//Comprobamos que se introduzca un pago//		
		try{
				if ($_POST["id_payment"]== NULL){
					$errors = array();
	                $errors["general"] = i18n("Invoice needs a payment identification");
	                $this->view->setVariable("errors", $errors);
					
				}else{	
			$this->invoiceMapper->update($invoice);
                    $this->view->setFlash(sprintf(i18n("Invoice \"%s\" successfully updated."), $invoice->getID()));
                    $this->view->redirect("invoice", "show");
				}}catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
		
		
		$this->view->setVariable("invoice", $invoice);
		$this->view->setVariable("id", $invoiceid);
        $this->view->setVariable("payments", $payments);
        $this->view->render("invoice", "INVOICE_EDIT_Vista");
    }

//Baja//

    public function delete() {
        $this->checkPerms("invoice", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        $invoiceid = $_REQUEST["id"];
        $invoice = $this->invoiceMapper->fetch($invoiceid);
	    $payment = $this->invoiceMapper->fetchPayment();

		
        if ($invoice == NULL) {
            throw new Exception(i18n("No such invoice with id: ").$invoiceid);
        }

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes"){
                $this->invoiceMapper->delete($invoice);
                $this->view->setFlash(sprintf(i18n("Invoice \"%s\" successfully deleted."), $invoice->getID()));
            }
            $this->view->redirect("invoice", "show");
        }
		$this->view->setVariable("invoice", $invoice);
		$this->view->setVariable("id", $invoiceid);
        $this->view->setVariable("payment", $payment);
        $this->view->render("invoice", "INVOICE_DELETE_Vista");
    }

}
