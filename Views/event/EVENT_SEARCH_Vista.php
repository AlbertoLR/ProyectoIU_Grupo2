<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Search Event");
$event = $view->getVariable("event");
$profiles = $view->getVariable("profiles");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=event&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=event&amp;action=show"><?= i18n("Show Events") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Search Events") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Search Event")?></h1>
        <form action="index.php?controller=event&amp;action=search" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label><?= i18n("Name") ?>:</label>
             <input type="text" name="nombre" class="form-control"  placeholder="ej: Magosto"  pattern="[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s]++">
          </div>
          <div class="form-group">
            <label><?= i18n("Price") ?>:</label>
             <input type="number" name="precio" class="form-control" placeholder="ej: 10"  pattern="[0-9]+">
          </div>
          <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
        </form>
    </div>
</div>
