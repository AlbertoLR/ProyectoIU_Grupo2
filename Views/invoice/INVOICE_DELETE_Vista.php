<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Delete Invoice");
$invoice = $view->getVariable("invoice");
$day=$view->getVariable("day");
$id_payment=$view->getVariable("id_payment");
$total_price=$view->getVariable("total_price");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
	<div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=invoice&amp;action=show"><?= i18n("List of Invoice") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Delete Invoice") ?></li>
  </ol>
  </div>
    <div class="container">
        <h1><?= i18n("Delete Invoice") ?></h1>
      <form action="index.php?controller=invoice&amp;action=delete" method="POST">
        <button type="submit" value="yes" name="submit" class="btn btn-default"><?= i18n("Yes") ?></button>
        <button type="submit" value="no" name="submit" class="btn btn-default"><?= i18n("No") ?></button>
        <input type="hidden" name="id" value="<?= $invoice->getID() ?>">
      </form>
      <div class="row top-buffer">
        <table class="table">
        <tbody>
          <tr>
            <th><?= i18n("Day")?></th>
            <td><?= $invoice->getDay() ?></td>
          </tr>
        </tbody>
        <tbody>
            <th><?= i18n("Payment")?></th>
            <td><?= $invoice->getPaymentId() ?></td>
        </tbody>
        <tbody>
            <th><?= i18n("Total Price")?></th>
              <td><?=$invoice->getTotalPrice() ?></td>
        </tbody>
        
        </table>
    </div>
    </div>
</div>
