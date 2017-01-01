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
  <div class="design">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
      <li class="breadcrumb-item"><a href="index.php?controller=action&amp;action=show"><?= i18n("List of Actions") ?></a></li>
      <li class="breadcrumb-item active"><?= i18n("Modify Action") ?></li>
    </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Update Action")?></h1>
      <form action="index.php?controller=action&amp;action=edit" method="POST">
        <div class="form-group">
          <label><?= i18n("Name") ?>:</label>
          <input type="text" name="actionname" class="form-control" value="<?php echo $action->getActionName(); ?>"  minlength="2" required="required">
          <input type="hidden" name="id" value="<?= $action->getID() ?>">
        </div>
        <button type="submit" name="submit"class="btn btn-default"><?= i18n("Update") ?></button>
      </form>
    </div>
</div>
