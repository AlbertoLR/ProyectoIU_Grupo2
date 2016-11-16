<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Update Profile");
$profile = $view->getVariable("profile");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
      <h1><?= i18n("Update Profile")?></h1>
      <form action="index.php?controller=profile&amp;action=update" method="POST">
        <div class="form-group">
          <label><?= i18n("Action Name") ?>:</label>
          <input type="text" name="profilename" class="form-control" value="<?php echo $profile->getProfileName(); ?>" required="required">
          <input type="hidden" name="id" value="<?= $profile->getID() ?>">
        </div>
      <button type="submit" name="submit"class="btn btn-default"><?= i18n("Update Profile") ?></button>
      </form>
    </div>
</div>