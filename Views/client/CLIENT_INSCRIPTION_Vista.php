<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Create Client");
$inscriptions = $view->getVariable("inscriptions");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
      <h1><?= i18n("Client Inscriptions")?></h1>
    <table class="table top-buffer">
          <thead>
            <tr>
              <th>#</th>
              <th><?= i18n("Activity") ?></th>
              <th><?= i18n("Date") ?></th>
              <th><?= i18n("Space") ?></th>
              <th style="width: 72px;"></th>
            </tr>
          </thead>
          <tbody>
        <?php if($inscriptions!=NULL){ ?>
        <?php foreach($inscriptions as $inscription){ ?>
              <tr>
            <td><?php echo $inscription["id"]; ?></td>
              <td><?php echo $inscription["actividad"]; ?></td>
              <td><?php echo $inscription["fecha"]; ?></td>
              <td><?php echo $inscription["nombre"]; ?></td>
              <td>
                  <a href="index.php?controller=inscription&amp;action=showone&amp;id=<?php echo $inscription["id"];  ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a>
                  <a href="index.php?controller=inscription&amp;action=edit&amp;id=<?php echo $inscription["id"];  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
                  <a href="index.php?controller=inscription&amp;action=delete&amp;id=<?php echo $inscription["id"];  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
              </td>
            </tr>
      <?php } } ?>
          </tbody>
    </table>
  </div>
</div>
