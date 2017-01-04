<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Delete Category");
$category = $view->getVariable("category");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=category&amp;action=show"><?= i18n("List of Categories") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Delete Category") ?></li>
  </ol>
  </div>
    <div class="container">
        <h1><?= i18n("Delete Category")." ".$category->getType()?></h1>
      <form action="index.php?controller=category&amp;action=delete" method="POST">
        <button type="submit" value="yes" name="submit" class="btn btn-default"><?= i18n("Yes") ?></button>
        <button type="submit" value="no" name="submit" class="btn btn-default"><?= i18n("No") ?></button>
        <input type="hidden" name="id" value="<?= $category->getID() ?>">
      </form>
    </div>
</div>
