<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Events");
$events = $view->getVariable("events");
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
			<li class="breadcrumb-itemactive">
				<?=i18n("Show Events")?>
			</li>
		</ol>
	</div>
    <div class="container">
    <h1><?= i18n("List of Events")?></h1>
	<a href="index.php?controller=event&action=add" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Create Event")?></a>
	<a href="index.php?controller=event&amp;action=search" class="btn btn-default"><i class="fa fa-search-plus" aria-hidden="true"></i> <?= i18n("Advanced Search") ?></a>

<table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th><?= i18n("Event")?></th>
          <th style="width: 72px;"></th>
        </tr>
      </thead>
      <tbody>
	  <?php foreach($events as $event){ ?>
          <tr>
	  <td><?php echo $event->getID(); ?></td>
          <td><?php echo $event->getNombre(); ?></td>
          <td>
              <a href="index.php?controller=event&action=showone&amp;id=<?php echo $event->getID();  ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a>
              <a href="index.php?controller=event&action=edit&amp;id=<?php echo $event->getID();  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
              <a href="index.php?controller=event&action=delete&amp;id=<?php echo $event->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
          </td>
        </tr>
	<?php } ?>
      </tbody>
</table>
    </div>
</div>
