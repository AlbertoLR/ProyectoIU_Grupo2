<?php

require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();

$view->setVariable("title", "Create Payment");
$payment = $view->getVariable("payment");
$reserves = $view->getVariable("reserves");
$inscriptions = $view->getVariable("inscriptions");
$errors = $view->getVariable("errors");

$array_date=getDate();
$date=$array_date['year']."-".$array_date['mon']."-".$array_date['mday'];

?>

<?= isset($errors["general"])?$errors["general"]:"" ?>
<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=payment&amp;action=show"><?= i18n("List of Payments") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Create Payment") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Create Payment")?></h1>
      <form payment="index.php?controller=payment&amp;action=add" method="POST">
      <div class="form-group">
        <label><?= i18n("Payment method") ?>:</label>
        <select name="payment_metod" class="form-control">
          <option value="" selected></option>
          <option value="Cash "><?= i18n("Cash ") ?> </option>
          <option value="Wire transfer"><?= i18n("Wire transfer") ?></option>
          <option value="Credit card"><?= i18n("Credit card") ?> </option>
        </select>
      </div>
      <div class="form-group">
        <label><?= i18n("Date") ?>:</label>
        <input type="text" name="date" class="form-control" value="<?= $date ?>" readonly required="required">
      </div>
      <div class="form-group">
        <label><?= i18n("Periodicity") ?>:</label>
          <select name="periodicity" class="form-control">
            <option value="" selected></option>
            <option value="Cash Payment"><?= i18n("Cash Payment") ?> </option>
            <option value="Monthly Payment"><?= i18n("Monthly Payment") ?></option>
            <option value="Quarterly Payment"><?= i18n("Quarterly Payment") ?></option>
            <option value="Semiannual Payment"><?= i18n("Semiannual Payment") ?></option>
            <option value="Annual Payment"><?= i18n("Annual Payment") ?></option>
          </select>
      </div>
	   <div class="form-group">
        <label><?= i18n("Quantity") ?>:</label>
         <input type="number" name="quantity" class="form-control" min="0" max="2499" required="required">
     </div>
      <div class="form-group">
          <label><?= i18n("Reserve (Only Spaces)") ?>:</label>
          <select name="id_reserva" class="form-control" id="payment">
            <option value="" selected></option>
            <?php foreach($reserves as $reserve => $value) {?>
              <?php if($value["id_espacio"]) {?>
            <option value="<?php echo $value["id"] ?>"><?=  i18n("DNI Client")." - ".$value["dni_c"] ?></option>
            <?php } } ?>
          </select>
      </div>
      <div class="form-group" id="limpiar">
          <label><?= i18n("Inscriptions") ?>:</label>
          <select name="id_inscription" class="form-control">
            <option value="" selected></option>
            <?php foreach($inscriptions as $inscription => $value) {?>
              <?php if($value["cliente_dni_c"]) {?>
            <option value="<?php echo $value["id"] ?>"><?= i18n("DNI Client"). ": ". $value["cliente_dni_c"] ." -- " .i18n("Date"). ": ". $value["fecha"] ?></option>
            <?php } } ?>
          </select>
      </div>
  	  <div class="form-group">
        <label><?= i18n("Realiced") ?>:</label>
        <select name="realiced" class="form-control">
           <option value="Yes"><?= i18n("Yes") ?></option>
           <option value="No"><?= i18n("No") ?></option>
         </select>
      </div>
      <button type="submit" name="submit" class="btn btn-default"><?= i18n("Submit") ?></button>
      </form>
    </div>
</div>
