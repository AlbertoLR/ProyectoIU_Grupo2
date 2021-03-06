<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Modify Invoice");
$invoice = $view->getVariable("invoice");
$payments=$view->getVariable("payments");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
	<div class="design">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
			<li class="breadcrumb-item"><a href="index.php?controller=invoice&amp;action=show"><?= i18n("List of Invoices") ?></a></li>
			<li class="breadcrumb-item active"><?= i18n("Modify Invoice") ?></li>
		</ol>
	</div>
    <div class="container">
      <h1><?= i18n("Modify Invoice")?></h1>
      <form action="index.php?controller=invoice&amp;action=edit" method="POST" enctype="multipart/form-data" >
	  <div class="form-group">
        <label><?= i18n("#") ?>:</label>
         <input type="text" name="id" class="form-control" value="<?= $invoice->getID()?>" minlength="2" required="required" readonly >
      </div>
	  <div class="form-group">
        <label><?= i18n("Day") ?>:</label>
         <input type="text" name="day" class="form-control" value="<?= $invoice->getDay()?>" minlength="2" required="required" id="datepicker">
      </div>
            <div class="form-group" id="limpev" >
                <label><?= i18n("Payment") ?>:</label>
                <select name="id_payment" class="form-control" id="payment" >
                    <option value="" ></option>
                  <?php foreach($payments as $payment => $value) {?>
                  <?php if($value["id"]==$invoice->getPaymentId()) {?>
                            <option value="<?php echo $value["id"] ?>" selected><?= $value["id"]?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $value["id"] ?>" ><?= $value["id"]?></option>
                        <?php } } ?>
                </select>
            </div>
      <div class="form-group">
        <label><?= i18n("Total Price") ?>:</label>
        <input type="number" name="total_price" class="form-control" value="<?= $invoice->getTotalPrice()?>" minlength="2" required="required">
      </div>
      <button type="submit" name="submit" class="btn btn-default"><?= i18n("Submit") ?></button>
      </form>
    </div>
</div>
