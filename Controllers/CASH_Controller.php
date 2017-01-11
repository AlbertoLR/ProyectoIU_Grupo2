<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Cash.php");
require_once(__DIR__."/../Models/CASH_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class CASH_Controller extends BaseController {

    private $cajaMapper;

    public function __construct() {
        parent::__construct();
        $this->cajaMapper = new CASH_Model();
        $this->view->setLayout("default");
    }

    public function show(){ //muestra todos los movimientos de la caja
        $this->checkPerms("cash", "show", $this->currentUserId);

        $cashes = $this->cajaMapper->fetch_all();
        $this->view->setVariable("cashes", $cashes);
        $this->view->render("cash", "CASH_SHOW_Vista");
    }

    public function showone(){ //muestra el estado actual de la caja (el efectivo final del ultimo movimiento añadido)

        $this->checkPerms("cash", "showone", $this->currentUserId);

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A cash register id is mandatory"));
        }

        $cajaid = $_REQUEST["id"];
        $cash = $this->cajaMapper->fetch($cajaid);

        if ($cash == NULL) {
            throw new Exception(i18n("No such cash register  with id: ").$cajaid);
        }

        $this->view->setVariable("cash", $cash);
        $this->view->render("cash", "CASH_SHOWONE_Vista");
    }

    public function add(){ //añade un movimiento
        $this->checkPerms("cash", "add", $this->currentUserId);

        $cash = new Cash();

        if (isset($_POST["submit"])) {
          $cash->setCantidad($_POST["cantidad"]);
		  
		  //pasamos a inglés los datos del formulario en caso de haber sido enviados en español ó gallego, si ya están en inglés los dejamos como están

		  if($_POST["tipo"]=='ingreso'){
			  $tipo = 'cash income';
		  }elseif($_POST["tipo"]=='retirada'){
			  $tipo = 'withdraw';
		  }elseif($_POST["tipo"]=='pago'){
			  $tipo = 'payment';
		  }elseif($_POST["tipo"]=='cash income'){
			  $tipo = 'cash income';
		  }elseif($_POST["tipo"]=='withdraw'){
			  $tipo = 'withdraw';
		  }else{
			  $tipo = 'payment';
		  }
		  
		  $cash->setTipo($tipo);
		  $cash->setDescripcion($_POST["descripcion"]);
          $cash->setPagoid($_POST["pagoid"]);
		  $cash->setFecha($_POST["fecha"]);
		  
		   try {
			   if($cash->getTipo() == 'cash income' && !empty($_POST["pagoid"])){
				    if(!$this->cajaMapper->pagoIdExists($_POST["pagoid"])){
                        $this->cajaMapper->insert($cash);
                        $this->view->setFlash(sprintf(i18n("Cash\"%s\" successfully added."),$cash->getCantidad()));
                        $this->view->redirect("cash", "show");
					} else {
						$errors = array();
						$errors["general"] = i18n("Payment_id already exists");
						$this->view->setVariable("errors", $errors);
					}
			   }elseif($cash->getTipo() == 'cash income' && empty($_POST["pagoid"])){
						$errors = array();
						$errors["general"] = i18n("Cash income must has a Payment_id");
						$this->view->setVariable("errors", $errors);
			   }elseif($cash->getTipo() == 'payment' && !empty($_POST["pagoid"])){
						$errors = array();
						$errors["general"] = i18n("Payment has not a Payment_id");
						$this->view->setVariable("errors", $errors);
			   }elseif($cash->getTipo() == 'withdraw' && !empty($_POST["pagoid"])){
						$errors = array();
						$errors["general"] = i18n("Withdraw has not a Payment_id");
						$this->view->setVariable("errors", $errors);
			   }elseif($cash->getTipo() == 'payment' && empty($_POST["pagoid"])){
						$this->cajaMapper->insert($cash);
                        $this->view->setFlash(sprintf(i18n("Cash\"%s\" successfully added."),$cash->getCantidad()));
                        $this->view->redirect("cash", "show");
			   }elseif($cash->getTipo() == 'withdraw' && empty($_POST["pagoid"])){
						$this->cajaMapper->insert($cash);
                        $this->view->setFlash(sprintf(i18n("Cash\"%s\" successfully added."),$cash->getCantidad()));
                        $this->view->redirect("cash", "show");
			   }else{
						$errors = array();
						$errors["general"] = i18n("Error");
						$this->view->setVariable("errors", $errors);
			   }
		   }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->setVariable("cash", $cash);
        $this->view->render("cash", "CASH_ADD_Vista");
		}
		
		public function search() { //buscamos particular externo con los parametros deseados
        $this->checkPerms("cash", "show", $this->currentUserId);

        if (isset($_POST["submit"])) {
            $query = "";
            $flag = 0;

            if ($_POST["cantidad"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "cantidad LIKE '%". $_POST["cantidad"] ."%'";
                $flag = 1;
            }

            if ($_POST["tipo"]){
                if ($flag){
                    $query .= " AND ";
                }
				 if($_POST["tipo"]=='ingreso'){
					$tipo = 'cash income';
				}elseif($_POST["tipo"]=='retirada'){
					$tipo = 'withdraw';
				}elseif($_POST["tipo"]=='pago'){
					$tipo = 'payment';
				}elseif($_POST["tipo"]=='cash income'){
					$tipo = 'cash income';
				}elseif($_POST["tipo"]=='withdraw'){
					$tipo = 'withdraw';
				}else{
					$tipo = 'payment';
				}
				
                $query .= "tipo LIKE '%". $tipo ."%'";
                $flag = 1;
            }

            if ($_POST["descripcion"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "descripcion='". $_POST["descripcion"] ."'";
                $flag = 1;
            }
			
			if ($_POST["pagoid"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "pago_id='". $_POST["pagoid"] ."'";
                $flag = 1;
            }
			
			if ($_POST["fecha"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "fecha='". $_POST["fecha"] ."'";
                $flag = 1;
            }

            if (empty($query)) {
                $cashes = $this->cajaMapper->fetch_all();
            } else {
                $cashes = $this->cajaMapper->search($query);
            }
            $this->view->setVariable("cashes", $cashes);
            $this->view->render("cash", "CASH_SHOW_Vista");
        }else {
            $this->view->render("cash", "CASH_SEARCH_Vista");
        }
	}
}