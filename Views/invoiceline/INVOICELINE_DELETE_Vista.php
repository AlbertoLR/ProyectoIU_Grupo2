<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Delete Invoice Line");
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
    <li class="breadcrumb-item"><a href="index.php?controller=invoice&amp;action=showone&amp;id=<?= $invoiceline->getInvoiceId();  ?>"><?= i18n("Detailed Invoice") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Delete Invoice Line") ?></li>
  </ol>
  </div>
    <div class="container">
        <h1><?= i18n("Delete Invoice Line") ?></h1>
      <form action="index.php?controller=invoiceline&amp;action=delete" method="POST">
        <button type="submit" value="yes" name="submit" class="btn btn-default"><?= i18n("Yes") ?></button>
        <button type="submit" value="no" name="submit" class="btn btn-default"><?= i18n("No") ?></button>
        <input type="hidden" name="id" value="<?= $invoiceline->getID() ?>">
      </form>
      <div class="row top-buffer">
        <table class="table">
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
