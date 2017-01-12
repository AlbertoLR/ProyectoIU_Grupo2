<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Payment.php");
require_once(__DIR__."/../Models/PAYMENT_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class PAYMENT_Controller extends BaseController {
    private $paymentMapper;
    public function __construct() {
        parent::__construct();
        $this->paymentMapper = new PAYMENT_Model();
        $this->view->setLayout("default");
    }

    public function show(){
        $this->checkPerms("payment", "show", $this->currentUserId);
        $payments = $this->paymentMapper->fetch_all();
        $this->view->setVariable("payment", $payments);
        $this->view->render("payment", "PAYMENT_SHOW_Vista");
    }

    public function showone(){
        $this->checkPerms("payment", "showone", $this->currentUserId);
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A payment id is mandatory"));
        }

        $paymentid = $_REQUEST["id"];
        $payment = $this->paymentMapper->fetch($paymentid);
        $reserves = $this->paymentMapper->fetch_reserves();
        $inscriptions = $this->paymentMapper->fetch_inscriptions();

        if ($payment == NULL) {
            throw new Exception(i18n("No such payment with id: ").$paymentid);
        }

        $this->view->setVariable("reserves", $reserves);
        $this->view->setVariable("inscriptions", $inscriptions);
        $this->view->setVariable("payment", $payment);
        $this->view->render("payment", "PAYMENT_SHOWONE_Vista");

    }

    public function add(){
        $this->checkPerms("payment", "add", $this->currentUserId);
        $payment = new Payment();
        $reserves = $this->paymentMapper->fetch_reserves();
        $inscriptions = $this->paymentMapper->fetch_inscriptions();

        if (isset($_POST["submit"])) {
            $payment->setPaymentMetod($_POST["payment_metod"]);
            $payment->setDate($_POST["date"]);
            $payment->setPeriodicity($_POST["periodicity"]);
            $payment->setQuantity($_POST["quantity"]);
            $payment->setReserveid($_POST["id_reserva"]);
            $payment->setInscriptionid($_POST["id_inscription"]);
            if($_POST["realiced"]=="Yes"){
              $payment->setRealiced(TRUE);
            }
            else{
              $payment->setRealiced(FALSE);
            }

          try{

            $this->paymentMapper->insert($payment);
            $this->view->setFlash(sprintf(i18n("Payment \"%s\" successfully added."), $payment->getDate()));
            $this->view->redirect("payment", "show");

          }catch(ValidationException $ex) {
              $errors = $ex->getErrors();
              $this->view->setVariable("errors", $errors);
          }
        }
        $this->view->setVariable("reserves", $reserves);
        $this->view->setVariable("inscriptions", $inscriptions);
        $this->view->setVariable("payment", $payment);
        $this->view->render("payment", "PAYMENT_ADD_VISTA");

    }

    public function edit() {

        $this->checkPerms("payment", "edit", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A payment id is mandatory"));
        }

        $paymentid = $_REQUEST["id"];
        $payment = $this->paymentMapper->fetch($paymentid);
        $reserves = $this->paymentMapper->fetch_reserves();
        $inscriptions = $this->paymentMapper->fetch_inscriptions();

        if ($payment == NULL) {
            throw new Exception(i18n("No such payment with id: ").$paymentid);
        }

        if (isset($_POST["submit"])) {

          $payment->setPaymentMetod($_POST["payment_metod"]);
          $payment->setDate($_POST["date"]);
          $payment->setPeriodicity($_POST["periodicity"]);
          $payment->setQuantity($_POST["quantity"]);
          $payment->setReserveid($_POST["id_reserva"]);
          $payment->setInscriptionid($_POST["id_inscription"]);
          if($_POST["realiced"]=="Yes"){
            $payment->setRealiced(TRUE);
          }
          else{
            $payment->setRealiced(FALSE);
          }

          try{

            $this->paymentMapper->update($payment);
            $this->view->setFlash(sprintf(i18n("Payment \"%s\" successfully updated."), $payment->getDate()));
            $this->view->redirect("payment", "show");

          }catch(ValidationException $ex) {
              $errors = $ex->getErrors();
              $this->view->setVariable("errors", $errors);
          }

        }

        $this->view->setVariable("reserves", $reserves);
        $this->view->setVariable("inscriptions", $inscriptions);
        $this->view->setVariable("payment", $payment);
		    $this->view->render("payment", "PAYMENT_EDIT_VISTA");

    }
    public function delete() {

        $this->checkPerms("payment", "delete", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {

            throw new Exception(i18n("Id is mandatory"));

        }
        $paymentid = $_REQUEST["id"];
        $payment = $this->paymentMapper->fetch($paymentid);
        $reserves = $this->paymentMapper->fetch_reserves();
        $inscriptions = $this->paymentMapper->fetch_inscriptions();

        if ($payment == NULL) {

            throw new Exception(i18n("No such payment with id: ").$paymentid);

        }

        if (isset($_POST["submit"])) {

            if ($_POST["submit"] == "yes"){

                $this->paymentMapper->delete($payment);

                $this->view->setFlash(sprintf(i18n("Payment \"%s\" successfully deleted."), $payment->getDate()));

            }
            $this->view->redirect("payment", "show");

        }

        $this->view->setVariable("reserves", $reserves);
        $this->view->setVariable("inscriptions", $inscriptions);
        $this->view->setVariable("payment", $payment);
        $this->view->render("payment", "PAYMENT_DELETE_VISTA");

    }

}
