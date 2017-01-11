<?php

require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();
$view->setVariable("title", "Show Cash");
$cashes = $view->getVariable("cashes");
$errors = $view->getVariable("errors");

?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<?php
	/*		
	**Busco la ultima posición del array (último movimiento) para mostrar el total de la caja (efectivo_final del ultimo movimiento)
	**Ya no es necesario al hacer la búsqueda ordenada por fecha descendente
	
	$tamaño = (count($cashes) - 1);
	$efectivo = $cashes[$tamaño]->getEfectivofinal();
	echo $efectivo;
	echo "    " + $tamaño;
	*/
?>

<div class="jumbotron">
<div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("List of cash") ?></li>
  </ol>
  </div>
    <div class="container">
    <h1><?= i18n("List of cash") ?></h1>
	<a href="index.php?controller=cash&amp;action=add" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Create cash") ?></a>
	<a href="index.php?controller=cash&amp;action=search" class="btn btn-default"><i class="fa fa-search-plus" aria-hidden="true"></i> <?= i18n("Advanced Search") ?></a>

<table class="table top-buffer">
      <thead>
        <tr>
			<th><?php if(empty($cashes)){ echo "";}else{ ?><?= i18n("CURRENT CASH") ?> <?php }?></th> <!-- controlamos cuando el efectivo es vacio en busquedas-->
			<th><?php if(empty($cashes)){ echo "";}else{echo $cashes[0]->getEfectivoFinal()." EUROS";} ?> </th>
		</tr>
	</thead>
</table>

<table class="table top-buffer">
      <thead>
		<tr>
          <th><br/><?= i18n("Initial cash") ?></th>
          <th><?= i18n("Amount") ?></th>
		  <th><?= i18n("Final cash") ?></th>
		  <th><?= i18n("Type") ?></th>
		  <th><?= i18n("Payment id") ?></th>
		  <th><?= i18n("Date") ?></th>
          <th style="width: 72px;"></th>
        </tr>
      </thead>
      <tbody>

	  <?php foreach($cashes as $cash){?>
          <tr>
          <td><?php echo $cash->getEfectivoinicial(); ?></td>
          <td><?php echo $cash->getCantidad(); ?></td>
		  <td><?php echo $cash->getEfectivofinal(); ?></td>
		  <td><?= i18n($cash->getTipo()) ?></td>
		  <td><?php echo $cash->getPagoid(); ?></td>
		  <td><?php echo $cash->getFecha(); ?></td>
		  <td>
              <a href="index.php?controller=cash&amp;action=showone&amp;id=<?php echo $cash->getID();  ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a> <!--ver detalle de movimiento-->
          </td>
        </tr>
	<?php } ?>
      </tbody>
</table>
<a href="index.php" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Return") ?></a>
    </div>
</div>