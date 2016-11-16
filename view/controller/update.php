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
      <form action="index.php?controller=controller&amp;action=update" method="POST">
        <?= i18n("Name") ?>: <input type="text" name="controllername" value="<?php echo $controller->getControllerName(); ?>">
      <input type="hidden" name="id" value="<?= $controller->getID() ?>">
      <input type="submit" name="submit" value="<?= i18n("Update Controller") ?>">
</form>
</div>