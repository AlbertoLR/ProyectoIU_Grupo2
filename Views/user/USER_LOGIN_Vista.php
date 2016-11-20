<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$restrictions = array('userperm', 'profileperm');
$currentuser = $view->getVariable("currentusername");
$controllers = $view->getVariable("user_controllers");
$view->setVariable("title", "Login");
$errors = $view->getVariable("errors");
$permissions = $view->getVariable("permissions");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>
    <div class="jumbotron">
	<div class="container">
	    <?php if (isset($currentuser)): ?>
		<h1><?= sprintf(i18n("Welcome to Moovett %s"), $currentuser) ?></h1>
      <p><?= i18n("Administer this site") ?></p>
    <div class="row">
	    <?php foreach ($controllers as $controller) {?>
            <?php if (!in_array($controller, $restrictions)): ?>
        <div class="col-sm-4 form-group" >
          <a class="btn btn-primary btn-lg btn-block" href="index.php?controller=<?php echo $controller ?>&amp;action=show" role="button"><?= i18n($controller) ?>s &raquo;</a>
        </div>
            <?php endif ?>
      <?php }?>
    </div>
	    <?php else: ?>
	      <h1><?= i18n("Welcome to Moovett") ?></h1>
              <p><?= i18n("Please Login") ?></p>
	     <?php endif ?>
      </div>
    </div>
