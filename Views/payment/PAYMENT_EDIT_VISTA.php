<?php

require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();

$view->setVariable("title", "Modify Payment");
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
    <li class="breadcrumb-item active"><?= i18n("Modify Payment") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Modify Payment")?></h1>
      <form payment="index.php?controller=payment&amp;action=edit" method="POST">
        <div class="form-group">
          <label><?= i18n("Payment method") ?>:</label>
          <select name="payment_metod" class="form-control" >
            <?php $metodos = array("Cash ", "Wire transfer", "Credit card") ?>
            <?php foreach($metodos as $metodo) {?>
            <?php if($metodo == $payment->getPaymentMetod()) {?>
              <option value="<?= $metodo ?>" selected><?=  i18n($metodo)?> </option>
            <?php }else{ ?>
            <option value="<?= $metodo ?>"><?= i18n($metodo) ?></option>
            <?php } }?>
          </select>
        </div>
      <div class="form-group">
        <label><?= i18n("Date") ?>:</label>
        <input type="text" name="date" class="form-control" value="<?= $date ?>" readonly required="required">
      </div>
      <div class="form-group">
        <label><?= i18n("Periodicity") ?>:</label>
          <select name="periodicity" class="form-control">
            <?php $periodos= array("Cash Payment", "Monthly Payment", "Quarterly Payment","Semiannual Payment","Annual Payment") ?>
            <?php foreach($periodos as $periodo) {?>
            <?php if($periodo== $payment->getPeriodicity()) {?>
              <option value="<?= $metodo ?>" selected><?= i18n($periodo) ?></option>
            <?php }else{ ?>
            <option value="<?= $periodo ?>"><?= i18n($periodo) ?></option>
            <?php } }?>
          </select>
      </div>
	   <div class="form-group">
        <label><?= i18n("Quantity") ?>:</label>
         <input type="number" name="quantity" class="form-control" min="0" max="2499" value="<?= $payment->getQuantity() ?>" required="required">
     </div>
      <div class="form-group">
          <label><?= i18n("Reserve (Only Spaces)") ?>:</label>
          <select name="id_reserva" class="form-control" id="payment">
            <option value="" selected></option>
            <?php foreach($reserves as $reserve => $value) {?>
              <?php if($value["id_espacio"]) {
                  if($value["id"]==$payment->getReserveid()){ ?>
                    <option selected value="<?php echo $value["id"] ?>"><?=  i18n("DNI Client")." - ".$value["dni_c"] ?></option>
             <?php  } else{ ?>
                    <option value="<?php echo $value["id"] ?>"><?=  i18n("DNI Client")." - ".$value["dni_c"] ?></option>
            <?php } } } ?>
          </select>
      </div>
      <div class="form-group" id="limpiar">
          <label><?= i18n("Inscription") ?>:</label>
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
          <?php if ($payment->getRealiced() == TRUE): ?>
            <option value="Yes" <?php echo "selected" ?>><?= i18n("Yes") ?></option>
            <option value="No"><?= i18n("No") ?></option>
          <?php else: ?>
              <option value="No" <?php echo "selected" ?>><?= i18n("No") ?></option>
              <option value="Yes" ><?= i18n("Yes") ?></option>
          <?php endif ?>
        </select>
      </div>
      <button type="submit" name="submit" class="btn btn-default"><?= i18n("Submit") ?></button>
      </form>
    </div>
</div>
