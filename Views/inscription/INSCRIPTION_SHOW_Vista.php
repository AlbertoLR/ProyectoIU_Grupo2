<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Inscriptions");
$inscriptions = $view->getVariable("inscriptions");
$events = $view->getVariable("events");
$reserves = $view->getVariable("reserves");
$activities= $view->getVariable("activities");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<!--Vista/formulario para visualizar en detalle una inscripción. En la pantalla, se
muestra la fecha, la particular externo, el evento, la reserva, el dni del cliente,
y la actividad-->

<div class="jumbotron">
    <div class="design">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
            <li class="breadcrumb-item active"><?= i18n("List of Inscriptions") ?></li>
        </ol>
    </div>
    <div class="container">
        <h1><?= i18n("List of Inscriptions")?></h1>
        <a href="index.php?controller=inscription&action=add" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Add Inscription")?></a>

        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th><?= i18n("Date")?></th>
                <th><?= i18n("Event")?></th>
                <th><?= i18n("Reserve")?></th>
                <th><?= i18n("Activity")?></th>
                <th style="width: 72px;"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($inscriptions as $inscription){ ?>
                <tr>
                    <td><?php echo $inscription->getIDInscripcion(); ?></td>

                    <td><?php echo $inscription->getFecha(); ?></td>

                    <?php $eve = "-";
                    foreach($events as $event => $value) {?>
                        <?php if($value["id"]==$inscription->getID_Evento()) {
                            $eve = $value["nombre"];
                         } } ?> <td><?php echo $eve ?></td>

                    <?php $rese = "-";
                    foreach($reserves as $res => $value) {?>
                        <?php if($value["id"]==$inscription->getID_Reserva()) {
                                $rese = $value["dni_c"];
                        } } ?> <td><?php echo $rese ?></td>

                    <?php $act = "-";
                    foreach($activities as $activity => $value) {?>
                        <?php if($value["id"]==$inscription->getID_Actividad()) {
                                  $act = $value ["nombre"];
                        } } ?> <td><?php echo $act ?></td>

                    <td>
                        <a href="index.php?controller=inscription&action=showone&amp;id=<?php echo $inscription->getIDInscripcion();  ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a>
                        <a href="index.php?controller=inscription&action=edit&amp;id=<?php echo $inscription->getIDInscripcion();  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
                        <a href="index.php?controller=inscription&action=delete&amp;id=<?php echo $inscription->getIDInscripcion();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

    </div>
</div>
