<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Update User");
$user = $view->getVariable("user");
$profiles = $view->getVariable("profiles");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
      <h1><?= i18n("Update User")?></h1>
      <div class="form-group">
        <a href="index.php?controller=user&amp;action=permissions" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Manage Permissions</a>
      </div>
      <form action="index.php?controller=user&amp;action=update" method="POST">
        <div class="form-group">
          <label><?= i18n("Name") ?>:</label>
          <input type="text" name="username" class="form-control" value="<?php echo $user->getUsername(); ?>">
          <label><?= i18n("Password") ?>:</label>
          <input type="password" name="passwd" class="form-control">
          <label><?= i18n("Profile") ?>:</label>
          <select name="profile" class="form-control">
            <option value="" ></option>
              <?php foreach($profiles as $profile) {?>
                  <?php if ($profile->getProfileName() == $user->getProfile()): ?>
                  <option value="<?= $profile->getProfileName()?>" selected><?= $profile->getProfileName()?></option>
                  <?php else: ?>
                  <option value="<?= $profile->getProfileName()?>"><?= $profile->getProfileName()?></option>
                  <?php endif ?>
              <?php }?>
          </select>
        </div>
        <input type="hidden" name="id" value="<?= $user->getID() ?>">
        <button type="submit" name="submit"class="btn btn-default"><?= i18n("Update Controller") ?></button>
      </form>
      </div>
</div>
