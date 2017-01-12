<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Delete Space");
$space = $view->getVariable("space");
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
				<a href="index.php?controller=space&amp;action=show">
					<?=i18n("Show Spaces")?>
				</a>
			</li>
			<li class="breadcrumb-itemactive">
				<?=i18n("Delete Space")?>
			</li>
		</ol>
	</div>
    <div class="container">
        <h1><?= i18n("Delete Space")." ".$space->getNombre()?></h1>
		<p><?= i18n("ID").": ".$space->getID()?></p>
		<p><?= i18n("Name").": ".$space->getNombre()?></p>
      <form action="index.php?controller=space&amp;action=delete" method="POST">
        <button type="submit" name="submit" value="yes" class="btn btn-default"><?= i18n("Yes") ?></button>
        <button type="submit" name="submit" value="no" class="btn btn-default"><?= i18n("No") ?></button>
        <input type="hidden" name="id" value="<?= $space->getID() ?>">
      </form>
    </div>
</div>
