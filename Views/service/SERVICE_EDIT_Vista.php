<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Update Service");
$service = $view->getVariable("service");
$clienteEx = $view->getVariable("clienteEx");
$pagos = $view->getVariable("pagos");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<!--Vista/formulario para modificar un servicio. El usuario puede modificar la
descripcion, fecha, coste, el dni del cliente externo, el metodo de pago,
la frecuencia de pago, y si se ha recibido el pago-->

<?php foreach($pagos as $pago => $value) {?>
    <?php if($value["id"]==$service->getID_Pago()) {?>
        <?php  $metodo=$value["metodo_pago"] ?>
    <?php } }?>

<?php foreach($pagos as $pago => $value) {?>
    <?php if($value["id"]==$service->getID_Pago()) {?>
        <?php  $frecuencia=$value["periodicidad"] ?>
    <?php } }?>


<div class="jumbotron">
  <div class="design">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
        <li class="breadcrumb-item"><a href="index.php?controller=service&amp;action=show"><?= i18n("List of Services") ?></a></li>
        <li class="breadcrumb-item active"><?= i18n("Modify Service") ?></li>
    </ol>
  </div>
    <div class="container">
        <h1><?= i18n("Modify Service")?></h1>
        <form action="index.php?controller=service&amp;action=edit" method="POST">
            <div class="form-group">
                <label><?= i18n("Description") ?>:</label>
                <input type="text" name="descripcion" class="form-control" value="<?php echo $service->getDescripcion(); ?>" minlength="2" maxlength="30" required="required">
            </div>
            <div class="form-group">
                <label><?= i18n("Date") ?>:</label>
                <input type="text" name="fecha" class="form-control" value="<?php echo $service->getFecha(); ?>" required placeholder="ej: 2015-12-15" id="datepicker" minlength="2" required="required">
            </div>
            <div class="form-group">
                <label><?= i18n("Cost") ?>:</label>
                <input type="number" name="coste" class="form-control" value="<?php echo $service->getCoste(); ?>" minlength="1" maxlength="10" min="0" max="2500" required="required">
            </div>
            <div class="form-group">
                <label><?= i18n("External Client's DNI/NIE") ?>:</label>
                <select name="external" class="form-control">
                    <option value=""></option>
                    <?php foreach($clienteEx as $client => $value) {?>
                        <?php if($value["id"]==$service->getIDCliente()) {?>
                            <option value="<?php echo $value["id"] ?>" selected><?= $value["dni_nif"] ?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $value["id"] ?>" ><?= $value["dni_nif"] ?></option>
                        <?php } }?>
                </select>
            </div>
            <div class="form-group">
                <label><?= i18n("Payment Method") ?>:</label>
                <input type="text" name="metodo" value="<?php echo $metodo; ?>" class="form-control" minlength="2" maxlength="30" required="required">
            </div>
            <div class="form-group">
                <label><?= i18n("Payment Frecuency") ?>:</label>
                <input type="text" name="frecuencia" value="<?php echo $frecuencia; ?>" class="form-control" minlength="2" maxlength="30" required="required">
            </div>
            <div class="form-group">
                <label><?= i18n("Payment Recieved") ?>:</label>
                <select name="recibido" class="form-control">
                    <?php foreach($pagos as $pago => $value) {?>
                        <?php if($value["id"]==$service->getID_Pago()) {?>
                            <?php if ($value["realizado"] == TRUE): ?>
                            <option value="Yes" <?php echo "selected" ?>><?= i18n("Yes") ?></option>
                            <option value="No"><?= i18n("No") ?></option>
                        <?php else: ?>
                            <option value="No" <?php echo "selected" ?>><?= i18n("No") ?></option>
                            <option value="Yes" ><?= i18n("Yes") ?></option>
                        <?php endif ?>
                        <?php } }?>
                </select>
            </div>


            <input type="hidden" name="id" value="<?= $service->getIDServicio() ?>">
            <button type="submit" name="submit"class="btn btn-default"><?= i18n("Update") ?></button>
        </form>
    </div>
</div>
