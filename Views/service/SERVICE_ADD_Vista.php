<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Create Service");
$service = $view->getVariable("service");
$clienteEX = $view->getVariable("clienteEx");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
        <li class="breadcrumb-item"><a href="index.php?controller=service&amp;action=show"><?= i18n("List of Services") ?></a></li>
        <li class="breadcrumb-item active"><?= i18n("Add Service") ?></li>
    </ol>
  </div>
    <div class="container">
        <h1><?= i18n("Add Service")?></h1>
        <form action="index.php?controller=service&amp;action=add" method="POST">
            <div class="form-group">
                <label><?= i18n("Description") ?>:</label>
                <input type="text" name="descripcion" class="form-control" minlength="2" required="required">
            </div>
            <div class="form-group">
                <label><?= i18n("Date") ?>:</label>
                <input type="text" name="fecha" class="form-control" placeholder="ej: 2015-12-15" id="datepicker">
            </div>
            <div class="form-group">
                <label><?= i18n("Cost") ?>:</label>
                <input type="number" name="coste" class="form-control" minlength="1" min="0" max="2500" required="required">
            </div>
            <div class="form-group">
                <label><?= i18n("External Client's DNI/NIF") ?>:</label>
                <select class="form-control" name="external" >
                    <option value=""></option>
                    <?php foreach($clienteEX as $client => $value) {?>
                        <option value="<?php echo $value["id"] ?>"><?= $value["dni_nif"] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label><?= i18n("Payment Method") ?>:</label>
                <input type="text" name="metodo" class="form-control" minlength="1" required="required">
            </div>
            <div class="form-group">
                <label><?= i18n("Payment Frecuency") ?>:</label>
                <input type="text" name="frecuencia" class="form-control" minlength="1" required="required">
            </div>
            <div class="form-group">
                <label><?= i18n("Payment Recieved") ?>:</label>
                <select name="recibido" class="form-control">
                    <option value="Yes"><?= i18n("Yes") ?></option>
                    <option value="No"><?= i18n("No") ?></option>
                </select>
            </div>
            <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
        </form>
    </div>
</div>
