<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Rankhours");
$rankhours = $view->getVariable("rankhours");
$seasons = $view->getVariable("seasons");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
    <h1><?= i18n("List of Rankhours")?></h1>
	<a href="index.php?controller=rankhour&action=add" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Create Rankhour")?></a>
<table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th><?= i18n("Day")?></th>
          <th><?= i18n("Opening")?></th>
          <th><?= i18n("Closing")?></th>
          <th><?= i18n("Season")?></th>
          <th style="width: 72px;"></th>
        </tr>
      </thead>
      <tbody>
	  <?php foreach($rankhours as $rankhour){ ?>
          <tr>
      	  <td><?php echo $rankhour->getID(); ?></td>
          <td><?php echo i18n($rankhour->getDay()); ?></td>
          <td><?php echo $rankhour->getOpening(); ?></td>
          <td><?php echo $rankhour->getClosing(); ?></td>
          <?php foreach($seasons as $season => $value){ ?>
          <?php if($value["id"]==$rankhour->getSeasonID()){ ?>
            <td><?php echo $value["nombre_temp"]?></td>
          	<?php }  } ?>
          <td>
            <a href="index.php?controller=rankhour&action=delete&amp;id=<?php echo $rankhour->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
          </td>
        </tr>
	       <?php } ?>
      </tbody>
    </table>
    </div>
</div>
