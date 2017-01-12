<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Delete Event");
$event = $view->getVariable("event");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
	<div class="design">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="index.php?controller=user&amp;action=login">
					<?=i18n("Home")?>
				</a>
			</li>
			<li class="breadcrumb-item">
				<a href="index.php?controller=event&amp;action=show">
					<?=i18n("Show Events")?>
				</a>
			</li>
			<li class="breadcrumb-itemactive">
				<?=i18n("Delete Event")?>
			</li>
		</ol>
	</div>
    <div class="container">
        <h1><?= i18n("Delete Event")." ".$event->getNombre()?></h1>
		<p><?= i18n("Name").": ".$event->getNombre()?></p>
		<p><?= i18n("Price").": ".$event->getPrecio()?>€</p>
      <form action="index.php?controller=event&amp;action=delete" method="POST">
        <button type="submit" name="submit" value="yes" class="btn btn-default"><?= i18n("Yes") ?></button>
        <button type="submit" name="submit" value="no" class="btn btn-default"><?= i18n("No") ?></button>
        <input type="hidden" name="id" value="<?= $event->getID() ?>">
      </form>
    </div>
</div>
