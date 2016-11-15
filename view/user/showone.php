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
        <a href="index.php?controller=user&action=permissions" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Manage Permissions</a><br />
        ID: <?= $user->getID() ?><br />
        Username: <?= $user->getUsername() ?><br />
        Profile: <?= $user->getProfile() ?><br />
    </div>
</div>