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
        <h1>Wellcome to IU Web</h1>
        <p>This is just shit by the moment.</p>
        <p><a class="btn btn-primary btn-lg" href="index.php?controller=user&action=show" role="button">Fetch Users here &raquo;</a></p>
      </div>
    </div>