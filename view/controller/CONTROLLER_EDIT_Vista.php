<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Update Controller");
$controller = $view->getVariable("controller");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
      <h1><?= i18n("Update Controller")?></h1>
      <form action="index.php?controller=controller&amp;action=edit" method="POST">
        <div class="form-group">
          <label><?= i18n("Name") ?>:</label>
          <input type="text" name="controllername" class="form-control" value="<?php echo $controller->getControllerName(); ?>" minlength="2" required="required">
          <input type="hidden" name="id" value="<?= $controller->getID() ?>">
        </div>
        <button type="submit" name="submit"class="btn btn-default"><?= i18n("Update Controller") ?></button>
        </div>
      </form>
</div>
