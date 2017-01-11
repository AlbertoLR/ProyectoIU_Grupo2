<?php

require_once(__DIR__."/../core/PDOConnection.php");

class CASH_Model {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function fetch_all(){ //muestra todos los movimientos y el total de la caja
        $sql = $this->db->prepare("SELECT * FROM caja ORDER BY id DESC");
        $sql->execute();
        $cajas_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $cashes = array();

        foreach ($cajas_db as $cash) {
            array_push($cashes, new Cash($cash["id"], $cash["efectivo_inicial"], $cash["cantidad"],$cash["efectivo_final"], $cash["tipo"],$cash["descripcion"],$cash["pago_id"],$cash["fecha"]));
        }
        return $cashes;
    }

    public function fetch($cajaID){ //muestra datos de un movimiento en particular
		$sql = $this->db->prepare("SELECT * FROM caja WHERE id=?");
		$sql->execute(array($cajaID));
		$cash = $sql->fetch(PDO::FETCH_ASSOC);

        if($cash != NULL) {
            return new Cash($cash["id"],$cash["efectivo_inicial"],$cash["cantidad"],$cash["efectivo_final"],$cash["tipo"],$cash["descripcion"],$cash["pago_id"],$cash["fecha"]);
        } else {
            return NULL;
        }
    }

    public function insert(Cash $cash) { //inserta un movimiento
		$sqlid = $this->db->prepare("SELECT MAX(id) FROM caja");
		$sqlid->execute();
		$id = $sqlid->fetch();
		/*print_r($id);
		echo $id[0];*/
		
		if($cash->getTipo() == 'payment' or $cash->getTipo() == 'retirada' or $cash->getTipo() == 'payment' or $cash->getTipo() == 'withdraw'){
			$cantidad = $cash->getCantidad() - ($cash->getCantidad()*2);
		}else{
			$cantidad = $cash->getCantidad();
		}
		
		//asignamos el valor correcto a una variable idPago (NULL para "retiradas de dinero en caja" en los que no hay un id_pago)
		if($cash->getPagoid()==''){
			$idPago = NULL;
		}else{
			$idPago = $cash->getPagoid();
		}
		
		$sqlinicial = $this->db->prepare('SELECT efectivo_final FROM caja WHERE id=?');
		$sqlinicial->execute(array($id[0]));
		$inicial = $sqlinicial->fetch(PDO::FETCH_ASSOC);
		/*print_r($inicial);
		echo $inicial['efectivo_final'];*/
		
		$final = $inicial['efectivo_final'] + $cantidad;
		
		//guardamos los valores en la base de datos siempre en español
		if($cash->getTipo() =='pago'){
			$cash->setTipo('payment'); 
		}elseif($cash->getTipo() =='ingreso'){
			$cash->setTipo('cash income'); 
		}else{
			$cash->setTipo('withdraw'); 
		}
		
        $sql = $this->db->prepare("INSERT INTO caja (efectivo_inicial,cantidad,efectivo_final,tipo,descripcion,pago_id,fecha) values (?,?,?,?,?,?,?)");
        $sql->execute(array($inicial['efectivo_final'], $cantidad, $final, $cash->getTipo(),$cash->getDescripcion(),$idPago,$cash->getFecha()));
		print_r($sql);
    }

	public function pagoIdExists($pagoId) {
        $sql = $this->db->prepare("SELECT count(pago_id) FROM caja where pago_id=?");
        $sql->execute(array($pagoId));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }    
	
	public function search($query) {//buscamos movimiento con los parametros que deseamos
        $search_query = "SELECT * FROM caja WHERE ". $query;
        $sql = $this->db->prepare($search_query);
        $sql->execute();
        $cashes_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $cashes = array();

        foreach ($cashes_db as $cash) {
            array_push($cashes, new Cash($cash["id"], $cash["efectivo_inicial"], $cash["cantidad"],$cash["efectivo_final"], $cash["tipo"],$cash["descripcion"],$cash["pago_id"],$cash["fecha"] ));
        }
        return $cashes;
    }
}