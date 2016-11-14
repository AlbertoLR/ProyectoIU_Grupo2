<?php  
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Create Action");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
      <h1><?= i18n("Create Action")?></h1>
      <form action="index.php?controller=action&amp;action=insert" method="POST">
	    <?= i18n("Action Name") ?>: <input type="text" name="actionname"><br />
	    <input type="submit" name="submit" value="submit">
      </form>
    </div>
</div>