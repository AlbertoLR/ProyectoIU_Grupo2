<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Show Invoice");
$invoice = $view->getVariable("invoice");
$invoicelines = $view->getVariable("invoicelines");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
	<div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=invoice&amp;action=show"><?= i18n("List of Invoices") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Detailed Invoice") ?></li>
  </ol>
  </div>
    <div class="container">
        <h1><?= i18n("Detailed Invoice") ?></h1>
      <div class="row top-buffer">
        <table class="table">
		<tbody>
          <tr type="hidden">
            <th><?= i18n("#")?></th>
            <td><?= $invoice->getID() ?></td>
          </tr>
        </tbody>
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
	<div class="container">
        <h1><?= i18n("List of Invoice Lines")?></h1>
	<a href="index.php?controller=invoiceline&action=add&id=<?= $invoice->getID()?>" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Create Invoice Line")?></a>
<table class="table">
      <thead>
        <tr>
          <th>#</th>
		  <th><?= i18n("Invoice")?></th>
		  <th><?= i18n("Product")?></th>
		  <th><?= i18n("Quantity")?></th>
		  <th><?= i18n("Price")?></th>
		  <th><?= i18n("Tax")?></th>
          <th style="width: 72px;"></th>
        </tr>
      </thead>
      <tbody>
	  <?php foreach($invoicelines as $invoiceline){ ?>
          <tr>
	  <td><?php echo $invoiceline->getID(); ?></td>
	  <td><?php echo $invoiceline->getInvoiceId(); ?></td>
	  <td><?php echo $invoiceline->getProduct(); ?></td>
	  <td><?php echo $invoiceline->getQuantity(); ?></td>
	  <td><?php echo $invoiceline->getPrice(); ?></td>
	  <td><?php echo $invoiceline->getTax(); ?></td>
          <td>
              <a href="index.php?controller=invoiceline&action=showone&amp;id=<?php echo $invoiceline->getID();  ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a>
              <a href="index.php?controller=invoiceline&action=edit&amp;id=<?php echo $invoiceline->getID();  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
              <a href="index.php?controller=invoiceline&action=delete&amp;id=<?php echo $invoiceline->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
          </td>
        </tr>
	<?php } ?>
      </tbody>
</table>
    </div>
</div>
