<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "User Injuries");
$injuries = $view->getVariable("injuries");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=show"><?= i18n("List of Users") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("User Injuries") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("User Injuries")?></h1>
    <table class="table top-buffer">
          <thead>
            <tr>
              <th><?= i18n("User DNI") ?></th>
              <th><?= i18n("User Name") ?></th>
              <th><?= i18n("User Surname") ?></th>
              <th><?= i18n("Injury") ?></th>
              <th><?= i18n("Username") ?></th>
              <th><?= i18n("Date") ?></th>
              <th><?= i18n("Hour") ?></th>
              <th><?= i18n("Discharge") ?></th>
            </tr>
          </thead>
          <tbody>
        <?php if($injuries!=NULL){ ?>
        <?php  foreach ($injuries as $key => $value) { ?>
              <tr>
                <td><?=$value["dni"] ?></td>
                <td><?=$value["name"] ?></td>
                <td><?=$value["surname"] ?></td>
                <td><?=$value["descripcion"] ?></td>
                <td><?=$value["username"] ?></td>
                <td><?=$value["fecha"] ?></td>
                <td><?=$value["hora"] ?></td>
                <td><?=$value["alta"] ?></td>
                <td>
                <?php  if($value["alta"]==NULL ) { ?>
                  <form action="index.php?controller=user&amp;action=discharge" method="POST" >
                    <input type="hidden" name="lesion_id" value="<?= $value["lesion_id"]?>">
                    <input type="hidden" name="user_id" value="<?= $value["user_id"]?>">
                    <input type="hidden" name="fecha" value="<?= $value["fecha"]?>">
                    <button type="submit" name="submit"class="btn btn-default"><?= i18n("Apply discharge") ?></button>
                  </form>
                </td>
            </tr>
      <?php } } } ?>
          </tbody>
    </table>
  </div>
</div>
