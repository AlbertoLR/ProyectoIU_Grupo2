<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Create User");
$user = $view->getVariable("user");
$profiles = $view->getVariable("profiles");
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
    <li class="breadcrumb-item active"><?= i18n("Create User") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Create User")?></h1>
        <form action="index.php?controller=user&amp;action=add" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label><?= i18n("DNI") ?>:</label>
            <input type="text" name="dni" id="dni" class="form-control"  placeholder="ej: 00000000A" minlength="9" maxlength="9" required="required" pattern="(([X-Zx-z]{1})([-]?)(\d{7})([-]?)([A-Za-z]{1}))|((\d{8})([-]?)([A-Za-z]{1}))" >
          </div>
          <div class="form-group">
            <label><?= i18n("Username") ?>:</label>
      	     <input type="text" name="username" class="form-control" minlength="5" maxlength="14">
          </div>
          <div class="form-group">
            <label><?= i18n("Password") ?>:</label>
            <input type="password" name="passwd" class="form-control" minlength="4" maxlength="14">
          </div>
          <div class="form-group">
            <label><?= i18n("Profile") ?>:</label>
            <select name="profile" class="form-control" id="profile">
              <option value="" selected></option>
              <?php foreach($profiles as $profile) {?>
                  <option value="<?= $profile->getProfileName()?>"><?= $profile->getProfileName()?></option>
              <?php }?>
            </select>
          </div>
          <div class="form-group">
            <label><?= i18n("Name") ?>:</label>
             <input type="text" name="name" class="form-control"  placeholder="ej: Juan"  pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+">
          </div>
          <div class="form-group">
            <label><?= i18n("Surname") ?>:</label>
             <input type="text" name="surname" class="form-control" placeholder="ej: Fernández López"  pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+">
          </div>
          <div class="form-group">
            <label><?= i18n("Birthdate") ?>:</label>
             <input type="text" name="fecha_nac" class="form-control" placeholder="ej: 2015-12-15" id="datepicker">
          </div>
          <div class="form-group">
            <label><?= i18n("Address") ?>:</label>
             <input type="text" name="direccion" class="form-control" placeholder="ej: Avenida de la Astronomía, 24, 28830, San Fernando de Henares, Madrid-ESPAÑA ">
          </div>
          <div class="form-group">
            <label><?= i18n("Bank account") ?>:</label>
             <input type="text" name="num_cuenta" class="form-control" placeholder="ej: ES0000000000000000000000" minlength="24" maxlength="24" pattern="([Ee][Ss][0-9]{22})" >
          </div>
          <div class="form-group">
            <label><?= i18n("Contract") ?>:</label>
            <select name="tipo_contrato" class="form-control">
              <option value="Indefinido">Indefinido</option>
              <option value="Temporal">Temporal</option>
              <option value="Para la formacion y el aprendizaje">Para la formación y el aprendizaje</option>
              <option value="Practicas">Prácticas</option>
            </select>
          </div>
          <div class="form-group">
            <label><?= i18n("Email") ?>:</label>
             <input type="email" name="email" class="form-control" placeholder="ej: moovett@moovett.es">
          </div>
          <div class="form-group">
            <label><?= i18n("Operating") ?>:</label>
            <select name="activo" class="form-control">
              <option value="Yes"><?= i18n("Yes") ?></option>
              <option value="No"><?= i18n("No") ?></option>
            </select>
          </div>
          <div class="form-group" style="visibility: hidden; display:none" id="show">
            <label><?= i18n("Asign Injury") ?>:</label>
            <select name="injury" class="form-control">
              <option  value=""></option>
              <?php foreach($injuries as $injury) {?>
              <option value="<?= $injury["id"]?>"><?= $injury["descripcion"]?></option>
              <?php }?>
            </select>
          </div>
          <div class="form-group">
            <label><?= i18n("Image") ?>:</label>
            <input type="file" name="foto" accept="image/*">
          </div>
          <div class="form-group">
            <label><?= i18n("Comment") ?>:</label>
             <textarea name="comentario" rows="5" class="form-control"></textarea>
          </div>
             <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
        </form>
    </div>
</div>
