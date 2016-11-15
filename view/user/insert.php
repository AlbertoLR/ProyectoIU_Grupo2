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
	    <?= i18n("Name") ?>: <input type="text" name="username"><br />
	    <?= i18n("Password") ?>: <input type="password" name="passwd"><br />
        <?= i18n("Profile") ?>: <select name="profile">
        <option value="" selected></option>
        <?php foreach($profiles as $profile) {?>
            <option value="<?= $profile->getProfileName()?>"><?= $profile->getProfileName()?></option>
        <?php }?>
        </select>
	    <input type="submit" name="submit" value="submit">
      </form>
    </div>
</div>