<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Create Client");
$injuries = $view->getVariable("injuries");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=client&amp;action=show"><?= i18n("List of Clients") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Client Injuries") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Client Injuries")?></h1>
    <table class="table top-buffer">
          <thead>
            <tr>
              <th><?= i18n("Client DNI") ?></th>
              <th><?= i18n("Client Name") ?></th>
              <th><?= i18n("Client Surname") ?></th>
              <th><?= i18n("Injury") ?></th>
              <th><?= i18n("Username") ?></th>
              <th><?= i18n("Date") ?></th>
              <th><?= i18n("Hour") ?></th>
            </tr>
          </thead>
          <tbody>
        <?php if($injuries!=NULL){ ?>
        <?php foreach($injuries as $injury => $value){ ?>
              <tr>
                <td><?=$value["dni_c"] ?></td>
                <td><?=$value["nombre_c"] ?></td>
                <td><?=$value["apellidos_c"] ?></td>
                <td><?=$value["descripcion"] ?></td>
                <td><?=$value["username"] ?></td>
                <td><?=$value["fecha"] ?></td>
                <td><?=$value["hora"] ?></td>
            </tr>
      <?php } }  ?>
          </tbody>
    </table>
  </div>
</div>
