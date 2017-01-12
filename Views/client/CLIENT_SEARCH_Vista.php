<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Search Client");
$client = $view->getVariable("client");
$profiles = $view->getVariable("profiles");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=client&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=client&amp;action=show"><?= i18n("List of Clients") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Search Clients") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Search Client")?></h1>
        <form action="index.php?controller=client&amp;action=search" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label><?= i18n("DNI") ?>:</label>
            <input type="text" name="dni" class="form-control"  placeholder="ej: 00000000A" >
          </div>
          <div class="form-group">
            <label><?= i18n("Name") ?>:</label>
             <input type="text" name="name" class="form-control"  placeholder="ej: Juan"  pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+">
          </div>
          <div class="form-group">
            <label><?= i18n("Surname") ?>:</label>
             <input type="text" name="surname" class="form-control" placeholder="ej: Fernández López"  pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+">
          </div>
          <div class="form-group">
            <label><?= i18n("Email") ?>:</label>
             <input type="email" name="email" class="form-control" placeholder="ej: moovett@moovett.es">
          </div>
          <div class="form-group">
            <label><?= i18n("Alert Fault") ?>:</label>
            <select name="alerta_falta" class="form-control">
              <option value=""></option>
              <option value="Yes"><?= i18n("Yes") ?></option>
              <option value="No"><?= i18n("No") ?></option>
            </select>
          </div>
          <div class="form-group">
            <label><?= i18n("Unemployed") ?>:</label>
            <select name="desempleado" class="form-control">
              <option value=""></option>
              <option value="Yes"><?= i18n("Yes") ?></option>
              <option value="No"><?= i18n("No") ?></option>
            </select>
          </div>
          <div class="form-group">
            <label><?= i18n("Student") ?>:</label>
            <select name="estudiante" class="form-control">
              <option value=""></option>
              <option value="Yes"><?= i18n("Yes") ?></option>
              <option value="No"><?= i18n("No") ?></option>
            </select>
          </div>
          <div class="form-group">
            <label><?= i18n("Family") ?>:</label>
            <select name="familiar" class="form-control">
              <option value=""></option>
              <option value="Yes"><?= i18n("Yes") ?></option>
              <option value="No"><?= i18n("No") ?></option>
            </select>
          </div>
             <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
        </form>
    </div>
</div>
