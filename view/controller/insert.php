<?php  
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Create Controller");
$controller = $view->getVariable("controller");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
      <h1><?= i18n("Create Controller")?></h1>
      <form action="index.php?controller=controller&amp;action=insert" method="POST">
	    <?= i18n("Name") ?>: <input type="text" name="controllername"><br />
	    <input type="submit" name="submit" value="submit">
      </form>
    </div>
</div>