<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Show User");
$user = $view->getVariable("user");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
        <h1><?= i18n("User")?></h1>
        <div class="form-group">
        </div>
        <div>
          <p>ID: <?= $user->getID() ?></p>
          <p>Username: <?= $user->getUsername() ?></p>
          <p>Profile: <?= $user->getProfile() ?></p>
        </div>
    </div>
</div>
