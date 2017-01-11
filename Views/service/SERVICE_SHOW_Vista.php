<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Services");
$services = $view->getVariable("services");
$pagos = $view->getVariable("pagos");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<!--Vista/formulario en la cual se visualizan todos los servicios. Para cada servicio,
se visualiza el id del servicio, la descripción, la fecha, y si se ha recibido el pago,
además de los botones para modificar, visualiar en detalle, o borrar cada uno-->

    <div class="jumbotron">
      <div class="design">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
            <li class="breadcrumb-item active"><?= i18n("List of Services") ?></li>
        </ol>
      </div>
        <div class="container">
            <h1><?= i18n("List of Services")?></h1>
        <a href="index.php?controller=service&action=add" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Add Service")?></a>

            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th><?= i18n("Service")?></th>
                    <th><?= i18n("Date")?></th>
                    <th><?= i18n("Payment Recieved")?></th>
                    <th style="width: 72px;"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($services as $service){ ?>
                    <tr>
                        <td><?php echo $service->getIDServicio(); ?></td>
                        <td><?php echo $service->getDescripcion(); ?></td>
                        <td><?php echo $service->getFecha(); ?></td>
                        <?php foreach($pagos as $pago => $value) {?>
                            <?php if($value["id"]==$service->getID_Pago()) {?>
                                <?php if($value["realizado"]){ ?>
                                    <td><?= i18n("Yes") ?></td>
                                <?php } else { ?>
                                    <td><?= i18n("No") ?></td>
                                <?php } ?>
                            <?php } } ?>
                        <td>
                            <a href="index.php?controller=service&action=showone&amp;id=<?php echo $service->getIDServicio();  ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a>
                            <a href="index.php?controller=service&action=edit&amp;id=<?php echo $service->getIDServicio();  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
                            <a href="index.php?controller=service&action=delete&amp;id=<?php echo $service->getIDServicio();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
