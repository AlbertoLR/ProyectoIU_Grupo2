<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Show Profile");
$profile = $view->getVariable("profile");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=profile&amp;action=show"><?= i18n("List of Profiles") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Profile") ?></li>
  </ol>
  </div>
    <div class="container">
        <h1><?= i18n("Profile")?></h1>
        <table class="table">
        <thead>
          <tr class="active">
            <th class="col-sm-2"><?= i18n("Identifier")?></th>
            <td class="col-sm-10"><?= $profile->getID() ?></td>

          </tr>
        </thead>
        <tbody>
          <tr>
            <th><?= i18n("Name")?></th>
            <td><?= $profile->getProfileName() ?></td>
          </tr>
        </tbody>
      </table>
    </div>
</div>
