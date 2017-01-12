<?php

require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();

$view->setVariable("title", "Show Payment");
$payment = $view->getVariable("payment");
$reserves = $view->getVariable("reserves");
$inscriptions = $view->getVariable("inscriptions");
$errors = $view->getVariable("errors");

?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=payment&amp;action=show"><?= i18n("List of Payments") ?></a></li>
   <li class="breadcrumb-item active"><?= i18n("Payment") ?></li>
  </ol>
  </div>
    <div class="container">
  	  <div class="row">
      <h1><?= i18n("Payment")?></h1>
      </div>
      <div class="row top-buffer">
        <table class="table">
        <tbody>
          <tr class="active">
            <th class="col-sm-2"><?= i18n("Identifier")?></th>
            <td class="col-sm-10"><?= $payment->getID() ?></td>
          </tr>
        </tbody>
        <tbody>
          <tr>
            <th><?= i18n("Payment method")?></th>
            <td><?= i18n($payment->getPaymentMetod()) ?></td>
          </tr>
        </tbody>
        <tbody>
          <tr class="active">
            <th><?= i18n("Date")?></th>
           <td><?= $payment->getDate() ?></td>
          </tr>
        </tbody>
		    <tbody>
          <tr>
           <th><?= i18n("Periodicity")?></th>
            <td><?= i18n($payment->getPeriodicity()) ?></td>
          </tr>
        </tbody>
	    	<tbody>
          <tr class="active">
            <th><?= i18n("Quantity")?></th>
            <td><?= $payment->getQuantity() ?></td>
          </tr>
        </tbody>
        <tbody>
        <tr >
            <th><?= i18n("Reserve")?>:</th>
            <?php foreach($reserves as $res => $value) {?>
                <?php if($value["id"]==$payment->getReserveid()) {?>
                    <td ><?= i18n("DNI Client")." - ".$value["dni_c"] ?></td>
                <?php } } ?>
            <?php if(!$value["id"]==$payment->getReserveid()) {?>
                <td ><?= i18n("No")?></td>
            <?php  } ?>
        </tr>
        </tbody>
        <tbody>
          <tr class="active">
              <th><?= i18n("Inscriptions")?>:</th>
              <?php foreach($inscriptions as $inscription => $value) {?>
                  <?php if($value["id"]==$payment->getInscriptionid()) {?>
                      <td ><?php echo i18n("DNI Client"). ": ". $value["cliente_dni_c"] ." -- " .i18n("Date"). ": ". $value["fecha"] ?></td>
                  <?php } } ?>
              <?php if(!$value["id"]==$payment->getInscriptionid()) {?>
                  <td ><?= i18n("No")?></td>
              <?php  } ?>
           </tr>
          </tbody>
          <tbody>
            <tr>
              <th><?= i18n("Realiced")?>:</th>
                <?php if($payment->getRealiced()){ ?>
                <td><?= i18n("Yes") ?></td>
                <?php } else { ?>
                <td><?= i18n("No") ?></td>
                <?php } ?>
            </tr>
          </tbody>
        </table>
     </div>
    </div>
</div>
