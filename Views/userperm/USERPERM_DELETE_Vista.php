<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Delete UserPerm");
$userperm = $view->getVariable("userperm");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=userperm&amp;action=show"><?= i18n("List of User Permissions") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Delete UserPerm") ?></li>
  </ol>
  </div>
    <div class="container">
        <h1><?= i18n("Delete UserPerm")." ".$userperm->getID() ?></h1>
      <form action="index.php?controller=userperm&amp;action=delete" method="POST">
        <button type="submit" name="submit" value="yes" class="btn btn-default"><?= i18n("Yes") ?></button>
        <button type="submit" name="submit" value="no" class="btn btn-default"><?= i18n("No") ?></button>
        <input type="hidden" name="id" value="<?= $userperm->getID() ?>">
      </form>
    </div>
</div>
