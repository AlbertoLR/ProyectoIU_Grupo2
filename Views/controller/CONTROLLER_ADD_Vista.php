<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Create Controller");
$controller = $view->getVariable("controller");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=controller&amp;action=show"><?= i18n("List of Controllers") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Create Controller") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Create Controller")?></h1>
      <form action="index.php?controller=controller&amp;action=add" method="POST">
        <div class="form-group">
          <label><?= i18n("Name") ?>:</label>
           <input type="text" name="controllername" class="form-control" minlength="2" required="required">
        </div>
          <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
      </form>
    </div>
</div>
