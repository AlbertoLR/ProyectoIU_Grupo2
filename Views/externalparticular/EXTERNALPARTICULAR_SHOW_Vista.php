<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage External Particulares");
$externalparticulars = $view->getVariable("externalparticulars");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
<div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("List of External Particulars") ?></li>
  </ol>
  </div>
    <div class="container">
    <h1><?= i18n("List of External Particulars") ?></h1>
	<a href="index.php?controller=externalparticular&amp;action=add" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Create External Particular") ?></a>
	<a href="index.php?controller=externalparticular&amp;action=search" class="btn btn-default"><i class="fa fa-search-plus" aria-hidden="true"></i> <?= i18n("Advanced Search") ?></a>

<table class="table top-buffer">
      <thead>
        <tr>
          <th>#</th>
          <th><?= i18n("Name") ?></th>
          <th><?= i18n("Surname") ?></th>
		  <th><?= i18n("Telephone") ?></th>
          <th style="width: 72px;"></th>
        </tr>
      </thead>
      <tbody>
	  <?php foreach($externalparticulars as $externalparticular){ ?>
          <tr>
	      <td><?php echo $externalparticular->getID(); ?></td>
          <td><?php echo $externalparticular->getNombre(); ?></td>
		  <td><?php echo $externalparticular->getApellidos(); ?></td>
		  <td><?php echo $externalparticular->getTelefono(); ?></td>
          <td>
              <a href="index.php?controller=externalparticular&amp;action=showone&amp;id=<?php echo $externalparticular->getID();  ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a>
              <a href="index.php?controller=externalparticular&amp;action=edit&amp;id=<?php echo $externalparticular->getID();  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
              <a href="index.php?controller=externalparticular&amp;action=delete&amp;id=<?php echo $externalparticular->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
          </td>
        </tr>
	<?php } ?>
      </tbody>
</table>
<a href="index.php" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Volver") ?></a>
    </div>
</div>