<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Create Reservation");
$clients=$view->getVariable("clients");
$sessions=$view->getVariable("sessions");
$spaces=$view->getVariable("spaces");
$spaceprice=$view->getVariable("spaceprice");
$physioprice=$view->getVariable("physioprice");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
	<div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=reservation&amp;action=show"><?= i18n("List of  Reservation") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Add Reservation") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Create reservation")?></h1>
      <form action="index.php?controller=reservation&amp;action=add" method="POST">
      <div class="form-group">
                <label><?= i18n("Client") ?>:</label>
                <select name="dni_c" class="form-control">
                  <option value="" selected></option>
                  <?php foreach($clients as $client => $value) {?>
                    <?php if($value["activo"]==TRUE) {?>
                        <option value="<?php echo $value["dni_c"] ?>"><?= $value["apellidos_c"] .  "," . " " . $value["nombre_c"] ?></option>
                  <?php }} ?>
                </select>
      </div>
      <div class="form-group">
        <label><?= i18n("Session") ?>:</label>
         <select name="id_sesion" class="form-control">
                  <option value="" selected></option>
                  <?php foreach($sessions as $session => $value) {?>
                        <option value="<?php echo $value["id"] ?>"><?= $value["id"] ?></option>
                  <?php } ?>
         </select>
      </div>
      <div class="form-group">
        <label><?= i18n("Space") ?>:</label>
        <select name="id_espacio" class="form-control">
                  <option value="" selected></option>
                  <?php foreach($spaces as $space => $value) {?>
                        <option value="<?php echo $value["id"] ?>"><?= $value["nombre"] ?></option>
                  <?php } ?>
         </select>
      </div>
	  <div class="form-group">
        <label><?= i18n("Day") ?>:</label>
         <input type="date" name="day" step="1" value="<?php echo date("Y-m-d");?>">
      </div>
      <div class="form-group">
        <label><?= i18n("Space Price") ?>:</label>
         <input type="number" name="precio_espacio" class="form-control" min="0">
      </div>
	  <div class="form-group">
        <label><?= i18n("Physio Price") ?>:</label>
         <input type="number" name="precio_fisio" class="form-control" min="0">
      </div>
      <button type="submit" name="submit" class="btn btn-default"><?= i18n("Submit") ?></button>
      </form>
    </div>
</div>

