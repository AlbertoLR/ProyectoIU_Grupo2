<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Activitys");
$activitys = $view->getVariable("activitys");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("List of Activities") ?></li>
  </ol>
  </div>
    <div class="container">
        <h1><?= i18n("List of Activities")?></h1>
	<a href="index.php?controller=activity&action=add" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Create Activity")?></a>
  <a href="index.php?controller=activity&amp;action=search" class="btn btn-default"><i class="fa fa-search-plus" aria-hidden="true"></i> <?= i18n("Advanced Search") ?></a>
<table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th><?= i18n("Activity")?></th>
          <th style="width: 72px;"></th>
        </tr>
      </thead>
      <tbody>
	  <?php foreach($activitys as $activity){ ?>
          <tr>
	  <td><?php echo $activity->getID(); ?></td>
          <td><?php echo $activity->getActivityName(); ?></td>
          <td>
              <a href="index.php?controller=activity&action=showone&id=<?php echo $activity->getID();  ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a>
              <a href="index.php?controller=activity&action=edit&id=<?php echo $activity->getID();  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
              <a href="index.php?controller=activity&action=delete&id=<?php echo $activity->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
          </td>
        </tr>
	<?php } ?>
      </tbody>
</table>
    </div>
</div>
