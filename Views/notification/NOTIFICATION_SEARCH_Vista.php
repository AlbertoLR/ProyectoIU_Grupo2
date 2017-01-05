<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Send Notification");
$notifications = $view->getVariable("notifications");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>
<div class="jumbotron">
<div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=notification&amp;action=show"><?= i18n("Send Notification") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Search addressee") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Search addressee")?></h1>
      <form notification="index.php?controller=notification&amp;action=search" method="POST">
      <div class="form-group">
        <label><?= i18n("Name")?>: </label>
         <input type="text" name="name" minlength="2" maxlength="15" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+">
      </div>
	  <div class="form-group">
        <label><?= i18n("Surname")?>: </label>
         <input type="text" name="surname" minlength="2" maxlength="40" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+">
      </div>
	  <div class="form-group">
        <label><?= i18n("Activity")?>: </label>
         <input type="text" name="activity" minlength="2" maxlength="10" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+">
      </div>
	  <div class="form-group">
        <label><?= i18n("Email")?>: </label>
         <input type="text" name="email" minlength="2" maxlength="30" pattern="[a-zA-Z0-9@_.-]+">
      </div>
      <button type="submit" name="submit" class="btn btn-default"><?= i18n("Submit") ?></button>
      </form>
    </div>
</div>
