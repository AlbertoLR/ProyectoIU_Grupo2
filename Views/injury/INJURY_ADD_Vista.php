<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Create Action");
$injury = $view->getVariable("injury");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=injury&amp;action=show"><?= i18n("List of Injuries") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Create Injury") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Create Injury")?></h1>
      <form action="index.php?controller=injury&amp;action=add" method="POST">
      <div class="form-group">
        <label for="usr"><?= i18n("Description") ?>:</label>
         <input type="text" name="injurydescription" class="form-control" minlength="2" required="required">
      </div>
        <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
      </form>
    </div>
</div>
