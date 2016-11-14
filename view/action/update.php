<?php  
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Update Action");
$action = $view->getVariable("action");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
      <h1><?= i18n("Update Action")?></h1>
      <form action="index.php?controller=action&amp;action=update" method="POST">
        <?= i18n("Action Name") ?>: <input type="text" name="actionname" value="<?php echo $action->getActionName(); ?>">
      <input type="hidden" name="id" value="<?= $action->getID() ?>">
      <input type="submit" name="submit" value="<?= i18n("Update Action") ?>">
</form>
    </div>
</div>