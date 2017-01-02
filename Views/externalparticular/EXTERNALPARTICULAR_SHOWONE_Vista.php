<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Show External Particular");
$externalparticular = $view->getVariable("externalparticular");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
<div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=externalparticular&amp;action=show"><?= i18n("List of External Particulars") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("External particular") ?></li>
  </ol>
  </div>
    <div class="container">
	<h1><?= i18n("External particular")?></h1>
    	<table class="table" >
          <tr class="active">
            <th><?= i18n("Identifier")?>:</th>
            <td><?= $externalparticular->getID() ?></td>
          </tr>
		 
          <tr class="active">
            <th><?= i18n("Name")?>:</th>
            <td><?= $externalparticular->getNombre() ?></td>
          </tr>
		  
          <tr class="active">
            <th><?= i18n("Surname")?>:</th>
            <td><?= $externalparticular->getApellidos() ?></td>
          </tr>
		  
           <tr class="active">
            <th><?= i18n("Telephone")?>:</th>
            <td><?= $externalparticular->getTelefono() ?></td>
          </tr>
          
        </table>
		<a href="index.php?controller=externalparticular&amp;action=show" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Volver") ?></a>
    </div>
</div>