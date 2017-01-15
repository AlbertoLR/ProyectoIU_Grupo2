<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Show Reservation");
$reservation = $view->getVariable("reservation");
$client=$view->getVariable("client");
$session=$view->getVariable("session");
$space=$view->getVariable("space");
$spaceprice=$view->getVariable("spaceprice");
$physioprice=$view->getVariable("physioprice");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
	<div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=reservation&amp;action=show"><?= i18n("List of Reservation") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Detailed Reservation") ?></li>
  </ol>
  </div>
    <div class="container">
        <h1><?= i18n("Show Reservation") ?></h1>
      <div class="row top-buffer">
        <table class="table">
		<tbody>
          <tr type="hidden">
            <th><?= i18n("#")?></th>
            <td><?= $reservation->getID() ?></td>
          </tr>
        </tbody>
        <tbody>
          <tr>
            <th><?= i18n("Client")?></th>
            <td><?= $reservation->getClientId() ?></td>
          </tr>
        </tbody>
        <tbody>
            <th><?= i18n("Session")?></th>
            <td><?= $reservation->getSessionId() ?></td>
        </tbody>
        <tbody>
            <th><?= i18n("Space")?></th>
              <td><?=$reservation->getSpaceid() ?></td>
        </tbody>
        <tbody>
          <tr>
            <th><?= i18n("Space Price")?></th>
              <td><?=$reservation->getSpacePrice() ?></td>
          </tr>
        </tbody>
		<tbody>
          <tr>
            <th><?= i18n("Physio Price")?></th>
              <td><?=$reservation->getPhysioPrice() ?></td>
          </tr>
        </tbody>
        </table>
    </div>
    </div>
</div>
