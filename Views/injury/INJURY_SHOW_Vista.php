<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Injuries");
$injuries = $view->getVariable("injuries");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
    <h1><?= i18n("List of Injuries")?></h1>
	   <a href="index.php?controller=injury&action=add" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Create Injury")?></a>
    <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th><?= i18n("Injury")?></th>
              <th style="width: 72px;"></th>
            </tr>
          </thead>
          <tbody>
    	  <?php foreach($injuries as $injury){ ?>
              <tr>
    	  <td><?php echo $injury->getID(); ?></td>
              <td><?php echo $injury->getInjuryDescription(); ?></td>
              <td>
                  <a href="index.php?controller=injury&action=showone&amp;id=<?php echo $injury->getID();  ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a>
                  <a href="index.php?controller=injury&action=edit&amp;id=<?php echo $injury->getID();  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
                  <a href="index.php?controller=injury&action=delete&amp;id=<?php echo $injury->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
              </td>
            </tr>
    	<?php } ?>
          </tbody>
    </table>
    </div>
</div>
