<?php

require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();

$view->setVariable("title", "Manage Payments");

$payments = $view->getVariable("payment");

$errors = $view->getVariable("errors");

?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">

  <div class="design">
  
  <ol class="breadcrumb">
  
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
	
    <li class="breadcrumb-item active"><?= i18n("List of Payments") ?></li>
	
  </ol>
  
  </div>
  
    <div class="container">
	
        <h1><?= i18n("List of Payments")?></h1>
		
	<a href="index.php?controller=payment&action=add" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Create Payment")?></a>
	
<table class="table">

      <thead>
	  
        <tr>
		
          <th>#</th>
		  
          <th><?= i18n("Payment")?></th>
		  
          <th style="width: 72px;"></th>
		  
        </tr>
		
      </thead>
	  
      <tbody>
	  
	  <?php foreach($payments as $payment){ ?>
	  
          <tr>
		  
	  <td><?php echo $payment->getID(); ?></td>
	  
          <td><?php echo $payment->getDate(); ?></td>
		  
          <td>
		  
              <a href="index.php?controller=payment&action=showone&id=<?php echo $payment->getID();  ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a>
			  
              <a href="index.php?controller=payment&action=edit&id=<?php echo $payment->getID();  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
			  
              <a href="index.php?controller=payment&action=delete&id=<?php echo $payment->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
			  
          </td>
		  
        </tr>
		
	<?php } ?>
	
      </tbody>
	  
</table>

    </div>
	
</div>