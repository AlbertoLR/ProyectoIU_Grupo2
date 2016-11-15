<?php  
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Create Action");
$profile = $view->getVariable("profile");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
      <h1><?= i18n("Create Profile")?></h1>
      <form action="index.php?controller=profile&amp;action=insert" method="POST">
	    <?= i18n("Profile Name") ?>: <input type="text" name="profilename"><br />
	    <input type="submit" name="submit" value="submit">
      </form>
    </div>
</div>