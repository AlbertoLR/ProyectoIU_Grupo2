<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Create Client");
$client = $view->getVariable("client");
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
      <li class="breadcrumb-item active"><?= i18n("Modify Client") ?></li>
    </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Modify Client")?></h1>
        <form action="index.php?controller=client&amp;action=edit" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label><?= i18n("DNI") ?>:</label>
            <input type="text" name="dni" class="form-control" value="<?= $client->getDni()?>" placeholder="ej: 00000000A" minlength="9" maxlength="9" required="required" pattern="(([X-Zx-z]{1})([-]?)(\d{7})([-]?)([A-Za-z]{1}))|((\d{8})([-]?)([A-Za-z]{1}))" >
          </div>
          <div class="form-group">
            <label><?= i18n("Name") ?>:</label>
             <input type="text" name="name" class="form-control" value="<?= $client->getName()?>"  placeholder="ej: Juan" minlength="3" maxlength="16"  pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+">
          </div>
          <div class="form-group">
            <label><?= i18n("Surname") ?>:</label>
             <input type="text" name="surname" class="form-control" value="<?= $client->getSurname()?>" placeholder="ej: Fernández López" minlength="3" maxlength="25"  pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+">
          </div>
          <div class="form-group">
            <label><?= i18n("Birthdate") ?>:</label>
             <input type="text" name="birthdate" class="form-control" value="<?= $client->getBirthday()?>" placeholder="ej: 2015-12-15" id="datepicker">
          </div>
          <div class="form-group">
            <label><?= i18n("Profession") ?>:</label>
             <input type="text" name="profession" value="<?= $client->getProfession()?>" placeholder="ej: Camarero" minlength="3" maxlength="30" class="form-control">
          </div>
          <div class="form-group">
            <label><?= i18n("Phone") ?>:</label>
             <input type="number" name="phone" value="<?= $client->getPhone()?>" placeholder="ej: 666777888" min="100000000" max="999999999" class="form-control">
          </div>
          <div class="form-group">
            <label><?= i18n("Address") ?>:</label>
             <input type="text" name="address" class="form-control" value="<?= $client->getAddress()?>" placeholder="ej: Avenida de la Astronomía, 24, 28830, San Fernando de Henares, Madrid-ESPAÑA ">
          </div>
          <div class="form-group">
            <label><?= i18n("Email") ?>:</label>
             <input type="email" name="email" class="form-control" value="<?= $client->getEmail()?>" placeholder="ej: moovett@moovett.es">
          </div>
          <div class="form-group">
            <label><?= i18n("Bank account") ?>:</label>
             <input type="text" name="account" class="form-control" value="<?= $client->getAccount()?>" placeholder="ej: ES0000000000000000000000" minlength="24" maxlength="24" pattern="([Ee][Ss][0-9]{22})" >
          </div>
          <div class="form-group">
            <label><?= i18n("Alert Fault") ?>:</label>
            <select name="alert" class="form-control">
              <?php if ($client->getAlert() == TRUE): ?>
                  <option value="Yes" <?php echo "selected" ?>><?= i18n("Yes") ?></option>
                  <option value="No"><?= i18n("No") ?></option>
              <?php else: ?>
                  <option value="No" <?php echo "selected" ?>><?= i18n("No") ?></option>
                  <option value="Yes" ><?= i18n("Yes") ?></option>
              <?php endif ?>
            </select>
          </div>
          <div class="form-group">
            <label><?= i18n("Unemployed") ?>:</label>
            <select name="unemployed" class="form-control">
              <?php if ($client->getUnemployed() == TRUE): ?>
                <option value="Yes" <?php echo "selected" ?>><?= i18n("Yes") ?></option>
                <option value="No"><?= i18n("No") ?></option>
              <?php else: ?>
                  <option value="No" <?php echo "selected" ?>><?= i18n("No") ?></option>
                  <option value="Yes" ><?= i18n("Yes") ?></option>
              <?php endif ?>
            </select>
          </div>
          <div class="form-group">
            <label><?= i18n("Student") ?>:</label>
            <select name="student" class="form-control">
              <?php if ($client->getStudent() == TRUE): ?>
                <option value="Yes" <?php echo "selected" ?>><?= i18n("Yes") ?></option>
                <option value="No"><?= i18n("No") ?></option>
              <?php else: ?>
                  <option value="No" <?php echo "selected" ?>><?= i18n("No") ?></option>
                  <option value="Yes" ><?= i18n("Yes") ?></option>
              <?php endif ?>
            </select>
          </div>
          <div class="form-group">
            <label><?= i18n("Family") ?>:</label>
            <select name="family" class="form-control">
              <?php if ($client->getFamily() == TRUE): ?>
                <option value="Yes" <?php echo "selected" ?>><?= i18n("Yes") ?></option>
                <option value="No"><?= i18n("No") ?></option>
              <?php else: ?>
                  <option value="No" <?php echo "selected" ?>><?= i18n("No") ?></option>
                  <option value="Yes" ><?= i18n("Yes") ?></option>
              <?php endif ?>
            </select>
          </div>
          <div class="form-group">
            <label><?= i18n("Operating") ?>:</label>
            <select name="active" class="form-control">
               <?php if ($client->getActive() == TRUE): ?>
                 <option value="Yes" <?php echo "selected" ?>><?= i18n("Yes") ?></option>
               <?php else: ?>
                 <option value="No" <?php echo "selected" ?>><?= i18n("No") ?></option>
               <?php endif ?>
            </select>
          </div>
          <div class="form-group">
            <label><?= i18n("Asign Injury") ?>:</label>
            <select name="injury" class="form-control" >
                <option  value="" selected=""></option>
              <?php foreach($injuries as $injury) {?>
              <option value="<?= $injury["id"]?>"><?= $injury["descripcion"]?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label><?= i18n("Image") ?>:</label>
            <input type="file" name="photo"  accept="image/*">
          </div>
          <div class="form-group">
            <label><?= i18n("Comment") ?>:</label>
             <textarea name="comment" rows="5" class="form-control"><?= $client->getComment()?></textarea>
          </div>
              <input type="hidden" name="id" value="<?= $client->getID() ?>">
             <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
        </form>
    </div>
</div>
