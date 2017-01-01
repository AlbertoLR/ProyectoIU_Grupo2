<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Show User");
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
        <li class="breadcrumb-item active"><?= i18n("Inscription Details") ?></li>
    </ol>
  </div>
    <div class="container">
        <div class="row top-buffer">
            <table class="table" >
                <tr class="active">
                    <th><?= i18n("Identifier")?>:</th>
                    <td><?= $inscription->getIDInscripcion() ?></td>
                </tr>
                <tr>
                    <th><?= i18n("Date")?>:</th>
                    <td><?= $inscription->getFecha() ?></td>
                </tr>
                <tr class="active">
                    <th><?= i18n("External Particular")?>:</th>
                    <?php foreach($particular as $part => $value) {?>
                        <?php if($value["id"]==$inscription->getID_Particular_Externo()) {?>
                            <td><?= $value["nombre"] . " " . $value["apellidos"] ?></td>
                        <?php } } ?>
                    <?php if(!$value["id"]==$inscription->getID_Particular_Externo()) {?>
                        <td ><?= i18n("No")?></td>
                    <?php  } ?>
                </tr>
                <tr>
                    <th><?= i18n("Event")?>:</th>
                    <?php foreach($events as $event => $value) {?>
                        <?php if($value["id"]==$inscription->getID_Evento()) {?>
                            <td><?= $value["nombre"] ?></td>
                        <?php } } ?>
                    <?php if(!$value["id"]==$inscription->getID_Evento()) {?>
                        <td ><?= i18n("No")?></td>
                    <?php  } ?>
                </tr>
                <tr class="active">
                    <th><?= i18n("Reserve")?>:</th>
                    <?php foreach($reserves as $res => $value) {?>
                        <?php if($value["id"]==$inscription->getID_Reserva()) {?>
                            <td ><?= i18n("DNI Client")." - ".$value["dni_c"] ?></td>
                        <?php } } ?>
                    <?php if(!$value["id"]==$inscription->getID_Reserva()) {?>
                        <td ><?= i18n("No")?></td>
                    <?php  } ?>
                </tr>
                <tr>
                    <th><?= i18n("DNI Client")?></th>
                    <?php if(NULL==$inscription->getDNI_Cliente()) {?>
                        <td ><?= i18n("No")?></td>
                    <?php }  ?>
                    <?php if(!NULL==$inscription->getDNI_Cliente()) {?>
                        <td><?=$inscription->getDNI_Cliente() ?></td>
                    <?php  } ?>
                </tr>
                <tr class="active">
                    <th><?= i18n("Activity")?>:</th>
                    <?php foreach($activities as $activity => $value) {?>
                        <?php if($value["id"]==$inscription->getID_Actividad()) {?>
                            <td><?= $value["nombre"] ?></td>
                        <?php } } ?>
                    <?php if(!$value["id"]==$inscription->getID_Actividad()) {?>
                        <td ><?= i18n("No")?></td>
                    <?php  } ?>
                </tr>
            </table>
        </div>
    </div>
</div>
