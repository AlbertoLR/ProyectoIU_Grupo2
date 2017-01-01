<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Modify Season");
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
      <li class="breadcrumb-item active"><?= i18n("Modify Season") ?></li>
    </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Modify Season")?></h1>
        <form action="index.php?controller=season&amp;action=edit" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label><?= i18n("Name") ?>:</label>
             <input type="text" name="description" class="form-control" value="<?= $season->getDescription() ?>"  pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+">
          </div>
          <div class="form-group">
            <label><?= i18n("Start Day") ?>:</label>
             <input type="date" name="date_start" class="form-control" value="<?= $season->getdateStart() ?>"  placeholder="ej: 2015-6-15" >
          </div>

          <div class="form-group">
            <label><?= i18n("End Day") ?>:</label>
             <input type="date" name="date_end" class="form-control" value="<?= $season->getdateEnd() ?>"  placeholder="ej: 2015-9-15" >
          </div>
          <input type="hidden" name="id" value="<?= $season->getID() ?>">
             <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
        </form>
    </div>
</div>
