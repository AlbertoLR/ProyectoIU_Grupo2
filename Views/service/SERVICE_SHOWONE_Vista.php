<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Show User");
$service = $view->getVariable("service");
$clienteEx = $view->getVariable("clienteEx");
$pagos = $view->getVariable("pagos");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<!--Vista/formulario para ver en detalle un servicio. En la pantalla se
visualiza la descripcion, fecha, coste, el dni del cliente externo, el
metodo de pago, la frecuencia de pago, y si se ha recibido el pago-->

<div class="jumbotron">
  <div class="design">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
        <li class="breadcrumb-item"><a href="index.php?controller=service&amp;action=show"><?= i18n("List of Services") ?></a></li>
        <li class="breadcrumb-item active"><?= i18n("Service Details") ?></li>
    </ol>
  </div>
    <div class="container">
        <div class="row top-buffer">
            <table class="table" >
                <tr class="active">
                    <th><?= i18n("Identifier")?>:</th>
                    <td><?= $service->getIDServicio() ?></td>
                </tr>
                <tr>
                    <th><?= i18n("Description")?>:</th>
                    <td><?= $service->getDescripcion() ?></td>
                </tr>
                <tr class="active">
                    <th><?= i18n("Date")?>:</th>
                    <td><?= $service->getFecha() ?></td>
                </tr>
                <tr>
                    <th><?= i18n("Cost")?>:</th>
                    <td><?= $service->getCoste() ?></td>
                </tr>
                <tr class="active">
                    <th><?= i18n("External Client's DNI/NIE")?>:</th>
                    <?php foreach($clienteEx as $client => $value) {?>
                        <?php if($value["id"]==$service->getIDCliente()) {?>
                            <td><?= $value["dni_nif"] ?></td>
                        <?php } } ?>
                </tr>
                <tr>
                    <th><?= i18n("Payment Method")?>:</th>
                    <?php foreach($pagos as $pago => $value) {?>
                        <?php if($value["id"]==$service->getID_Pago()) {?>
                            <td><?= $value["metodo_pago"] ?></td>
                        <?php } } ?>
                </tr>
                <tr class="active">
                    <th><?= i18n("Payment Frecuency")?>:</th>
                    <?php foreach($pagos as $pago => $value) {?>
                        <?php if($value["id"]==$service->getID_Pago()) {?>
                            <td><?= $value["periodicidad"] ?></td>
                        <?php } } ?>
                </tr>
                <tr>
                    <th><?= i18n("Payment Recieved")?>:</th>
                    <?php foreach($pagos as $pago => $value) {?>
                        <?php if($value["id"]==$service->getID_Pago()) {?>
                            <?php if($value["realizado"]){ ?>
                                <td><?= i18n("Yes") ?></td>
                             <?php } else { ?>
                                <td><?= i18n("No") ?></td>
                            <?php } ?>
                    <?php } } ?>
                </tr>
            </table>
        </div>
    </div>
</div>
