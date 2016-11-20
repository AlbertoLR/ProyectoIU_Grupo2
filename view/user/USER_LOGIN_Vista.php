<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$controllers = array('user', 'profile', 'controller', 'action', 'permission');
$currentuser = $view->getVariable("currentusername");
$view->setVariable("title", "Login");
$errors = $view->getVariable("errors");
$permissions = $view->getVariable("permissions");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>
    <div class="jumbotron">
	<div class="container">
	    <?php if (isset($currentuser)): ?>
		<h1><?= sprintf(i18n("Welcome to Moovet %s"), $currentuser) ?></h1>
      <p>Administer this site:</p>
    <div class="row">
	    <?php foreach ($controllers as $controller) {?>
        <div class="col-sm-4 form-group" >
          <a class="btn btn-primary btn-lg btn-block" href="index.php?controller=<?php echo $controller ?>&amp;action=show" role="button">Administer <?php echo $controller ?>s  here &raquo;</a>
        </div>
      <?php }?>
    </div>
	    <?php else: ?>
	      <h1><?= i18n("Welcome to Moovet") ?></h1>
              <p>Please Login</p>
	     <?php endif ?>
      </div>
    </div>