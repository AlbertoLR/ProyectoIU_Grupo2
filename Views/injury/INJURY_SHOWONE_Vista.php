<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Show Injury");
$injury = $view->getVariable("injury");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=injury&amp;action=show"><?= i18n("List of Injuries") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Injury") ?></li>
  </ol>
  </div>
    <div class="container">
        <h1><?= i18n("Injury")?></h1>
        <table class="table">
        <thead>
          <tr class="active">
            <th class="col-sm-2"><?= i18n("Identifier")?></th>
            <td class="col-sm-10"><?= $injury->getID() ?></td>

          </tr>
        </thead>
        <tbody>
          <tr>
            <th><?= i18n("Description")?></th>
            <td><?= $injury->getInjuryDescription() ?></td>
          </tr>
        </tbody>
      </table>
    </div>
</div>
