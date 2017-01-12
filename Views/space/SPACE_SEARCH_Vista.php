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
    <li class="breadcrumb-item active"><?= i18n("Search Space") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Search Space")?></h1>
        <form action="index.php?controller=space&amp;action=search" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label><?= i18n("Name") ?>:</label>
             <input type="text" name="nombre" class="form-control"  placeholder="ej: Sala de baile"  pattern="[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s]++">
          </div>
          <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
        </form>
    </div>
</div>
