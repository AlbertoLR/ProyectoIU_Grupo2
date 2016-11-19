<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Create User");
$user = $view->getVariable("user");
$profiles = $view->getVariable("profiles");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
      <h1><?= i18n("Create User")?></h1>
        <form action="index.php?controller=user&amp;action=insert" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label><?= i18n("DNI") ?>:</label>
            <input type="text" name="dni" class="form-control"  minlength="9" maxlength="9" pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))" >
          </div>
          <div class="form-group">
            <label><?= i18n("Username") ?>:</label>
      	     <input type="text" name="username" class="form-control">
          </div>
          <div class="form-group">
            <label><?= i18n("Password") ?>:</label>
            <input type="password" name="passwd" class="form-control">
          </div>
          <div class="form-group">
            <label><?= i18n("Profile") ?>:</label>
            <select name="profile" class="form-control">
              <option value=""></option>
              <?php foreach($profiles as $profile) {?>
                  <option value="<?= $profile->getProfileName()?>"><?= $profile->getProfileName()?></option>
              <?php }?>
            </select>
          </div>
          <div class="form-group">
            <label><?= i18n("Name") ?>:</label>
             <input type="text" name="name" class="form-control">
          </div>
          <div class="form-group">
            <label><?= i18n("Surname") ?>:</label>
             <input type="text" name="surname" class="form-control">
          </div>
          <div class="form-group">
            <label><?= i18n("Birthdate") ?>:</label>
             <input type="date" name="fecha_nac" class="form-control">
          </div>
          <div class="form-group">
            <label><?= i18n("Adress") ?>:</label>
             <input type="text" name="direccion" class="form-control">
          </div>
          <div class="form-group">
            <label><?= i18n("Bank account") ?>:</label>
             <input type="text" name="num_cuenta" class="form-control">
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
             <input type="email" name="email" class="form-control">
          </div>
          <div class="form-group">
            <label><?= i18n("Operating") ?>:</label>
            <select name="activo" class="form-control">
              <option value="Yes">Yes</option>
              <option value="No">No</option>
            </select>
          </div>
          <div class="form-group">
            <label><?= i18n("Image") ?>:</label>
            <input type="file" name="foto">
          </div>
          <div class="form-group">
            <label><?= i18n("Comment") ?>:</label>
             <textarea name="comentario" rows="5" class="form-control"></textarea>
          </div>
             <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
        </form>
    </div>
</div>
