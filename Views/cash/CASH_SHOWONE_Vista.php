<?php

require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();
$view->setVariable("title", "Cash");
$cash = $view->getVariable("cash");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
<div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=cash&amp;action=show"><?= i18n("List of cash") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Cash details") ?></li>
  </ol>
  </div>
    <div class="container">
		
		<h2><?= i18n("Cash details")?></h2><br/>
		
    	<table class="table" >
          <tr class="active">
		    <th><?= i18n("Payment id")?>:</th>
            <td><?=$cash->getID() ?></td>
		</tr>
		<tr class="active">
            <th><?= i18n("Date")?>:</th>
            <td><?= $cash->getFecha() ?> </td>
		</tr>   
		<tr class="active">
            <th><?= i18n("Amount")?>:</th>
            <td><?= $cash->getCantidad() ?> Euros </td>
		</tr>   
		<tr class="active">
            <th><?= i18n("Type")?>:</th>
            <td><?= i18n($cash->getTipo()) ?></td>
		  </tr>      
		<tr class="active">
            <th><?= i18n("Concept of")?>:</th>
            <td><?= $cash->getDescripcion() ?> </td>
		  </tr>         

        </table>
		<a href="index.php?controller=cash&amp;action=show" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Return") ?></a>
    </div>
</div>