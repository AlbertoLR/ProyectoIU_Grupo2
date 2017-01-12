<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Update Event");
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
				<?=i18n("Edit Event")?>
			</li>
		</ol>
	</div>
    <div class="container">
      <h1><?= i18n("Update Event")?></h1>
      <form action="index.php?controller=event&amp;action=edit" method="POST">
        <div class="form-group">
          <label><?= i18n("Name") ?>:</label>
          <input type="text" name="nombre" class="form-control" value="<?php echo $event->getNombre(); ?>" minlength="2" required="required">
				</div>
				<div class="form-group">	
				  <label><?= i18n("Price") ?>:</label>
				  <input type="smallint" name="precio" class="form-control" value="<?php echo $event->getPrecio(); ?>" minlength="2" required="required">
          <input type="hidden" name="id" value="<?= $event->getID() ?>">
        </div>
        <button type="submit" name="submit"class="btn btn-default"><?= i18n("Update") ?></button>
      </form>
    </div>
</div>
