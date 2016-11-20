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
            <th><?= i18n("Profile")?></th>
            <td><?= $profile->getProfileName() ?></td>
          </tr>
        </tbody>
      </table>
    </div>
</div>
