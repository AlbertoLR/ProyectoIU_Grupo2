<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Delete Action");
$action = $view->getVariable("action");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
        <h1><?= i18n("Delete Action")." ".$action->getActionName()?></h1>
      <form action="index.php?controller=action&amp;action=delete" method="POST">
        <button type="submit" name="submit"class="btn btn-default"><?= i18n("Yes") ?></button>
        <button type="submit" name="submit"class="btn btn-default"><?= i18n("No") ?></button>
        <input type="hidden" name="id" value="<?= $action->getID() ?>">
      </form>
    </div>
</div>
