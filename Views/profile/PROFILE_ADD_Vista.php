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
    <div class="container">
      <h1><?= i18n("Create Profile")?></h1>
      <form action="index.php?controller=profile&amp;action=add" method="POST">
      <div class="form-group">
        <label for="usr"><?= i18n("Profile Name") ?>:</label>
         <input type="text" name="profilename" class="form-control" minlength="2" required="required">
      </div>
        <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
      </form>
    </div>
</div>
