<?php  
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Delete Profile");
$profile = $view->getVariable("profile");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
        <h1><?= i18n("Delete Profile")." ".$profile->getProfileName()?></h1>
      <form action="index.php?controller=profile&amp;action=delete" method="POST">
	    <input type="submit" name="submit" value="yes">
        <input type="submit" name="submit" value="no">
        <input type="hidden" name="id" value="<?= $profile->getID() ?>">
      </form>
    </div>
</div>