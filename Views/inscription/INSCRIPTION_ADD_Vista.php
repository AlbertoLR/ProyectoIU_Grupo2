<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Create Inscription");
$inscription = $view->getVariable("inscription");
$particular = $view->getVariable("particular");
$events = $view->getVariable("events");
$reserves = $view->getVariable("reserves");
$clients= $view->getVariable("clients");
$activities= $view->getVariable("activities");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="design">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
            <li class="breadcrumb-item"><a href="index.php?controller=inscription&amp;action=show"><?= i18n("List of Inscriptions") ?></a></li>
            <li class="breadcrumb-item active"><?= i18n("Add Inscription") ?></li>
        </ol>
    </div>
    <div class="container">
        <h1><?= i18n("Add Inscription")?></h1>
        <form action="index.php?controller=inscription&amp;action=add" method="POST">
            <div class="form-group">
                <label><?= i18n("Date") ?>:</label>
                <input type="text" name="fecha" class="form-control" required placeholder="ej: 2015-12-15" id="datepicker">
            </div>
            <div class="form-group">
                <label><?= i18n("External Particular") ?>:</label>
                <select name="id_particular_externo" class="form-control" id="particular">
                    <option value="" selected></option>
                  <?php foreach($particular as $part => $value) {?>
                  <option value="<?php echo $value["id"] ?>"><?= $value["nombre"]." ". $value["apellidos"] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div id="limpiar">
            <div class="form-group" id="limpev" >
                <label><?= i18n("Event") ?>:</label>
                <select name="id_evento" class="form-control" id="event" >
                    <option value="" selected></option>
                  <?php foreach($events as $event => $value) {?>
                  <option value="<?php echo $value["id"] ?>"><?= $value["nombre"] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label><?= i18n("Reserve (It should be the same as DNI Client below)") ?>:</label>
                <select name="id_reserva" class="form-control">
                  <option value="" selected></option>
                  <?php foreach($reserves as $reserve => $value) {?>
                  <option value="<?php echo $value["id"] ?>"><?=  i18n("DNI Client")." - ".$value["dni_c"] ?></option>
                  <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label><?= i18n("DNI Client") ?>:</label>
                <select name="dni_cliente" class="form-control">
                  <option value="" selected></option>
                  <?php foreach($clients as $client => $value) {?>
                    <?php if($value["activo"]==TRUE) {?>
                        <option value="<?php echo $value["dni_c"] ?>"><?= $value["dni_c"] ?></option>
                  <?php }} ?>
                </select>
            </div>
            <div class="form-group" id="limpact">
                <label><?= i18n("Activity") ?>:</label>
                <select name="id_actividad" class="form-control" id="activit">
                  <option value="" selected></option>
                  <?php foreach($activities as $activity => $value) {?>
                  <option value="<?php echo $value["id"] ?>"><?= $value["nombre"] ?></option>
                  <?php } ?>
                </select>
            </div>
          </div>
            <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
        </form>
    </div>
</div>
