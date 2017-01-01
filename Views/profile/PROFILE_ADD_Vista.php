<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Create Action");
$profile = $view->getVariable("profile");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=profile&amp;action=show"><?= i18n("List of Profiles") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Create Profile") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Create Profile")?></h1>
      <form action="index.php?controller=profile&amp;action=add" method="POST">
      <div class="form-group">
        <label for="usr"><?= i18n("Name") ?>:</label>
         <input type="text" name="profilename" class="form-control" minlength="2" required="required">
      </div>
        <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
      </form>
    </div>
</div>
