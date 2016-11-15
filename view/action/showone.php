<?php  
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Show Action");
$action = $view->getVariable("action");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>
        
<div class="jumbotron">
    <div class="container">
        <h1><?= i18n("Action")?></h1>
        ID: <?= $action->getID() ?><br />
        Action: <?= $user->getActionName() ?><br />
    </div>
</div>