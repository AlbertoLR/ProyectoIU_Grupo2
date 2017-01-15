<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Modify Invoice Line");
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
			<li class="breadcrumb-item active"><?= i18n("Modify Invoice Line") ?></li>
		</ol>
	</div>
    <div class="container">
      <h1><?= i18n("Modify Invoice Line")?></h1>
      <form action="index.php?controller=invoiceline&amp;action=edit" method="POST" enctype="multipart/form-data" >
	  <div class="form-group">
        <label><?= i18n("#") ?>:</label>
         <input type="text" name="id" class="form-control" value="<?= $invoiceline->getID()?>" minlength="2" required="required" readonly >
      </div>
	  <div class="form-group">
        <label><?= i18n("Invoice") ?>:</label>
         <input type="text" name="invoice" class="form-control" value="<?= $invoiceline->getInvoiceId()?>" minlength="2" required="required" readonly >
      </div>
      <div class="form-group">
        <label><?= i18n("Product") ?>:</label>
         <input type="text" name="product" class="form-control" value="<?= $invoiceline->getProduct()?>" required="required">
      </div>
      <div class="form-group">
        <label><?= i18n("Quantity") ?>:</label>
        <input type="text" name="quantity" class="form-control" value="<?= $invoiceline->getQuantity()?>" required="required">
      </div>
      <div class="form-group">
        <label><?= i18n("Price") ?>:</label>
         <input type="text" name="price" class="form-control" value="<?= $invoiceline->getPrice()?>" required="required">
      </div>
	  <div class="form-group">
        <label><?= i18n("Tax") ?>:</label>
         <input type="text" name="tax"  class="form-control" value="<?= $invoiceline->getTax()?>" required="required">
      </div>
      <button type="submit" name="submit" class="btn btn-default"><?= i18n("Submit") ?></button>
      </form>
    </div>
</div>
