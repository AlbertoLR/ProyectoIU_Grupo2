<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Clients");
$clients = $view->getVariable("clients");
$clients_json = $view->getVariable("clients_json");
$errors = $view->getVariable("errors");
?>

<script type="text/javascript">
        var clients = "<?php echo $clients_json ?>";
</script>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("List of Clients") ?></li>
  </ol>
  </div>
    <div class="container">
    <h1><?= i18n("List of Clients") ?></h1>
	<a href="index.php?controller=client&amp;action=add" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Create Client") ?></a>
    <a href="index.php?controller=client&amp;action=showdeleted" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("View Deleted Clients") ?></a>
    <form action="index.php?controller=client&amp;action=showone" method="POST">
    <div class=" tt-dropdown-menu .tt-menu form-group top-buffer">
	   <?= i18n("Search") ?>: <input type="text" name="id" class="typeahead tt-query form-control" autocomplete="off" spellcheck="false">
    <div>
    </form>

<table class="table top-buffer">
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
              <a href="index.php?controller=client&amp;action=delete&amp;id=<?php echo $client->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
          </td>
        </tr>
	<?php } ?>
      </tbody>
</table>
    </div>
</div>
