<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Search Space");
$space = $view->getVariable("space");
$profiles = $view->getVariable("profiles");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=space&amp;action=show"><?= i18n("Show Spaces") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Filter Spaces") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Filter Space")?></h1>
        <form action="index.php?controller=space&amp;action=filter" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label><?= i18n("Dia") ?>:</label>
             <input type="date" name="dia" class="form-control"  placeholder="ej: 20/05/2016"  pattern="[0-9]++">
          </div>
          <div class="form-group">
            <label><?= i18n("Hora Inicio") ?>:</label>
             <input type="time" name="hora_inicio" class="form-control" placeholder="ej: 11:00:00"  pattern="[0-9:]+">
          </div>
		  <div class="form-group">
            <label><?= i18n("Hora Fin") ?>:</label>
             <input type="time" name="hora_fin" class="form-control" placeholder="ej: 12:00:00"  pattern="[0-9:]+">
          </div>
          <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
        </form>
    </div>
</div>
