<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Sessions");
$sessions = $view->getVariable("sessions");
$hours = $view->getVariable("hours");
$activities = $view->getVariable("activities");
$events = $view->getVariable("events");
$users = $view->getVariable("users");
$spaces = $view->getVariable("spaces");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("List of Sessions") ?></li>
  </ol>
  </div>
    <div class="container">
    <h1><?= i18n("List of Sessions")?></h1>
	<a href="index.php?controller=session&action=add" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Create Session")?></a>
  <a href="index.php?controller=session&amp;action=search" class="btn btn-default"><i class="fa fa-search-plus" aria-hidden="true"></i> <?= i18n("Advanced Search") ?></a>

<table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th><?= i18n("Day")?></th>
          <th><?= i18n("Start")?></th>
          <th><?= i18n("End")?></th>
          <th><?= i18n("Activity/Event")?></th>
            <th><?= i18n("User")?></th>
          <th><?= i18n("Space")?></th>
          <th style="width: 72px;"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($sessions as $session){ ?>
              <tr>
                <td><?php echo $session->getID(); ?></td>
                <?php foreach($hours as $hour => $value){ ?>
                  <?php if($value["id"]==$session->getHoursID()) {?>
                   <td><?php echo i18n(date('l', strtotime($value["dia"]))) ."-" .$value["dia"] ?></td>
                   <td><?php echo $value["hora_inicio"] ?></td>
                   <td><?php echo $value["hora_fin"] ?></td>
                <?php } } ?>

                <?php if($session->getActivityID()) {?>
                <?php foreach($activities as $activity => $value){ ?>
                  <?php if($value["id"]==$session->getActivityID()) {?>
                   <td><?php echo $value["nombre"] ?></td>
                <?php } } } else { ?>
                  <?php if($session->getEventID()) {?>
                    <?php foreach($events as $event => $value){ ?>
                    <?php if($value["id"]==$session->getEventID()) {?>
                      <td><?php echo $value["nombre"] ?></td>
                  <?php }}} else { ?>
                    <td><?php echo i18n("No") ?></td>
                  <?php } ?>
                <?php } ?>

                <?php foreach($users as $user=> $value){ ?>
                  <?php if($value["id"]==$session->getUserID()) {?>
                   <td><?php echo $value["name"] ?></td>
                  <?php } } ?>

                <?php foreach($spaces as $space => $value){ ?>
                  <?php if($value["id"]==$session->getSpaceID()) {?>
                   <td><?php echo $value["nombre"] ?></td>
                <?php } } ?>
                <td>
                    <a href="index.php?controller=session&action=edit&id=<?php echo $session->getID();  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
                    <a href="index.php?controller=session&action=delete&id=<?php echo $session->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
                </td>
            </tr>
             <?php } ?>
      </tbody>
    </table>
    </div>
</div>
