<?php

require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();

$view->setVariable("title", "Manage Discounts");

$discounts = $view->getVariable("discount");

$errors = $view->getVariable("errors");

?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">

  <div class="design">

  <ol class="breadcrumb">

    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>

    <li class="breadcrumb-item active"><?= i18n("List of Discounts") ?></li>

  </ol>

  </div>

    <div class="container">

        <h1><?= i18n("List of Discounts")?></h1>

	<a href="index.php?controller=discount&action=add" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Create Discount")?></a>

<table class="table">

      <thead>

        <tr>

          <th>#</th>

          <th><?= i18n("Discount")?></th>

          <th style="width: 72px;"></th>

        </tr>

      </thead>

      <tbody>

	  <?php foreach($discounts as $discount){ ?>

          <tr>

	  <td><?php echo $discount->getID(); ?></td>
	  <td><?php echo $discount->getDiscountDescription(); ?></td>
		  
          <td>

              <a href="index.php?controller=discount&action=showone&id=<?php echo $discount->getID();  ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a>
              <a href="index.php?controller=discount&action=edit&id=<?php echo $discount->getID();  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
              <a href="index.php?controller=discount&action=delete&id=<?php echo $discount->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
          </td>
        </tr>
	<?php } ?>
      </tbody>
</table>
    </div>
</div>
