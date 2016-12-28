<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Seasons");
$seasons = $view->getVariable("seasons");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
    <h1><?= i18n("List of Seasons")?></h1>
	<a href="index.php?controller=season&action=add" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Create Season")?></a>
<table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th><?= i18n("Name")?></th>
          <th><?= i18n("Start Day")?></th>
          <th><?= i18n("End Day")?></th>
          <th style="width: 72px;"></th>
        </tr>
      </thead>
      <tbody>
	  <?php foreach($seasons as $season){ ?>
          <tr>
      	  <td><?php echo $season->getID(); ?></td>
          <td><?php echo $season->getDescription(); ?></td>
          <td><?php echo $season->getdateStart(); ?></td>
          <td><?php echo $season->getdateEnd(); ?></td>
          <td>
              <a href="index.php?controller=season&action=edit&amp;id=<?php echo $season->getID();  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
              <a href="index.php?controller=season&action=delete&amp;id=<?php echo $season->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
          </td>
        </tr>
	<?php } ?>
      </tbody>
</table>
    </div>
</div>
