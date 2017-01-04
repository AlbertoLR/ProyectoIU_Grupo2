<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Update Document");
$document = $view->getVariable("document");
$users = $view->getVariable("users");
$clients = $view->getVariable("clients");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=document&amp;action=show"><?= i18n("List of Documents") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Update Document") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Update Document")?></h1>
        <form action="index.php?controller=document&amp;action=edit" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label><?= i18n("User") ?>:</label>
            <select name="dni" class="form-control">
                  <option value=""></option>
              <?php foreach($users as $user) {?>
                 <?php if ($user->getDNI() == $document->getDNI()): ?>
                   <option value="<?= $user->getDNI()?>" selected><?= $user->getSurname().", ".$user->getName().":".$user->getDNI() ?></option>
                 <?php else:?>
                  <option value="<?= $user->getDNI()?>"><?= $user->getSurname().", ".$user->getName().":".$user->getDNI() ?></option>
                 <?php endif ?>
              <?php }?>
            </select>
          </div>
          <div class="form-group">
            <label><?= i18n("Client") ?>:</label>
            <select name="dni_c" class="form-control">
              <option value=""></option>
              <?php foreach($clients as $client) {?>
                 <?php if ($client->getDNI() == $document->getDNIC()): ?>
                   <option value="<?= $client->getDNI()?>" selected><?= $client->getSurname().", ".$client->getName().":".$user->getDNI() ?></option>
                 <?php else:?>
                  <option value="<?= $client->getDNI()?>"><?= $client->getSurname().", ".$client->getName().":".$client->getDNI() ?></option>
                 <?php endif ?>
              <?php }?>
            </select>
          </div>
          <div class="form-group">
            <label><?= i18n("Type") ?>:</label>
            <select name="type" class="form-control">
              <option value="sepa" <?php if ($document->getType() == "sepa") { echo "selected"; } ?>>SEPA</option>
              <option value="lopd" <?php if ($document->getType() == "lopd") { echo "selected"; } ?>>LOPD</option>
              <option value="dni" <?php if ($document->getType() == "dni") { echo "selected"; } ?>>DNI</option>
              <option value="other" <?php if ($document->getType() == "other") { echo "selected"; } ?>>Other</option>
            </select>
          </div>
          <div class="form-group">
            <label><?= i18n("Document") ?>:</label>
            <input type="file" name="file">
          </div>
        <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
        </form>
    </div>
</div>