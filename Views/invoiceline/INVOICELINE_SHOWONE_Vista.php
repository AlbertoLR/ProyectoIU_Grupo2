<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Show Invoiceline");
$invoiceline = $view->getVariable("invoiceline");
$product=$view->getVariable("product");
$invoice=$view->getVariable("invoice");
$quantity=$view->getVariable("quantity");
$price=$view->getVariable("price");
$tax=$view->getVariable("tax");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
	<div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=invoice&amp;action=show"><?= i18n("List of Invoices") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Detailed Invoice Line") ?></li>
  </ol>
  </div>
    <div class="container">
        <h1><?= i18n("Detailed Invoice Line") ?></h1>
      <div class="row top-buffer">
        <table class="table">
		<tbody>
          <tr type="hidden">
            <th><?= i18n("#")?></th>
            <td><?= $invoiceline->getID() ?></td>
          </tr>
        </tbody>
        <tbody>
          <tr>
            <th><?= i18n("Invoice")?></th>
            <td><?= $invoiceline->getInvoiceId() ?></td>
          </tr>
        </tbody>
        <tbody>
            <th><?= i18n("Product")?></th>
            <td><?= $invoiceline->getProduct() ?></td>
        </tbody>
        <tbody>
            <th><?= i18n("Quantity")?></th>
              <td><?=$invoiceline->getQuantity() ?></td>
        </tbody>
        <tbody>
          <tr>
            <th><?= i18n("Price")?></th>
              <td><?=$invoiceline->getPrice() ?></td>
          </tr>
        </tbody>
		<tbody>
          <tr>
            <th><?= i18n("Tax")?></th>
              <td><?=$invoiceline->getTax() ?></td>
          </tr>
        </tbody>
        </table>
    </div>
    </div>
</div>
