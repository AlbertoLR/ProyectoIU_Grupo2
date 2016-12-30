<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Hours");
$hours = $view->getVariable("hours");
$ranks = $view->getVariable("ranks");
$seasons = $view->getVariable("seasons");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
    <h1><?= i18n("List of Hours")?></h1>
    <a href="index.php?controller=hour&action=add" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Create Hours")?></a>
    <a href="index.php?controller=hour&action=showused" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("View Used Hours")?></a>
<table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th><?= i18n("Day")?></th>
          <th><?= i18n("Start")?></th>
          <th><?= i18n("End")?></th>
          <th><?= i18n("Weekday")?></th>
          <th><?= i18n("Opening")?></th>
          <th><?= i18n("Closing")?></th>
          <th><?= i18n("Season")?></th>
          <th style="width: 72px;"></th>
        </tr>
      </thead>
      <tbody>
	  <?php foreach($hours as $hour){ ?>
      <?php if($hour->getActive()==false){ ?>
          <tr>
      	  <td><?php echo $hour->getID(); ?></td>
          <td><?php echo $hour->getDay(); ?></td>
          <td><?php echo $hour->getOpening(); ?></td>
          <td><?php echo $hour->getClosing(); ?></td>
          <?php foreach($ranks as $rank => $value){ ?>
          <?php if($value["id"]==$hour->getRankID()){ ?>
            <td><?php echo i18n($value["dia_s"]) ?></td>
            <td><?php echo $value["hora_apertura"]?></td>
            <td><?php echo $value["hora_cierre"]?></td>
            <?php foreach($seasons as $season => $values){ ?>
            <?php if($values["id"]==$value["horario_temporada_id"]){ ?>
              <td><?php echo $values["nombre_temp"]?></td>
              <?php }  } ?>
          	<?php }  }  ?>
          <td>
            <a href="index.php?controller=hour&action=delete&amp;id=<?php echo $hour->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
          </td>
          <?php } ?>
        </tr>
	       <?php } ?>
      </tbody>
    </table>
    </div>
</div>
