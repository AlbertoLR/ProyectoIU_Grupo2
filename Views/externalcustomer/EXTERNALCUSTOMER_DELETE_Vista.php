<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Delete External Customer");
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
    <li class="breadcrumb-item active"><?= i18n("Delete External Customer:") ?></li>
  </ol>
  </div>
    <div class="container">
        <h1><?= i18n("Delete External Customer:")." ".$externalcustomer->getNombre()?></h1>
      <form action="index.php?controller=externalcustomer&amp;action=delete" method="POST">
        <button type="submit" value="yes" name="submit" class="btn btn-default"><?= i18n("Yes") ?></button>
        <button type="submit" value="no" name="submit" class="btn btn-default"><?= i18n("No") ?></button>
        <input type="hidden" name="id" value="<?= $externalcustomer->getID() ?>">
      </form>
	  <br/>
	  <table class="table" >
          <tr class="active">
            <th><?= i18n("Identifier")?>:</th>
            <td><?= $externalcustomer->getID() ?></td>
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