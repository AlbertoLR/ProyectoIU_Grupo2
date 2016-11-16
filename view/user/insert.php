<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Create User");
$user = $view->getVariable("user");
$profiles = $view->getVariable("profiles");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
      <h1><?= i18n("Create User")?></h1>
        <form action="index.php?controller=user&amp;action=insert" method="POST">
          <div class="form-group">
            <label><?= i18n("Name") ?>:</label>
      	     <input type="text" name="username" class="form-control">
          </div>
          <div class="form-group">
            <label><?= i18n("Password") ?>:</label>
            <input type="password" name="passwd" class="form-control">
          </div>
          <div class="form-group">
            <label><?= i18n("Profile") ?>:</label>
            <select name="profile" class="form-control">
              <option value=""></option>
              <?php foreach($profiles as $profile) {?>
                  <option value="<?= $profile->getProfileName()?>"><?= $profile->getProfileName()?></option>
              <?php }?>
            </select>
          </div>
             <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
        </form>
    </div>
</div>
