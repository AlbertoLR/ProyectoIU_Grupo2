<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Delete Inscription");
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
        <li class="breadcrumb-item active"><?= i18n("Delete Inscription") ?></li>
    </ol>
  </div>
    <div class="container">
        <h1><?= i18n("Delete Inscription")." ".$inscription->getIDInscripcion()?></h1>
        <form action="index.php?controller=inscription&amp;action=delete" method="POST">

            <div class="row top-buffer">
                <table class="table">
                    <tbody>
                    <tr class="active">
                        <th class="col-sm-2"><?= i18n("Identifier")?></th>
                        <td class="col-sm-10"><?= $inscription->getIDInscripcion() ?></td>
                    </tr>
                    </tbody>
                    <tbody>
                    <tr>
                        <th><?= i18n("Date")?></th>
                        <td><?= $inscription->getFecha() ?></td>
                    </tr>
                    </tbody>
                    <tbody>
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
                    </tbody>
                    <tbody>
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
                    </tbody>
                    <tbody>
                    <tr class="active">
                        <th><?= i18n("Reserve")?>:</th>
                        <?php foreach($reserves as $res => $value) {?>
                            <?php if($value["id"]==$inscription->getID_Reserva()) {?>
                                <td><?= i18n("DNI Client")." - ".$value["dni_c"] ?></td>
                            <?php } } ?>
                        <?php if(!$value["id"]==$inscription->getID_Reserva()) {?>
                            <td ><?= i18n("No")?></td>
                        <?php  } ?>
                    </tr>
                    </tbody>
                    <tbody>
                    <tr>
                        <th><?= i18n("DNI Client")?></th>
                        <?php if(NULL==$inscription->getDNI_Cliente()) {?>
                            <td ><?= i18n("No")?></td>
                        <?php }  ?>
                        <?php if(!NULL==$inscription->getDNI_Cliente()) {?>
                            <td><?=$inscription->getDNI_Cliente() ?></td>
                        <?php  } ?>
                    </tr>
                    </tbody>
                    <tbody>
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
                    </tbody>
                </table>
            </div>


            <button type="submit" value="yes" name="submit" class="btn btn-default"><?= i18n("Yes") ?></button>
            <button type="submit" value="no" name="submit" class="btn btn-default"><?= i18n("No") ?></button>
            <input type="hidden" name="id" value="<?= $inscription->getIDInscripcion() ?>">
        </form>
    </div>
</div>
