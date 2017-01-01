<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Clients");
$clients = $view->getVariable("clients");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=client&amp;action=show"><?= i18n("List of Clients") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("List of Deleted Clients") ?></li>
  </ol>
  </div>
    <div class="container">
        <h1><?= i18n("List of Deleted Clients")?></h1>
<table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th><?= i18n("DNI") ?></th>
          <th><?= i18n("Name") ?></th>
          <th><?= i18n("Surname") ?></th>
          <th style="width: 72px;"></th>
        </tr>
      </thead>
      <tbody>
	  <?php foreach($clients as $client){ ?>
          <tr>
	      <td><?php echo $client->getID(); ?></td>
        <td><?php echo $client->getDni(); ?></td>
          <td><?php echo $client->getName(); ?></td>
          <td><?php echo $client->getSurname(); ?></td>
          <td>
              <a href="index.php?controller=client&amp;action=showone&amp;id=<?php echo $client->getID();  ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a>
              <a href="index.php?controller=client&amp;action=edit&amp;id=<?php echo $client->getID();  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
              <a href="index.php?controller=client&amp;action=recovery&amp;id=<?php echo $client->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-undo" aria-hidden="true"></i></a>
          </td>
        </tr>
	<?php } ?>
      </tbody>
</table>
    </div>
</div>
