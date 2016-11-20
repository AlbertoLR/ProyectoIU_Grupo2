<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Update User");
$user = $view->getVariable("user");
$profiles = $view->getVariable("profiles");
$errors = $view->getVariable("errors");
$date_array=getDate();
$date = $date_array['year']. "-" .$date_array['mon']. "-" .$date_array['mday'];
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
      <h1><?= i18n("Update User")?></h1>
      <div class="form-group">
      </div>
      <form action="index.php?controller=user&amp;action=edit" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label><?= i18n("DNI") ?>:</label>
          <input type="text" name="dni" class="form-control" value="<?= $user->getDni()?>"  minlength="9" maxlength="9" pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))" >
        </div>
        <div class="form-group">
          <label><?= i18n("Username") ?>:</label>
           <input type="text" name="username" class="form-control" value="<?= $user->getUsername()?>" minlength="5" maxlength="14">
        </div>
        <div class="form-group">
          <label><?= i18n("Password") ?>:</label>
          <input type="password" name="passwd" class="form-control" minlength="4" maxlength="14">
        </div>
        <div class="form-group">
          <label><?= i18n("Profile") ?>:</label>
          <select name="profile" class="form-control">
            <?php foreach($profiles as $profile) {?>
                <option value="<?= $profile->getProfileName()?>"><?= $profile->getProfileName()?></option>
            <?php }?>
          </select>
        </div>
        <div class="form-group">
          <label><?= i18n("Name") ?>:</label>
           <input type="text" name="name" class="form-control" value="<?= $user->getName()?>"  pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+">
        </div>
        <div class="form-group">
          <label><?= i18n("Surname") ?>:</label>
           <input type="text" name="surname" class="form-control" value="<?= $user->getSurname()?>"  pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+">
        </div>
        <div class="form-group">
          <label><?= i18n("Birthdate") ?>:</label>
           <input type="date" name="fecha_nac" class="form-control" value="<?= $user->getFechaNac()?>" max="<?= $date?>">
        </div>
        <div class="form-group">
          <label><?= i18n("Adress") ?>:</label>
           <input type="text" name="direccion" class="form-control" value="<?= $user->getDireccion()?>">
        </div>
        <div class="form-group">
          <label><?= i18n("Bank account") ?>:</label>
           <input type="text" name="num_cuenta" class="form-control" value="<?= $user->getNumCuenta()?>" minlength="24" maxlength="24" pattern="(ES[0-9]{22})">
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
           <input type="email" name="email" class="form-control" value="<?= $user->getEmail()?>">
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
          <input type="file" name="foto" accept="image/*">
        </div>
        <div class="form-group">
          <label><?= i18n("Comment") ?>:</label>
           <textarea name="comentario" rows="5" class="form-control"><?= $user->getComentario()?></textarea>
        </div>
        <input type="hidden" name="id" value="<?= $user->getID() ?>">
        <button type="submit" name="submit"class="btn btn-default"><?= i18n("Update") ?></button>
      </form>
      </div>
</div>
