<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Show Event");
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
				<?=i18n("Event")?>
			</li>
		</ol>
	</div>
    <div class="container">
        <h1><?= i18n("Event")?></h1>
				<a href="index.php?controller=event&amp;action=inscription&amp;id=<?=$event->getID()?>" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("View Inscriptions") ?></a>
        <table class="table top-buffer">
        <thead>
          <tr class="active">
            <th class="col-sm-2"><?= i18n("Identifier")?></th>
            <td class="col-sm-10"><?= $event->getID() ?></td>

          </tr>
        </thead>
        <tbody>
          <tr>
            <th><?= i18n("Name")?></th>
            <td><?= $event->getNombre() ?></td>
		  </tr>
		  <tr>
			<th><?= i18n("Price")?></th>
            <td><?= $event->getPrecio() ?>€</td>
          </tr>
        </tbody>
      </table>
    </div>
</div>
