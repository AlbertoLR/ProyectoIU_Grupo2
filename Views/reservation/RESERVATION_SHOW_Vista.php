<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Reservations");
$reservations = $view->getVariable("reservations");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
	<div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("List of Reservations") ?></li>
  </ol>
  </div>
    <div class="container">
        <h1><?= i18n("List of Reservations")?></h1>
	<a href="index.php?controller=reservation&action=add" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Create Reservation")?></a>
<table class="table">
      <thead>
        <tr>
          <th>#</th>
		  <th><?= i18n("Client")?></th>
		  <th><?= i18n("Session")?></th>
		  <th><?= i18n("Space")?></th>
		  <th><?= i18n("Date")?></th>
		  <th><?= i18n("Space Price")?></th>
		  <th><?= i18n("Physio Price")?></th>
          <th style="width: 72px;"></th>
        </tr>
      </thead>
      <tbody>
	  <?php foreach($reservations as $reservation){ ?>
          <tr>
	  <td><?php echo $reservation->getID(); ?></td>
	  <td><?php echo $reservation->getClientId(); ?></td>
	  <td><?php echo $reservation->getSessionId(); ?></td>
	  <td><?php echo $reservation->getSpaceid(); ?></td>
	  <td><?php if ($reservation->getDay()== "0000-00-00"){
				echo " ";
				} else {
				echo $reservation->getDay(); } ?></td>
	  <td><?php echo $reservation->getSpacePrice(); ?></td>
	  <td><?php echo $reservation->getPhysioPrice(); ?></td>
          <td>
              <a href="index.php?controller=reservation&action=showone&amp;id=<?php echo $reservation->getID();  ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a>
              <a href="index.php?controller=reservation&action=edit&amp;id=<?php echo $reservation->getID();  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
              <a href="index.php?controller=reservation&action=delete&amp;id=<?php echo $reservation->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
          </td>
        </tr>
	<?php } ?>
      </tbody>
</table>
    </div>
</div>
