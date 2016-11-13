<?php  
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Login");
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
        <?= i18n("Profile") ?>: <input type="text" name="profile"><br />
	    <input type="submit" name="submit" value="submit">
      </form>
    </div>
</div>