<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Delete Injury");
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
    <li class="breadcrumb-item active"><?= i18n("Delete Injury") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Delete Injury")." ".$injury->getInjuryDescription()?></h1>
      <form action="index.php?controller=injury&amp;action=delete" method="POST">
        <button type="submit" name="submit" value="yes" class="btn btn-default"><?= i18n("Yes") ?></button>
        <button type="submit" name="submit" value="no" class="btn btn-default"><?= i18n("No") ?></button>
        <input type="hidden" name="id" value="<?= $injury->getID() ?>">
      </form>
      <div class="row top-buffer">
        <table class="table">
        <tbody>
          <tr class="active">
            <th class="col-sm-2"><?= i18n("Identifier")?></th>
            <td class="col-sm-10"><?= $injury->getID() ?></td>
          </tr>
        </tbody>
        <tbody>
          <tr>
            <th><?= i18n("Description")?></th>
            <td><?= $injury->getInjuryDescription() ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
