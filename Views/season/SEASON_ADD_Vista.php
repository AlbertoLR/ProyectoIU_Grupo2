<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Create Season");
$season = $view->getVariable("season");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=season&amp;action=show"><?= i18n("List of Seasons") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Create Season") ?></li>
  </ol>
  </div>
    <div class="container">

      <h1><?= i18n("Create Season")?></h1>
        <form action="index.php?controller=season&amp;action=add" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label><?= i18n("Name") ?>:</label>
             <input type="text" name="description" class="form-control" minlength="2" maxlength="16"  pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+">
          </div>
          <div class="form-group">
            <label><?= i18n("Start Day") ?>:</label>
             <input type="date" name="date_start" class="form-control" placeholder="ej: 2015-6-15" >
          </div>

          <div class="form-group">
            <label><?= i18n("End Day") ?>:</label>
             <input type="date" name="date_end" class="form-control" placeholder="ej: 2015-9-15" >
          </div>
             <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
        </form>
    </div>
</div>
