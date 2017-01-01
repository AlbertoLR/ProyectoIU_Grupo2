<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Delete Season");
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
    <li class="breadcrumb-item active"><?= i18n("Delete Season") ?></li>
  </ol>
  </div>
    <div class="container">
        <h1><?= i18n("Delete Season")." ".$season->getDescription()?></h1>
      <form action="index.php?controller=season&amp;action=delete" method="POST">
        <button type="submit" name="submit" value="yes" class="btn btn-default"><?= i18n("Yes") ?></button>
        <button type="submit" name="submit" value="no" class="btn btn-default"><?= i18n("No") ?></button>
        <input type="hidden" name="id" value="<?= $season->getID() ?>">
      </form>
    </div>
</div>
