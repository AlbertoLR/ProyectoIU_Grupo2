<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Invoices");
$invoices = $view->getVariable("invoices");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
	<div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("List of Invoices") ?></li>
  </ol>
  </div>
    <div class="container">
        <h1><?= i18n("List of Invoices")?></h1>
	<a href="index.php?controller=invoice&action=add" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Create Invoice")?></a>
<table class="table">
      <thead>
        <tr>
          <th>#</th>
		  <th><?= i18n("Day")?></th>
		  <th><?= i18n("Payment")?></th>
		  <th><?= i18n("Total Price")?></th>
          <th style="width: 72px;"></th>
        </tr>
      </thead>
      <tbody>
	  <?php foreach($invoices as $invoice){ ?>
          <tr>
	  <td><?php echo $invoice->getID(); ?></td>
	  <td><?php echo $invoice->getDay(); ?></td>
	  <td><?php echo $invoice->getPaymentId(); ?></td>
	  <td><?php echo $invoice->getTotalPrice(); ?></td>
          <td>
              <a href="index.php?controller=invoice&action=showone&amp;id=<?php echo $invoice->getID();  ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a>
              <a href="index.php?controller=invoice&action=edit&amp;id=<?php echo $invoice->getID();  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
              <a href="index.php?controller=invoice&action=delete&amp;id=<?php echo $invoice->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
          </td>
        </tr>
	<?php } ?>
      </tbody>
</table>
    </div>
</div>
