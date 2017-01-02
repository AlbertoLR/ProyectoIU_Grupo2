<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage External Customers");
$externalcustomers = $view->getVariable("externalcustomers");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
<div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("List of External Customers") ?></li>
  </ol>
  </div>
    <div class="container">
    <h1><?= i18n("List of External Customers") ?></h1>
	<a href="index.php?controller=externalcustomer&amp;action=add" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Create External Customer") ?></a>

<table class="table top-buffer">
      <thead>
        <tr>
          <th>#</th>
          <th><?= i18n("Dni/Nif") ?></th>
          <th><?= i18n("Name") ?></th>
          <th style="width: 72px;"></th>
        </tr>
      </thead>
      <tbody>
	  <?php foreach($externalcustomers as $externalcustomer){ ?>
          <tr>
	      <td><?php echo $externalcustomer->getID(); ?></td>
          <td><?php echo $externalcustomer->getDni_nif(); ?></td>
          <td><?php echo $externalcustomer->getNombre(); ?></td>
          <td>
              <a href="index.php?controller=externalcustomer&amp;action=showone&amp;id=<?php echo $externalcustomer->getID();  ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a>
              <a href="index.php?controller=externalcustomer&amp;action=edit&amp;id=<?php echo $externalcustomer->getID();  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
              <a href="index.php?controller=externalcustomer&amp;action=delete&amp;id=<?php echo $externalcustomer->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
          </td>
        </tr>
	<?php } ?>
      </tbody>
</table>
<a href="index.php" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Volver") ?></a>
    </div>
</div>