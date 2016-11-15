<?php  
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Show Controller");
$controller = $view->getVariable("controller");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>
        
<div class="jumbotron">
    <div class="container">
        <h1><?= i18n("Controller")?></h1>
        ID: <?= $controller->getID() ?><br />
        Controller: <?= $controller->getControllerName() ?><br />
        Action: <?= $controller->getAction() ?><br />
    </div>
</div>