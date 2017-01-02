<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Show External Customer");
$externalcustomer = $view->getVariable("externalcustomer");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
<div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=externalcustomer&amp;action=show"><?= i18n("List of External Customers") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("External customer") ?></li>
  </ol>
  </div>
    <div class="container">
	<h1><?= i18n("External customer")?></h1>
    	<table class="table" >
          <tr class="active">
            <th><?= i18n("Identifier")?>:</th>
            <td><?= $externalcustomer->getID() ?></td>
          </tr>
         
		 <tr class="active">
            <th><?= i18n("Dni/Nif")?>:</th>
            <td><?= $externalcustomer->getDni_nif() ?></td>
          </tr>
		 
          <tr class="active">
            <th><?= i18n("Name")?>:</th>
            <td><?= $externalcustomer->getNombre() ?></td>
          </tr>
		  
          <tr class="active">
            <th><?= i18n("Surname")?>:</th>
            <td><?= $externalcustomer->getApellido() ?></td>
          </tr>
		  
          <tr class="active">
            <th><?= i18n("Email")?>:</th>
            <td><?= $externalcustomer->getEmail() ?></td>
          </tr>
          
          <tr class="active">
            <th><?= i18n("Telephone")?>:</th>
            <td><?= $externalcustomer->getTelefono() ?></td>
          </tr>
          
        </table>
		<a href="index.php?controller=externalcustomer&amp;action=show" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Volver") ?></a>
    </div>
</div>