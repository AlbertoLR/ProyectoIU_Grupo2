<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Search Document");
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
    <li class="breadcrumb-item active"><?= i18n("Search Document") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Create Document")?></h1>
        <form action="index.php?controller=document&amp;action=search" method="POST">
          <div class="form-group">
            <label><?= i18n("User") ?>:</label>
            <select name="dni" class="form-control">
              <option value="" selected></option>
              <?php foreach($users as $user) {?>
                  <option value="<?= $user->getDNI()?>"><?= $user->getSurname().", ".$user->getName().":".$user->getDNI() ?></option>
              <?php }?>
            </select>
          </div>
          <div class="form-group">
            <label><?= i18n("Client") ?>:</label>
            <select name="dni_c" class="form-control">
              <option value="" selected></option>
              <?php foreach($clients as $client) {?>
                  <option value="<?= $client->getDNI()?>"><?= $client->getSurname().", ".$client->getName().":".$user->getDNI() ?></option>
              <?php }?>
            </select>
          </div>
          <div class="form-group">
            <label><?= i18n("Type") ?>:</label>
            <select name="type" class="form-control">
	      <option value="" selected></option>
              <option value="sepa">SEPA</option>
              <option value="lopd">LOPD</option>
              <option value="dni">DNI</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label><?= i18n("Document") ?>:</label>
             <input type="text" name="file" class="form-control"  placeholder="ej: Cousa.pdf"  pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\.\s]+">
          </div>
        <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
        </form>
    </div>
</div>
